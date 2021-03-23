<?php

namespace Okcomputer\Dolly;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FlushViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (app()->environment() === 'local') {
            // Clear the view-specific cache.
            Cache::tags('views')->flush();

        }
        return $next($request);
    }
}
