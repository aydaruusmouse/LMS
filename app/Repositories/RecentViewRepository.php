<?php

namespace App\Repositories;

use App\Models\RecentView;

class RecentViewRepository
{
    public function all($data = [])
    {
        return RecentView::with('course')->when(arrayCheck('user_id', $data), function ($query) use ($data) {
            $query->where('user_id', $data['user_id']);
        })->when(arrayCheck('type', $data), function ($query) use ($data) {
            $query->where('viewable_type', $data['type']);
        })->latest()->get();

    }

    public function find($type, $id)
    {
        return RecentView::where('viewable_type', $type)->where('viewable_id', $id)->first();
    }

    public function store(array $request)
    {
        return RecentView::create($request);
    }
}
