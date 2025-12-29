<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AssignmentDataTable;
use App\DataTables\CourseDataTable;
use App\DataTables\StudentDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseRequest;
use App\Models\LiveClass;
use App\Models\Resource;
use App\Repositories\CategoryRepository;
use App\Repositories\CourseRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\LevelRepository;
use App\Repositories\LiveClassRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\TagRepository;
use App\Repositories\UserRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $organization;

    protected $course;

    protected $liveClass;

    protected $category;

    protected $user;

    public function __construct(OrganizationRepository $organization, CourseRepository $course, CategoryRepository $category, UserRepository $user, LiveClassRepository $liveclass)
    {
        $this->organization = $organization;
        $this->user         = $user;
        $this->category     = $category;
        $this->course       = $course;
        $this->liveClass    = $liveclass;
    }

    public function index(CourseDataTable $dataTable, Request $request, $org_id = null)
    {
        try {

            $organization  = $this->organization->find($org_id ?? $request->organization_id);

            $instructor    = $request->organization_id ? $this->user->findUsers([
                'organization_id' => $request->organization_id,
            ]) : [];

            $categories    = $request->category_ids ? $this->category->activeCategories([
                'ids'  => $request->category_ids,
                'type' => 'course',
            ]) : [];

            $data          = [
                'organization'    => $organization,
                'instructors'     => $instructor,
                'categories'      => $categories,
                'status'          => $request->status,
                'organization_id' => $request->organization_id,
                'instructor_ids'  => $request->instructor_ids,
            ];

            $filtered_data = [
                'instructor_ids' => $request->instructor_ids,
                'category_ids'   => $request->category_ids,
                'org_id'         => $org_id ?? $request->organization_id,
                'status'         => $request->status,
            ];

            return $dataTable->with($filtered_data)->render('backend.admin.course.index', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back()->withInput();
        }
    }

    public function create(LanguageRepository $languageRepository, LevelRepository $levelRepository, TagRepository $tagRepository, SubjectRepository $subjectRepository): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $data = [
                'languages'    => $languageRepository->activeLanguage(),
                'levels'       => $levelRepository->activeLevels(),
                'tags'         => $tagRepository->activeTags(),
                'category'     => $this->category->find(old('category_id')),
                'subject'      => $subjectRepository->find(old('subject_id')),
                'organization' => $this->organization->find(old('organization_id')),
                'instructors'  => old('organization_id') ? $this->user->findUsers([
                    'organization_id' => old('organization_id'),
                ]) : [],
            ];

            return view('backend.admin.course.create', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function store(CourseRequest $request): \Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            Toastr::info(__('this_function_is_disabled_in_demo_server'));

            return back();
        }
        try {
            $this->course->store($request->all());

            Toastr::success(__('create_successful'));

            return redirect()->route('courses.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back()->withInput();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id, LanguageRepository $languageRepository, LevelRepository $levelRepository, TagRepository $tagRepository, SubjectRepository $subjectRepository, AssignmentDataTable $dataTable, Request $request)
    {
        try {

            $course = $this->course->find($id);

            $data   = [
                'sections'     => $course->sections,
                'lessons'      => $course->lessons,
                'resources'    => Resource::where('course_id', $course->id)->get(),
                'faqs'         => $course->faqs,
                'languages'    => $languageRepository->activeLanguage(),
                'levels'       => $levelRepository->activeLevels(),
                'tags'         => $tagRepository->activeTags(),
                'category'     => $this->category->find(old('category_id', $course->category_id)),
                'subject'      => old('subject_id', $course->subject_id) ? $subjectRepository->find(old('subject_id', $course->subject_id)) : $subjectRepository->find(old('subject_id')),
                'organization' => $this->organization->find(old('organization_id', $course->organization_id)),
                'course'       => $course,
                'liveClass'    => LiveClass::where('course_id', $id)->first(),
                'request_tab'  => $request['tab'] ? $request['tab'] : 'basic',
                'instructors'  => old('organization_id', $course->organization_id) ? $this->user->findUsers([
                    'organization_id' => old('organization_id', $course->organization_id),
                ]) : [],
            ];

            return $dataTable->with('course_id', $id)->render('backend.admin.course.edit', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function update(CourseRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            Toastr::info(__('this_function_is_disabled_in_demo_server'));

            return back();
        }
        try {
            $this->course->update($request->all(), $id);

            if ($request->course_type == 'live_class') {
                $liveClass = LiveClass::where('course_id', $id)->first();
                if ($liveClass) {
                    $this->liveClass->update($request->all(), $id);
                } else {
                    $this->liveClass->store($request->all(), $id);
                }
            }

            Toastr::success(__('update_successful'));

            return redirect()->route('courses.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back()->withInput();
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
            $this->course->update([
                'deleted_at' => now(),
            ], $id);

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
                'title'   => 'error',
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
            $course                 = $this->course->find($request->id);
            $request['category_id'] = $course->category_id;
            $request['title']       = $course->title;
            $this->course->update($request->all(), $request->id);
            $data                   = [
                'status'  => 'success',
                'message' => __('update_successful'),
                'title'   => 'success',
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'status'  => 'danger',
                'message' => $e->getMessage(),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
    }

    public function published(Request $request): \Illuminate\Http\JsonResponse
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

            $this->course->published($request->id);

            $data = [
                'status'  => 'success',
                'message' => __('update_successful'),
                'title'   => 'success',
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'status'  => 'danger',
                'message' => $e->getMessage(),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
    }

    public function students($id, StudentDataTable $dataTable)
    {
        try {
            $data = [
                'id' => $id,
            ];

            return $dataTable->with($data)->render('backend.admin.student.index', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }
}
