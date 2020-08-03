<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AuthenticateBranch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(!Auth::guard('branch')->check()){
            return redirect(env('branch').'/login')->with('error','Please login for access this page');
        }
        
        return $next($request);
    }
}