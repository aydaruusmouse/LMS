<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Notification;
use App\Traits\PaymentTrait;

class OrderRepository
{
    use PaymentTrait;

    public function index()
    {
        return Checkout::latest()->paginate(setting('paginate'));
    }

    public function orderHistory($data)
    {
        return Enroll::with('checkout', 'enrollable')->whereHas('enrollable')->whereHas('checkout', function ($q) use ($data) {
            $q->where('user_id', $data['user_id']);
        })->when(arrayCheck('type', $data) && $data['type'] == 'course', function ($query) {
            $query->where('enrollable_type', Course::class)->whereHas('checkout', function ($q) {
                $q->where('status', 1);
            });
        })->when(arrayCheck('type', $data) && $data['type'] == 'book', function ($query) {
            $query->where('enrollable_type', Book::class);
        })->groupBy('checkout_id')->latest()->paginate($data['paginate']);
    }

    public function find($relation, $id): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        return Checkout::with($relation)->find($id);
    }

    public function completeOrder($data, $user)
    {

        $payment_details = $carts = [];
        if ($user) {
            $carts = Cart::where('user_id', $user->id)->where('trx_id', $data['trx_id'])->when(session()->get('is_buy_now'), function ($query) {
                $query->where('is_buy_now', session()->get('is_buy_now'));
            })->get();
        }

        if ($data['payment_type'] == 'aamarpay') {
            $trx_id = $data['opt_b'];
        } else {
            $trx_id = array_key_exists('trx_id', $data) ? $data['trx_id'] : $carts->first()->trx_id;
        }

        $orders          = $this->takePaymentOrder($trx_id);

        if (! $user) {

            if (count($orders) == 0) {
                $orders = Checkout::where('trx_id', $trx_id)->where('status', 1)->get();
            }
            auth()->login($orders->first()->user);
            $user  = auth()->user();
            $carts = Cart::where('user_id', $user->id)->where('trx_id', $trx_id)->when(session()->get('is_buy_now'), function ($query) {
                $query->where('is_buy_now', session()->get('is_buy_now'));
            })->get();
        }
        $orders          = Checkout::where('trx_id', $trx_id)->update(['status' => 1, 'payment_type' => $data['payment_type']]);
        $this->notification($user->id);
        if ($user) {
            $payment_details = $this->methodCheck($data, $orders, $user);
            foreach ($carts as $cart) {
                $enrolls                    = [];
                $enrolls['checkout_id']     = $cart->checkout->id;
                $enrolls['price']           = $cart->price;
                $enrolls['quantity']        = $cart->quantity;
                $enrolls['coupon_discount'] = $cart->coupon_discount;
                $enrolls['discount']        = $cart->discount;
                $enrolls['tax']             = $cart->tax;
                $enrolls['shipping_cost']   = $cart->shipping_cost;
                $enrolls['sub_total']       = $cart->sub_total;
                $enrolls['enrollable_id']   = $cart->cartable_id;
                $enrolls['enrollable_type'] = $cart->cartable_type;
                Enroll::create($enrolls);
                $cart->delete();
            }
            $storage         = setting('default_storage') == 'aws_s3' ? 'aws_s3' : 'local';

            if (array_key_exists('file', $data) && $data['file']) {
                $fileName                 = time().'.'.$data['file']->extension();
                $data['file']->move(public_path('images/orders/'), $fileName);

                $data['image']['storage'] = $storage;
                $data['image']['image']   = 'images/orders/'.$fileName;
            }
            session()->put('trx_id', $trx_id);
            session()->forget('bkash_token');
            session()->forget('is_buy_now');
        }

        return $payment_details;
    }

    public function takePaymentOrder($trx_id)
    {
        return Checkout::where('trx_id', $trx_id)
            ->where('status', 0)->get();
    }

    // public function methodCheck($data, $orders = [], $user = null)
    // {
    //     $currency = new CurrencyRepository();

    //     if (session()->has('currency')) {
    //         $user_currency = session()->get('currency');
    //     } else {
    //         $user_currency = setting('default_currency');
    //     }

    //     if ($data['payment_type'] == 'stripe') {
    //         return $this->stripe();
    //     }
    //     return false;
    // }

    public function notification($user_id)
    {
        $notification                = [];
        $notification['title']       = 'payment';
        $notification['description'] = 'payment_successful';
        $notification['is_read']     = 0;
        $notification['url']         = null;
        $notification['user_id']     = $user_id;
        Notification::create($notification);
    }
}
