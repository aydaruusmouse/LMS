<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermissionCheckerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->role_id == 1) {
                return $next($request);
            }

            $permissions = collect(auth()->user()->permissions);

            if (substr($request->route()->getName(), -6) == '.store') {
                if ($permissions->contains(str_replace('.store', '.create', $request->route()->getName()))) {
                    return $next($request);
                } else {
                    abort(403);
                }
            }
            if (substr($request->route()->getName(), -7) == '.update') {
                if ($permissions->contains(str_replace('.update', '.edit', $request->route()->getName())) || $permissions->contains(str_replace('.update', '.settings', $request->route()->getName()))) {
                    return $next($request);
                } else {
                    abort(403);
                }
            } else {
                if ($permissions->contains($request->route()->getName())) {
                    return $next($request);
                } else {
                    abort(403);
                }
            }
        }
    }
}
