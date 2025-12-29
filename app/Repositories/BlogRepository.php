<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\BlogCommentReply;
use App\Models\BlogLanguage;
use App\Traits\ImageTrait;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BlogRepository
{
    use ImageTrait;

    public function all($data = [])
    {
        return Blog::orderByDesc('id')->paginate($data['paginate']);
    }

    public function activeBlogs($data = [])
    {
        return Blog::withCount('comments')->with('language')->where('status', 'published')->when(arrayCheck('q', $data), function ($query) use ($data) {
            $query->where('title', 'like', '%'.$data['q'].'%')->orWhereHas('languages', function ($query) use ($data) {
                $query->where('title', 'like', '%'.$data['q'].'%');
            });
        })->when(arrayCheck('take', $data), function ($query) use ($data) {
            $query->take($data['take']);
        })->latest()->get();
    }

    public function findBlogs($data = []): LengthAwarePaginator
    {
        if (! arrayCheck('paginate', $data)) {
            $data['paginate'] = setting('paginate');
        }

        return Blog::with('language')->where('status', 'published')->when(arrayCheck('q', $data), function ($query) use ($data) {
            $query->where('title', 'like', '%'.$data['q'].'%');
        })->when(arrayCheck('user_id', $data), function ($query) use ($data) {
            $query->where('user_id', $data['user_id']);
        })->latest()->paginate($data['paginate']);
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $blog = BlogLanguage::where('lang', 'en')->where('blog_id', $id)->first();
        } else {
            $blog = BlogLanguage::where('lang', $lang)->where('blog_id', $id)->first();
            if (! $blog) {
                $blog                     = BlogLanguage::where('lang', 'en')->where('blog_id', $id)->first();
                $blog['translation_null'] = 'not-found';
            }
        }

        return $blog;
    }

    public function store($request)
    {
        //        if (arrayCheck('image_media_id', $request)) {
        //            $request['image'] = $this->getImageWithRecommendedSize($request['image_media_id'], '406', '240', true);
        //        }
        if (arrayCheck('image_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['image_media_id'], '406', '240', true);
        }
        if (arrayCheck('banner_media_id', $request)) {
            $request['banner'] = $this->getImageWithRecommendedSize($request['banner_media_id'], '828', '490', true);
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
        }

        if ($request['status'] == 'published') {
            $request['published_at'] = now();
        }

        $request['user_id'] = auth()->id();
        $request['slug']    = getSlug('blogs', $request['title']);

        $blog               = Blog::create($request);
        $this->langStore($request, $blog);

        return $blog;
    }

    public function find($id)
    {
        return Blog::find($id);
    }

    public function update($request, $id)
    {
        $blog            = Blog::findOrfail($id);
        $data            = $request;

        if ($request['status'] == 'published' && $blog->status != 'published') {
            $request['published_at'] = now();
        }
        if (arrayCheck('image_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['image_media_id'], '406', '240', true);
        }
        if (arrayCheck('banner_media_id', $request)) {
            $request['banner'] = $this->getImageWithRecommendedSize($request['banner_media_id'], '828', '490', true);
        }
        if (arrayCheck('meta_image', $request)) {
            $request['meta_image'] = $this->getImageWithRecommendedSize($request['meta_image'], '828', '490', true);
        }

        if (arrayCheck('lang', $request) && $request['lang'] != 'en') {
            $request['title']             = $blog->title;
            $request['short_description'] = $blog->short_description;
            $request['description']       = $blog->description;
            $request['meta_title']        = $blog->meta_title;
            $request['meta_keywords']     = $blog->meta_keywords;
            $request['meta_description']  = $blog->meta_description;
            $request['tags']              = $blog->tags;
        }

        $request['slug'] = getSlug('blogs', $request['title'], 'slug', $id);

        $blog->update($request);

        if ($request['translate_id']) {
            $request['lang'] = $request['lang'] ?: 'en';
            $this->langUpdate($data);
        } else {
            $this->langStore($data, $blog);
        }

        return $blog;
    }

    public function destroy($id): int
    {
        return Blog::destroy($id);
    }

    public function langStore($request, $blog)
    {
        return BlogLanguage::create([
            'blog_id'           => $blog->id,
            'title'             => $request['title'],
            'short_description' => $request['short_description'],
            'description'       => $request['description'],
            'tags'              => getArrayValue('tags', $request),
            'meta_title'        => $request['meta_title'],
            'meta_keywords'     => $request['meta_keywords'],
            'meta_description'  => $request['meta_description'],
            'lang'              => arrayCheck('lang', $request) ? $request['lang'] : 'en',
        ]);
    }

    public function langUpdate($request)
    {
        return BlogLanguage::where('id', $request['translate_id'])->update([
            'lang'              => $request['lang'],
            'title'             => $request['title'],
            'short_description' => $request['short_description'],
            'description'       => $request['description'],
            'tags'              => getArrayValue('tags', $request),
            'meta_title'        => $request['meta_title'],
            'meta_keywords'     => $request['meta_keywords'],
            'meta_description'  => $request['meta_description'],
        ]);
    }

    public function comment($data)
    {
        return BlogComment::create($data);
    }

    public function reply($data)
    {
        return BlogCommentReply::create($data);
    }

    public function isCommented($data)
    {
        return BlogComment::where('blog_id', $data['blog_id'])->where('user_id', $data['user_id'])->first();
    }

    public function comments($id, $with = []): LengthAwarePaginator
    {
        return BlogComment::withCount('replies')->with($with)->where('blog_id', $id)->latest()->paginate(3);
    }

    public function commentReplies($id, $with = []): Collection|array
    {
        return BlogCommentReply::with($with)->where('blog_comment_id', $id)->latest()->get();
    }
}
