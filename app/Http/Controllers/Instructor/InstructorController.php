<?php

namespace App\Http\Controllers\Instructor;

use App\DataTables\Instructor\InstructorDataTable;
use App\DataTables\Instructor\LiveClassDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\InstructorRequest;
use App\Models\Role;
use App\Repositories\BookRepository;
use App\Repositories\CourseRepository;
use App\Repositories\ExpertiseRepository;
use App\Repositories\InstructorPayoutMethodRepository;
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
            $user         = $this->user->find(auth()->user()->role_id);
            $organization = $this->organization->find($user->instructor->organization_id);

            $data         = [
                'organization'    => $organization,
                'organization_id' => $org_id,
            ];

            return $dataTable->with('org_id', $user->instructor->organization_id)->render('backend.instructor.instructor.index', $data);
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

            return view('backend.instructor.instructor.create', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function store(InstructorRequest $request, UserRepository $userRepository): \Illuminate\Http\JsonResponse
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
        $user = $userRepository->find(auth()->user()->id);
        try {
            $request['permissions']     = $this->setInstructorPermission($request);
            $request['organization_id'] = $user->instructor->organization_id;
            $this->instructor->store($request->all());
            DB::commit();
            Toastr::success(__('create_successful'));

            return response()->json([
                'success' => __('create_successful'),
                'route'   => route('instructor.instructors.index'),
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
            $instructor = $user->instructor;
            $expertises = $this->experties->instructorExperties($instructor->expertises ?: []);
            $followers  = $user->followers;
            $courses    = $this->course->activeCourses([
                'user_id'           => $id,
                'paginate'          => setting('paginate'),
                'instructor_course' => 1,
            ]);
            $books      = $repository->activeBooks([
                'instructor_id' => $id,
                'paginate'      => setting('paginate'),
            ]);

            $data       = [
                'instructor' => $instructor,
                'user'       => $user,
                'expertises' => $expertises,
                'courses'    => $courses,
                'books'      => $books,
                'followers'  => $followers ? $followers->count()             / 1000 .' K' : 0,
                'followings' => $user->following ? $user->following->count() / 1000 .' K' : 0,
            ];

            return $dataTable->with('user_id', $id)->render('backend.instructor.instructor.profile', $data);
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

            return view('backend.instructor.instructor.edit', $data);
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
            if ($id == auth()->user()->id) {
                if (! hasPermission('instructors.self-edit')) {
                    return response()->json(['error' => __('permission_not_allowed')]);
                }
            } elseif (! hasPermission('instructors.edit')) {
                return response()->json(['error' => __('permission_not_allowed')]);
            }
            $request['permissions'] = $this->setInstructorPermission($request);
            $this->instructor->update($request->all(), $id);
            DB::commit();
            Toastr::success(__('update_successful'));

            return response()->json(['success' => __('update_successful'),  'route' => route('instructor.instructors.index')]);
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

    public function payout(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {

        try {
            $id   = auth()->user()->id;
            $user = $this->user->find($id);
            $data = [
                'instructor' => $user->instructor,
            ];

            return view('backend.instructor.payout.payout_method', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function paymentMethodUpdate(Request $request, InstructorPayoutMethodRepository $payoutRepository)
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
            $method_info = $payoutRepository->getMethodInfo($request->instructor_id, $request->payout_method);
            if (blank($method_info)) {
                $payoutRepository->store($request->all());
            } else {
                $method_info = $payoutRepository->update($request->all(), $method_info->id);
            }
            Toastr::success(__('update_successful'));

            return response()->json([
                'success' => __('update_successful'),
                'reload'  => true,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }

    }

    public function methodStatus(Request $request, InstructorPayoutMethodRepository $payoutRepository): \Illuminate\Http\JsonResponse
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
            if ($payoutRepository->find($request['id'])) {
                $payoutRepository->status($request->all());
                $data = [
                    'status'  => 'success',
                    'message' => __('update_successful'),
                    'title'   => 'success',
                ];
            } else {
                $data = [
                    'status'  => 400,
                    'message' => __('please_set_credential_first'),
                    'title'   => 'success',
                ];
            }

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'status'  => 400,
                'message' => $e->getMessage(),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
    }

    public function defaultMethod(Request $request, InstructorPayoutMethodRepository $payoutRepository): \Illuminate\Http\JsonResponse
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
            if ($payoutRepository->find($request['id'])) {
                $payoutRepository->setDefault($request->all());
                $data = [
                    'status'  => 'success',
                    'message' => __('update_successful'),
                    'title'   => 'success',
                    'reload'  => true,
                ];
            } else {
                $data = [
                    'status'  => 400,
                    'message' => __('please_set_credential_first'),
                    'title'   => 'success',
                ];
            }

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'status'  => 400,
                'message' => $e->getMessage(),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
    }
}
