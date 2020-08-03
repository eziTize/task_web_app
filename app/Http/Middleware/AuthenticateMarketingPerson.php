<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AuthenticateMarketingPerson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(!Auth::guard('marketing_person')->check()){
            return redirect(env('marketing_person').'/login')->with('error','Please login for access this page');
        }
        
        return $next($request);
    }
}