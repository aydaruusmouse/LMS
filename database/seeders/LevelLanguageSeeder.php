<?php

namespace Database\Seeders;

use App\Models\LevelLanguage;
use Illuminate\Database\Seeder;

class LevelLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        LevelLanguage::create([
            'level_id' => 2,
            'lang'     => 'en',
            'title'    => 'Intermediate',
        ]);
        LevelLanguage::create([
            'level_id' => 3,
            'lang'     => 'en',
            'title'    => 'advanced',
        ]);
    }
}
