<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $currentMonth = $request->get('month', Carbon::now()->month);
        $currentYear = $request->get('year', Carbon::now()->year);
        
        // Get available years from user's attendance data
        $availableYears = Attendance::where('user_id', $user->id)
            ->selectRaw('YEAR(attendance_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();
        
        // Add current year if not in data
        if (!in_array(date('Y'), $availableYears)) {
            $availableYears[] = date('Y');
            rsort($availableYears);
        }
        
        // Get attendance for current month
        $attendances = Attendance::where('user_id', $user->id)
            ->whereMonth('attendance_date', $currentMonth)
            ->whereYear('attendance_date', $currentYear)
            ->get()
            ->keyBy(function($item) {
                return Carbon::parse($item->attendance_date)->format('Y-m-d');
            });

        // Generate calendar data
        $startOfMonth = Carbon::create($currentYear, $currentMonth, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        $calendar = [];
        
        for ($date = $startOfMonth->copy(); $date <= $endOfMonth; $date->addDay()) {
            $dateStr = $date->format('Y-m-d');
            $attendance = $attendances->get($dateStr);
            $status = $attendance ? $attendance->status : '';
            
            $calendar[] = [
                'date' => $date->format('d'),
                'full_date' => $dateStr,
                'day' => $date->format('D'),
                'status' => $status,
                'is_weekend' => $date->isWeekend()
            ];
        }

        // Next Week Roster - show selected WO days from current month
        $nextWeekRoster = [];
        foreach ($attendances as $attendance) {
            if ($attendance->status === 'WO') {
                $date = Carbon::parse($attendance->attendance_date);
                $dayName = $date->format('l'); // Full day name (Monday, Tuesday, etc.)
                $nextWeekRoster[$dayName] = 'WO';
            }
        }

        return view('web.profile', compact('user', 'calendar', 'nextWeekRoster', 'currentMonth', 'currentYear', 'availableYears'));
    }
}