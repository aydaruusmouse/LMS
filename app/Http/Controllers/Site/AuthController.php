<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Activation;
use App\Models\PasswordRequest;
use App\Models\User;
use App\Repositories\PageRepository;
use App\Repositories\UserRepository;
use App\Traits\ImageTrait;
use App\Traits\SendMailTrait;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ImageTrait, SendMailTrait;

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function socialLogin(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'uid' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user = User::where('firebase_auth_id', $request->uid)->where('role_id', 3)->first();

            if ($user) {
                $check_user_status = userAvailability($user);

                if (! $check_user_status['status']) {
                    return response()->json([
                        'error' => $check_user_status['message'],
                    ]);
                }
            } else {
                $images      = [];

                try {
                    $curl     = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL            => $request->image,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING       => '',
                        CURLOPT_MAXREDIRS      => 10,
                        CURLOPT_TIMEOUT        => 30,
                        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST  => 'GET',
                    ]);

                    $response = curl_exec($curl);

                    $err      = curl_error($curl);
                    curl_close($curl);
                    $url      = $response;
                } catch (\Exception $e) {
                    $url = '';
                }

                if ($url) {
                    $images = $this->saveImage('', '_staff_', '', $url);
                } elseif ($request->image) {
                    $images = $this->saveImage('', '_staff_', '', file_get_contents($request->image));
                }

                $name        = explode(' ', $request->name);
                $credentials = [
                    'first_name'        => array_key_exists(0, $name) ? $name[0] : '',
                    'last_name'         => array_key_exists(1, $name) ? $name[1] : ' '.(array_key_exists(2, $name) ? ' '.$name[2] : ''),
                    'email'             => $request->email ?: '',
                    'phone'             => $request->phone ?: '',
                    'images'            => array_key_exists('images', $images) ? $images['images'] : [],
                    'password'          => $request->uid,
                    'role_id'           => 3,
                    'gender'            => $request->gender,
                    'firebase_auth_id'  => $request->uid,
                    'permissions'       => [],
                    'email_verified_at' => now(),
                ];

                $user        = $this->userRepository->store($credentials);
            }

            Auth::login($user);

            DB::commit();

            return response()->json([
                'success' => __('login_successfully'),
                'route'   => route('my-profile'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function signUp(PageRepository $pageRepository): Factory|View|Application
    {
        $privacy = $pageRepository->get(setting('privacy_agreement'));
        $terms   = $pageRepository->get(setting('terms_agreement'));
        $data    = [
            'privacy_url'     => $privacy ? url('page/'.$privacy->link) : '#',
            'terms_condition' => $terms ? url('page/'.$terms->link) : '#',
        ];

        return view('frontend.auth.sign_up', $data);
    }

    public function forgotPassword()
    {
        return view('frontend.auth.forget_password');
    }

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            try {
                $check_user_status = userAvailability($user);

                if (! $check_user_status['status']) {
                    Toastr::error($check_user_status['message']);

                    return back();
                }
                $otp               = rand(1000, 9999);
                PasswordRequest::where('user_id', $user->id)->delete();
                PasswordRequest::create([
                    'user_id' => $user->id,
                    'otp'     => $otp,
                ]);
                $data              = [
                    'otp'            => $otp,
                    'user'           => $user,
                    'reset_link'     => url('/').'/confirm-otp/'.$request->email.'/'.$otp,
                    'template_title' => 'password_reset',
                ];

                $this->sendmail($request->email, 'emails.template_mail', $data);
                Toastr::success(__('receive__mail_password_hints'));

                return redirect()->back();
            } catch (Exception $e) {
                Toastr::warning(__($e->getMessage()));

                return redirect()->back();
            }
        } else {
            Toastr::warning(__('user_not_found'));

            return redirect()->back();
        }
    }

    public function confirmOtp($email, $otp)
    {
        $password_request = PasswordRequest::where('otp', $otp)->first();
        $otp_array        = array_map('intval', str_split($password_request->otp));
        $data             = [
            'password_request' => $password_request,
            'otp_array'        => $otp_array,
            'email'            => $email,
        ];

        return view('frontend.auth.otp', $data);
    }

    public function passwordOtpSubmit(Request $request)
    {
        $request->validate([
            'first'  => ['required', 'numeric', 'digits:1'],
            'second' => ['required', 'numeric', 'digits:1'],
            'third'  => ['required', 'numeric', 'digits:1'],
            'fourth' => ['required', 'numeric', 'digits:1'],
        ]);
        try {
            $otp         = $request->first.$request->second.$request->third.$request->fourth;
            $otp_request = PasswordRequest::where('otp', $otp)->first();
            if (! $otp_request) {
                Toastr::warning(__('sorry_otp_not_match'));

                return redirect()->back();
            }

            return view('frontend.auth.confirm-password', compact('otp_request'));
        } catch (Exception $e) {
            Toastr::error(__($e->getMessage()));

            return back();
        }
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|max:32|confirmed',
        ]);

        try {
            $user = User::where('email', $request->email)->first();
            $otp  = PasswordRequest::where('otp', $request->otp)->where('user_id', $user->id)->latest()->first();
            if ($otp) {
                $data           = [
                    'user'           => $user,
                    'login_link'     => url('/login'),
                    'template_title' => 'recovery_mail',
                ];

                $this->sendmail($request->email, 'emails.template_mail', $data);
                $user->password = bcrypt($request->password);
                $user->save();
                $otp->delete();
                Toastr::success(__('successfully_password_changed'));

                return $this->logout($request);
            } else {
                Toastr::warning(__('please_request_another_code'));

                return redirect()->back();
            }
        } catch (Exception $e) {
            Toastr::warning(__($e->getMessage()));

            return redirect()->back();
        }
    }

    public function activation($email, $code)
    {
        $user       = User::whereEmail($email)->first();
        $activation = Activation::where([['code', $code], ['user_id', $user->id]])->first();
        if ($activation) {
            if ($activation->completed == 1) {
                Toastr::success(__('your_account_has_been_already_activated'));

                return redirect()->route('login');
            } else {
                try {
                    DB::beginTransaction();
                    $activation->completed   = 1;
                    $activation->save();
                    $user->email_verified_at = now();
                    $user->status            = 1;
                    $user->save();
                    $data                    = [
                        'user'           => $user,
                        'login_link'     => url('/login'),
                        'template_title' => 'welcome_email',
                    ];
                    $this->sendmail($email, 'emails.template_mail', $data);
                    DB::commit();
                    Toastr::success(__('your_account_is_active_now'));

                    return redirect()->route('login');
                } catch (Exception $e) {
                    DB::rollBack();
                    Toastr::success(__($e->getMessage()));

                    return redirect()->route('login');
                }
            }
        } else {
            Toastr::error(__('please_check_your_credential'));

            return redirect()->route('login');
        }
    }

    public function changePassword()
    {
        return view('frontend.auth.change-password');
    }

    public function changePasswordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password'         => 'required|min:6|max:32|confirmed',
        ]);
        $user = $this->userRepository->findByEmail(auth()->user()->email);
        if (Hash::check($request->current_password, $user->password)) {
            try {
                $user->password = bcrypt($request->password);
                $user->save();
                Toastr::success(__('successfully_password_changed'));

                return $this->logout($request);
            } catch (Exception $e) {
                Toastr::warning(__($e->getMessage()));

                return redirect()->back();
            }
        } else {
            Toastr::warning(__('sorry_old_password_not_match'));

            return redirect()->back();
        }
    }
}
