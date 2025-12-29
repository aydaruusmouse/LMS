<?php

namespace App\Repositories;

use App\Models\OrganizationStaff;
use App\Models\User;
use App\Traits\ImageTrait;

class OrganizationStaffRepository
{
    use ImageTrait;

    public function getOrgStaff($id)
    {
        return OrganizationStaff::where('organization_id', $id)->whereHas('user')->paginate(setting('paginate'));
    }

    public function all($with = [])
    {
        return OrganizationStaff::with($with)->whereHas('organization')->whereHas('user', function ($query) {
            $query->where('role_id', 2)->active()->notDeleted()->notBanned();
        })->paginate(setting('paginate'));
    }

    public function get($id)
    {
        return OrganizationStaff::findOrfail($id);
    }

    public function store($request)
    {
        $request['role_id'] = 5;

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

        return OrganizationStaff::create($request);
    }

    public function update($request, $id)
    {

        $user            = User::findOrFail($id);

        $staff           = $user->organizationStaff;

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

        $request['slug'] = getSlug('instructors', $user->name, 'slug', $staff->id);

        return $staff->update($request);
    }

    public function bestTeacher()
    {
        return OrganizationStaff::join('users', 'users.id', 'instructors.user_id')
            ->where('role_id', 2)
            ->take(setting('paginate'))
            ->get();
    }
}
