<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use App\Traits\ApiReturnFormatTrait;
use Closure;
use Illuminate\Http\Request;

class CheckApiKeyMiddleware
{
    use ApiReturnFormatTrait;

    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('apiKey')) {
            $keys = ApiKey::pluck('key')->toArray();
            if (in_array($request->header('apiKey'), $keys)) {
                return $next($request);
            }
        }

        //        return $this->responseWithError(__('API key invalid'), [], 403);
        return $next($request);
    }
}
