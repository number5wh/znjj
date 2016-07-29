<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{

    public function handle($request, Closure $next)
    {
        if(session('phone') == null){
            return redirect('/');
        }
        return $next($request);
    }
}
