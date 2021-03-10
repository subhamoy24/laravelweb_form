<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectPage
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
       return $next($request)->header('Cache-Control','nocache,no-store,max-age=0,must-revalidate')->header("Pragma",'no-cache')->header('Expires','Sun, 02 jan 1990 00:00:00 GMT');
    }
}
