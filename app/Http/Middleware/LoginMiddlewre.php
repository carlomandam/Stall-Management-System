<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class LoginMiddlewre
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
          if(Auth::check()){
          return redirect()->back();
        }
        return redirect('/login');
    }
}
