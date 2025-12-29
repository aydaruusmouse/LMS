<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CourseResource;
use App\Http\Resources\Api\UserResource;
use App\Models\Course;
use App\Models\Follow;
use App\Models\User;
use App\Repositories\CourseRepository;
use App\Repositories\UserRepository;
use App\Traits\ApiReturnFormatTrait;

class InstructorController extends Controller
{
    use ApiReturnFormatTrait;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function profile($id): \Illuminate\Http\JsonResponse
    {
        try {
            $auth_user     = jwtUser();
            $user          = $this->userRepository->find($id);
            if (! $user) {
                return $this->responseWithError(__('user_not_found'));
            }
            if ($user->role_id != 2) {
                return $this->responseWithError(__('user_not_found'));
            }
            $instructor    = $user->instructor;
            if (! $instructor) {
                return $this->responseWithError(__('user_not_found'));
            }
            $organization  = $instructor->organization;
            if (! $organization) {
                return $this->responseWithError(__('user_not_found'));
            }
            $total_course  = Course::whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })->count();

            $total_student = User::whereHas('checkout', function ($query) use ($user) {
                $query->whereHas('enrolls.enrollable.users', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                });
            })->count();
            $social_links  = [];

            if ($instructor->social_links) {
                foreach ($instructor->social_links as $key => $social_link) {
                    $social_links[] = [
                        'name' => ucfirst($key),
                        'link' => $social_link,
                    ];
                }
            }

            $data          = [
                'profile_pic'   => $user->profile_pic,
                'name'          => $user->name,
                'designation'   => $instructor->designation,
                'about'         => strip_tags(nullCheck($user->about)),
                'social_links'  => $social_links,
                'is_following'  => $auth_user && $auth_user->following()->where('follower_id', $user->id)->exists(),
                'total_course'  => $total_course,
                'total_student' => $total_student,
                'followers'     => $user->followers()->count(),
                'organization'  => [
                    'id'      => $organization->id,
                    'name'    => $organization->org_name,
                    'logo'    => getFileLink('320x320', $organization->logo),
                    'tagline' => nullCheck($organization->tagline),
                ],
            ];

            return $this->responseWithSuccess(__('profile_fetched_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function students($id, UserRepository $userRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $auth_user     = jwtUser();
            $user          = $this->userRepository->find($id);
            if (! $user) {
                return $this->responseWithError(__('user_not_found'));
            }
            if ($user->role_id != 2) {
                return $this->responseWithError(__('user_not_found'));
            }
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

    public function courses($id, CourseRepository $courseRepository): \Illuminate\Http\JsonResponse
    {
        try {
            $user         = $this->userRepository->find($id);
            if (! $user) {
                return $this->responseWithError(__('user_not_found'));
            }
            if ($user->role_id != 2) {
                return $this->responseWithError(__('user_not_found'));
            }
            $instructor   = $user->instructor;
            if (! $instructor) {
                return $this->responseWithError(__('user_not_found'));
            }
            $organization = $instructor->organization;
            if (! $organization) {
                return $this->responseWithError(__('user_not_found'));
            }
            $total_course = $courseRepository->activeCourses([
                'user_id'           => $id,
                'paginate'          => setting('api_paginate'),
                'instructor_course' => 1,
            ]);

            $data         = [
                'courses' => CourseResource::collection($total_course),
            ];

            return $this->responseWithSuccess(__('course_fetched_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function followUnfollow($id): \Illuminate\Http\JsonResponse
    {
        try {
            $user          = jwtUser();
            $followed_user = $this->userRepository->find($id);
            if (! $followed_user) {
                return $this->responseWithError(__('user_not_found'));
            }
            if ($user->role_id == 3 && $followed_user->role_id != 2) {
                return $this->responseWithError(__('you_can_not_follow_this_user'));
            }
            $is_follow     = Follow::where('follower_id', $followed_user->id)->where('user_id', $user->id)->first();
            if ($is_follow) {
                $is_follow->delete();

                return $this->responseWithSuccess(__('unfollowed_successfully'));
            } else {
                Follow::create([
                    'follower_id' => $followed_user->id,
                    'user_id'     => $user->id,
                ]);

                return $this->responseWithSuccess(__('followed_successfully'));
            }
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
