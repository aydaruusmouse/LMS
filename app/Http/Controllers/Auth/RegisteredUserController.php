<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Activation;
use App\Models\Organization;
use App\Models\User;
use App\Models\Course;
use App\Repositories\CartRepository;
use App\Repositories\CourseRepository;
use App\Repositories\InstructorRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\PageRepository;
use App\Traits\SendMailTrait;
use App\Traits\SendNotification;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    use SendMailTrait, SendNotification;

    protected $organization;

    protected $instructor;

    protected $cartRepository;

    protected $courseRepository;

    public function __construct(OrganizationRepository $organization, InstructorRepository $instructor, CartRepository $cartRepository, CourseRepository $courseRepository)
    {
        $this->organization = $organization;
        $this->instructor   = $instructor;
        $this->cartRepository = $cartRepository;
        $this->courseRepository = $courseRepository;
    }

    public function create(PageRepository $pageRepository): View
    {
        $privacy = $pageRepository->get(setting('privacy_agreement'));
        $terms   = $pageRepository->get(setting('terms_agreement'));
        $data    = [
            'privacy_url'     => $privacy ? url('page/'.$privacy->link) : '#',
            'terms_condition' => $terms ? url('page/'.$terms->link) : '#',
        ];

        return view('frontend.auth.sign_up', $data);
    }

    // student register

    public function store(Request $request) //: RedirectResponse
    {
        $request->validate([
            'first_name'      => ['required', 'string', 'max:255'],
            'last_name'       => ['nullable', 'string', 'max:255'],
            'email'           => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'        => ['required', 'confirmed', 'string', 'min:6'],
            'phone'           => ['required', 'unique:users,phone'],
            'city'            => ['required', 'string', 'max:255'],
            'terms_condition' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $user                   = new User();
            $user->first_name       = $request->first_name;
            $user->last_name        = $request->last_name;
            $user->email            = $request->email;
            $user->phone_country_id = $request->phone_country_id;
            $user->phone            = $request->phone;
            // Store city text - using address field to store city name
            if ($request->has('city')) {
                $user->address = $request->city;
            }
            $user->status           = 0;
            $user->password         = Hash::make($request->password);
            $user->status           = 1;

            if (setting('disable_email_confirmation') == 1) {
                $user->email_verified_at = now();
            }

            if (empty($request->organization_id)) {
                $user->role_id = 3;
                $user->save();
                event(new Registered($user));
                if (setting('disable_email_confirmation') == 1) {
                    Toastr::success(__('registration_completed_successfully'));
                    Auth::login($user);
                    
                    // Handle pending enrollment after registration
                    if (session()->has('pending_enrollment')) {
                        $this->handlePendingEnrollment();
                        DB::commit();
                        // Redirect to checkout if pending enrollment was processed
                        return redirect()->route('checkout');
                    }
                }
                DB::commit();

                return $this->emailConfirmation($request);
            } elseif (! empty($request->organization_id)) {
                if ($this->organization->find(1000)) {
                    $this->instructor->store($request->all());
                    $instructor = User::where('email', $request->email)->first();
                    event(new Registered($instructor));
                    Auth::login($instructor);
                    DB::commit();

                    return $this->emailConfirmation($request);
                } else {
                    $request['org_name']     = $request->organization_id;
                    $request['person_name']  = $request->first_name.' '.$request->last_name;
                    $request['person_email'] = $request->email;
                    $request['person_phone'] = $request->phone;
                    if ($this->organization->store($request->all())) {
                        $organization               = Organization::select('id')->where('email', $request->email)->first();
                        $request['organization_id'] = $organization->id;
                        $this->instructor->store($request->all());
                        $instructor                 = User::where('email', $request->email)->first();
                        event(new Registered($instructor));
                        Auth::login($instructor);
                        DB::commit();

                        return $this->emailConfirmation($request);
                    }
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function emailConfirmation(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (setting('disable_email_confirmation') != 1) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $data['user_id'] = $user->id;
            $data['code']    = Str::random(32);
            $activation      = Activation::create($data);
            $data            = [
                'user'              => $user,
                'user_id'           => $user->id,
                'code'              => $activation->code,
                'confirmation_link' => url('/').'/activation/'.$request->email.'/'.$activation->code,
                'template_title'    => 'email_confirmation',
            ];
            $this->sendmail($request->email, 'emails.template_mail', $data);
            Toastr::success(__('user_register_hints'));

            return redirect()->route('login');
        } else {
            return redirect()->route('login');
        }
    }

    protected function handlePendingEnrollment()
    {
        if (session()->has('pending_enrollment')) {
            $pending = session()->get('pending_enrollment');
            session()->forget('pending_enrollment');
            
            $user_id = auth()->id();
            
            if ($pending['type'] == 'course') {
                $course = $this->courseRepository->find($pending['id']);
                
                if ($course) {
                    // Check if already in cart
                    $existingCart = \App\Models\Cart::where('user_id', $user_id)
                        ->where('cartable_id', $course->id)
                        ->where('cartable_type', Course::class)
                        ->first();
                    
                    if (!$existingCart) {
                        $has_cart = $this->cartRepository->hasCart($user_id);
                        $quantity = $pending['quantity'] ?? 1;
                        $sub_total = $course->is_free ? 0 : $course->price * $quantity;
                        $trx_id = $has_cart ? $has_cart->trx_id : Str::random();
                        
                        $this->cartRepository->store([
                            'instructor_id' => $course->instructor_ids,
                            'user_id'       => $user_id,
                            'quantity'      => $quantity,
                            'price'         => $course->is_free ? 0 : $course->price,
                            'discount'      => $course->discount_check,
                            'trx_id'        => $trx_id,
                            'tax'           => 0,
                            'sub_total'     => $sub_total,
                            'total_amount'  => ($sub_total) - $course->discount_check,
                            'shipping_cost' => 0,
                            'cartable_id'   => $course->id,
                            'cartable_type' => Course::class,
                        ]);
                    }
                }
            }
        }
    }
}
