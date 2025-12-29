<?php

namespace App\Repositories;

use App\Models\Badge;

class BadgeRepository
{
    public function all()
    {
        return Badge::orderByDesc('id')->paginate(setting('pagination'));
    }

    public function store($request)
    {
        return Badge::create($request);
    }

    public function update($request, $id)
    {
        return Badge::findOrfail($id)->update($request);
    }

    public function destroy($id)
    {
        return Badge::destroy($id);
    }

    public function activeBadge($data = [])
    {
        return Badge::where('status', 1)->when(arrayCheck('q', $data), function ($query) use ($data) {
            $query->where('badges.name', 'like', '%'.$data['q'].'%');
        })->when(arrayCheck('to_day', $data), function ($query) use ($data) {
            $query->where('to_day', '<=', $data['to_day']);
        })->when(arrayCheck('lang', $data), function ($query) use ($data) {
            $query->join('badge_languages', 'badges.id', 'badge_languages.badge_id')
                ->where('badge_languages.lang', $data['lang'])
                ->selectRaw('badges.*,badge_languages.name as badge_name, badge_languages.description as lang_description');
        })->latest()->get();
    }
}
