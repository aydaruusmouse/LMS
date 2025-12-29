<?php

namespace App\Repositories;

use App\Models\OrganizationPayoutMethod;

class OrganizationPayoutMethodRepository
{
    public function store($request)
    {
        return OrganizationPayoutMethod::create($request);
    }

    public function update($request, $id)
    {
        $method = OrganizationPayoutMethod::findOrfail($id);

        $method->update($request);

        return $method;
    }

    public function find($id)
    {
        return OrganizationPayoutMethod::find($id);
    }

    public function getMethodInfo($organization_id, $type)
    {
        return OrganizationPayoutMethod::where('organization_id', $organization_id)->where('payout_method', $type)->first();
    }

    public function status($data)
    {
        $key         = OrganizationPayoutMethod::findOrfail($data['id']);
        $key->status = $data['status'];

        return $key->save();
    }

    public function setDefault($data)
    {
        $key             = OrganizationPayoutMethod::findOrfail($data['id']);
        OrganizationPayoutMethod::where('user_id', $key->user_id)->update(['is_default' => 0]);
        $key->is_default = $data['status'];

        return $key->save();
    }
}
