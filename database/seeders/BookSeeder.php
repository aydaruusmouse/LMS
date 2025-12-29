<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::create([
            'id'                => 1,
            'title'             => fake()->title(),
            'slug'              => fake()->title(),
            'user_id'           => 1,
            'instructor_id'     => 2,
            'price'             => 500.00,
            'subject_id'        => 1,
            'discount'          => 50.00,
            'discount_type'     => 'flat',
            'status'            => 1,
            'discount_start_at' => now(),
            'discount_end_at'   => now()->addMonths(2),
            'total_rating'      => 5,
        ]);
        Book::create([
            'id'                => 2,
            'title'             => fake()->title(),
            'slug'              => fake()->title(),
            'user_id'           => 1,
            'instructor_id'     => 2,
            'price'             => 0.00,
            'subject_id'        => 1,
            'discount'          => 0.00,
            'discount_type'     => 'flat',
            'status'            => 1,
            'discount_start_at' => now(),
            'discount_end_at'   => now()->addMonths(2),
            'is_free'           => 1,
        ]);
    }
}
