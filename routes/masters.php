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
use App\Http\Controllers\Masters\AirlineController;
use App\Http\Controllers\Masters\AllowedIpController;
use App\Http\Controllers\MemberController;

Route::middleware('auth')->group(function () {
 Route::prefix('masters')->group(function () {
    
        Route::resource('booking-status', BookingStatusController::class);
        Route::resource('payment-status', PaymentStatusController::class);
        

        Route::resource('call-types', CallTypeController::class);
        Route::resource('campaign', CampaignController::class);
        Route::resource('quality-feedback', QualityFeedbackController::class);
        Route::resource('lobs', \App\Http\Controllers\Masters\LOBController::class);
        Route::resource('teams', TeamController::class);
        Route::resource('status', StatusController::class);
        Route::resource('supplier', SupplierController::class);
        Route::resource('quality', QualityController::class);
        Route::resource('query-type', QueryTypeController::class);
        Route::resource('members', MemberController::class);
        Route::resource('companies', CompaniesController::class);
        Route::resource('airlines', AirlineController::class);
        Route::patch('allowed-ips/toggle-open-all', [AllowedIpController::class, 'toggleOpenAll'])->name('allowed-ips.toggle-open-all');
        Route::patch('allowed-ips/{allowedIp}/toggle-status', [AllowedIpController::class, 'toggleStatus'])->name('allowed-ips.toggle-status');
        Route::resource('allowed-ips', AllowedIpController::class);
        Route::resource('units', \App\Http\Controllers\UnitController::class);
    });
    
});