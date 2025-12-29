<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogoutCheckMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (! auth()->check()) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
