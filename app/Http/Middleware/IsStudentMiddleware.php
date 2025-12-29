<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use App\Models\Checkout;
use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsStudentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $trx_id = $request->trx_id ?: $request->opt_b;
        if ($trx_id && ! \auth()->check()) {
            $cart     = Cart::where('trx_id', $request->trx_id)->first();
            $checkout = Checkout::where('trx_id', $request->trx_id)->first();

            if ($cart || $checkout) {
                $data = $cart ?: $checkout;
                Auth::login(@$data->user);
            } else {
                if ($request->user_id || $request->opt_d) {
                    Auth::loginUsingId($request->user_id ?: $request->opt_d);
                } else {
                    Toastr::error('Invalid Transaction ID');

                    return redirect()->route('login');
                }
            }
        }

        if (auth()->check()) {
            if (auth()->user()->role_id == 3) {
                return $next($request);
            }
        }

        return redirect()->route('login');
    }
}
