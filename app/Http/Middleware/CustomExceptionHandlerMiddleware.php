<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;

class CustomExceptionHandlerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //        dd('asd');
        app()->singleton(
            App\Exceptions\Handler::class,
            App\Exceptions\ApiHandler::class
        );
        auth()->shouldUse("supplier");
        return $next($request);
    }
}
