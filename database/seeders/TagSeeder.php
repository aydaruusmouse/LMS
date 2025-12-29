<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'id'    => 1,
            'title' => 'web',
        ]);
        Tag::create([
            'id'    => 2,
            'title' => 'book',
        ]);
        Tag::create([
            'id'    => 3,
            'title' => 'blog',
        ]);
    }
}
