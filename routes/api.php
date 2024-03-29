<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [OrganizationController::class, 'Login'])->middleware('is_API_call_Authentic');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/organizations', [OrganizationController::class, 'index']);
Route::get('/get_transaction_id', [OrganizationController::class, 'GenerateTransactionId']);
Route::post('/transaction_history', [OrganizationController::class, 'GetTransactionHistory']);
Route::post('/get_transaction_details', [OrganizationController::class, 'GetTransactionDetails']);
Route::post('/post_transaction', [OrganizationController::class, 'PostTransaction']);
Route::post('/api_call_log', [OrganizationController::class, 'GetAPICallLog']);


Route::get('/organizations/{username_}/{password_}/{calltype_}/{rc_number_}/{class_}', [OrganizationController::class, 'call'])
->middleware('is_user_authorized','is_unit_enough','is_call_type_valid');
/*
------------------------------------------------------------------------
API Calls Statistics Routes  
------------------------------------------------------------------------
*/
Route::post('/get_total_api_calls_today', [OrganizationController::class, 'GetTotalAPICallsToday'])->middleware('is_API_call_Authentic');
Route::post('/get_total_units_expended_today', [OrganizationController::class, 'GetTotalUnitsExpendedToday']);
Route::post('/get_total_units_purchased_today', [OrganizationController::class, 'GetTotalUnitsPurchasedToday']);

Route::post('/get_total_cummulative_api_calls', [OrganizationController::class, 'GetTotalCummulativeAPICalls']);
Route::post('/get_total_cummulative_units_expended', [OrganizationController::class, 'GetTotalCummulativeUnitsExpended']);
Route::post('/get_total_cummulative_units_purchased', [OrganizationController::class, 'GetTotalCummulativeUnitsPurchased']);

/*
------------------------------------------------------------------------
API Calls Realtime Units  
------------------------------------------------------------------------
*/
Route::post('/get_realtime_units', [OrganizationController::class, 'GetRealtimeUnits']);
Route::post('/fetch_user_details', [OrganizationController::class, 'FetchUserDetails']);
Route::post('/update_user_details', [OrganizationController::class, 'UpdateUserDetails']);
Route::post('/change_user_password', [OrganizationController::class, 'ChangeUserPassword']);

/*
------------------------------------------------------------------------
Sign Up
------------------------------------------------------------------------
*/
Route::post('/sign_up', [OrganizationController::class, 'SignUp']);

/*
------------------------------------------------------------------------
Validate Registration Token
------------------------------------------------------------------------
*/
Route::post('/validate_registration_token', [OrganizationController::class, 'ValidateRegistrationToken'])->middleware('VerifyRegistrationToken');

/*
------------------------------------------------------------------------
Process Password Recovery
------------------------------------------------------------------------
*/
Route::post('/process_password_recovery', [OrganizationController::class, 'ProcessPasswordRecovery']);


/*
------------------------------------------------------------------------
Validate Password Recovery Token
------------------------------------------------------------------------
*/
Route::post('/validate_password_recovery_token', [OrganizationController::class, 'ValidatePasswordRecoveryToken']);

/*
------------------------------------------------------------------------
Reset Password
------------------------------------------------------------------------
*/
Route::post('/reset_password', [OrganizationController::class, 'ResetPassword']);



/*
------------------------------------------------------------------------


API Section for Admin


------------------------------------------------------------------------
*/

Route::post('/get_users', [AdminController::class, 'GetUsers']);
Route::post('/change_user_status', [AdminController::class, 'ChangeUserStatus']);
/*
------------------------------------------------------------------------
Sign Up MDA User
------------------------------------------------------------------------
*/
Route::post('/sign_up_mda_user', [AdminController::class, 'SignUpMdaUser']);

Route::post('/validate_mda_registration_token', [AdminController::class, 'ValidateMdaRegistrationToken'])->middleware('VerifyMdaRegistrationToken');

/*
------------------------------------------------------------------------
Reset Password
------------------------------------------------------------------------
*/
Route::post('/new_mda_password', [AdminController::class, 'NewMdaPassword']); 

/*
------------------------------------------------------------------------ 
Admin Dashboard APIs
------------------------------------------------------------------------
*/
Route::post('/get_todays_income', [AdminController::class, 'GetTodaysIncome'])->middleware('is_API_call_Authentic');
Route::post('/get_todays_api_calls_made', [AdminController::class, 'GetTodaysAPICalls'])->middleware('is_API_call_Authentic');
Route::post('/get_todays_registered_users_business', [AdminController::class, 'GetTodaysRegisteredUsersBusiness'])->middleware('is_API_call_Authentic');
Route::post('/get_todays_registered_users_government', [AdminController::class, 'GetTodaysRegisteredUsersGovernment'])->middleware('is_API_call_Authentic');

Route::post('/get_cummulative_income', [AdminController::class, 'GetCummulativeIncome'])->middleware('is_API_call_Authentic');
Route::post('/get_cummulative_api_calls_made', [AdminController::class, 'GetCummulativeAPICalls'])->middleware('is_API_call_Authentic');
Route::post('/get_cummulative_registered_users_business', [AdminController::class, 'GetCummulativeRegisteredUsersBusiness'])->middleware('is_API_call_Authentic');
Route::post('/get_cummulative_registered_users_government', [AdminController::class, 'GetCummulativeRegisteredUsersGovernment'])->middleware('is_API_call_Authentic'); 

