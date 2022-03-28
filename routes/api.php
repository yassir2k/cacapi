<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrganizationController;

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
Route::post('/login', [OrganizationController::class, 'Login']); 
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
Route::post('/get_total_api_calls_today', [OrganizationController::class, 'GetTotalAPICallsToday']);
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