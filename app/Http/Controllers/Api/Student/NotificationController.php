<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\NotificationResource;
use App\Repositories\NotificationRepository;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    use ApiReturnFormatTrait;

    public function __construct(NotificationRepository $notification)
    {
        $this->notification = $notification;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            $notifications = $this->notification->all([
                'user_id'  => jwtUser()->id,
                'paginate' => setting('api_paginate'),
            ]);

            return $this->responseWithSuccess(__('notifications_fetched_successfully'), NotificationResource::collection($notifications));
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'ids' => 'required',
        ]);
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }

        if (is_array($request->ids)) {
            $ids = $request->ids;
        } else {
            $ids[] = $request->ids;
        }

        try {
            $this->notification->delete($ids);

            return $this->responseWithSuccess(__('notifications_deleted_successfully'));
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
