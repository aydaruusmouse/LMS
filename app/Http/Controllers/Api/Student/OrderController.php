<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\EnrollResource;
use App\Http\Resources\Api\OrderResource;
use App\Repositories\CartRepository;
use App\Repositories\CheckoutRepository;
use App\Repositories\CouponRepository;
use App\Repositories\OrderRepository;
use App\Traits\ApiReturnFormatTrait;
use App\Traits\PaymentTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller
{
    use ApiReturnFormatTrait, PaymentTrait;

    protected $orderRepository;

    protected $cartRepository;

    public function __construct(OrderRepository $orderRepository, CartRepository $cartRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->cartRepository  = $cartRepository;
    }

    public function payment(Request $request, CouponRepository $couponRepository)
    {
        try {
            $user           = jwtUser();
            $token          = JWTAuth::fromUser($user);
            auth()->login($user);

            $carts          = $this->cartRepository->all([
                'user_id' => auth()->id(),
            ]);
            if (count($carts) == 0) {
                Toastr::error(__('No item in your cart.'));

                return redirect()->route('site.home');
            }
            $trx_id         = $carts->first()->trx_id;

            $amount         = $carts->sum('total_amount');
            $image          = 'https://lms.spagreen.net/public/frontend/img/logo.png';
            if (setting('dark_logo') && @is_file_exists(setting('dark_logo')['original_image'])) {
                $image = get_media(setting('dark_logo')['original_image']);
            } elseif (setting('light_logo') && @is_file_exists(setting('light_logo')['original_image'])) {
                $image = get_media(setting('light_logo')['original_image']);
            }

            $coupons        = $couponRepository->appliedCoupons([
                'user_id' => auth()->id(),
                'trx_id'  => $trx_id,
            ], 'coupon');

            $total_discount = $coupons->sum('coupon_discount');

            $data           = [
                'user_carts'     => $carts,
                'trx_id'         => $trx_id,
                'amount'         => $amount,
                'gh_price'       => round(convert_price($amount, 'GHS') * 100),
                'image'          => $image,
                'token'          => $token,
                'currency_code'  => $request->currency_code ?: 'USD',
                'total_discount' => $total_discount,
                'coupons'        => $coupons,
            ];

            return view('api.payment', $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function createOrder(Request $request)
    {
        $user = jwtUser();
    }

    public function orderHistory(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = validator($request->all(), [
            'type' => 'required|in:course,book',
        ]);

        if ($validator->fails()) {
            return $this->responseWithError(__('validation_failed'), $validator->errors());
        }

        $user      = jwtUser();

        $data      = [
            'user_id'  => $user->id,
            'type'     => $request->type,
            'paginate' => setting('api_paginate'),
        ];
        try {
            $data = [
                'order_histories' => OrderResource::collection($this->orderRepository->orderHistory($data)),
            ];

            return $this->responseWithSuccess(__('history_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function orderDetails($id, Request $request): \Illuminate\Http\JsonResponse
    {

        try {
            $currency = $request->currency ?: null;
            $checkout = $this->orderRepository->find(['enrolls.enrollable'], $id);
            $data     = [
                'order_details' => [
                    'id'              => $checkout->id,
                    'date'            => Carbon::parse($checkout->created_at)->format('d M Y'),
                    'invoice_no'      => $checkout->invoice_no,
                    'user'            => [
                        'name'  => arrayCheck('name', $checkout->billing_address) ? $checkout->billing_address['name'] : '',
                        'email' => arrayCheck('email', $checkout->billing_address) ? $checkout->billing_address['email'] : '',
                        'phone' => arrayCheck('phone', $checkout->billing_address) ? $checkout->billing_address['phone'] : '',
                    ],
                    'payment_type'    => $checkout->payment_type,
                    'items'           => EnrollResource::collection($checkout->enrolls),
                    'sub_total'       => get_price($checkout->sub_total, $currency),
                    'discount'        => get_price($checkout->discount, $currency),
                    'tax'             => get_price($checkout->tax, $currency),
                    'coupon_discount' => get_price($checkout->coupon_discount, $currency),
                    'payable_amount'  => get_price($checkout->payable_amount, $currency),
                ],
            ];

            return $this->responseWithSuccess(__('order_details_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function completeOrder(CheckoutRepository $checkoutRepository, Request $request)
    {

        DB::beginTransaction();
        try {
            $user                  = null;
            if ($request->token) {
                try {
                    if (! $user = JWTAuth::parseToken()->authenticate()) {
                        return $this->responseWithError(__('unauthorized_user'), [], 401);
                    }
                } catch (\Exception $e) {
                }
            }

            if ($user) {
                auth()->login($user);
            }
            $input                 = $request->all();

            if ($request->opt_b) {
                $userId      = $request->opt_d;
                auth()->loginUsingId($userId);
                $trxId       = $request->opt_b;
                $paymentType = 'aamarpay';
            } else {
                $userId      = auth()->id();
                $trxId       = $request->trx_id;
                $paymentType = $request->payment_type;
            }

            $input['trx_id']       = $trxId;
            $input['user_id']      = $userId;
            $input['payment_type'] = $paymentType;

            $carts                 = $this->cartRepository->all([
                'user_id' => auth()->id(),
            ]);

            $data                  = [
                'orders'  => $checkoutRepository->completeOrder($input, $carts),
                'success' => __('Order Completed'),
                'favicon' => @is_file_exists(@setting('favicon')['image_57x57_url']) ? get_media(setting('favicon')['image_57x57_url']) : static_asset('images/ico/apple-icon-precomposed.png'),
            ];

            DB::commit();
            if (request()->ajax()) {
                $data = [
                    'success' => __('purchase_done'),
                    'url'     => route('api.payment.success'),
                ];

                return response()->json($data);
            } else {
                return view('api.payment-success', $data);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            $data = [
                'favicon' => @is_file_exists(@setting('favicon')['image_57x57_url']) ? get_media(setting('favicon')['image_57x57_url']) : static_asset('images/ico/apple-icon-precomposed.png'),
            ];
            session()->forget('trx_id');
            if (request()->ajax()) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            } else {
                return view('api.payment-failed', $data);
            }
        }
    }

    public function paymentSuccess()
    {
        dd('inside_payment_success');
        app()->setLocale(setting('default_language'));
        $data = [
            'favicon' => @is_file_exists(@setting('favicon')['image_57x57_url']) ? get_media(setting('favicon')['image_57x57_url']) : static_asset('images/ico/apple-icon-precomposed.png'),
        ];

        return view('api.payment-success', $data);
    }

    public function downloadInvoice(Request $request, CheckoutRepository $checkoutRepository)
    {
        try {
            $validator = Validator::make($request->all(), [
                'trx_id' => 'required',
                'token'  => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            ini_set('max_execution_time', 1000);
            $logo_url  = (setting('dark_logo') && @is_file_exists(setting('dark_logo')['original_image']) ?
                get_media(setting('dark_logo')['original_image']) :
                get_media('images/default/logo/logo-green-black.png'));
            $user      = jwtUser();
            $checkout  = $checkoutRepository->checkoutByTrx($request->trx_id);
            if (authUser()->id != $checkout->user_id) {
                abort(404);
            }
            $data      = [
                'logo_url'      => $logo_url,
                'checkout'      => $checkout,
                'currency_code' => 'USD',
            ];
            $pdf       = Pdf::loadView('frontend.invoice', $data);
            $pdf_name  = "$checkout->invoice_no.pdf";

            return $pdf->download($pdf_name);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
