<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/client-dashboard', function() {
    return view('clients/dashboard');
});

Route::get('/buy-credit', function() {
    return view('clients/buycredit');
});

Route::get('/transaction-history', function() {
    return view('clients/transaction-history');
});

//Route::post('/client-process-transaction', [OrganizationController::class, 'process_transaction'], function(){
 //   return view('clients/dashboard');
//});