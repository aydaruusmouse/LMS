<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feedback::create([
            'title'       => 'Good',
            'slug'        => 'good',
            'description' => "It was nice for me to be able to do the assignments and tests at my leisure and when I had the time. I loved how you stated unequivocally that additional online research may be required for some assignments. To be honest, there was nothing I didn't appreciate about the course.
            I will undoubtedly take another online course from you!",
            'user_id'     => 3,
        ]);
    }
}
