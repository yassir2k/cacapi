<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Company;
use App\Models\User;
use App\Models\Transactions;
use App\Models\Affiliate;
use App\Models\Log;
use App\Mail\DeactivateAccountMail;
use App\Mail\ActivateAccountMail;
use \Auth, Mail;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function GetUsers(){
        $temp = User::select('*', \DB::raw("DATE_FORMAT(registered_on, '%W, %M %e %Y %r') as datetime"))
        ->Where(['role' => "Accessor"])->paginate(10);
        return response()->json($temp);
    }


    public function ChangeUserStatus(Request $request){
        $username = $request->input('username');
        $value = $request->input('value');
        $temp = User::select('*')
        ->Where(['username' => $username])->first();
        $temp->is_active = $value;
        $temp->save();
        //Send Email
        $time = date("l d F, Y H:i:s ");
        if($value == 0)//deactivate
        {
            Mail::to($temp->email)
            ->send(new DeactivateAccountMail($temp->email, $temp->organization_name, $temp->contact_name, $time));
        }
        else{//activate
            Mail::to($temp->email)
            ->send(new ActivateAccountMail($temp->email, $temp->organization_name, $temp->contact_name, $time));
        }
        return "saved.";
    }
}
