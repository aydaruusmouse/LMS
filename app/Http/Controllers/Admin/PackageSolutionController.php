<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserSubscribeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PackageSolutionRequest;
use App\Repositories\PackageSolutionRepository;
use App\Repositories\UserSubscriptionRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PackageSolutionController extends Controller
{
    protected $packageSolutionRepository;

    public function __construct(PackageSolutionRepository $packageSolutionRepository)
    {
        $this->packageSolutionRepository = $packageSolutionRepository;
    }

    public function index(UserSubscriptionRepository $subscriptionRepository)
    {
        $packages        = $this->packageSolutionRepository->all();
        $most_popular_id = $subscriptionRepository->mostPopular();
        $most_popular_id = ($most_popular_id != null) ? $most_popular_id->package_solutions_id : 0;
        $data            = [
            'packages'        => $packages,
            'most_popular_id' => $most_popular_id,
        ];
        if (Auth::user()->role_id == 1) {
            return view('backend.admin.package_solution.index', $data);
        } elseif (Auth::user()->role_id == 2) {
            return view('backend.admin.package_solution.instructor_package', $data);
        }
    }

    public function store(PackageSolutionRequest $request): \Illuminate\Http\JsonResponse
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
            $this->packageSolutionRepository->store($request->all());
            Toastr::success(__('create_successful'));
            DB::commit();

            return response()->json([
                'success' => __('create_successful'),
                'route'   => route('packages.index'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }

    }

    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $package = $this->packageSolutionRepository->find($id);
            $data    = [
                'package' => $package,
            ];

            return view('backend.admin.package_solution.edit', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function update(PackageSolutionRequest $request, $id): \Illuminate\Http\JsonResponse
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
            $this->packageSolutionRepository->update($request->all(), $id);
            Toastr::success(__('update_successful'));
            DB::commit();

            return response()->json([
                'success' => __('update_successful'),
                'route'   => route('packages.index'),
            ]);
        } catch (\Exception $e) {
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
            $this->packageSolutionRepository->destroy($id);
            Toastr::success(__('delete_successful'));
            $data = [
                'status'    => 'success',
                'message'   => __('delete_successful'),
                'title'     => __('success'),
                'is_reload' => true,
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
            $this->packageSolutionRepository->status($request->all());
            $data = [
                'status'  => 200,
                'message' => __('update_successful'),
                'title'   => 'success',
            ];

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

    public function PackageSubscribe($id, UserSubscriptionRepository $subscriptionRepository): \Illuminate\Http\JsonResponse
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
            $package                         = $this->packageSolutionRepository->find($id);
            $user_subscribe                  = $subscriptionRepository->getUserSubscription(auth()->user()->id);
            $request['user_id']              = auth()->user()->id;
            $request['package_solutions_id'] = $package->id;
            $request['price']                = $package->price;
            $request['validity']             = $package->validity;
            $request['upload_limit']         = $package->upload_limit;
            $request['add_limit']            = $package->add_limit;
            $request['bundle']               = $package->bundle;
            $request['facilities']           = $package->facilities;
            if (! empty($user_subscribe)) {
                $request['validity'] = ($user_subscribe->validity + $package->validity);
                $subscriptionRepository->update(auth()->user()->id, $request);
            } else {
                $subscriptionRepository->store($request);
            }

            Toastr::success(__('subscription_successful'));
            $data                            = [
                'status'    => 'success',
                'message'   => __('subscription_successful'),
                'title'     => __('success'),
                'is_reload' => true,
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

    public function PackageSubscribeList(UserSubscribeDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.package_subscription.index');
    }
}
