<?php

namespace App\Repositories;

use App\Models\Service;

class ServiceRepository
{
    public function all()
    {
        return $all = Service::orderByDesc('id')->paginate(setting('setting'));
    }

    public function store($request)
    {
        $service = Service::create($request);

        return true;
    }

    public function update($request, $id)
    {
        $service = Service::findOrfail($id)->update($request);

        return true;
    }

    public function destroy($id)
    {
        $service = Service::destroy($id);

        return true;
    }
}
