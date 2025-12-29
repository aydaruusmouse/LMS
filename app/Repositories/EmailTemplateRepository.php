<?php

namespace App\Repositories;

use App\Models\EmailTemplate;

class EmailTemplateRepository
{
    public function get($id)
    {
        return EmailTemplate::findorfail($id);
    }

    public function authentication()
    {
        return EmailTemplate::where('email_type', 'authentication')->get();
    }

    public function update($request)
    {
        $id = $request['id'];

        return EmailTemplate::find($id)->update($request);
    }
}
