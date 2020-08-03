<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AuthenticateTelecaller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(!Auth::guard('telecaller')->check()){
            return redirect(env('telecaller').'/login')->with('error','Please login for access this page');
        }
        
        return $next($request);
    }
}