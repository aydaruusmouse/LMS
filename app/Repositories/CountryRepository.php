<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository
{
    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return Country::all();
    }

    public function activeCountries()
    {
        return Country::active()->get();
    }

    public function store($request)
    {
        return Country::create($request);
    }

    public function find($id)
    {
        return Country::find($id);
    }

    public function update($request, $id)
    {
        return Country::find($id)->update($request);
    }

    public function delete($id): int
    {
        return Country::destroy($id);
    }

    public function statusChange($request)
    {
        $id = $request['id'];

        return Country::find($id)->update($request);
    }

    public function getCode($id)
    {
        return Country::find($id)->phonecode;
    }
}
