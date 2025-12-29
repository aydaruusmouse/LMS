<?php

namespace App\Providers;

use App\Models\Addon;
use App\Models\Currency;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Schema::defaultStringLength(191);

        $this->app->singleton('settings', function () {
            return Cache::rememberForever('settings', function () {
                return Schema::hasTable('settings') ? Setting::all() : collect();
            });
        });
        $this->app->singleton('languages', function () {
            return Cache::rememberForever('languages', function () {
                return Schema::hasTable('languages') ? Language::where('status', 1)->get() : collect();
            });
        });
        $this->app->singleton('currencies', function () {
            return Cache::rememberForever('currencies', function () {
                return Schema::hasTable('currencies') ? Currency::where('status', 1)->get() : collect();
            });
        });
        $this->app->singleton('addons', function () {
            return Cache::rememberForever('addons', function () {
                return Schema::hasTable('addons') ? Addon::where('status', 1)->get() : collect();
            });
        });

        if (setting('https')) {
            URL::forceScheme('https');
        }
    }
}
