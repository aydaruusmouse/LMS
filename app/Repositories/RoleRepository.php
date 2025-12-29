<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Support\Str;

class RoleRepository
{
    public function all()
    {
        return Role::paginate(setting('paginate'));
    }

    public function activeRoles()
    {
        return Role::where('status', 1)->where('slug', '!=', 1)->get();
    }

    public function get($id)
    {
        return Role::findOrfail($id);
    }

    public function store(array $request)
    {
        $role              = new Role();
        $role->name        = $request['name'];

        if (arrayCheck('slug', $request)) {
            $role->slug = $request['slug'];
        } else {
            $role->slug = Str::slug($request['name'], '-');
        }

        $role->permissions = arrayCheck('permissions', $request) ? $request['permissions'] : [];

        return $role->save();
    }

    public function edit($id)
    {
        return Role::findOrfail($id);
    }

    public function update($request, $id)
    {
        $role              = Role::findOrfail($id);
        $role->name        = $request['name'];

        if (arrayCheck('slug', $request)) {
            $role->slug = $request['slug'];
        } else {
            $role->slug = Str::slug($request['name'], '-');
        }
        $role->permissions = arrayCheck('permissions', $request) ? $request['permissions'] : [];

        return $role->save();
    }

    public function destroy($id)
    {
        $role = Role::findOrfail($id);

        return $role->delete();
    }

    public function staffRoll()
    {
        return Role::whereNotIn('id', [
            3, 5, 1, 2,
        ])->get();
    }
}
