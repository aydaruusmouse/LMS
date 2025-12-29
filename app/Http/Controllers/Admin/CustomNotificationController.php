<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CustomNotificationDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\CustomNotificationRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CustomNotificationController extends Controller
{
    protected $notification;

    public function __construct(CustomNotificationRepository $notification)
    {
        $this->notification = $notification;
    }

    public function index(CustomNotificationDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.custom_notification.index');
    }

    public function create(RoleRepository $repository): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $data = [
            'roles' => $repository->activeRoles(),
        ];

        return view('backend.admin.custom_notification.create', $data);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
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
            'title'       => 'required',
            'description' => 'required',
            'role_ids'    => 'required',
        ]);

        try {
            $this->notification->store($request->all());

            Toastr::success(__('create_successful'));

            return response()->json([
                'success' => __('create_successful'),
                'route'   => route('custom-notification.index'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function edit($id, UserRepository $userRepository): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $notification = $this->notification->find($id);

            $data         = [
                'notification' => $notification,
                'users'        => $userRepository->findUsers([
                    'ids'       => $notification->user_ids,
                    'onesignal' => 1,
                ]),
            ];

            return view('backend.admin.custom_notification.edit', $data);
        } catch (\Exception $e) {
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
                'title'  => __('error'),
            ];

            return response()->json($data);
        }

        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'user_ids'    => 'required',
        ]);

        try {
            if (! setting('onesignal_rest_api_key') || ! setting('onesignal_app_id')) {
                return response()->json([
                    'error'  => __('configure_onesignal'),
                    'status' => 'danger',
                    'title'  => __('error'),
                ]);
            }
            $this->notification->update($request->all(), $id);
            Toastr::success(__('update_successful'));

            return response()->json([
                'success' => __('update_successful'),
                'route'   => route('custom-notification.index'),
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
            $this->notification->destroy($id);
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
