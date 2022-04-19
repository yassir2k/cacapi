<?php

namespace App\Http\Controllers\Api;
use App\Models\Organization;
use App\Models\Company;
use App\Models\User;
use App\Models\Transactions;
use App\Models\Affiliate;
use App\Models\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\crypt;
use App\Mail\NewRegistrationMail;
use App\Mail\PasswordRecoveryMail;
use \Auth, Mail;

class OrganizationController extends Controller
{
    //
    public function index(){
        return Company::take(2)->get();
    }

    /*---------------------------------------- 
    Function to fetch Client's IP Address
    ----------------------------------------*/
    public function getIPAddress() {  
		//whether ip is from the share internet  
		 if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
					$ip = $_SERVER['HTTP_CLIENT_IP'];  
			}  
		//whether ip is from the proxy  
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
		 }  
	//whether ip is from the remote address  
		else{  
				 $ip = $_SERVER['REMOTE_ADDR'];  
		 }  
		 return $ip;  
	}


    /*---------------------------------------- 
    Login Function
    ----------------------------------------*/
    public function Login(Request $request){
        // create our user data for the authentication
        $email   = $request->input('email');
        $password  = $request->input('password');
        $credentials = ['email' => $email, 'password' => $password, 'is_active' => 1, 'is_registered' => 1];
        // attempt to do the login
        if (Auth::attempt($credentials))
        {
            // validation successful!
            $details = User::Where(['email' => $email])->first();
            $success['status'] = "success";
            $success['email'] = $email;
            $success['username'] = $details->username;
            $success['organization'] = $details->organization_name;
            $success['address'] = $details->address;
            $success['phone'] = $details->contact_phone;
            $success['role'] = $details->role;
            $success['token'] =  substr(bin2hex(random_bytes(100)), 0, 100);
            return $success;
        } 
        else {        
            // validation not successful, send back to form 
            return "Unsuccessful";
        }
    }


    /*---------------------------------------- 
    Post Transaction Data to DB
    ----------------------------------------*/
    public function PostTransaction(Request $request){
        $return = "";
        $username = $request->input('username');
        $email = $request->input('email');
        $amount = $request->input('amount');
        $description = $request->input('description');
        $r_message = $request->input('message');
        $r_processor_id = $request->input('processorId');
        $rrr = $request->input('rrr');
        $r_status = $request->input('status');
        $r_transaction_id = $request->input('transactionId');
        $r_payment_date = $request->input('transaction_datetime');
        $r_order_id = $request->input('orderId');
        $data = ['username' => $username, 
            'email' => $email,
            'amount' => $amount,
            'rrr' => $rrr,
            'description' => $description,
            'r_message' => $r_message, 
            'r_order_id' => $r_order_id,
            'r_payment_date' => date('Y-m-d H:i:s', strtotime($r_payment_date)),
            'r_status' => $r_status,
            'r_processor_id' => $r_processor_id,
            'r_transaction_id' => $r_transaction_id
        ];
        Transactions::create($data);
        $check = Transactions::where(['rrr' => $rrr])->first();
        if($check != null)//it means data has been successfully saved
        {
            //Now get the unit from DB, update and save
            $details = User::select('units')
            ->where(['username' => $username])->first();
            $details->units += $amount;

            $account = User::where(['username' => $username])->first();
            $account->units = $details->units;
            $account->save();
            $return = "saved";
        }
        else{ //something happened as data isnt available on bd (not saved)
            $return = "not saved";
        }
        return $return;
    }



    /*---------------------------------------- 
    Main API Function Call 
    ----------------------------------------*/
    public function call(Request $request)
    {
        $rc = request()->route('rc_number_');
        $call_type = (int)request()->route('calltype_'); //Basic, Directors, Shareholders, or Secretary
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


            /*--------------------------------------------------------------
                Deduct Unit and update DB
            --------------------------------------------------------------*/
            $unit -= 1000;
            $account->units = $unit;
            $account->save();

            /*--------------------------------------------------------------
                Saving IP, Broswer, OS and other sundry details to DB
            --------------------------------------------------------------*/
            $info = get_browser(null, true);
            $browser = $info['browser'];
            $user_OS = $info['platform'];
            $device = $info['device_type'];
            $ip = $this->getIPAddress();
            $transactionId = strtoupper(substr(bin2hex(random_bytes(12)), 0, 12));
            $details = $rc." (".$class.") - Basic Company Information Search";
            $dateTime = date("Y-m-d H:i:s");
            $responseCode = "Ok";
            $cost = 1000;
            $data = ['transaction_id' => $transactionId, 
                'details' => $details,
                'api_call_datetime' => $dateTime,
                'ip_address' => $ip,
                'device' => $device,
                'browser' => $browser, 
                'operating_system' => $user_OS,
                'call_type' => $call_type,
                'api_call_cost' => $cost,
                'response_code' => $responseCode,
                'username' => $username
            ];
            Log::create($data);
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
                
                
                /*--------------------------------------------------------------
                Saving IP, Broswer, OS and other sundry details to DB
                --------------------------------------------------------------*/
                $info = get_browser(null, true);
                $browser = $info['browser'];
                $user_OS = $info['platform'];
                $device = $info['device_type'];
                $ip = $this->getIPAddress();
                $transactionId = strtoupper(substr(bin2hex(random_bytes(12)), 0, 12));
                $details = $rc." (".$class.") - Basic Company Information Search with Proprietors.";
                $dateTime = date("Y-m-d H:i:s");
                $responseCode = "Ok";
                $cost = 1000;
                $data = ['transaction_id' => $transactionId, 
                    'details' => $details,
                    'api_call_datetime' => $dateTime,
                    'ip_address' => $ip,
                    'device' => $device,
                    'browser' => $browser, 
                    'operating_system' => $user_OS,
                    'call_type' => $call_type,
                    'api_call_cost' => $cost,
                    'response_code' => $responseCode,
                    'username' => $username
                ];
                Log::create($data);
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
                
                /*--------------------------------------------------------------
                Saving IP, Broswer, OS and other sundry details to DB
                --------------------------------------------------------------*/
                $info = get_browser(null, true);
                $browser = $info['browser'];
                $user_OS = $info['platform'];
                $device = $info['device_type'];
                $ip = $this->getIPAddress();
                $transactionId = strtoupper(substr(bin2hex(random_bytes(12)), 0, 12));
                $details = $rc." (".$class.") - Basic Company Information Search with Directors";
                $dateTime = date("Y-m-d H:i:s");
                $responseCode = "Ok";
                $cost = 1000;
                $data = ['transaction_id' => $transactionId, 
                    'details' => $details,
                    'api_call_datetime' => $dateTime,
                    'ip_address' => $ip,
                    'device' => $device,
                    'browser' => $browser, 
                    'operating_system' => $user_OS,
                    'call_type' => $call_type,
                    'api_call_cost' => $cost,
                    'response_code' => $responseCode,
                    'username' => $username
                ];
                Log::create($data);
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

                /*--------------------------------------------------------------
                Saving IP, Broswer, OS and other sundry details to DB
                --------------------------------------------------------------*/
                $info = get_browser(null, true);
                $browser = $info['browser'];
                $user_OS = $info['platform'];
                $device = $info['device_type'];
                $ip = $this->getIPAddress();
                $transactionId = strtoupper(substr(bin2hex(random_bytes(12)), 0, 12));
                $details = $rc." (".$class.") - Basic Company Information Search with Trustees";
                $dateTime = date("Y-m-d H:i:s");
                $responseCode = "Ok";
                $cost = 1000;
                $data = ['transaction_id' => $transactionId, 
                    'details' => $details,
                    'api_call_datetime' => $dateTime,
                    'ip_address' => $ip,
                    'device' => $device,
                    'browser' => $browser, 
                    'operating_system' => $user_OS,
                    'call_type' => $call_type,
                    'api_call_cost' => $cost,
                    'response_code' => $responseCode,
                    'username' => $username
                ];
                Log::create($data);
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

                /*--------------------------------------------------------------
                Saving IP, Broswer, OS and other sundry details to DB
                --------------------------------------------------------------*/
                $info = get_browser(null, true);
                $browser = $info['browser'];
                $user_OS = $info['platform'];
                $device = $info['device_type'];
                $ip = $this->getIPAddress();
                $transactionId = strtoupper(substr(bin2hex(random_bytes(12)), 0, 12));
                $details = $rc." (".$class.") - Basic Company Information Search with Shareholders";
                $dateTime = date("Y-m-d H:i:s");
                $responseCode = "Not Found";
                $cost = 1000;
                $data = ['transaction_id' => $transactionId, 
                    'details' => $details,
                    'api_call_datetime' => $dateTime,
                    'ip_address' => $ip,
                    'device' => $device,
                    'browser' => $browser, 
                    'operating_system' => $user_OS,
                    'call_type' => $call_type,
                    'api_call_cost' => $cost,
                    'response_code' => $responseCode,
                    'username' => $username
                ];
                Log::create($data);
                return "No Company record exists in CAC's Database for the search term 'RC: " . $rc . ", Classification: " . $class . "'";
            }
            if($class == 1 || $class == 3)
            {
                //Business Names

                //Deduct Unit and update DB
                $unit -= 1000;
                $account->units = $unit;
                $account->save(); 

                /*--------------------------------------------------------------
                Saving IP, Broswer, OS and other sundry details to DB
                --------------------------------------------------------------*/
                $info = get_browser(null, true);
                $browser = $info['browser'];
                $user_OS = $info['platform'];
                $device = $info['device_type'];
                $ip = $this->getIPAddress();
                $transactionId = strtoupper(substr(bin2hex(random_bytes(12)), 0, 12));
                $details = $rc." (".$class.") - Basic Company Information Search with Shareholders";
                $dateTime = date("Y-m-d H:i:s");
                $responseCode = "API Call for Shareholders not applicable for BN or IT";
                $cost = 1000;
                $data = ['transaction_id' => $transactionId, 
                    'details' => $details,
                    'api_call_datetime' => $dateTime,
                    'ip_address' => $ip,
                    'device' => $device,
                    'browser' => $browser, 
                    'operating_system' => $user_OS,
                    'call_type' => $call_type,
                    'api_call_cost' => $cost,
                    'response_code' => $responseCode,
                    'username' => $username
                ];
                Log::create($data);
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
                
                /*--------------------------------------------------------------
                Saving IP, Broswer, OS and other sundry details to DB
                --------------------------------------------------------------*/
                $info = get_browser(null, true);
                $browser = $info['browser'];
                $user_OS = $info['platform'];
                $device = $info['device_type'];
                $ip = $this->getIPAddress();
                $transactionId = strtoupper(substr(bin2hex(random_bytes(12)), 0, 12));
                $details = $rc." (".$class.") - Basic Company Information Search with Shareholders";
                $dateTime = date("Y-m-d H:i:s");
                $responseCode = "Ok";
                $cost = 1000;
                $data = ['transaction_id' => $transactionId, 
                    'details' => $details,
                    'api_call_datetime' => $dateTime,
                    'ip_address' => $ip,
                    'device' => $device,
                    'browser' => $browser, 
                    'operating_system' => $user_OS,
                    'call_type' => $call_type,
                    'api_call_cost' => $cost,
                    'response_code' => $responseCode,
                    'username' => $username
                ];
                Log::create($data);
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

                /*--------------------------------------------------------------
                Saving IP, Broswer, OS and other sundry details to DB
                --------------------------------------------------------------*/
                $info = get_browser(null, true);
                $browser = $info['browser'];
                $user_OS = $info['platform'];
                $device = $info['device_type'];
                $ip = $this->getIPAddress();
                $transactionId = strtoupper(substr(bin2hex(random_bytes(12)), 0, 12));
                $details = $rc." (".$class.") - Basic Company Information Search with Secretary";
                $dateTime = date("Y-m-d H:i:s");
                $responseCode = "Not Found";
                $cost = 1000;
                $data = ['transaction_id' => $transactionId, 
                    'details' => $details,
                    'api_call_datetime' => $dateTime,
                    'ip_address' => $ip,
                    'device' => $device,
                    'browser' => $browser, 
                    'operating_system' => $user_OS,
                    'call_type' => $call_type,
                    'api_call_cost' => $cost,
                    'response_code' => $responseCode,
                    'username' => $username
                ];
                Log::create($data);
                return "No Company record exists in CAC's Database for the search term 'RC: " . $rc . ", Classification: " . $class . "'";
            }
            if($class == 1) //Business Names
            {
                //Deduct Unit and update DB
                $unit -= 1000;
                $account->units = $unit;
                $account->save(); 

                /*--------------------------------------------------------------
                Saving IP, Broswer, OS and other sundry details to DB
                --------------------------------------------------------------*/
                $info = get_browser(null, true);
                $browser = $info['browser'];
                $user_OS = $info['platform'];
                $device = $info['device_type'];
                $ip = $this->getIPAddress();
                $transactionId = strtoupper(substr(bin2hex(random_bytes(12)), 0, 12));
                $details = $rc." (".$class.") - Basic Company Information Search with Secretary";
                $dateTime = date("Y-m-d H:i:s");
                $responseCode = "API call (for Secretary) not applicable for Business Names.";
                $cost = 1000;
                $data = ['transaction_id' => $transactionId, 
                    'details' => $details,
                    'api_call_datetime' => $dateTime,
                    'ip_address' => $ip,
                    'device' => $device,
                    'browser' => $browser, 
                    'operating_system' => $user_OS,
                    'call_type' => $call_type,
                    'api_call_cost' => $cost,
                    'response_code' => $responseCode,
                    'username' => $username
                ];
                Log::create($data);
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
                
                /*--------------------------------------------------------------
                Saving IP, Broswer, OS and other sundry details to DB
                --------------------------------------------------------------*/
                $info = get_browser(null, true);
                $browser = $info['browser'];
                $user_OS = $info['platform'];
                $device = $info['device_type'];
                $ip = $this->getIPAddress();
                $transactionId = strtoupper(substr(bin2hex(random_bytes(12)), 0, 12));
                $details = $rc." (".$class.") - Basic Company Information Search with Secretary";
                $dateTime = date("Y-m-d H:i:s");
                $responseCode = "Ok";
                $cost = 1000;
                $data = ['transaction_id' => $transactionId, 
                    'details' => $details,
                    'api_call_datetime' => $dateTime,
                    'ip_address' => $ip,
                    'device' => $device,
                    'browser' => $browser, 
                    'operating_system' => $user_OS,
                    'call_type' => $call_type,
                    'api_call_cost' => $cost,
                    'response_code' => $responseCode,
                    'username' => $username
                ];
                Log::create($data);
                return $reply;
            }
        }
    }
    /*--------------------------------------------------------------
        End of Main API Call
    --------------------------------------------------------------*/

    public function GenerateTransactionId(){
        $id = substr(bin2hex(random_bytes(20)), 0, 20);//Generate Control Hash
        return strtoupper($id);
    }

    /*public function process_transaction(Request $request){
        $MDA_Units = User::where(['username' => 'firs'])->pluck('units')->first();
        $MDA_Units += (int)$request->input('units');
        $account = User::where(['username' => 'firs'])->first();
        $account->units = $MDA_Units;
        $account->save(); 
    }*/


    public function GetTransactionHistory(Request $request){
        $userId  = $request->input('username');
        $temp = Transactions::select('*', \DB::raw("DATE_FORMAT(r_payment_date, '%W, %M %e %Y %r') as datetime"))
        ->Where(['username' => $userId])->paginate(10);
        return response()->json($temp);
    }


    public function GetAPICallLog(Request $request){
        $userId  = $request->input('username');
        $temp = Log::select('*', \DB::raw("DATE_FORMAT(api_call_datetime, '%W, %M %e %Y %r') as datetime"))
        ->Where(['username' => $userId])->paginate(10);
        return response()->json($temp);
    }


    public function GetTransactionDetails(Request $request){
        $rrr  = $request->input('rrr');
        if($rrr == null){
            return "Empty";
        }

        $temp = Transactions::select('*', \DB::raw("DATE_FORMAT(r_payment_date, '%W, %M %e %Y %r') as datetime"))
        ->Where(['rrr' => $rrr])->get();
        return response()->json($temp);
    }

    /*---------------------------------------- 
    This section handles dashboard statistics
    ----------------------------------------*/
    public function GetTotalAPICallsToday(Request $request){
        $username = $request->input('username');
        $temp = Log::select('id')
        ->where(\DB::raw("DATE_FORMAT(api_call_datetime, '%Y-%m-%d')"), '=', date('Y-m-d'))
        ->where(['username' => $username])->get();
        $total_today = count($temp);
        return $total_today;
    }

    public function GetTotalUnitsExpendedToday(Request $request){
        $username = $request->input('username');
        $temp = Log::select('api_call_cost')
        ->where(\DB::raw("DATE_FORMAT(api_call_datetime, '%Y-%m-%d')"), '=', date('Y-m-d'))
        ->where(['username' => $username])->sum('api_call_cost');
        return $temp;
    }

    public function GetTotalUnitsPurchasedToday(Request $request){
        $username = $request->input('username');
        $temp = Transactions::select('amount')
        ->where(\DB::raw("DATE_FORMAT(r_payment_date, '%Y-%m-%d')"), '=', date('Y-m-d'))
        ->where(['username' => $username])->sum('amount');
        return $temp;
    }

    public function GetTotalCummulativeAPICalls(Request $request){
        $username = $request->input('username');
        $temp = Log::select('id')
        ->where(['username' => $username])->get();
        $total_today = count($temp);
        return $total_today;
    }

    public function GetTotalCummulativeUnitsExpended(Request $request){
        $username = $request->input('username');
        $temp = Log::select('api_call_cost')
        ->where(['username' => $username])->sum('api_call_cost');
        return $temp;
    }

    public function GetTotalCummulativeUnitsPurchased(Request $request){
        $username = $request->input('username');
        $temp = Transactions::select('amount')
        ->where(['username' => $username])->sum('amount');
        return $temp;
    }

    /*---------------------------------------- 
    Get Realtime Units
    ----------------------------------------*/
    public function GetRealtimeUnits(Request $request){
        $username = $request->input('username');
        $temp = User::select('units')
        ->where(['username' => $username])->first();
        return $temp;
    }


    /*---------------------------------------- 
    Load More Log Details
    ----------------------------------------*/
    public function LoadMoreDetails(Request $request)
    {
        $id = request()->route('transaction_id');
        if(is_null($id))
        {
            return "Not Found";
        }
        $Feedback = Log::where(['transaction_id'=> $id])->first();
        return view('/clients/load-more-details')
        ->with('_feedback',$Feedback);
    }

    /*---------------------------------------- 
    Fetch User Details
    ----------------------------------------*/
    public function FetchUserDetails(Request $request)
    {
        $username = $request->input('username');
        if(is_null($username))
        {
            return "Not Found";
        }
        $Feedback = User::where(['username'=> $username])->first();
        return $Feedback;
    }

    /*---------------------------------------- 
    Update User Details
    ----------------------------------------*/
    public function UpdateUserDetails(Request $request)
    {
        $username = $request->input('username');
        $address = $request->input('address');
        $contactName = $request->input('contactName');
        $contactMobile = $request->input('contactMobile');
        $email = $request->input('email');
        if(is_null($username) || is_null($address) || is_null($contactName) || is_null($contactMobile) || is_null($email))
        {
            return "Incomplete data posted";
        }
        $User = User::where(['username'=> $username])->first();
        $User->address = $address;
        $User->contact_name = $contactName;
        $User->contact_phone = $contactMobile;
        $User->email = $email;
        $User->save();
        return "User data successfully updated";
    }

    /*---------------------------------------- 
        Update User Details
    ----------------------------------------*/
    public function ChangeUserPassword(Request $request)
    {
        $Password = $request->input('password');
        $nPassword = $request->input('new_password');
        $cPassword = $request->input('confirm_password');
        $username = $request->input('username'); 
        if(is_null($Password) || is_null($nPassword) || is_null($cPassword)  || is_null($username))
        {
            return "Incomplete data posted";
        }
        $credentials = ['username' => $username, 'password' => $Password, 'is_active' => 1, 'is_registered' => 1];

        // attempt to do the login
        if (Auth::attempt($credentials))
        {
            //Meaning current password is valid. bcrypt('Qa1234@')
            $User = User::where(['username'=> $username])->first();
            $User->password = bcrypt($nPassword);
            $User->save();
            return "success";

        }
        else
        {
            return "Invalid current password";
        }
    }

    /*---------------------------------------- 
        Update User Details
    ----------------------------------------*/
    public function SignUp(Request $request)
    {
        $Organization = $request->input('Organization');
        $ContactName = $request->input('ContactName');
        $Email = $request->input('Email');
        $PhoneNumber = $request->input('PhoneNumber'); 
        $Address = $request->input('Address');
        $Password = $request->input('Password');
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
            'password' => bcrypt($Password),
            'viewed_by_admin' => 0,
            'is_active' => 0,
            'is_registered' => 0,
            'registered_on' => NULL,
            'registration_hash' => $Token,
            'password_reset_hash' => NULL,
            'password_hash_control' => NULL,
            'units' => 0,
            'role' => "Accessor",
            'billable' => 1,
            'client_type' => "Business"
        ];
        User::create($data);

        //To be sure data is saved, let's query the DB for confirmation.
        $check = User::where(['email'=> $Email])->first();
        if($check != null)
        {
            Mail::to($Email)
            ->send(new NewRegistrationMail($Email, $Organization, $ContactName, $Token));
            return "saved";
        }
        else{
            return "not saved";
        }

    }

    /*---------------------------------------- 
        Verify Registration
    ----------------------------------------*/
    public function ValidateRegistrationToken(Request $request)
    {
        $token = $request->input('token'); 
        $User = User::where(['registration_hash'=> $token, 'is_registered' => 0])->first();
        if(is_null($User))
        {
            return "The token is either invalid, or it has been used already/expired..";
        }
        else
        {
            $User->registered_on = date("Y-m-d H:i:s");
            $User->is_active = 1;
            $User->is_registered = 1;
            $User->save();
            return "Valid";
        }
    }


    /*---------------------------------------- 
        Process Password Recovery
    ----------------------------------------*/
    public function ProcessPasswordRecovery(Request $request)
    {
        $Email = $request->input('email'); 
        $User = User::where(['email'=> $Email])->first();
        $Token = strtoupper(substr(bin2hex(random_bytes(8)), 0, 8));
        $Hash = substr(bin2hex(random_bytes(100)), 0, 100);
        if(is_null($User))
        {
            return "This email is not associated with any account.";
        }
        else
        {
            Mail::to($Email)
            ->send(new PasswordRecoveryMail($Email, $User->organization_name, $User->contact_name, $Token));
            $User->password_reset_hash = $Token;
            $User->password_hash_control = $Hash;
            $User->save();
            $reply["Message"] = "Valid";
            $reply["Hash"] = $Hash;
            return $reply;
        }
    }


    /*---------------------------------------- 
        Validate Password Recovery Token
    ----------------------------------------*/
    public function ValidatePasswordRecoveryToken(Request $request)
    {
        $token = $request->input('passwordRecoveryToken'); 
        $hash = $request->input('passwordRecoveryHash'); 
        if(is_null($token) || is_null($hash))
        {
            return "Invalid or Unauthorized API call.";
        }
        else
        {
            $User = User::where(['password_reset_hash'=> $token, 'password_hash_control' => $hash])->first();
            if(is_null($User))
            {
                return "Invalid token";
            }
            $User->password_reset_hash = NULL;
            $User->save();
            $reply["Message"] = "Success";
            $reply["Hash"] = $hash;
            return $reply;
        }
    }


    /*---------------------------------------- 
        Reset Password
    ----------------------------------------*/
    public function ResetPassword(Request $request)
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
            $User = User::where(['password_hash_control' => $hash])->first();
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
}
