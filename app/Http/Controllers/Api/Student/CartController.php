<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CartResource;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Course;
use App\Repositories\BookRepository;
use App\Repositories\CartRepository;
use App\Repositories\CheckoutRepository;
use App\Repositories\CouponRepository;
use App\Repositories\CourseRepository;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CartController extends Controller
{
    use ApiReturnFormatTrait;

    protected $courseRepository;

    protected $bookRepository;

    protected $cartRepository;

    protected $checkout;

    public function __construct(CourseRepository $courseRepository, BookRepository $bookRepository, CartRepository $cartRepository, CheckoutRepository $checkout)
    {
        $this->courseRepository = $courseRepository;
        $this->bookRepository   = $bookRepository;
        $this->cartRepository   = $cartRepository;
        $this->checkout         = $checkout;
    }

    public function index(CouponRepository $couponRepository, Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $trx_id         = '';
            $currency       = $request->currency ?: null;
            $input          = [
                'paginate' => setting('api_paginate'),
                'user_id'  => jwtUser()->id,
            ];
            $carts          = $this->cartRepository->all($input);

            if (count($carts) > 0) {
                $trx_id = $carts->first()->trx_id;
            }

            $coupons        = $couponRepository->appliedCoupons([
                'user_id' => jwtUser()->id,
                'trx_id'  => $trx_id,
            ], 'coupon');

            $total_discount = $coupons->sum('coupon_discount');

            $data           = [
                'carts'        => CartResource::collection($this->cartRepository->all($input)),
                'calculations' => [
                    'sub_total'       => get_price($carts->sum('sub_total'), $currency),
                    'discount'        => get_price($carts->sum('discount'), $currency),
                    'coupon_discount' => get_price($coupons->sum('coupon_discount'), $currency),
                    'tax'             => get_price($carts->sum('tax'), $currency),
                    'total_payable'   => get_price($carts->sum('total_amount') - $total_discount, $currency),
                ],
            ];

            return $this->responseWithSuccess(__('cart_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function addToCart(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:course,book',
            'id'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user     = jwtUser();

            if ($request->type == 'course') {
                $course        = $this->courseRepository->find($request->id);
                $cartable_type = Course::class;
            } else {
                if (addon_is_activated('book_store')) {
                    return $this->responseWithSuccess(__('addon_not_installed_yet'));
                }
                $course        = $this->bookRepository->find($request->id);
                $cartable_type = Book::class;
            }

            $cart     = Cart::where('user_id', $user->id)
                ->where('cartable_id', $request->id)
                ->where('cartable_type', $cartable_type)
                ->first();

            $has_cart = $this->cartRepository->hasCart($user->id);

            if ($cart) {
                return $this->responseWithError(__('course_already_added_to_cart'));
            } else {
                $quantity  = $request->quantity ?? 1;
                $sub_total = $course->price * $quantity;
                $tax       = $shipping_cost = 0;
                $trx_id    = $has_cart ? $has_cart->trx_id : Str::random();
                $this->cartRepository->store([
                    'instructor_id' => $course->instructor_ids,
                    'user_id'       => $user->id,
                    'quantity'      => $quantity,
                    'price'         => $course->price,
                    'discount'      => $course->discount_check,
                    'trx_id'        => $trx_id,
                    'tax'           => 0,
                    'sub_total'     => $sub_total,
                    'total_amount'  => ($sub_total + $tax + $shipping_cost) - $course->discount_check,
                    'shipping_cost' => 0,
                    'cartable_id'   => $course->id,
                    'cartable_type' => $cartable_type,
                ]);
                //                $this->studentCheckout($user->id, $trx_id);
            }

            return $this->responseWithSuccess(__('added_to_cart_successfully'));
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function delete($id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->cartRepository->destroy($id);

            return $this->responseWithSuccess(__('cart_deleted_successfully'));
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function studentCheckout($user_id, $trx_id)
    {
        $input                   = [
            'paginate' => setting('api_paginate'),
            'user_id'  => $user_id,
        ];

        $carts                   = $this->cartRepository->all($input);
        $sub_total               = $carts->sum('sub_total');
        $discount                = $carts->sum('discount');
        $coupon_discount         = $carts->sum('coupon_discount');
        $tax                     = $carts->sum('tax');
        $total_amount            = $carts->sum('total_amount');

        $data                    = [];
        $data['user_id']         = $user_id;
        $data['trx_id']          = $trx_id;
        $data['sub_total']       = $sub_total;
        $data['tax']             = $tax;
        $data['discount']        = $discount;
        $data['coupon_discount'] = $coupon_discount;
        $data['total_amount']    = $total_amount;
        $data['payable_amount']  = $total_amount;

        $unpaid_checkout         = $this->checkout->unpaidCheckout($user_id);
        if (empty($unpaid_checkout)) {
            $this->checkout->store($data);
        } else {
            $this->checkout->update($data, $trx_id);
        }
    }
}
