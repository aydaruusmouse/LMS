<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\AppliedCoupon;
use App\Models\Country;
use App\Models\Course;
use App\Repositories\CartRepository;
use App\Repositories\CurrencyRepository;
use App\Repositories\OrderRepository;
use App\Traits\ApiReturnFormatTrait;
use App\Traits\PaymentTrait;
use App\Traits\PaytmChecksum;
use App\Traits\SendNotification;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use MercadoPago\Item;
use MercadoPago\Payer;
use MercadoPago\Preference;
use MercadoPago\SDK;
use Obydul\LaraSkrill\SkrillClient;
use Obydul\LaraSkrill\SkrillRequest;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Razorpay\Api\Api;
use Xenon\NagadApi\Base;
use Xenon\NagadApi\Helper;

class PaymentController extends Controller
{
    use ApiReturnFormatTrait, PaymentTrait, SendNotification;

    protected $orderRepository;

    protected $cartRepository;

    public function __construct(OrderRepository $orderRepository, CartRepository $cartRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->cartRepository  = $cartRepository;
    }

    public function findOrders($data)
    {
        $orders = $this->cartRepository->findCartsOrder(
            [
                'type'   => Course::class,
                'trx_id' => $data['trx_id'],
            ]
        );

        return $orders;
    }

    public function findAmount($data, $orders = null, $active_currency = null)
    {
        $amount = 0;
        if (arrayCheck('type', $data) && $data['type'] == 'wallet') {
            $amount = $data['amount'];
        } elseif ($orders && count($orders) > 0) {
            $coupon_discount = AppliedCoupon::where('trx_id', $orders->first()->trx_id)->where('user_id', auth()->id())->sum('coupon_discount');
            if ($active_currency) {
                $amount = ($orders->sum('total_amount') - $orders->sum('discount')) * $active_currency->exchange_rate;
            } else {
                $amount = $orders->sum('total_amount') - $coupon_discount;
            }
        }

        return $amount;
    }

    public function successUrl($request, $user = null, $amount = null): string|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Contracts\Foundation\Application
    {
        $url   = '';
        $token = $request->token;

        if ($request->type == 'wallet' && $user) {
            $url = URL::temporarySignedRoute('recharge.wallet', now()->addMinutes(5), [
                'user_id'      => $user->id,
                'total'        => $amount,
                'trx_id'       => $request->trx_id,
                'response'     => 'yes',
                'payment_type' => $request->payment_type,
                'token'        => $token,
            ]);
        } elseif (auth()->user() || $token) {
            if ($request->payment_mode == 'api') {
                $url = url("api/complete-order?trx_id=$request->trx_id&payment_type=$request->payment_type&token=$token&curr=$request->curr&paymentID=$request->paymentID");
            } else {
                $url = url("user/complete-order?trx_id=$request->trx_id&payment_type=$request->payment_type&paymentID=$request->paymentID");
            }
        }

        return $url;
    }

    public function findUser($data)
    {
        $user = null;
        if (arrayCheck('token', $data)) {
            try {
                $user = JWTAuth::parseToken()->authenticate();
            } catch (\Exception $e) {
                $user = '';
            }
        }
        if (! $user) {
            $user = auth()->user();
        }

        return $user;
    }

    public function tokenGenerator($data): string
    {
        if (arrayCheck('type', $data) && $data['type'] == 'wallet') {
            $trx_id = Str::random();
        } else {
            $trx_id = arrayCheck('trx_id', $data) ? $data['trx_id'] : '';
        }

        return $trx_id;
    }

    public function findSystemCountry(): string
    {
        $country = Country::find(setting('default_country'));
        if ($country) {
            $region = $country->iso3;
        } else {
            $region = 'USA';
        }

        return $region;
    }

    public function cancelUrl($request)
    {
        if ($request->type == 'wallet') {
            $url = url('wallet');
        } elseif ($request->payment_mode == 'api') {
            $url = url("api/complete-order?trx_id=$request->trx_id&code=$request->code&payment_type=$request->payment_type&token=$request->token&curr=$request->curr");
        } else {
            $url = url('checkout');
        }

        return $url;
    }

    protected function apiToken($data): string
    {
        return arrayCheck('token', $data) ? $data['token'] : '';
    }

    //pg redirects
    public function stripeRedirect(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $data            = $request->all();
            $orders          = $this->findOrders($data);
            $amount          = $this->findAmount($data, $orders);
            $success_url     = $this->successUrl($request, $this->findUser($data), $amount);
            $stripe_currency = 'usd';
            $us              = ['card'];

            $session_data    = [
                'payment_method_types'    => $us,
                'line_items'              => [
                    [
                        'price_data' => [
                            'currency'     => $stripe_currency,
                            'product_data' => [
                                'name' => 'Payment',
                            ],
                            'unit_amount'  => round($amount * 100),
                        ],
                        'quantity'   => 1,
                    ],
                ],
                'phone_number_collection' => [
                    'enabled' => 'true',
                ],
                'mode'                    => 'payment',
                'success_url'             => $success_url,
                'cancel_url'              => url()->previous(),
            ];
            $headers         = [
                'Authorization' => 'Basic '.base64_encode(setting('stripe_secret').':'),
                'Content-Type'  => 'application/x-www-form-urlencoded',
            ];

            $response        = httpRequest('https://api.stripe.com/v1/checkout/sessions', $session_data, $headers, true);
            session()->put('payment_intent', $response['payment_intent']);

            return redirect($response['url']);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function mollieRedirect(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $euro            = app('currencies')->where('code', 'EUR')->first();
            if (! $euro) {
                Toastr::error(__('euro_currency_not_found'));

                return back();
            }

            Mollie()->setApiKey(setting('mollie_api_key'));
            $data            = $request->all();
            $orders          = $this->findOrders($data);
            $find_amount     = $this->findAmount($data, $orders, $this->activeCurrencyCheck());
            $url             = $this->successUrl($request, auth()->user(), $find_amount);
            $active_currency = $this->activeCurrencyCheck();
            $amount          = $this->currencyAmountCalculator($orders, $data, $active_currency, $euro);

            $payment         = mollie()->payments()->create([
                'amount'      => [
                    'currency' => 'EUR', // Type of currency you want to send
                    'value'    => number_format($amount['total_amount'], 2, '.', ''), // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                'description' => __('payment_by').' '.setting('system_name'),
                'redirectUrl' => $url,
                'metadata'    => [
                    'order_id' => date('YmdHis'),
                ],
            ]);

            session()->put('id', $payment->id); // redirect customer to Mollie checkout page
            cache()->put('id', $payment->id); // redirect customer to Mollie checkout page

            return redirect($payment->getCheckoutUrl(), 303);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function skrillRedirect(Request $request)
    {
        try {
            $data                              = $request->all();
            $orders                            = $this->findOrders($data);
            $trx_id                            = $this->tokenGenerator($data);
            $amount                            = $this->findAmount($data, $orders);
            $success_url                       = $this->successUrl($request, $this->findUser($data), $amount);
            $skrilRequest                      = new SkrillRequest();
            $skrilRequest->pay_to_email        = setting('skrill_merchant_email'); // your merchant email
            $skrilRequest->return_url          = $success_url;
            $skrilRequest->cancel_url          = url()->previous();
            $skrilRequest->logo_url            = static_asset('frontend/img/logo.png'); // optional
            $skrilRequest->status_url          = $success_url;
            $skrilRequest->amount              = $amount;
            $skrilRequest->currency            = 'USD';
            $skrilRequest->language            = 'EN';
            $skrilRequest->country             = $this->findSystemCountry();
            $skrilRequest->prepare_only        = '1';
            $skrilRequest->merchant_fields     = 'site_name, customer_email';
            $skrilRequest->site_name           = setting('system_name');
            $skrilRequest->customer_email      = auth()->user()->email;
            $skrilRequest->detail1_description = "Product Sale for $trx_id";
            $skrilRequest->detail1_text        = "Product Sale for $trx_id";
            $skrilRequest->transaction_id      = date('YmdHis');

            $client                            = new SkrillClient($skrilRequest);
            $sid                               = $client->generateSID(); //return SESSION ID
            $jsonSID                           = json_decode($sid);

            if ($jsonSID != null && $jsonSID->code == 'BAD_REQUEST') {
                return $jsonSID->message;
            }
            $redirectUrl                       = $client->paymentRedirectUrl($sid); //return redirect url

            return redirect()->to($redirectUrl);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function sslRedirect(Request $request)
    {
        try {
            $bdt_currency                  = $this->getCurrency();

            if (! $bdt_currency) {
                return false;
            }

            if (setting('is_sslcommerz_sandbox_mode_activated') == 1) {
                config(['sslcommerz.apiDomain' => 'https://sandbox.sslcommerz.com']);
            } else {
                config(['sslcommerz.apiDomain' => 'https://securepay.sslcommerz.com']);
            }

            $data                          = $request->all();
            $request['payment_type']       = 'ssl_commerze';
            $orders                        = $this->findOrders($data);
            $active_currency               = $this->activeCurrencyCheck();
            $user                          = $this->findUser($data);
            $url                           = '';
            $amount                        = $this->currencyAmountCalculator($orders, $data, $active_currency, $bdt_currency);
            $post_data['total_amount']     = round($amount['total_amount']);
            $db_amount                     = $amount['db_amount'];
            $post_data['currency']         = 'BDT';
            $post_data['tran_id']          = date('YmdHis'); // tran_id must be unique
            // CUSTOMER INFORMATION
            $post_data['cus_name']         = 'cus_name';
            $post_data['cus_email']        = 'cus_email';
            $post_data['cus_add1']         = 'Customer Address';
            $post_data['cus_add2']         = '';
            $post_data['cus_city']         = '';
            $post_data['cus_state']        = '';
            $post_data['cus_postcode']     = '';
            $post_data['cus_country']      = 'Bangladesh';
            $post_data['cus_phone']        = 'cus_phone';
            $post_data['cus_fax']          = '';
            // SHIPMENT INFORMATION
            $post_data['ship_name']        = 'Store Test';
            $post_data['ship_add1']        = 'Dhaka';
            $post_data['ship_add2']        = 'Dhaka';
            $post_data['ship_city']        = 'Dhaka';
            $post_data['ship_state']       = 'Dhaka';
            $post_data['ship_postcode']    = '1000';
            $post_data['ship_phone']       = '';
            $post_data['ship_country']     = 'Bangladesh';
            $post_data['shipping_method']  = 'NO';
            $post_data['product_name']     = 'Computer';
            $post_data['product_category'] = 'Goods';
            $post_data['product_profile']  = 'physical-goods';
            config(['sslcommerz.success_url' => str_replace(url('/'), '', $this->successUrl($request, $user, $db_amount))]);
            config(['sslcommerz.cancel_url' => str_replace(url('/'), '', $this->cancelUrl($request))]);
            config(['sslcommerz.apiCredentials.store_id' => setting('sslcommerz_id')]);
            config(['sslcommerz.apiCredentials.store_password' => setting('sslcommerz_password')]);

            $sslc                          = new SslCommerzNotification();

            $response                      = $sslc->makePayment($post_data);

            if ($response) {
                $data = json_decode($response);
                $url  = $data->data;
            }
            if ($url) {
                return redirect($url);
            } else {
                Toastr::error(__('Ops! Something went wrong.'));

                return back();
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function bkashRedirect(Request $request): bool|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $bdt_currency            = $this->getCurrency();
            if (! $bdt_currency) {
                return false;
            }

            if (setting('is_bkash_sandbox_mode_activated') == 1) {
                $base_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized';
            } else {
                $base_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta/tokenized';
            }

            $data                    = $request->all();
            $request['payment_type'] = 'bKash';
            $orders                  = $this->findOrders($data);
            $active_currency         = $this->activeCurrencyCheck();
            $token                   = $this->apiToken($data);
            $trx_id                  = $this->tokenGenerator($data);
            $amount                  = $this->currencyAmountCalculator($orders, $data, $active_currency, $bdt_currency);
            $total_amount            = $amount['total_amount'];
            $request['lang']         = 'bn';
            $request['curr']         = 'BDT';
            $bkash_token             = $this->bKashTokenGenerator();

            if ($bkash_token) {
                $auth            = $bkash_token;
                session()->put('id_token', $auth);

                $requestbody     = [
                    'mode'                  => '0011',
                    'amount'                => round($total_amount, 2),
                    'currency'              => 'BDT',
                    'intent'                => 'sale',
                    'payerReference'        => 'Faculty',
                    'merchantInvoiceNumber' => date('YmdHis'),
                    'callbackURL'           => url("bkash/execute?trx_id=$trx_id&token=$token&lang=$request->lang&curr=$request->curr&payment_mode=$request->payment_mode&payment_type=bKash"),
                ];

                $headers         = [
                    'accept'        => 'application/json',
                    'content-type'  => 'application/json',
                    'Authorization' => $auth,
                    'X-APP-Key'     => setting('app_key'),
                ];
                $requestbodyJson = json_encode($requestbody);
                $response        = curlRequest("$base_url/checkout/create", $requestbodyJson, 'POST', $headers);

                return redirect($response->bkashURL);
            }
            Toastr::error(__('oops...Something Went Wrong'));

            return back();
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function bkashExecute(Request $request)
    {
        try {
            $data            = $request->all();
            $id              = $request->paymentID;
            $status          = $request->status;
            $auth            = session()->get('id_token');
            $active_currency = $this->activeCurrencyCheck();
            $bdt_currency    = $this->getCurrency();
            $user            = $this->findUser($request->all());
            $orders          = $this->findOrders($data);
            $amount          = $this->currencyAmountCalculator($orders, $data, $active_currency, $bdt_currency);
            $db_amount       = $amount['db_amount'];
            if (! $id || $status != 'success' || ! $auth) {
                return redirect($this->cancelUrl($request))->with(['error' => __('Something went wrong, please try again.')]);
            }

            return redirect($this->successUrl($request, $user, $db_amount));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function nagadRedirect(Request $request): bool|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $currency                = new CurrencyRepository();
        $bdt_currency            = $currency->currencyByCode('BDT');
        if (! $bdt_currency) {
            return false;
        }

        if (setting('is_nagad_sandbox_mode_activated') == 1) {
            $payment_mode = 'development';
        } else {
            $payment_mode = 'production';
        }

        $data                    = $request->all();
        $request['payment_type'] = 'NAGAD';
        $orders                  = $this->findOrders($data);
        $active_currency         = $this->activeCurrencyCheck();
        $token                   = $this->apiToken($data);
        $trx_id                  = $this->tokenGenerator($data);
        $amount                  = $this->currencyAmountCalculator($orders, $data, $active_currency, $bdt_currency);
        $total_amount            = $amount['total_amount'];

        $config                  = [
            'NAGAD_APP_ENV'                    => $payment_mode, //development|production
            'NAGAD_APP_LOG'                    => '1',
            'NAGAD_APP_ACCOUNT'                => setting('nagad_merchant_no'), //demo
            'NAGAD_APP_MERCHANTID'             => setting('nagad_merchant_id'), //demo
            'NAGAD_APP_MERCHANT_PRIVATE_KEY'   => setting('nagad_private_key'),
            'NAGAD_APP_MERCHANT_PG_PUBLIC_KEY' => setting('nagad_public_key'),
            'NAGAD_APP_TIMEZONE'               => 'Asia/Dhaka',
        ];

        $nagad                   = new Base($config, [
            'amount'           => round($total_amount, 2),
            'invoice'          => Helper::generateFakeInvoice(15, true),
            'merchantCallback' => url("nagad/callback?token=$token&trx_id=$trx_id"),
        ]);

        return redirect($nagad->payNow($nagad));
    }

    public function nagadVerify(Request $request, OrderRepository $order): \Illuminate\Http\JsonResponse|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $config   = [
            'NAGAD_APP_ENV'                    => 'development', //development|production
            'NAGAD_APP_LOG'                    => '1',
            'NAGAD_APP_ACCOUNT'                => setting('nagad_merchant_no'), //demo
            'NAGAD_APP_MERCHANTID'             => setting('nagad_merchant_id'), //demo
            'NAGAD_APP_MERCHANT_PRIVATE_KEY'   => setting('nagad_private_key'),
            'NAGAD_APP_MERCHANT_PG_PUBLIC_KEY' => setting('nagad_public_key'),
            'NAGAD_APP_TIMEZONE'               => 'Asia/Dhaka',
        ];
        $helper   = new Helper($config);
        $response = $helper->verifyPayment($request->payment_ref_id);

        if ($response && $response['statusCode'] == '000') {
            $data = [
                'merchantId'             => $response['merchantId'],
                'orderId'                => $response['orderId'],
                'paymentRefId'           => $response['paymentRefId'],
                'amount'                 => $response['amount'],
                'clientMobileNo'         => $response['clientMobileNo'],
                'merchantMobileNo'       => $response['merchantMobileNo'],
                'orderDateTime'          => $response['orderDateTime'],
                'issuerPaymentDateTime'  => $response['issuerPaymentDateTime'],
                'issuerPaymentRefNo'     => $response['issuerPaymentRefNo'],
                'additionalMerchantInfo' => $response['additionalMerchantInfo'],
                'status'                 => $response['status'],
                'statusCode'             => $response['statusCode'],
                'cancelIssuerDateTime'   => $response['cancelIssuerDateTime'],
                'cancelIssuerRefNo'      => $response['cancelIssuerRefNo'],
                'trx_id'                 => $request->trx_id,
                'payment_type'           => 'nagad',
                'guest'                  => auth()->user() ? 0 : 1,
            ];

            try {
                $order->completeOrder($data, auth()->user());
                $data = [
                    'success' => __('Order Completed'),
                ];

                DB::commit();

                if (request()->ajax()) {
                    return response()->json($data);
                } else {
                    if ($request->type == 'wallet') {
                        return redirect('wallet');
                    } else {
                        return redirect('user/invoice/'.session()->get('trx_id'));
                    }
                }
            } catch (\Exception $e) {
                DB::rollBack();
                session()->forget('trx_id');
                if (request()->ajax()) {
                    return response()->json([
                        'error' => $e->getMessage(),
                    ]);
                } else {
                    return redirect()->back()->with(['error' => $e->getMessage()]);
                }
            }
        }

        return redirect('checkout');
    }

    public function aamarpayRedirect(Request $request)
    {
        try {
            $bdt_currency            = $this->getCurrency();

            if (! $bdt_currency) {
                return false;
            }

            if (setting('is_amarpay_sandbox_mode_activated') == 1) {
                $api_url = 'https://sandbox.aamarpay.com/request.php';
            } else {
                $api_url = 'https://secure.aamarpay.com/request.php';
            }

            $data                    = $request->all();
            $request['payment_type'] = 'aamarpay';
            $orders                  = $this->findOrders($data);
            $active_currency         = $this->activeCurrencyCheck();
            $token                   = $this->apiToken($data);
            $user                    = $this->findUser($data);
            $trx_id                  = $data['trx_id'];
            $amount                  = $this->currencyAmountCalculator($orders, $data, $active_currency, $bdt_currency);
            $total_amount            = $amount['total_amount'];
            $success_url             = $this->successUrl($request, auth()->user(), $total_amount);

            $fields                  = [
                'store_id'      => setting('aamrapay_store_id'),
                'amount'        => round($total_amount),
                'payment_type'  => 'VISA',
                'currency'      => 'BDT',
                'tran_id'       => date('YmdHis'),
                'cus_name'      => $user ? $user->first_name : 'Yoori Customer',
                'cus_email'     => $user ? $user->email : 'yoori@example.com',
                'cus_add1'      => '',
                'cus_add2'      => '',
                'cus_city'      => '',
                'cus_state'     => '',
                'cus_postcode'  => '',
                'cus_country'   => 'Bangladesh',
                'cus_phone'     => $user ? $user->phone : '01634896248',
                'cus_fax'       => 'Not¬Applicable',
                'ship_name'     => $user ? $user->first_name : 'Yoori Customer',
                'ship_add1'     => '',
                'ship_add2'     => '',
                'ship_city'     => '',
                'ship_state'    => '',
                'ship_postcode' => '',
                'ship_country'  => 'Bangladesh',
                'desc'          => 'Order Payments',
                'success_url'   => $success_url,
                'fail_url'      => $this->cancelUrl($request),
                'cancel_url'    => $this->cancelUrl($request),
                'opt_a'         => $user || $token ? '' : 1,
                'opt_b'         => $trx_id,
                'opt_d'         => $user ? $user->id : '',
                'signature_key' => setting('aamarpay_signature_key'),
            ];
            if (array_key_exists('payment_type', $data) && $request->type == 'wallet') {
                $payment['trx_id']    = $trx_id;
                $payment['api_token'] = '';
                $payment['guest_id']  = $user->id;
                $payment['amount']    = $amount['db_amount'];
                $payment['type']      = '';
                DB::table('payment_methods')->insert($payment);
            }

            $fields_string           = '';
            foreach ($fields as $key => $value) {
                $fields_string .= $key.'='.$value.'&';
            }

            $fields_string           = rtrim($fields_string, '&');
            $ch                      = curl_init();
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $url_forward             = str_replace('"', '', stripslashes(curl_exec($ch)));
            curl_close($ch);

            $this->redirect_to_merchant($url_forward);
        } catch (Exception $e) {
            dd($e);
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function redirect_to_merchant($url)
    {

        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">

        <head>
            <script type="text/javascript">
                function closethisasap() {
                    document.forms["redirectpost"].submit();
                }
            </script>
        </head>

        <body onLoad="closethisasap();">

        <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com'.$url; ?>"></form>
        </body>


        </html>
        <?php
        exit;
    }

    public function paytmRedirect(Request $request)
    {
        try {
            $inr_currency    = $this->getCurrency('INR');
            $user            = auth()->user();
            $data            = $request->all();
            $trx_id          = $this->tokenGenerator($data);
            $orders          = $this->findOrders($data);
            $token           = $this->apiToken($data);
            $active_currency = $this->activeCurrencyCheck();
            $amount          = $this->currencyAmountCalculator($orders, $data, $active_currency, $inr_currency);
            $total_amount    = $amount['total_amount'];
            $db_amount       = $amount['db_amount'];

            if (auth()->user() || $token) {
                if ($request->payment_mode == 'api') {
                    try {
                        if (! $user = JWTAuth::parseToken()->authenticate()) {
                            return $this->responseWithError(__('unauthorized_user'), [], 401);
                        }
                    } catch (\Exception $e) {
                        return $this->responseWithError(__('unauthorized_user'), [], 401);
                    }
                    $url = url('paytm/success?trx_id='.$trx_id.'&code='.'&payment_type=paytm&&payment_mode=api&token='.$token.'&curr='.$request->curr);
                } else {
                    $url = url('paytm/success?trx_id='.$trx_id.'&code='.'&payment_type=paytm');
                }
                if ($request->type == 'wallet') {
                    $url = url("paytm/success?user_id=$user->id&total=$db_amount&transaction_id=$trx_id&payment_type=$request->payment_type&type=wallet");
                }
            }

            $order_id        = date('YmdHis');
            $merchant_id     = setting('merchant_id');
            if (setting('is_paytm_sandbox_mode_activated')) {
                $base_url = 'https://securegw-stage.paytm.in';
            } else {
                $base_url = 'https://securegw.paytm.in';
            }
            $fields['body']  = [
                'requestType' => 'Payment',
                'mid'         => $merchant_id,
                'orderId'     => $order_id,
                'callbackUrl' => $url,
                'websiteName' => setting('merchant_website'),
                'txnAmount'   => [
                    'value'    => round($total_amount, 2),
                    'currency' => 'INR',
                ],
                'userInfo'    => [
                    'custId' => $user->id,
                    'mobile' => $user->phone ?: '01631102838',
                ],
            ];

            $checksum        = PaytmChecksum::generateSignature(json_encode($fields['body'], JSON_UNESCAPED_SLASHES), setting('merchant_key'));
            $fields['head']  = [
                'signature' => $checksum,
                'channelId' => setting('channel'),
            ];

            $post_data       = json_encode($fields, JSON_UNESCAPED_SLASHES);
            $url             = "$base_url/theia/api/v1/initiateTransaction?mid=$merchant_id&orderId=$order_id";

            $ch              = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $response        = curl_exec($ch);
            $response        = json_decode($response, true);

            $token           = $response['body']['txnToken'];
            $data            = [
                'token'    => $token,
                'mid'      => $merchant_id,
                'orderId'  => $order_id,
                'base_url' => $base_url,
            ];

            return view('frontend.payments.paytm', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function payTmSuccess(Request $request, OrderRepository $order)
    {
        DB::beginTransaction();

        if ($request->STATUS == 'TXN_FAILURE') {
            $url = url('checkout');
            if ($request->type == 'wallet') {
                $url = url('wallet');
            }

            if ($request->payment_mode == 'api') {
                $url = url("api/user/make-payment?trx_id=$request->trx_id&token=$request->token&curr=$request->curr&lang=$request->lang");
            }
            session()->flash('error', $request->RESPMSG);

            return redirect($url);
        }

        $user = auth()->user();

        $data = [
            'trx_id'       => $request->trx,
            'payment_type' => 'paytm',
        ];

        if ($request->code) {
            $data['code'] = $request->code;
        }

        try {
            $order->completeOrder($data, auth()->user());
            $data = [
                'success' => __('Order Completed'),
            ];

            DB::commit();

            if (request()->ajax()) {
                return response()->json($data);
            } else {
                if ($request->type == 'wallet') {
                    return redirect()->route('wallet');
                } elseif ($request->payment_mode == 'api') {
                    return redirect()->route('api.payment.success');
                } else {
                    return redirect('user/invoice/'.$request->trx);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            session()->forget('trx_id');
            if (request()->ajax()) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            } else {
                if ($request->type == 'wallet') {
                    return redirect()->route('wallet');
                } elseif ($request->payment_mode == 'api') {
                    return redirect()->route('api.payment.cancel');
                } else {
                    return redirect('checkout');
                }
            }
        }
    }

    public function razorpayRedirect(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $image           = 'https://lms.spagreen.net/public/frontend/img/logo.png';
            if (setting('dark_logo') && @is_file_exists(setting('dark_logo')['original_image'])) {
                $image = get_media(setting('dark_logo')['original_image']);
            } elseif (setting('light_logo') && @is_file_exists(setting('light_logo')['original_image'])) {
                $image = get_media(setting('light_logo')['original_image']);
            }
            $inr_currency    = $this->getCurrency('INR');
            $active_currency = $this->activeCurrencyCheck();
            $data            = $request->all();
            $orders          = $this->findOrders($data);
            $amount          = $this->currencyAmountCalculator($orders, $data, $active_currency, $inr_currency);
            $total_amount    = $amount['total_amount'];
            $api             = new Api(setting('razorpay_key'), setting('razorpay_secret'));
            $order           = $api->order->create([
                'receipt'  => '123',
                'amount'   => round($total_amount * 100),
                'currency' => 'INR',
                'notes'    => ['key1' => 'value3', 'key2' => 'value2'],
            ]);
            $data            = [
                'key'          => setting('razorpay_key'),
                'success'      => true,
                'amount'       => round($total_amount * 100),
                'currency'     => 'INR',
                'name'         => setting('system_name'),
                'description'  => 'Test Transaction',
                'image'        => $image,
                'order_id'     => $order->id,
                'callback_url' => $this->successUrl($request, $this->findUser($data), $amount['db_amount']),
                'prefill'      => [
                    'name'    => auth()->user()->name,
                    'email'   => auth()->user()->email,
                    'contact' => auth()->user()->phone,
                ],
                'notes'        => [
                    'address' => 'Course Purchase',
                ],
                'theme'        => [
                    'color' => setting('primary_color'),
                ],
            ];

            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function fwRedirect(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $currency        = $this->getCurrency('NGN');
            if (! $currency) {
                Toastr::error('Something Went Wrong Try Again Later');

                return back();
            }
            $url             = 'https://api.flutterwave.com/v3/payments';
            $data            = $request->all();
            $orders          = $this->findOrders($data);
            $user            = auth()->user();
            $active_currency = $this->activeCurrencyCheck();
            $amount          = $this->currencyAmountCalculator($orders, $data, $active_currency, $currency);
            $success_url     = $this->successUrl($request);
            $image           = 'https://lms.spagreen.net/public/frontend/img/logo.png';
            if (setting('dark_logo') && @is_file_exists(setting('dark_logo')['original_image'])) {
                $image = get_media(setting('dark_logo')['original_image']);
            } elseif (setting('light_logo') && @is_file_exists(setting('light_logo')['original_image'])) {
                $image = get_media(setting('light_logo')['original_image']);
            }
            $headers         = [
                'Authorization' => 'Bearer '.setting('flutterwave_secret_key'),
            ];
            $body            = [
                'public_key'     => 'FLWPUBK-58cc63c00e129204fb4e94ef95bb781f-X',
                'tx_ref'         => Str::random(12),
                'amount'         => $amount['total_amount'],
                'currency'       => 'NGN',
                'redirect_url'   => 'https://google.com',
                'meta'           => [
                    'consumer_id' => $user->id,
                ],
                'customer'       => [
                    'email'       => $user->email,
                    'phonenumber' => $user->phone,
                    'name'        => $user->name,
                ],
                'customizations' => [
                    'title' => setting('system_name'),
                    'logo'  => $image,
                ],
            ];
            $response        = curlRequest($url, $body, 'POST', $headers);

            return redirect()->away($response['data']['link']);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function mercadoPagoRedirect(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $access_key            = setting('mercadopago_access_key');
        $data                  = $request->all();
        $orders                = $this->findOrders($data);
        $active_currency       = $this->activeCurrencyCheck($data);
        $amount                = $this->findAmount($data, $orders, $active_currency);
        $success_url           = $this->successUrl($request, $this->findUser($data), $amount);

        SDK::setAccessToken(setting('mercadopago_access_key'));

        $preference            = new Preference();

        $payer                 = new Payer();
        $payer->name           = auth()->user()->name;
        $payer->email          = auth()->user()->email;
        $payer->phone          = [
            'area_code' => auth()->user()->postal_code ?? '1216',
            'number'    => auth()->user()->phone,
        ];

        // Crea un ítem en la preferencia

        $item                  = new Item();
        $item->title           = auth()->user()->name;
        $item->quantity        = 1;

        $item->unit_price      = $amount;
        $preference->payer     = $payer;
        $preference->items     = [$item];

        $preference->back_urls = [
            'success' => $success_url,
            'failure' => route('checkout'),
            'pending' => route('checkout'),
        ];

        $preference->save();

        return view('frontend.payments.mercado_pago', compact('preference'));
    }

    public function midtransRedirect(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (setting('is_midtrans_sandbox_enabled')) {
            $base_url = 'https://app.sandbox.midtrans.com/snap/v1/transactions';
        } else {
            $base_url = 'https://app.midtrans.com/snap/v1/transactions';
        }

        $data            = $request->all();
        $currency        = $this->getCurrency('IDR');
        $orders          = $this->findOrders($data);
        $active_currency = $this->activeCurrencyCheck();
        $amount          = $this->currencyAmountCalculator($orders, $data, $active_currency, $currency);
        $success_url     = $this->successUrl($request, $this->findUser($data), $amount['db_amount']);

        $data            = [
            'transaction_details' => [
                'order_id'     => 'ORDER-101-'.Str::random(12),
                'gross_amount' => round($amount['total_amount']),
            ],
            'credit_card'         => [
                'secure' => true,
            ],
            'callbacks'           => [
                'finish' => $success_url,
            ],
        ];

        $headers         = [
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Basic '.base64_encode(setting('mid_trans_server_key').':'),
        ];

        $response        = curlRequest($base_url, json_encode($data), 'POST', $headers, true);

        return redirect()->away($response['redirect_url']);
    }

    public function telrRedirect(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $data        = $request->all();
        $orders      = $this->findOrders($data);
        $amount      = $this->currencyAmountCalculator($orders, $data, $this->activeCurrencyCheck(), $this->getCurrency('AED'));
        $success_url = $this->successUrl($request, $this->findUser($data), $amount['db_amount']);

        $params      = [
            'ivp_method'   => 'create',
            'ivp_store'    => setting('telr_store_id'),
            'ivp_authkey'  => setting('telr_auth_key'),
            'ivp_cart'     => rand(),
            'ivp_test'     => '1',
            'ivp_amount'   => round($amount['total_amount'], 2),
            'ivp_currency' => 'AED',
            'ivp_desc'     => 'Order Processes',
            'return_auth'  => $success_url,
            'return_can'   => $this->cancelUrl($request),
            'return_decl'  => $this->cancelUrl($request),
        ];

        $ch          = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://secure.telr.com/gateway/order.json');
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Expect:']);
        $results     = curl_exec($ch);
        curl_close($ch);
        $results     = json_decode($results, true);
        $ref         = isset($results['order']) ? trim($results['order']['ref']) : '';
        $url         = isset($results['order']) ? trim($results['order']['url']) : '';
        if (empty($ref) || empty($url)) {
            return back()->with(['error' => __('failed_to_create_telr')]);
        } else {
            return redirect($url);
        }
    }

    public function iyzicoRedirect(Request $request)
    {
        try {
            if (setting('is_iyzico_sandbox_enabled')) {
                $url = 'https://sandbox-api.iyzipay.com/payment/pay-with-iyzico/initialize';
            } else {
                $url = 'https://api.iyzipay.com/payment/pay-with-iyzico/initialize';
            }
            $data                    = $request->all();
            $orders                  = $this->findOrders($data);
            $user                    = $this->findUser($data);
            $amount                  = $this->currencyAmountCalculator($orders, $data, $this->activeCurrencyCheck(), $this->getCurrency('TRY'));
            $basket_id               = date('YmdHis');
            $shipping_address        = '';
            $billing_address         = '';
            $conversation_id         = rand(100000000, 999999999);
            $options                 = new \Iyzipay\Options();
            $options->setApiKey(setting('iyzico_api_key'));
            $options->setSecretKey(setting('iyzico_secret_key'));
            $options->setBaseUrl($url);
            $iyzico_request          = new \Iyzipay\Request\CreatePayWithIyzicoInitializeRequest();
            if (setting('default_language') == 'tr') {
                $iyzico_request->setLocale(\Iyzipay\Model\Locale::TR);
            } else {
                $iyzico_request->setLocale(\Iyzipay\Model\Locale::EN);
            }
            $iyzico_request->setConversationId($conversation_id);
            $iyzico_request->setPrice($amount);
            $iyzico_request->setPaidPrice($amount);
            $iyzico_request->setCurrency(\Iyzipay\Model\Currency::TL);
            $iyzico_request->setLocale(\Iyzipay\Model\Locale::EN);
            $iyzico_request->setBasketId($basket_id);
            $iyzico_request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
            $iyzico_request->setCallbackUrl(route('iyzico.callback', [
                'conversation_id' => $conversation_id,
            ]));
            $iyzico_request->setEnabledInstallments([2, 3, 6, 9]);
            $buyer                   = new \Iyzipay\Model\Buyer();
            $buyer->setId(date('YmdHis'));
            $buyer->setName($user->first_name);
            $buyer->setSurname($user->last_name);
            $buyer->setGsmNumber($user->phone);
            $buyer->setEmail($user->email);
            $buyer->setIdentityNumber(date('YmdHis'));
            $buyer->setLastLoginDate(date('Y-m-d H:i:s'));
            $buyer->setRegistrationDate($user->created_at);
            $buyer->setRegistrationAddress('Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1');
            $buyer->setIp('85.34.78.112');
            $buyer->setCity('Istanbul');
            $buyer->setCountry('Turkey');
            $buyer->setZipCode('34732');
            $iyzico_request->setBuyer($buyer);
            $basket_items            = [];
            $firstBasketItem         = new \Iyzipay\Model\BasketItem();
            $firstBasketItem->setId($basket_id);
            $firstBasketItem->setName('Product Purchase');
            $firstBasketItem->setCategory1('Order');
            $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
            $firstBasketItem->setPrice($amount);
            $basket_items[0]         = $firstBasketItem;
            $iyzico_request->setShippingAddress($this->getAddress($shipping_address));
            $iyzico_request->setBillingAddress($this->getAddress($billing_address));
            $iyzico_request->setBasketItems($basket_items); // make request
            $payWithIyzicoInitialize = \Iyzipay\Model\PayWithIyzicoInitialize::create($iyzico_request, $options);

            /* $data = [
                 'locale' => 'tr',
                 'conversationId' => $conversation_id,
                 'price' => $amount,
                 'basketId' => $basket_id,
                 'paymentGroup' => 'PRODUCT',
                 'buyer' => [
                     'id' => $user->id,
                     'name' => $user->first_name,
                     'surname' => $user->last_name,
                     'identityNumber' => $user->id,
                     'email' => $user->email,
                     'gsmNumber' => $user->phone,
                     'registrationDate' => $user->created_at,
                     'lastLoginDate' => $user->updated_at,
                     'registrationAddress' => $user->address,
                     'city' => $user->city,
                     'country' => $user->country,
                     'zipCode' => $user->zip_code,
                     'ip' => $request->ip(),
                 ],
                 'shippingAddress' => [
                     'address' => $user->address,
                     'zipCode' => $user->zip_code,
                     'contactName' => $user->first_name . ' ' . $user->last_name,
                     'city' => $user->city,
                     'country' => $user->country,
                 ],
                 'billingAddress' => [
                     'address' => $user->address,
                     'zipCode' => $user->zip_code,
                     'contactName' => $user->first_name . ' ' . $user->last_name,
                     'city' => $user->city,
                     'country' => $user->country,
                 ],
                 'basketItems' => [
                     [
                         'id' => $basket_id,
                         'price' => $amount,
                         'name' => 'Product Purchase',
                         'category1' => 'Order',
                         'itemType' => 'VIRTUAL',
                     ],
                 ],
                 'callbackUrl' => route('iyzico.callback'),
                 'currency' => 'TRY',
                 'paidPrice' => $amount,
             ];*/

            session()->put('iyzico_token', $payWithIyzicoInitialize->getToken());

            return redirect($payWithIyzicoInitialize->getPayWithIyzicoPageUrl());
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function retrieveIyzico(Request $request)
    {
        $options        = new \Iyzipay\Options();
        $options->setApiKey(setting('iyzico_api_key'));
        $options->setSecretKey(setting('iyzico_secret_key'));

        if (setting('is_iyzico_sandbox_mode') == 1) {
            $options->setBaseUrl('https://sandbox-api.iyzipay.com');
        } else {
            $options->setBaseUrl('https://api.iyzipay.com');
        }

        $iyzico_request = new \Iyzipay\Request\RetrievePayWithIyzicoRequest();
        if (setting('default_language') == 'tr') {
            $iyzico_request->setLocale(\Iyzipay\Model\Locale::TR);
        } else {
            $iyzico_request->setLocale(\Iyzipay\Model\Locale::EN);
        }
        $iyzico_request->setConversationId($request->conversation_id);
        $iyzico_request->setToken(session()->get('iyzico_token'));

        return \Iyzipay\Model\PayWithIyzico::retrieve($iyzico_request, $options);
    }

    public function getAddress($billing_address): \Iyzipay\Model\Address
    {
        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName($billing_address ? $billing_address['name'] : 'Yoori Customer');
        $billingAddress->setCity($billing_address ? $billing_address['city'] : 'Istanbul');
        $billingAddress->setCountry($billing_address ? $billing_address['country'] : 'Turkey');
        $billingAddress->setAddress($billing_address ? $billing_address['address'] : 'Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1');
        $billingAddress->setZipCode($billing_address ? $billing_address['postal_code'] : '34742');

        return $billingAddress;
    }

    public function hitpayRedirect(Request $request)
    {
        if (setting('is_hitpay_sandbox_mode_activated') == 1) {
            $url = 'https://api.sandbox.hit-pay.com/v1/';
        } else {
            $url = 'https://api.hit-pay.com/v1/';
        }

        $data            = $request->all();
        $orders          = $this->findOrders($data);
        $user            = $this->findUser($data);
        $active_currency = $this->activeCurrencyCheck();
        $amount          = $this->currencyAmountCalculator($orders, $data, $active_currency, $this->getCurrency('SGD'));
        $success_url     = $this->successUrl($request, $this->findUser($data), $amount['db_amount']);
        try {
            $client       = new Client([
                'base_uri' => $url,
                'headers'  => [
                    'X-BUSINESS-API-KEY' => setting('hitpay_api_key'),
                    'Content-Type'       => 'application/x-www-form-urlencoded',
                    'X-Requested-With'   => 'XMLHttpRequest',
                ],
                'verify'   => false, // bypass SSL certificate verification
            ]);
            $response     = $client->post('payment-requests', [
                RequestOptions::FORM_PARAMS => [
                    'email'            => $user->email,
                    'redirect_url'     => $success_url,
                    'reference_number' => setting('system_name'),
                    'webhook'          => 'https://lms.spagreen.net/',
                    'currency'         => 'SGD',
                    'amount'           => $amount['total_amount'],
                ],
            ]);
            $responseData = json_decode($response->getBody(), true);
            $responseUrl  = $responseData['url'];

            return redirect($responseUrl);
        } catch (ClientException  $e) {
            $response = $e->getResponse();
            if ($response->getStatusCode() == 422) {
                $responseBody = json_decode($response->getBody(), true);
                $errorMessage = $responseBody['errors'];
                Toastr::error($errorMessage);
            } else {
                Toastr::error('Invalid business api key.');
            }

            return back();
        }
    }

    public function uddoktaPyRedirect(Request $request)
    {
        try {
            $bdt_currency    = $this->getCurrency();

            if (! $bdt_currency) {
                return false;
            }
            if (setting('is_uddokta_pay_sandbox_mode_activated')) {
                $baseURL = 'https://sandbox.uddoktapay.com/api/checkout-v2';
            } else {
                $baseURL = trim(setting('uddokta_pay_base_url'), '/').'/api/checkout-v2';
            }
            $apiKEY          = setting('uddokta_pay_api_key');
            $data            = $request->all();
            $orders          = $this->findOrders($data);
            $active_currency = $this->activeCurrencyCheck();
            $bd_amount       = $this->currencyAmountCalculator($orders, $data, $active_currency, $bdt_currency);
            $amount          = $bd_amount['total_amount'];
            $fields          = [
                'full_name'    => auth()->user()->name,
                'email'        => auth()->user()->email,
                'amount'       => $amount,
                'metadata'     => $data,
                'redirect_url' => $this->successUrl($request, $this->findUser($data), $bd_amount['db_amount']),
                'cancel_url'   => url()->previous(),
            ];

            $response        = curlRequest($baseURL, json_encode($fields), 'POST', [
                'RT-UDDOKTAPAY-API-KEY' => $apiKEY,
                'accept'                => 'application/json',
                'content-type'          => 'application/json',
            ], true);

            return redirect($response['payment_url']);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function pgProcess(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data     = $request->all();
            $currency = $this->getCurrency($request->currency);
            $amount   = $this->currencyAmountCalculator([], $data, $this->activeCurrencyCheck(), $currency);
            $response = [
                'success' => 'success',
                'url'     => $this->successUrl($request, $this->findUser($data), $amount['db_amount']),
            ];
            if ($request->payment_type == 'flutter_wave' || $request->payment_type == 'paystack') {
                $response['amount']       = round($amount['total_amount']);
                $response['payment_type'] = 'flutter_wave';
            }
            if ($request->payment_type == 'paystack') {
                $response['payment_type'] = 'paystack';
                $response['amount']       = $response['amount'] * 100;
            }
            if ($request->payment_type == 'kkiapay') {
                $response['payment_type'] = 'kkiapay';
                $response['amount']       = round($amount['total_amount']);
                $response['url']          = $this->successUrl($request, $this->findUser($data), $amount['db_amount']);
            }

            return response()->json($response);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
