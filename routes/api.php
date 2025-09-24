<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Masters\TeamController;

Route::post('/send-notification', [NotificationController::class, 'sendNotification']);
Route::get('/teams/{lobId}', [TeamController::class, 'getTeamsByLob']);

// Amadeus PNR Retrieval API
Route::post('/amadeus/pnr-retrieval', [\App\Http\Controllers\Travel\AmadeusPnrRetrievalController::class, 'retrievePnr']);

// Status API endpoints
Route::middleware('auth')->group(function () {
    Route::get('/booking-statuses', [\App\Http\Controllers\Api\StatusController::class, 'getBookingStatuses']);
    Route::get('/payment-statuses', [\App\Http\Controllers\Api\StatusController::class, 'getPaymentStatuses']);
});