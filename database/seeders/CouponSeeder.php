<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'id'             => 1,
            'title'          => 'Spagreen404',
            'slug'           => Str::slug('Spagreen404'),
            'type'           => 'course',
            'code'           => 404,
            'discount'       => 40,
            'discount_type'  => 'percent',
            'start_date'     => now(),
            'end_date'       => now()->addMonths(1),
            'course_ids'     => [1, 2],
            'instructor_ids' => [1],
            'user_id'        => 1,
            'status'         => 1,
        ]);
    }
}
