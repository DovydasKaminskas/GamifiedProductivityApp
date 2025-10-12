<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class setUserTimezone
{
    public function handle($request, Closure $next)
    {
//        dd("sdfsdf");
        if (auth()->check() && auth()->user()->timezone) {
            // Set the timezone globally for Carbon
            Carbon::setTimezone(auth()->user()->timezone);
        }
        return $next($request);
    }
}
