<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckUnitBalance
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
        $calltype = request()->route('calltype_');
        $cost = 0;
        switch($calltype){
            case "1":{
                $cost = 1000;
                break;
            }
            case "2":{
                $cost = 1000;
                break;
            }
            case "3":{
                $cost = 1000;
                break;
            }
            case "4":{
                $cost = 1000;
                break;
            }
        }
        //$units = User::where(['username' => $username])->pluck('units')->first();
        $user = User::where(['username' => $username])->first();
        //Check if call cost is greater than Units on the DB
        if( ($cost > $user->units) && ($user->billable == 1)){
            return response('Insufficient unitsb to make API call.');
        }
        return $next($request);
    }
}
