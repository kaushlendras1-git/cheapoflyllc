<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AmadeusController;

Route::get('/amadeus/pnr-details', [AmadeusController::class, 'getPnr']);

Route::get('/teams/{lob}', [TeamController::class, 'getTeamsByLob']);
Route::get('/team-leaders', [UserController::class, 'getTeamLeaders']);

Route::post('/travel-changes', [\App\Http\Controllers\TravelChangeController::class, 'store']);
Route::get('/travel-changes/{bookingId}', [\App\Http\Controllers\TravelChangeController::class, 'getByBooking']);
Route::get('/travel-changes/single/{id}', [\App\Http\Controllers\TravelChangeController::class, 'show']);
Route::put('/travel-changes/{id}', [\App\Http\Controllers\TravelChangeController::class, 'update']);
Route::delete('/travel-changes/{id}', [\App\Http\Controllers\TravelChangeController::class, 'destroy']);