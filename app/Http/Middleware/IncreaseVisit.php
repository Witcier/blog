<?php

namespace App\Http\Middleware;

use App\Jobs\IncreaseStaticVisit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class IncreaseVisit
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
        $location = Route::currentRouteName();
        $ip = $request->ip();

        dispatch(new IncreaseStaticVisit($location, $ip));

        return $next($request);
    }
}
