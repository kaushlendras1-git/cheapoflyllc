<?php
use App\Http\Controllers\Masters\StatusController;
use App\Http\Controllers\Masters\SupplierController;
use App\Http\Controllers\Masters\QualityController;
use App\Http\Controllers\Masters\TeamController;
use App\Http\Controllers\Masters\CampaignController;
use App\Http\Controllers\Masters\CallTypeController;
use App\Http\Controllers\Masters\QualityFeedbackController;
use App\Http\Controllers\Masters\QueryTypeController;
use App\Http\Controllers\Masters\BookingStatusController;
use App\Http\Controllers\Masters\PaymentStatusController;
use App\Http\Controllers\Masters\CompaniesController;
use App\Http\Controllers\MemberController;

Route::middleware('auth')->group(function () {
 Route::prefix('masters')->group(function () {
    
        Route::resource('booking-status', BookingStatusController::class);
        Route::resource('payment-status', PaymentStatusController::class);
        Route::resource('call-types', CallTypeController::class);
        Route::resource('campaign', CampaignController::class);
        Route::resource('quality-feedback', QualityFeedbackController::class);
        Route::resource('lobs', \App\Http\Controllers\LOBController::class);
        Route::resource('teams', TeamController::class);
        Route::resource('status', StatusController::class);
        Route::resource('supplier', SupplierController::class);
        Route::resource('quality', QualityController::class);
        Route::resource('query-type', QueryTypeController::class);
        Route::resource('members', MemberController::class);
        Route::resource('companies', CompaniesController::class);
    });
    
});