<?php

namespace App\Http\Controllers\Api;
use App\Models\Organization;
use App\Models\Company;
use App\Models\User;
use App\Models\Affiliate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Auth;

class OrganizationController extends Controller
{
    //
    public function index(){
        return Company::take(2)->get();
    }


    public function login(Request $request)
    {
        $username = request()->route('username_');
        $password = request()->route('password_');
        $credentials = ['username' => $username,'password' => $password, 'is_active' => 1, 'is_registered' => 1];
        // attempt to do the login
        if (Auth::attempt($credentials))
        {
            return "authenticated";
        }
        return "Invalid Authentication";
    }


    public function call(Request $request)
    {
        $rc = request()->route('rc_number_');
        $call_type = (int)request()->route('calltype_');
        $class = (int)request()->route('class_');
        $type = null;
        $role = "";
        $username = request()->route('username_');
        
        // There are total of 4 different calls to be made: 
        //1 - basic company details, 
        //2 - basic company details with directors, 
        //3 - basic company details with shareholders, and 
        //4 - basic company details with secretary

        //1 - basic company details
        if($call_type == 1){
            $company = Company::where(['rc_number' => $rc, 'classification_fk' => $class])->pluck('rc_number')->first();
            $unit = User::where(['username' => $username])->pluck('units')->first();
            $account = User::where(['username' => $username])->first();
            if(is_null($company))
            {
                return "No Company record exists in CAC's Database for the search term 'RC: " . $rc . ", Classification: " . $class . "'";
            }
            $reply["Company_Details"] = Company::select('approved_name as Company_Name','rc_number','company.address', 
            'company.city', 'company.state', 
            'Classification.Description as company_type')
            ->Join('classification', function($join) use ($rc, $class){
                $join->on('company.classification_fk', '=', 'classification.id')
                ->where(['company.rc_number' => $rc])
                ->where('company.classification_fk', '=', $class);
            })
            ->get();   
            //Deduct Unit and update DB
            $unit -= 1000;
            $account->units = $unit;
            $account->save();
            return $reply;
        }

        //2 - basic company details with directors
        if($call_type == 2){
            $company = Company::where(['rc_number' => $rc, 'classification_fk' => $class])->pluck('rc_number')->first();
            $unit = User::where(['username' => $username])->pluck('units')->first();
            $account = User::where(['username' => $username])->first();
            if(is_null($company))
            {
                return "No Company record exists in CAC's Database for the search term 'RC: " . $rc . ", Classification: " . $class . "'";
            }
            if($class == 1)
            {
                //Business Names
                $type = [6122, 6121];
                $role = "Proprietors";
                $reply["Company_Details"] = Company::select('approved_name as company_name',
                'rc_number',
                'company.address', 
                'company.city', 
                'company.state', 'Classification.Description as company_type')
                ->Join('classification', function($join) use ($rc, $class){
                    $join->on('company.classification_fk', '=', 'classification.id')
                    ->where(['company.rc_number' => $rc])
                    ->where('company.classification_fk', '=', $class);
                })
                ->get();
                
                $reply[$role] = Affiliate::select('affiliates.surname', 
                'affiliates.firstname', 'affiliates.other_name',
                'affiliate_type.name as description', 'affiliates.corporation_name as corporate_proprietor_(if_any)')
                ->Join('company', function($join) use ($rc, $class, $type){
                    $join->on('affiliates.company_fk', '=', 'company.id')
                    ->where(['company.rc_number' => $rc])
                    ->Wherein('affiliate_type_fk', $type)
                    ->where('company.classification_fk', '=', $class);
                })
                ->Join('affiliate_type', function($join) use ($type){
                    $join->on('affiliates.affiliate_type_fk', '=', 'affiliate_type.id')
                    ->Wherein('affiliate_type_fk', $type);
                })
                ->get();   

                //Deduct Unit and update DB
                $unit -= 1000;
                $account->units = $unit;
                $account->save();     
                return $reply;
            }
            if($class == 2)
            {
                //Limited Liability Company
                $type = 6986;
                $role = "Directors";
                $reply["Company_Details"] = Company::select('approved_name as company_name',
                'rc_number',
                'company.address', 
                'company.city', 
                'company.state', 'Classification.Description as company_type')
                ->Join('classification', function($join) use ($rc, $class){
                    $join->on('company.classification_fk', '=', 'classification.id')
                    ->where(['company.rc_number' => $rc])
                    ->where('company.classification_fk', '=', $class);
                })
                ->get();
                
                $reply[$role] = Affiliate::select('affiliates.surname', 
                'affiliates.firstname', 'affiliates.other_name',
                'affiliate_type.name as Description')
                ->Join('company', function($join) use ($rc, $class, $type){
                    $join->on('affiliates.company_fk', '=', 'company.id')
                    ->where(['company.rc_number' => $rc])
                    ->Where('affiliate_type_fk', '=', $type)
                    ->where('company.classification_fk', '=', $class);
                })
                ->Join('affiliate_type', function($join) use ($type){
                    $join->on('affiliates.affiliate_type_fk', '=', 'affiliate_type.id')
                    ->Where('affiliate_type_fk', '=', $type);
                })
                ->get();     

                //Deduct Unit and update DB
                $unit -= 1000;
                $account->units = $unit;
                $account->save();   
                return $reply;
            }
            if($class == 3)
            {
                //Incorporated Trustees
                $type = 7517;
                $role = "Trustees";
                $reply["Company_Details"] = Company::select('approved_name as company_name',
                'rc_number',
                'company.address', 
                'company.city', 
                'company.state', 'Classification.Description as company_type')
                ->Join('classification', function($join) use ($rc, $class){
                    $join->on('company.classification_fk', '=', 'classification.id')
                    ->where(['company.rc_number' => $rc])
                    ->where('company.classification_fk', '=', $class);
                })
                ->get();
                
                $reply[$role] = Affiliate::select('affiliates.surname', 
                'affiliates.firstname', 'affiliates.other_name',
                'affiliate_type.name as description')
                ->Join('company', function($join) use ($rc, $class, $type){
                    $join->on('affiliates.company_fk', '=', 'company.id')
                    ->where(['company.rc_number' => $rc])
                    ->Where('affiliate_type_fk','=', $type)
                    ->where('company.classification_fk', '=', $class);
                })
                ->Join('affiliate_type', function($join) use ($type){
                    $join->on('affiliates.affiliate_type_fk', '=', 'affiliate_type.id')
                    ->Where('affiliate_type_fk', '=', $type);
                })
                ->get(); 

                //Deduct Unit and update DB
                $unit -= 1000;
                $account->units = $unit;
                $account->save();    
                return $reply;
            }
        }

        //3 - basic company details with shareholders
        if($call_type == 3){
            $company = Company::where(['rc_number' => $rc, 'classification_fk' => $class])->pluck('rc_number')->first();
            $unit = User::where(['username' => $username])->pluck('units')->first();
            $account = User::where(['username' => $username])->first();
            if(is_null($company))
            {
                //Deduct Unit and update DB
                $unit -= 1000;
                $account->units = $unit;
                $account->save();    
                return "No Company record exists in CAC's Database for the search term 'RC: " . $rc . ", Classification: " . $class . "'";
            }
            if($class == 1 || $class == 3)
            {
                //Business Names

                //Deduct Unit and update DB
                $unit -= 1000;
                $account->units = $unit;
                $account->save(); 
                return "API call type 3 (Shareholders) doesn't apply for Business Names(1), or Incorporated Trustees(3) entities.";
            }
            if($class == 2)
            {
                //Limited Liability Company
                $type = [7516, 7531, 7532, 7533];
                //7516 - Shareholder
                //7531 - Shareholder Corporate Entity
                //7532 - Shareholder Foreign Organisation
                //7533 - Shareholder Government Organization
                
                $reply["Company_Details"] = Company::select('approved_name as Company_Name',
                'rc_number',
                'company.address', 
                'company.city', 
                'company.state', 'Classification.Description as company_type')
                ->Join('classification', function($join) use ($rc, $class){
                    $join->on('company.classification_fk', '=', 'classification.id')
                    ->where(['company.rc_number' => $rc])
                    ->where('company.classification_fk', '=', $class);
                })
                ->get();

                $reply["Share_Holders"] = Affiliate::select('affiliates.surname', 'affiliates.firstname', 'affiliates.other_name',
                'affiliate_type.name as description', 'affiliates.num_shares_alloted as shares_allotment', 
                'affiliates.type_of_shares')
                ->Join('company', function($join) use ($rc, $class, $type){
                    $join->on('affiliates.company_fk', '=', 'company.id')
                    ->Where(['company.rc_number' => $rc])
                    ->Wherein('affiliate_type_fk', $type)
                    ->Where('company.classification_fk', '=', $class);
                })
                ->Join('affiliate_type', function($join) use ($type){
                    $join->on('affiliates.affiliate_type_fk', '=', 'affiliate_type.id')
                    ->Wherein('affiliate_type_fk', $type);
                })
                ->get();   

                //Deduct Unit and update DB
                $unit -= 1000;
                $account->units = $unit;
                $account->save();     
                return $reply;
            }
        }

        //4 - basic company details with secretary
        if($call_type == 4){
            $company = Company::where(['rc_number' => $rc, 'classification_fk' => $class])->pluck('rc_number')->first();
            $unit = User::where(['username' => $username])->pluck('units')->first();
            $account = User::where(['username' => $username])->first();
            if(is_null($company))
            {
                //Deduct Unit and update DB
                $unit -= 1000;
                $account->units = $unit;
                $account->save(); 
                return "No Company record exists in CAC's Database for the search term 'RC: " . $rc . ", Classification: " . $class . "'";
            }
            if($class == 1) //Business Names
            {
                //Deduct Unit and update DB
                $unit -= 1000;
                $account->units = $unit;
                $account->save(); 
                return "API call type 4 (Shareholders) doesn't apply for Business Names(1) entities.";
            }
            if($class == 2 || $class == 3) //Limited Liability Company
            {
                $type = [7518, 7515];
                
                $reply["Company_Details"] = Company::select('approved_name as Company_Name',
                'rc_number',
                'company.address', 
                'company.city', 
                'company.state', 'Classification.Description as company_type')
                ->Join('classification', function($join) use ($rc, $class){
                    $join->on('company.classification_fk', '=', 'classification.id')
                    ->where(['company.rc_number' => $rc])
                    ->where('company.classification_fk', '=', $class);
                })
                ->get();

                $reply["Secretary"] = Affiliate::select('affiliates.surname', 'affiliates.firstname', 'affiliates.other_name',
                'affiliate_type.name as description')
                ->Join('company', function($join) use ($rc, $class, $type){
                    $join->on('affiliates.company_fk', '=', 'company.id')
                    ->Where(['company.rc_number' => $rc])
                    ->Wherein('affiliate_type_fk', $type)
                    ->Where('company.classification_fk', '=', $class);
                })
                ->Join('affiliate_type', function($join) use ($type){
                    $join->on('affiliates.affiliate_type_fk', '=', 'affiliate_type.id')
                    ->Wherein('affiliate_type_fk', $type);
                })
                ->get(); 

                //Deduct Unit and update DB
                $unit -= 1000;
                $account->units = $unit;
                $account->save();       
                return $reply;
            }
        }
    }

    public function GenerateTransactionId(){
        $id = substr(bin2hex(random_bytes(20)), 0, 20);//Generate Control Hash
        return strtoupper($id);
    }
}
