<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Testimonial::create([
            'id'          => 1,
            'name'        => 'Natasha Hope',
            'description' => "We're loving it. OVOY LMS is both perfect    and highly adaptable.",
        ]);
        Testimonial::create([
            'id'          => 2,
            'name'        => 'Charles Dale',
            'description' => "We're loving it. OVOY LMS is both perfect    and highly adaptable.",
        ]);
    }
}
