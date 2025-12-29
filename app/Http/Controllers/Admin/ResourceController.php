<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Resource;
use App\Repositories\ResourceRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResourceController extends Controller
{
    protected $resource;

    public function __construct(ResourceRepository $resource)
    {
        $this->resource = $resource;
    }

    public function store(Request $request)
    {

        $request->validate([
            'course_id' => 'required',
            'title'     => 'required',
            'file'      => 'required|string',
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
            $this->resource->store($request);
            Toastr::success(__('create_successful'));

            if (! $request->ajax()) {
                return back();
            }

            return view('backend.admin.course.resource_list', [
                'course'    => Course::find($request->course_id),
                'resources' => Resource::where('course_id', $request->course_id)->get(),
            ]);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        try {
            $lesson = $this->resource->find($id);

            $data   = [
                'html' => view('backend.admin.course.lesson.edit', compact('lesson'))->render(),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'title'       => ['required', Rule::unique('lessons')->where(function ($query) use ($request, $id) {
                $query->where('section_id', $request->section_id)->where('id', '!=', $id);
            })->ignore('id')],
            'source_data' => 'required',
            'duration'    => 'required_if:lesson_type,==,video|required_if:lesson_type,==,audio',
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
            $this->resource->update($request->all(), $id);
            Toastr::success(__('update_successful'));

            return response()->json([
                'success' => __('update_successful'),
                'route'   => route('courses.edit', [$request->course_id, 'tab' => 'curriculum']),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        if (config('app.demo_mode')) {
            $data = [
                'status'  => 'danger',
                'message' => __('this_function_is_disabled_in_demo_server'),
                'title'   => 'error',
            ];
        }
        try {

            $this->resource->destroy($id);

            Toastr::success(__('delete_successful'));

            $data = [
                'status'  => 'success',
                'message' => __('delete_successful'),
                'title'   => __('success'),
            ];

            return view('backend.admin.course.resource_list', [
                'course'    => Course::find($request->course_id),
                'resources' => Resource::where('course_id', $request->course_id)->get(),
            ]);
        } catch (\Exception $e) {
            $data = [
                'status'  => 'danger',
                'message' => $e->getMessage(),
                'title'   => __('error'),
            ];

            return response()->json($data);
        }
    }

    public function lessonOrder(Request $request)
    {
        try {
            $this->resource->lessonsOrder($request->all());
            Toastr::success(__('create_successful'));

            return response()->json([
                'success' => __('create_successful'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function download($id)
    {
        $resource  = Resource::findOrFail($id);

        $file_path = public_path($resource->source);

        $extension = explode('.', $file_path)[1];

        return response()->download($file_path, $resource->slug.".$extension");
    }
}
