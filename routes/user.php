<?php
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserShiftController;
use App\Http\Controllers\UserTeamController;
use App\Models\User;
use App\Models\Shift;
use App\Models\Team;


Route::middleware('auth')->group(function () {
    Route::get('/users', [MemberController::class, 'index'])->name('users.index');
    Route::post('/users/change-status', [MemberController::class, 'changeStatus'])->name('users.change-status');
    Route::get('/users', [MemberController::class, 'index'])->name('users');

   // Shift assignment route
    Route::post('/users/{user}/change-shift', [UserShiftController::class, 'changeShift'])->name('users.change-shift');
    // Team assignment route
    Route::post('/users/{user}/change-team', [UserTeamController::class, 'changeTeam'])->name('users.change-team');


        Route::get('/users/{user}/assignments', function(App\Models\User $user) {
            $user->load(['currentShift.shift', 'currentTeam.team', 'lobRelation', 'teamRelation']);
            $shifts = \App\Models\Shift::all();
            $teams = \App\Models\Team::all();
            return view('web.members.assignments', compact('user', 'shifts', 'teams'));
        })->name('users.assignments');
    
     // Profile and settings routes moved to web.php

});