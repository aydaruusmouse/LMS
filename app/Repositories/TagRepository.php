<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Models\TagLanguage;

class TagRepository
{
    public function all()
    {
        return Tag::orderByDesc('id')->paginate(setting('paginate'));
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $tag = TagLanguage::where('lang', 'en')->where('tag_id', $id)->first();
        } else {
            $tag = TagLanguage::where('lang', $lang)->where('tag_id', $id)->first();
            if (! $tag) {
                $tag                     = TagLanguage::where('lang', 'en')->where('tag_id', $id)->first();
                $tag['translation_null'] = 'not-found';
            }
        }

        return $tag;
    }

    public function activeTags($data = [])
    {
        return Tag::active()->when(arrayCheck('q', $data), function ($query) use ($data) {
            $query->whereHas('languages', function ($query) use ($data) {
                $query->where('title', 'like', '%'.$data['q'].'%');
            });
        })->when(arrayCheck('take', $data), function ($query) use ($data) {
            $query->take($data['take']);
        })->latest()->get();
    }

    public function store($request)
    {
        $level = Tag::create($request);
        $this->langStore($request, $level);

        return $level;
    }

    public function find($id)
    {
        return Tag::find($id);
    }

    public function update($request, $id)
    {
        $tag  = Tag::find($id);
        $data = $request;

        if (arrayCheck('lang', $request) && $request['lang'] != 'en') {
            $request['title'] = $tag->title;
        }

        $tag->update($request);

        if ($request['translate_id']) {
            $request['lang'] = $request['lang'] ?: 'en';
            $this->langUpdate($data);
        } else {
            $this->langStore($data, $tag);
        }

        return $tag;
    }

    public function status($data)
    {
        $key         = Tag::findOrfail($data['id']);
        $key->status = $data['status'];

        return $key->save();
    }

    public function destroy($id): int
    {
        return Tag::destroy($id);
    }

    public function langStore($request, $level)
    {
        return TagLanguage::create([
            'tag_id' => $level->id,
            'title'  => $request['title'],
            'lang'   => arrayCheck('lang', $request) ? $request['lang'] : 'en',
        ]);
    }

    public function langUpdate($request)
    {
        return TagLanguage::where('id', $request['translate_id'])->update([
            'lang'  => $request['lang'],
            'title' => $request['title'],
        ]);
    }
}
