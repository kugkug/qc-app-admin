<?php

use App\Http\Controllers\Api\ApplicationsController;
use App\Http\Controllers\Api\BusinessController;
use App\Http\Controllers\Api\ComplaintsController;
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

    Route::group(['prefix' => 'businesses'], function() {
        Route::post('update/{ref_no}', [BusinessController::class, 'updateApplication'])->name('api_update_business');
    });

    Route::group(['prefix' => 'requirement'], function() {        
        Route::post('update/{requirement_id}', [ApplicationsController::class, 'updateRequirements'])->name('api_update_requirement');
        Route::post('business-update/{requirement_id}', [BusinessController::class, 'updateRequirements'])->name('api_update_business_requirement');
    });

    Route::group(['prefix' => 'payment'], function() {
        Route::post('create-order/{ref_no}', [ApplicationsController::class, 'createPaymentOrder'])->name('api_create_payment_order');
        Route::post('update/{ref_no}', [ApplicationsController::class, 'updatePaymentOrder'])->name('api_create_payment_order_update');
        Route::post('business-create/{ref_no}', [BusinessController::class, 'createPaymentOrder'])->name('api_create_payment_order_business');
        Route::post('business-update/{ref_no}', [BusinessController::class, 'updatePaymentOrder'])->name('api_update_payment_order_business');
    });
    
    Route::group(['prefix' => 'complaints'], function() {
        Route::post('recommendation-first/{complaint_ref_no}', [ComplaintsController::class, 'recommendation_first'])->name('api_recommendation_first_complaint');
        Route::post('recommendation-second/{complaint_ref_no}', [ComplaintsController::class, 'recommendation_second'])->name('api_recommendation_second_complaint');
        Route::post('recommendation-third/{complaint_ref_no}', [ComplaintsController::class, 'recommendation_third'])->name('api_recommendation_third_complaint');
        Route::post('head-approval/{complaint_ref_no}', [ComplaintsController::class, 'head_approval'])->name('api_head_approval_complaint');
        Route::post('resolved/{complaint_ref_no}', [ComplaintsController::class, 'resolved'])->name('api_resolved_complaint');
    });
});