<?php

namespace App\Repositories;

use App\Models\AppliedCoupon;
use App\Models\Checkout;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\User;
use App\Traits\PaymentTrait;
use App\Traits\RandomStringTrait;
use App\Traits\SendNotification;
use Illuminate\Support\Str;

class CheckoutRepository
{
    use PaymentTrait, RandomStringTrait, SendNotification;

    public function unpaidCheckout($user_id)
    {
        return Checkout::where('user_id', $user_id)->where('status', 0)->first();
    }

    public function checkoutByTrx($trx_id)
    {
        return Checkout::with('enrolls.enrollable')->with('user')->where('trx_id', $trx_id)->first();
    }

    public function update($request, $trx_id)
    {
        return Checkout::where('trx_id', $trx_id)->update($request);
    }

    public function store($data, $user_id, $calculations, $payment_details)
    {
        $system_commission              = $calculations['payable_amount'] * floatval(setting('system_commission')) / 100;
        $organization_commission        = $calculations['payable_amount'] - $system_commission;
        $prefix                         = setting('invoice_prefix') ?: 'OVOY';

        $data                           = [
            'user_id'                   => $user_id,
            'billing_address'           => null,
            'shipping_address'          => null,
            'trx_id'                    => $data['trx_id'],
            'sub_total'                 => $calculations['sub_total'],
            'tax'                       => $calculations['tax'],
            'discount'                  => $calculations['discount'],
            'coupon_discount'           => $calculations['coupon_discount'],
            'total_amount'              => $calculations['total_amount'],
            'payable_amount'            => $calculations['payable_amount'],
            'invoice_no'                => $prefix . '-' . $this->generate_random_string(10, 'number'),
            'invoice_date'              => date('Y-m-d H:i:s'),
            'payment_type'              => $data['payment_type'],
            'payment_details'           => $payment_details,
            'offline_method_id'         => getArrayValue('offline_method_id', $data),
            'status'                    => $data['payment_type'] == 'offline_method' ? 0 : 1,
            'system_commission'         => $system_commission,
            'organization_commission'   => $organization_commission,
        ];

        return Checkout::create($data);
    }

    public function insertEnroll($carts, $checkout_id)
    {
        $enrolls = [];
        foreach ($carts as $cart) {

            $payable_amount = $cart->total_amount - $cart->discount;

            $system_commission = $payable_amount * floatval(setting('system_commission')) / 100;

            $organization_commission = $payable_amount - $system_commission;

            $enrolls[] = [
                'checkout_id' => $checkout_id,
                'price' => $cart->price,
                'quantity' => $cart->quantity,
                'coupon_discount' => $cart->coupon_discount,
                'discount' => $cart->discount,
                'tax' => $cart->tax,
                'shipping_cost' => $cart->shipping_cost,
                'sub_total' => $cart->sub_total,
                'enrollable_id' => $cart->cartable_id,
                'enrollable_type' => $cart->cartable_type,
                'system_commission' => $system_commission,
                'organization_commission' => $organization_commission,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $cart->delete();
        }

        return Enroll::insert($enrolls);
    }

    public function walletCheck($data, $user, $checkout): bool
    {
        if ($data['payment_type'] == 'wallet') {
            $wallet_repo = new WalletRepository();

            $data = [
                'type' => 'expense',
                'payment_type' => 'wallet',
                'trx_id' => $checkout->trx_id,
                'status' => 1,
            ];
            $wallet_repo->store($data, $checkout->payable_amount, 'course_purchase', []);

            $wallet_repo->updateWallet($user, $checkout->payable_amount, 2);
        }

        return true;
    }

    public function completeOrder($data, $carts)
    {
        $user = auth()->user();

        if ($data['payment_type'] == 'offline_method') {
            $payment_details = [];
            if (arrayCheck('offline_method_file', $data)) {
                $storage = setting('default_storage') == 'aws_s3' ? 'aws_s3' : 'local';
                $fileName = time() . '.' . $data['offline_method_file']->extension();
                $data['offline_method_file']->move(public_path('images/orders/'), $fileName);

                $payment_details = [
                    'storage' => $storage,
                    'image' => 'images/orders/' . $fileName,
                ];
            }
        } else {
            $payment_details = $this->methodCheck($data);

            if (!$this->successStatusCheck($data, $payment_details)) {
                return __('transaction_cant_be_completed');
            }
        }

        $coupon_discount = 0;
        if (setting('coupon_system')) {
            $coupons = AppliedCoupon::where('user_id', $user->id)->where('trx_id', $data['trx_id'])->where('status', 0)->get();
            $coupon_discount = count($coupons) > 0 ? $coupons->sum('coupon_discount') : 0;
        }

        $calculations = [
            'sub_total' => $carts->sum('sub_total'),
            'tax' => $carts->sum('tax'),
            'discount' => $carts->sum('discount'),
            'coupon_discount' => $coupon_discount,
            'total_amount' => $carts->sum('total_amount'),
            'payable_amount' => $carts->sum('total_amount') - $coupon_discount,
        ];

        $checkout = $this->store($data, $user->id, $calculations, $payment_details);

        $this->insertEnroll($carts, $checkout->id);

        $this->walletCheck($data, $user, $checkout);

        if (setting('coupon_system')) {
            AppliedCoupon::where('user_id', $user->id)->where('trx_id', $data['trx_id'])->where('status', 0)->update(['status' => 1]);
        }

        return $checkout;
    }

    public function getCalculations($enrolled_courses): array
    {
        return [
            'sub_total'         => $enrolled_courses->sum('price'),
            'tax'               => 0,
            'discount'          => $enrolled_courses->sum('discount_check'),
            'coupon_discount'   => 0,
            'total_amount'      => $enrolled_courses->sum('price'),
            'payable_amount'    => $enrolled_courses->sum('price') - $enrolled_courses->sum('discount_check'),
        ];
    }

    public function bulkEnrollmentsData($enrolled_courses, $checkout): array
    {
        $enrolls = [];

        foreach ($enrolled_courses as $enrolled_course) {
            $payable_amount                 = $enrolled_course->price - $enrolled_course->discount_check;
            $system_commission              = $payable_amount * floatval(setting('system_commission')) / 100;
            $organization_commission        = $payable_amount - $system_commission;

            $enrolls[]                      = [
                'checkout_id'               => $checkout->id,
                'price'                     => $enrolled_course->price,
                'quantity'                  => 1,
                'coupon_discount'           => 0,
                'discount'                  => $enrolled_course->discount_check,
                'tax'                       => 0,
                'shipping_cost'             => 0,
                'sub_total'                 => $enrolled_course->price,
                'enrollable_id'             => $enrolled_course->id,
                'enrollable_type'           => Course::class,
                'system_commission'         => $system_commission,
                'organization_commission'   => $organization_commission,
                'created_at'                => now(),
                'updated_at'                => now(),
            ];
        }

        return $enrolls;
    }
    public function bulkEnrolls($data): bool
    {
        $students = User::whereIn('id', $data['student_id'])->get();
        $data['payment_type'] = __('added_by_admin');

        $enrolls = [];
        foreach ($students as $student) {
            $data['trx_id'] = Str::random();
            $enrolled_courses = Course::whereIn('id', $data['course_id'])->whereDoesntHave('enrolls', function ($query) use ($student) {
                $query->whereHas('checkout', function ($query) use ($student) {
                    $query->where('user_id', $student->id);
                });
            })->get();
            if ($enrolled_courses->count() == 0) {
                continue;
            }
            $checkout = $this->store($data, $student->id, $this->getCalculations($enrolled_courses), []);
            $enrolls = array_merge($enrolls, $this->bulkEnrollmentsData($enrolled_courses, $checkout));
        }

        if (count($enrolls) > 0) {
            Enroll::insert($enrolls);
        }
        return true;
    }

    public function changeStatus($id)
    {
        $checkout = Checkout::find($id);
        $status = !$checkout->status;
        $checkout->update(['status' => !$checkout->status]);
        return $status;
    }
}
