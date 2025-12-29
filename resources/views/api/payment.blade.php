<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Method</title>
    <link href="{{ static_asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ static_asset('frontend/css/toastr.min.css') }}">
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        h1, h2, h3, h4, h5, h6, p {
            margin: 0;
            padding: 0;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        ul li {
            list-style: none;
        }

        a,
        a:focus {
            text-decoration: none;
            outline: 0;
        }


        button,
        input,
        optgroup,
        select,
        textarea {
            color: inherit;
            font: inherit;
            margin: 0;
        }

        .payment-list .input-checkbox input[type="radio"] {
            display: none;
        }

        .payment-list .input-checkbox input[type="radio" i] {
            background-color: initial;
            cursor: default;
            appearance: auto;
            box-sizing: border-box;
            margin: 3px 3px 0px 5px;
            padding: initial;
            border: initial;
        }

        .payment-list .input-checkbox input {
            line-height: normal;
        }

        .payment-list .input-checkbox input[type="checkbox"], .input-checkbox input[type="radio"] {
            box-sizing: border-box;
            padding: 0;
        }

        .payment-list .input-checkbox input[type="radio"]:checked + label {
            border-color: rgba(35, 164, 98, 0.2);
            background-color: rgba(35, 164, 98, 0.06);;
        }

        .payment-list .input-checkbox input[type="radio"] + label {
            cursor: pointer;
            width: 100%;
            height: 60px;
            border: 1px solid #F6F6F6;
            /* border: 1px solid #F6F6F6; */
            padding: 6px;
            border-radius: 6px;
            align-items: center;
            justify-content: center;
        }

        .payment-list li label {
            display: flex;
            font-weight: 600;
            font-size: 12px !important;
            line-height: 20px;
        }

        .payment-list label {
            font-size: 16px !important;
            color: #000;
        }

        .payment-list li label img {
            /* width: 80px;
            height: 40px;
            margin-inline-end: 10px; */
        }

        ul.payment-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 15px;
            max-height: 50vh;
        }

        ul.payment-list li {
            width: 49.4%;
        }

        .order-summary {
            position: fixed;
            bottom: 30px;
            width: 67%;
        }

        .order-summary h6 {
            font-weight: 600;
            font-size: 14px;
            line-height: 14px;
            margin-bottom: 15px;
        }

        .sg-card {
            padding: 15px;
            border: 1px solid #F6F6F6;
            border-radius: 6px;
        }

        .sg-card ul li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .sg-card .sub-title,
        .sg-card .price {
            font-size: 12px;
            font-weight: 400;
            line-height: 12px;
        }

        .order-total {
            border-top: 1px solid #F6F6F6;
            padding-top: 15px;
        }

        .order-total p {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-total p,
        .order-total span.price {
            font-size: 12px;
            font-weight: 600;
        }

        a.submit-btn {
            width: 100%;
            background: #23A462;
            display: block;
            text-align: center;
            padding: 16px 0;
            border-radius: 6PX;
            margin-top: 40px;
            color: #fff;
            line-height: 12px;
            font-size: 12px;
            font-weight: 500;
            text-transform: capitalize;
        }

        .simplebar {
            overflow-y: auto;
            overflow-x: hidden;
        }

        .simplebar::-webkit-scrollbar {
            width: 5px;
        }

        .simplebar::-webkit-scrollbar-track {
            box-shadow: none;
            background-color: #556068;
            border-radius: 4px;
        }

        .simplebar::-webkit-scrollbar-thumb {
            background-color: #bfbfbf;
            border-radius: 4px;
            transition: background-color .5s ease;
        }

        .img-fluid {
            max-width: 80%;
        }

        @media (min-width: 767px) and (max-width: 991px) {
            ul.payment-list li {
                width: 48.7%;
            }

            .order-summary {
                width: 76%;
                /* width: 85%; */
            }
        }

        @media (max-width: 425px) {
            ul.payment-list li {
                width: 47.8%;
            }

            .order-summary {
                width: 93.7%;
            }
        }
    </style>
</head>
<body>
<section class="payment-method">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="payment-list simplebar">
                    @if(setting('is_paypal_activated') == 1 && setting('paypal_client_id'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="paypal" id="paypal" name="payment">
                                <label for="paypal">
                                    <img src="{{ static_asset('images/payment-icon/paypal.svg') }}" alt="paypal"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_stripe_activated') == 1 && setting('stripe_key') && setting('stripe_secret'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="stripe" id="stripe" name="payment">
                                <label for="stripe">
                                    <img src="{{ static_asset('images/payment-icon/stripe.svg') }}" alt="stripe"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_mollie_activated') == 1 && setting('mollie_api_key'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="mollie" id="mollie" name="payment">
                                <label for="mollie">
                                    <img src="{{ static_asset('images/payment-icon/mollie.svg') }}" alt="mollie"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_skrill_activated') == 1 && setting('skrill_merchant_email'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="skrill" id="skrill" name="payment">
                                <label for="skrill">
                                    <img src="{{ static_asset('images/payment-icon/skrill.svg') }}" alt="mollie"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_sslcommerz_activated') == 1 && setting('sslcommerz_id') && setting('sslcommerz_password'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="sslcommerze" id="sslcommerze" name="payment">
                                <label for="sslcommerze">
                                    <img src="{{ static_asset('images/payment-icon/sslcommerze.svg') }}"
                                         alt="sslcommerze"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_bkash_activated') == 1 && setting('app_key') && setting('bkash_app_secret') && setting('bkash_username') && setting('bkash_password'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="bkash" id="bkash" name="payment">
                                <label for="bkash">
                                    <img src="{{ static_asset('images/payment-icon/bkash.svg') }}" alt="bkash"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_nagad_activated') == 1 && setting('nagad_merchant_id') && setting('nagad_mode') && setting('nagad_merchant_no') && setting('nagad_public_key') && setting('nagad_private_key'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="nagad" id="nagad" name="payment">
                                <label for="nagad">
                                    <img src="{{ static_asset('images/payment-icon/nagad.svg') }}" alt="nagad"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_aamarpay_activated') == 1 && setting('aamrapay_store_id')  && setting('aamarpay_signature_key'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="aamarpay" id="aamarpay" name="payment">
                                <label for="aamarpay">
                                    <img src="{{ static_asset('images/payment-icon/aamarpay.svg') }}" alt="aamarpay"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_paytm_activated') == 1 && setting('merchant_id') && setting('merchant_key') && setting('merchant_website') && setting('channel') && setting('industry_type'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="paytm" id="paytm" name="payment">
                                <label for="paytm">
                                    <img src="{{ static_asset('images/payment-icon/paytm.svg') }}" alt="paytm"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_razorpay_activated') == 1 && setting('razorpay_key') && setting('razorpay_secret'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="razor_pay" id="razor_pay" name="payment">
                                <label for="razor_pay">
                                    <img src="{{ static_asset('images/payment-icon/razorpay.svg') }}" alt="razor_pay"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_flutterwave_activated') == 1 && setting('flutterwave_secret_key') && setting('flutterwave_public_key'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="flutter_wave" id="flutter_wave" name="payment">
                                <label for="fw">
                                    <img src="{{ static_asset('images/payment-icon/fw.svg') }}" alt="flutter_wave"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_paystack_activated') == 1 && setting('paystack_secret_key') && setting('paystack_public_key'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="paystack" id="paystack" name="payment">
                                <label for="paystack">
                                    <img src="{{ static_asset('images/payment-icon/paystack.svg') }}" alt="paystack"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_google_pay_activated') == 1 && setting('google_pay_merchant_id') && setting('google_pay_merchant_name') && setting('google_pay_gateway') && setting('google_pay_gateway_merchant_id'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="google_pay" id="google_pay" name="payment">
                                <label for="google_pay">
                                    <img src="{{ static_asset('images/payment-icon/google_pay.svg') }}" alt="google_pay"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_mercado_pago_activated') == 1 && setting('mercadopago_access_key') && setting('mercadopago_key'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="mercadopago" id="mercadopago" name="payment">
                                <label for="mercado_pago">
                                    <img src="{{ static_asset('images/payment-icon/mercado-pago.svg') }}"
                                         alt="mercadopago"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_kkiapay_activated') == 1 && setting('kkiapay_public_api_key') && setting('kkiapay_private_api_key') && setting('kkiapay_secret'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="kkiapay" id="kkiapay" name="payment">
                                <label for="kkiapay">
                                    <img src="{{ static_asset('images/payment-icon/kkiapay.svg') }}" alt="kkiapay"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_jazz_cash_activated') == 1 && setting('jazz_cash_merchant_id'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="jazz_cash" id="jazz_cash" name="payment">
                                <label for="jazz_cash">
                                    <img src="{{ static_asset('images/payment-icon/JazzCash.svg') }}" alt="jazz_cash"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_mid_trans_activated') == 1 && setting('mid_trans_client_id') && setting('mid_trans_server_key'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="mid_trans" id="mid_trans" name="payment">
                                <label for="midtrans">
                                    <img src="{{ static_asset('images/payment-icon/midtrans.svg') }}" alt="mid_trans"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_telr_activated') == 1 && setting('telr_store_id') && setting('telr_auth_key'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="telr" id="telr" name="payment">
                                <label for="telr">
                                    <img src="{{ static_asset('images/payment-icon/telr.svg') }}" alt="telr"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_iyzico_activated') == 1 && setting('iyzico_secret_key'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="iyzico" id="iyzico" name="payment">
                                <label for="iyzico">
                                    <img src="{{ static_asset('images/payment-icon/iyzico.svg') }}" alt="iyzico"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_hitpay_activated') == 1 && setting('hitpay_api_key'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" value="hitpay" id="hitpay" name="payment">
                                <label for="hitpay">
                                    <img src="{{ static_asset('images/payment-icon/hitpay.svg') }}" alt="hitpay"
                                         class="img-fluid">
                                </label>
                            </div>
                        </li>
                    @endif
                    @if(setting('is_uddokta_pay_activated'))
                        <li>
                            <div class="input-checkbox">
                                <input type="radio" name="payment_type" value="uddokta_pay" id="uddokta_pay">
                                <label for="uddokta_pay">
                                    <img src="{{ static_asset('images/payment-icon/uddokta_pay.svg') }}"
                                         alt="uddokta_pay">
                                </label>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
            @php
                $action_url = url('api/complete-order');
            @endphp
            <div class="col-lg-12">
                <div class="summary-position">
                    <div class="order-summary">
                        <h6>{{ __('price_details') }}</h6>
                        <div class="sg-card">
                            <ul>
                                <li>
                                    <span class="sub-title">{{ __('sub_total') }}</span>
                                    <span class="price">{{ get_price($user_carts->sum('sub_total'),$currency_code) }}</span>
                                </li>
                                <li>
                                    <span class="sub-title">{{ __('discount') }}</span>
                                    <span
                                        class="price">{{ get_price($user_carts->sum('discount'),$currency_code) }}</span>
                                </li>
                                @if(setting('coupon_system'))
                                    <li>
                                        <span class="sub-title">{{ __('coupon') }}</span>
                                        <span class="price">{{ get_price($coupons->sum('coupon_discount'),$currency_code) }}</span>
                                    </li>
                                @endif
                            </ul>
                            <div class="order-total">
                                <p>
                                    <span class="title">{{ __('total') }}</span>
                                    <span class="price">{{ get_price($user_carts->sum('total_amount')  - $total_discount,$currency_code) }}</span>
                                </p>
                            </div>
                        </div>

                        <a href="#" class="submit-btn payment_btns">{{ __('proceed') }}</a>
                        @if(setting('is_paypal_activated'))
                            <div class="mx-auto w_40 payment_btns d-none paypal_btn"
                                 id="paypal-button-container"></div>
                        @endif
                        <div class="div_btns d-none">
                            @if(setting('is_stripe_activated'))
                                <a href="{{ route('stripe.redirect',['trx_id' => $trx_id,'payment_type' => 'stripe','payment_mode' => 'api','token' => $token]) }}"
                                   class="submit-btn d-block text-center payment_btns stripe_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_uddokta_pay_activated'))
                                <a href="{{ route('uddokta.pay.redirect',['trx_id' => $trx_id,'payment_type' => 'uddokta_pay','payment_mode' => 'api','token' => $token]) }}"
                                   class="submit-btn d-block text-center payment_btns uddokta_pay_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_sslcommerz_activated'))
                                <a href="{{ route('sslcommerze.redirect',['trx_id' => $trx_id,'payment_type' => 'sslcommerze','payment_mode' => 'api','token' => $token]) }}"
                                   class="submit-btn d-block text-center payment_btns sslcommerze_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_mollie_activated'))
                                <a href="{{ route('mollie.redirect',['trx_id' => $trx_id,'payment_type' => 'mollie','payment_mode' => 'api','token' => $token]) }}"
                                   class="submit-btn d-block text-center payment_btns mollie_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_skrill_activated'))
                                <a href="{{ route('skrill.redirect',['trx_id' => $trx_id,'payment_type' => 'skrill','payment_mode' => 'api','token' => $token]) }}"
                                   class="submit-btn d-block text-center payment_btns skrill_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_bkash_activated'))
                                <a href="{{ route('bkash.redirect',['trx_id' => $trx_id,'payment_type' => 'bKash','payment_mode' => 'api','token' => $token]) }}"
                                   class="submit-btn d-block text-center payment_btns bKash_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_nagad_activated'))
                                <a href="{{ route('nagad.redirect',['trx_id' => $trx_id,'payment_type' => 'nagad','payment_mode' => 'api','token' => $token]) }}"
                                   class="submit-btn d-block text-center payment_btns nagad_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_aamarpay_activated'))
                                <a href="{{ route('aamarpay.redirect',['trx_id' => $trx_id,'payment_type' => 'aamarpay','payment_mode' => 'api','token' => $token]) }}"
                                   class="submit-btn d-block text-center payment_btns aamarpay_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_paytm_activated'))
                                <a href="{{ route('paytm.redirect',['trx_id' => $trx_id,'payment_type' => 'paytm','payment_mode' => 'api','token' => $token]) }}"
                                   class="submit-btn d-block text-center payment_btns paytm_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_razorpay_activated'))
                                <a href="javascript:void(0)"
                                   class="submit-btn d-block text-center payment_btns razor_pay_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_flutterwave_activated'))
                                <a href="javascript:void(0)"
                                   class="submit-btn d-block text-center payment_btns flutter_wave_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_paystack_activated'))
                                <a href="javascript:void(0)"
                                   class="submit-btn d-block text-center payment_btns paystack_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_mercado_pago_activated'))
                                <a href="{{ route('mercadoPago.redirect',['trx_id' => $trx_id,'payment_type' => 'mercadopago','payment_mode' => 'api','token' => $token]) }}"
                                   class="submit-btn d-block text-center payment_btns mercadopago_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_kkiapay_activated'))
                                <a href="javascript:void(0)"
                                   class="submit-btn d-block text-center payment_btns kkiapay_btn kkiapay-button">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_mid_trans_activated'))
                                <a href="{{ route('midtrans.redirect',['trx_id' => $trx_id,'payment_type' => 'mid_trans','payment_mode' => 'api','token' => $token]) }}"
                                   class="submit-btn d-block text-center payment_btns mid_trans_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_telr_activated'))
                                <a href="{{ route('telr.redirect',['trx_id' => $trx_id,'payment_type' => 'telr','payment_mode' => 'api','token' => $token]) }}"
                                   class="submit-btn d-block text-center payment_btns telr_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_hitpay_activated'))
                                <a href="{{ route('hitpay.redirect',['trx_id' => $trx_id,'payment_type' => 'hitpay','payment_mode' => 'api','token' => $token]) }}"
                                   class="submit-btn d-block text-center payment_btns hitpay_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_hitpay_activated'))
                                <a href="{{ route('hitpay.redirect',['trx_id' => $trx_id,'payment_type' => 'hitpay','payment_mode' => 'api','token' => $token]) }}"
                                   class="submit-btn d-block text-center payment_btns hitpay_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_jazz_cash_activated'))
                                <a href="javascript:void(0)"
                                   class="submit-btn d-block text-center payment_btns jazz_cash_btn">{{ __('proceed') }}</a>
                            @endif
                            @if(setting('is_google_pay_activated'))
                                <a href="javascript:void(0)"
                                   class="submit-btn d-block text-center payment_btns google_pay_btn">{{ __('proceed') }}</a>
                            @endif
                            @include('components.frontend_loading_btn', ['class' => 'submit-btn','type' => 'a'])
                        </div>
                    </div>
                </div>
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
                   value="{{ url("api/complete-order?trx_id=$trx_id&payment_type=flutter_wave&payment_mode=api&token=$token") }}"/>
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
</section>
<script src="{{ static_asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ static_asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ static_asset('frontend/js/toastr.min.js') }}"></script>
{!! Toastr::message() !!}
<script>
    window.url = '';
    window.base_url = $('.url').val();
    window.amount = $('.total_amount').val();
    window.trx_id = $('.trx_id').val();
    window.token = '{{ $token }}';
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
            callback="{{ url("api/complete-order?trx_id=$trx_id&payment_type=kkiapay?payment_mode=api&token=$token") }}"></script>
@endif
@if(setting('is_mid_trans_activated'))
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ setting('mid_trans_client_id') }}"></script>
@endif
<script>
    $(document).ready(function () {
        $(document).on('change', 'input[name="payment"]', function () {
            let val = $(this).val();
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
                    payment_mode: 'api',
                    token: '{{ $token }}',
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
                    let url = "{{ url("api/complete-order?trx_id=$trx_id") }}" + '&payment_type=paystack&payment_mode=api&ref=' + response.reference + '&token={{ $token }}';
                    window.location.href = url;
                }
            });

            handler.openIframe();
        });

    });
</script>
</body>
</html>
