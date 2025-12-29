<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::create([
            'id'                   => 1,
            'title'                => 'course',
            'user_id'              => 3,
            'payment_method'       => 'cash',
            'amount'               => 1000.00,
            'trx_id'               => 'STU1001',
            'date'                 => date('Y-m-d'),
            'transactionable_id'   => 1,
            'transactionable_type' => 'course',
            'status'               => 'paid',
        ]);
        Transaction::create([
            'id'                   => 2,
            'title'                => 'book',
            'user_id'              => 3,
            'payment_method'       => 'cash',
            'amount'               => 500.00,
            'trx_id'               => 'STU1002',
            'date'                 => date('Y-m-d'),
            'transactionable_id'   => 1,
            'transactionable_type' => 'book',
            'status'               => 'paid',
        ]);
    }
}
