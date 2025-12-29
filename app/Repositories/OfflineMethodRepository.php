<?php

namespace App\Repositories;

use App\Models\OfflineMethod;
use App\Models\OfflineMethodLanguage;
use App\Traits\ImageTrait;

class OfflineMethodRepository
{
    use ImageTrait;

    public function all()
    {
        return OfflineMethod::latest()->paginate(setting('paginate'));
    }

    public function activeMethods($data = [])
    {
        return OfflineMethod::active()->latest()->get();
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $method = OfflineMethodLanguage::where('lang', 'en')->where('offline_method_id', $id)->first();
        } else {
            $method = OfflineMethodLanguage::where('lang', $lang)->where('offline_method_id', $id)->first();
            if (! $method) {
                $method                     = OfflineMethodLanguage::where('lang', 'en')->where('offline_method_id', $id)->first();
                $method['translation_null'] = 'not-found';
            }
        }

        return $method;
    }

    public function store($request)
    {
        $data    = $request;
        if (arrayCheck('offline_method_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['offline_method_media_id'], '147', '80', true);
        }

        if ($request['type'] != 'bank_payment') {
            $request['bank_details'] = [];
        }
        $offline = OfflineMethod::create($request);

        $this->langStore($data, $offline);

        return $offline;
    }

    public function find($id)
    {
        return OfflineMethod::find($id);
    }

    public function update($request, $id)
    {
        $data    = $request;
        $offline = OfflineMethod::findOrfail($id);

        if (arrayCheck('offline_method_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['offline_method_media_id'], '147', '80', true);
        }

        if (arrayCheck('lang', $request) && $request['lang'] != 'en') {
            $request['name'] = $offline->title;
        }

        if ($request['type'] != 'bank_payment') {
            $request['bank_details'] = [];
        }

        $offline->update($request);

        if ($request['translate_id']) {
            $request['lang'] = $request['lang'] ?: 'en';
            $this->langUpdate($data);
        } else {
            $this->langStore($data, $offline);
        }

        return $offline;
    }

    public function status($data)
    {
        $method         = OfflineMethod::find($data['id']);
        $method->status = $data['status'];
        $method->save();

        return $method;
    }

    public function destroy($id): int
    {
        OfflineMethodLanguage::where('offline_method_id', $id)->delete();

        return OfflineMethod::destroy($id);
    }

    public function langStore($request, $method)
    {
        return OfflineMethodLanguage::create([
            'offline_method_id' => $method->id,
            'name'              => $request['name'],
            'instructions'      => $request['instructions'],
            'lang'              => arrayCheck('lang', $request) ? $request['lang'] : 'en',
        ]);
    }

    public function langUpdate($request)
    {
        return OfflineMethodLanguage::where('id', $request['translate_id'])->update([
            'lang'         => $request['lang'],
            'name'         => $request['name'],
            'instructions' => $request['instructions'],
        ]);
    }
}
