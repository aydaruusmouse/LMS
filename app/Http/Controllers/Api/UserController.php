<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmailVerification;
use App\Models\PhoneVerification;
use App\Models\SocialAccount;
use App\Repositories\CourseRepository;
use App\Repositories\UserRepository;
use App\Traits\ApiReturnFormatTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ApiReturnFormatTrait;

    public function profile(CourseRepository $courseRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $user            = jwtUser();
            $social_accounts = SocialAccount::where('user_id', $user->id)->get();

            $data            = [
                'id'                   => $user->id,
                'name'                 => $user->name,
                'first_name'           => $user->first_name,
                'last_name'            => nullCheck($user->last_name),
                'gender'               => nullCheck($user->gender),
                'email'                => $user->email,
                'phone'                => nullCheck($user->phone),
                'date_of_birth'        => nullCheck($user->date_of_birth),
                'address'              => nullCheck($user->address),
                'image'                => $user->profile_pic,
                'is_email_added'       => (bool) $user->email,
                'is_phone_added'       => (bool) $user->phone,
                'is_fb_connected'      => count($social_accounts) > 0 && $social_accounts->where('provider', 'facebook')->count() > 0,
                'is_google_connected'  => count($social_accounts) > 0 && $social_accounts->where('provider', 'google')->count() > 0,
                'is_twitter_connected' => count($social_accounts) > 0 && $social_accounts->where('provider', 'twitter')->count() > 0,
                'is_apple_connected'   => count($social_accounts) > 0 && $social_accounts->where('provider', 'apple')->count() > 0,
            ];

            return $this->responseWithSuccess('profile_fetched_successfully', $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function updateProfile(Request $request): \Illuminate\Http\JsonResponse
    {

        // dd(json_encode($request->all()));
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name'  => 'required',
            // 'email'      => 'required_without:phone|exists:users,email',
            // 'phone'      => 'required_without:email|exists:users,phone',
        ]);
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }

        try {
            $repo = new UserRepository();

            $user = jwtUser();

            $repo->update($request->all(), $user->id);

            return $this->responseWithSuccess('profile_updated_successfully');
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function changePassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password'     => 'required|confirmed|min:6',
        ]);
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }
        try {
            $user           = jwtUser();
            if (! Hash::check($request->old_password, $user->password)) {
                return $this->responseWithError('old_password_does_not_match');
            }
            $user->password = Hash::make($request->password);
            $user->save();

            return $this->responseWithSuccess('password_changed_successfully');
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function destroy(): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        try {
            $user               = jwtUser();
            $check_availability = userAvailability($user);

            if (! $check_availability['status']) {
                return $this->responseWithError($check_availability['message'], $check_availability['code']);
            }

            $user->is_deleted   = 1;
            $user->save();

            return $this->responseWithSuccess('account_deleted_successfully');
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function addEmail(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }
        try {
            $user         = jwtUser();
            $otp          = rand(1000, 9999);

            if ($user->email) {
                return $this->responseWithError(__('email_already_added'));
            }

            $email_verify = EmailVerification::where('email', $request->email)->latest()->first();

            if ($email_verify && now() < Carbon::parse($email_verify->created_at)->addMinutes(2)) {
                return $this->responseWithError(__('otp_already_sent'), [], 500);
            }

            EmailVerification::create([
                'otp'   => $otp,
                'email' => $request->email,
            ]);

            $msg          = __('otp_send_successfully');

            return $this->responseWithSuccess((string) $otp);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function verifyMail(Request $request): \Illuminate\Http\JsonResponse
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
            $user                 = jwtUser();

            $email_verify         = EmailVerification::where('email', $request->email)->latest()->first();
            if (! $email_verify) {
                return $this->responseWithError(__('otp_doesnt_found'), [], 500);
            }
            if ($request->otp != $email_verify->otp) {
                return $this->responseWithError(__('otp_doesnt_match'), [], 500);
            }

            $email_verify->status = 1;
            $email_verify->save();

            $user->update([
                'email'             => $request->email,
                'email_verified_at' => now(),
            ]);

            EmailVerification::where('email', $request->email)->delete();

            DB::commit();

            return $this->responseWithSuccess(__('email_added_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }

    public function addPhone(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:users,phone',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }
        try {
            $user         = jwtUser();
            $otp          = rand(1000, 9999);

            if ($user->phone) {
                return $this->responseWithError(__('phone_already_added'));
            }

            $phone_verify = PhoneVerification::where('phone', $request->phone)->latest()->first();

            if ($phone_verify && now() < Carbon::parse($phone_verify->created_at)->addMinutes(2)) {
                return $this->responseWithError(__('otp_already_sent'), [], 500);
            }

            PhoneVerification::create([
                'otp'   => $otp,
                'phone' => $request->phone,
            ]);

            $msg          = __('otp_send_successfully');

            return $this->responseWithSuccess((string) $otp);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function verifyPhone(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'otp'   => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $user                 = jwtUser();

            $phone_verify         = PhoneVerification::where('phone', $request->phone)->latest()->first();
            if (! $phone_verify) {
                return $this->responseWithError(__('otp_doesnt_found'), [], 500);
            }
            if ($request->otp != $phone_verify->otp) {
                return $this->responseWithError(__('otp_doesnt_match'), [], 500);
            }

            $phone_verify->status = 1;
            $phone_verify->save();

            $user->update([
                'phone' => $request->phone,
            ]);

            PhoneVerification::where('phone', $request->phone)->delete();

            DB::commit();

            return $this->responseWithSuccess(__('phone_added_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->responseWithError($e->getMessage(), [], 500);
        }
    }

    public function addSocial(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'uid'      => 'required',
            'provider' => 'required|in:facebook,google,apple,twitter',
            'name'     => 'required',
        ]);

        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }

        try {
            $user               = jwtUser();
            $check_availability = userAvailability($user);
            if (! $check_availability['status']) {
                return $this->responseWithError($check_availability['message'], $check_availability['code']);
            }
            $social             = SocialAccount::where('user_id', $user->id)->where('provider', $request->provider)->first();

            if ($social) {
                return $this->responseWithError(__('already_connected'));
            }

            $social             = SocialAccount::where('uid', $request->uid)->where('user_id', $user->id)->where('provider', $request->provider)->first();

            if ($social) {
                return $this->responseWithError(__('social_already_added'));
            }

            $images             = [];

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

            $name               = explode(' ', $request->name);

            SocialAccount::create([
                'user_id'    => $user->id,
                'uid'        => $request->uid,
                'provider'   => $request->provider,
                'first_name' => array_key_exists(0, $name) ? $name[0] : '',
                'last_name'  => array_key_exists(1, $name) ? $name[1] : ' '.(array_key_exists(2, $name) ? ' '.$name[2] : ''),
                'email'      => $request->email ?: '',
                'phone'      => $request->phone ?: '',
                'image'      => array_key_exists('images', $images) ? $images['images'] : [],
            ]);

            return $this->responseWithSuccess(__('social_added_successfully'));
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
