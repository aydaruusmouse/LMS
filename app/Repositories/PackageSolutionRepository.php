<?php

namespace App\Repositories;

use App\Models\PackageSolution;

class PackageSolutionRepository
{
    public function all($data = [])
    {
        return PackageSolution::all();
    }

    public function store($request)
    {
        return PackageSolution::create($request);

    }

    public function update($request, $id)
    {
        $package = PackageSolution::findOrfail($id);
        $package->update($request);

        return $package;
    }

    public function find($id)
    {
        return PackageSolution::find($id);
    }

    public function status($data)
    {
        $key         = PackageSolution::findOrfail($data['id']);
        $key->status = $data['status'];

        return $key->save();
    }

    public function destroy($id)
    {
        return PackageSolution::destroy($id);
    }
}
