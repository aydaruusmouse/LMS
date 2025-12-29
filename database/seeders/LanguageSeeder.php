<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'name'   => 'Bangla',
            'locale' => 'bn',
            'flag'   => 'images/flags/bd.png',
        ]);

        Language::create([
            'name'           => 'Arabic',
            'locale'         => 'ar',
            'text_direction' => 'rtl',
            'flag'           => 'images/flags/ar.png',
        ]);
    }
}
