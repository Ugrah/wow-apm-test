<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Session;

use App\Services\ApiService;


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
        $api_service = new ApiService();

        if((!Session::has('token')) || (!$api_service->checkIfUserIsConnected())) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}