<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\ActivityLog;
use App\Models\Course;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\CartRepository;
use App\Repositories\CourseRepository;
use App\Traits\GetUserBrowser;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    use GetUserBrowser;

    protected $courseRepository;

    protected $cartRepository;

    public function __construct(CourseRepository $courseRepository, CartRepository $cartRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->cartRepository   = $cartRepository;
    }

    public function create(): View
    {
        return view('frontend.auth.sign_in');
    }

    public function store(LoginRequest $request)
    {
        if ($this->activityLog($request)) {
            $url               = RouteServiceProvider::STUDENT;
            $is_array_returned = $request->authenticate();
            $request->session()->regenerate();

            if (Auth::user()->role_id == 1 || Auth::user()->role_id == 4) {
                $url = RouteServiceProvider::ADMIN;
            }

            if (Auth::user()->role_id == 2) {
                $url = RouteServiceProvider::INSTRUCTOR;
            }

            if (Auth::user()->role_id == 3) {
                if (session()->has('carts')) {
                    $this->storeToServer();
                }
                
                // Handle pending enrollment after login
                if (session()->has('pending_enrollment')) {
                    $pending = session()->get('pending_enrollment');
                    session()->forget('pending_enrollment');
                    
                    // Add the course/book to cart
                    $this->addPendingEnrollmentToCart($pending);
                    
                    // Redirect to checkout page
                    return response()->json([
                        'success'   => true,
                        'is_reload' => 1,
                        'route'     => route('checkout'),
                    ]);
                }
            }

            if (Auth::user()->role_id == 5) {
                $url = RouteServiceProvider::ORGANIZATION;
            }

            return response()->json([
                'success'   => true,
                'is_reload' => 1,
                'route'     => url($url),
            ]);
        }

        return response()->json([
            'success'   => true,
            'is_reload' => 1,
            'route'     => url()->previous(),
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function activityLog(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (blank($user)) {
            Toastr::warning(__('user_not_found'));

            return redirect()->back();
        } else {
            if ($user->status == 0) {
                Toastr::warning(__('your_account_is_inactive'));

                return false;
            } elseif ($user->is_deleted == 1) {
                Toastr::warning(__('you_account_has_been_deleted'));

                return false;
            } else {
                try {
                    $log             = [];
                    $log['url']      = $request->fullUrl();
                    $log['method']   = $request->method();
                    $log['ip']       = $request->ip();
                    $log['browser']  = $this->getBrowser($request->header('user-agent'));
                    $log['platform'] = $this->getPlatForm($request->header('user-agent'));
                    $log['user_id']  = $user->id;
                    ActivityLog::create($log);

                    return true;
                } catch (Exception $e) {
                    Toastr::warning(__($e->getMessage()));

                    return redirect()->back();
                }
            }
        }
    }

    public function storeToServer()
    {

        $total_items    = session()->get('carts');
        $course_ids     = [];

        foreach ($total_items as $item) {
            if ($item['type'] == 'course') {
                $course_ids[] = $item['id'];
            }
        }
        $sessionCourses = $this->courseRepository->findCourses($course_ids);

        $user_id        = auth()->id();

        foreach ($sessionCourses as $course) {
            $this->cartRepository->store([
                'instructor_id' => $course->instructor_ids,
                'user_id'       => $user_id,
                'quantity'      => 1,
                'price'         => $course->is_free ? 0 : $course->price,
                'discount'      => $course->discount_check,
                'trx_id'        => Str::random(),
                'tax'           => 0,
                'sub_total'     => $course->is_free ? 0 : $course->price,
                'total_amount'  => $course->is_free ? 0 : $course->price,
                'shipping_cost' => 0,
                'cartable_id'   => $course->id,
                'cartable_type' => Course::class]);
        }
    }

    protected function addPendingEnrollmentToCart($pending)
    {
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
