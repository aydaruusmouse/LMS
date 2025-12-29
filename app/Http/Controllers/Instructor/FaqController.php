<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Repositories\FaqRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FaqController extends Controller
{
    protected $faq;

    public function __construct(FaqRepository $faq)
    {
        $this->faq = $faq;
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'question' => ['required', Rule::unique('faqs')->where(function ($query) use ($request) {
                $query->where('course_id', $request->course_id);
            })->ignore('id')],
            'answer'   => 'required',
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
            $this->faq->store($request->all());
            Toastr::success(__('create_successful'));
            session()->flash('faq', 1);

            return response()->json([
                'success' => __('create_successful'),
                'route'   => route('instructor.courses.edit', [$request->course_id, 'tab' => 'faq']),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        try {
            $faq  = $this->faq->get($id);
            $data = [
                'html' => view('backend.instructor.course.faq.edit', compact('faq'))->render(),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'question' => ['required', Rule::unique('faqs')->where(function ($query) use ($request, $id) {
                $query->where('course_id', $request->course_id)->where('id', '!=', $id);
            })->ignore('id')],
            'answer'   => 'required',
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
            $this->faq->update($request->all(), $id);
            Toastr::success(__('update_successful'));
            session()->flash('faq', 1);

            return response()->json([
                'success' => __('update_successful'),
                'route'   => route('instructor.courses.edit', [$request->course_id, 'tab' => 'faq']),
            ]);
        } catch (\Exception $e) {
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
            $this->faq->destroy($id);
            Toastr::success(__('delete_successful'));
            $data = [
                'status'  => 'success',
                'message' => __('delete_successful'),
                'title'   => __('success'),
            ];
            session()->flash('faq', 1);

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'status'  => 'danger',
                'message' => $e->getMessage(),
                'title'   => __('error'),
            ];

            return response()->json($data);
        }
    }
}
