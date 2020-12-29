<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Session;


class UserAuth
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request $request
    * @param  \Closure $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
        // if(!Auth::user()) {
        //     return redirect()->route('login');
        // }

        return $next($request);
    }
}