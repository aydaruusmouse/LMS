<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CouponResource;
use App\Models\Cart;
use App\Models\Course;
use App\Repositories\CartRepository;
use App\Repositories\CouponRepository;
use App\Repositories\CourseRepository;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    use ApiReturnFormatTrait;

    protected $couponRepository;

    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $input = [
                'paginate' => setting('api_paginate'),
                'lang'     => $request->header('lang') ?: app()->getLocale(),
            ];
            $data  = [
                'coupons' => CouponResource::collection($this->couponRepository->activeCoupon($input)),
            ];

            return $this->responseWithSuccess(__('coupon_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function applyCoupon(Request $request, CartRepository $cartRepository): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:course,book',
            'code' => 'required|exists:coupons,code',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user            = jwtUser();
            $success         = false;
            $carts           = Cart::where('user_id', $user->id)->get();
            $coupon          = $this->couponRepository->couponByCode($request->code);

            if ($coupon->start_date <= now() && $coupon->end_date > now()) {
                $is_coupon_applied = $this->couponRepository->isCouponApplied([
                    'id'      => $coupon->id,
                    'user_id' => $user->id,
                ]);

                if ($is_coupon_applied) {
                    return $this->responseWithError(__('coupon_already_applied'));
                }

                if ($coupon->type == 'course') {
                    $repo       = new CourseRepository();
                    $course     = $repo->findCourses($carts->where('cartable_type', Course::class)->pluck('cartable_id')->toArray());
                    $duplicates = array_intersect($coupon->course_ids, $course->pluck('id')->toArray());

                    if (count($duplicates) > 0) {
                        $carts   = $carts->where('cartable_type', Course::class)->whereIn('cartable_id', $duplicates);
                        $success = true;
                    } else {
                        return $this->responseWithError(__('invalid_coupon'));
                    }
                } elseif ($coupon->type == 'instructor') {
                    $repo       = new CourseRepository();
                    $course     = $repo->findCourses($carts->where('cartable_type', Course::class)->pluck('cartable_id')->toArray());
                    $duplicates = array_intersect($coupon->instructor_ids, array_unique(array_merge(...$course->pluck('instructor_ids')->toArray())));

                    if (count($duplicates) > 0) {
                        $duplicates = array_intersect($coupon->instructor_ids, array_unique(array_merge(...$course->pluck('instructor_ids')->toArray())));
                        $carts      = [];
                        foreach ($duplicates as $duplicate) {
                            $carts[] = Cart::where('user_id', $user->id)->whereJsonContains('instructor_id', (string) $duplicate)->first();
                        }
                        $success    = true;
                    } else {
                        return $this->responseWithError(__('invalid_coupon'));
                    }
                } elseif ($coupon->type == 'global') {
                    $success = true;
                }
            } else {
                return $this->responseWithError(__('coupon_expired'));
            }

            DB::beginTransaction();

            $discount_amount = 0;

            if ($success) {
                foreach ($carts as $cart) {
                    $discount_amount += $coupon->discount_type == 'percent' ? ($cart->price * $coupon->discount) / 100 : $coupon->discount;
                }

                $this->couponRepository->couponApply([
                    'user_id'         => $user->id,
                    'coupon_id'       => $coupon->id,
                    'trx_id'          => $carts->first()->trx_id,
                    'coupon_discount' => $discount_amount,
                ]);
            }

            DB::commit();

            return $this->responseWithSuccess(__('coupon_applied_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->responseWithError($e->getMessage());
        }
    }
}
