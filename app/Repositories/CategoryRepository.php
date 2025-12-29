<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\CategoryLanguage;
use App\Traits\ImageTrait;

class CategoryRepository
{
    use ImageTrait;

    public function all()
    {
        return Category::orderByDesc('id')->paginate(setting('pagination'));
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $category = CategoryLanguage::where('lang', 'en')->where('category_id', $id)->first();
        } else {
            $category = CategoryLanguage::where('lang', $lang)->where('category_id', $id)->first();
            if (! $category) {
                $category                     = CategoryLanguage::where('lang', 'en')->where('category_id', $id)->first();
                $category['translation_null'] = 'not-found';
            }
        }

        return $category;
    }

    public function store($request)
    {
        if (arrayCheck('image_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['image_media_id'], '402', '238', true);
        }
        if (! arrayCheck('meta_title', $request)) {
            $request['meta_title'] = $request['title'];
        }
        if (! arrayCheck('meta_keywords', $request)) {
            $request['meta_keywords'] = $request['title'];
        }
        if (! arrayCheck('meta_description', $request)) {
            $request['meta_description'] = $request['title'];
        }
        if (arrayCheck('meta_image', $request)) {
            $request['meta_image'] = $this->getImageWithRecommendedSize($request['meta_image'], '1200', '630', true);
        } else {
            $request['meta_image'] = getArrayValue('image', $request);
        }
        $request['slug'] = getSlug('categories', $request['title']);
        $category        = Category::create($request);
        $this->langStore($request, $category);

        return $category;
    }

    public function find($id)
    {
        return Category::find($id);
    }

    public function update($request, $id)
    {
        $category = Category::findOrfail($id);
        $data     = $request;

        if (arrayCheck('image_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['image_media_id'], '402', '238', true);
        }
        if (arrayCheck('meta_image', $request)) {
            $request['meta_image'] = $this->getImageWithRecommendedSize($request['meta_image'], '1200', '630', true);
        }

        if (arrayCheck('lang', $request) && $request['lang'] != 'en') {
            $request['title']            = $category->title;
            $request['meta_title']       = $category->meta_title;
            $request['meta_keywords']    = $category->meta_keywords;
            $request['meta_description'] = $category->meta_description;
        }
        $category->update($request);

        if ($request['translate_id']) {
            $request['lang'] = $request['lang'] ?: 'en';
            $this->langUpdate($data);
        } else {
            $this->langStore($data, $category);
        }

        return $category;
    }

    public function status($data)
    {
        $key         = Category::findOrfail($data['id']);
        $key->status = $data['status'];

        return $key->save();
    }

    public function feature($data)
    {
        $key              = Category::findOrfail($data['id']);
        $key->is_featured = $data['status'];

        return $key->save();
    }

    public function destroy($id): int
    {
        return Category::destroy($id);
    }

    public function langStore($request, $coupon)
    {
        return CategoryLanguage::create([
            'category_id'      => $coupon->id,
            'title'            => $request['title'],
            'meta_title'       => $request['meta_title'],
            'meta_keywords'    => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
            'lang'             => arrayCheck('lang', $request) ? $request['lang'] : 'en',
        ]);
    }

    public function langUpdate($request)
    {
        return CategoryLanguage::where('id', $request['translate_id'])->update([
            'lang'             => $request['lang'],
            'title'            => $request['title'],
            'meta_title'       => $request['meta_title'],
            'meta_keywords'    => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
        ]);
    }

    public function activeCategories($data, $relation = [])
    {
        return Category::with($relation)->withCount('activeCourses')->when(! arrayCheck('parent_id', $data), function ($query) {
            $query->where('parent_id', 0);
        })->when(arrayCheck('q', $data), function ($query) use ($data) {
            $query->where(function ($query) use ($data) {
                $query->where('title', 'like', '%'.$data['q'].'%')->orWhereHas('languages', function ($query) use ($data) {
                    $query->where('title', 'like', '%'.$data['q'].'%');
                });
            });
        })->when(arrayCheck('ids', $data), function ($query) use ($data) {
            $query->whereIn('id', $data['ids']);
        })->when(arrayCheck('excluded_ids', $data), function ($query) use ($data) {
            $query->whereNotIn('id', $data['excluded_ids']);
        })->when(arrayCheck('take', $data), function ($query) use ($data) {
            $query->take($data['take']);
        })->when(arrayCheck('skip', $data), function ($query) use ($data) {
            $query->skip($data['skip']);
        })->when(arrayCheck('top_course', $data), function ($query) {
            $query->whereHas('activeCourses', function ($query) {
                $query->orderBy('total_rating', 'desc');
            });
        })->where('type', $data['type'])->orderBy('ordering')->active()->get();
    }

    public function parentCategories($data, $relation = [])
    {
        return Category::with($relation)->withCount('activeCourses')->where('parent_id', 0)
            ->where('type', $data['type'])
            ->when(arrayCheck('sub_with_course', function ($query) {
                $query->withCount('subCategories');
            }))->orderBy('ordering')->active()->paginate($data['paginate']);
    }

    public function findBySlug($slug)
    {
        return Category::where('slug', $slug)->first();
    }
}
