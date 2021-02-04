<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GroupsController;
use App\Http\Controllers\Api\ReportsController;
use App\Http\Controllers\Api\CustomersController;
use App\Http\Controllers\Api\RisksController;
use App\Http\Controllers\Api\SettingsController;
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



Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);

    Route::post('groups',[GroupsController::class,'index']);
    Route::post('groups/add',[GroupsController::class,'addGroup']);
    Route::post('items/add',[GroupsController::class,'addItem']);
    Route::put('items/{item}',[GroupsController::class,'updateItem']);
    Route::put('groups/{group}',[GroupsController::class,'updateGroup']);
    Route::delete('groups/{group}',[GroupsController::class,'deleteGroup']);
    Route::delete('items/{item}',[GroupsController::class,'deleteItem']);

    Route::get('reports',[ReportsController::class,'index']);
    Route::get('report/{id}',[ReportsController::class,'getReport']);
    Route::delete('report/{id}',[ReportsController::class,'deleteReport']);
    Route::post('report/add',[ReportsController::class,'addReport']);
    Route::put('report/{id}',[ReportsController::class,'updateReport']);
    Route::put('report/item/{id}',[ReportsController::class,'updateItem']);
    Route::delete('report/{report}/group/{group}',[ReportsController::class,'deleteGroup']);
    Route::post('report/{report}/item/add',[ReportsController::class,'addItem']);
    Route::post('report/{report}/group',[ReportsController::class,'addGroup']);
    Route::delete('report/{report}/item/{item}',[ReportsController::class,'deleteItem']);

    Route::get('customers',[CustomersController::class,'getCustomers']);
    Route::post('customer/add',[CustomersController::class,'addCustomer']);
    Route::get('customer/{id}',[CustomersController::class,'getCustomer']);
    Route::put('customer/{id}',[CustomersController::class,'updateCustomer']);

    Route::get('settings/summary',[SettingsController::class,'getExecutiveSummary']);
    Route::post('settings/summary',[SettingsController::class,'updateExecutiveSummary']);

    Route::get('risks',[RisksController::class,'getRisks']);

    Route::get('dashboard',[SettingsController::class,'getStats']);

});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');
});
