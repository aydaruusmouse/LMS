<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\EmailVerification;
use App\Models\PhoneVerification;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\ApiReturnFormatTrait;
use App\Traits\ImageTrait;
use App\Traits\SendMailTrait;
use App\Traits\SmsSenderTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use ApiReturnFormatTrait,ImageTrait,SendMailTrait,SmsSenderTrait;

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }
        try {
            $user              = User::where('email', $request->email)->where('role_id', 3)->first();
            dd($user);

            $check_user_status = userAvailability($user);

            if (! $check_user_status['status']) {
                return $this->responseWithError($check_user_status['message'], [], $check_user_status['code']);
            }

            $credentials       = $request->only('email', 'password');

            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return $this->responseWithError(__('invalid_credentials'), [], 401);
                }
            } catch (JWTException $e) {
                return $this->responseWithError(__('unable_to_login'), [], 422);

            } catch (\Exception $e) {
                return $this->responseWithError($e->getMessage(), [], 500);
            }

            Auth::attempt($credentials);

            return $this->responseWithSuccess(__('login_successfully'), authData($user, $token));
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'email'      => 'required|max:255|unique:users,email',
            'password'   => 'required|min:6|max:30|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }

        DB::beginTransaction();

        $user      = $this->userRepository->findByEmail($request->email);

        if ($user && $user->is_deleted == 1) {
            $date             = now();
            $email            = "archive-$date-".$user->email;
            $phone            = "archive-$date-".$user->phone;
            $firebase_auth_id = "archive-$date-".$user->firebase_auth_id;

            $this->userRepository->update([
                'email'            => $email,
                'phone'            => $phone,
                'firebase_auth_id' => $firebase_auth_id,
            ], $user->id);
        }

        try {
            $data                = $request->all();
            $otp                 = rand(1000, 9999);
            $data['role_id']     = 3;
            $data['permissions'] = [];

            if (setting('disable_email_confirmation') == 1) {
                $data['email_verified_at'] = now();
                $msg                       = __('registration_completed_successfully');
                $this->userRepository->store($data);
            } else {
                EmailVerification::create([
                    'otp'   => $otp,
                    'email' => $request->email,
                ]);

                $user = $this->userRepository->store($data);
                $this->sendmail($request->email, 'emails.api.email-verification', [
                    'user'    => $user,
                    'otp'     => $otp,
                    'subject' => 'Verify Mail',
                ]);
                $msg  = __('check_your_mail_to_verify_your_account');
            }

            DB::commit();

            return $this->responseWithSuccess($msg);
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }

    public function resendEmailOtp(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|exists:users,email',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }
        DB::beginTransaction();
        try {
            $otp          = rand(1000, 9999);

            $user         = $this->userRepository->findByEmail($request->email);

            if ($user->email_verified_at) {
                return $this->responseWithSuccess(__('your_email_is_already_verified'));
            }

            $email_verify = EmailVerification::where('email', $request->email)->latest()->first();

            if ($email_verify && now() < Carbon::parse($email_verify->created_at)->addMinutes(2)) {
                return $this->responseWithError(__('otp_already_sent'), [], 500);
            }

            EmailVerification::create([
                'otp'   => $otp,
                'email' => $request->email,
            ]);

            $this->sendmail($request->email, 'emails.api.email-verification', [
                'user'    => $user,
                'otp'     => $otp,
                'subject' => 'Verify Mail',
            ]);
            $msg          = __('check_your_mail_to_verify_your_account');

            DB::commit();

            return $this->responseWithSuccess($msg);
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }

    public function emailVerify(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'otp'   => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $email_verify            = EmailVerification::where('email', $request->email)->latest()->first();
            if (! $email_verify) {
                return $this->responseWithError(__('otp_doesnt_found'), [], 500);
            }
            if ($request->otp != $email_verify->otp) {
                return $this->responseWithError(__('otp_doesnt_match'), [], 500);
            }

            $email_verify->status    = 1;
            $email_verify->save();
            $user                    = User::where('email', $request->email)->first();
            $user->email_verified_at = now();
            $user->save();
            EmailVerification::where('email', $request->email)->delete();

            try {
                if (! $token = JWTAuth::fromUser($user)) {
                    auth()->login($user);

                    return $this->responseWithError(__('invalid_credentials'), [], 401);
                }
            } catch (JWTException $e) {
                return $this->responseWithError(__('unable_to_login'), [], 422);
            } catch (\Exception $e) {
                return $this->responseWithError($e->getMessage(), [], 500);
            }

            Auth::login($user);

            DB::commit();

            return $this->responseWithSuccess(__('otp_verified_successfully'), authData($user, $token));
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }

    public function registerByPhone(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'phone'      => 'required|max:255|unique:users,phone',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }
        DB::beginTransaction();
        try {
            $otp                       = rand(1000, 9999);
            $data                      = $request->all();

            $data['role_id']           = 3;
            $data['email_verified_at'] = now();
            $data['permissions']       = [];

            if (setting('disable_otp_verification') == 1) {
                $msg = __('registration_completed_successfully');
                $this->userRepository->store($data);
            } else {
                PhoneVerification::create([
                    'first_name' => $request->first_name,
                    'last_name'  => $request->last_name,
                    'otp'        => $otp,
                    'phone'      => $request->phone,
                ]);

                $msg = $this->sendSMS($request->phone, 'register', $otp);

                if (! $msg) {
                    return $this->responseWithError($msg, [], 500);
                }

                $msg = __('an_otp_sent_to_your_phone');
            }

            DB::commit();

            return $this->responseWithSuccess($msg);
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }

    public function phoneVerify(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|max:255|unique:users,phone|exists:phone_verifications,phone',
            'otp'   => 'required|exists:phone_verifications,otp',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }
        DB::beginTransaction();
        try {
            $data                      = $request->all();

            $verification              = PhoneVerification::where('otp', $request->otp)->latest()->first();

            $data['first_name']        = $verification->first_name;
            $data['last_name']         = $verification->last_name;
            $data['role_id']           = 3;
            $data['email_verified_at'] = now();
            $data['permissions']       = [];
            $data['password']          = bcrypt($data['otp']);
            $user                      = $this->userRepository->store($data);
            $msg                       = __('registration_completed_successfully');
            PhoneVerification::where('phone', $request->phone)->delete();

            try {
                if (! $token = JWTAuth::fromUser($user)) {
                    auth()->login($user);

                    return $this->responseWithError(__('invalid_credentials'), [], 401);
                }
            } catch (JWTException $e) {
                return $this->responseWithError(__('unable_to_login'), [], 422);
            } catch (\Exception $e) {
                return $this->responseWithError($e->getMessage(), [], 500);
            }

            Auth::login($user);

            DB::commit();

            return $this->responseWithSuccess($msg, \authData($user, $token));
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }

    public function resendPhoneOtp(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|max:255|exists:phone_verifications,phone',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }
        DB::beginTransaction();
        try {
            $otp          = rand(1000, 9999);

            $phone_verify = PhoneVerification::where('phone', $request->phone)->latest()->first();

            if (! $phone_verify) {
                return $this->responseWithError(__('please_register_first'));
            }

            if (now() < Carbon::parse($phone_verify->created_at)->addMinutes(2)) {
                return $this->responseWithError(__('otp_already_sent'), [], 500);
            }

            $phone_verify->update([
                'otp' => $otp,
            ]);

            $msg          = $this->sendSMS($request->phone, 'register', $otp);

            if (! $msg) {
                return $this->responseWithError($msg, [], 500);
            }

            $msg          = __('otp_has_been_sent_to_your_mobile');

            DB::commit();

            return $this->responseWithSuccess($msg);
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }

    public function socialLogin(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'uid' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }
        DB::beginTransaction();
        try {
            $user = User::where('firebase_auth_id', $request->uid)->where('role_id', 3)->first();

            if ($user && $user->is_deleted == 1) {
                $date             = now();
                $email            = "archive-$date-".$user->email;
                $phone            = "archive-$date-".$user->phone;
                $firebase_auth_id = "archive-$date-".$user->firebase_auth_id;

                $this->userRepository->update([
                    'email'            => $email,
                    'phone'            => $phone,
                    'firebase_auth_id' => $firebase_auth_id,
                ], $user->id);
            }

            if ($user && $user->is_deleted != 1) {
                $check_user_status = userAvailability($user);

                if (! $check_user_status['status']) {
                    return $this->responseWithError($check_user_status['message'], [], $check_user_status['code']);
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
            try {
                if (! $token = JWTAuth::fromUser($user)) {
                    auth()->login($user);

                    return $this->responseWithError(__('invalid_credentials'), [], 401);
                }
            } catch (JWTException $e) {
                return $this->responseWithError(__('unable_to_login'), [], 422);
            } catch (\Exception $e) {
                return $this->responseWithError($e->getMessage(), [], 500);
            }

            Auth::login($user);

            DB::commit();

            return $this->responseWithSuccess(__('login_successfully'), authData($user, $token));
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }

    public function getLoginOtp(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|max:255|exists:users,phone',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }

        try {
            $otp               = rand(1000, 9999);

            $user              = $this->userRepository->findByPhone($request->phone);

            $check_user_status = userAvailability($user);

            if (! $check_user_status['status']) {
                return $this->responseWithError($check_user_status['message'], [], $check_user_status['code']);
            }

            $phone_verify      = PhoneVerification::where('phone', $request->phone)->latest()->first();

            if ($phone_verify && now() < Carbon::parse($phone_verify->created_at)->addMinutes(2)) {
                return $this->responseWithError(__('otp_already_sent'), [], 500);
            }

            PhoneVerification::create([
                'first_name' => $user->first_name,
                'last_name'  => $user->last_name,
                'otp'        => $otp,
                'phone'      => $request->phone,
            ]);

            $msg               = $this->sendSMS($request->phone, 'login', $otp);

            if (! $msg) {
                return $this->responseWithError($msg, [], 500);
            }

            $msg               = __('check_your_phone_to_verify_your_account');

            return $this->responseWithSuccess($msg);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }

    public function verifyLoginOtp(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|max:255|exists:users,phone|exists:phone_verifications,phone',
            'otp'   => 'required|max:255|exists:phone_verifications,otp',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }

        try {

            $phone_verify      = PhoneVerification::where('phone', $request->phone)->latest()->first();

            if ($phone_verify->otp != $request->otp) {
                return $this->responseWithError(__('invalid_otp'), [], 422);
            }

            $user              = $this->userRepository->findByPhone($request->phone);

            $check_user_status = userAvailability($user);

            if (! $check_user_status['status']) {
                return $this->responseWithError($check_user_status['message'], [], $check_user_status['code']);
            }

            try {
                if (! $token = JWTAuth::fromUser($user)) {
                    auth()->login($user);

                    return $this->responseWithError(__('invalid_credentials'), [], 401);
                }
            } catch (JWTException $e) {
                return $this->responseWithError(__('unable_to_login'), [], 422);
            } catch (\Exception $e) {
                return $this->responseWithError($e->getMessage(), [], 500);
            }

            Auth::login($user);

            DB::commit();

            return $this->responseWithSuccess(__('login_successfully'), authData($user, $token));
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        try {

            JWTAuth::getToken();
            JWTAuth::parseToken()->invalidate(true);

            return $this->responseWithSuccess(__('logout_successfully'));
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }

    public function forgotPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:phone|exists:users,email',
            'phone' => 'required_without:email|exists:users,phone',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }

        try {
            $otp               = rand(1000, 9999);

            $user              = $this->userRepository->findByEmail($request->email);
            if (! $user) {
                $user = $this->userRepository->findByPhone($request->phone);
            }
            $check_user_status = userAvailability($user);

            if (! $check_user_status['status']) {
                return $this->responseWithError($check_user_status['message'], [], $check_user_status['code']);
            }
            $verify            = DB::table('password_resets')->where('email', $request->email)->first();

            if ($verify && now() < Carbon::parse($verify->created_at)->addMinutes(2)) {
                return $this->responseWithError(__('otp_already_sent'), [], 500);
            }

            DB::table('password_resets')->where('email', $request->email)->delete();

            DB::table('password_resets')->insert([
                'email'      => $request->email ?: $request->phone,
                'token'      => $otp,
                'created_at' => now(),
            ]);

            $data['user']      = $user;
            $data['otp']       = $otp;
            $data['subject']   = 'Reset Password';

            if (arrayCheck('phone', $data)) {
                $msg = $this->sendSMS($request->phone, 'forgot_password', $otp);

                if (! $msg) {
                    return $this->responseWithError($msg, [], 500);
                }
            } else {
                $this->sendmail($request->email, 'emails.api.forgot_password', $data);
            }

            return $this->responseWithSuccess((string) $otp);

        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function verifyOtp(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:phone|exists:users,email',
            'phone' => 'required_without:email|exists:users,phone',
            'otp'   => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }
        DB::beginTransaction();
        try {
            $otp = DB::table('password_resets')->where('token', $request->otp)->where('email', $request->email)->latest()->first();

            if ($otp) {
                return $this->responseWithSuccess(__('otp_verified_successfully'));
            } else {
                return $this->responseWithError(__('otp_doesnt_match'), [], 404);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }

    public function resetPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required_without:phone|exists:users,email',
            'phone'    => 'required_without:email|exists:users,phone',
            'password' => 'required|confirmed|min:6',
            'otp'      => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }

        DB::beginTransaction();
        try {
            $otp            = DB::table('password_resets')->where('token', $request->otp)->where('email', $request->email)->latest()->first();

            if (! $otp) {
                return $this->responseWithError(__('otp_doesnt_found'), [], 404);
            }

            $user           = $this->userRepository->findByEmail($otp->email);
            if (! $user) {
                $user = $this->userRepository->findByPhone($otp->phone);
            }

            $user->password = bcrypt($request->password);
            $user->save();

            DB::table('password_resets')->where('email', $request->email)->delete();

            DB::commit();

            return $this->responseWithSuccess(__('password_has_been_changed'));

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['errors' => 'Something Went wrong']);
        }
    }
}
