<?php

namespace App\Repositories;

use App\Models\InstructorPayoutMethod;

class InstructorPayoutMethodRepository
{
    public function store($request)
    {
        return InstructorPayoutMethod::create($request);
    }

    public function update($request, $id)
    {
        $method = InstructorPayoutMethod::findOrfail($id);
        $method->update($request);

        return $method;
    }

    public function find($id)
    {
        return InstructorPayoutMethod::find($id);
    }

    public function getMethodInfo($instructor_id, $type)
    {
        return InstructorPayoutMethod::where('instructor_id', $instructor_id)->where('payout_method', $type)->first();
    }

    public function status($data)
    {
        $key         = InstructorPayoutMethod::findOrfail($data['id']);
        $key->status = $data['status'];

        return $key->save();
    }

    public function setDefault($data)
    {
        $key             = InstructorPayoutMethod::findOrfail($data['id']);
        InstructorPayoutMethod::where('instructor_id', $key->instructor_id)->update(['is_default' => 0]);
        $key->is_default = $data['status'];

        return $key->save();
    }
}
