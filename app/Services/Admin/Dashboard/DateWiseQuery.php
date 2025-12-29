<?php

namespace App\Services\Admin\Dashboard;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DateWiseQuery
{
    public function query(Request $request, $query)
    {
        return $query->when($request->query_string == 'today' ?? false, function ($query) {

            $start = Carbon::now()->startOfDay();

            $end   = Carbon::now()->endOfDay();

            $query->whereBetween('created_at', [$start, $end]);
        })

            ->when($request->query_string == 'last_seven_days' ?? false, function ($query) {

                // Calculate the date 7 days ago from the current date
                $sevenDaysAgo         = Carbon::now()->subDays(7);

                // Start of last seven days
                $startOfLastSevenDays = $sevenDaysAgo->startOfDay();

                // End of last seven days (today's date)
                $endOfLastSevenDays   = Carbon::now()->endOfDay();

                $query->whereBetween('created_at', [
                    $startOfLastSevenDays, $endOfLastSevenDays,
                ]);
            })

            ->when($request->query_string == 'last_fourteen_days' ?? false, function ($query) {

                // Calculate the date 7 days ago from the current date
                $sevenDaysAgo         = Carbon::now()->subDays(14);

                // Start of last seven days
                $startOfLastSevenDays = $sevenDaysAgo->startOfDay();

                // End of last seven days (today's date)
                $endOfLastSevenDays   = Carbon::now()->endOfDay();

                $query->whereBetween('created_at', [
                    $startOfLastSevenDays, $endOfLastSevenDays,
                ]);
            })

            ->when($request->query_string == 'last_month' ?? false, function ($query) {

                // Get the current date

                // Calculate the first day of the last month
                $firstDayOfLastMonth = Carbon::now()->subMonth()->startOfMonth();

                // Calculate the last day of the last month
                $lastDayOfLastMonth  = Carbon::now()->subMonthNoOverflow()->endOfMonth();

                // Query for reports in the last month
                $query->whereBetween('created_at', [$firstDayOfLastMonth, $lastDayOfLastMonth]);
            })

            ->when($request->query_string == 'last_six_months' ?? false, function ($query) {

                // Calculate the date 6 months ago from the current date
                $sixMonthsAgo = Carbon::now()->subMonths(6)->startOfMonth();

                // Query for reports in the last 6 months
                $query->whereBetween('created_at', [$sixMonthsAgo, Carbon::now()]);
            })

            ->when($request->query_string == 'last_twelve_months' ?? false, function ($query) {

                // Calculate the date 6 months ago from the current date
                $twelveMonthAgo = Carbon::now()->subMonths(12)->startOfMonth();

                // Query for reports in the last 12 months
                $query->whereBetween('created_at', [$twelveMonthAgo, Carbon::now()]);
            });
    }
}
