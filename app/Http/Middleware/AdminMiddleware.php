<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,  $guard = null)
    {



        // if(Auth::guard($guard)->check()){
        //     return $next($request);
        // }
        if(Auth::guard($guard)->check() &&Auth::user()->position == "Admin"){


            return $next($request);
        }
        return redirect()->back();
    }
    
}
