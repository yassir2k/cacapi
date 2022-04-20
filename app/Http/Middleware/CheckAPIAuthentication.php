<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAPIAuthentication
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
        $auth = $request->header('Authorization');
        $username = $request->input('username');
        $key = substr($auth, 4, 13); //SessionId
        $Hash = substr($auth, 23, 128);
        $token = substr($auth, 158, 100);
        $apiHash = $key.$username.$token; //What was used in making Hash from the front end
        //Compare APiHas with Hash
        //dd($apiHash);
        if( strval($Hash) != strval(hash('sha512', $apiHash)) )  {
            return response()->json("Unauthenticated API Call detected.");
        }
        return $next($request);
    }
}
