<?php

namespace App\Repositories;

use App\Models\Book;
use Carbon\Carbon;

class BookRepository
{
    public function all()
    {
        return Book::orderByDesc('id')->paginate(setting('paginate'));
    }

    public function store($request)
    {
        return Book::create($request);
    }

    public function find($id)
    {
        return Book::withAvg('reviews', 'rating')->withCount('reviews')->find($id);
    }

    public function update($request, $id)
    {
        return Book::findOrfail($id)->update($request);
    }

    public function destroy($id)
    {
        return Book::destroy($id);
    }

    public function activeBooks($data, $relation = [])
    {
        if (! arrayCheck('paginate', $data)) {
            $data['paginate'] = setting('pagination');
        }

        return Book::with($relation)->withAvg('reviews', 'rating')->withCount('reviews')
            ->when(arrayCheck('is_free', $data), function ($query) use ($data) {
                $query->where('is_free', $data['is_free']);
            })->when(arrayCheck('like', $data), function ($query) use ($data) {
                $query->where('title', 'LIKE', '%'.$data['q'].'%');
            })->when(arrayCheck('trending', $data), function ($query) {
                $query->withSum('enrolls', 'quantity')->orderBy('enrolls_sum_quantity', 'desc')->whereHas('enrolls', function ($query) {
                    $now = Carbon::now();
                    $query->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year);
                });
            })->when(arrayCheck('is_popular', $data), function ($query) {
                $query->withSum('enrolls', 'quantity')->orderBy('enrolls_sum_quantity', 'desc');
            })->when(arrayCheck('high_rated', $data), function ($query) {
                $query->orderBy('reviews_avg_rating', 'desc');
            })->when(arrayCheck('is_free', $data), function ($query) use ($data) {
                $query->where('is_free', $data['is_free']);
            })->when(arrayCheck('instructor_id', $data), function ($query) use ($data) {
                $query->where('instructor_id', $data['instructor_id']);
            })->when(arrayCheck('wishlist', $data), function ($query) use ($data) {
                $query->whereHas('wishlists', function ($query) use ($data) {
                    $query->where('user_id', $data['user_id']);
                });
            })->when(arrayCheck('pending', $data), function ($query) use ($data) {
                $query->whereHas('enrolls.checkout', function ($query) use ($data) {
                    $query->where('status', $data['status']);
                });
            })->when(arrayCheck('related', $data), function ($query) use ($data) {
                $query->where('id', '!=', $data['id'])->when(arrayCheck('category_id', $data), function ($query) use ($data) {
                    $query->where(function ($query) use ($data) {
                        foreach ($data['category_id'] as $category_id) {
                            $query->orWhereJsonContains('category_ids', $category_id);
                        }
                    });
                });
            })->latest()->active()->paginate($data['paginate']);
    }

    public function cartBooks()
    {
        return Book::whereHas('carts', function ($query) {
            $query->where('user_id', auth()->id());
        })->active()->get();
    }

    public function findBooks($ids, $with = [])
    {
        return Book::with($with)->whereIn('id', $ids)->get();
    }
}
