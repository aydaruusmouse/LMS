<?php

namespace App\Repositories;

use App\Models\State;

class StateRepository
{
    public function all()
    {
        return State::orderByDesc('id')->paginate(setting('paginate'));
    }

    public function activeState()
    {
        return State::active()->orderBy('name')->get();
    }

    public function stateByCountry($id)
    {
        return State::where('country_id', $id)->active()->orderBy('name')->get();
    }

    public function store($request)
    {
        return State::create($request);
    }

    public function find($id)
    {
        return State::find($id);
    }

    public function update($request, $id)
    {
        return State::find($id)->update($request);
    }

    public function delete($id): int
    {
        return State::destroy($id);
    }

    public function statusChange($request)
    {
        $id = $request['id'];

        return State::find($id)->update($request);
    }

    public function destroy($id): int
    {
        return State::destroy($id);
    }
}
