<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AuthenticateTpo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(!Auth::guard('tpo')->check()){
            return redirect(env('tpo').'/login')->with('error','Please login for access this page');
        }
        
        return $next($request);
    }
}