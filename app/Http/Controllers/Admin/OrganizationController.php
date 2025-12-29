<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrganizationDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrganizationRequest;
use App\Models\Checkout;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Payout;
use App\Models\User;
use App\Repositories\CategoryRepository;
use App\Repositories\CountryRepository;
use App\Repositories\OrganizationPayoutMethodRepository;
use App\Repositories\OrganizationRepository;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    protected $organization;

    protected $country;

    protected $category;

    public function __construct(OrganizationRepository $organization, CountryRepository $country, CategoryRepository $category)
    {
        $this->organization = $organization;
        $this->country      = $country;
        $this->category     = $category;
    }

    public function index(OrganizationDataTable $dataTable)
    {
        try {
            $data = [
                'organizations'          => $this->organization->organizationStatus(),
                'approved_organizations' => $this->organization->organizationStatus(1),
                'suspend_organizations'  => $this->organization->organizationStatus(2),
                'inactive_organizations' => $this->organization->organizationStatus('0'),
            ];

            return $dataTable->render('backend.admin.organization.all-organization', $data);

        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function create()
    {
        try {
            $countries = $this->country->all();
            $data      = [
                'countries' => $countries,
            ];

            return view('backend.admin.organization.add-organizaion', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function store(OrganizationRequest $request): \Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            Toastr::info(__('this_function_is_disabled_in_demo_server'));

            return back();
        }
        try {
            $this->organization->store($request->all());
            Toastr::success(__('create_successful'));

            return redirect()->route('organizations.index');
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back()->withInput();
        }
    }

    public function show($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $organization = $this->organization->find($id); //total student number for this organizaion

            $data         = [
                'organization'     => $organization,
                'total_student'    => User::whereHas('checkout', function ($query) use ($id) {
                    $query->whereHas('enrolls', function ($query) use ($id) {
                        $query->whereHasMorph('enrollable', [Course::class], function ($query) use ($id) {
                            $query->where('organization_id', $id);
                        });
                    });
                })->count(),
                'total_enrolls'    => Enroll::whereHasMorph('enrollable', [Course::class], function ($query) use ($id) {
                    $query->where('organization_id', $id);
                })->count(),
                'total_course'     => $organization->courses()->count(),
                'total_instructor' => $organization->instructors()->count(),
            ];

            return view('backend.admin.organization.details-organization', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $countries    = $this->country->all();
            $organization = $this->organization->find($id);
            $data         = [
                'countries'    => $countries,
                'organization' => $organization,
            ];

            return view('backend.admin.organization.edit-organization', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function update(OrganizationRequest $request, $id)
    {
        if (config('app.demo_mode')) {
            Toastr::info(__('this_function_is_disabled_in_demo_server'));

            return back();
        }
        try {
            $this->organization->update($request->all(), $id);
            Toastr::success(__('update_successful'));

            return redirect()->route('organizations.index');
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        //
    }

    public function delete($id): \Illuminate\Http\JsonResponse
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
            $this->organization->delete($id);

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
                'title'   => 'error',
            ];

            return response()->json($data);
        }
    }

    public function overview($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $organization = $this->organization->find($id);

            $data         = [
                'organization'          => $organization,
                'total_earning'         => Checkout::whereHas('enrolls', function ($query) use ($id) {
                    $query->whereHasMorph('enrollable', [Course::class], function ($query) use ($id) {
                        $query->where('organization_id', $id);
                    });
                })->sum('payable_amount'),
                'total_withdraw_amount' => Payout::where('organization_id', $id)->where('status', '=', 1)->sum('amount'),
                'total_course'          => $organization->courses()->count(),
                'total_instructor'      => $organization->instructors()->count(),
                'total_student'         => User::whereHas('checkout', function ($query) use ($id) {
                    $query->whereHas('enrolls', function ($query) use ($id) {
                        $query->whereHasMorph('enrollable', [Course::class], function ($query) use ($id) {
                            $query->where('organization_id', $id);
                        });
                    });
                })->count(),
                'total_enrolls'         => Enroll::whereHasMorph('enrollable', [Course::class], function ($query) use ($id) {
                    $query->where('organization_id', $id);
                })->count(),
            ];

            return view('backend.admin.organization.overview', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function payment($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $organization = $this->organization->find($id);
            $data         = [
                'organization' => $organization,
            ];

            return view('backend.admin.organization.payout.payout_method', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function settings($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $countries    = $this->country->all();
            $organization = $this->organization->find($id);
            $data         = [
                'countries'    => $countries,
                'organization' => $organization,
            ];

            return view('backend.admin.organization.setting', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
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
            $this->organization->statusChange($request->all());
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
                'title'   => 'error',
            ];

            return response()->json($data);
        }
    }

    public function paymentMethodUpdate(Request $request, OrganizationPayoutMethodRepository $payoutRepository)
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
            $method_info = $payoutRepository->getMethodInfo($request->organization_id, $request->payout_method);
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

    public function methodStatus(Request $request, OrganizationPayoutMethodRepository $payoutRepository): \Illuminate\Http\JsonResponse
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

    public function defaultMethod(Request $request, OrganizationPayoutMethodRepository $payoutRepository): \Illuminate\Http\JsonResponse
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
