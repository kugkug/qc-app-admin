<?php

use App\Http\Controllers\AdminModulesController;
use Illuminate\Support\Facades\Route;

Route::get("/", [AdminModulesController::class, 'index'])->name('login');

Route::group(['prefix' => 'admin'], function() {
    Route::get("/", [AdminModulesController::class, 'dashboard'])->name('dashboard');

    Route::get("/dashboard", [AdminModulesController::class, 'dashboard'])->name('dashboard');
    Route::get("/applications", [AdminModulesController::class, 'applications'])->name('applications');
    Route::get("/draft", [AdminModulesController::class, 'draft'])->name('dashboard');
    Route::get("/for_review", [AdminModulesController::class, 'for_review'])->name('for_review');
    Route::get("/rejected", [AdminModulesController::class, 'rejected'])->name('rejected');
    Route::get("/validated", [AdminModulesController::class, 'validated'])->name('validated');
    Route::get("/payment_created", [AdminModulesController::class, 'payment_created'])->name('payment_created');
    Route::get("/payment_validation", [AdminModulesController::class, 'payment_validation'])->name('payment_validation');
    Route::get("/completed", [AdminModulesController::class, 'completed'])->name('completed');
    Route::get("/released", [AdminModulesController::class, 'released'])->name('released');
    Route::get("/generate_report", [AdminModulesController::class, 'generate_report'])->name('generate_report');
    // Route::get("/health_certificate", [ApplicantModulesController::class, 'health_certificate'])->name('applicant_health_certificate');
    // Route::get("/sanitary_permit", [ApplicantModulesController::class, 'sanitary_permit'])->name('applicant_sanitary_permit');
    // Route::get("/laboratory_follow_up", [ApplicantModulesController::class, 'laboratory_followup'])->name('applicant_laboratory_followup');
    // Route::get("/analysis_follow_up", [ApplicantModulesController::class, 'water_analysis_followup'])->name('applicant_water_analysis_followup');


    // Route::group(['prefix' => 'processing'], function() {
    //     Route::get("/application", [ApplicantModulesController::class, 'processing_application'])->name('applicant_processing_application');
    //     Route::get("/upload-requirements", [ApplicantModulesController::class, 'processing_upload_requirements'])->name('applicant_processing_upload_requirements');
    // });
});