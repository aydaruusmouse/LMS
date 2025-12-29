<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Addon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ZipArchive;

class AddonController extends Controller
{
    protected $installed_addon;

    public function index()
    {
        try {
            $data = [
                'addons' => Addon::paginate(setting('paginate')),
            ];

            return view('backend.admin.addons.installed', $data);
        } catch (\Exception $e) {
        }
    }

    public function addonMarketPlace()
    {
        return view('backend.admin.addons.available');
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'purchase_code'  => 'required',
            'addon_zip_file' => 'required|mimes:zip',
        ]);
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $rand_str_dir = Str::random(10);
        try {
            $verify_code           = 'verified'; //$this->valid_purchase_code($request->purchase_code);
            if ($verify_code == 'unverified') {
                return response()->json(['error' => 'There is a problem with your purchase code.Please contact with Envato support team.']);
            }

            $dir                   = 'public/addons';
            if (! is_dir(base_path($dir))) {
                mkdir(base_path($dir), 0777, true);
            }

            $zip                   = new ZipArchive();
            $open_able             = $zip->open($request->addon_zip_file);

            if (! class_exists('ZipArchive')) {
                return response()->json(['error' => 'ZipArchive class not found']);
            }

            if ($open_able) {
                $zip->extractTo(base_path('public/addons/'.$rand_str_dir.'/'));
                $zip->close();
            } else {
                return response()->json(['error' => 'Unable to open file, please try again']);
            }
            $get_addon_class       = glob(base_path('public/addons/'.$rand_str_dir.'/*Addon.php'));
            if (empty($get_addon_class)) {
                File::deleteDirectory(base_path('public/addons/'.$rand_str_dir));

                return response()->json(['error' => 'Addon.php file not found']);
            }
            $get_addon_class       = explode('/', $get_addon_class[0]);
            $get_addon_class       = explode('.', end($get_addon_class));
            $this->installed_addon = substr($get_addon_class[0], 0, -5);

            try {
                $read_json = file_get_contents(base_path("public/addons/$rand_str_dir/config.json"));
            } catch (\Exception $e) {
                File::deleteDirectory(base_path('public/addons/'.$rand_str_dir));

                return response()->json(['error' => 'config.json file not found']);
            }
            $decoded_json          = json_decode($read_json, true);
            $addon_name            = $decoded_json['name'];
            $addon_description     = $decoded_json['description'];
            $addon_identifier      = $decoded_json['addon_identifier'];
            $purchase_code         = $request->purchase_code;
            $addon_version         = $decoded_json['version'];
            $cms_version           = $decoded_json['required_cms_version'];
            $app_version           = $decoded_json['required_app_version'];

            if (isAppMode() && setting('current_version') < $app_version) {
                File::deleteDirectory(base_path('public/addons/'.$rand_str_dir));

                return response()->json(['error' => 'Please update your app version to install this addon.']);
            }

            if (setting('current_version') < $cms_version) {
                File::deleteDirectory(base_path('public/addons/'.$rand_str_dir));

                return response()->json(['error' => 'Please update your cms version to install this addon.']);
            }

            $addon_exist           = Addon::where('addon_identifier', $addon_identifier)->first();

            if ($addon_exist) {
                File::deleteDirectory(base_path('app/Addons/'.$this->installed_addon));
                Addon::where('addon_identifier', $addon_identifier)->update([
                    'purchase_code' => $purchase_code,
                    'version'       => $addon_version,
                    'image'         => '',
                ]);
            } else {
                Addon::create([
                    'name'             => $addon_name,
                    'description'      => $addon_description,
                    'addon_identifier' => $addon_identifier,
                    'purchase_code'    => $purchase_code,
                    'version'          => $addon_version,
                    'image'            => '',
                    'status'           => 1,
                ]);
            }

            File::move(base_path('public/addons/'.$rand_str_dir), base_path('app/Addons/'.$this->installed_addon));
            File::deleteDirectory(base_path('public/addons/'.$rand_str_dir));

            Artisan::call('migrate', [
                '--path'  => "app/Addons/$this->installed_addon/migrations",
                '--force' => true,
            ]);
            Artisan::call('all:clear');

            Toastr::success('Addon installed successfully.');

            return response()->json(['success' => 'Addon installed successfully.']);
        } catch (\Exception $e) {
            if (is_dir(base_path('public/addons/'.$rand_str_dir))) {
                File::deleteDirectory(base_path('public/addons/'.$rand_str_dir));
            }
            if (is_dir(base_path('app/addons/'.$this->installed_addon))) {
                File::deleteDirectory(base_path('app/Addons/'.$this->installed_addon));
            }

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function valid_purchase_code($purchase_code = '')
    {
        $purchase_code = urlencode($purchase_code);
        $verified      = 'unverified';
        if (! empty($purchase_code) && $purchase_code != '' && strlen($purchase_code) > 24) {
            $url      = 'https://api.envato.com/v3/market/author/sale?code='.$purchase_code;
            $ch       = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Envato API Wrapper PHP)');

            $header   = [];
            $header[] = 'Content-length: 0';
            $header[] = 'Content-type: application/json';
            $header[] = 'Authorization: Bearer 5CZXrrM34RPf7ukUzCKqod2BAcQJNKE6';

            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            $data     = curl_exec($ch);
            curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if (! empty($data)) {
                $result = json_decode($data, true);
                if (isset($result['buyer']) && isset($result['item']['id'])) {
                    return $result;
                }
            }
        }

        return $verified;
    }

    public function statusChange(Request $request): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status'  => 'danger',
                'message' => __('this_function_is_disabled_in_demo_server'),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
        try {
            $key         = Addon::findOrfail($request->id);
            $key->status = $request->status;
            $key->save();
            Artisan::call('all:clear');
            $data        = [
                'status'  => 200,
                'message' => __('update_successful'),
                'title'   => 'success',
                'reload'  => '1',
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'status'  => 400,
                'message' => $e->getMessage(),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
    }
}
