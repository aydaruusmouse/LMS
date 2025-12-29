<?php

namespace App\Repositories;

use App\Models\Payout;

class PayoutRepository
{
    public function all()
    {
        return Payout::all();
    }

    public function store($request)
    {
        return Payout::create($request);

    }

    public function update($request, $id)
    {
        $package = Payout::findOrfail($id);
        $package->update($request);

        return $package;
    }

    public function find($id)
    {
        return Payout::find($id);
    }

    public function status($data)
    {
        $key         = Payout::findOrfail($data['id']);
        $key->status = $data['status'];

        return $key->save();
    }

    public function destroy($id)
    {
        return Payout::destroy($id);
    }

    public function statusUpdate($id, $status)
    {
        $key         = Payout::findOrfail($id);
        $key->status = $status;

        return $key->save();
    }
}
