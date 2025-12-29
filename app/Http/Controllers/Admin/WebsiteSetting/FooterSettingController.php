<?php

namespace App\Http\Controllers\Admin\WebsiteSetting;

use App\Http\Controllers\Controller;
use App\Repositories\LanguageRepository;
use App\Repositories\SettingRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FooterSettingController extends Controller
{
    protected $setting;

    protected $language;

    public function __construct(SettingRepository $setting, LanguageRepository $language)
    {
        $this->setting  = $setting;
        $this->language = $language;
    }

    public function footerContent()
    {
        return redirect()->route('footer.social-links');
    }

    public function socialLinkSetting(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $lang = $request->site_lang ? $request->site_lang : App::getLocale();

        return view('backend.admin.website_setting.footer_content.social_link', compact('lang'));
    }

    public function newsletterSetting(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $lang = $request->site_lang ? $request->site_lang : App::getLocale();

        return view('backend.admin.website_setting.footer_content.newsletter', compact('lang'));
    }

    public function appsLinkSetting(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $lang = $request->site_lang ? $request->site_lang : App::getLocale();

        return view('backend.admin.website_setting.footer_content.apps_link', compact('lang'));
    }

    public function paymentbannerSetting(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.website_setting.footer_content.payment_banner');
    }

    public function usefulLinkSetting(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $languages     = app('languages');
        $lang          = $request->site_lang ? $request->site_lang : App::getLocale();
        $menu_language = headerFooterMenu('footer_useful_link_menu');

        return view('backend.admin.website_setting.footer_content.useful_link', compact('languages', 'lang', 'menu_language'));
    }

    public function resourceLinkSetting(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $languages     = app('languages');
        $lang          = $request->site_lang ? $request->site_lang : App::getLocale();
        $menu_language = headerFooterMenu('footer_resource_link_menu', $lang);

        return view('backend.admin.website_setting.footer_content.resources_link', compact('languages', 'lang', 'menu_language'));
    }

    public function quickLinkSetting(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $languages     = app('languages');
        $lang          = $request->site_lang ? $request->site_lang : App::getLocale();
        $menu_language = headerFooterMenu('footer_quick_link_menu', $lang);

        return view('backend.admin.website_setting.footer_content.quick_link', compact('languages', 'lang', 'menu_language'));
    }

    public function copyrightSetting(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $lang = $request->site_lang ? $request->site_lang : App::getLocale();

        return view('backend.admin.website_setting.footer_content.copyright', compact('lang'));
    }

    public function updateSetting(Request $request): \Illuminate\Http\JsonResponse
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

    public function menuUpdate(Request $request): \Illuminate\Http\JsonResponse
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
            if ($request->has('label')) {
                $menu                 = [];
                $parent               = 0;
                for ($i = 0; $i < count($request->label); $i++) {
                    if ($request['menu_lenght'][$i] == 1) {
                        $menu[] = [
                            'label'     => $request['label'][$i],
                            'url'       => getArrayValue($i, $request['url']),
                            'mega_menu' => getArrayValue($i, $request['mega_menu_position']),
                        ];
                        $parent++;
                    } else {
                        $menu[count($menu) - 1][] = [
                            'label'     => $request['label'][$i],
                            'url'       => getArrayValue($i, $request['url']),
                            'mega_menu' => getArrayValue($i, $request['mega_menu_position']),
                        ];
                    }

                }

                foreach ($request->label as $key => $label) {
                    $data[$key]['label']     = $request['label'][$key];
                    $data[$key]['url']       = $request['url'][$key];
                    $data[$key]['mega_menu'] = @$request['mega_menu_position'][$key];
                }

                if ($request->has('menu_name')) {
                    $request[$request['menu_name']] = $menu;
                } else {
                    $request['footer_useful_link_menu'] = $menu;
                }

                $request['site_lang'] = $request->lang ?: app()->getLocale();
                unset($request['label']);
                unset($request['url']);
                unset($request['menu_lenght']);
                unset($request['menu_name']);
                unset($request['mega_menu_position']);

                if ($this->setting->update($request)) {
                    Toastr::success(__('Menu Updated Successfully'));
                    $data = [
                        'success' => __('Menu Updated Successfully'),
                    ];

                    return response()->json($data);
                } else {
                    Toastr::error(__('Something went wrong, please try again.'));
                    $data = [
                        'error' => __('Something went wrong, please try again.'),
                    ];

                    return response()->json($data);
                }
            } else {
                Toastr::error(__('No Menu Found'));
                $data = [
                    'error' => __('No Menu Found'),
                ];

                return response()->json($data);
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
