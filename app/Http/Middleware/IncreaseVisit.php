<?php

namespace App\Http\Middleware;

use App\Jobs\IncreaseStaticVisit;
use App\Models\Visit\Visit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
        $location = explode('.', Route::currentRouteName())[0];

        if (Arr::exists(Visit::$locationMap, $location)) {
            dispatch(new IncreaseStaticVisit($location, $request->ip()));
        }

        return $next($request);
    }
}
