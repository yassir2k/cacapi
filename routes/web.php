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

Route::post('/clients/load-more-details/', [OrganizationController::class, 'LoadMoreDetails']);

/*Route::get('/registration/verify-mda-registration/{mdatoken}', function () {
    return view('verify-mda-registration');
})->name('verifymda');*/

Route::get('/{any}', function () {
    return view('login');
})->where('any','^(?!v).*$');
