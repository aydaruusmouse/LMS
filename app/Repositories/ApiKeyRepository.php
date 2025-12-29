<?php

namespace App\Repositories;

use App\Models\ApiKey;
use App\Models\ApiKeyLanguage;

class ApiKeyRepository
{
    public function all($data = [])
    {
        if (! arrayCheck('paginate', $data)) {
            $data['paginate'] = setting('paginate');
        }

        return ApiKey::paginate($data['paginate']);
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $api_key = ApiKeyLanguage::where('lang', 'en')->where('api_key_id', $id)->first();
        } else {
            $api_key = ApiKeyLanguage::where('lang', $lang)->where('api_key_id', $id)->first();
            if (! $api_key) {
                $api_key                     = ApiKeyLanguage::where('lang', 'en')->where('api_key_id', $id)->first();
                $api_key['translation_null'] = 'not-found';
            }
        }

        return $api_key;
    }

    public function store($request)
    {
        $key = ApiKey::create($request);
        $this->langStore($request, $key);

        return $key;
    }

    public function get($id)
    {
        return ApiKey::findOrfail($id);
    }

    public function update($request, $id)
    {
        $key  = ApiKey::findOrfail($id);
        $data = $request;

        if (arrayCheck('lang', $data) && $data['lang'] != 'en') {
            $data['title'] = $key->title;
        }

        $key->update($data);

        if ($request['translate_id']) {
            $request['lang'] = $request['lang'] ?: 'en';
            $this->langUpdate($request);
        } else {
            $this->langStore($request, $key);
        }

        return $key;
    }

    public function destroy($id)
    {
        $apiKey = ApiKey::findOrfail($id);

        return $apiKey->delete();
    }

    public function delete($request)
    {
        $apiKey = ApiKey::findOrfail($request['id']);
        if ($apiKey->status == 1) {
            $apiKey->status = 0;
        } else {
            $apiKey->status = 1;
        }

        return $apiKey->save();
    }

    public function langStore($request, $key)
    {
        return ApiKeyLanguage::create([
            'api_key_id' => $key->id,
            'title'      => $request['title'],
            'lang'       => arrayCheck('lang', $request) ? $request['lang'] : 'en',
        ]);
    }

    public function langUpdate($request)
    {
        return ApiKeyLanguage::where('id', $request['translate_id'])->update([
            'title' => $request['title'],
            'lang'  => $request['lang'],
        ]);
    }
}
