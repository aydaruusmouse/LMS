<?php

namespace App\Http\Controllers\Admin\MobileAppSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MobileAppRequest;
use App\Models\HomeScreen;
use App\Repositories\PageRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MobileAppSettingController extends Controller
{
    protected $setting;

    public function __construct(SettingRepository $setting)
    {
        $this->setting = $setting;
    }

    public function androidSetting(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.mobile-app.android-setting');
    }

    public function iosSetting(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.mobile-app.ios-setting');
    }

    public function mobileSettingUpdate(MobileAppRequest $request)
    {
        if ($request->mobile_app == 'android') {
            if ($request->has('android_skippable')) {
                $request['android_skippable'] = 1;
            } else {
                $request['android_skippable'] = 0;
            }
        }
        if ($request->mobile_app == 'ios') {
            if ($request->has('ios_skippable')) {
                $request['ios_skippable'] = 1;
            } else {
                $request['ios_skippable'] = 0;
            }
        }
        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));

            return response()->json([
                'success' => __('update_successful'),
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function gdpr(PageRepository $pageRepository): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $data = [
                'pages' => $pageRepository->activePages(['lang' => app()->getLocale()]),
            ];

            return view('backend.admin.mobile-app.gdpr', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function updateGdpr(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));

            return response()->json([
                'success' => __('update_successful'),
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function homeScreenBuilder(UserRepository $userRepository): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $sections    = HomeScreen::where('type', 'home_screen')->orderBy('position')->get();
            $instructors = array_merge(array_filter($sections->pluck('values')->toArray()));

            $ids         = [];
            foreach ($instructors as $instructor) {
                foreach ($instructor as $item) {
                    $ids[] = $item;
                }
            }
            $data        = [
                'sections'    => $sections,
                'instructors' => $userRepository->findUsers(['role_id' => 2, 'ids' => $ids]),
            ];

            return view('backend.admin.mobile-app.home-screen-builder', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function updateHomeScreen(Request $request): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        DB::beginTransaction();
        try {
            $i = 1;
            HomeScreen::where('type', 'home_screen')->delete();
            foreach ($request->builder as $key => $builder) {
                $exploded  = explode('_', $key);
                $num       = end($exploded);
                $substring = '_'.$num;
                $section   = is_numeric($num) ? str_replace($substring, '', $key) : $key;
                $data      = [
                    'type'     => 'home_screen',
                    'section'  => $section,
                    'contents' => $builder,
                    'position' => $i,
                ];

                HomeScreen::create($data);
                $i++;
            }
            DB::commit();
            Toastr::success(__('home_screen_updated_successfully'));

            return response()->json(['success' => __('home_screen_updated_successfully')]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
