<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Traits\AccountingTrait;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    use AccountingTrait;

    public function run()
    {
        /*$income_accounts = ['Income Account','Paypal','Stripe', 'Mollie', 'Skrill', 'SSLCommerze', 'bKash', 'Nagad', 'Aamarpay','Paytm','Razorpay','Flutterwave','Paystack',
            'Google Pay','Mercado Pago','KkiApay','JazzCash','Midtrans','Telr','Iyzico','HitPay'];

        $defaults = ['income', 'paypal','stripe', 'mollie', 'skrill', 'ssl_commerze', 'bkash', 'nagad', 'aamarpay','paytm','razor_pay','flutter_wave','paystack','google_pay','mercadopago','kkiapay',
            'jazz_cash','mid_trans','telr','iyzico','hitpay'];

        $rows = [];

        foreach ($income_accounts as $key=> $income_account)
        {
            $rows[] = [
                'name'              => $income_account,
                'user_id'           => 1,
                'type'              => 'income',
                'default_for'       => $defaults[$key],
                'opening_balance'   => $key == 0 ? 500 : 0,
                'description'       => $income_account . ' Income account',
                'is_deletable'      => 0,
                'created_at'        => now(),
                'updated_at'        => now()
            ];
        }

        Account::insert($rows);

        Account::create([
            'name'              => 'Expense Account',
            'user_id'           => 1,
            'type'              => 'expense',
            'default_for'       => 'expense',
            'opening_balance'   => 0,
            'description'       => 'Opening balance for expense account',
            'is_deletable'      => 0,
        ]);*/

        /*  $this->income([
              'title'                 => 'opening balance',
              'amount'                => 500,
              'account_id'            => 1,
              'description'           => 'Opening balance for income account',
              'reference'             => 'Opening balance',
              'transactionable_id'    => 1,
              'transactionable_type'  => 'App\Models\Account'
          ]);*/
    }
}
