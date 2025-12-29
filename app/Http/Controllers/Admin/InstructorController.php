<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\InstructorDataTable;
use App\DataTables\LiveClassDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InstructorRequest;
use App\Models\Role;
use App\Repositories\BookRepository;
use App\Repositories\CourseRepository;
use App\Repositories\ExpertiseRepository;
use App\Repositories\InstructorRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\UserRepository;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    protected $organization;

    protected $user;

    protected $instructor;

    protected $experties;

    protected $course;

    public function __construct(OrganizationRepository $organization, InstructorRepository $instructor, UserRepository $user, ExpertiseRepository $experties, CourseRepository $course)
    {
        $this->organization = $organization;
        $this->user         = $user;
        $this->instructor   = $instructor;
        $this->experties    = $experties;
        $this->course       = $course;
    }

    public function index(InstructorDataTable $dataTable, $org_id = null)
    {
        try {
            $organization = $this->organization->find($org_id);

            $data         = [
                'organization'    => $organization,
                'organization_id' => $org_id,
            ];

            return $dataTable->with('org_id', $org_id)->render('backend.admin.instructor.index', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function create(Request $request, ExpertiseRepository $expertiseRepository): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {

        try {
            $data = [
                'organization_id' => $request->organization_id,
                'expertises'      => $expertiseRepository->activeExpertises(),
            ];

            return view('backend.admin.instructor.create', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function store(InstructorRequest $request): \Illuminate\Http\JsonResponse
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
            $request['permissions'] = $this->setInstructorPermission($request);
            $request['user_type']   = 'instructor';
            $this->instructor->store($request->all());
            DB::commit();
            Toastr::success(__('create_successful'));

            return response()->json([
                'success' => __('create_successful'),
                'route'   => route('instructors.index'),
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function show($id, BookRepository $repository, LiveClassDataTable $dataTable)
    {
        try {
            $user       = $this->user->find($id);
            $books      = [];
            $instructor = $user->instructor;
            $expertises = $this->experties->instructorExperties($instructor->expertises ?: []);
            $followers  = $user->followers;
            $courses    = $this->course->activeCourses([
                'user_id'           => $id,
                'paginate'          => setting('paginate'),
                'instructor_course' => 1,
            ]);
            if (addon_is_activated('book_store')) {
                $books = $repository->activeBooks([
                    'instructor_id' => $id,
                    'paginate'      => setting('paginate'),
                ]);
            }

            $data       = [
                'instructor' => $instructor,
                'user'       => $user,
                'expertises' => $expertises,
                'courses'    => $courses,
                'books'      => $books,
                'followers'  => $followers ? $followers->count()             / 1000 .' K' : 0,
                'followings' => $user->following ? $user->following->count() / 1000 .' K' : 0,
            ];

            return $dataTable->with('user_id', $id)->render('backend.admin.instructor.profile', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function edit(ExpertiseRepository $expertiseRepository, $id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $user = $this->user->find($id);
            $data = [
                'expertises' => $expertiseRepository->activeExpertises(),
                'user'       => $user,
                'instructor' => $user->instructor,
            ];

            return view('backend.admin.instructor.edit', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function update(InstructorRequest $request, $id): \Illuminate\Http\JsonResponse
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
            $request['permissions'] = $this->setInstructorPermission($request);
            $this->instructor->update($request->all(), $id);
            DB::commit();
            Toastr::success(__('update_successful'));

            return response()->json(['success' => __('update_successful'),  'route' => route('instructors.index')]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function setInstructorPermission($request)
    {
        $instructor_default_permission = Role::where('id', 2)->first();
        $permissions                   = [];
        if (arrayCheck('can_edit_profile', $request->permissions)) {
            array_push($permissions, 'instructors.self-edit');
        }
        if (arrayCheck('can_edit_book', $request->permissions)) {
            array_push($permissions, 'books.edit');
        }
        if (arrayCheck('can_edit_organization', $request->permissions)) {
            array_push($permissions, 'organizations.edit');
        }
        if (arrayCheck('can_edit_live_class', $request->permissions)) {
            array_push($permissions, 'livesClasses.edit');
        }
        if (arrayCheck('can_edit_course', $request->permissions)) {
            array_push($permissions, 'courses.edit');
        }
        if (! blank($instructor_default_permission->permissions)) {
            return $all_permission = array_merge($permissions, $instructor_default_permission->permissions);
        } else {
            return $permissions;
        }

    }
}
