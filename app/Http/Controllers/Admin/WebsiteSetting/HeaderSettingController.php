<?php

namespace App\Http\Controllers\Admin\WebsiteSetting;

use App\Http\Controllers\Controller;
use App\Repositories\LanguageRepository;
use App\Repositories\SettingRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HeaderSettingController extends Controller
{
    protected $setting;

    protected $language;

    public function __construct(SettingRepository $setting, LanguageRepository $language)
    {
        $this->setting  = $setting;
        $this->language = $language;
    }

    public function headerTopbar(): Factory|View|Application
    {
        return view('backend.admin.website_setting.header_content.topbar');
    }

    public function headerLogo(): Factory|View|Application
    {
        return view('backend.admin.website_setting.header_content.logo');
    }

    public function headerMenu(Request $request): Factory|View|Application
    {
        $languages     = app('languages');
        $lang          = $request->site_lang ? $request->site_lang : App::getLocale();
        $menu_language = headerFooterMenu('header_menu', $lang);

        return view('backend.admin.website_setting.header_content.menu', compact('languages', 'lang', 'menu_language'));
    }

    public function updateHeaderMenu(Request $request): JsonResponse
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
}
