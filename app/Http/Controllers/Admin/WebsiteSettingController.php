<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeScreen;
use App\Repositories\CourseRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\LessonRepository;
use App\Repositories\PageRepository;
use App\Repositories\SettingRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use App\Traits\ImageTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WebsiteSettingController extends Controller
{
    use ImageTrait;

    protected $setting;

    protected $language;

    public function __construct(SettingRepository $setting, LanguageRepository $language)
    {
        $this->setting  = $setting;
        $this->language = $language;
    }

    public function homePage(UserRepository $userRepository, SubjectRepository $subjectRepository, LessonRepository $lessonRepository, CourseRepository $courseRepository): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $sections    = HomeScreen::where('type', 'home_page')->orderBy('position')->get();

            $instructors = $subjects = $lessons = $courses = $featured_courses = [];

            foreach ($sections->whereIn('section', ['instructors', 'subject', 'lesson_with_mentor', 'single_course', 'featured_course']) as $section) {
                if (arrayCheck('ids', $section->contents)) {
                    if ($section->section == 'instructors') {
                        $instructors = array_merge($instructors, $section->contents['ids']);
                    }
                    if ($section->section == 'subject') {
                        $subjects = array_merge($subjects, $section->contents['ids']);
                    }
                    if ($section->section == 'lesson_with_mentor') {
                        $lessons = array_merge($lessons, $section->contents['ids']);
                    }
                    if ($section->section == 'single_course') {
                        $courses = array_merge($courses, $section->contents['ids']);
                    }
                    if ($section->section == 'featured_course') {
                        $featured_courses = array_merge($featured_courses, $section->contents['ids']);
                    }
                }
            }

            $data        = [
                'sections'         => $sections,
                'instructors'      => $userRepository->findUsers(['role_id' => 2, 'ids' => $instructors]),
                'subjects'         => $subjectRepository->activeSubject(['ids' => $subjects]),
                'lessons'          => $lessonRepository->activeLesson(['ids' => $lessons]),
                'courses'          => $courseRepository->findCourses($courses),
                'featured_courses' => $courseRepository->findCourses($featured_courses),
            ];

            return view('backend.admin.website_setting.home_page', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function updateHomePage(Request $request): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $validator = Validator::make($request->all(), [
            'builder' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => __('please_add_at_least_one_section')]);
        }

        DB::beginTransaction();
        try {
            HomeScreen::where('type', 'home_page')->delete();
            $height_1 = $width_1 = $height_2 = $width_2 = null;
            $i        = 1;
            foreach ($request->builder as $key => $builder) {
                $exploded  = explode('_', $key);
                $num       = end($exploded);
                $substring = '_'.$num;
                $section   = is_numeric($num) ? str_replace($substring, '', $key) : $key;
                if ($section == 'become_instructor') {
                    $width_1  = '615';
                    $height_1 = '623';
                }
                if ($section == 'fun_fact') {
                    if (arrayCheck('image1', $builder)) {
                        $width_1  = '266';
                        $height_1 = '250';
                    }
                    if (arrayCheck('image2', $builder)) {
                        $width_2  = '296';
                        $height_2 = '285';
                    }
                }

                if ($section == 'video_slider') {
                    foreach (getArrayValue('links', $builder, []) as $k => $value) {
                        $image                         = $this->getImageWithRecommendedSize($value['media_id'], 1030, 520);
                        $builder['links'][$k]['image'] = $image;
                    }
                }

                $data      = [
                    'type'       => 'home_page',
                    'section'    => $section,
                    'contents'   => $builder,
                    'media_id_1' => arrayCheck('image1', $builder) ? $builder['image1'] : null,
                    'image_1'    => arrayCheck('image1', $builder) ? $this->getImageWithRecommendedSize($builder['image1'], $width_1, $height_1) : '',
                    'media_id_2' => arrayCheck('image2', $builder) ? $builder['image2'] : null,
                    'image_2'    => arrayCheck('image2', $builder) ? $this->getImageWithRecommendedSize($builder['image2'], $width_2, $height_2) : '',
                    'position'   => $i,
                ];
                HomeScreen::create($data);
                $i++;
            }

            DB::commit();
            Toastr::success(__('home_screen_updated_successfully'));

            return response()->json(['success' => __('home_screen_updated_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function deleteHomeSection($id): JsonResponse
    {
        try {
            HomeScreen::destroy($id);

            return response()->json([
                'success' => __('delete_successfully'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function themes(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.website_setting.themes');
    }

    public function updateThemes(Request $request): JsonResponse
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

    public function popup(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.popup', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function savePopupSetting(Request $request): JsonResponse
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
            'popup_title' => 'required',
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

    public function callToAction(Request $request)
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.cta', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveCtaSetting(Request $request): JsonResponse
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
            'cta_title' => 'required',
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

    public function instructorContent(Request $request)
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.become_instructor_section', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveInstructorContent(Request $request): JsonResponse
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
            'become_instructor_title' => 'required',
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

    public function seo(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.seo', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveSeoSetting(Request $request): JsonResponse
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

    public function google(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            return view('backend.admin.website_setting.google_setup');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveGoogleSetup(Request $request): JsonResponse
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
            'tracking_code'      => 'required_if:is_google_analytics_activated,==,1',
            'recaptcha_Site_key' => 'required_if:is_recaptcha_activated,==,1',
            'recaptcha_secret'   => 'required_if:is_recaptcha_activated,==,1',
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

    public function customCss(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            return view('backend.admin.website_setting.custom_css');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function customJs(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            return view('backend.admin.website_setting.custom_js');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveCustomCssAndJs(Request $request): JsonResponse
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

    public function fbPixel(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            return view('backend.admin.website_setting.fb_pixel');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveFbPixel(Request $request): JsonResponse
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
            'facebook_pixel_id' => 'required_if:is_facebook_pixel_activated,==,1',
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

    public function gdpr(Request $request, PageRepository $pageRepository): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'pages'     => $pageRepository->activePages(['lang' => app()->getLocale()]),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.gdpr', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveGdpr(Request $request): JsonResponse
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
            'cookies_agreement' => 'required_if:cookies_status,==,1',
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

    public function themeOptions(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        return view('backend.admin.website_setting.theme_options');
    }

    public function updateThemesOptions(Request $request): JsonResponse
    {
        // dd(json_encode($request->all()));
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

            //            Artisan::call('google-fonts:fetch');

            Artisan::call('storage:link');

            DB::commit();

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

    public function headerFooter(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.website_setting.header_footer');
    }

    public function updateHeaderFooter(Request $request): JsonResponse
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

    public function heroSection(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $languages     = app('languages');

        if ($request->lang) {
            if (App::getLocale() == 1) {
                $lang = 'en';
            } else {
                $lang = App::getLocale();
            }
        } else {
            $lang = App::getLocale();
        }
        $menu_language = headerFooterMenu('header_menu', 'en');
        $active_header = setting('header');

        return view('backend.admin.website_setting.hero_setting.'.$active_header, compact('languages', 'lang', 'menu_language'));
    }

    public function updateHeroSection(Request $request): JsonResponse
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
