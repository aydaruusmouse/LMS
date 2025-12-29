<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\StaffDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StaffRequest;
use App\Models\Country;
use App\Models\Permission;
use App\Repositories\Admin\StaffRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    protected $staff;

    protected $role;

    protected $permission;

    protected $user;

    public function __construct(StaffRepository $staff, RoleRepository $role, PermissionRepository $permission, UserRepository $user)
    {
        $this->staff      = $staff;
        $this->role       = $role;
        $this->permission = $permission;
        $this->user       = $user;
    }

    public function index(StaffDataTable $staffDataTable)
    {
        return $staffDataTable->render('backend.admin.staff.all-staff');
    }

    public function create(): View|Factory|RedirectResponse|Application
    {
        try {
            $permissions = $this->permission->all();
            $countries   = Country::all();
            $roles       = $this->role->staffRoll();
            $data        = [
                'permissions' => $permissions,
                'countries'   => $countries,
                'roles'       => $roles,
            ];

            return view('backend.admin.staff.add-staff', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function changeRole(Request $request): string
    {
        $role_permissions = $this->role->get($request->role_id)->permissions;
        $permissions      = $this->permission->all();

        return view('backend.admin.staff.permissions', compact('permissions', 'role_permissions'))->render();
    }

    public function store(StaffRequest $request): \Illuminate\Http\JsonResponse
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
            $this->staff->store($request->all());
            Toastr::success(__('create_successful'));

            return response()->json([
                'success' => __('create_successful'),
                'route'   => route('staffs.index'),
            ]);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id): View|Factory|RedirectResponse|Application
    {
        try {
            $permissions = Permission::all();
            $countries   = Country::all();
            $roles       = $this->role->staffRoll();
            $staff       = $this->staff->edit($id);
            $data        = [
                'permissions' => $permissions,
                'countries'   => $countries,
                'roles'       => $roles,
                'staff'       => $staff,
            ];

            return view('backend.admin.staff.edit-staff', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
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
            $this->staff->update($request->all(), $id);
            Toastr::success(__('update_successful'));

            return response()->json([
                'success' => __('update_successful'),
                //                'route'   => route('staffs.index'),
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        //
    }

    public function statusChange(Request $request): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status'  => 400,
                'message' => __('this_function_is_disabled_in_demo_server'),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
        try {
            $this->user->statusChange($request->all());
            $data = [
                'status'  => 200,
                'message' => __('update_successful'),
                'title'   => 'success',
            ];

            return response()->json($data);
        } catch (Exception $e) {
            $data = [
                'status'  => 400,
                'message' => $e->getMessage(),
                'title'   => 'danger',
            ];

            return response()->json($data);
        }
    }

    public function StaffVerified($id): RedirectResponse
    {
        if (config('app.demo_mode')) {
            Toastr::info(__('this_function_is_disabled_in_demo_server'));

            return back();
        }
        try {
            $response = $this->user->userVerified($id);
            Toastr::success(__($response['message']));

            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return redirect()->back();
        }
    }

    public function StaffBanned($id): RedirectResponse
    {
        if (config('app.demo_mode')) {
            Toastr::info(__('this_function_is_disabled_in_demo_server'));

            return back();
        }
        try {
            $response = $this->user->userBan($id);
            Toastr::success(__($response['message']));

            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return redirect()->back();
        }
    }

    public function staffDelete($id): \Illuminate\Http\JsonResponse|RedirectResponse
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
            $response = $this->user->userDelete($id);

            $data     = [
                'status'  => 'success',
                'message' => __($response['message']),
                'title'   => 'success',
            ];

            return response()->json($data);
        } catch (Exception $e) {
            $data = [
                'status'  => 'danger',
                'message' => $e->getMessage(),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
    }
}
