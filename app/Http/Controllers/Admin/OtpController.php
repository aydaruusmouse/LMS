<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmsTemplate;
use App\Repositories\CountryRepository;
use App\Repositories\SettingRepository;
use App\Traits\SmsSenderTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    use SmsSenderTrait;

    protected $setting;

    public function __construct(SettingRepository $setting)
    {
        $this->setting = $setting;
    }

    public function otpSetting(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.otp_setting.otp_setting');
    }

    public function saveOTP(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'active_sms_provider'     => 'required',
            'twilio_sms_sid'          => 'required_if:active_sms_provider,==,twillio',
            'twilio_sms_auth_token'   => 'required_if:active_sms_provider,==,twillio',
            'valid_twilio_sms_number' => 'required_if:active_sms_provider,==,twillio',
            'fast_2_auth_key'         => 'required_if:active_sms_provider,==,fast2',
            'fast_2_entity_id'        => 'required_if:active_sms_provider,==,fast2',
            'fast_2_route'            => 'required_if:active_sms_provider,==,fast2',
            'fast_2_language'         => 'required_if:active_sms_provider,==,fast2',
            'fast_2_sender_id'        => 'required_if:active_sms_provider,==,fast2',
            'spagreen_sms_api_key'    => 'required_if:active_sms_provider,==,spagreen',
            'spagreen_secret_key'     => 'required_if:active_sms_provider,==,spagreen',
            'mimo_username'           => 'required_if:active_sms_provider,==,mimo',
            'mimo_sms_password'       => 'required_if:active_sms_provider,==,mimo',
            'mimo_sms_sender_id'      => 'required_if:active_sms_provider,==,mimo',
            'nexmo_sms_key'           => 'required_if:active_sms_provider,==,nexmo',
            'nexmo_sms_secret_key'    => 'required_if:active_sms_provider,==,nexmo',
            'ssl_sms_api_token'       => 'required_if:active_sms_provider,==,ssl_wireless',
            'ssl_sms_url'             => 'required_if:active_sms_provider,==,ssl_wireless',
        ]);

        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
            ];

            return response()->json($data);
        }
    }

    public function sendNumber(Request $request, CountryRepository $countryRepository): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'test_number' => 'required',
        ]);
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        try {
            $data         = $request->all();
            $data['code'] = $countryRepository->getCode($data['phone_country_id']);

            $this->test($data);

            return response()->json([
                'success' => __('message_sent_successfully'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function smsTemplates(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $data = [
                'sms_templates' => SmsTemplate::all(),
            ];

            return view('backend.admin.otp_setting.sms_templates', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveTemplate(Request $request, CountryRepository $countryRepository): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'body' => 'required',
        ]);

        if (setting('active_sms_provider') == 'fast2') {
            $request->validate([
                'template_id' => 'required',
            ]);
        }
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        try {

            $sms_template = SmsTemplate::where('key', $request->key)->first();

            if ($sms_template) {
                $sms_template->update([
                    'body'        => $request->body,
                    'template_id' => $request->template_id,
                ]);
            } else {
                SmsTemplate::create([
                    'key'         => $request->key,
                    'title'       => $request->title,
                    'body'        => $request->body,
                    'short_codes' => $request->short_codes,
                    'template_id' => $request->template_id,
                ]);
            }
            Toastr::success(__('update_successful'));

            return response()->json([
                'success' => __('message_sent_successfully'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
