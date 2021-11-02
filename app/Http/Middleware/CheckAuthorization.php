<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \Auth;

class CheckAuthorization
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
        $username = request()->route('username_');
        $password = request()->route('password_');
        $credentials = ['username' => $username,'password' => $password, 'is_active' => 1, 'is_registered' => 1];
        if (!(Auth::attempt($credentials)))
        {
            return response('User not authorized to access API resource', 401);
        }
        return $next($request);
    }
}
