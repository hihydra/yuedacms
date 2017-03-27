<?php

namespace App\Http\Middleware;

use Closure;

class FrontIslogin
{
    public function handle($request, Closure $next)
    {
       if(!$request->cookie('API_SESSIONID')){
            return redirect('login');
        }
        return $next($request);
    }
}
