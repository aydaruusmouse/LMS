<?php

namespace App\Services\Admin\Dashboard;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseStatistic
{
    private $months = [
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

    private $data   = [];

    public function execute(Request $request)
    {

        $firstDayOfLastMonth = Carbon::now()->subMonth()->startOfMonth();

        $lastDayOfLastMonth  = Carbon::now()->subMonth()->endOfMonth();

        $query               = Course::select(
            DB::raw('MONTHNAME(created_at) as month_name'),
            DB::raw('COUNT(*) as data')
        )

            // ->whereDate('created_at', '>=', $firstDayOfLastMonth)
            // ->whereDate('created_at', '<=', $lastDayOfLastMonth)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        foreach ($this->months as $full_month => $sort_month) {
            $enrol        = $query->where('month_name', $full_month)->first();
            $this->data[] = $enrol ? $query->where('month_name', $full_month)->first()->data : 0;
        }

        return $this->data;
    }
}
