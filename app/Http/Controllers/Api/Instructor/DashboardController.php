<?php

namespace App\Http\Controllers\Api\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\EnrolledCourseResource;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\User;
use App\Traits\ApiReturnFormatTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ApiReturnFormatTrait;

    public function dashboard(Request $request): JsonResponse
    {
        try {
            $user                = jwtUser();
            $currency_code       = $request->currency ?: null;

            $enroll_monthly_stat = Enroll::whereHas('enrollable.users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })->selectRaw('COUNT(*) as total_students,MONTH(created_at) month,DATE_FORMAT(created_at,"%b") as month_name')
                ->whereYear('created_at', now()->year)->when($request->start_date && $request->end_date, function ($query) use ($request) {
                    $query->whereBetween('created_at', [Carbon::parse($request->start_date)->format('Y-m-d H:i:s 00:00:00'), Carbon::parse($request->end_date)->format('Y-m-d H:i:s 23:59:59')]);
                })->groupBy('month')->orderBy('month')->get();

            $enroll_stats        = [];
            $month_names         = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            foreach ($month_names as $key => $month_name) {
                $enroll_stats[$month_name] = 0;
            }

            foreach ($enroll_monthly_stat as $item) {
                $enroll_stats[$item->month_name] = $item->total_students;
            }

            $latest_enrolls      = Enroll::whereHas('checkout')->whereHas('enrollable.users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })->with('enrollable')->latest()->take(5)->get();

            $data                = [
                'total_student'    => User::whereHas('checkout', function ($query) use ($user) {
                    $query->whereHas('enrolls.enrollable.users', function ($query) use ($user) {
                        $query->where('users.id', $user->id);
                    });
                })->count(),
                'total_course'     => Course::whereHas('users', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                })->count(),
                'total_earning'    => get_price(100, $currency_code),
                'total_enrollment' => Enroll::whereHas('enrollable.users', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                })->count(),
                'enroll_stats'     => $enroll_stats,
                'latest_enrolls'   => EnrolledCourseResource::collection($latest_enrolls),
            ];

            return $this->responseWithSuccess(__('dashboard_data_fetched_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function getStats(Request $request): JsonResponse
    {
        try {
            $user = jwtUser();
            if ($request->type == 'yearly') {
                $enroll_yearly_stat = Enroll::whereHas('enrollable.users', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                })->selectRaw('COUNT(*) as total_students,YEAR(created_at) year')
                    ->groupBy('year')->orderBy('year')->get();

                $enroll_stats       = [];
                foreach ($enroll_yearly_stat as $item) {
                    $enroll_stats[$item->year] = $item->total_students;
                }
            } elseif ($request->type == 'weekly') {
                $enroll_weekly_stat = Enroll::whereHas('enrollable.users', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                })->selectRaw('COUNT(*) as total_students,WEEK(created_at) week')
                    ->whereYear('created_at', now()->year)->groupBy('week')->orderBy('week')->get();
                $enroll_stats       = [];
                for ($i = 1; $i <= 52; $i++) {
                    $enroll_stats[$i] = 0;
                }

                foreach ($enroll_weekly_stat as $item) {
                    $enroll_stats[$item->week] = $item->total_students;
                }
            } else {
                $enroll_monthly_stat = Enroll::whereHas('enrollable.users', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                })->selectRaw('COUNT(*) as total_students,MONTH(created_at) month,DATE_FORMAT(created_at,"%b") as month_name')
                    ->whereYear('created_at', now()->year)->groupBy('month')->orderBy('month')->get();
                $enroll_stats        = [];
                $month_names         = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

                foreach ($month_names as $month_name) {
                    $enroll_stats[$month_name] = 0;
                }

                foreach ($enroll_monthly_stat as $item) {
                    $enroll_stats[$item->month_name] = $item->total_students;
                }
            }

            return $this->responseWithSuccess(__('stat_fetched_successfully'), $enroll_stats);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function enrollments(): JsonResponse
    {
        try {
            $user           = jwtUser();
            $latest_enrolls = Enroll::whereHas('checkout')->whereHas('enrollable.users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })->with('enrollable')->latest()->paginate(setting('api_paginate'));
            $data           = [
                'enrollments' => EnrolledCourseResource::collection($latest_enrolls),
            ];

            return $this->responseWithSuccess(__('enrollments_fetched_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
