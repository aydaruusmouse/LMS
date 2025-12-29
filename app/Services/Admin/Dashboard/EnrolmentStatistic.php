<?php

namespace App\Services\Admin\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrolmentStatistic
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

        $query = DB::table('enrolls')->select(
            DB::raw('MONTHNAME(created_at) as month_name'),
            DB::raw('COUNT(*) as data')
        )

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
