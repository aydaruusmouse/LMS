<?php

namespace App\Repositories;

use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class ReviewRepository
{
    public function all()
    {
        return Rating::latest()->paginate(setting('paginate'));
    }

    public function store($data)
    {
        return Rating::create($data);
    }

    public function reviews($data)
    {
        return Rating::with('user')->whereHas('user')->when(arrayCheck('status', $data), function ($query) {
            $query->where('status', 1);
        })->where('commentable_id', $data['id'])->where('commentable_type', $data['type'])->latest()->paginate($data['paginate']);
    }

    public function searchUserReview($data)
    {
        return Rating::where('commentable_id', $data['id'])->where('user_id', $data['user_id'])->where('commentable_type', $data['type'])->first();
    }

    public function reviewPercentage($data)
    {
        return Rating::where('commentable_id', $data['id'])->where('commentable_type', $data['type'])->select('rating', DB::raw('count(*) as total'))
            ->groupBy('rating')->pluck('total', 'rating');
    }

    public function find($id)
    {
        return Rating::findOrFail($id);
    }

    public function changeStatus($id)
    {
        $review = $this->find($id);

        if ($review->status == 1) {
            $review->status = 0;
        } else {
            $review->status = 1;
        }

        return $review->save();
    }
}
