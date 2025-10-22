<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RingCentral\RingCentralController;
use App\Http\Controllers\RingCentral\CallRoutingController;



Route::prefix('ringcentral')->name('ringcentral.')->group(function () {
    Route::get('/authorize', [RingCentralController::class, 'authorize'])->name('authorize');
    Route::get('/callback', [RingCentralController::class, 'callback'])->name('callback');
    Route::get('/sms', [RingCentralController::class, 'sms'])->name('sms');
    Route::get('/call', [RingCentralController::class, 'call'])->name('call');
    Route::get('/fax', [RingCentralController::class, 'fax'])->name('fax');
    Route::get('/call-logs', [RingCentralController::class, 'callLogs'])->name('call-logs');
    Route::get('/incoming-calls/{extension?}', [RingCentralController::class, 'getIncomingCallsForUser'])->name('incoming-calls');
    Route::post('/add-comment', [RingCentralController::class, 'addComment'])->name('add-comment');
    Route::get('/test', function() { return view('web.ringcentral.test'); })->name('test');
    Route::get('/demo', function() { return view('web.ringcentral.demo'); })->name('demo');
    Route::get('/tutorial', function() { return view('web.ringcentral.tutorial'); })->name('tutorial');
    
    // Call routing endpoints
    Route::get('/user-by-extension/{extension}', [CallRoutingController::class, 'getUserByExtension'])->name('user-by-extension');
    Route::get('/all-extensions', [CallRoutingController::class, 'getAllExtensions'])->name('all-extensions');
    Route::post('/webhook/incoming-call', [CallRoutingController::class, 'incomingCallWebhook'])->name('webhook.incoming-call');
});