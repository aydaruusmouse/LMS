<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PGRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'aamrapay_store_id'              => 'required_if:payment_method,aamarpay',
            'aamarpay_signature_key'         => 'required_if:payment_method,aamarpay',
            'bkash_app_secret'               => 'required_if:payment_method,bkash',
            'bkash_username'                 => 'required_if:payment_method,bkash',
            'bkash_password'                 => 'required_if:payment_method,bkash',
            'app_key'                        => 'required_if:payment_method,bkash',
            'flutterwave_secret_key'         => 'required_if:payment_method,fw',
            'flutterwave_public_key'         => 'required_if:payment_method,fw',
            'google_pay_merchant_id'         => 'required_if:payment_method,google_pay',
            'google_pay_merchant_name'       => 'required_if:payment_method,google_pay',
            'google_pay_gateway'             => 'required_if:payment_method,google_pay',
            'google_pay_gateway_merchant_id' => 'required_if:payment_method,google_pay',
            'hitpay_api_key'                 => 'required_if:payment_method,hitpay',
            'iyzico_secret_key'              => 'required_if:payment_method,iyzico',
            'iyzico_api_key'                 => 'required_if:payment_method,iyzico',
            'jazz_cash_merchant_id'          => 'required_if:payment_method,jazz_cash',
            'jazz_cash_password'             => 'required_if:payment_method,jazz_cash',
            'jazz_cash_integrity_salt'       => 'required_if:payment_method,jazz_cash',
            'kkiapay_public_api_key'         => 'required_if:payment_method,kkiapay',
            'kkiapay_private_api_key'        => 'required_if:payment_method,kkiapay',
            'kkiapay_secret'                 => 'required_if:payment_method,kkiapay',
            'mercadopago_access_key'         => 'required_if:payment_method,mercado_pago',
            'mercadopago_key'                => 'required_if:payment_method,mercado_pago',
            'mid_trans_client_id'            => 'required_if:payment_method,midtrans',
            'mid_trans_server_key'           => 'required_if:payment_method,midtrans',
            'mollie_api_key'                 => 'required_if:payment_method,mollie',
            'nagad_mode'                     => 'required_if:payment_method,nagad',
            'nagad_merchant_id'              => 'required_if:payment_method,nagad',
            'nagad_merchant_no'              => 'required_if:payment_method,nagad',
            'nagad_public_key'               => 'required_if:payment_method,nagad',
            'nagad_private_key'              => 'required_if:payment_method,nagad',
            'paypal_client_id'               => 'required_if:payment_method,paypal',
            'paystack_secret_key'            => 'required_if:payment_method,paystack',
            'paystack_public_key'            => 'required_if:payment_method,paystack',
            'merchant_id'                    => 'required_if:payment_method,paytm',
            'merchant_key'                   => 'required_if:payment_method,paytm',
            'merchant_website'               => 'required_if:payment_method,paytm',
            'channel'                        => 'required_if:payment_method,paytm',
            'industry_type'                  => 'required_if:payment_method,paytm',
            'razorpay_key'                   => 'required_if:payment_method,razorpay',
            'razorpay_secret'                => 'required_if:payment_method,razorpay',
            'skrill_merchant_email'          => 'required_if:payment_method,skrill',
            'sslcommerz_id'                  => 'required_if:payment_method,sslcommerz',
            'sslcommerz_password'            => 'required_if:payment_method,sslcommerz',
            'stripe_key'                     => 'required_if:payment_method,stripe',
            'stripe_secret'                  => 'required_if:payment_method,stripe',
            'telr_store_id'                  => 'required_if:payment_method,telr',
            'telr_auth_key'                  => 'required_if:payment_method,telr',
            'uddokta_pay_api_key'            => 'required_if:payment_method,uddokta_pay',
        ];
    }
}
