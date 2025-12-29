<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Traits\ImageTrait;

class LessonRepository
{
    use ImageTrait;

    public function all()
    {
        return Lesson::orderByDesc('id')->paginate(setting('paginate'));
    }

    public function activeLesson($data)
    {
        return Lesson::active()->when(arrayCheck('q', $data), function ($query) use ($data) {
            $query->where('title', 'like', '%'.$data['q'].'%');
        })->whereHas('course', function ($query) {
            $query->active();
        })->whereHas('section', function ($query) {
            $query->active();
        })->when(arrayCheck('ids', $data), function ($query) use ($data) {
            $query->whereIn('id', $data['ids']);
        })->when(arrayCheck('section_id', $data), function ($query) use ($data) {
            $query->where('section_id', $data['section_id']);
        })->latest()->get();
    }

    public function store($request)
    {
        if (arrayCheck('image_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['image_media_id'], '402', '238', true);
        }
        if (arrayCheck('source', $request) && arrayCheck('source_data', $request) && $request['source'] == 'upload') {
            $request['source_data'] = $this->saveFile($request['source_data'], 'pos_file', false);
        }

        $request['slug'] = getSlug('sections', $request['title']);
        $lesson          = Lesson::create($request);

        $lesson->course->increment('total_lesson');

        return $lesson;
    }

    public function find($id)
    {
        return Lesson::find($id);
    }

    public function update($request, $id)
    {
        $lesson          = Lesson::findOrfail($id);

        if (arrayCheck('image_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['image_media_id'], '402', '238', true);
        }

        if (arrayCheck('source', $request)
         && arrayCheck('source_data', $request)
         && $request['source'] == 'upload'
         && ! is_string($request['source_data'])

        ) {
            $request['source_data'] = $this->saveFile($request['source_data'], 'pos_file', false);
        }

        $request['slug'] = getSlug('sections', $request['title']);

        if (! arrayCheck('is_free', $request)) {
            $request['is_free'] = 0;
        }
        $lesson->update($request);

        return $lesson;
    }

    public function destroy($id)
    {
        $lesson = Lesson::findOrfail($id);
        $lesson->course->decrement('total_lesson');

        if ($lesson->source == 'upload' && $lesson->source_data) {
            $this->deleteFile($lesson->source_data);
        }

        return Lesson::destroy($id);
    }

    public function lessonsOrder($data): bool
    {
        Lesson::where('section_id', $data['section_id'])->update(['order_no' => 0]);

        foreach ($data['ids'] as $key => $value) {
            $section           = Lesson::find($value);
            $section->order_no = $key + 1;
            $section->save();
        }

        return true;
    }

    public function findBySlug($slug, $with = [])
    {
        return Lesson::with($with)->when(arrayCheck('progress', $with), function ($query) {
            $query->with('progress', function ($query) {
                $query->where('user_id', auth()->id());
            });
        })->where('slug', $slug)->first();
    }
}
