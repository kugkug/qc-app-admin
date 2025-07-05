<?php

use App\Http\Controllers\AdminModulesController;
use App\Http\Controllers\Executor\ApplicationsController;
use App\Http\Controllers\Executor\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/", [AdminModulesController::class, 'index'])->name('login');

Route::middleware([
    'auth',
    // 'token_validator',
    'prevent_back',
])->group(function() {
        Route::get("/dashboard", [AdminModulesController::class, 'dashboard'])->name('dashboard');
        Route::group(['prefix' => 'applications'], function() {
            Route::get("/all", [AdminModulesController::class, 'applications'])->name('applications');
            Route::get("/for-review", [AdminModulesController::class, 'for_review'])->name('for_review');
            Route::get("/payment-created", [AdminModulesController::class, 'payment_created'])->name('payment_created');
            Route::get("/payment-validation", [AdminModulesController::class, 'payment_validation'])->name('payment_validation');
            Route::get("/validated", [AdminModulesController::class, 'validated'])->name('validated');
            Route::get("/head-approval", [AdminModulesController::class, 'head_approval'])->name('head_approval');
            Route::get("/rejected", [AdminModulesController::class, 'rejected'])->name('rejected');
            Route::get("/completed", [AdminModulesController::class, 'completed'])->name('completed');
            Route::get("/released", [AdminModulesController::class, 'released'])->name('released');
            Route::get("/customer-complaints", [AdminModulesController::class, 'customer_complaints'])->name('customer_complaints');
        });
        
        Route::group(['prefix' => 'application'], function() {
            Route::get("/for-review/{application_ref_no}", [AdminModulesController::class, 'review_application'])->name('review_application');
            Route::get("/payment-validation/{application_ref_no}", [AdminModulesController::class, 'review_payment'])->name('review_payment');
            Route::get("/head-approval/{application_ref_no}", [AdminModulesController::class, 'review_approval'])->name('review_payment');
        });
        
        Route::get("/generate-report", [AdminModulesController::class, 'generate_report'])->name('generate_report');
        // Route::get("/health_certificate", [ApplicantModulesController::class, 'health_certificate'])->name('applicant_health_certificate');
        // Route::get("/sanitary_permit", [ApplicantModulesController::class, 'sanitary_permit'])->name('applicant_sanitary_permit');
        // Route::get("/laboratory_follow_up", [ApplicantModulesController::class, 'laboratory_followup'])->name('applicant_laboratory_followup');
        // Route::get("/analysis_follow_up", [ApplicantModulesController::class, 'water_analysis_followup'])->name('applicant_water_analysis_followup');


        // Route::group(['prefix' => 'processing'], function() {
        //     Route::get("/application", [ApplicantModulesController::class, 'processing_application'])->name('applicant_processing_application');
        //     Route::get("/upload-requirements", [ApplicantModulesController::class, 'processing_upload_requirements'])->name('applicant_processing_upload_requirements');
        // });
    
});

Route::group(['prefix' => 'executor'], function() {
    Route::post('/login', [UserController::class, 'login'])->name('exec_login');
    Route::post('/logout', [UserController::class, 'logout'])->name('exec_logout');

    Route::group(['prefix' => 'head'], function() {
        Route::post('approval/{req_id}', [ApplicationsController::class, 'approveApplication'])->name('api_update_requirement');
    });

    Route::group(['prefix' => 'requirement'], function() {
        Route::post('update/{req_id}', [ApplicationsController::class, 'updateRequirement'])->name('api_update_requirement');
    });

    Route::group(['prefix' => 'payment'], function() {
        Route::post('create/{ref_no}', [ApplicationsController::class, 'createPaymentOrder'])->name('api_update_requirement');
        Route::post('update/{ref_no}', [ApplicationsController::class, 'updatePaymentOrder'])->name('api_update_requirement');
        // Route::post('create/{ref_no}', [ApplicationsController::class, 'createPaymentOrder'])->name('api_update_requirement');
    });
});