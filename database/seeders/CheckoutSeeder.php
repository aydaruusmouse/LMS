<?php

namespace Database\Seeders;

use App\Models\Checkout;
use Illuminate\Database\Seeder;

class CheckoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Checkout::create([
            'id'               => 1,
            'user_id'          => 3,
            'billing_address'  => [
                'name'  => 'John Doe',
                'email' => 'john@gmail.com',
                'phone' => '0123235435',
            ],
            'shipping_address' => [
                'name'  => 'John Doe',
                'email' => 'john@gmail.com',
                'phone' => '0123235435',
            ],
            'trx_id'           => 'STU1001',
            'sub_total'        => 20,
            'tax'              => 0.00,
            'discount'         => 2.00,
            'total_amount'     => 20.00,
            'payable_amount'   => 20.00,
            'invoice_no'       => 'SP1001',
            'payment_type'     => 'stripe',
            'invoice_date'     => date('Y-m-d H:i:s'),
            'status'           => 1,
        ]);

        Checkout::create([
            'id'               => 2,
            'user_id'          => 3,
            'billing_address'  => [
                'name'  => 'John Doe',
                'email' => 'john@gmail.com',
                'phone' => '0123235435',
            ],
            'shipping_address' => [
                'name'  => 'John Doe',
                'email' => 'john@gmail.com',
                'phone' => '0123235435',
            ],
            'trx_id'           => 'STU1002',
            'sub_total'        => 500.00,
            'tax'              => 0.00,
            'discount'         => 0.00,
            'total_amount'     => 500.00,
            'payable_amount'   => 500.00,
            'invoice_no'       => 'SP1002',
            'payment_type'     => 'stripe',
            'invoice_date'     => date('Y-m-d H:i:s'),
            'status'           => 1,
        ]);
    }
}
