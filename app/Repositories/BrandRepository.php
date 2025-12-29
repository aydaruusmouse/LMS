<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Traits\ImageTrait;

class BrandRepository
{
    use ImageTrait;

    public function all()
    {
        return Brand::orderByDesc('id')->paginate(setting('pagination'));
    }

    public function find($id)
    {
        return Brand::find($id);
    }

    public function activeBrands($data = [])
    {
        return Brand::where('status', 1)->when(arrayCheck('q', $data), function ($query) use ($data) {
            $query->where('name', 'like', '%'.$data['q'].'%');
        })->latest()->get();
    }

    public function store($request)
    {
        if (arrayCheck('brand_media_id', $request)) {
            $request['logo'] = $this->getImageWithRecommendedSize($request['brand_media_id'], '195', '34', true);
        }
        $brand = Brand::create($request);

        return $brand;
    }

    public function update($request, $id)
    {
        $data  = $request;
        $brand = Brand::findOrfail($id);

        if (arrayCheck('brand_media_id', $request)) {
            $request['logo'] = $this->getImageWithRecommendedSize($request['brand_media_id'], '195', '34', true);
        }

        $brand->update($request);

        return $brand;
    }

    public function destroy($id): int
    {
        return Brand::destroy($id);
    }

    public function status($data)
    {
        $key         = Brand::findOrfail($data['id']);
        $key->status = $data['status'];

        return $key->save();
    }
}
