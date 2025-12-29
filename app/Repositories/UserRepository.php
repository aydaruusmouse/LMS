<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\User;
use App\Traits\ImageTrait;

class UserRepository
{
    use ImageTrait;

    public function index($data)
    {
        if (! arrayCheck('paginate', $data)) {
            $data['paginate'] = setting('pagination');
        }

        return User::paginate($data['paginate']);
    }

    public function store($data)
    {
        if (arrayCheck('image', $data)) {
            $data['image'] = $this->getImageWithRecommendedSize($data['image'], 260, 175);
        }
        $data['password'] = bcrypt($data['password']);

        return User::create($data);
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function update($data, $id)
    {
        $user = User::find($id);

        if (arrayCheck('image', $data)) {
            //$data['image'] = $this->getImageWithRecommendedSize($data['image'], 260, 175);
            $response       = $this->saveImage($data['image'], '_staff_');
            $data['images'] = $response['images'];
        }
        if (arrayCheck('password', $data)) {
            $data['password'] = bcrypt($data['password']);
        }
        if (! arrayCheck('status', $data) || jwtUser()->role_id == 3) {
            $data['status'] = $user->status;
        }
        $user->update($data);

        return $user;
    }

    public function destroy($id): int
    {
        return User::destroy($id);
    }

    public function findByEmail($mail)
    {
        return User::where('email', $mail)->first();
    }

    public function findByPhone($phone)
    {
        return User::where('phone', $phone)->first();
    }

    public function searchUsers($relation, $data): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return User::with($relation)->when(arrayCheck('search', $data), function ($query) use ($data) {
            $query->where('name', 'like', '%'.$data['search'].'%');
        })->when(arrayCheck('role_id', $data), function ($query) use ($data) {
            $query->where('role_id', $data['role_id']);
        })->when(arrayCheck('status', $data), function ($query) use ($data) {
            $query->where('status', $data['status'])->where('is_user_banned', 0)->where('is_deleted', 0);
        })->when(arrayCheck('ids', $data), function ($query) use ($data) {
            $query->whereIn('id', $data['ids']);
        })->when(arrayCheck('role_id', $data) && $data['role_id'] == 2, function ($query) use ($data) {
            $query->whereHas('instructor.organization', function ($query) use ($data) {
                $query->when(arrayCheck('organization_id', $data), function ($query) use ($data) {
                    $query->where('id', $data['organization_id']);
                });
            });
        })->when(arrayCheck('instructor_student', $data), function ($query) use ($data) {
            $query->whereHas('checkout', function ($query) use ($data) {
                $query->whereHas('enrolls', function ($query) use ($data) {
                    $query->whereIn('enrollable_id', $data['total_course'])->where('enrollable_type', Course::class);
                });
            });
        })->latest()->paginate($data['paginate']);
    }

    public function findUsers($data, $relation = [])
    {
        return User::with($relation)->when(arrayCheck('role_id', $data) && $data['role_id'] == 2, function ($query) {
            $query->where('role_id', 2)->whereHas('instructor.organization');
        })->when(arrayCheck('role_id', $data) && ! is_array($data['role_id']), function ($query) use ($data) {
            $query->where('role_id', $data['role_id']);
        })->when(arrayCheck('role_id', $data) && is_array($data['role_id']), function ($query) use ($data) {
            $query->whereIn('role_id', $data['role_id']);
        })->when(arrayCheck('q', $data), function ($query) use ($data) {
            $query->where(function ($query) use ($data) {
                $query->where('first_name', 'like', '%'.$data['q'].'%')->orWhere('last_name', 'like', '%'.$data['q'].'%')
                    ->orWhere('email', 'like', '%'.$data['q'].'%')->orWhere('phone', 'like', '%'.$data['q'].'%');
            });
        })->when(arrayCheck('ids', $data), function ($query) use ($data) {
            $query->whereIn('id', $data['ids']);
        })->when(arrayCheck('status', $data), function ($query) use ($data) {
            $query->where('status', $data['status'])->where('is_user_banned', 0)->where('is_deleted', 0);
        })->where('role_id', '!=', 1)->when(arrayCheck('take', $data), function ($query) use ($data) {
            $query->take($data['take']);
        })->when(arrayCheck('onesignal', $data), function ($query) {
            $query->where('is_onesignal_subscribed', 1);
        })->when(arrayCheck('organization_id', $data), function ($query) use ($data) {
            $query->whereHas('instructor', function ($query) use ($data) {
                $query->where('organization_id', $data['organization_id']);
            });
        })->get();
    }

    public function statusChange($request)
    {
        $id            = $request['id'];
        $status        = $request['status'];
        $staff         = User::findOrfail($id);
        $staff->status = $status;
        $staff->save();

        return true;
    }

    public function userVerified($id)
    {
        $staff = User::findOrfail($id);
        if (! empty($staff->email_verified_at)) {
            $staff->email_verified_at = null;
            $staff->save();
            $data                     = [
                'status'  => true,
                'message' => __('verified_remove_successful'),
            ];

            return $data;
        } else {
            $staff->email_verified_at = date('Y-m-d H:i:s');
            $staff->save();
            $data                     = [
                'status'  => true,
                'message' => __('verified_this_successful'),
            ];

            return $data;
        }
    }

    public function userBan($id)
    {
        $staff = user::findOrfail($id);
        if ($staff->is_user_banned == 0) {
            $staff->is_user_banned = 1;
            $staff->save();
            $data                  = [
                'status'  => true,
                'message' => __('successfully_banned_this_person'),
            ];
        } else {
            $staff->is_user_banned = 0;
            $staff->save();
            $data                  = [
                'status'  => true,
                'message' => __('active_this_successful'),
            ];
        }

        return $data;
    }

    public function userDelete($id)
    {
        $staff = user::findOrfail($id);
        if ($staff->is_deleted == 0) {
            $staff->is_deleted = 1;
            $staff->save();
            $data              = [
                'status'  => true,
                'message' => __('delete_successful'),
            ];
        } else {
            $staff->is_deleted = 0;
            $staff->save();
            $data              = [
                'status'  => true,
                'message' => __('restore_successful'),
            ];
        }

        return $data;
    }

    public function enrollableStudent($course_id)
    {
        return User::whereHas('checkout', function ($query) use ($course_id) {
            $query->whereHas('enrolls', function ($query) use ($course_id) {
                $query->whereIn('enrollable_id', $course_id)->where('enrollable_type', Course::class);
            });
        })->count();
    }

    public function instructorStudentFind($id, $user)
    {
        return User::whereHas('checkout', function ($query) use ($user) {
            $query->whereHas('enrolls.enrollable.users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            });
        })->find($id);
    }
}
