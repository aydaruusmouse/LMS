<?php

namespace App\Repositories;

use App\Models\User;
use App\Traits\ImageTrait;

class StudentRepository
{
    use ImageTrait;

    public function find($id)
    {
        return User::findOrfail($id);
    }

    public function store($request)
    {
        $request['role_id']     = 3;
        if (isset($request['image'])) {
            $requestImage      = $request['image'];
            $response          = $this->saveImage($requestImage, '_staff_');
            $request['images'] = $response['images'];
        }
        if (arrayCheck('password', $request)) {
            $request['password'] = bcrypt($request['password']);
        }
        $request['permissions'] = [];

        return User::create($request);
    }

    public function update($request, $id)
    {
        $user = User::find($id);

        if (arrayCheck('image', $request)) {
            $requestImage      = $request['image'];
            $response          = $this->saveImage($requestImage, '_staff_');
            $request['images'] = $response['images'];
        }
        if (arrayCheck('password', $request)) {
            $request['password'] = bcrypt($request['password']);
        }
        if (empty($request['password'])) {
            $request['password'] = $user->password;
        }

        return $user->update($request);
    }
}
