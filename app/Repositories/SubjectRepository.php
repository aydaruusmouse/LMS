<?php

namespace App\Repositories;

use App\Models\Subject;
use App\Models\SubjectLanguage;
use App\Traits\ImageTrait;

class SubjectRepository
{
    use ImageTrait;

    public function all()
    {
        return Subject::orderByDesc('id')->paginate(setting('paginate'));
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $subject = SubjectLanguage::where('lang', 'en')->where('subject_id', $id)->first();
        } else {
            $subject = SubjectLanguage::where('lang', $lang)->where('subject_id', $id)->first();
            if (! $subject) {
                $subject                     = SubjectLanguage::where('lang', 'en')->where('subject_id', $id)->first();
                $subject['translation_null'] = 'not-found';
            }
        }

        return $subject;
    }

    public function activeSubject($data = [], $relation = [])
    {
        return Subject::with($relation)->where('status', 1)->when(arrayCheck('q', $data), function ($query) use ($data) {
            $query->where('title', 'like', '%'.$data['q'].'%')->orWhereHas('languages', function ($query) use ($data) {
                $query->where('title', 'like', '%'.$data['q'].'%');
            });
        })->when(arrayCheck('lang', $data), function ($query) use ($data) {
            $query->whereHas('languages', function ($query) use ($data) {
                $query->where('lang', $data['lang']);
            });
        })->when(arrayCheck('ids', $data), function ($query) use ($data) {
            $query->whereIn('id', $data['ids']);
        })->when(arrayCheck('take', $data), function ($query) use ($data) {
            $query->take($data['take']);
        })->latest()->paginate(setting('paginate'));
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
        }

        $request['slug'] = getSlug('subjects', $request['title']);

        $subject         = Subject::create($request);

        $this->langStore($request, $subject);

        return $subject;
    }

    public function find($id)
    {
        return Subject::find($id);
    }

    public function update($request, $id)
    {
        $subject = Subject::findOrfail($id);
        $data    = $request;
        if (arrayCheck('image_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['image_media_id'], '402', '238', true);
        }
        if (arrayCheck('meta_image', $request)) {
            $request['meta_image'] = $this->getImageWithRecommendedSize($request['meta_image'], '1200', '630', true);
        }

        if (arrayCheck('lang', $request) && $request['lang'] != 'en') {
            $request['title']            = $subject->title;
            $request['meta_title']       = $subject->meta_title;
            $request['meta_keywords']    = $subject->meta_keywords;
            $request['meta_description'] = $subject->meta_description;
        }

        $subject->update($request);

        if ($request['translate_id']) {
            $request['lang'] = $request['lang'] ?: 'en';
            $this->langUpdate($data);
        } else {
            $this->langStore($data, $subject);
        }

        return $subject;
    }

    public function status($data)
    {
        $key         = Subject::findOrfail($data['id']);
        $key->status = $data['status'];

        return $key->save();
    }

    public function destroy($id)
    {
        return Subject::destroy($id);
    }

    public function langStore($request, $subject)
    {
        return SubjectLanguage::create([
            'subject_id'       => $subject->id,
            'title'            => $request['title'],
            'meta_title'       => $request['meta_title'],
            'meta_keywords'    => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
            'lang'             => arrayCheck('lang', $request) ? $request['lang'] : 'en',
        ]);
    }

    public function langUpdate($request)
    {
        return SubjectLanguage::where('id', $request['translate_id'])->update([
            'lang'             => $request['lang'],
            'title'            => $request['title'],
            'meta_title'       => $request['meta_title'],
            'meta_keywords'    => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
        ]);
    }
}
