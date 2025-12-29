<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Level::create([
            'id'    => 2,
            'title' => 'Intermediate',
        ]);
        Level::create([
            'id'    => 3,
            'title' => 'Advanced',
        ]);
    }
}
