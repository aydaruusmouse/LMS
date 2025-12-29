@extends('backend.layouts.master')
@section('title', __('payment_methods'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{ __('payment_methods') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30 pt-sm-30">
                        <div class="row align-items-center g-20">
                            @include('backend.admin.system_setting.payment_gateways.paypal')
                            @include('backend.admin.system_setting.payment_gateways.stripe')
                            @include('backend.admin.system_setting.payment_gateways.mollie')
                            @include('backend.admin.system_setting.payment_gateways.skrill')
                            @include('backend.admin.system_setting.payment_gateways.ssl_commerze')
                            @include('backend.admin.system_setting.payment_gateways.bkash')
                            @include('backend.admin.system_setting.payment_gateways.nagad')
                            @include('backend.admin.system_setting.payment_gateways.aamarpay')
                            @include('backend.admin.system_setting.payment_gateways.paytm')
                            @include('backend.admin.system_setting.payment_gateways.razorpay')
                            @include('backend.admin.system_setting.payment_gateways.flutterwave')
                            @include('backend.admin.system_setting.payment_gateways.paystack')
{{--                            @include('backend.admin.system_setting.payment_gateways.google_pay')--}}
                            @include('backend.admin.system_setting.payment_gateways.mercado_pago')
                            @include('backend.admin.system_setting.payment_gateways.kkiapay')
                            @include('backend.admin.system_setting.payment_gateways.jazz_cash')
                            @include('backend.admin.system_setting.payment_gateways.mid_trans')
                            @include('backend.admin.system_setting.payment_gateways.telr')
                            @include('backend.admin.system_setting.payment_gateways.iyzico')
                            @include('backend.admin.system_setting.payment_gateways.hitpay')
                            @include('backend.admin.system_setting.payment_gateways.uddokta_pay')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
