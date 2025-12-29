<?php

namespace App\Repositories;

use App\Models\LiveClass;
use Carbon\Carbon;

class LiveClassRepository
{
    public function all($data = [])
    {
        if (! arrayCheck('paginate', $data)) {
            $data['paginate'] = setting('paginate');
        }

        return LiveClass::active()->pagiante($data['paginate']);
    }

    public function allLiveClass()
    {
        return LiveClass::latest()->paginate(10);
    }

    public function store($request, $id)
    {
        $request['user_id']          = auth()->id();
        $request['course_id']        = $id;
        $request['meeting_method']   = $request['LiveClassmeetingMethod'];
        $request['description']      = $request['liveClassDescription'];
        $request['meeting_link']     = $request['LiveClassmeetingLink'];
        $request['meeting_password'] = $request['LiveClassmeetingPassword'];
        $request['meeting_id']       = $request['LiveClassMeetingID'];

        if (arrayCheck('class_date', $request)) {
            $dates               = explode(' - ', $request['dateRange']);
            $request['start_at'] = Carbon::parse($dates[0]);
            $request['end_at']   = Carbon::parse($dates[1]);
        }

        return LiveClass::create($request);
    }

    public function update($request, $id)
    {
        $liveClass                   = LiveClass::where('course_id', $id)->first();
        $request['user_id']          = auth()->id();
        $request['course_id']        = $id;
        $request['meeting_method']   = $request['LiveClassmeetingMethod'];
        $request['description']      = $request['liveClassDescription'];
        $request['meeting_link']     = $request['LiveClassmeetingLink'];
        $request['meeting_password'] = $request['LiveClassmeetingPassword'];
        $request['meeting_id']       = $request['LiveClassMeetingID'];

        if (arrayCheck('dateRange', $request)) {
            $dates               = explode(' - ', $request['dateRange']);
            $request['start_at'] = Carbon::parse($dates[0]);
            $request['end_at']   = Carbon::parse($dates[1]);

        }

        return $liveClass->update($request);
    }

    public function destroy($id): int
    {
        return LiveClass::destroy($id);
    }

    public function myMeeting($courseIds = [])
    {
        return LiveClass::whereIn('course_id', $courseIds)
            ->with('course.user')
            ->get();
    }
}
