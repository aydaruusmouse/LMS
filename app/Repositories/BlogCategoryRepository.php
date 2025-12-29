<?php

namespace App\Repositories;

use App\Models\BlogCategory;
use App\Models\BlogCategoryLanguage;
use App\Traits\ImageTrait;

class BlogCategoryRepository
{
    use ImageTrait;

    public function all($data = [], $relation = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return BlogCategory::with($relation)->latest()->paginate($data['paginate']);
    }

    public function activeCategories()
    {
        return BlogCategory::active()->get();
    }

    public function get($id)
    {
        return BlogCategory::findOrfail($id);
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $category = BlogCategoryLanguage::where('lang', 'en')->where('blog_category_id', $id)->first();
        } else {
            $category = BlogCategoryLanguage::where('lang', $lang)->where('blog_category_id', $id)->first();
            if (! $category) {
                $category                     = BlogCategoryLanguage::where('lang', 'en')->where('blog_category_id', $id)->first();
                $category['translation_null'] = 'not-found';
            }
        }

        return $category;
    }

    public function store($request)
    {
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
        }

        $request['slug'] = getSlug('blog_categories', $request['title']);
        $category        = BlogCategory::create($request);
        $this->langStore($request, $category);

        return $category;
    }

    public function update($request, $id)
    {
        $category = BlogCategory::findOrfail($id);
        $data     = $request;
        //        if (arrayCheck('meta_image', $request)) {
        //            $request['meta_image'] = $this->saveImage($request['meta_image'], 'og_image')['images'];
        //        }
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
        $key         = BlogCategory::findOrfail($data['id']);
        $key->status = $data['status'];

        return $key->save();
    }

    public function destroy($id)
    {
        return BlogCategory::destroy($id);
    }

    public function langStore($request, $category)
    {
        return BlogCategoryLanguage::create([
            'blog_category_id' => $category->id,
            'title'            => $request['title'],
            'meta_title'       => $request['meta_title'],
            'meta_keywords'    => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
            'lang'             => arrayCheck('lang', $request) ? $request['lang'] : 'en',
        ]);
    }

    public function langUpdate($request)
    {
        return BlogCategoryLanguage::where('id', $request['translate_id'])->update([
            'lang'             => $request['lang'],
            'title'            => $request['title'],
            'meta_title'       => $request['meta_title'],
            'meta_keywords'    => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
        ]);
    }
}
