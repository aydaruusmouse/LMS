<?php

namespace App\Repositories;

use App\Models\City;

class CityRepository
{
    public function all()
    {
        return City::orderByDesc('id')->paginate(setting('pagination'));
    }

    public function store($request)
    {
        return City::create($request);
    }

    public function find($id)
    {
        return City::find($id);
    }

    public function update($request, $id)
    {
        return City::find($id)->update($request);
    }

    public function statusChange($request)
    {
        $id = $request['id'];

        return City::find($id)->update($request);
    }

    public function destroy($id): int
    {
        return City::destroy($id);
    }

    public function activeCities()
    {
        return City::active()->orderBy('name')->get();
    }

    public function cityByState($id)
    {
        return City::where('state_id', $id)->active()->orderBy('name')->get();
    }
}
