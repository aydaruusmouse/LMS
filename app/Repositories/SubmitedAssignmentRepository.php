<?php

namespace App\Repositories;

use App\Models\SubmitedAssignment;
use App\Traits\ImageTrait;

class SubmitedAssignmentRepository
{
    use ImageTrait;

    public function store($request)
    {
        if (arrayCheck('submitted_file', $request)) {
            $type            = get_yrsetting('supported_mimes');
            $extension       = strtolower($request['submitted_file']->getClientOriginalExtension());
            $request['file'] = $this->saveFile($request['submitted_file'], $type[$extension]);

        }

        return SubmitedAssignment::create($request);
    }

    public function update($request, $id)
    {
        if (arrayCheck('submitted_file', $request)) {
            $type            = get_yrsetting('supported_mimes');
            $extension       = strtolower($request['submitted_file']->getClientOriginalExtension());
            $request['file'] = $this->saveFile($request['submitted_file'], $type[$extension]);

        }
        $submit_assignment = SubmitedAssignment::find($id);

        return $submit_assignment->update($request);
    }

    public function delete($id)
    {
        $submitted_data = SubmitedAssignment::find($id);

        return $submitted_data->delete();
    }
}
