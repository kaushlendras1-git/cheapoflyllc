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
        
        // Status Management Routes
        Route::get('status-management', [\App\Http\Controllers\StatusManagementController::class, 'index'])->name('status-management.index');
        Route::post('status-management/booking-status', [\App\Http\Controllers\StatusManagementController::class, 'storeBookingStatus']);
        Route::put('status-management/booking-status/{id}', [\App\Http\Controllers\StatusManagementController::class, 'updateBookingStatus']);
        Route::delete('status-management/booking-status/{id}', [\App\Http\Controllers\StatusManagementController::class, 'deleteBookingStatus']);
        Route::post('status-management/payment-status', [\App\Http\Controllers\StatusManagementController::class, 'storePaymentStatus']);
        Route::put('status-management/payment-status/{id}', [\App\Http\Controllers\StatusManagementController::class, 'updatePaymentStatus']);
        Route::delete('status-management/payment-status/{id}', [\App\Http\Controllers\StatusManagementController::class, 'deletePaymentStatus']);
        Route::post('status-management/booking-payment-mapping', [\App\Http\Controllers\StatusManagementController::class, 'storeBookingPaymentMapping']);
        Route::delete('status-management/booking-payment-mapping/{id}', [\App\Http\Controllers\StatusManagementController::class, 'deleteBookingPaymentMapping']);
        Route::post('status-management/status-dependency', [\App\Http\Controllers\StatusManagementController::class, 'storeStatusDependency']);
        Route::delete('status-management/status-dependency/{id}', [\App\Http\Controllers\StatusManagementController::class, 'deleteStatusDependency']);
        Route::post('status-management/interdependency', [\App\Http\Controllers\StatusManagementController::class, 'storeStatusInterdependency']);
        Route::delete('status-management/interdependency/{id}', [\App\Http\Controllers\StatusManagementController::class, 'deleteStatusInterdependency']);
        Route::get('status-management/available-statuses', [\App\Http\Controllers\StatusManagementController::class, 'getAvailableStatuses']);
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
        Route::resource('units', \App\Http\Controllers\UnitController::class);
    });
    
});