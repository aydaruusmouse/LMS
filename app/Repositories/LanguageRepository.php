<?php

namespace App\Repositories;

use App\Models\FlagIcon;
use App\Models\Language;
use App\Models\LanguageConfig;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LanguageRepository
{
    public function all()
    {
        return Language::orderByDesc('id')->paginate(setting('paginate'));
    }

    public function get($id)
    {
        return Language::findOrfail($id);
    }

    public function activeLanguage()
    {
        return Language::where('status', 1)->get();
    }

    public function store($request)
    {
        $language  = Language::create($request);

        $base_path = base_path("lang/$language->locale.json");
        if (! File::exists($base_path)) {
            $translation_keys = file_get_contents(base_path('lang/en.json'));
            file_put_contents(base_path("lang/$language->locale.json"), $translation_keys);
        }

        return $language;
    }

    public function update($request, $id): bool
    {
        if (! arrayCheck('text_direction', $request)) {
            $request['text_direction'] = 'ltr';
        }
        if (! arrayCheck('status', $request)) {
            $request['status'] = 0;
        }
        $language          = $this->get($id);
        $request['locale'] = $language->locale;
        $language->update($request);

        return $language;
    }

    protected function createConfig($request, $language): bool
    {
        if ($language->languageConfig) {
            $language->languageConfig->update([
                'name'     => arrayCheck('name', $request) ? $request['name'] : null,
                'script'   => arrayCheck('script', $request) ? $request['script'] : null,
                'native'   => arrayCheck('native', $request) ? $request['native'] : null,
                'regional' => arrayCheck('regional', $request) ? $request['regional'] : null,
            ]);
        } else {
            LanguageConfig::create([
                'language_id' => $language->id,
                'name'        => $language->name,
                'script'      => arrayCheck('script', $request) ? $request['script'] : null,
                'native'      => arrayCheck('native', $request) ? $request['native'] : null,
                'regional'    => arrayCheck('regional', $request) ? $request['regional'] : null,
            ]);
        }

        return true;
    }

    public function destroy($id): int
    {
        $language  = $this->get($id);

        DB::table('language_configs')->where('language_id', $id)->delete();
        $json_file = base_path("lang/$language->locale.json");

        if (File::exists($json_file)) {
            unlink($json_file);
        }

        return $language->delete($id);
    }

    public function statusChange($request)
    {
        $id = $request['id'];

        return Language::find($id)->update($request);
    }

    public function directionChange($request)
    {
        $id = $request['id'];
        if ($request['status'] == 1) {
            $request['text_direction'] = 'rtl';
        } elseif ($request['status'] == 0) {
            $request['text_direction'] = 'ltr';
        }

        return Language::find($id)->update([
            'text_direction' => $request['text_direction'],
        ]);
    }

    public function flags(): \Illuminate\Database\Eloquent\Collection
    {
        return FlagIcon::all();
    }

    public function generateTranslationFolders($locale): bool
    {
        ini_set('max_execution_time', 600); //600 seconds

        $path            = base_path('lang/'.$locale);
        $translationPath = base_path('lang/vendor/translation/'.$locale);
        $json_file       = 'lang/'.$locale.'.json';

        //make file if not exist
        if (! File::isDirectory($path)) {

            File::makeDirectory($path, 0777, true, true);
            File::copyDirectory(base_path('lang/en'), $path);
        }
        //make file if not exist
        if (! File::isDirectory($translationPath)) {

            File::makeDirectory($translationPath, 0777, true, true);
            File::copyDirectory(base_path('lang/vendor/translation/en'), $translationPath);
        }

        // Write json
        if (! File::exists($json_file)) {
            $newJsonString = file_get_contents(base_path('lang/en.json'));
            file_put_contents(base_path($json_file), $newJsonString);
        }

        return true;
    }
}
