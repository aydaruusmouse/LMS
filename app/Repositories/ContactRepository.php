<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    public function all()
    {
        return $all = Contact::orderByDesc('id')->paginate(setting('paginate'));
    }

    public function store($request)
    {
        $contact = Contact::create($request);

        return true;
    }

    public function update($request, $id)
    {
        $contact = Contact::findOrfail($id)->update($request);

        return true;
    }

    public function delete($id)
    {
        $contact = Contact::destroy($id);

        return true;
    }
}
