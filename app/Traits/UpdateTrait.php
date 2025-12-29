<?php

namespace App\Traits;

use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use ZipArchive;

trait UpdateTrait
{
    private $files = [];

    public function recurse_copy($src, $dst)
    {
        // return $src;
        $dir = opendir($src);

        if (! is_dir($dst)) {
            mkdir($dst, 0777, true);
        }
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src.'/'.$file)) {
                    $this->recurse_copy($src.'/'.$file, $dst.'/'.$file);
                } else {
                    copy($src.'/'.$file, $dst.'/'.$file);
                    chmod($dst.'/'.$file, 0777);
                }
            }
        }
        closedir($dir);
    }

    public function backup($src, $dst)
    {
        $zipname = base_path('public/backup_update.zip');
        $new_zip = new ZipArchive;

        $new_zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $this->recurse($src, $dst);

        foreach ($this->files as $file) {
            if (! is_dir($file) && file_exists($file)) {
                $new_zip->addFile($file);
            }
        }

        $new_zip->close();
    }

    public function recurse($src, $dst)
    {
        $dir = opendir($src);

        if (! is_dir($dst)) {
            mkdir($dst, 0777, true);
        }

        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src.'/'.$file)) {
                    $this->files[] = $dst.'/'.$file;
                    $this->recurse($src.'/'.$file, $dst.'/'.$file);
                } else {
                    $file_location = str_replace('public/updater', '', $src);
                    $this->files[] = $file_location.'/'.$file;
                }
            }
        }
        closedir($dir);
    }

    public function delete_directory($dirname, $is_remove = true): bool
    {
        $dir_handle = '';
        if (is_dir($dirname)) {
            $dir_handle = opendir($dirname);
        }
        if (! $dir_handle) {
            return false;
        }
        while ($file = readdir($dir_handle)) {
            if ($file != '.' && $file != '..' && $file != '.gitignore') {
                if (! is_dir($dirname.'/'.$file)) {
                    unlink($dirname.'/'.$file);
                } else {
                    $this->delete_directory($dirname.'/'.$file);
                }
            }
        }
        closedir($dir_handle);
        if ($is_remove) {
            rmdir($dirname, 0777);
        }

        return true;
    }

    public function downloadUpdateFile($data): bool|string
    {
        try {
            $script_url   = str_replace('admin/update-system', '', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
            $fields       = [
                'domain'        => urlencode($_SERVER['SERVER_NAME']),
                'version'       => getArrayValue('version', $data, setting('current_version') + 1),
                'item_id'       => '47989504',
                'purchase_code' => urlencode(setting('purchase_code')),
                'url'           => urlencode($script_url),
                'is_beta'       => config('app.dev_mode') ? 1 : 0,
            ];

            $request      = curlRequest('https://desk.spagreen.net/verify-installation-v2', $fields);

            if (property_exists($request, 'status') && $request->status) {
                $response = $request->status;
            } else {
                return 'Something went wrong with your purchase code/Contact with Script Author';
            }

            $zip_file     = $request->release_zip_link;
            $file_path    = base_path('public/updater.zip');

            if ($zip_file) {
                try {
                    file_put_contents($file_path, file_get_contents($zip_file));
                } catch (\Exception $e) {

                    return 'Zip file cannot be Imported. Please check your server permission or Contact with Script Author.';
                }
            } else {
                return 'Zip file cannot be Imported. Please check your server permission or Contact with Script Author.';
            }

            if (file_exists($file_path)) {
                $zip = new ZipArchive;
                if ($zip->open($file_path) === true) {
                    $zip->extractTo(base_path('/'));
                    $zip->close();
                } else {
                    return 'Zip file cannot be Imported. Please check your server permission or Contact with Script Author.';
                }
                unlink($file_path);
            }

            $config_file  = base_path('config.json');
            if (file_exists($config_file)) {
                $config = json_decode(file_get_contents($config_file), true);
            } else {
                return 'Config File Not Found, Please Try Again';
            }

            $version      = isAppMode() ? $config['app_version'] : $config['web_version'];
            $version_code = isAppMode() ? $config['app_version_code'] : $config['web_version_code'];

            $code         = Setting::where('title', 'version_code')->first();
            $version_no   = Setting::where('title', 'current_version')->first();

            if ($code) {
                $code->update([
                    'value' => $version_code,
                ]);
            } else {
                Setting::create([
                    'title' => 'version_code',
                    'value' => $version_code,
                ]);
            }

            if ($version_no) {
                $version_no->update([
                    'value' => $version,
                ]);
            } else {
                Setting::create([
                    'title' => 'current_version',
                    'value' => $version,
                ]);
            }

            try {
                if (arrayCheck('removed_directories', $config)) {
                    foreach ($config['removed_directories'] as $directory) {
                        File::deleteDirectory(base_path($directory));
                    }
                }
            } catch (\Exception $e) {
                return "Couldn't Remove Old Files, Please Try Again";
            }
            envWrite('APP_INSTALLED', true);
            envWrite('DEV_MODE', false);
            if (env('DEMO_MODE') == 'yes') {
                envWrite('DEMO_MODE', true);
            } else {
                envWrite('DEMO_MODE', false);
            }
            Artisan::call('migrate', ['--force' => true]);
            Artisan::call('all:clear');

            return true;

        } catch (\Exception $e) {
            return false;
        }
    }
}
