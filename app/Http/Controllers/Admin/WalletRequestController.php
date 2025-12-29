<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\WalletDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\WalletRepository;
use App\Traits\SendNotification;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class WalletRequestController extends Controller
{
    use SendNotification;

    public $wallet;

    public function __construct(WalletRepository $wallet)
    {
        $this->wallet = $wallet;
    }

    public function index(WalletDataTable $dataTable)
    {
        try {
            return $dataTable->render('backend.admin.wallet.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function changeStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            return response()->json([
                'message' => __('This function is disabled in demo server.'),
                'type'    => __('Error').' !',
                'class'   => 'danger',
            ]);
        }
        try {
            $wallet  = $this->wallet->changeStatus($request->all());

            if ($request->status == 1) {
                $msg = __('wallet_request_approved');
            } else {
                $msg = __('wallet_request_rejected');
            }

            Toastr::success($msg);

            $data    = [
                'status'  => 'success',
                'message' => $msg,
                'title'   => __('success'),
            ];

            $status  = $request->status == 1 ? 'approved' : 'rejected';

            $details = __('wallet_request_notification', ['status' => $status, 'amount' => $wallet->amount, 'trx_id' => $wallet->trx_id]);

            $this->sendNotification($wallet->user, $details, 'success', url('wallet'), '');

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
