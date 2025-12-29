@extends('frontend.layouts.master')
@section('title', __('payment_details'))
@section('content')
    <section class="payment-gateway-section p-t-50 p-t-sm-30 p-b-185 p-b-sm-50">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-12">
                    <nav class="page-nav m-b-sm-40 m-b-70">
                        <ul>
                            <li class="active">
                                <a href="{{ route('cart.view') }}">
                                    {{ __('view_cart') }}
                                </a>
                            </li>
                            <li class="active">
                                <a href="{{ route('checkout') }}">
                                    {{__('payment_details')}}
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    {{ __('order_complete') }}
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="payment-gateway">
                        <h6 class="border-bottom-soft-white p-b-10 fw-semibold m-b-20">{{ __('select_payment') }}</h6>
                        <div class="row payment-methods-list">
                            @if(setting('is_paypal_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" value="paypal" id="paypal">
                                        <label for="paypal">
                                            <img src="{{ static_asset('images/payment-icon/paypal.svg') }}"
                                                 alt="paypal">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_stripe_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" value="stripe" id="stripe">
                                        <label for="stripe">
                                            <img src="{{ static_asset('images/payment-icon/stripe.svg') }}"
                                                 alt="Stripe">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_mollie_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" id="mollie" value="mollie">
                                        <label for="mollie">
                                            <img src="{{ static_asset('images/payment-icon/mollie.svg') }}"
                                                 alt="mollie">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_skrill_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" id="skrill" value="skrill">
                                        <label for="skrill">
                                            <img src="{{ static_asset('images/payment-icon/skrill.svg') }}"
                                                 alt="skrill">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_sslcommerz_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" value="sslcommerz" id="sslcommerz">
                                        <label for="sslcommerz">
                                            <img src="{{ static_asset('images/payment-icon/sslcommerz.svg') }}"
                                                 alt="SSL Commerz">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_bkash_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" id="bKash" value="bKash">
                                        <label for="bKash">
                                            <img src="{{ static_asset('images/payment-icon/bKash.svg') }}" alt="bKash">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_nagad_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" value="nagad" id="nagad">
                                        <label for="nagad">
                                            <img src="{{ static_asset('images/payment-icon/nagad.svg') }}"
                                                 alt="nagad">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_aamarpay_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" value="aamarpay" id="aamarpay">
                                        <label for="aamarpay">
                                            <img src="{{ static_asset('images/payment-icon/aamarpay.svg') }}"
                                                 alt="aamarpay">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_paytm_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" id="paytm" value="paytm">
                                        <label for="paytm">
                                            <img src="{{ static_asset('images/payment-icon/paytm.svg') }}"
                                                 alt="Paytm">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_razorpay_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" value="razor_pay" id="razor_pay">
                                        <label for="razor_pay">
                                            <img src="{{ static_asset('images/payment-icon/razorpay.svg') }}"
                                                 alt="razor_pay">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_flutterwave_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" value="flutter_wave" id="flutter_wave">
                                        <label for="flutter_wave">
                                            <img src="{{ static_asset('images/payment-icon/flutterwave.svg') }}"
                                                 alt="flutter_wave">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_paystack_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" id="paystack" value="paystack">
                                        <label for="paystack">
                                            <img src="{{ static_asset('images/payment-icon/paystack.svg') }}"
                                                 alt="paystack">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_google_pay_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" id="google_pay" value="google_pay">
                                        <label for="google_pay">
                                            <img src="{{ static_asset('images/payment-icon/google_pay.svg') }}"
                                                 alt="google_pay">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_mercado_pago_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" id="mercadopago" value="mercadopago">
                                        <label for="mercadopago">
                                            <img src="{{ static_asset('images/payment-icon/mercado-pago.svg') }}"
                                                 alt="Mercado Pago">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_kkiapay_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" id="kkiapay" value="kkiapay">
                                        <label for="kkiapay">
                                            <img src="{{ static_asset('images/payment-icon/kkiapay.svg') }}"
                                                 alt="kkiapay">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_jazz_cash_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" id="jazz_cash" value="jazz_cash">
                                        <label for="jazz_cash">
                                            <img src="{{ static_asset('images/payment-icon/JazzCash.svg') }}"
                                                 alt="jazz_cash">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_mid_trans_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" value="mid_trans" id="mid_trans">
                                        <label for="mid_trans">
                                            <img src="{{ static_asset('images/payment-icon/midtrans.svg') }}"
                                                 alt="mid_trans">

                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_telr_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" id="telr" value="telr">
                                        <label for="telr">
                                            <img src="{{ static_asset('images/payment-icon/telr.svg') }}" alt="telr">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_iyzico_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" id="iyzico" value="iyzico">
                                        <label for="iyzico">
                                            <img src="{{ static_asset('images/payment-icon/iyzico.svg') }}"
                                                 alt="iyzico">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_hitpay_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" id="hitpay" value="hitpay">
                                        <label for="hitpay">
                                            <img src="{{ static_asset('images/payment-icon/hitpay.svg') }}"
                                                 alt="hitpay">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(setting('is_uddokta_pay_activated'))
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" value="uddokta_pay" id="uddokta_pay">
                                        <label for="uddokta_pay">
                                            <img src="{{ static_asset('images/payment-icon/uddokta_pay.svg') }}"
                                                 alt="uddokta_pay">
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @foreach($offline_methods as $offline_method)
                                <div class="col-lg-3 col-md-3 col-4">
                                    <div class="payment-methods-item">
                                        <input type="radio" name="payment_type" data-id="{{ $offline_method->id }}"
                                               data-name="{{ $offline_method->lang_name }}"
                                               data-instructions="{{ $offline_method->lang_instructions }}"
                                               value="offline_method" id="offline_method_{{ $offline_method->id }}">
                                        <label for="offline_method_{{ $offline_method->id }}">
                                            <img src="{{ getFileLink('147x80',$offline_method->image) }}"
                                                 alt="{{ $offline_method->lang_name }}">
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if(setting('wallet_system') && auth()->user()->balance >= $amount)
                        <div class="checkout-billing m-t-50">
                            <div class="section-title-v3 color-dark m-b-15">
                                <h6>{{__('Pay with Your Wallet Balance')}}</h6>
                                <strong class="active_color">Available balance
                                    : {{ get_price(auth()->user()->balance, userCurrency()) }}</strong>
                            </div>
                            <div class="checkout-accordion">
                                <div class="accordion accordion-flush" id="walletBilling">
                                    <div class="accordion-item">
                                        <div class="accordion-header" id="checkout-billing-wallet">
                                            <div class="accordion-button collapsed" data-bs-toggle="collapse"
                                                 data-bs-target="#checkout-billing-walletFS" aria-expanded="false"
                                                 aria-controls="checkout-billing-walletFS">
                                                <label>
                                                    <input type="checkbox" name="payment_type" value="wallet">
                                                    <span>{{__('Pay with Your Wallet Balance')}}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <div class="checkout-sidebar">
                        <div class="widget m-b-30 cart-product-table">
                            <h6 class="border-bottom-soft-white p-b-10 fw-semibold m-b-20">{{__('order_summary')}}</h6>
                            @foreach($user_carts as $key=> $cart)
                                @if($cart->cartable_type == 'App\Models\Book')
                                    <div class="cart-product border-bottom-soft-white p-b-15 m-b-15">
                                        <div class="book-thumbnail">
                                            <a href="{{ route('course.details',$course->slug) }}">
                                                <img src="{{ getFileLink('80x80',$course->image) }}"
                                                     alt="{{ $course->title }}">
                                            </a>
                                        </div>
                                        <div class="book-text-content">
                                            <h6><a href="book-details.html">The Phychology of money</a></h6>
                                            <p class="author">By <a href="#">Morgan Housel</a></p>
                                            <p class="file-type">Hard Copy</p>
                                            <div class="quantity-price-wrapper">
                                                <span class="quantity">1 ×</span>
                                                <span class="price">$115.50</span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @php
                                        $course = $cart->cartable;
                                    @endphp
                                    <div
                                        class="cart-product border-bottom-soft-white p-b-15 m-b-15 {{ $key > 2 ? 'd-none' : '' }}">
                                        <div class="book-thumbnail">
                                            <a href="{{ route('course.details',$course->slug) }}">
                                                <img src="{{ getFileLink('80x80',$course->image) }}"
                                                     alt="{{ $course->title }}">
                                            </a>
                                        </div>
                                        <div class="book-text-content">
                                            <h6>
                                                <a href="{{ route('course.details',$course->slug) }}">{{ $course->title }}</a>
                                            </h6>
                                            <div class="quantity-price-wrapper">
                                                <span class="quantity">1 ×</span>
                                                <span class="price">{{ get_price($course->price, userCurrency()) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if($key > 2)
                                <a href="javascript:void(0)" class="see-all-btn">{{ __('see_all') }}</a>
                            @endif
                        </div>
                        <div class="cart-product-calculation m-t-sm-15">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>{{ __('sub_total') }}</td>
                                    <td>{{ get_price($user_carts->sum('sub_total'), userCurrency()) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('discount') }}</td>
                                    <td>{{ get_price($user_carts->sum('discount'), userCurrency()) }}</td>
                                </tr>
                                @if(setting('coupon_system'))
                                    <tr>
                                        <td>{{ __('coupon_discount') }}</td>
                                        <td>{{ get_price($total_discount, userCurrency()) }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>{{ __('total') }}</td>
                                    <td>{{ get_price($amount, userCurrency()) }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div>
                                <a href="#"
                                   class="template-btn d-block text-center payment_btns disable_a">{{ __('pay_now') }}</a>
                                <div class="div_btns d-none">
                                    @if(setting('is_stripe_activated'))
                                        <a href="{{ route('stripe.redirect',['trx_id' => $trx_id,'payment_type' => 'stripe']) }}"
                                           class="template-btn d-block text-center payment_btns stripe_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_uddokta_pay_activated'))
                                        <a href="{{ route('uddokta.pay.redirect',['trx_id' => $trx_id,'payment_type' => 'uddokta_pay']) }}"
                                           class="template-btn d-block text-center payment_btns uddokta_pay_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_sslcommerz_activated'))
                                        <a href="{{ route('sslcommerze.redirect',['trx_id' => $trx_id,'payment_type' => 'sslcommerze']) }}"
                                           class="template-btn d-block text-center payment_btns sslcommerz_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_mollie_activated'))
                                        <a href="{{ route('mollie.redirect',['trx_id' => $trx_id,'payment_type' => 'mollie']) }}"
                                           class="template-btn d-block text-center payment_btns mollie_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_skrill_activated'))
                                        <a href="{{ route('skrill.redirect',['trx_id' => $trx_id,'payment_type' => 'skrill']) }}"
                                           class="template-btn d-block text-center payment_btns skrill_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_bkash_activated'))
                                        <a href="{{ route('bkash.redirect',['trx_id' => $trx_id,'payment_type' => 'bKash']) }}"
                                           class="template-btn d-block text-center payment_btns bKash_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_nagad_activated'))
                                        <a href="{{ route('nagad.redirect',['trx_id' => $trx_id,'payment_type' => 'nagad']) }}"
                                           class="template-btn d-block text-center payment_btns nagad_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_aamarpay_activated'))
                                        <a href="{{ route('aamarpay.redirect',['trx_id' => $trx_id,'payment_type' => 'aamarpay']) }}"
                                           class="template-btn d-block text-center payment_btns aamarpay_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_paytm_activated'))
                                        <a href="{{ route('paytm.redirect',['trx_id' => $trx_id,'payment_type' => 'paytm']) }}"
                                           class="template-btn d-block text-center payment_btns paytm_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_razorpay_activated'))
                                        <a href="javascript:void(0)"
                                           class="template-btn d-block text-center payment_btns razor_pay_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_flutterwave_activated'))
                                        <a href="javascript:void(0)"
                                           class="template-btn d-block text-center payment_btns flutter_wave_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_paystack_activated'))
                                        <a href="javascript:void(0)"
                                           class="template-btn d-block text-center payment_btns paystack_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_mercado_pago_activated'))
                                        <a href="{{ route('mercadoPago.redirect',['trx_id' => $trx_id,'payment_type' => 'mercadopago']) }}"
                                           class="template-btn d-block text-center payment_btns mercadopago_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_kkiapay_activated'))
                                        <a href="javascript:void(0)"
                                           class="template-btn d-block text-center payment_btns kkiapay_btn kkiapay-button">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_mid_trans_activated'))
                                        <a href="{{ route('midtrans.redirect',['trx_id' => $trx_id,'payment_type' => 'mid_trans']) }}"
                                           class="template-btn d-block text-center payment_btns mid_trans_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_telr_activated'))
                                        <a href="{{ route('telr.redirect',['trx_id' => $trx_id,'payment_type' => 'telr']) }}"
                                           class="template-btn d-block text-center payment_btns telr_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_hitpay_activated'))
                                        <a href="{{ route('hitpay.redirect',['trx_id' => $trx_id,'payment_type' => 'hitpay']) }}"
                                           class="template-btn d-block text-center payment_btns hitpay_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_hitpay_activated'))
                                        <a href="{{ route('hitpay.redirect',['trx_id' => $trx_id,'payment_type' => 'hitpay']) }}"
                                           class="template-btn d-block text-center payment_btns hitpay_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_jazz_cash_activated'))
                                        <a href="javascript:void(0)"
                                           class="template-btn d-block text-center payment_btns jazz_cash_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('is_google_pay_activated'))
                                        <a href="javascript:void(0)"
                                           class="template-btn d-block text-center payment_btns google_pay_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(count($offline_methods) > 0)
                                        <a href="javascript:void(0)"
                                           class="template-btn d-block text-center payment_btns offline_method_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @if(setting('wallet_system') && auth()->user()->balance >= $amount)
                                        <a href="{{ route('complete.order',['trx_id' => $trx_id,'payment_type' => 'wallet']) }}"
                                           class="template-btn d-block text-center payment_btns wallet_btn">{{ __('pay_now') }}</a>
                                    @endif
                                    @include('components.frontend_loading_btn', ['class' => 'template-btn d-block','type' => 'a'])
                                </div>
                                @if(setting('is_paypal_activated'))
                                    <div class="mx-auto w_40 payment_btns d-none paypal_btn"
                                         id="paypal-button-container"></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal window-load-modal fade" id="offline_method_modal" tabindex="-1"
         aria-labelledby="windowLoadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('pay_with_offline') }} - <span id="method_title"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('complete.order') }}" method="POST" class="ajax_form">@csrf
                    <div class="modal-body mt-4">
                        <input type="hidden" name="trx_id" value="{{ $trx_id }}">
                        <input type="hidden" name="payment_type" value="offline_method">
                        <input type="hidden" name="offline_method_id" id="offline_method_id" value="">
                        <input type="file" name="offline_method_file" id="chooseFile" accept=".jpg, .jpeg, .gif, .png">
                        <h6 class="mb-2 mt-2 instruction_header">{{ __('instructions') }} :</h6>
                        <div class="instructions"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="template-btn btn-secondary" data-bs-dismiss="modal">{{ __('cancel') }}</button>
                        <button type="submit" class="template-btn">{{ __('proceed') }}</button>
                        @include('components.frontend_loading_btn', [
                                            'class' => 'template-btn',
                                        ])
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if(setting('is_jazz_cash_activated'))
        @php
            $DateTime = new \DateTime();
            $pp_TxnDateTime = $DateTime->format('YmdHis');

            $ExpiryDateTime = $DateTime;
            $ExpiryDateTime->modify('+' . 1 . ' hours');
            $pp_TxnExpiryDateTime = $ExpiryDateTime->format('YmdHis');

            $pp_TxnRefNo = 'T' . $pp_TxnDateTime;

            $pp_Amount = '50000';

            $post_data = [
                "pp_Version" => config('jazz_cash.VERSION'),
                "pp_TxnType" => "MIGS",
                "pp_Language" => config('jazz_cash.LANGUAGE'),
                "pp_MerchantID" => config('jazz_cash.MERCHANT_ID'),
                "pp_SubMerchantID" => "",
                "pp_Password" => config('jazz_cash.PASSWORD'),
                "pp_BankID" => "TBANK",
                "pp_ProductID" => "RETL",
                "pp_IsRegisteredCustomer" => "No",
                "pp_TokenizedCardNumber" => "",
                "pp_TxnRefNo" => $pp_TxnRefNo,
                "pp_Amount" => $pp_Amount,
                "pp_TxnCurrency" => config('jazz_cash.CURRENCY_CODE'),
                "pp_TxnDateTime" => $pp_TxnDateTime,
                "pp_BillReference" => "billRef",
                "pp_Description" => "Description of transaction",
                "pp_TxnExpiryDateTime" => $pp_TxnExpiryDateTime,
                "pp_ReturnURL" => url('/') . config('jazz_cash.RETURN_URL'),
                "ppmpf_1" => "1",
                "ppmpf_2" => "2",
                "ppmpf_3" => "3",
                "ppmpf_4" => "4",
                "ppmpf_5" => "5",
                "pp_CustomerID" => "Test",
                "pp_CustomerEmail" => "test@gmail.com",
                "pp_MobileNumber" => "03123456789",
                "pp_CINIC" => "345678",
            ];
            ksort($post_data);

            $str = '';
            foreach ($post_data as $key => $value) {
                if (!empty($value)) {
                    $str = $str . '&' . $value;
                }
            }

            $str                        = setting('jazz_cash_integrity_salt') . $str;
            $post_data['pp_SecureHash'] = hash_hmac('sha256', $str, setting('jazz_cash_integrity_salt'));
        @endphp
        <form class="jsform" action='https://sandbox.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform/'
              method="GET">
            @foreach($post_data as $key => $data)
                <input type="hidden" name="{{ $key }}" value="{{ $data }}">
            @endforeach
        </form>
    @endif
    @if(setting('is_flutterwave_activated'))
        <form action="https://checkout.flutterwave.com/v3/hosted/pay" method="post" class="fw_form">
            <input type="hidden" name="public_key" value="{{ setting('flutterwave_public_key') }}"/>
            <input type="hidden" name="tx_ref" value="{{ Str::random(12) }}"/>
            <input type="hidden" name="amount" value="{{ round(convert_price($amount,'NGN'),2) }}"/>
            <input type="hidden" name="currency" value="NGN"/>
            <input type="hidden" name="redirect_url"
                   value="{{ url("user/complete-order?trx_id=$trx_id&payment_type=flutter_wave") }}"/>
            <input type="hidden" name="meta[token]" value="{{ $trx_id }}"/>
            <input type="hidden" name="customer[name]" value="{{ auth()->user()->name }}"/>
            <input type="hidden" name="customer[email]" value="{{ auth()->user()->email }}"/>
        </form>
    @endif
    <input type="hidden" class="total_amount" value="{{ $user_carts->sum('total_amount') }}">
    <input type="hidden" class="trx_id" value="{{ $trx_id }}">
    <input type="hidden" class="url" value="{{ url('/') }}">
    <input type="hidden" class="auth_user" value="{{ auth()->user() }}">
    <input type="hidden" class="is_sslcommerz_sandbox_mode_activated"
           value="{{ setting('is_sslcommerz_sandbox_mode_activated') == 1 }}">
    <input type="hidden" id="stripe_key" value="{{ setting('stripe_key') }}">
@endsection
@push('js')
    <script>
        window.url = '';
        window.base_url = $('.url').val();
        window.amount = $('.total_amount').val();
        window.trx_id = $('.trx_id').val();
        window.code = $('.code').val();
        window.user = $('.auth_user').val();
        window.package_id = $('.package_id').val();
        window.ssl_sandobx_activated = $('.is_sslcommerz_sandbox_mode_activated').val();
    </script>
    </script>
    @if(setting('is_paypal_activated'))
        <script data-namespace="paypal_sdk"
                src="https://www.paypal.com/sdk/js?client-id={{ setting('paypal_client_id') }}&currency=USD"></script>
        <script src="{{ static_asset('frontend/js/paypal.js') }}"></script>
    @endif
    @if(setting('is_razorpay_activated'))
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    @endif
    @if(setting('is_paystack_activated'))
        <script src="https://js.paystack.co/v1/inline.js"></script>
    @endif
    @if(setting('is_kkiapay_activated'))
        <script src="https://cdn.kkiapay.me/k.js" amount="{{ (int)convert_price($amount,'XOF') }}" url="{{ $image }}"
                position="center" theme="{{ setting('primary_color') }}"
                sandbox="{{ setting('is_kkiapay_sandbox_enabled') ? "true" : "false" }}"
                key="{{ setting('kkiapay_public_api_key') }}"
                callback="{{ url("user/complete-order?trx_id=$trx_id&payment_type=kkiapay") }}"></script>
    @endif
    @if(setting('is_mid_trans_activated'))
        <script src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ setting('mid_trans_client_id') }}"></script>
    @endif
    <script>
        $(document).ready(function () {
            let offline_method = '';
            $(document).on('click', '.see-all-btn', function () {
                $('.cart-product').removeClass('d-none');
                $(this).addClass('d-none');
            });
            $(document).on('change', 'input[name="payment_type"]', function () {
                let val = $(this).val();
                if (val == 'offline_method') {
                    offline_method = {
                        id: $(this).data('id'),
                        lang_name: $(this).data('name'),
                        lang_instructions: $(this).data('instructions'),
                    };
                }
                $('.payment_btns').addClass('d-none');
                $('.div_btns').removeClass('d-none');
                let btn_selector = $('.' + val + '_btn');
                if (val) {
                    btn_selector.removeClass('d-none');
                }
            });
            $(document).on('click', '.razor_pay_btn', function (e) {
                $(this).addClass('d-none');
                $('.loading_button').removeClass('d-none');
                $.ajax({
                    url: "{{ route('razorpay.redirect') }}",
                    type: "GET",
                    data: {
                        _token: "{{ csrf_token() }}",
                        trx_id: $('.trx_id').val(),
                        payment_type: 'razor_pay',
                    },
                    success: function (data) {
                        $(this).removeClass('d-none');
                        $('.loading_button').addClass('d-none');
                        if (data.success) {
                            var rzp1 = new Razorpay(data);
                            rzp1.open();
                            e.preventDefault();
                        } else {
                            toastr.error(data.error);
                        }
                    }
                });
            });
            $(document).on('click', '.flutter_wave_btn', function (e) {
                $('.fw_form').submit();
            });
            $(document).on('click', '.jazz_cash_btn', function (e) {
                $('.jsform').submit();
            });
            $(document).on('click', '.paystack_btn', function (e) {
                let handler = PaystackPop.setup({
                    key: '{{ setting('paystack_public_key') }}',
                    email: "{{ auth()->user()->email }}",
                    amount: parseInt("{{ $gh_price }}"),
                    ref: '' + Math.floor((Math.random() * 1000000000) + 1),
                    currency: 'GHS',
                    onClose: function () {
                        toastr.error('Payment cancelled');
                    },
                    callback: function (response) {
                        let url = "{{ url("user/complete-order?trx_id=$trx_id") }}" + '&payment_type=paystack&ref=' + response.reference;
                        window.location.href = url;
                    }
                });

                handler.openIframe();
            });
            $(document).on('click','.offline_method_btn',function () {
                $('#offline_method_id').val(offline_method.id);
                $('#method_title').text(offline_method.lang_name);
                if(offline_method.lang_instructions) {
                    $('.instruction_header').removeClass('d-none');
                    $('.instructions').removeClass('d-none').html(offline_method.lang_instructions);
                } else {
                    $('.instruction_header').addClass('d-none');
                    $('.instructions').addClass('d-none');
                }
                $('#offline_method_modal').modal('show');
            });
        });
    </script>
@endpush
