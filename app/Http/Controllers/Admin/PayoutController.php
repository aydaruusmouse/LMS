<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PayoutDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PayoutRequest;
use App\Models\Checkout;
use App\Models\Course;
use App\Models\Organization;
use App\Models\User;
use App\Repositories\InstructorPayoutMethodRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\PayoutRepository;
use App\Repositories\UserRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PayoutController extends Controller
{
    protected $payoutRepository;

    public function __construct(PayoutRepository $payoutRepository)
    {
        $this->payoutRepository = $payoutRepository;
    }

    public function index(PayoutDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.payout.index');
    }

    public function create(OrganizationRepository $organization)
    {
        $organizations = $organization->activeOrganization([]);
        $data          = [
            'organizations' => $organizations,
        ];

        return view('backend.admin.payout.create', $data);
    }

    public function paymentMethod()
    {

        return view('backend.admin.payout.payout_method');
    }

    public function instructorPaymentMethod()
    {
        return view('backend.admin.payout.instructor_payout_method');
    }

    public function instructorPaymentMethodUpdate(Request $request, InstructorPayoutMethodRepository $InsPoutRepository)
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
            $user        = User::find(auth()->user()->id);
            $method_info = $InsPoutRepository->getMethodInfo($user->id, $request->payout_method);
            if (blank($method_info)) {
                $request['user_id']       = $user->id;
                $request['payout_method'] = $request->payout_method;
                $request['value']         = $request->value;
                $InsPoutRepository->store($request->all());
            } else {
                $method_info = $InsPoutRepository->update($request->all(), $method_info->id);
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

    public function store(PayoutRequest $request, UserRepository $userRepository): \Illuminate\Http\JsonResponse
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

        $organization = Organization::where('id', $request->organization)->first();
        $org_id       = $organization->id;
        $payout_id    = $this->payoutID($organization);
        try {
            $request['organization_id']  = $organization->id;
            $request['email']            = $organization->email;
            $request['phone_country_id'] = $organization->phone_country_id;
            $request['phone']            = $organization->phone;
            $request['payout_id']        = $payout_id;
            $request['transaction_id']   = Str::random(10);
            $request['user_id']          = auth()->user()->id;

            //available balance check
            $balance                     = $this->OrganizationBalance($organization->id);
            if ($request->amount > $balance) {
                return response()->json(['error' => __('sorry_balance_not_sufficient')]);
            }

            $this->payoutRepository->store($request->all());
            Toastr::success(__('create_successful'));
            DB::commit();

            return response()->json([
                'success' => __('create_successful'),
                'route'   => route('payouts.index'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }

    }

    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $payout  = $this->payoutRepository->find($id);
            $org_id  = $payout->organization_id;
            //available balance check
            $balance = $this->OrganizationBalance($org_id);
            $data    = [
                'payout'  => $payout,
                'balance' => $balance,
            ];

            return view('backend.admin.payout.edit', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function update(PayoutRequest $request, $id): \Illuminate\Http\JsonResponse
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
            $payout  = $this->payoutRepository->find($id);
            $balance = $this->OrganizationBalance($payout->organization_id);
            if ($request->amount > $balance) {
                return response()->json(['error' => __('sorry_balance_not_sufficient')]);
            }
            if ($payout->status == 0) {
                $this->payoutRepository->update($request->all(), $id);
                Toastr::success(__('update_successful'));
                DB::commit();

                return response()->json([
                    'success' => __('update_successful'),
                    'route'   => route('payouts.index'),
                ]);
            } else {
                Toastr::warning(__('update_unsuccessful'));
                $data = [
                    'status'  => 'warning',
                    'message' => __('delete_unsuccessful'),
                    'title'   => __('warning'),
                ];

                return response()->json($data);
            }

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
            $payout = $this->payoutRepository->find($id);
            if ($payout->status == 0) {
                $this->payoutRepository->destroy($id);
                Toastr::success(__('delete_successful'));
                $data = [
                    'status'  => 'success',
                    'message' => __('delete_successful'),
                    'title'   => __('success'),
                ];
            } else {
                Toastr::warning(__('delete_unsuccessful'));
                $data = [
                    'status'  => 'warning',
                    'message' => __('delete_unsuccessful'),
                    'title'   => __('warning'),
                ];
            }

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
            $this->payoutRepository->status($request->all());
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

    public function payoutID($organization)
    {
        try {
            $last_id           = $this->payoutRepository->all()->count();
            $organization_name = substr($organization->org_name, 0, 2);
            $first_name        = auth()->user()->first_name;
            $name              = substr($first_name, 0, 2);

            return $payout_id  = $organization_name.random_int(100, 999).$last_id.$name;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function methodStatus(Request $request, InstructorPayoutMethodRepository $InsPoutRepository): \Illuminate\Http\JsonResponse
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
            if ($InsPoutRepository->find($request['id'])) {
                $InsPoutRepository->status($request->all());
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

    public function defaultMethod(Request $request, InstructorPayoutMethodRepository $InsPoutRepository): \Illuminate\Http\JsonResponse
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
            if ($InsPoutRepository->find($request['id'])) {
                $InsPoutRepository->setDefault($request->all());
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

    public function balanceCheck(Request $request)
    {
        $organization = Organization::where('id', $request->organization)->first();
        $id           = $organization->id;
        try {
            $amount = Checkout::whereHas('enrolls', function ($query) use ($id) {
                $query->whereHasMorph('enrollable', [Course::class], function ($query) use ($id) {
                    $query->where('organization_id', $id);
                });
            })->sum('payable_amount');

            $data   = [
                'status'  => 'success',
                'message' => __('balance_found'),
                'amount'  => __('available_balance').get_price($amount, userCurrency()),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function OrganizationBalance($id)
    {
        try {
            $balance = Checkout::whereHas('enrolls', function ($query) use ($id) {
                $query->whereHasMorph('enrollable', [Course::class], function ($query) use ($id) {
                    $query->where('organization_id', $id);
                });
            })->sum('payable_amount');

            return $balance;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function paymentComplete($id): \Illuminate\Http\JsonResponse
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
            $payout = $this->payoutRepository->find($id);
            $status = 2;
            $this->payoutRepository->statusUpdate($payout->id, $status);
            Toastr::success(__('complete_successful'));
            $data   = [
                'status'    => 'success',
                'message'   => __('complete_successful'),
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

    public function paymentApproved($id): \Illuminate\Http\JsonResponse
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
            $payout = $this->payoutRepository->find($id);
            $status = 1;
            $this->payoutRepository->statusUpdate($payout->id, $status);
            Toastr::success(__('approved_successful'));
            $data   = [
                'status'    => 'success',
                'message'   => __('approved_successful'),
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

    public function paymentDecline($id): \Illuminate\Http\JsonResponse
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
            $payout = $this->payoutRepository->find($id);
            $status = 3;
            $this->payoutRepository->statusUpdate($payout->id, $status);
            Toastr::success(__('decline_successful'));
            $data   = [
                'status'    => 'success',
                'message'   => __('decline_successful'),
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
}
