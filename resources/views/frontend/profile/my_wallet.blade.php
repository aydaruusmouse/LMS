@extends('frontend.layouts.master')
@section('title', __('my_wallet'))
@section('content')
    <section class="my-balance-section p-t-50 p-b-80 p-b-sm-50 p-t-sm-30">
        <div class="container container-1278">
            <div class="row">
                @include('frontend.profile.sidebar')
                <div class="col-md-8">
                    <div class="my-balance-wrapper">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title-v3 color-dark m-b-40 m-b-sm-15">
                                    <h3>{{__('my_wallet')}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="balance-wrap">
                            <div class="balance-box m-b-30 m-b-sm-15">
                                <div class="balance-box-content">
                                    <h6>{{__('available_wallet')}}</h6>
                                    <p>{{__('anytime_change_your_amount')}}</p>
                                </div>
                                <div class="balance-amount">
                                    <h4>{{ get_price(auth()->user()->balance, userCurrency()) }}</h4>
                                </div>
                            </div>
                            <div class="balance-box m-b-30 m-b-sm-15">
                                <div class="balance-box-content">
                                    <h6>{{__('recharge_your_wallet')}}</h6>
                                </div>
                                <div class="balance-amount">
                                    <a href="#" data-bs-target="#wallet_modal" data-bs-toggle="modal"
                                       class="template-btn">{{__('recharge')}}</a>
                                </div>
                            </div>
                        </div>
                        <h6 class="border-bottom-soft-white p-b-10 fw-semibold p-t-20 p-t-sm-30 m-b-15">{{__('payment_history')}}</h6>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('title') }}</th>
                                    <th>{{ __('date') }}</th>
                                    <th>{{__('transaction_id') }}</th>
                                    <th>{{ __('payment_type') }}</th>
                                    <th>{{ __('total') }}</th>
                                    <th>{{ __('status') }}</th>
                                </tr>
                                </thead>
                                <tbody class="border-top-0 wallet_table">
                                @forelse ($wallets as $key=> $wallet)
                                    @include('frontend.profile.components.wallet')
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-danger">{{__('no_data_found')}}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($wallets->nextPageUrl())
                            <div class="m-t-20 text-center">
                                <a href="javascript:void(0)" data-page="{{ $wallets->currentPage() }}"
                                   data-url="{{ route('wallet') }}"
                                   class="template-btn load_more">{{__('more_history')}}</a>
                                @include('components.frontend_loading_btn', ['class' => 'template-btn see-more'])
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="modal window-load-modal fade" id="wallet_modal" tabindex="-1" aria-labelledby="windowLoadModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header mb-3">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('wallet_recharge') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row align-items-xl-center justify-content-center">
                            <div class="col-lg-12 mb-3">
                                <form method="post" action="#" class="user-form wallet_form"
                                      enctype="multipart/form-data">
                                    <label for="amount">{{ __('amount') }}</label>
                                    <input type="text" class="form-control" name="amount" id="amount"
                                           placeholder="e.g.100">
                                </form>
                            </div>
                            <div class="col-lg-12">
                                <div class="row payment-methods-list pg_block">
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
                                                <input type="radio" name="payment_type" value="sslcommerz"
                                                       id="sslcommerz">
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
                                                    <img src="{{ static_asset('images/payment-icon/bKash.svg') }}"
                                                         alt="bKash">
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
                                                <input type="radio" name="payment_type" value="razor_pay"
                                                       id="razor_pay">
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
                                                <input type="radio" name="payment_type" value="flutter_wave"
                                                       id="flutter_wave">
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
                                                <input type="radio" name="payment_type" id="google_pay"
                                                       value="google_pay">
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
                                                <input type="radio" name="payment_type" id="mercadopago"
                                                       value="mercadopago">
                                                <label for="mercadopago">
                                                    <img
                                                        src="{{ static_asset('images/payment-icon/mercado-pago.svg') }}"
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
                                                <input type="radio" name="payment_type" id="jazz_cash"
                                                       value="jazz_cash">
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
                                                <input type="radio" name="payment_type" value="mid_trans"
                                                       id="mid_trans">
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
                                                    <img src="{{ static_asset('images/payment-icon/telr.svg') }}"
                                                         alt="telr">
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
                                                <input type="radio" name="payment_type" value="uddokta_pay"
                                                       id="uddokta_pay">
                                                <label for="uddokta_pay">
                                                    <img src="{{ static_asset('images/payment-icon/uddokta_pay.svg') }}"
                                                         alt="KKiaPay">
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                    @foreach($offline_methods as $offline_method)
                                        <div class="col-lg-3 col-md-3 col-4">
                                            <div class="payment-methods-item">
                                                <input type="radio" name="payment_type"
                                                       data-id="{{ $offline_method->id }}"
                                                       data-name="{{ $offline_method->lang_name }}"
                                                       data-instructions="{{ $offline_method->lang_instructions }}"
                                                       value="offline_method"
                                                       id="offline_method_{{ $offline_method->id }}">
                                                <label for="offline_method_{{ $offline_method->id }}">
                                                    <img src="{{ getFileLink('147x80',$offline_method->image) }}"
                                                         alt="{{ $offline_method->lang_name }}">
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-lg-12 text-center">
                                        @include('components.frontend_loading_btn', ['class' => 'template-btn','type' => 'a'])
                                        <a href="#" class="template-btn pay_btn disable_a">{{__('recharge_now')}}</a>
                                        @if(setting('is_paypal_activated'))
                                            <div class="row">
                                                <div class="colg-lg-5">
                                                    <div class="mx-auto w_40 payment_btns d-none paypal_btn"
                                                         id="paypal-button-container"></div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(setting('is_jazz_cash_activated'))
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
            <input type="hidden" name="tx_ref" value="{{ $trx_id }}"/>
            <input type="hidden" name="amount" class="fw_amount"/>
            <input type="hidden" name="currency" value="NGN"/>
            <input type="hidden" name="redirect_url" class="fw_redirect_url"/>
            <input type="hidden" name="meta[token]" value="{{ $trx_id }}"/>
            <input type="hidden" name="customer[name]" value="{{ auth()->user()->name }}"/>
            <input type="hidden" name="customer[email]" value="{{ auth()->user()->email }}"/>
        </form>
    @endif
    <input type="hidden" class="total_amount" value="">
    <input type="hidden" class="trx_id" value="{{ $trx_id }}">
    <input type="hidden" class="url" value="{{ url('/') }}">
    <input type="hidden" class="auth_user" value="{{ auth()->user() }}">
    <input type="hidden" class="is_sslcommerz_sandbox_mode_activated"
           value="{{ setting('is_sslcommerz_sandbox_mode_activated') == 1 }}">
    <input type="hidden" id="stripe_key" value="{{ setting('stripe_key') }}">
    <div class="modal window-load-modal fade" id="offline_method_modal" tabindex="-1"
         aria-labelledby="windowLoadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('pay_with_offline') }} - <span class="offline_method_name"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('recharge.wallet') }}" method="POST" class="ajax_form">@csrf
                    <div class="modal-body mt-4">
                        <input type="hidden" name="trx_id" value="{{ $trx_id }}">
                        <input type="hidden" name="payment_type" value="offline_method">
                        <input type="hidden" name="amount" class="amount" value="">
                        <input type="hidden" name="offline_method_id" class="offline_method_id" value="">
                        <input type="file" name="offline_method_file" id="chooseFile">
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
@endsection
@push('js')
    <script>
        window.url = '';
        window.base_url = $('.url').val();
        window.amount = $('#amount').val();
        window.trx_id = $('.trx_id').val();
        window.code = $('.code').val();
        window.user = $('.auth_user').val();
        window.ssl_sandobx_activated = $('.is_sslcommerz_sandbox_mode_activated').val();
        window.is_wallet = 1;
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
        <script src="https://cdn.kkiapay.me/k.js"></script>
    @endif
    @if(setting('is_mid_trans_activated'))
        <script src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ setting('mid_trans_client_id') }}"></script>
    @endif
    <script>
        $(document).ready(function () {
            $(document).on('click', '.load_more', function () {
                let that = this;
                let page = parseInt($(this).data('page')) + 1;
                let url = $(this).data('url');
                let selector = $(this).closest('div');
                $(that).addClass('d-none');
                $(selector).find('.loading_button').removeClass('d-none');
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        page: page,
                    },
                    success: function (data) {
                        $('.wallet_table').append(data.html);
                        $(that).data('page', page);
                        if (data.next_page) {
                            $(selector).find('.loading_button').addClass('d-none');
                            $(that).removeClass('d-none');
                        } else {
                            $(selector).find('.loading_button').addClass('d-none');
                            $(that).addClass('d-none');
                        }
                    }
                });
            });
            $(document).on('keyup', '#amount', function () {
                let amount = $(this).val();
                if (amount > 0) {
                    $('.payment-methods-list').removeClass('pg_block');
                } else {
                    $('.payment-methods-list').addClass('pg_block');
                }
                window.amount = $('#amount').val();
            });
            $(document).on('change', 'input[name="payment_type"]', function () {
                let val = $(this).val();
                let pay_btn = $('.pay_btn');
                let trx_id = $('.trx_id').val();
                let amount = $('#amount').val();
                let type = 'wallet';
                let url = '';
                let query_parameters = `?trx_id=${trx_id}&payment_type=${val}&amount=${amount}&type=${type}`;
                pay_btn.removeClass('disable_a');
                if (val == 'paypal') {
                    $('.paypal_btn').removeClass('d-none');
                    pay_btn.addClass('d-none');
                }
                if (val == 'stripe') {
                    url = "{{ route('stripe.redirect') }}" + query_parameters;
                }
                if (val == 'mollie') {
                    url = "{{ route('mollie.redirect') }}" + query_parameters;
                }
                if (val == 'skrill') {
                    url = "{{ route('skrill.redirect') }}" + query_parameters;
                }
                if (val == 'sslcommerz') {
                    url = "{{ route('sslcommerze.redirect') }}" + query_parameters;
                }
                if (val == 'bKash') {
                    url = "{{ route('bkash.redirect') }}" + query_parameters;
                }
                if (val == 'nagad') {
                    url = "{{ route('nagad.redirect') }}" + query_parameters;
                }
                if (val == 'aamarpay') {
                    url = "{{ route('aamarpay.redirect') }}" + query_parameters;
                }
                if (val == 'paytm') {
                    url = "{{ route('paytm.redirect') }}" + query_parameters;
                }
                if (val == 'mercadopago') {
                    url = "{{ route('mercadoPago.redirect') }}" + query_parameters;
                }
                if (val == 'mid_trans') {
                    url = "{{ route('midtrans.redirect') }}" + query_parameters;
                }
                if (val == 'iyzico') {
                    url = "{{ route('iyzico.redirect') }}" + query_parameters;
                }
                if (val == 'hitpay') {
                    url = "{{ route('hitpay.redirect') }}" + query_parameters;
                }
                if (val == 'uddokta_pay') {
                    url = "{{ route('uddokta.pay.redirect') }}" + query_parameters;
                } else {
                    $('.paypal_btn').addClass('d-none');
                    pay_btn.removeClass('d-none');
                }

                if (url) {
                    pay_btn.attr('href', url);
                } else {
                    pay_btn.attr('href', 'javascript:void(0)');
                }
            });
            $(document).on('click', '.pay_btn', function (e) {
                let selector = $('input[name="payment_type"]:checked');
                let val = selector.val();
                let pay_btn = $('.pay_btn');
                let trx_id = $('.trx_id').val();
                let amount = $('#amount').val();
                let type = 'wallet';
            /*    let url = '';
                let query_parameters = `?trx_id=${trx_id}&payment_type=${val}&amount=${amount}&type=${type}`;*/
                pay_btn.removeClass('disable_a');
                if (val == 'razor_pay') {
                    $('.paypal_btn').addClass('d-none');
                    pay_btn.addClass('d-none');
                    $(this).addClass('d-none');
                    $('.loading_button').removeClass('d-none');
                    $.ajax({
                        url: "{{ route('razorpay.redirect') }}",
                        type: "GET",
                        data: {
                            _token: "{{ csrf_token() }}",
                            trx_id: trx_id,
                            payment_type: 'razor_pay',
                            amount: amount,
                            type: type,
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
                } else if (val == 'flutter_wave' || val == 'paystack') {
                    $(this).addClass('d-none');
                    $('.loading_button').removeClass('d-none');
                    $.ajax({
                        url: "{{ route('process.pg') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            trx_id: trx_id,
                            payment_type: val,
                            amount: amount,
                            type: type,
                            currency: val == 'paystack' ? 'GHS' : 'NGN',
                        },
                        success: function (data) {
                            $('.pay_btn').removeClass('d-none');
                            $('.loading_button').addClass('d-none');
                            if (data.success) {
                                if (val == 'paystack') {
                                    let handler = PaystackPop.setup({
                                        key: '{{ setting('paystack_public_key') }}',
                                        email: "{{ auth()->user()->email }}",
                                        amount: data.amount,
                                        ref: '' + Math.floor((Math.random() * 1000000000) + 1),
                                        currency: 'GHS',
                                        onClose: function () {
                                            toastr.error('Payment cancelled');
                                        },
                                        callback: function (response) {
                                            let url = `${data.url}&ref=${response.reference}`;
                                            window.location.href = url;
                                        }
                                    });

                                    handler.openIframe();
                                } else {
                                    $('.fw_amount').val(data.amount);
                                    $('.fw_redirect_url').val(data.url);
                                    $('.fw_form').submit();
                                }
                            } else {
                                toastr.error(data.error);
                            }
                        }
                    });
                } else if (val == 'jazz_cash') {
                    $('.jsform').submit();
                } else if (val == 'kkiapay') {
                    $(this).addClass('d-none');
                    $('.loading_button').removeClass('d-none');
                    $.ajax({
                        url: "{{ route('process.pg') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            trx_id: trx_id,
                            payment_type: val,
                            amount: amount,
                            type: type,
                            currency: 'XOF',
                        },
                        success: function (data) {
                            $('.pay_btn').removeClass('d-none');
                            $('.loading_button').addClass('d-none');
                            if (data.success) {
                                openKkiapayWidget({
                                    amount: data.amount,
                                    position: "center",
                                    callback: data.url,
                                    sandbox: "{{ setting('is_kkiapay_sandbox_enabled') ? "true" : "false" }}",
                                    theme: "{{ setting('primary_color') }}",
                                    key: "{{ setting('kkiapay_public_api_key') }}"
                                });
                            } else {
                                toastr.error(data.error);
                            }
                        }
                    });
                }
                else if(val == 'offline_method')
                {
                    let id = selector.data('id');
                    let name = selector.data('name');
                    let instructions = selector.data('instructions');
                    $('.offline_method_name').text(name);
                    if(instructions) {
                        $('.instruction_header').removeClass('d-none');
                        $('.instructions').removeClass('d-none').html(instructions);
                    } else {
                        $('.instruction_header').addClass('d-none');
                        $('.instructions').addClass('d-none');
                    }
                    $('.offline_method_id').val(id);
                    $('#offline_method_modal .amount').val(amount);
                    $('#offline_method_modal').modal('show');
                }
            });
        });
    </script>
@endpush
