<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Rating;
use App\Repositories\BadgeRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\UserRepository;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function __construct(OrganizationRepository $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    public function details($slug, BadgeRepository $badge, UserRepository $userRepository): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $organization        = $this->organizationRepository->findBySlug($slug);
            $organization_create = Carbon::parse(date('Y-m-d', strtotime($organization->created_at)));
            $user_life_time_days = today()->diffInDays($organization_create);
            $course_id           = $organization->courses->pluck('id')->toArray();
            $data                = [
                'organization'      => $organization,
                'badges'            => $badge->activeBadge(['to_day' => $user_life_time_days]),
                'total_instructors' => $organization->instructors_count,
                'total_courses'     => $organization->courses_count,
                'total_students'    => $userRepository->enrollableStudent($course_id),
                'total_enrolls'     => Enroll::whereIn('enrollable_id', $course_id)->where('enrollable_type', Course::class)->count(),
                'instructors'       => $organization->instructors()->with('user')->paginate(8),
                'courses'           => $organization->courses()->with('category')->paginate(6),
                'total_rating'      => Rating::whereHasMorph('commentable', [Course::class], function ($query) use ($organization) {
                    $query->where('organization_id', $organization->id);
                })->avg('rating'),
                'total_review'      => Rating::whereHasMorph('commentable', [Course::class], function ($query) use ($organization) {
                    $query->where('organization_id', $organization->id);
                })->count(),
            ];

            return view('frontend.organization.details', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function loadInstructor(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $organization    = $this->organizationRepository->find($request->id);
            $instructors     = $organization->instructors()->with('user')->paginate(8);
            $instructor_view = '';
            foreach ($instructors as $key => $instructor) {
                $vars = [
                    'instructor' => $instructor,
                    'key'        => $key,
                ];
                $instructor_view .= view('frontend.instructor_load_more', $vars)->render();
            }

            return response()->json([
                'html'      => $instructor_view,
                'next_page' => $instructors->nextPageUrl(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function loadCourse(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $organization = $this->organizationRepository->find($request->id);
            $courses      = $organization->courses()->with('category')->paginate(6);
            $course_view  = '';
            foreach ($courses as $key => $course) {
                $vars = [
                    'course' => $course,
                    'key'    => $key,
                    'col'    => 'col-lg-4',
                ];
                $course_view .= view('frontend.course.component', $vars)->render();
            }

            return response()->json([
                'html'      => $course_view,
                'next_page' => $courses->nextPageUrl(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
