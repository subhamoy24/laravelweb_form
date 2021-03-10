<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
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

        error_log(session()->has('LoggedUser'));
        error_log($request->path());
        //error_log(back());
        //session()->validate();
        if(!session()->has('LoggedUser') && ($request->path()!='dash')){
            return redirect('/');
        }
         if(!session()->has('LoggedUser') && ($request->path()=='dash')){
            return redirect('/');
        }

        if(session()->has('LoggedUser')&&($request->path()=='dash')){
            return $next($request)->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')->header("Pragma",'no-cache')->header('Expires','Sun, 02 jan 1990 00:00:00 GMT');
        }
        return $next($request)->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')->header("Pragma",'no-cache')->header('Expires','Sun, 02 jan 1990 00:00:00 GMT');
    }
}
