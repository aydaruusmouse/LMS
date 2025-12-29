<?php

namespace App\Repositories;

use App\Models\Expertise;
use App\Models\ExpertiseLanguage;

class ExpertiseRepository
{
    public function all()
    {
        return Expertise::orderByDesc('id')->paginate(setting('paginate'));
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $expertise = ExpertiseLanguage::where('lang', 'en')->where('expertise_id', $id)->first();
        } else {
            $expertise = ExpertiseLanguage::where('lang', $lang)->where('expertise_id', $id)->first();
            if (! $expertise) {
                $expertise                     = ExpertiseLanguage::where('lang', 'en')->where('expertise_id', $id)->first();
                $expertise['translation_null'] = 'not-found';
            }
        }

        return $expertise;
    }

    public function activeExpertises()
    {
        return Expertise::active()->latest()->get();
    }

    public function store($request)
    {
        $expertise = Expertise::create($request);
        $this->langStore($request, $expertise);

        return $expertise;
    }

    public function find($id)
    {
        return Expertise::find($id);
    }

    public function update($request, $id)
    {
        $expertise = Expertise::find($id);

        $expertise->update($request);

        if ($request['translate_id']) {
            $request['lang'] = $request['lang'] ?: 'en';
            $this->langUpdate($request);
        } else {
            $this->langStore($request, $expertise);
        }

        return $expertise;
    }

    public function status($data)
    {
        $key         = Expertise::findOrfail($data['id']);
        $key->status = $data['status'];

        return $key->save();
    }

    public function destroy($id): int
    {
        return Expertise::destroy($id);
    }

    public function langStore($request, $subject)
    {
        return ExpertiseLanguage::create([
            'expertise_id' => $subject->id,
            'title'        => $request['title'],
            'lang'         => arrayCheck('lang', $request) ? $request['lang'] : 'en',
        ]);
    }

    public function langUpdate($request)
    {
        return ExpertiseLanguage::where('id', $request['translate_id'])->update([
            'lang'  => $request['lang'],
            'title' => $request['title'],
        ]);
    }

    public function instructorExperties($erperties)
    {
        return Expertise::whereIn('id', $erperties)->get();
    }
}
