<?php

use App\Http\Controllers\AdminModulesController;
use App\Http\Controllers\BusinessModulesController;
use App\Http\Controllers\ComplaintsModulesController;
use App\Http\Controllers\Executor\ApplicationsController;
use App\Http\Controllers\Executor\BusinessController;
use App\Http\Controllers\Executor\ComplaintsController;
use App\Http\Controllers\Executor\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/", [AdminModulesController::class, 'index'])->name('login');

Route::middleware([
    'auth',
    // 'token_validator',
    'prevent_back',
])->group(function() {
        Route::get("/dashboard", [AdminModulesController::class, 'dashboard'])->name('dashboard');

        Route::group(['prefix' => 'users'], function() {
            Route::get("/all", [AdminModulesController::class, 'users_all'])->name('users_all');
        });

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
            
        });

        Route::group(['prefix' => 'businesses'], function() {
            Route::get("/all", [BusinessModulesController::class, 'applications'])->name('businesses');
            Route::get("/for-review", [BusinessModulesController::class, 'for_review'])->name('for_review_business');
            Route::get("/payment-created", [BusinessModulesController::class, 'payment_created'])->name('payment_created_business');
            Route::get("/payment-validation", [BusinessModulesController::class, 'payment_validation'])->name('payment_validation_business');
            Route::get("/validated", [BusinessModulesController::class, 'validated'])->name('validated_business');
            Route::get("/head-approval", [BusinessModulesController::class, 'head_approval'])->name('head_approval_business');
            Route::get("/rejected", [BusinessModulesController::class, 'rejected'])->name('rejected_business');
            Route::get("/completed", [BusinessModulesController::class, 'completed'])->name('completed_business');
        });
        
        Route::group(['prefix' => 'application'], function() {
            Route::get("/for-review/{application_ref_no}", [AdminModulesController::class, 'review_application'])->name('review_application');
            Route::get("/payment-validation/{application_ref_no}", [AdminModulesController::class, 'review_payment'])->name('review_payment_application');
            Route::get("/payment-created/{application_ref_no}", [AdminModulesController::class, 'view_payment_created'])->name('view_payment_created_application');
            Route::get("/head-approval/{application_ref_no}", [AdminModulesController::class, 'review_approval'])->name('review_approval_application');
        });

        Route::group(['prefix' => 'business'], function() {
            Route::get("/for-review/{application_ref_no}", [BusinessModulesController::class, 'review_application'])->name('review_application_business');
            Route::get("/payment-validation/{application_ref_no}", [BusinessModulesController::class, 'review_payment'])->name('review_payment_business');
            Route::get("/payment-created/{application_ref_no}", [BusinessModulesController::class, 'view_payment_created'])->name('view_payment_created_business');
            Route::get("/head-approval/{application_ref_no}", [BusinessModulesController::class, 'review_approval'])->name('review_approval_business');
        });

        Route::group(['prefix' => 'complaints'], function() {
            Route::get("/all", [ComplaintsModulesController::class, 'all'])->name('complaints');
            Route::get("/processing", [ComplaintsModulesController::class, 'processing'])->name('complaints_processing');
            Route::get("/recommendation-first", [ComplaintsModulesController::class, 'recommendation_first'])->name('complaints_recommendation_first');
            Route::get("/recommendation-second", [ComplaintsModulesController::class, 'recommendation_second'])->name('complaints_recommendation_second');
            Route::get("/recommendation-third", [ComplaintsModulesController::class, 'recommendation_third'])->name('complaints_recommendation_third');
            Route::get("/head-approval", [ComplaintsModulesController::class, 'head_approval'])->name('complaints_head_approval');
            Route::get("/resolved", [ComplaintsModulesController::class, 'resolved'])->name('complaints_resolved');

            Route::group(['prefix' => 'processing'], function() {
                Route::get("/process/{complaint_ref_no}", [ComplaintsModulesController::class, 'process_complaint'])->name('complaints_process');
                Route::get("/recommendation-first/{complaint_ref_no}", [ComplaintsModulesController::class, 'process_recommendation_first'])->name('complaints_process_recommendation_first');
                Route::get("/recommendation-second/{complaint_ref_no}", [ComplaintsModulesController::class, 'process_recommendation_second'])->name('complaints_process_recommendation_second');
                Route::get("/recommendation-third/{complaint_ref_no}", [ComplaintsModulesController::class, 'process_recommendation_third'])->name('complaints_process_recommendation_third');
                Route::get("/head-approval/{complaint_ref_no}", [ComplaintsModulesController::class, 'process_head_approval'])->name('complaints_process_head_approval');
                Route::get("/resolved/{complaint_ref_no}", [ComplaintsModulesController::class, 'process_resolved'])->name('complaints_process_resolved');
                Route::get("/completed/{complaint_ref_no}", [ComplaintsModulesController::class, 'process_completed'])->name('complaints_process_completed');
            });
        });
        
        Route::get("/generate-report", [AdminModulesController::class, 'generate_report'])->name('generate_report');
        Route::post("/generate_report/health_certificates", [AdminModulesController::class, 'generate_health_certificates_report'])->name('generate_health_certificates_report');
        Route::post("/generate_report/sanitary_permits", [AdminModulesController::class, 'generate_sanitary_permits_report'])->name('generate_sanitary_permits_report');
});

Route::group(['prefix' => 'executor'], function() {
    Route::post('/login', [UserController::class, 'login'])->name('exec_login');
    Route::post('/logout', [UserController::class, 'logout'])->name('exec_logout');

    Route::group(['prefix' => 'head'], function() {
        Route::post('approval/{req_id}', [ApplicationsController::class, 'approveApplication'])->name('exec_approval');
        Route::post('business-approval/{req_id}', [BusinessController::class, 'approveApplication'])->name('exec_approval_business');
    });

    Route::group(['prefix' => 'requirement'], function() {
        Route::post('update/{req_id}', [ApplicationsController::class, 'updateRequirement'])->name('exec_update_requirement');
        Route::post('business-update/{req_id}', [BusinessController::class, 'updateRequirement'])->name('exec_update_requirement_business');
    });

    Route::group(['prefix' => 'payment'], function() {
        Route::post('create/{ref_no}', [ApplicationsController::class, 'createPaymentOrder'])->name('exec_create_payment_order');
        Route::post('update/{ref_no}', [ApplicationsController::class, 'updatePaymentOrder'])->name('exec_update_payment_order');
        Route::post('business-create/{ref_no}', [BusinessController::class, 'createPaymentOrder'])->name('exec_create_payment_order_business');
        Route::post('business-update/{ref_no}', [BusinessController::class, 'updatePaymentOrder'])->name('exec_update_payment_order_business');
    });

    Route::group(['prefix' => 'complaints'], function() {
        Route::post('recommendation-first/{ref_no}', [ComplaintsController::class, 'recommendation_first'])->name('exec_recommendation_first_complaint');
        Route::post('recommendation-second/{ref_no}', [ComplaintsController::class, 'recommendation_second'])->name('exec_recommendation_second_complaint');
        Route::post('recommendation-third/{ref_no}', [ComplaintsController::class, 'recommendation_third'])->name('exec_recommendation_third_complaint');
        Route::post('head-approval/{ref_no}', [ComplaintsController::class, 'head_approval'])->name('exec_head_approval_complaint');
        Route::post('resolved/{ref_no}', [ComplaintsController::class, 'resolved'])->name('exec_resolved_complaint');
    });
    
});