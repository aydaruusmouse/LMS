<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Activation;
use App\Models\Organization;
use App\Models\User;
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

    public function __construct(OrganizationRepository $organization, InstructorRepository $instructor)
    {
        $this->organization = $organization;
        $this->instructor   = $instructor;
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
}
