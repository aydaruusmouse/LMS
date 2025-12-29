<?php

namespace App\Repositories;

use App\Models\Organization;
use App\Traits\ImageTrait;

class OrganizationRepository
{
    use ImageTrait;

    public function all($data, $relation = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        if (! arrayCheck('paginate', $data)) {
            $data['paginate'] = setting('paginate');
        }

        return Organization::with($relation)->latest()->paginate($data['paginate']);
    }

    public function activeOrganization($data, $relation = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        if (! arrayCheck('paginate', $data)) {
            $data['paginate'] = setting('paginate');
        }

        return Organization::with($relation)->when(arrayCheck('q', $data), function ($query) use ($data) {
            $query->where('org_name', 'like', '%'.$data['q'].'%');
        })->active()->latest()->paginate($data['paginate']);
    }

    public function findOrganizations($data, $relation = [])
    {
        return Organization::with($relation)->when(arrayCheck('q', $data), function ($query) use ($data) {
            $query->where('org_name', 'like', '%'.$data['q'].'%');
        })->when(arrayCheck('organization_ids', $data), function ($query) use ($data) {
            $query->whereIn('id', $data['organization_ids']);
        })->active()->latest()->get();
    }

    public function organizationStatus($status = null)
    {
        return Organization::when($status || $status == '0', function ($query) use ($status) {
            return $query->where('status', $status);
        })->count();
    }

    public function find($id)
    {
        return Organization::find($id);
    }

    public function store($request)
    {
        if (arrayCheck('logo', $request)) {
            $request['org_media_id'] = $request['logo'];
            $request['logo']         = $this->getImageWithRecommendedSize($request['logo'], '127', '102');
        }
        if (arrayCheck('person_media_id', $request)) {
            $request['person_image'] = $this->getImageWithRecommendedSize($request['person_media_id'], '127', '102');
        }
        $request['slug'] = getSlug('organizations', $request['org_name']);

        return Organization::create($request);
    }

    public function update($request, $id)
    {
        if (arrayCheck('logo', $request)) {
            $request['org_media_id'] = $request['logo'];
            $request['logo']         = $this->getImageWithRecommendedSize($request['logo'], '127', '102');
        }
        if (arrayCheck('person_media_id', $request)) {
            $request['person_image'] = $this->getImageWithRecommendedSize($request['person_media_id'], '127', '102');
        }

        return Organization::find($id)->update($request);
    }

    public function destroy($id): int
    {
        return Organization::destroy($id);
    }

    public function statusChange($request)
    {
        $id = $request['id'];

        return Organization::find($id)->update($request);
    }

    public function delete($id)
    {
        $organization = Organization::findorfail($id);
        if ($organization->status == 1 || $organization->status == 0) {
            $organization->status = 2;
        } else {
            $organization->status = 1;
        }

        return $organization->save();
    }

    public function findBySlug($slug)
    {
        return Organization::with('courses:id,organization_id')->withCount('instructors')->withCount('courses')->where('slug', $slug)->first();
    }
}
