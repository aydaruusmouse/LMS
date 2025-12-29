<?php

namespace App\Repositories;

use App\Models\Meeting;

class MeetingRepository
{
    public function myMeeting($data = [])
    {
        return Meeting::whereJsonContains('invitation_ids', (string) $data['user_id'])->paginate(setting('paginate'));
    }
}
