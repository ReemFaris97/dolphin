<?php

namespace App\Http\Middleware;

use Closure;

class DistributorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->check()){
            return redirect()->route('admin.login');
        }
        else{
            if(auth()->user()->is_distributor == 1)
                return $next($request);
        }

        return $next($request);
    }
}
