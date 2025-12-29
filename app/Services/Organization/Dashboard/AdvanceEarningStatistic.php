<?php

namespace App\Services\Organization\Dashboard;

use App\Models\Checkout;
use App\Models\Enroll;
use App\Services\Admin\Dashboard\DateWiseQuery;
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

    public function execute(Request $request)
    {

        $query    = Checkout::select(
            DB::raw('DAYNAME(created_at) as day_name'),
            DB::raw('SUM(payable_amount) as data')
        );

        $earnings = $this->query($request, $query)
            ->groupBy(DB::raw('DAY(created_at)'))
            ->orderBy(DB::raw('DAY(created_at)'))
            ->get();

        return [
            'labels'      => $this->dayNames,
            'regular'     => $this->parseData($earnings),
            'offer'       => $this->parseData($earnings),
            'total_sales' => $this->query($request, new Enroll())->sum('price'),
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
