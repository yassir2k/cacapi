<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class VerifyRegistrationToken
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
        $token = request()->route('token');//Gets parameter from Route
        $reg_hash_token = User::where(['registration_hash' => $token])->first();
        if(!($reg_hash_token))
        {
            return redirect()->intended('/')
            ->with('error','Invalid or expired link.');
        }
        return $next($request);
    }
}
