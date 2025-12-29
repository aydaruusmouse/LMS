<?php

namespace App\Repositories\Admin;

use App\Models\User;
use App\Traits\ImageTrait;

class StaffRepository
{
    use ImageTrait;

    public function all()
    {
        return $all = User::orderBy('id', 'desc')->paginate(setting('paginate'));
    }

    public function store($request)
    {
        if (arrayCheck('image', $request)) {
            $requestImage      = $request['image'];
            $response          = $this->saveImage($requestImage, '_staff_');
            $request['images'] = $response['images'];
        }
        if (arrayCheck('password', $request)) {
            $request['password'] = bcrypt($request['password']);
        }

        return User::create($request);
    }

    public function edit($id)
    {
        return User::findOrfail($id);
    }

    public function update($request, $id)
    {
        if (arrayCheck('image', $request)) {
            $requestImage      = $request['image'];
            $response          = $this->saveImage($requestImage, '_staff_');
            $request['images'] = $response['images'];
        }
        if (arrayCheck('password', $request)) {
            $request['password'] = bcrypt($request['password']);
        }
        if (! arrayCheck('permissions', $request)) {
            $request['permissions'] = [];
        }

        return User::findOrfail($id)->update($request);
    }
}
