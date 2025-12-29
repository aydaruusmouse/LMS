<?php

namespace Database\Seeders;

use App\Models\ApiKey;
use App\Models\ApiKeyLanguage;
use Illuminate\Database\Seeder;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApiKey::create([
            'title'   => 'Student App',
            'key'     => 'spagreen_',
            'status'  => 1,
            'user_id' => 1,
        ]);
        ApiKey::create([
            'title'   => 'Instructor App',
            'key'     => 'spagreen',
            'status'  => 1,
            'user_id' => 1,
        ]);
        ApiKeyLanguage::create([
            'title'      => 'Student App',
            'api_key_id' => 1,
        ]);
        ApiKeyLanguage::create([
            'title'      => 'Instructor App',
            'api_key_id' => 2,
        ]);
    }
}
