<?php

namespace App\Repositories;

use App\Models\Section;

class SectionRepository
{
    public function store($request)
    {
        $request['slug'] = getSlug('sections', $request['title']);

        return Section::create($request);
    }

    public function find($id)
    {
        return Section::find($id);
    }

    public function update($request, $id)
    {
        $section         = Section::findOrfail($id);
        $request['slug'] = getSlug('sections', $request['title']);

        return $section->update($request);
    }

    public function destroy($id)
    {
        return Section::destroy($id);
    }

    public function sectionsOrder($data): bool
    {
        Section::where('course_id', $data['course_id'])->update(['order_no' => 0]);

        foreach ($data['ids'] as $key => $value) {
            $section           = Section::find($value);
            $section->order_no = $key + 1;
            $section->save();
        }

        return true;
    }
}
