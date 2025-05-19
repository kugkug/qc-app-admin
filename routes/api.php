<?php

use App\Http\Controllers\Api\ApplicationsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('login', [UserController::class, 'login'])->name('api_login');
Route::post('registration', [UserController::class, 'register'])->name('api_register');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('logout', [UserController::class, 'logout'])->name('api_logout');

    Route::group(['prefix' => 'applications'], function() {
        Route::get('all', [ApplicationsController::class, 'getAllApplications'])->name('api_all_applications');
        Route::post('status-filtered', [ApplicationsController::class, 'getApplicationViaStatus'])->name('api_filter_applications');
        Route::post('update/{ref_no}', [ApplicationsController::class, 'updateApplication'])->name('api_update_application');
    });

    Route::group(['prefix' => 'requirement'], function() {        
        Route::post('update/{requirement_id}', [ApplicationsController::class, 'updateRequirements'])->name('api_update_requirement');
    });

    Route::group(['prefix' => 'payment'], function() {
        Route::post('create-order/{ref_no}', [ApplicationsController::class, 'createPaymentOrder'])->name('api_create_payment_order');
        Route::post('update/{ref_no}', [ApplicationsController::class, 'updatePaymentOrder'])->name('api_create_payment_order');
    });
    
});