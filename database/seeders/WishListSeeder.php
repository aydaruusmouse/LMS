<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Course;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class WishListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wishlist::create([
            'wishable_type' => Course::class,
            'user_id'       => 1,
            'wishable_id'   => 1,
        ]);
        Wishlist::create([
            'wishable_type' => Course::class,
            'user_id'       => 1,
            'wishable_id'   => 2,
        ]);
        Wishlist::create([
            'wishable_type' => Course::class,
            'user_id'       => 1,
            'wishable_id'   => 3,
        ]);
        Wishlist::create([
            'wishable_type' => Course::class,
            'user_id'       => 1,
            'wishable_id'   => 4,
        ]);
        Wishlist::create([
            'wishable_type' => Course::class,
            'user_id'       => 1,
            'wishable_id'   => 5,
        ]);

        Wishlist::create([
            'wishable_type' => Book::class,
            'user_id'       => 1,
            'wishable_id'   => 1,
        ]);
    }
}
