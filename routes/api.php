<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Masters\TeamController;

Route::post('/send-notification', [NotificationController::class, 'sendNotification']);
Route::get('/teams/{lobId}', [TeamController::class, 'getTeamsByLob']);