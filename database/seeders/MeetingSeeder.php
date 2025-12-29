<?php

namespace Database\Seeders;

use App\Models\Meeting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meeting::create([
            'instructor_id'  => '2',
            'invitation_ids' => ['3', '5'],
            'start_date'     => Carbon::now(),
            'end_date'       => Carbon::today()->addDay(),
            'meeting_link'   => 'https://meet.google.com/psg-rbsi-yto',
        ]);
    }
}
