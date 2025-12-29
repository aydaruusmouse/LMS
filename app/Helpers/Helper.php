<?php

use App\Models\Country;
use App\Models\EmailTemplate;
use App\Models\InstructorPayoutMethod;
use App\Models\OrganizationPayoutMethod;
use App\Models\UserSubscription;
use Carbon\Carbon;
use GeoSot\EnvEditor\Facades\EnvEditor;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

if (! function_exists('curlRequest')) {
    function curlRequest($url, $fields, $method = 'POST', $headers = [], $is_array = false)
    {
        $client   = new \GuzzleHttp\Client(['verify' => false]);

        if (is_string($fields)) {
            $data = [
                'body'    => $fields,
                'headers' => $headers,
            ];
        } else {
            $data = [
                'form_params' => $fields,
                'headers'     => $headers,
            ];
        }

        $response = $client->request($method, $url, $data);

        $result   = $response->getBody()->getContents();

        return json_decode($result, $is_array);
    }
}
if (! function_exists('httpRequest')) {
    function httpRequest($url, $fields, $headers = [], $is_form = false, $method = 'POST')
    {
        if ($is_form) {
            $response = Http::withHeaders($headers)->asForm()->$method($url, $fields);
        } else {
            $response = Http::withHeaders($headers)->$method($url, $fields);
        }

        return $response->json();
    }
}
if (! function_exists('validate_purchase')) {
    function validate_purchase($code, $data)
    {
        $script_url    = str_replace('install/process', '', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

        $fields        = [
            'item_id'         => '47989504',
            'purchase_code'   => urlencode($code),
            'current_version' => setting('current_version'),
        ];
        $response      = false;

        if (config('app.dev_mode')) {
            $url = 'https://desk.spagreen.net/version-check-including-beta';
        } else {
            $url = 'https://desk.spagreen.net/version-check';
        }

        $request       = curlRequest($url, $fields);
        if (property_exists($request, 'status') && $request->status) {
            $response = $request->release_info;
        }

        if (is_bool($response)) {
            $latest_version = isAppMode() ? '100' : '140';
        } else {
            $latest_version = isAppMode() ? '100' : $response->version;
        }

        $fields        = [
            'domain'        => urlencode($_SERVER['SERVER_NAME']),
            'version'       => $latest_version,
            'item_id'       => isAppMode() ? '47989504' : '47989504',
            'url'           => urlencode($script_url),
            'purchase_code' => urlencode($code),
            'is_beta'       => config('app.dev_mode') ? 1 : 0,
        ];

        $curl_response = curlRequest('https://desk.spagreen.net/verify-installation-v2', $fields);

        if (property_exists($curl_response, 'status') && $curl_response->status) {
            try {
                envWrite('DB_HOST', $data['DB_HOST']);
                envWrite('DB_DATABASE', $data['DB_DATABASE']);
                envWrite('DB_USERNAME', $data['DB_USERNAME']);
                envWrite('DB_PASSWORD', $data['DB_PASSWORD']);
            } catch (\Exception $e) {
                return 'Unable to write env file!';
            }

            $zip_file = $curl_response->release_zip_link;

            if ($zip_file) {
                try {
                    $file_path = base_path('public/install/installer.zip');
                    file_put_contents($file_path, file_get_contents($zip_file));
                } catch (Exception $e) {
                    return 'Zip file cannot be Imported. Please check your server permission or Contact with Script Author.';
                }
            } else {
                return 'Zip file cannot be Imported. Please check your server permission or Contact with Script Author.';
            }

            return 'success';
        } else {
            return $curl_response->message;
        }
    }
}
if (! function_exists('hasPermission')) {

    function hasPermission($key_word): bool
    {
        if (in_array($key_word, auth()->user()->permissions ?? []) || auth()->user()->role_id == 1) {
            return true;
        }

        return false;
    }
}

if (! function_exists('is_file_exists')) {
    function is_file_exists($item, $storage = 'local')
    {
        if (! blank($item) && ! blank($storage)) {
            if ($storage == 'local') {
                if (file_exists(base_path('public/'.$item))) {
                    return true;
                }
            } elseif ($storage == 'aws_s3') {
                if (Storage::disk('s3')->exists($item)) {
                    return true;
                }
            } elseif ($storage == 'wasabi') {
                if (Storage::disk('wasabi')->exists($item)) {
                    return true;
                }
            }
        }

        return false;
    }
}
if (! function_exists('get_media')) {
    function get_media($item, $storage = 'local', $updater = false)
    {
        if (! blank($item) and ! blank($storage)) {
            if ($storage == 'local') {
                if ($updater) {
                    return base_path('public/'.$item);
                } else {
                    return app('url')->asset(isLocalhost().$item);
                }
            } elseif ($storage == 'aws_s3') {
                return Storage::disk('s3')->url($item);
            } elseif ($storage == 'wasabi') {
                return Storage::disk('wasabi')->url($item);
            }
        }

        return false;
    }
}
if (! function_exists('static_asset')) {

    function static_asset($path = null, $secure = null)
    {
        if (strpos(php_sapi_name(), 'cli') !== false || defined('LARAVEL_START_FROM_PUBLIC')) {
            return app('url')->asset($path, $secure);
        } else {
            return app('url')->asset('public/'.$path, $secure);
        }
    }
}
if (! function_exists('isLocalhost')) {

    function isLocalhost(): string
    {
        return ! (str_contains(php_sapi_name(), 'cli') || defined('LARAVEL_START_FROM_PUBLIC')) ? 'public/' : '';
    }
}
if (! function_exists('get_price')) {

    function get_price($price, $curr = null): ?string
    {
        return format_price(convert_price($price, $curr), $curr);
    }
}

if (! function_exists('format_price')) {

    function format_price($price, $curr = null)
    {
        $no_of_decimals         = setting('no_of_decimals');
        $decimal_separator      = setting('decimal_separator') ? setting('decimal_separator') : '.';
        $thousands_separator    = $decimal_separator == ',' ? '.' : ',';
        $currency_symbol_format = setting('currency_symbol_format') ? setting('currency_symbol_format') : 'amount_symbol';

        if ($no_of_decimals != '') {
            $price = number_format($price, $no_of_decimals, $decimal_separator, $thousands_separator);
        } else {
            $price = number_format($price, 3, $decimal_separator, $thousands_separator);
        }

        if ($currency_symbol_format == 'amount_symbol') {
            return $price.get_symbol($curr);
        } elseif ($currency_symbol_format == 'symbol_amount') {
            return get_symbol($curr).$price;
        } elseif ($currency_symbol_format == 'amount__symbol') {
            return $price.' '.get_symbol($curr);
        } elseif ($currency_symbol_format == 'symbol__amount') {
            return get_symbol($curr).' '.$price;
        }
    }
}
if (! function_exists('convert_price')) {

    function convert_price($price, $curr = null): float|int
    {
        $exchange_rate = 1;
        $currencies    = app('currencies');
        if (! $curr) {
            $curr = setting('default_currency');
        }
        $currency      = $currencies->where('code', $curr)->first();
        if ($currency) {
            $exchange_rate = $currency->exchange_rate;
        }

        return floatval($price) * floatval($exchange_rate);
    }
}
if (! function_exists('get_symbol')) {

    function get_symbol($curr = null)
    {
        $currencies = \app('currencies');

        if (! $curr) {
            $curr = setting('default_currency');
        }

        $symbol     = '$';

        $currency   = $currencies->where('code', $curr)->first();
        if ($currency) {
            $symbol = $currency->symbol;
        }

        return $symbol;
    }
}
if (! function_exists('base_price')) {

    function base_price($product)
    {
        $price = $product->price;
        $tax   = 0;
        if ($product->vat_tax != '') {
            foreach ($product->vatTaxes($product) as $vatTax) {
                $tax += ($price * $vatTax->percentage) / 100;
            }
        }
        $price += $tax;

        return format_price(convert_price($price));
    }
}
if (! function_exists('addon_is_activated')) {
    function addon_is_activated($addon_unique_identity)
    {
        $addon = \app('addons')->where('addon_identifier', $addon_unique_identity)->first();

        return isset($addon);
    }
}
if (! function_exists('fontURL')) {
    function fontURL()
    {
        $fonts_url     = static_asset('fonts/poppins/css.css');
        $font_title    = setting('fonts');
        $font_title_sl = preg_replace('/\s+/', '_', strtolower($font_title));
        if (File::exists(public_path('fonts/'.$font_title_sl.'/css.css'))) {
            $fonts_url = static_asset('fonts/'.$font_title_sl.'/css.css');
        }

        return $fonts_url;
    }
}
if (! function_exists('getFileName')) {
    function getFileName($file)
    {
        $name = '';
        if ($file) {
            $file = explode('/', $file);
            $name = $file[count($file) - 1];
        }

        return $name;
    }
}
if (! function_exists('envWrite')) {
    function envWrite($key, $value)
    {
        try {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            } else {
                $value = '"'.trim($value).'"';
            }
            if (EnvEditor::keyExists($key)) {
                EnvEditor::editKey($key, $value);
            } else {
                EnvEditor::addKey($key, $value);
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
if (! function_exists('nullCheck')) {
    function nullCheck($value)
    {
        return $value ?: '';
    }
}
if (! function_exists('languageCheck')) {
    function languageCheck()
    {
        if (cache()->has('locale')) {
            $lang = cache()->get('locale');
        } elseif (setting('default_language')) {
            $lang = setting('default_language');
        } else {
            $lang = 'en';
        }

        return $lang;
    }
}

if (! function_exists('priceFormatUpdate')) {
    function priceFormatUpdate($price, $curr, $type = null): float|int
    {
        if (! $price) {
            $price = 0;
        }
        $active_currency = \app('currencies')->where('id', $curr)->first();
        $rate            = $active_currency ? $active_currency->exchange_rate : 1;
        if ($type == '*') {
            return round($price * $rate, setting('no_of_decimals'));
        } else {
            return $price / $rate;
        }
    }
}
if (! function_exists('arrayCheck')) {
    function arrayCheck($key, $array): bool
    {
        return is_array($array) && count($array) > 0 && array_key_exists($key, $array) && ! empty($array[$key]) && $array[$key] != 'null';
    }
}
if (! function_exists('isAppMode')) {
    function isAppMode(): bool
    {
        return config('app.mobile_mode');
    }
}
if (! function_exists('geoLocale')) {
    function geoLocale()
    {
        try {
            $url      = 'http://www.geoplugin.net/json.gp';
            $response = curlRequest($url, [], 'GET');

            if (property_exists($response, 'geoplugin_status') && $response->geoplugin_status == 200) {
                $currency = [
                    'exchange_rate' => $response->geoplugin_currencyConverter,
                    'name'          => $response->geoplugin_currencyCode,
                    'symbol'        => $response->geoplugin_currencySymbol_UTF8,
                ];
            } else {
                $currency = [
                    'exchange_rate' => 1,
                    'name'          => 'USD',
                    'symbol'        => '$',
                ];
            }

            return [
                'currency' => $currency,
            ];
        } catch (\Exception $e) {
            $currency = [
                'exchange_rate' => 1,
                'name'          => 'USD',
                'symbol'        => '$',
            ];

            return [
                'currency' => $currency,
            ];
        }
    }
}
if (! function_exists('currencyList')) {
    function currencyList()
    {
        $currency_list = [];

        if (cache()->get('currency_list')) {
            $currency_list = cache()->get('currency_list');
        } else {
            $file = file_get_contents(public_path('sql/currencies.json'));
            $data = json_decode($file, true);
            foreach ($data as $key => $value) {
                $currency_list[$key] = $key;
            }
            cache()->put('currency_list', $currency_list, now()->addDays(5));
        }

        return $currency_list;
    }
}
if (! function_exists('jwtUser')) {
    function jwtUser()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return null;
        }

        return $user;
    }
}
if (! function_exists('authData')) {
    function authData($user, $token = null): array
    {
        $data = [
            'id'            => $user->id,
            'name'          => $user->name,
            'role_id'       => (int) $user->role_id,
            'phone'         => nullCheck($user->phone),
            'email'         => nullCheck($user->email),
            'location'      => nullCheck($user->location),
            'profile_image' => $user->profile_pic,
        ];

        if ($token) {
            $data['token'] = $token;
        }

        return $data;
    }
}
if (! function_exists('getArrayValue')) {
    function getArrayValue($key, $array, $default = null)
    {
        return arrayCheck($key, $array) ? $array[$key] : $default;
    }
}
if (! function_exists('getInputValue')) {
    function getInputValue($value)
    {
        return $value ?: old($value);
    }
}
if (! function_exists('get_yrsetting')) {

    function get_yrsetting($setting_for)
    {
        return config()->get('lmssetting.'.$setting_for);
    }
}

if (! function_exists('userAvailability')) {

    function userAvailability($user): array
    {
        if (! $user) {
            return [
                'status'  => false,
                'message' => __('user_not_found'),
                'code'    => 404,
            ];
        } elseif ($user->is_user_banned == 1) {
            return [
                'status'  => false,
                'message' => __('your_account_has_been_banned'),
                'code'    => 401,
            ];
        } elseif ($user->is_deleted == 1) {
            return [
                'status'  => false,
                'message' => __('user_not_found'),
                'code'    => 401,
            ];
        } elseif (! $user->email_verified_at) {
            return [
                'status'  => false,
                'message' => __('verify_your_mail_first'),
                'code'    => 401,
            ];
        } elseif ($user->status == 0) {
            return [
                'status'  => false,
                'message' => __('your_account_is_pending'),
                'code'    => 403,
            ];
        } elseif ($user->status == 2) {
            return [
                'status'  => false,
                'message' => __('your_account_is_suspended'),
                'code'    => 403,
            ];
        }

        return [
            'status'  => true,
            'message' => __('user_available'),
            'code'    => 200,
        ];
    }
}
if (! function_exists('setting')) {
    function setting($title, $lang = null)
    {
        if (! $lang) {
            $lang = app()->getLocale();
        }
        try {
            $settings = app('settings');
            if (! blank($title)) {
                if (in_array($title, get_yrsetting('setting_array')) || in_array($title, get_yrsetting('setting_image'))) {
                    $data = $settings->where('title', $title)->first();
                    if (! blank($data)) {
                        return $data->value ? unserialize($data->value) : [];
                    }
                } else {
                    if (in_array($title, get_yrsetting('setting_by_lang'))) {
                        $data = $settings->where('title', $title)->where('lang', $lang)->first();

                        if (blank($data)) {
                            $data = $settings->where('title', $title)->where('lang', 'en')->first();

                            return ! blank($data) ? $data->value : '';
                        }

                        return $data->value;
                    } else {
                        $data = $settings->where('title', $title)->first();
                    }

                    return ! blank($data) ? $data->value : '';
                }
            } else {
                return '';
            }
        } catch (\Exception $e) {
            // dd($e);
            return '';
        }
    }
}

if (! function_exists('getFileLink')) {
    function getFileLink($size, $array, $offline = null)
    {
        if ($size == 'original_image' && is_array($array) && array_key_exists($size, $array)) {
            if (@is_file_exists($array[$size], $array['storage'])) {
                return get_media($array[$size], $array['storage']);
            } else {
                return static_asset('images/default/default-image-320x320.png');
            }
        }
        if (is_array($array) && array_key_exists('image_'.$size, $array)) {
            if (@is_file_exists($array['image_'.$size], $array['storage'])) {
                return get_media($array['image_'.$size], $array['storage']);
            }
        }

        return static_asset('images/default/default-image-'.$size.'.png');
    }
}

if (! function_exists('checkEmptyProvider')) {
    function checkEmptyProvider($check_for)
    {
        foreach (get_yrsetting($check_for) as $title) {
            if (setting($title) == '') {
                return false;
            }
        }

        return true;
    }
}

if (! function_exists('menuActivation')) {
    function menuActivation($urls, $class, $other = null)
    {
        $check_lang = app()->getLocale() == setting('default_language') ? '' : app()->getLocale().'/';

        if (is_array($urls)) {
            foreach ($urls as $url) {
                if (Request::is($check_lang.$url)) {
                    return $class;
                }
            }
        } elseif (Request()->is($check_lang.$urls)) {
            return $class;
        } else {
            return $other;
        }
    }
}
if (! function_exists('formatBytes')) {

    function formatBytes($size, $precision = 2)
    {
        $base     = log($size, 1024);
        $suffixes = ['B', 'KB', 'MB', 'GB', 'TB'];

        return round(pow(1024, $base - floor($base)), $precision).' '.$suffixes[floor($base)];
    }
}
if (! function_exists('EmailTemplate')) {
    function EmailTemplate($title)
    {
        return EmailTemplate::where('title', $title)->first();
    }
}
if (! function_exists('countryCode')) {
    function countryCode($id = null)
    {
        if ($id) {
            $country = Country::find($id);
            $code    = @$country->phonecode;
        } elseif (setting('default_country')) {
            $country = Country::find(setting('default_country'));
            $code    = @$country->phonecode;
        } else {
            $country = Country::find(19);
            $code    = @$country->phonecode;
        }

        if (! $code) {
            $code = '+880';
        }

        return str_contains($code, '+') ? $code : '+'.$code;
    }
}

if (! function_exists('getSlug')) {
    function getSlug($table, $name, $column = 'slug', $id = null): string
    {
        $slug  = Str::slug($name);
        $count = \Illuminate\Support\Facades\DB::table($table)->when($id, function ($query) use ($id) {
            $query->where('id', '!=', $id);
        })->where($column, $slug)->count();
        if ($count > 0) {
            $slug = $slug.'-'.strtolower(Str::random(5));
        }

        return $slug;
    }
}

if (! function_exists('google_fonts_list')) {
    function google_fonts_list()
    {
        $path = storage_path().'/json/fonts.json';

        return json_decode(file_get_contents($path), true);
    }
}

if (! function_exists('css_font_name')) {
    function css_font_name($name)
    {
        $name = trim($name, '');
        $name = ucwords($name, '_');

        return str_replace('_', ' ', $name);
    }
}

if (! function_exists('font_link')) {
    function font_link()
    {
        $url              = '<link rel="preconnect" href="https://fonts.googleapis.com">';
        $url .= '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';

        // header font
        $header_font_name = setting('header_font');
        $header_font_name = trim($header_font_name, '');
        $header_font_name = ucwords($header_font_name, '_');
        $header_font_name = str_replace('_', '+', $header_font_name);
        $url .= '<link href="https://fonts.googleapis.com/css2?family='.$header_font_name.':wght@400;500;600;700&display=swap" rel="stylesheet">';

        if (setting('body_font') == setting('header_font')) {
            return $url;
        }

        //body font
        $body_font_name   = setting('body_font');
        if ($header_font_name != $body_font_name) {
            $body_font_name = trim($body_font_name, '');
            $body_font_name = ucwords($body_font_name, '_');
            $body_font_name = str_replace('_', '+', $body_font_name);
            $url .= '<link href="https://fonts.googleapis.com/css2?family='.$body_font_name.':wght@400;500;600;700&display=swap" rel="stylesheet">';
        }

        return $url;
    }
}
if (! function_exists('localeRoutePrefix')) {
    function localeRoutePrefix()
    {
        $current_locale       = false;
        $current_url          = url()->current();
        $locale               = languageCheck();

        $current_url_explodes = explode('/', $current_url);

        $all_locales          = app('languages')->pluck('locale')->toArray();

        foreach ($all_locales as $all_locale) {
            if (in_array($all_locale, $current_url_explodes)) {
                $locale         = $all_locale;
                $current_locale = true;
                break;
            }
        }

        if (! $current_locale) {
            $locale = setting('default_language');
        }

        cache()->put('locale', $locale);
        app()->setLocale($locale);

        if ($locale == setting('default_language')) {
            app()->setLocale($locale);

            return '';
        }

        return $locale;
    }
}
if (! function_exists('setLanguageRedirect')) {
    function setLanguageRedirect($language_locale, $current_url = null): array|string
    {
        if (! $current_url) {
            $current_url = url()->current();
        }
        $locale               = languageCheck();
        $current_locale       = '';

        $current_url_explodes = explode('/', $current_url);
        $all_locales          = app('languages')->pluck('locale')->toArray();

        foreach ($all_locales as $all_locale) {
            if (in_array($all_locale, $current_url_explodes)) {
                $current_locale = $all_locale;
                break;
            }
        }
        //gareral-setting
        $count                = 1;
        if ($current_locale) {
            $reload_url = str_replace("/$locale", "/$language_locale", $current_url);
        } else {
            $reload_url = str_replace(url(''), url("/$language_locale"), $current_url);
        }

        if ($language_locale == setting('default_language')) {
            $reload_url = str_replace("/$language_locale", '', $reload_url);
        }

        return $reload_url;
    }
}
if (! function_exists('systemLanguage')) {
    function systemLanguage()
    {
        $languages = app('languages');

        return $languages->where('locale', app()->getLocale())->first();
    }
}

if (! function_exists('packageSubscription')) {
    function packageSubscription($user_id, $package_id)
    {
        return UserSubscription::where('user_id', $user_id)->where('package_solutions_id', $package_id)->get();
    }
}

if (! function_exists('headerFooterMenu')) {

    function headerFooterMenu($title, $lang = 'en')
    {
        try {
            $settings = app('settings');
            if (in_array($title, get_yrsetting('setting_array')) || in_array($title, get_yrsetting('setting_by_lang'))) {
                $data = $settings->where('title', $title)->where('lang', $lang)->first();
                if (! blank($data)) {
                    return $data->value ? unserialize($data->value) : [];
                }
            }
        } catch (\Exception $e) {
            return '';
        }
    }
}

if (! function_exists('payoutMethod')) {
    function payoutMethod($organization_id, $payout_method)
    {
        return OrganizationPayoutMethod::where('organization_id', $organization_id)->where('payout_method', $payout_method)->first();
    }
}

if (! function_exists('instructorPayoutMethod')) {
    function instructorPayoutMethod($instructor_id, $payout_method)
    {
        return InstructorPayoutMethod::where('instructor_id', $instructor_id)->where('payout_method', $payout_method)->first();
    }
}

if (! function_exists('organizationPayoutMethod')) {
    function organizationPayoutMethod($organization_id, $payout_method)
    {
        return OrganizationPayoutMethod::where('organization_id', $organization_id)->where('payout_method', $payout_method)->first();
    }
}

if (! function_exists('getPdfFile')) {
    function getPdfFile($file, $type = null)
    {
        if (is_array($file)) {
            if ($type == 'title') {
                $files       = explode('/', $file['file']);

                return $name = $files[1];
            } else {
                return static_asset($file['file']);
            }
        } else {
            $file_array = explode('/', $file);

            return $file_array[count($file_array) - 1];
        }
    }
}

if (! function_exists('isHome')) {
    function isHome()
    {
        if (request()->path() == '/' || request()->path() == 'home1' || request()->path() == 'home2' || request()->path() == 'home3' || request()->path() == App::getLocale() || request()->path() == setting('default_language')) {
            return true;
        } else {
            return false;
        }
    }
}

if (! function_exists('isAuth')) {
    function isAuth()
    {
        if (request()->path() == ('sign-in' || 'sign-up')) {
            return true;
        } else {
            return false;
        }
    }
}

if (! function_exists('getRemainingDaysHours')) {
    function getRemainingDaysHours($givenDateTime)
    {
        // Convert the given date and time to a Carbon instance
        $targetDateTime  = Carbon::createFromFormat('Y-m-d H:i:s', $givenDateTime);

        // Get the current date and time as a Carbon instance
        $currentDateTime = Carbon::now();

        // Calculate the difference between the two dates
        $diff            = $currentDateTime->diff($targetDateTime);

        // Extract the days and hours from the difference
        $daysLeft        = $diff->days;
        $hoursLeft       = $diff->h;

        // Return the result as an array
        return ['days' => $daysLeft, 'hours' => $hoursLeft];
    }
}

if (! function_exists('authOrganizationSlug')) {
    function authOrganizationSlug()
    {
        if (Auth::check() && Auth::user()->role_id == 5) {
            return Auth::user()->organizationStaff->organization->slug;
        }

        return '';
    }
}

if (! function_exists('authOrganizationId')) {
    function authOrganizationId()
    {
        if (Auth::check() && Auth::user()->role_id == 5) {
            return Auth::user()->organizationStaff->organization_id;
        }

        if (Auth::check() && Auth::user()->role_id == 2) {
            return Auth::user()->instructor->organization_id;
        }

        throw new \Exception('Organization not found', 422);
    }
}

if (! function_exists('stringMasking')) {
    function stringMasking($string, $pattern, $start_range = null, $end_range = null)
    {
        if (! $start_range) {
            $start_range = 0;
        }

        return config('app.demo_mode') ? Str::mask($string, $pattern, $start_range, $end_range) : $string;
    }
}
if (! function_exists('authUser')) {
    function authUser()
    {
        return auth()->check() ? auth()->user() : jwtUser();
    }
}
if (! function_exists('userCurrency')) {
    function userCurrency()
    {
        $currency_id = setting('default_currency');
        if (auth()->check()) {
            $currency_id = auth()->user()->currency_code;
        } elseif (session()->has('currency_code')) {
            $currency_id = session()->get('currency_code');
        }

        return $currency_id;
    }
}
if (! function_exists('userLanguage')) {
    function userLanguage()
    {
        $locale = setting('default_language');
        if (auth()->check()) {
            $locale = auth()->user()->lang;
        } elseif (session()->has('currency')) {
            $locale = session()->get('lang');
        }

        return $locale;
    }
}
if (! function_exists('getVideoId')) {
    function getVideoId($provider, $link)
    {
        if ($provider == 'vimeo') {
            if (preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/?(showcase\/)*([0-9))([a-z]*\/)*([0-9]{6,11})[?]?.*/", $link, $output_array)) {
                return $output_array[6];
            }
        } elseif ($provider == 'youtube') {
            $id = [];
            preg_match("#([\/|\?|&]vi?[\/|=]|youtu\.be\/|embed\/)([a-zA-Z0-9_-]+)#", $link, $id);

            return end($id);
        } elseif ($provider == 'upload') {
            return static_asset($link);
        } elseif ($provider == 'mp4') {
            return $link;
        }

        return '';
    }
}
