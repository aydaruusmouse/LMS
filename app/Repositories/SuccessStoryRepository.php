<?php

namespace App\Repositories;

use App\Models\SuccessStory;
use App\Models\SuccessStoryLanguage;
use App\Traits\ImageTrait;

class SuccessStoryRepository
{
    use ImageTrait;

    public function all()
    {
        return SuccessStory::orderByDesc('id')->paginate(setting('pagination'));
    }

    public function activeStories($data = [])
    {
        return SuccessStory::active()->when(arrayCheck('lang', $data), function ($query) use ($data) {
            $query->whereHas('languages', function ($query) use ($data) {
                $query->where('lang', $data['lang'])
                    ->selectRaw('success_stories.*,success_story_languages.title as story_title');
            });
        })->latest()->get();
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $success = SuccessStoryLanguage::where('lang', 'en')->where('success_story_id', $id)->first();
        } else {
            $success = SuccessStoryLanguage::where('lang', $lang)->where('success_story_id', $id)->first();
            if (! $success) {
                $success                     = SuccessStoryLanguage::where('lang', 'en')->where('success_story_id', $id)->first();
                $success['translation_null'] = 'not-found';
            }
        }

        return $success;
    }

    public function store($request)
    {
        if (arrayCheck('success_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['success_media_id'], '473', '337', true);
        }
        $request['slug'] = strtolower($request['title']);
        $success         = SuccessStory::create($request);

        $this->langStore($request, $success);

        return $success;
    }

    public function update($request, $id)
    {
        $data    = $request;
        $success = SuccessStory::findOrfail($id);

        if (arrayCheck('success_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['success_media_id'], '473', '337', true);
        }

        if (arrayCheck('lang', $request) && $request['lang'] != 'en') {
            $request['title'] = $success->title;
        }
        $success->update($request);

        if ($request['translate_id']) {
            $data['lang'] = $data['lang'] ?: 'en';
            $this->langUpdate($data);
        } else {
            $this->langStore($data, $success);
        }

        return $success;
    }

    public function find($id)
    {
        return SuccessStory::find($id);
    }

    public function destroy($id)
    {
        return SuccessStory::destroy($id);
    }

    public function langStore($request, $success)
    {
        return SuccessStoryLanguage::create([
            'success_story_id' => $success->id,
            'title'            => $request['title'],
            'lang'             => arrayCheck('lang', $request) ? $request['lang'] : 'en',
            'description'      => $request['description'],
        ]);
    }

    public function langUpdate($request)
    {
        return SuccessStoryLanguage::where('id', $request['translate_id'])->update([
            'lang'  => $request['lang'],
            'title' => $request['title'],
        ]);
    }

    public function status($data)
    {
        $key         = SuccessStory::findOrfail($data['id']);
        $key->status = $data['status'];

        return $key->save();
    }
}
