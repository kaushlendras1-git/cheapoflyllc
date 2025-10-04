<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\UserController;

Route::get('/teams/{lob}', [TeamController::class, 'getTeamsByLob']);
Route::get('/team-leaders', [UserController::class, 'getTeamLeaders']);