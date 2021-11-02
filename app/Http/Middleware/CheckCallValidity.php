<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCallValidity
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
        $call = (int)request()->route('calltype_');
        if( $call != 1 && $call != 2 && $call != 3 && $call != 4){
                return response('Invalid API call made.');
        }
        return $next($request);
    }
}
