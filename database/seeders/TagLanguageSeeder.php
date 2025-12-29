<?php

namespace Database\Seeders;

use App\Models\TagLanguage;
use Illuminate\Database\Seeder;

class TagLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TagLanguage::create([
            'tag_id' => 1,
            'lang'   => 'en',
            'title'  => 'web',
        ]);
        TagLanguage::create([
            'tag_id' => 2,
            'lang'   => 'en',
            'title'  => 'book',
        ]);
        TagLanguage::create([
            'tag_id' => 3,
            'lang'   => 'en',
            'title'  => 'blog',
        ]);
    }
}
