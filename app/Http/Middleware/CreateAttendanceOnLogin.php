<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CreateAttendanceOnLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
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
        
        return $next($request);
    }
}
