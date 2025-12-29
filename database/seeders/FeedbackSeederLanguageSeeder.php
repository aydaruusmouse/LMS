<?php

namespace Database\Seeders;

use App\Models\FeedbackLanguage;
use Illuminate\Database\Seeder;

class FeedbackSeederLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FeedbackLanguage::create([
            'title'       => 'Good',
            'lang'        => 'en',
            'description' => "It was nice for me to be able to do the assignments and tests at my leisure and when I had the time. I loved how you stated unequivocally that additional online research may be required for some assignments. To be honest, there was nothing I didn't appreciate about the course. 
            I will undoubtedly take another online course from you!",
            'feedback_id' => 1,
        ]);
    }
}
