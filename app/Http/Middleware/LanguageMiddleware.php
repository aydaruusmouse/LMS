<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        /*$locale = null;

        // Check if the user has a language preference cookie
        if ($request->hasCookie('applocale')) {
            $locale = $request->cookie('applocale');
        }

        // If neither cookie nor browser preference nor request is available or supported, use the default locale
        if (!$locale) {
            $locale = Config::get('app.locale');
        }

        // Set the application locale
         App::setLocale($locale);

        // Set the locale cookie
        if (!$request->hasCookie('applocale') || $request->cookie('applocale') !== $locale) {
            Cookie::queue('locale', $locale, 60 * 24 * 365);
        }

        $url = URL::current();
        $baseprefix = str_replace(URL::to('/'), '', $url);

        if(isset(explode('/', $baseprefix)[1])){
            $prefixStatus = true;
            $prefix = explode('/', $baseprefix)[1];

        }else{
            $prefixStatus = false;
            $prefix = setting('default_language');
        }

        $supported_locales =  array_column(array_values(languages()->toArray()), 'locale');

        //For default laguage we will hide the url.
        if(($prefix === $locale) && ($locale === setting('default_language'))){

            $defaultUrl = str_replace('/'.$prefix, '', URL::current());

            if($defaultUrl == URL::current()){

                return $next($request);
            }else{
               return redirect()->to($defaultUrl);
            }

        }elseif($prefix === $locale){
            return $next($request);
        }elseif(in_array($prefix , $supported_locales)){

            //For other locals we will redirect to the correct URL
            if($prefixStatus){
                $newUrl = str_replace('/'.$prefix, '/'.$locale, URL::current());

            }else{
                $newUrl = url($locale . '/');

            }

        // Create a redirect response to the new URL
        return redirect()->to($newUrl);
        }

        //when we change the language we will update the url based on previous url
        if(($prefix == 'language') && ($locale == setting('default_language'))){

            $prefix = str_replace('/language/', '', $baseprefix);
            $url = str_replace(URL::to('/'), URL::to('/').'/'.$prefix, URL::previous());
            $cookie = Cookie::make('applocale', $prefix);

            return redirect()->to($url)->withCookie($cookie);
        }

        $currentLocale =  Cookie::has('applocale') ? Cookie::get('applocale') : Config::get('app.locale');

        //when we have default language change request through backend we will redirect to the updated url
        if(($prefix == 'admin')){

            $prefix = str_replace('/admin/', '', $baseprefix);
            $url = str_replace(URL::to('/'),URL::to('/').'/'.$currentLocale, URL::current());

            if(setting('default_language') == $currentLocale){

                return $next($request);
            }else{
               return redirect()->to($url);
            }
        }

        return $next($request);*/

        //   app()->setLocale(languageCheck());

        $prefix     = '';

        $url        = URL::current();

        $baseprefix = str_replace(URL::to('/'), '', $url);

        if (isset(explode('/', $baseprefix)[1])) {
            $prefix = explode('/', $baseprefix)[1];
            if (setting('default_language') == $prefix) {
                return redirect()->to(str_replace('/'.setting('default_language'), '', $url));
            }
        }

        return $next($request);
    }
}
