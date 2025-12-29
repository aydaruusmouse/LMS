<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                if (Auth::user()->role_id == 1 || Auth::user()->role_id == 4) {
                    return redirect(RouteServiceProvider::ADMIN);
                }

                if (Auth::user()->role_id == 3) {
                    return redirect(RouteServiceProvider::STUDENT);
                }

                if (Auth::user()->role_id == 5) {
                    return redirect(RouteServiceProvider::ORGANIZATION);
                }

                if (Auth::user()->role_id == 2) {
                    return redirect(RouteServiceProvider::INSTRUCTOR);
                }

                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
