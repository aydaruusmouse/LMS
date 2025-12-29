<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class NotInstallCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return response()->view('install.index');
        }

        if (Schema::hasTable('settings') && Schema::hasTable('users') && config('app.app_installed')) {
            if (request()->ajax()) {
                return response()->json([
                    'error' => __('Looks like You have already installed this application. If You face any difficulty, please contact to the script author.'),
                ]);
            } else {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
