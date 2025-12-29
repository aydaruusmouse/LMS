<?php

return [
    'MERCHANT_ID'            => setting('jazz_cash_merchant_id'),
    'PASSWORD'               => setting('jazz_cash_password'),
    'INTEGERITY_SALT'        => setting('jazz_cash_integrity_salt'),
    'CURRENCY_CODE'          => 'PKR',
    'VERSION'                => '1.1',
    'LANGUAGE'               => 'EN',
    'RETURN_URL'             => '/user/complete-order/{id}',
    'TRANSACTION_POST_URL'   => 'https://sandbox.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform/',
    'JAZZCASH_HTTP_POST_URL' => 'https://sandbox.jazzcash.com.pk/ApplicationAPI/API/2.0/Purchase/DoMWalletTransaction',
];
