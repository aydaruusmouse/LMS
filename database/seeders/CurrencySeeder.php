<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'id'            => 2,
            'name'          => 'Taka',
            'symbol'        => 'TK',
            'code'          => 'BDT',
            'exchange_rate' => 100,
        ]);
        Currency::create([
            'id'            => 3,
            'name'          => 'Euro',
            'symbol'        => '€',
            'code'          => 'EUR',
            'exchange_rate' => 0.89,
        ]);
        Currency::create([
            'id'            => 4,
            'name'          => 'Indian Rupee',
            'symbol'        => '₹',
            'code'          => 'INR',
            'exchange_rate' => 82.08,
        ]);
        Currency::create([
            'id'            => 5,
            'name'          => 'Ghana Cedi',
            'symbol'        => ' GH₵ ',
            'code'          => 'GHS',
            'exchange_rate' => 11.35,
        ]);
        Currency::create([
            'id'            => 6,
            'name'          => 'West African CFA franc',
            'symbol'        => 'CFA',
            'code'          => 'XOF',
            'exchange_rate' => 583.15,
        ]);
        Currency::create([
            'id'            => 7,
            'name'          => 'Nigerian Naira',
            'symbol'        => '₦',
            'code'          => 'NGN',
            'exchange_rate' => 776.50,
        ]);
        Currency::create([
            'id'            => 8,
            'name'          => 'Indonesian Rupiah',
            'symbol'        => 'Rp',
            'code'          => 'IDR',
            'exchange_rate' => 15003.00,
        ]);
        Currency::create([
            'id'            => 9,
            'name'          => 'Singapore Dollar',
            'symbol'        => '$',
            'code'          => 'SGD',
            'exchange_rate' => 1.32,
        ]);

    }
}
