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

        // Determine checkout status based on payment status BEFORE overwriting $data
        // Preserve payment_status and payment_type before overwriting $data array
        $payment_status = isset($data['payment_status']) ? $data['payment_status'] : null;
        $payment_type = isset($data['payment_type']) ? $data['payment_type'] : null;
        
        $checkout_status = 0; // Default to pending
        if ($payment_status == 'success') {
            // Payment was successful (API confirmed or other payment method succeeded)
            $checkout_status = 1; // Paid
        } elseif ($payment_type != 'offline_method') {
            // For non-offline methods, assume success if we reached here (successStatusCheck passed)
            $checkout_status = 1; // Paid
        }
        // For offline_method without success, status remains 0 (pending)
        
        // Log checkout status for debugging
        \Log::info('Checkout Status Determination', [
            'payment_status' => $payment_status,
            'payment_type' => $payment_type,
            'checkout_status' => $checkout_status,
            'trx_id' => $data['trx_id'] ?? 'N/A',
        ]);

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
            'status'                    => $checkout_status,
            'system_commission'         => $system_commission,
            'organization_commission'   => $organization_commission,
        ];

        $checkout = Checkout::create($data);
        
        // Log created checkout for debugging
        \Log::info('Checkout Created', [
            'checkout_id' => $checkout->id,
            'status' => $checkout->status,
            'trx_id' => $checkout->trx_id,
            'payment_type' => $checkout->payment_type,
        ]);
        
        return $checkout;
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

        // Calculate coupon discount first (used in both offline and online payments)
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

        if ($data['payment_type'] == 'offline_method') {
            $payment_details = [];
            $payment_success = false; // Track if payment was successful
            
            // Validate phone number is required
            if (!arrayCheck('phone_number', $data) || empty(trim($data['phone_number']))) {
                return __('phone_number_is_required_for_payment');
            }
            
            if (!arrayCheck('phone_country_id', $data)) {
                return __('phone_country_code_is_required');
            }
            
            // Get offline method to determine which API to use
            $offline_method_id = arrayCheck('offline_method_id', $data) ? $data['offline_method_id'] : null;
            $offline_method = null;
            $is_edahab = false;
            
            if ($offline_method_id) {
                $offline_method = \App\Models\OfflineMethod::find($offline_method_id);
                if ($offline_method) {
                    $method_name = strtolower($offline_method->name);
                    $is_edahab = (strpos($method_name, 'edahab') !== false || strpos($method_name, 'dahab') !== false);
                }
            }
            
            // Handle phone number payment instead of file upload
            if (arrayCheck('phone_number', $data) && arrayCheck('phone_country_id', $data)) {
                $phone_number = trim($data['phone_number']);
                
                // Validate phone number format based on payment method
                if ($is_edahab) {
                    // eDahab: phone must start with 65 (not 25265...)
                    // Remove country code prefix if present (252, +252, etc.)
                    $phone_number = preg_replace('/^(\+?252)/', '', $phone_number);
                    $phone_number = trim($phone_number);
                    
                    // Validate phone number starts with 65 only
                    if (!str_starts_with($phone_number, '65')) {
                        return __('phone_number_must_start_with_65') . '. Current: ' . $phone_number;
                    }
                    
                    // Ensure phone number is only digits starting with 65
                    if (!preg_match('/^65\d+$/', $phone_number)) {
                        return __('phone_number_must_start_with_65') . ' and contain only digits. Current: ' . $phone_number;
                    }
                } else {
                    // Waafi: phone must start with 63 or 252
                    $country = \App\Models\Country::find($data['phone_country_id']);
                    $country_code = $country ? ($country->phonecode ?: '252') : '252';
                    
                    // Remove + from country code if present
                    if (str_starts_with($country_code, '+')) {
                        $country_code = str_replace('+', '', $country_code);
                    }
                    
                    // Ensure phone number starts with 63 or 252
                    if (!str_starts_with($phone_number, '63') && !str_starts_with($phone_number, '252')) {
                        // Prepend country code if not present (default to 252)
                        $phone_number = $country_code . $phone_number;
                    }
                    
                    // Validate phone number starts with 63 or 252
                    if (!str_starts_with($phone_number, '63') && !str_starts_with($phone_number, '252')) {
                        return __('phone_number_must_start_with_63_or_252');
                    }
                }
                
                // Get amount from checkout total
                $total_amount = $calculations['payable_amount'];
                
                try {
                    if ($is_edahab) {
                        // ========== eDahab API Integration ==========
                        // Get eDahab API credentials from settings
                        $edahab_secret_key = setting('edahab_secret_key') ?: 'CaWwAFfA6HPnOUZjtrAmdZo5guXbGGfwOxqnUi';
                        $edahab_api_key = setting('edahab_api_key') ?: 'nvt1vtEpgW6D8gRy0cJclVWND10IrHF6cdNlQb6tq';
                        $edahab_agent_code = setting('edahab_agent_code') ?: '758022';
                        $is_production = setting('edahab_is_production') ? true : false;
                        
                        // Return URL for eDahab (must start with https://)
                        $return_url = url(route('checkout')) . '?trx_id=' . $data['trx_id'] . '&payment_type=offline_method&edahab_return=1';
                        
                        // eDahab API base URL and endpoint
                        $edahab_base_url = setting('edahab_api_url') ?: 'https://edahab.net/api/api/';
                        $edahab_endpoint = 'issueinvoice'; // Based on working controller
                        
                        $invoice_id = null;
                        $transaction_id = null;
                        
                        try {
                            // Step 1: Create Invoice
                            // Build payload - note: field name is "Edahabnumber" (capital E) not "edahabNumber"
                            $create_invoice_payload = [
                                'apiKey' => $edahab_api_key,
                                'Edahabnumber' => $phone_number, // Capital E - should be just 65xxxxxxx (no country code)
                                'amount' => (float)$total_amount,
                                'currency' => 'SLSH',
                                'agentCode' => $edahab_agent_code,
                                // Note: returnUrl might be optional based on working controller
                            ];
                            
                            // Create hash for authentication
                            // Hash = SHA256(json_encode(payload) + SECRET_KEY)
                            $request_as_string = json_encode($create_invoice_payload);
                            $hash = hash('sha256', $request_as_string . $edahab_secret_key);
                            
                            // Build URL with hash as query parameter
                            $create_invoice_url = $edahab_base_url . $edahab_endpoint . '?hash=' . $hash;
                            
                            // Headers
                            $create_invoice_headers = [
                                'Content-Type' => 'application/json',
                                'Accept' => 'application/json',
                            ];
                            
                            try {
                                $create_invoice_response = curlRequest($create_invoice_url, json_encode($create_invoice_payload), 'POST', $create_invoice_headers, true);
                                
                                // Check if response indicates 404 or other HTTP errors
                                if (is_array($create_invoice_response) && isset($create_invoice_response['error'])) {
                                    $error_msg = $create_invoice_response['error'];
                                    if (strpos($error_msg, '404') !== false || strpos($error_msg, 'Not Found') !== false) {
                                        \Log::error('eDahab API Endpoint Not Found', [
                                            'url' => $create_invoice_url,
                                            'response' => $create_invoice_response,
                                            'trx_id' => $data['trx_id'],
                                        ]);
                                        return __('payment_api_error') . ': API endpoint not found (404). URL: ' . $create_invoice_url . '. Please configure the correct eDahab API endpoint in settings. Response: ' . json_encode($create_invoice_response);
                                    }
                                }
                            } catch (\Exception $curl_error) {
                                // Handle DNS resolution errors and connection errors
                                $error_message = $curl_error->getMessage();
                                
                                // Check for DNS/connection errors
                                if (strpos($error_message, 'Could not resolve host') !== false || 
                                    strpos($error_message, 'cURL error 6') !== false ||
                                    strpos($error_message, 'cURL error 7') !== false) {
                                    \Log::error('eDahab API Connection Error', [
                                        'url' => $create_invoice_url,
                                        'error' => $error_message,
                                        'trx_id' => $data['trx_id'],
                                        'suggestion' => 'Please configure edahab_api_url with the correct eDahab API base URL',
                                    ]);
                                    return __('payment_api_error') . ': Could not connect to eDahab API. URL: ' . $create_invoice_url . '. Error: ' . $error_message . '. Please configure the correct eDahab API base URL (edahab_api_url) in settings. Contact eDahab support for the correct API endpoint URL.';
                                }
                                
                                // Check for 404 errors
                                if (strpos($error_message, '404') !== false || strpos($error_message, 'Not Found') !== false) {
                                    \Log::error('eDahab API Endpoint Not Found', [
                                        'url' => $create_invoice_url,
                                        'error' => $error_message,
                                        'trx_id' => $data['trx_id'],
                                        'suggestion' => 'Please configure edahab_api_url and edahab_create_invoice_endpoint in settings',
                                    ]);
                                    return __('payment_api_error') . ': API endpoint not found (404). URL: ' . $create_invoice_url . '. Please configure the correct eDahab API endpoint in settings. Error: ' . $error_message;
                                }
                                
                                throw $curl_error; // Re-throw if unknown error
                            }
                            
                            // Log full API response for debugging
                            \Log::info('eDahab Create Invoice API Call', [
                                'url' => $create_invoice_url,
                                'payload' => $create_invoice_payload,
                                'response' => $create_invoice_response,
                                'trx_id' => $data['trx_id'],
                                'phone_number' => $phone_number,
                                'response_type' => gettype($create_invoice_response),
                            ]);
                            
                            // Validate create invoice response
                            $create_success = false;
                            $create_error = null;
                            
                            // Check for "Invalid Api Credentials" or similar errors in response
                            $response_string = is_string($create_invoice_response) ? $create_invoice_response : json_encode($create_invoice_response);
                            if (stripos($response_string, 'Invalid Api Credentials') !== false || 
                                stripos($response_string, 'Invalid API Credentials') !== false ||
                                stripos($response_string, 'invalid credentials') !== false) {
                                \Log::error('eDahab Invalid API Credentials', [
                                    'trx_id' => $data['trx_id'],
                                    'phone_number' => $phone_number,
                                    'api_response' => $create_invoice_response,
                                    'payload_sent' => $create_invoice_payload, // Log payload but mask sensitive data
                                ]);
                                return __('payment_failed') . ': Invalid API Credentials. Please verify your eDahab API Key and Secret Key in settings. API Response: ' . $response_string;
                            }
                            
                            if (is_array($create_invoice_response)) {
                                // Check StatusCode: 0 = Success, 1-6 = Various errors
                                if (isset($create_invoice_response['StatusCode'])) {
                                    if ($create_invoice_response['StatusCode'] == 0) {
                                        $create_success = true;
                                        $invoice_id = $create_invoice_response['InvoiceId'] ?? null;
                                    } else {
                                        // StatusCode 1-6 indicates errors
                                        // StatusCode 4 = Invalid_Api_Credentials (from documentation)
                                        if ($create_invoice_response['StatusCode'] == 4) {
                                            $create_error = 'Invalid API Credentials (StatusCode: 4). Please verify your eDahab API Key and Secret Key.';
                                        } else {
                                            $create_error = $create_invoice_response['StatusDescription'] ?? 'Invoice creation failed';
                                        }
                                        if (isset($create_invoice_response['ValidationErrors'])) {
                                            $create_error .= ' - ' . json_encode($create_invoice_response['ValidationErrors']);
                                        }
                                    }
                                } else {
                                    $create_error = 'Invalid API response: Missing StatusCode. Response: ' . json_encode($create_invoice_response);
                                }
                            } elseif (is_object($create_invoice_response)) {
                                if (isset($create_invoice_response->StatusCode)) {
                                    if ($create_invoice_response->StatusCode == 0) {
                                        $create_success = true;
                                        $invoice_id = $create_invoice_response->InvoiceId ?? null;
                                    } else {
                                        if ($create_invoice_response->StatusCode == 4) {
                                            $create_error = 'Invalid API Credentials (StatusCode: 4). Please verify your eDahab API Key and Secret Key.';
                                        } else {
                                            $create_error = $create_invoice_response->StatusDescription ?? 'Invoice creation failed';
                                        }
                                        if (isset($create_invoice_response->ValidationErrors)) {
                                            $create_error .= ' - ' . json_encode($create_invoice_response->ValidationErrors);
                                        }
                                    }
                                } else {
                                    $create_error = 'Invalid API response: Missing StatusCode. Response: ' . json_encode($create_invoice_response);
                                }
                            } else {
                                $create_error = 'Invalid API response format. Response: ' . json_encode($create_invoice_response);
                            }
                            
                            // If invoice creation failed, return error with exact API response
                            if (!$create_success) {
                                \Log::error('eDahab Create Invoice Failed', [
                                    'trx_id' => $data['trx_id'],
                                    'phone_number' => $phone_number,
                                    'api_response' => $create_invoice_response,
                                    'error' => $create_error,
                                ]);
                                return __('payment_failed') . ': ' . ($create_error ?: json_encode($create_invoice_response));
                            }
                            
                            if (!$invoice_id) {
                                \Log::error('eDahab Create Invoice: Missing InvoiceId', [
                                    'trx_id' => $data['trx_id'],
                                    'api_response' => $create_invoice_response,
                                ]);
                                return __('payment_failed') . ': Invoice created but InvoiceId is missing. API Response: ' . json_encode($create_invoice_response);
                            }
                            
                            // Step 2: Check Invoice Status
                            // Wait a moment for payment processing (if needed)
                            sleep(2); // Adjust based on eDahab's processing time
                            
                            // Use the same endpoint for checking invoice status
                            // The API might use different parameters or the same endpoint
                            $check_invoice_url = $edahab_api_url;
                            // Step 2: Check Invoice Status
                            // Build payload for checking invoice
                            $check_invoice_payload = [
                                'apiKey' => $edahab_api_key,
                                'invoiceId' => $invoice_id,
                            ];
                            
                            // Create hash for check invoice request
                            $check_request_as_string = json_encode($check_invoice_payload);
                            $check_hash = hash('sha256', $check_request_as_string . $edahab_secret_key);
                            
                            // Build URL with hash as query parameter
                            $check_invoice_endpoint = 'checkinvoice'; // Adjust if different
                            $check_invoice_url = $edahab_base_url . $check_invoice_endpoint . '?hash=' . $check_hash;
                            
                            // Headers
                            $check_invoice_headers = [
                                'Content-Type' => 'application/json',
                                'Accept' => 'application/json',
                            ];
                            
                            $check_invoice_response = curlRequest($check_invoice_url, json_encode($check_invoice_payload), 'POST', $check_invoice_headers, true);
                            
                            // Log full API response for debugging
                            \Log::info('eDahab Check Invoice API Call', [
                                'url' => $check_invoice_url,
                                'payload' => $check_invoice_payload,
                                'response' => $check_invoice_response,
                                'trx_id' => $data['trx_id'],
                                'invoice_id' => $invoice_id,
                                'response_type' => gettype($check_invoice_response),
                            ]);
                            
                            // Validate check invoice response - ONLY mark success if payment is confirmed
                            $payment_success = false;
                            $check_error = null;
                            
                            if (is_array($check_invoice_response)) {
                                // Check StatusCode first
                                if (isset($check_invoice_response['StatusCode'])) {
                                    if ($check_invoice_response['StatusCode'] == 0) {
                                        // StatusCode 0 means API call succeeded, now check InvoiceStatus
                                        $invoice_status = isset($check_invoice_response['InvoiceStatus']) ? strtolower($check_invoice_response['InvoiceStatus']) : null;
                                        
                                        // ONLY mark as success if InvoiceStatus is "success" (not "pending")
                                        if ($invoice_status == 'success') {
                                            $payment_success = true;
                                            $transaction_id = $check_invoice_response['TransactionId'] ?? null;
                                        } elseif ($invoice_status == 'pending') {
                                            $check_error = 'Payment is still pending. InvoiceStatus: Pending. Please complete the payment.';
                                        } else {
                                            $check_error = 'Payment not completed. InvoiceStatus: ' . ($check_invoice_response['InvoiceStatus'] ?? 'Unknown') . '. API Response: ' . json_encode($check_invoice_response);
                                        }
                                    } else {
                                        // StatusCode 1-6 indicates errors
                                        $check_error = $check_invoice_response['StatusDescription'] ?? 'Invoice check failed';
                                        if (isset($check_invoice_response['ValidationErrors'])) {
                                            $check_error .= ' - ' . json_encode($check_invoice_response['ValidationErrors']);
                                        }
                                    }
                                } else {
                                    $check_error = 'Invalid API response: Missing StatusCode. Response: ' . json_encode($check_invoice_response);
                                }
                            } elseif (is_object($check_invoice_response)) {
                                if (isset($check_invoice_response->StatusCode)) {
                                    if ($check_invoice_response->StatusCode == 0) {
                                        $invoice_status = isset($check_invoice_response->InvoiceStatus) ? strtolower($check_invoice_response->InvoiceStatus) : null;
                                        
                                        if ($invoice_status == 'success') {
                                            $payment_success = true;
                                            $transaction_id = $check_invoice_response->TransactionId ?? null;
                                        } elseif ($invoice_status == 'pending') {
                                            $check_error = 'Payment is still pending. InvoiceStatus: Pending. Please complete the payment.';
                                        } else {
                                            $check_error = 'Payment not completed. InvoiceStatus: ' . ($check_invoice_response->InvoiceStatus ?? 'Unknown') . '. API Response: ' . json_encode($check_invoice_response);
                                        }
                                    } else {
                                        $check_error = $check_invoice_response->StatusDescription ?? 'Invoice check failed';
                                        if (isset($check_invoice_response->ValidationErrors)) {
                                            $check_error .= ' - ' . json_encode($check_invoice_response->ValidationErrors);
                                        }
                                    }
                                } else {
                                    $check_error = 'Invalid API response: Missing StatusCode. Response: ' . json_encode($check_invoice_response);
                                }
                            } else {
                                $check_error = 'Invalid API response format. Response: ' . json_encode($check_invoice_response);
                            }
                            
                            // If payment check failed or still pending, return error with exact API response
                            if (!$payment_success) {
                                \Log::error('eDahab Payment Not Successful', [
                                    'trx_id' => $data['trx_id'],
                                    'invoice_id' => $invoice_id,
                                    'api_response' => $check_invoice_response,
                                    'error' => $check_error,
                                ]);
                                return __('payment_failed') . ': ' . ($check_error ?: json_encode($check_invoice_response));
                            }
                            
                            // Payment confirmed successful - store details
                            $payment_details = [
                                'phone_number' => $phone_number,
                                'create_invoice_response' => $create_invoice_response,
                                'check_invoice_response' => $check_invoice_response,
                                'payment_status' => 'success',
                                'invoice_id' => $invoice_id,
                                'transaction_id' => $transaction_id,
                                'edahab_agent_code' => $edahab_agent_code,
                                'payment_method' => 'eDahab',
                            ];
                            
                            \Log::info('eDahab Payment Success', [
                                'trx_id' => $data['trx_id'],
                                'invoice_id' => $invoice_id,
                                'transaction_id' => $transaction_id,
                                'phone_number' => $phone_number,
                            ]);
                            
                        } catch (\Exception $e) {
                            \Log::error('eDahab API Exception', [
                                'error' => $e->getMessage(),
                                'trace' => $e->getTraceAsString(),
                                'trx_id' => $data['trx_id'],
                            ]);
                            return __('payment_api_error') . ': ' . $e->getMessage() . '. Please check logs for details.';
                        }
                    } else {
                        // ========== Waafi API Integration ==========
                        // Get Waafi API credentials from settings
                        $merchant_uid = setting('waafi_merchant_uid') ?: 'M0914140';
                        $api_user_id = setting('waafi_api_user_id') ?: '1008614';
                        $api_key = setting('waafi_api_key') ?: 'API-OnhpL7LBfZnHS8c6Eluio3vHZRAA';
                        
                        // Generate unique IDs for the transaction
                        $request_id = Str::uuid()->toString();
                        $reference_id = 'RF-' . Str::uuid()->toString();
                        $invoice_id = 'INV-' . Str::uuid()->toString();
                        
                        // Get currency code
                        $currency_code = 'SLSH';
                        
                        // Call Waafi API
                        $api_url = 'https://api.waafipay.net/asm';
                        $api_fields = [
                            'schemaVersion' => '1.0',
                            'requestId' => $request_id,
                            'timestamp' => now()->format('Y-m-d H:i:s.v'),
                            'channelName' => 'WEB',
                            'serviceName' => 'API_PURCHASE',
                            'serviceParams' => [
                                'merchantUid' => $merchant_uid,
                                'apiUserId' => $api_user_id,
                                'apiKey' => $api_key,
                                'paymentMethod' => 'MWALLET_ACCOUNT',
                                'payerInfo' => [
                                    'accountNo' => $phone_number,
                                ],
                                'transactionInfo' => [
                                    'referenceId' => $reference_id,
                                    'invoiceId' => $invoice_id,
                                    'amount' => (string)number_format($total_amount, 2, '.', ''),
                                    'currency' => $currency_code,
                                    'description' => 'Course enrollment payment - Transaction ID: ' . $data['trx_id'],
                                ],
                            ],
                        ];
                        
                        $api_response = curlRequest($api_url, json_encode($api_fields), 'POST', [
                            'Content-Type' => 'application/json',
                            'Accept' => 'application/json',
                        ], true);
                        
                        // Log API response for debugging
                        \Log::info('Waafi API Response', [
                            'response' => $api_response,
                            'trx_id' => $data['trx_id'],
                            'phone_number' => $phone_number,
                            'response_type' => gettype($api_response),
                        ]);
                        
                        // Check if Waafi API response indicates success
                        $is_success = false;
                        $has_error = false;
                        $error_message = null;
                        
                        if (is_array($api_response)) {
                            // Check for explicit error indicators first
                            if (isset($api_response['responseCode']) && 
                                !in_array($api_response['responseCode'], ['2001', '200', '0', '2000', '1001'])) {
                                $error_codes = ['400', '401', '403', '404', '500', '501', '502', '503'];
                                if (in_array($api_response['responseCode'], $error_codes)) {
                                    $has_error = true;
                                }
                            }
                            
                            // Check for error messages
                            if (isset($api_response['responseMsg'])) {
                                $msg = strtolower($api_response['responseMsg']);
                                if (stripos($msg, 'error') !== false || 
                                    stripos($msg, 'failed') !== false || 
                                    stripos($msg, 'declined') !== false ||
                                    stripos($msg, 'rejected') !== false) {
                                    $has_error = true;
                                    $error_message = $api_response['responseMsg'];
                                }
                            }
                            
                            // If no explicit error, check for success indicators
                            if (!$has_error) {
                                // Success codes
                                if (isset($api_response['responseCode']) && 
                                    in_array($api_response['responseCode'], ['2001', '200', '0', '2000', '1001'])) {
                                    $is_success = true;
                                }
                                
                                // Check params.status
                                if (!$is_success && isset($api_response['params']['status'])) {
                                    $status = strtolower($api_response['params']['status']);
                                    if (in_array($status, ['success', 'completed', 'approved', 'paid', 'successful', 'processed'])) {
                                        $is_success = true;
                                    } elseif (in_array($status, ['failed', 'error', 'declined', 'rejected', 'cancelled'])) {
                                        $has_error = true;
                                    }
                                }
                                
                                // Check responseMsg for success keywords
                                if (!$is_success && !$has_error && isset($api_response['responseMsg'])) {
                                    $msg = strtolower($api_response['responseMsg']);
                                    if (stripos($msg, 'success') !== false || 
                                        stripos($msg, 'approved') !== false || 
                                        stripos($msg, 'completed') !== false ||
                                        stripos($msg, 'processed') !== false) {
                                        $is_success = true;
                                    }
                                }
                                
                                // Check top-level status
                                if (!$is_success && !$has_error && isset($api_response['status'])) {
                                    $status = strtolower($api_response['status']);
                                    if (in_array($status, ['success', 'paid', 'completed', 'approved', 'successful', 'processed'])) {
                                        $is_success = true;
                                    }
                                }
                                
                                // If no explicit error and API returned a response (not null/empty), assume success
                                if (!$is_success && !$has_error && !empty($api_response)) {
                                    if (isset($api_response['responseCode']) || isset($api_response['params']) || isset($api_response['responseMsg'])) {
                                        $is_success = true;
                                        \Log::warning('Waafi API: Assuming success due to valid response structure', ['response' => $api_response]);
                                    }
                                }
                            }
                        } elseif (is_object($api_response)) {
                            // Handle object response - same logic as array
                            if (isset($api_response->responseCode) && 
                                !in_array($api_response->responseCode, ['2001', '200', '0', '2000', '1001'])) {
                                $error_codes = ['400', '401', '403', '404', '500', '501', '502', '503'];
                                if (in_array($api_response->responseCode, $error_codes)) {
                                    $has_error = true;
                                }
                            }
                            
                            if (isset($api_response->responseMsg)) {
                                $msg = strtolower($api_response->responseMsg);
                                if (stripos($msg, 'error') !== false || 
                                    stripos($msg, 'failed') !== false || 
                                    stripos($msg, 'declined') !== false ||
                                    stripos($msg, 'rejected') !== false) {
                                    $has_error = true;
                                    $error_message = $api_response->responseMsg;
                                }
                            }
                            
                            if (!$has_error) {
                                if (isset($api_response->responseCode) && 
                                    in_array($api_response->responseCode, ['2001', '200', '0', '2000', '1001'])) {
                                    $is_success = true;
                                }
                                
                                if (!$is_success && isset($api_response->params->status)) {
                                    $status = strtolower($api_response->params->status);
                                    if (in_array($status, ['success', 'completed', 'approved', 'paid', 'successful', 'processed'])) {
                                        $is_success = true;
                                    }
                                }
                                
                                if (!$is_success && isset($api_response->responseMsg)) {
                                    $msg = strtolower($api_response->responseMsg);
                                    if (stripos($msg, 'success') !== false || 
                                        stripos($msg, 'approved') !== false || 
                                        stripos($msg, 'completed') !== false) {
                                        $is_success = true;
                                    }
                                }
                                
                                if (!$is_success && !$has_error && !empty($api_response)) {
                                    if (isset($api_response->responseCode) || isset($api_response->params) || isset($api_response->responseMsg)) {
                                        $is_success = true;
                                        \Log::warning('Waafi API: Assuming success due to valid response structure', ['response' => $api_response]);
                                    }
                                }
                            }
                        } else {
                            $is_success = true;
                            \Log::warning('Waafi API: Unexpected response format, assuming success', ['response' => $api_response]);
                        }
                        
                        // If we detected an error, return it
                        if ($has_error) {
                            return $error_message ?: __('payment_failed_please_try_again');
                        }
                        
                        // If still not successful after all checks, return error
                        if (!$is_success) {
                            $error_msg = __('payment_failed');
                            if (is_array($api_response) && isset($api_response['responseMsg'])) {
                                $error_msg = $api_response['responseMsg'];
                            } elseif (is_object($api_response) && isset($api_response->responseMsg)) {
                                $error_msg = $api_response->responseMsg;
                            }
                            return $error_msg ?: __('payment_failed_please_try_again');
                        }
                        
                        // Store Waafi transaction details
                        $transaction_id = null;
                        if (is_array($api_response) && isset($api_response['params']['transactionId'])) {
                            $transaction_id = $api_response['params']['transactionId'];
                        } elseif (is_object($api_response) && isset($api_response->params->transactionId)) {
                            $transaction_id = $api_response->params->transactionId;
                        }
                        
                        $payment_details = [
                            'phone_number' => $phone_number,
                            'api_response' => $api_response,
                            'api_url' => $api_url,
                            'payment_status' => 'success',
                            'request_id' => $request_id,
                            'reference_id' => $reference_id,
                            'invoice_id' => $invoice_id,
                            'transaction_id' => $transaction_id,
                            'waafi_merchant_uid' => $merchant_uid,
                            'payment_method' => 'Waafi',
                        ];
                        $payment_success = true;
                    }
                } catch (\Exception $e) {
                    // API call failed - return error to keep user on checkout
                    return __('payment_api_error') . ': ' . $e->getMessage();
                }
            } else {
                // No phone number and no file - this should not happen due to validation above
                // But if it does, return error
                return __('phone_number_is_required_for_payment');
            }
            
            // For offline_method, payment must be successful (via API) before creating checkout
            // If payment_success is false, return error to prevent checkout creation
            if (!isset($payment_success) || !$payment_success) {
                $method_name = $is_edahab ? 'eDahab' : 'Waafi';
                \Log::error($method_name . ' Payment Failed', [
                    'trx_id' => $data['trx_id'] ?? 'N/A',
                    'phone_number' => $phone_number ?? 'N/A',
                    'method' => $method_name,
                ]);
                return __('payment_verification_failed_please_try_again');
            }
            
            // Set payment status in $data based on API success for offline_method
            // This will be used in the store() method to set checkout status
            if ($payment_success) {
                $data['payment_status'] = 'success';
                $method_name = $is_edahab ? 'eDahab' : 'Waafi';
                \Log::info($method_name . ' Payment Success - Setting payment_status to success', [
                    'trx_id' => $data['trx_id'],
                    'phone_number' => $phone_number,
                    'method' => $method_name,
                ]);
            }
        } else {
            $payment_details = $this->methodCheck($data);

            if (!$this->successStatusCheck($data, $payment_details)) {
                return __('transaction_cant_be_completed');
            }
            // For other payment methods, if successStatusCheck passes, payment is successful
            $data['payment_status'] = 'success';
        }


        $checkout = $this->store($data, $user->id, $calculations, $payment_details);
        
        // Double-check: If payment was successful but checkout status is still 0, update it
        // This is a safety measure to ensure enrollment works correctly
        if (isset($data['payment_status']) && $data['payment_status'] == 'success' && $checkout->status == 0) {
            \Log::warning('Checkout status mismatch - updating to paid', [
                'checkout_id' => $checkout->id,
                'trx_id' => $checkout->trx_id,
                'payment_status' => $data['payment_status'],
            ]);
            $checkout->update(['status' => 1]);
            $checkout->refresh(); // Reload to get updated status
        }

        $this->insertEnroll($carts, $checkout->id);
        
        // Log enrollment creation for debugging
        \Log::info('Enrollment Created', [
            'checkout_id' => $checkout->id,
            'checkout_status' => $checkout->status,
            'enrolls_count' => $carts->count(),
            'trx_id' => $checkout->trx_id,
        ]);

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
