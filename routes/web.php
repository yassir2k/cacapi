<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\AdminController;

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

//Route::get('/registration/verify-registration/{token}', [OrganizationController::class, 'VerifyRegistration'])->name('verify')->middleware('VerifyRegistrationToken');

Route::get('/registration/verify-registration/{token}', function () {
    return view('verify-registration');
})->name('verify');

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/password-recovery', function () {
    return view('clients/password-recovery');
});

Route::get('/reset-password', function () {
    return view('clients/reset-password');
});

Route::get('/validate-password-recovery-token', function () {
    return view('clients/validate-password-recovery-token');
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

Route::get('/transaction-history/transaction-details/{rrr}', function() {
    return view('clients/transaction-details');
});

Route::get('/api-documentation', function() {
    return view('clients/api-documentation');
});

Route::get('/api-call-log', function() {
    return view('clients/api-call-log');
});

Route::get('/edit-user-profile', function() {
    return view('clients/edit-user-profile');
});

Route::get('/change-user-password', function() {
    return view('clients/change-user-password');
});

Route::get('/clients/load-more-details/{transaction_id}', [OrganizationController::class, 'LoadMoreDetails']);

/****************************************************************************************************************
 * Admin Routes Definition Below
 ***************************************************************************************************************/

Route::get('/admin-dashboard', function() {
    return view('admin/dashboard');
});

Route::get('/manage-registered-users', function() {
    return view('admin/manage-registered-users');
});

Route::get('/create-new-mda-user', function() {
    return view('admin/create-new-mda-user');
});


Route::get('/registration/verify-mda-registration/{mdatoken}', function () {
    return view('verify-mda-registration');
})->name('verifyMda');