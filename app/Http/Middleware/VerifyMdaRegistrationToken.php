<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyMdaRegistrationToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->input('mdatoken');//Gets parameter from Route
        $reg_hash_token = User::where(['registration_hash' => $token])->first();
        if($reg_hash_token == null)
        {
            return response("Invalid, or an expired token");
        }
        return $next($request);
    }
}
