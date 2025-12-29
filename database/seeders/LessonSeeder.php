<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lesson::create([
            'title'       => 'Learn new things and improve your knowledge and skills',
            'lesson_type' => 'video',
            'course_id'   => 1,
            'slug'        => 'learn-new-things-one',
            'is_free'     => 0,
            'source'      => 'upload',
            'source_data' => 'files/Every programming tutorial.mp4',
            'status'      => 1,
            'duration'    => '00:02:00',
            'section_id'  => 1,
        ]);
    }
}
