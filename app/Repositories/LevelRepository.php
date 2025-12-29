<?php

namespace App\Repositories;

use App\Models\Level;
use App\Models\LevelLanguage;

class LevelRepository
{
    public function all()
    {
        return Level::orderByDesc('id')->paginate(setting('paginate'));
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $level = LevelLanguage::where('lang', 'en')->where('level_id', $id)->first();
        } else {
            $level = LevelLanguage::where('lang', $lang)->where('level_id', $id)->first();
            if (! $level) {
                $level                     = LevelLanguage::where('lang', 'en')->where('level_id', $id)->first();
                $level['translation_null'] = 'not-found';
            }
        }

        return $level;
    }

    public function activeLevels($data = [])
    {
        return Level::active()->when(arrayCheck('q', $data), function ($query) use ($data) {
            $query->whereHas('languages', function ($query) use ($data) {
                $query->where('title', 'like', '%'.$data['q'].'%');
            });
        })->when(arrayCheck('take', $data), function ($query) use ($data) {
            $query->take($data['take']);
        })->latest()->get();
    }

    public function levels($data, $relation = [])
    {
        return Level::with($relation)->active()->latest()->paginate($data['paginate']);
    }

    public function store($request)
    {
        $level = Level::create($request);
        $this->langStore($request, $level);

        return $level;
    }

    public function find($id)
    {
        return Level::find($id);
    }

    public function update($request, $id)
    {
        $level = Level::find($id);
        $data  = $request;

        if (arrayCheck('lang', $request) && $request['lang'] != 'en') {
            $request['title'] = $level->title;
        }
        $level->update($request);

        if ($request['translate_id']) {
            $request['lang'] = $request['lang'] ?: 'en';
            $this->langUpdate($data);
        } else {
            $this->langStore($data, $level);
        }

        return $level;
    }

    public function status($data)
    {
        $key         = Level::findOrfail($data['id']);
        $key->status = $data['status'];

        return $key->save();
    }

    public function destroy($id): int
    {
        return Level::destroy($id);
    }

    public function langStore($request, $level)
    {
        return LevelLanguage::create([
            'level_id' => $level->id,
            'title'    => $request['title'],
            'lang'     => arrayCheck('lang', $request) ? $request['lang'] : 'en',
        ]);
    }

    public function langUpdate($request)
    {
        return LevelLanguage::where('id', $request['translate_id'])->update([
            'lang'  => $request['lang'],
            'title' => $request['title'],
        ]);
    }
}
