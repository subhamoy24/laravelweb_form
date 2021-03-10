<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AtgAuth
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
        //error_log("bvdhkv");
        if($request->has('Authentication')){
            error_log("bvdhkv");
            error_log(env('API_KEY'));
           if($request->Authentication==env('API_KEY')){
               return $next($request)-> header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')->header("Pragma",'no-cache')->header('Expires','Sun, 02 jan 1990 00:00:00 GMT');
           }else{
               return response()->json(['status'=>0,'message'=>['entered Authentication is invalid']]);

           }
       }else{
        return response()->json(['status'=>0,'message'=>['there must have an authentication key']]);
       }
    
    }
}
