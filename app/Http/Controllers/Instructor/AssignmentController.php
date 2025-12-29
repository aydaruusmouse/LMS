<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Repositories\AssignmentRepository;
use App\Repositories\UserRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AssignmentController extends Controller
{
    protected $assignment;

    public function __construct(AssignmentRepository $assignment)
    {
        $this->assignment = $assignment;
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'title'         => ['required', Rule::unique('assignments')->where(function ($query) use ($request) {
                $query->where('course_id', $request->course_id);
            })->ignore('id')],
            'deadline'      => 'required',
            'instructor_id' => 'required',
            'total_marks'   => 'required',
            'pass_marks'    => 'required',
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
            $this->assignment->store($request->all());
            Toastr::success(__('create_successful'));

            return response()->json([
                'success' => __('create_successful'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        try {
            $user       = new UserRepository();
            $assignment = $this->assignment->find($id);
            $course     = $assignment->course;

            $data       = [
                'assignment'  => $assignment,
                'sections'    => $course->sections,
                'lesson'      => $assignment->lesson,
                'instructors' => $user->findUsers([
                    'organization_id' => $course->organization_id,
                ]),
            ];

            $data       = [
                'html' => view('backend.instructor.course.assignment.edit', $data)->render(),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'title'         => ['required', Rule::unique('assignments')->where(function ($query) use ($request, $id) {
                $query->where('course_id', $request->course_id)->where('id', '!=', $id);
            })->ignore('id')],
            'deadline'      => 'required',
            'instructor_id' => 'required',
            'total_marks'   => 'required',
            'pass_marks'    => 'required',
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
            $this->assignment->update($request->all(), $id);

            Toastr::success(__('update_successful'));

            return response()->json([
                'success' => __('update_successful'),
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
            $this->assignment->destroy($id);

            Toastr::success(__('delete_successful'));
            $data = [
                'status'  => 'success',
                'message' => __('delete_successful'),
                'title'   => __('success'),
            ];

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
