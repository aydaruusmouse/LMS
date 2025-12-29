<?php

namespace App\Services\Organization\Dashboard;

use App\Models\Course;
use App\Services\Admin\Dashboard\DateWiseQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseStatistic
{
    private $dayNames = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
    ];

    public function execute(Request $request)
    {
        $query   = Course::select(
            DB::raw('DAYNAME(created_at) as day_name'),
            DB::raw('COUNT(*) as data')
        );

        $courses = $this->query($request, $query)
            ->groupBy(DB::raw('DAY(created_at)'))
            ->orderBy(DB::raw('DAY(created_at)'))->get();

        return $this->parseData($courses);
    }

    private function parseData($query)
    {
        $data = [];

        foreach ($this->dayNames as $day) {
            $enrol  = $query->where('day_name', $day)->first();
            $data[] = $enrol ? $query->where('day_name', $day)->first()->data : 0;
        }

        return $data;
    }

    private function query(Request $request, $query)
    {

        return app(DateWiseQuery::class)->query($request, $query);
    }
}
