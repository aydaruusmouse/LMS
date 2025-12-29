<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Course;
use App\Models\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rating::create([
            'user_id'          => 4,
            'rating'           => 5,
            'commentable_id'   => 1,
            'commentable_type' => Course::class,
            'comment'          => 'lines of code with a single click, just like copying and pasting',
        ]);

        Rating::create([
            'user_id'          => 4,
            'rating'           => 5,
            'commentable_id'   => 1,
            'commentable_type' => Book::class,
            'comment'          => 'lines of code with a single click, just like copying and pasting',
        ]);
    }
}
