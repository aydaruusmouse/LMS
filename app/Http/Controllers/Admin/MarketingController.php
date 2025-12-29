<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Traits\SmsSenderTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    use SmsSenderTrait;

    public function bulkSMS(RoleRepository $repository): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $data = [
                'roles' => $repository->activeRoles(),
            ];

            return view('backend.admin.marketing.bulk_sms', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function sendBulkSms(Request $request, UserRepository $userRepository): \Illuminate\Http\JsonResponse
    {
        if (! setting('active_sms_provider')) {
            return response()->json([
                'status' => 'error',
                'error'  => __('no_sms_provider_found'),
            ]);
        }
        $request->validate([
            'message'  => 'required',
            'role_ids' => 'required',
        ]);

        try {
            $users         = $userRepository->findUsers([
                'role_id' => $request['role_ids'],
            ]);
            $phone_numbers = $users->pluck('phone')->toArray();
            if (count($phone_numbers) == 0) {
                return response()->json([
                    'status' => 'error',
                    'error'  => __('no_phone_found'),
                ]);
            }

            try {
                $this->send($phone_numbers, $request->message);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'error'  => $e->getMessage(),
                ]);
            }
            Toastr::success(__('sms_sent_successfully'));

            return response()->json([
                'status'  => 'success',
                'success' => __('sms_sent_successfully'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'error'  => $e->getMessage(),
            ]);
        }
    }
}
