<?php

namespace App\Repositories;

use App\Models\Page;
use App\Models\PageLanguage;
use App\Traits\ImageTrait;

class PageRepository
{
    use ImageTrait;

    public function all($data = [])
    {
        if (! arrayCheck('paginate', $data)) {
            $data['paginate'] = setting('paginate');
        }

        return Page::with('language')->latest()->paginate($data['paginate']);
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $api_key = PageLanguage::where('lang', 'en')->where('page_id', $id)->first();
        } else {
            $api_key = PageLanguage::where('lang', $lang)->where('page_id', $id)->first();
            if (! $api_key) {
                $api_key                     = PageLanguage::where('lang', 'en')->where('page_id', $id)->first();
                $api_key['translation_null'] = 'not-found';
            }
        }

        return $api_key;
    }

    public function store($request)
    {
        if (! arrayCheck('meta_title', $request)) {
            $request['meta_title'] = $request['title'];
        }
        if (! arrayCheck('meta_keywords', $request)) {
            $request['meta_keywords'] = $request['title'];
        }
        if (arrayCheck('meta_image', $request)) {
            $request['meta_image'] = $this->saveImage($request['meta_image'], 'og_image')['images'];
        }
        if (! arrayCheck('meta_description', $request)) {
            $request['meta_description'] = $request['title'];
        }
        $request['link'] = getSlug('pages', $request['title'], 'link');
        $key             = Page::create($request);
        $this->langStore($request, $key);

        return $key;
    }

    public function get($id, $is_active = null)
    {
        return Page::when($is_active, function ($query) {
            $query->where('status', 1);
        })->find($id);
    }

    public function update($request, $id)
    {
        $page = Page::findOrfail($id);
        $data = $request;

        if (arrayCheck('lang', $request) && $request['lang'] == 'en') {
            $page->update([
                'link'             => $request['link'],
                'title'            => $request['title'],
                'content'          => $request['content'],
                'meta_title'       => $request['meta_title'],
                'meta_keywords'    => $request['meta_keywords'],
                'meta_description' => $request['meta_description'],
                'meta_image'       => arrayCheck('meta_image', $request) ? $this->saveImage($request['meta_image'], 'og_image')['images'] : $page->meta_image,
            ]);
        } else {
            $page->update([
                'link'       => $request['link'],
                'meta_image' => arrayCheck('meta_image', $request) ? $this->saveImage($request['meta_image'], 'og_image')['images'] : $page->meta_image,
            ]);
        }

        if ($request['translate_id']) {
            $request['lang'] = $request['lang'] ?: 'en';
            $this->langUpdate($data);
        } else {
            $this->langStore($data, $page);
        }

        return $page;
    }

    public function destroy($id)
    {
        $apiKey = Page::findOrfail($id);

        return $apiKey->delete();
    }

    public function delete($request)
    {
        $apiKey = Page::findOrfail($request['id']);
        if ($apiKey->status == 1) {
            $apiKey->status = 0;
        } else {
            $apiKey->status = 1;
        }

        return $apiKey->save();
    }

    public function langStore($request, $key)
    {
        return PageLanguage::create([
            'page_id'          => $key->id,
            'title'            => $request['title'],
            'content'          => $request['content'],
            'meta_title'       => $request['meta_title'],
            'meta_keywords'    => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
            'lang'             => arrayCheck('lang', $request) ? $request['lang'] : 'en',
        ]);
    }

    public function langUpdate($request)
    {
        return PageLanguage::where('id', $request['translate_id'])->update([
            'lang'             => $request['lang'],
            'title'            => $request['title'],
            'content'          => $request['content'],
            'meta_title'       => $request['meta_title'],
            'meta_keywords'    => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
        ]);
    }

    public function status($data)
    {
        $key         = Page::findOrfail($data['id']);
        $key->status = $data['status'];

        return $key->save();
    }

    public function activePages($data = [])
    {
        return Page::when(arrayCheck('lang', $data), function ($query) use ($data) {
            $query->join('page_languages', 'page_languages.page_id', '=', 'pages.id')
                ->select('pages.*', 'page_languages.title as page_title')
                ->where('page_languages.lang', $data['lang']);
        })->where('status', 1)->get();
    }

    public function findByLink($link)
    {
        return Page::where('link', $link)->first();
    }
}
