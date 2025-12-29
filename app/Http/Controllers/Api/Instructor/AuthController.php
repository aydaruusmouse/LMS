<?php

namespace App\Http\Controllers\Api\Instructor;

use App\Http\Controllers\Controller;
use App\Models\EmailVerification;
use App\Models\User;
use App\Repositories\InstructorRepository;
use App\Repositories\UserRepository;
use App\Traits\ApiReturnFormatTrait;
use App\Traits\ImageTrait;
use App\Traits\SendMailTrait;
use App\Traits\SmsSenderTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use ApiReturnFormatTrait,ImageTrait,SendMailTrait,SmsSenderTrait;

    protected $instructor;

    public function __construct(InstructorRepository $instructor)
    {
        $this->instructor = $instructor;
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }
        try {
            $user              = User::where('email', $request->email)->whereIn('role_id', [2, 5])->first();

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

    public function register(Request $request, UserRepository $userRepository): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'           => 'required|max:255|unique:users,email',
            'password'        => 'required|min:6|max:30|confirmed',
            'first_name'      => 'required|string',
            'last_name'       => 'required|string',
            'phone'           => 'required|unique:users,phone',
            'designation'     => 'required|string',
            'organization_id' => 'required|exists:organizations,id',
        ]);

        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }

        DB::beginTransaction();

        $user      = $userRepository->findByEmail($request->email);

        if ($user && $user->is_deleted == 1) {
            $date             = now();
            $email            = "archive-$date-".$user->email;
            $phone            = "archive-$date-".$user->phone;
            $firebase_auth_id = "archive-$date-".$user->firebase_auth_id;

            $userRepository->update([
                'email'            => $email,
                'phone'            => $phone,
                'firebase_auth_id' => $firebase_auth_id,
            ], $user->id);
        }

        try {
            $data                = $request->all();
            $otp                 = rand(1000, 9999);
            $data['permissions'] = [];

            if (setting('disable_email_confirmation') == 1) {
                $data['email_verified_at'] = now();
                $msg                       = __('registration_completed_successfully');
                $data['user_type']         = 'instructor';
                $this->instructor->store($data);
            } else {
                EmailVerification::create([
                    'otp'   => $otp,
                    'email' => $request->email,
                ]);

                $data['user_type'] = 'instructor';
                $this->instructor->store($data);
                $this->sendmail($request->email, 'emails.api.email-verification', [
                    'user'    => $user,
                    'otp'     => $otp,
                    'subject' => 'Verify Mail',
                ]);
                $msg               = __('check_your_mail_to_verify_your_account');
            }

            DB::commit();

            return $this->responseWithSuccess($msg);
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }

    public function logout(): JsonResponse
    {
        try {

            JWTAuth::getToken();
            JWTAuth::parseToken()->invalidate(true);

            return $this->responseWithSuccess(__('logout_successfully'));
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }
}
