<?php

namespace App\Repositories;

use App\Models\Instructor;
use App\Models\User;
use App\Traits\ImageTrait;

class InstructorRepository
{
    use ImageTrait;

    public function getOrgInstructor($id)
    {
        return Instructor::where('organization_id', $id)->whereHas('user')->paginate(setting('paginate'));
    }

    public function all($with = [], $data = [])
    {
        return Instructor::with($with)->whereHas('organization')->whereHas('user', function ($query) {
            $query->where('role_id', 2)->active()->notDeleted()->notBanned();
        })->when(arrayCheck('best_teacher', $data) && $data['best_teacher'] == 1, function ($query) {
            $query->withAggregate('courses', 'total_enrolled')->orderBy('courses_total_enrolled', 'desc');
        })->when(! arrayCheck('best_teacher', $data), function ($query) {
            $query->latest();
        })->paginate(5);
    }

    public function get($id)
    {
        return Instructor::findOrfail($id);
    }

    public function store($request)
    {
        $request['role_id'] = 2;
        if (isset($request['image'])) {
            $requestImage      = $request['image'];
            $response          = $this->getImageWithRecommendedSize(0, '417', '384', true, $requestImage);
            $request['images'] = $response['images'];
        }
        if (arrayCheck('password', $request)) {
            $request['password'] = bcrypt($request['password']);
        }
        $user               = User::create($request);
        $request['user_id'] = $user->id;
        $request['slug']    = getSlug('instructors', $user->name);

        return Instructor::create($request);
    }

    public function update($request, $id)
    {
        $user            = User::find($id);
        $ins             = $user->instructor;
        if (arrayCheck('image', $request)) {
            $requestImage      = $request['image'];
            $response          = $this->getImageWithRecommendedSize(0, '417', '384', true, $requestImage);
            $request['images'] = $response['images'];
        }
        if (arrayCheck('password', $request)) {
            $request['password'] = bcrypt($request['password']);
        }

        $user->update($request);

        $user            = User::find($id);

        $request['slug'] = getSlug('instructors', $user->name, 'slug', $ins->id);

        return $ins->update($request);
    }
}
