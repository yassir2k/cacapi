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

//Route::get('organizations','App\Http\Controllers\Api\OrganizationController@index');
Route::get('/organizations', [OrganizationController::class, 'index']);
Route::get('/get_transaction_id', [OrganizationController::class, 'GenerateTransactionId']);
Route::post('/transaction_history', [OrganizationController::class, 'GetTransactionHistory']);
//Route::get('/organizations/{username_}/{password_}/{calltype_}', [OrganizationController::class, 'call'])
//->middleware('is_user_authorized','is_unit_enough','is_call_type_valid');
Route::get('/organizations/{username_}/{password_}/{calltype_}/{rc_number_}/{class_}', [OrganizationController::class, 'call'])
->middleware('is_user_authorized','is_unit_enough','is_call_type_valid');