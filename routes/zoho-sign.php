<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZohoSignController;

Route::get('/zoho-test', function() {
    return 'Zoho Sign routes are working!';
});

Route::get('/zoho-sign', [ZohoSignController::class, 'showForm'])->name('zoho-sign.form');
Route::post('/zoho-sign/send', [ZohoSignController::class, 'sendForSignature'])->name('zoho-sign.send');
Route::post('/zoho-sign/test-static', [ZohoSignController::class, 'testWithStaticFile'])->name('zoho-sign.test-static');