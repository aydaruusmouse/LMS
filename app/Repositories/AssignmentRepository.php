<?php

namespace App\Repositories;

use App\Models\Assignment;
use App\Traits\ImageTrait;
use Carbon\Carbon;

class AssignmentRepository
{
    use ImageTrait;

    public function activeAssignments($data = [])
    {
        return Assignment::when(arrayCheck('course_id', $data), function ($query) use ($data) {
            return $query->where('course_id', $data['course_id']);
        })->active()->latest()->paginate(setting('paginate'));
    }

    public function myAssignments()
    {
        return Assignment::where('status', 1)->CourseAssignment()->paginate(setting('paginate'));
    }

    public function store($request)
    {
        if (arrayCheck('file_media_id', $request)) {
            $request['file'] = $this->getFile($request['file_media_id']);
        }

        $request['deadline'] = Carbon::parse($request['deadline'])->format('Y-m-d H:i:s');
        $request['slug']     = getSlug('assignments', $request['title']);

        return Assignment::create($request);
    }

    public function find($id)
    {
        return Assignment::find($id);
    }

    public function update($request, $id)
    {
        $assignment          = Assignment::findOrfail($id);

        if (arrayCheck('file_media_id', $request)) {
            $request['file'] = $this->getFile($request['file_media_id']);
        }
        $request['slug']     = getSlug('assignments', $request['title']);
        $request['deadline'] = Carbon::parse($request['deadline'])->format('Y-m-d H:i:s');

        return $assignment->update($request);
    }

    public function destroy($id): int
    {
        return Assignment::destroy($id);
    }
}
