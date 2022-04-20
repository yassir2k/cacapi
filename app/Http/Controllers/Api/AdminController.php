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
use App\Mail\NewMdaRegistrationMail;
use \Auth, Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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


    public function SignUpMdaUser(Request $request)
    {
        $Organization = $request->input('Organization');
        $ContactName = $request->input('ContactName');
        $Email = $request->input('Email');
        $PhoneNumber = $request->input('PhoneNumber'); 
        $Address = $request->input('Address');
        $IpAddress = $request->input('IpAddress');
        $Username = $request->input('Username'); 
        $User = User::where(['username'=> $Username])->first();
        if($User != null)
        {
            //Meaning it exists or used before in registration
            return "This username (".$Username.") has already been used.";
        }
        //If username is not unique, let's cross the unique email module
        $email = User::where(['email'=> $Email])->first();
        if($email != null)
        {
            //Meaning it exists or used before in registration
            return "This email (".$Email.") has already been used.";
        }

        $Token = substr(bin2hex(random_bytes(100)), 0, 100);
        //At this stage, we're good to go
        $data = [
            'username' => $Username, 
            'email' => $Email,
            'organization_name' => $Organization,
            'address' => $Address,
            'contact_name' => $ContactName,
            'contact_phone' => $PhoneNumber, 
            'password' => bcrypt("&*()12@"),
            'viewed_by_admin' => 0,
            'is_active' => 0,
            'is_registered' => 0,
            'registered_on' => NULL,
            'registration_hash' => $Token,
            'password_reset_hash' => NULL,
            'password_hash_control' => NULL,
            'units' => 0,
            'role' => "Accessor",
            'billable' => 0,
            'client_type' => "Government",
            'ip_address' => $IpAddress
        ];
        User::create($data);

        //To be sure data is saved, let's query the DB for confirmation.
        $check = User::where(['email'=> $Email])->first();
        if($check != null)
        {
            Mail::to($Email)
            ->send(new NewMdaRegistrationMail($Email, $Organization, $ContactName, $Token));
            return "saved";
        }
        else{
            return "not saved";
        }

    }


    /*---------------------------------------- 
        Verify MDA Registration
    ----------------------------------------*/
    public function ValidateMdaRegistrationToken(Request $request)
    {
        $token = $request->input('token'); 
        $User = User::where(['registration_hash'=> $token, 'is_registered' => 0, 'billable' => 0])->first();
        if(is_null($User))
        {
            return "The token is either invalid, or it has been used already/expired.";
        }
        else
        {
            $User->registered_on = date("Y-m-d H:i:s");
            $User->is_active = 1;
            $User->is_registered = 1;
            $User->save();
            $reply["Message"] = "Valid";
            $reply["Hash"] = $token;
            return $reply;
        }
    }


    /*---------------------------------------- 
        New MDA Password
    ----------------------------------------*/
    public function NewMdaPassword(Request $request)
    {
        $NewPassword = $request->input('newPassword'); 
        $ConfirmPassword = $request->input('confirmPassword'); 
        $hash = $request->input('hash'); 
        if($NewPassword != $ConfirmPassword)
        {
            return "New and cofirm new passwords do not match.";
        }
        else
        {
            $User = User::where(['registration_hash' => $hash])->first();
            if(is_null($User))
            {
                return "Invalid token";
            }
            $User->password = bcrypt($NewPassword);
            $User->password_hash_control = NULL;
            $User->save();
            return "Success";
        }
    }


    /*---------------------------------------- 
        Get Today's Income
    ----------------------------------------*/
    public function GetTodaysIncome(Request $request)
    {
        $temp = Transactions::select('amount')
        ->where(\DB::raw("DATE_FORMAT(r_payment_date, '%Y-%m-%d')"), '=', date('Y-m-d'))
        ->sum('amount');
        return $temp;
    }


    /*---------------------------------------- 
        Get Today's API Calls
    ----------------------------------------*/
    public function GetTodaysAPICalls(Request $request)
    {
        $temp = Log::select('*')
        ->where(\DB::raw("DATE_FORMAT(api_call_datetime, '%Y-%m-%d')"), '=', date('Y-m-d'))
        ->get();
        $count = count($temp);
        return $count;
    }

    /*-------------------------------------------- 
        Get Today's Registered Users (Business)
    --------------------------------------------*/
    public function GetTodaysRegisteredUsersBusiness(Request $request)
    {
        $temp = User::select('*')
        ->where(\DB::raw("DATE_FORMAT(registered_on, '%Y-%m-%d')"), '=', date('Y-m-d'))
        ->where(['client_type' => "Business"])
        ->get();
        $count = count($temp);
        return $count;
    }

    /*-------------------------------------------- 
        Get Today's Registered Users (Business)
    --------------------------------------------*/
    public function GetTodaysRegisteredUsersGovernment(Request $request)
    {
        $temp = User::select('*')
        ->where(\DB::raw("DATE_FORMAT(registered_on, '%Y-%m-%d')"), '=', date('Y-m-d'))
        ->where(['client_type' => "Government"])
        ->get();
        $count = count($temp);
        return $count;
    }

    /******************************************************************************************************************************************************** */

    /*---------------------------------------- 
        Get Cummulative Income
    ----------------------------------------*/
    public function GetCummulativeIncome(Request $request)
    {
        $temp = Transactions::select('amount')
        ->sum('amount');
        return $temp;
    }


    /*---------------------------------------- 
        Get Cummulative API Calls
    ----------------------------------------*/
    public function GetCummulativeAPICalls(Request $request)
    {
        $temp = Log::select('*')
        ->get();
        $count = count($temp);
        return $count;
    }

    /*-------------------------------------------- 
        Get Cummulative Registered Users (Business)
    --------------------------------------------*/
    public function GetCummulativeRegisteredUsersBusiness(Request $request)
    {
        $temp = User::select('*')
        ->where(['client_type' => "Business"])
        ->get();
        $count = count($temp);
        return $count;
    }

    /*-------------------------------------------- 
        Get Cummulative Registered Users (Business)
    --------------------------------------------*/
    public function GetCummulativeRegisteredUsersGovernment(Request $request)
    {
        $temp = User::select('*')
        ->where(['client_type' => "Government"])
        ->get();
        $count = count($temp);
        return $count;
    }
}
