<?php

namespace App\Http\Controllers\Api\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\FollowResource;
use App\Http\Resources\Api\MyCourseResource;
use App\Http\Resources\Api\UserResource;
use App\Models\Follow;
use App\Models\User;
use App\Repositories\CourseRepository;
use App\Repositories\UserRepository;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    use ApiReturnFormatTrait;

    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function students(): JsonResponse
    {
        try {
            $user          = jwtUser();
            $instructor    = $user->instructor;
            if (! $instructor) {
                return $this->responseWithError(__('user_not_found'));
            }
            $organization  = $instructor->organization;
            if (! $organization) {
                return $this->responseWithError(__('user_not_found'));
            }

            $total_student = User::whereHas('checkout', function ($query) use ($user) {
                $query->whereHas('enrolls.enrollable.users', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                });
            })->paginate(setting('api_paginate'));

            $data          = [
                'students' => UserResource::collection($total_student),
            ];

            return $this->responseWithSuccess(__('student_fetched_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function profile($id): JsonResponse
    {
        try {
            $user = $this->userRepository->instructorStudentFind($id, jwtUser());
            if (! $user) {
                return $this->responseWithError(__('user_not_found'));
            }
            $data = [
                'id'      => $user->id,
                'name'    => $user->name,
                'email'   => $user->email,
                'address' => nullCheck($user->address),
                'image'   => $user->profile_pic,
            ];

            return $this->responseWithSuccess(__('student_fetched_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function courses($id, CourseRepository $courseRepository): JsonResponse
    {
        try {
            $user  = $this->userRepository->instructorStudentFind($id, jwtUser());
            if (! $user) {
                return $this->responseWithError(__('user_not_found'));
            }
            $input = [
                'my_course' => 1,
                'user_id'   => $id,
                'paginate'  => setting('api_paginate'),
            ];
            $data  = [
                'courses' => MyCourseResource::collection($courseRepository->activeCourses($input)),
            ];

            return $this->responseWithSuccess(__('course_fetched_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function certificates($id, CourseRepository $courseRepository): JsonResponse
    {
        try {
            $input          = [
                'my_course'   => 1,
                'user_id'     => $id,
                'paginate'    => setting('api_paginate'),
                'course_view' => setting('course_view_percent'),
            ];

            $courses        = MyCourseResource::collection($courseRepository->activeCourses($input));
            $updatedCourses = [];

            foreach ($courses as $course) {
                if ($course->enrolls[0]->complete_count > setting('course_view_percent')) {
                    $updatedCourses[] = $course;
                }
            }
            $data           = [
                'courses' => $updatedCourses,
            ];

            return $this->responseWithSuccess('course_retrieved_successfully', $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function followingUser($id): JsonResponse
    {
        try {
            $user      = $this->userRepository->instructorStudentFind($id, jwtUser());
            if (! $user) {
                return $this->responseWithError(__('user_not_found'));
            }
            $following = Follow::whereHas('follower.instructor')->with('follower.instructor')->where('user_id', $id)->paginate(setting('api_paginate'));
            $data      = [
                'following' => FollowResource::collection($following),
            ];

            return $this->responseWithSuccess(__('following_fetched_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
