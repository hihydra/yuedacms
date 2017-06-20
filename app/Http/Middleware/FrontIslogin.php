<?php

namespace App\Http\Middleware;

use Closure;

class FrontIslogin
{
    public function handle($request, Closure $next)
    {
       if(!$request->cookie('API_SESSIONID')){
       		if($request->ajax()){
       			return response()->json(array('loginUrl' => url('/login'),'result' => 2));
       		}else{
       			return redirect('login');
            }
        }

        return $next($request);
    }
}
