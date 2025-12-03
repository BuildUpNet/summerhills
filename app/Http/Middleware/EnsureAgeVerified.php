<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EnsureAgeVerified
{
   public function handle(Request $request, Closure $next): mixed
    {
        if ($request->routeIs('age.verify') || $request->routeIs('age.blocked')) {
            return $next($request);
        }

        if (session('age_verified') || $request->cookie('age_verified') === '1') {
            return $next($request);
        }

        // User hasn't verified yet — let frontend handle popup
        return $next($request);
    }
}
