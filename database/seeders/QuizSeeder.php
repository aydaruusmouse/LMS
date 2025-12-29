<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now  = now();

        $data = [
            [
                'title'       => 'Software development',
                'section_id'  => 1,
                'slug'        => 'software development',
                'duration'    => 60,
                'total_marks' => 100,
                'pass_marks'  => 50,
                'status'      => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'title'       => 'Web design',
                'section_id'  => 1,
                'slug'        => 'web design',
                'duration'    => 120,
                'total_marks' => 100,
                'pass_marks'  => 50,
                'status'      => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        Quiz::insert($data);
    }
}
