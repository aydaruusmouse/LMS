<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->role_id == 1 || auth()->user()->role_id == 4) {
                return $next($request);
            }
        }

        return redirect()->route('login');
    }
}
