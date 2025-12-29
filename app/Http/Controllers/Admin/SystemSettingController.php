<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PGRequest;
use App\Models\Timezone;
use App\Repositories\CountryRepository;
use App\Repositories\CurrencyRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\SettingRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SystemSettingController extends Controller
{
    protected $setting;

    public function __construct(SettingRepository $setting)
    {
        $this->setting = $setting;
    }

    public function generalSetting(LanguageRepository $languageRepository, CountryRepository $countryRepository, CurrencyRepository $currencyRepository, Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            if (setting('time_zone')) {
                $time_zone = Timezone::where('id', setting('time_zone'))->first()->timezone;
                envWrite('APP_TIMEZONE', $time_zone);
                session()->forget('time_zone');
            }

            $data = [
                'languages'  => $languageRepository->activeLanguage(),
                'time_zones' => Timezone::all(),
                'countries'  => $countryRepository->all(),
                'currencies' => $currencyRepository->activeCurrency(),
                'lang'       => $request->site_lang ? $request->site_lang : App::getLocale(),
            ];

            return view('backend.admin.system_setting.general_setting', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function updateSetting(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            Toastr::info(__('this_function_is_disabled_in_demo_server'));

            return back();
        }

        DB::beginTransaction();
        try {
            $this->setting->update($request);

            Toastr::success(__('update_successful'));
            DB::commit();

            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function generalSettingUpdate(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            Toastr::info(__('this_function_is_disabled_in_demo_server'));

            return back();
        }
        $request->validate([
            'system_name'   => 'required',
            'company_name'  => 'required',
            'tagline'       => 'required',
            'phone'         => 'required|numeric',
            'email_address' => 'required|email',
            'purchase_code' => 'required',
            'time_zone'     => 'required',
        ]);

        DB::beginTransaction();
        try {
            $this->setting->update($request);
            $time_zone = Timezone::where('id', $request->time_zone)->first();
            if ($time_zone) {
                $time_zone = $time_zone->timezone;
                envWrite('APP_TIMEZONE', $time_zone);
            }

            Toastr::success(__('update_successful'));

            DB::commit();

            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error($e->getMessage());

            return back()->withInput();
        }
    }

    public function cache(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.system_setting.cache_setting');
    }

    public function cacheUpdate(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        if ($request->is_cache_enabled == 'enable') {
            $request->validate([
                'is_cache_enabled' => 'required',
                'redis_host'       => 'required_if:default_cache,=      =,redis',
                'redis_password'   => 'required_if:default_cache,=  =,redis',
                'redis_port'       => 'required_if:default_cache,=      =,redis',
            ]);
        }

        try {

            $this->setting->update($request);
            Artisan::call('optimize:clear');

            if ($request->is_cache_enabled == 'enable') {
                Artisan::call('config:cache');
            }

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

    public function firebase(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.system_setting.firebase');
    }

    public function firebaseUpdate(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        $request->validate([
            'api_key'             => 'required',
            'auth_domain'         => 'required',
            'project_id'          => 'required',
            'storage_bucket'      => 'required',
            'messaging_sender_id' => 'required',
            'app_id'              => 'required',
            'measurement_id'      => 'required',
        ]);

        try {

            $request->setMethod('POST');
            $request->request->add(['is_google_login_activated' => $request->has('is_google_login_activated') ? 1 : 0]);
            $request->request->add(['is_facebook_login_activated' => $request->has('is_facebook_login_activated') ? 1 : 0]);
            $request->request->add(['is_twitter_login_activated' => $request->has('is_twitter_login_activated') ? 1 : 0]);

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

    public function preference(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.system_setting.preference');
    }

    public function systemStatus(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
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
            if (array_key_exists('maintenance_secret', $request->all())) {
                $command = $request['maintenance_secret'];
                if ($this->setting->update($request)) {
                    Artisan::call('down --refresh=15 --secret='.$command);
                    Toastr::success(__('updated_successfully'));

                    return back();
                } else {
                    Toastr::error(__('Something went wrong, please try again'));

                    return back();
                }
            }
            if (config('app.demo_mode')) {
                $response['message'] = __('This function is disabled in demo server.');
                $response['title']   = __('Ops..!');
                $response['status']  = 'error';

                return response()->json($response);
            }
            if ($this->setting->statusChange($request->data)) {
                if ($request['data']['name'] == 'maintenance_mode') {
                    Artisan::call('up');
                }

                if ($request['data']['name'] == 'migrate_web') {
                    if (is_dir('resources/views/admin/store-front')) {
                        envWrite('MOBILE_MODE', 'off');
                        Artisan::call('optimize:clear');
                    } else {
                        $response['message'] = __('migrate_permission');
                        $response['title']   = __('error');
                        $response['status']  = 'error';
                        $response['type']    = 'migrate_error';

                        return response()->json($response);
                    }
                }

                $reload_names        = ['wallet_system', 'coupon_system'];

                if (in_array($request['data']['name'], $reload_names)) {
                    $response['reload'] = 1;
                }

                $response['message'] = __('Updated Successfully');
                $response['title']   = __('Success');
                $response['status']  = 'success';
            } else {
                $response['message'] = __('Something went wrong, please try again');
                $response['title']   = __('Ops..!');
                $response['status']  = 'error';
            }

            return response()->json($response);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['title']   = __('Ops..!');
            $response['status']  = 'error';

            return response()->json($response);
        }
    }

    public function storageSetting(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.system_setting.storage_setting');
    }

    public function saveStorageSetting(Request $request): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $request->validate([
            'aws_access_key_id'             => 'required_if:default_storage,==,aws_s3',
            'aws_secret_access_key'         => 'required_if:default_storage,==,aws_s3',
            'aws_default_region'            => 'required_if:default_storage,==,aws_s3',
            'aws_bucket'                    => 'required_if:default_storage,==,aws_s3',
            'wasabi_access_key_id'          => 'required_if:default_storage,==,wasabi',
            'wasabi_secret_access_key'      => 'required_if:default_storage,==,wasabi',
            'wasabi_default_region'         => 'required_if:default_storage,==,wasabi',
            'wasabi_bucket'                 => 'required_if:default_storage,==,wasabi',
            'image_optimization_percentage' => 'required_if:image_optimization,==,setting-status-change/image_optimization',
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

    public function chatMessenger(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.system_setting.chat_messenger');
    }

    public function saveMessengerSetting(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        $request->validate([
            'facebook_page_id'         => 'required_if:fb,=        =,1',
            'facebook_messenger_color' => 'required_if:fb,==,1',
            'tawk_property_id'         => 'required_if:tawk,=        =,1',
            'tawk_widget_id'           => 'required_if:tawk,=          =,1',
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

    public function paymentGateways(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.system_setting.payment_gateways');
    }

    public function savePGSetting(PGRequest $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
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

    public function pusher(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.system_setting.pusher');
    }

    public function savePusherSetting(PGRequest $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        $request->validate([
            'pusher_app_id'      => 'required',
            'pusher_app_key'     => 'required',
            'pusher_app_secret'  => 'required',
            'pusher_app_cluster' => 'required',
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

    public function oneSignal(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.system_setting.onesignal');
    }

    public function saveOneSignalSetting(PGRequest $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        $request->validate([
            'onesignal_app_id' => 'required',
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

    public function adminPanelSetting()
    {
        $lang = \App::getLocale();

        return view('backend.admin.system_setting.admin_panel_setting', compact('lang'));
    }

    public function miscellaneousSetting()
    {
        return view('backend.admin.system_setting.miscellaneous_setting');
    }

    public function aiWriterSetting()
    {
        return view('backend.admin.system_setting.ai_writer_setting');
    }

    public function miscellaneousUpdate(Request $request): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $request->validate([
            'paginate'                   => 'required|numeric',
            'api_paginate'               => 'required|numeric',
            'index_form_pagination_size' => 'required|numeric',
            'media_paginate'             => 'required|numeric',
            'order_prefix'               => 'required',

        ]);

        DB::beginTransaction();
        try {
            $this->setting->update($request);

            Toastr::success(__('update_successful'));
            DB::commit();

            return response()->json([
                'success' => __('update_successful'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error(__($e->getMessage()));

            return response()->json([
                'error' => __($e->getMessage()),
            ]);
        }
    }

    public function refund(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.system_setting.refund');
    }

    public function saveRefundSetting(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        $request->validate([
            'refund_status'         => 'required',
            'refund_time'           => 'required',
            'completion_percentage' => 'required',
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
}
