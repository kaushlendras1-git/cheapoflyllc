<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;

class UserObserver
{
    public function created(User $user)
    {
        $this->createTodayAttendance($user);
    }

    private function createTodayAttendance(User $user)
    {
        $today = Carbon::today();
        
        // Check if attendance already exists for today
        $existingAttendance = Attendance::where('user_id', $user->id)
            ->where('attendance_date', $today)
            ->first();

        if (!$existingAttendance) {
            // Determine status based on day of week
            $status = $today->isWeekend() ? 'WO' : 'P';
            
            Attendance::create([
                'user_id' => $user->id,
                'attendance_date' => $today,
                'status' => $status
            ]);
        }
    }
}