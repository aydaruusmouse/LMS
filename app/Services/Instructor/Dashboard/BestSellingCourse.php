<?php

namespace App\Services\Instructor\Dashboard;

use App\Models\Course;
use Illuminate\Http\Request;

class BestSellingCourse
{
    public function execute(Request $request)
    {

        if ($request->best_selling_course) {
            return app(DateWiseQuery::class)->query($request, Course::withCount('enrolls')->with('enrolls')->whereHas('enrolls'))
                ->whereHas('users', function ($query) {
                    $query->where('users.id', auth()->id());
                })->orderBy('enrolls_count', 'desc')
                ->limit(100)
                ->get();
        }

        return Course::withCount('enrolls')->with('enrolls')
            ->whereHas('enrolls')
            ->whereHas('users', function ($query) {
                $query->where('users.id', auth()->id());
            })->orderBy('enrolls_count', 'desc')
            ->limit(100)
            ->get();
    }
}
