<?php

namespace App\Services\Admin\Dashboard;

use App\Models\Checkout;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvanceEarningStatistic
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

    private $DAYNAMEs = [
        'January'   => 'Jan',
        'February'  => 'Feb',
        'March'     => 'Mar',
        'April'     => 'Apr',
        'May'       => 'May',
        'June'      => 'Jun',
        'July'      => 'Jul',
        'August'    => 'Aug',
        'September' => 'Sep',
        'October'   => 'Oct',
        'November'  => 'Nov',
        'December'  => 'Dec',
    ];

    public function execute(Request $request)
    {

        $query    = User::select(
            DB::raw('DAYNAME(created_at) as day_name'),
            DB::raw('COUNT(*) as data')
        )
            ->where('user_type', 'student');
        $students = $this->query($request, $query)->get();

        $query    = Course::select(
            DB::raw('DAYNAME(created_at) as day_name'),
            DB::raw('COUNT(*) as data')
        );

        $courses  = $this->query($request, $query)
            ->groupBy(DB::raw('DAY(created_at)'))
            ->orderBy(DB::raw('DAY(created_at)'))->get();

        $query    = Checkout::select(
            DB::raw('DAYNAME(created_at) as day_name'),
            DB::raw('SUM(payable_amount) as data')
        );

        $earnings = $this->query($request, $query)
            ->groupBy(DB::raw('DAY(created_at)'))
            ->orderBy(DB::raw('DAY(created_at)'))
            ->get();

        return [
            'labels'            => $this->dayNames,
            'student'           => $this->parseData($students),
            'course'            => $this->parseData($courses),
            'earning'           => $this->parseData($earnings),
            'new_student_count' => $this->query($request, User::where('user_type', 'student'))->count(),
            'new_course_count'  => $this->query($request, new Course())->count(),
            'total_sales'       => $this->query($request, new Enroll())->sum('price'),
        ];
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
