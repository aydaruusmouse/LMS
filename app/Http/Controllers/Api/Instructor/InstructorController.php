<?php

namespace App\Http\Controllers\Api\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Repositories\InstructorRepository;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    use ApiReturnFormatTrait;

    public function profile(): JsonResponse
    {
        try {
            $user         = jwtUser();
            $instructor   = $user->instructor;
            if (! $instructor) {
                return $this->responseWithError(__('user_not_found'));
            }
            $organization = $instructor->organization;
            if (! $organization) {
                return $this->responseWithError(__('user_not_found'));
            }
            $social_links = [];
            if ($instructor->social_links) {
                foreach ($instructor->social_links as $key => $social_link) {
                    $social_links[] = [
                        'name' => ucfirst($key),
                        'link' => $social_link,
                    ];
                }
            }
            $data         = [
                'profile_pic'       => $user->profile_pic,
                'name'              => $user->name,
                'designation'       => $instructor->designation,
                'organization_name' => $organization->name,
                'social_links'      => $social_links,
                'total_course'      => Course::whereHas('users', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                })->count(),
                'total_student'     => User::whereHas('checkout', function ($query) use ($user) {
                    $query->whereHas('enrolls.enrollable.users', function ($query) use ($user) {
                        $query->where('users.id', $user->id);
                    });
                })->count(),
                'followers'         => count($user->followers),
                'followings'        => count($user->following),
            ];

            return $this->responseWithSuccess(__('profile_fetched_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    public function updateProfile(Request $request, InstructorRepository $instructor): JsonResponse
    {
        $user      = jwtUser();

        $validator = validator($request->all(), [
            'first_name'  => 'required|string',
            'last_name'   => 'required|string',
            'phone'       => 'required|unique:users,phone,'.$user->id,
            'email'       => 'required|email|unique:users,email,'.$user->id,
            'designation' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->responseWithError(__('required_field_missing'), $validator->errors(), 422);
        }
        try {
            $instructor->update($request->all(), $user->id);

            return $this->responseWithSuccess(__('profile_updated_successfully'));
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
