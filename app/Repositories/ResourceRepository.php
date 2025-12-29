<?php

namespace App\Repositories;

use App\Models\Resource;
use App\Traits\ImageTrait;

class ResourceRepository
{
    use ImageTrait;

    public function all()
    {
        return Resource::orderByDesc('id')->paginate(setting('paginate'));
    }

    public function activeLesson($data)
    {
        return Resource::active()->when(arrayCheck('q', $data), function ($query) use ($data) {
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
        $slug   = getSlug('sections', $request['title']);

        $lesson = Resource::create([
            'slug'       => $slug,
            'course_id'  => $request->course_id,
            'section_id' => 1,
            'title'      => $request->title,
            'source'     => $request->file,
        ]);

        $lesson->course->increment('total_lesson');

        return $lesson;
    }

    public function find($id)
    {
        return Resource::find($id);
    }

    public function update($request, $id)
    {
        $lesson          = Resource::findOrfail($id);

        if (arrayCheck('image_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['image_media_id'], '402', '238', true);
        }

        if (arrayCheck('source', $request) && arrayCheck('source_data', $request) && $request['source'] == 'upload') {
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
        $lesson = Resource::findOrfail($id);
        $lesson->course->decrement('total_lesson');

        if ($lesson->source == 'upload' && $lesson->source_data) {
            $this->deleteFile($lesson->source_data);
        }

        return Resource::destroy($id);
    }

    public function lessonsOrder($data): bool
    {
        Resource::where('section_id', $data['section_id'])->update(['order_no' => 0]);

        foreach ($data['ids'] as $key => $value) {
            $section           = Resource::find($value);
            $section->order_no = $key + 1;
            $section->save();
        }

        return true;
    }

    public function myResource($courseIds = [])
    {
        return Resource::whereIn('course_id', $courseIds)->get();
    }

    public function myResourceBasedOnCourseID($courseIds)
    {
        return Resource::where('course_id', $courseIds)->get();
    }
}
