<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Course;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run()
    {
        Cart::create([
            'id'            => 1,
            'instructor_id' => 2,
            'user_id'       => 3,
            'quantity'      => 1,
            'price'         => 15.00,
            'discount'      => 0.00,
            'trx_id'        => 'STU1001',
            'cartable_id'   => 1,
            'total_amount'  => 15.00,
            'sub_total'     => 15.00,
            'cartable_type' => Course::class,
        ]);
    }
}
