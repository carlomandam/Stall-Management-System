<?php

namespace App\Http\Middleware;

use Closure;
<<<<<<< Updated upstream
use Auth; 

=======
use Auth;
>>>>>>> Stashed changes
class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next,$guard = null)

    {



        if(Auth::guard($guard)->check() && Auth::user()->position == 'Staff'){


            return $next($request);
        }
        else
            return redirect()->back();
    }
}
