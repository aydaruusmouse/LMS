<?php

namespace App\Http\Controllers\Admin\MobileAppSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Repositories\BookRepository;
use App\Repositories\CourseRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\SliderRepository;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    protected $slider;

    protected $book;

    protected $course;

    public function __construct(SliderRepository $slider, BookRepository $book, CourseRepository $course)
    {
        $this->slider = $slider;
        $this->book   = $book;
        $this->course = $course;
    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $sliders = $this->slider->all();
            $data    = [
                'sliders' => $sliders,
                'sl'      => 1,
            ];

            return view('backend.admin.mobile-app.slider.all-slider', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $data = [
                'books' => addon_is_activated('book_store') ? $this->book->all() : [],
            ];

            return view('backend.admin.mobile-app.slider.create-slider', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function store(SliderRequest $request): \Illuminate\Http\JsonResponse
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
            DB::beginTransaction();
            $this->slider->store($request->all());
            Toastr::success(__('create_successful'));

            DB::commit();

            return response()->json([
                'success' => __('create_successful'),
                'route'   => route('sliders.index'),
            ]);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function edit($id, LanguageRepository $language, Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $lang            = $request->lang ?? app()->getLocale();
            $slider          = $this->slider->get($id);
            $slider_language = $this->slider->getByLang($id, $lang);
            if (is_array($slider_language)) {
                $slider_language['title']     = $slider->title;
                $slider_language['sub_title'] = $slider->sub_title;
                $slider_language['btn_text']  = $slider->btn_text;
            } else {
                $slider_language = $slider_language->toArray();
            }

            $data            = [
                'slider'          => $slider,
                'books'           => addon_is_activated('book_store') ? $this->book->all() : [],
                'languages'       => $language->all(),
                'lang'            => $lang,
                'slider_language' => $slider_language,
            ];

            return view('backend.admin.mobile-app.slider.edit-slider', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function update(SliderRequest $request, $id): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
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
            DB::beginTransaction();
            $this->slider->update($request->all(), $id);
            Toastr::success(__('update_successful'));
            DB::commit();

            return response()->json([
                'success' => __('update_successful'),
                'route'   => route('sliders.index'),
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status'  => 'danger',
                'message' => __('this_function_is_disabled_in_demo_server'),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
        try {
            $this->slider->destroy($id);
            $data = [
                'status'  => 'success',
                'message' => __('delete_successful'),
                'title'   => __('success'),
            ];

            return response()->json($data);
        } catch (Exception $e) {
            $data = [
                'status'  => 'danger',
                'message' => $e->getMessage(),
                'title'   => __('error'),
            ];

            return response()->json($data);
        }
    }

    public function statusChange(Request $request): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status'  => 'danger',
                'message' => __('this_function_is_disabled_in_demo_server'),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
        try {
            $this->slider->statusChange($request->all());
            $data = [
                'status'  => 'success',
                'message' => __('update_successful'),
                'title'   => __('success'),
            ];

            return response()->json($data);
        } catch (Exception $e) {
            $data = [
                'status'  => 'danger',
                'message' => $e->getMessage(),
                'title'   => __('error'),
            ];

            return response()->json($data);
        }
    }
}
