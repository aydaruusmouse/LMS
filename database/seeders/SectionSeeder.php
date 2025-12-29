<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::create([
            'id'        => 1,
            'title'     => 'Getting CSS from Photoshop: The Very Basic No Code Approach',
            'slug'      => 'CSS-from-Photoshop',
            'course_id' => 1,
        ]);
    }
}
