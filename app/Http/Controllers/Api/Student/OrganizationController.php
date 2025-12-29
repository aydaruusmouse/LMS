<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CourseResource;
use App\Http\Resources\Api\UserResource;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Rating;
use App\Models\User;
use App\Repositories\CourseRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\UserRepository;
use App\Traits\ApiReturnFormatTrait;

class OrganizationController extends Controller
{
    use ApiReturnFormatTrait;

    protected $organizationRepository;

    public function __construct(OrganizationRepository $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    public function profile($id): \Illuminate\Http\JsonResponse
    {
        try {
            $organization  = $this->organizationRepository->find($id);
            if (! $organization) {
                return $this->responseWithError('organization_not_found');
            }
            $review        = Rating::whereHasMorph('commentable', [Course::class], function ($query) use ($id) {
                $query->where('organization_id', $id);
            })->avg('rating');

            $total_review  = Rating::whereHasMorph('commentable', [Course::class], function ($query) use ($id) {
                $query->where('organization_id', $id);
            })->count();

            $total_student = User::whereHas('checkout', function ($query) use ($id) {
                $query->whereHas('enrolls', function ($query) use ($id) {
                    $query->whereHasMorph('enrollable', [Course::class], function ($query) use ($id) {
                        $query->where('organization_id', $id);
                    });
                });
            })->count();

            $total_enrolls = Enroll::whereHasMorph('enrollable', [Course::class], function ($query) use ($id) {
                $query->where('organization_id', $id);
            })->count();

            $data          = [
                'id'                => $id,
                'name'              => $organization->org_name,
                'address'           => nullCheck($organization->address),
                'rating'            => number_format($review, 2),
                'total_review'      => $total_review,
                'brand_color'       => $organization->brand_color ?? '#609966',
                'phone'             => nullCheck($organization->phone),
                'email'             => nullCheck($organization->email),
                'total_course'      => $organization->courses()->count(),
                'total_instructor'  => $organization->instructors()->count(),
                'total_students'    => $total_student,
                'total_enrollments' => $total_enrolls,
                'logo'              => getFileLink('72x72', $organization->logo),
            ];

            return $this->responseWithSuccess(__('profile_fetched_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function instructors($id, UserRepository $userRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $organization     = $this->organizationRepository->find($id);
            if (! $organization) {
                return $this->responseWithError('organization_not_found');
            }

            $total_instructor = $userRepository->searchUsers([], [
                'paginate'        => setting('api_paginate'),
                'role_id'         => 2,
                'organization_id' => $id,
            ]);
            $data             = [
                'instructors' => UserResource::collection($total_instructor),
            ];

            return $this->responseWithSuccess(__('instructor_fetched_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function courses($id, CourseRepository $courseRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $organization = $this->organizationRepository->find($id);
            if (! $organization) {
                return $this->responseWithError('organization_not_found');
            }
            $total_course = $courseRepository->activeCourses([
                'user_id'             => $id,
                'paginate'            => setting('api_paginate'),
                'organization_course' => $id,
            ]);

            $data         = [
                'courses' => CourseResource::collection($total_course),
            ];

            return $this->responseWithSuccess(__('course_fetched_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
