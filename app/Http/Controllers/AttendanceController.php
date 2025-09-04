<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', date('n'));
        $year = $request->get('year', date('Y'));
        $users = User::all();
        
        // Get available years from attendance data
        $availableYears = Attendance::selectRaw('YEAR(attendance_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();
        
        // Add current year if not in data
        if (!in_array(date('Y'), $availableYears)) {
            $availableYears[] = date('Y');
            rsort($availableYears);
        }
        
        return view('web.attendance.index', compact('users', 'month', 'year', 'availableYears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'attendance_date' => 'required|date',
            'status' => 'nullable|in:P,WO,LWP,UL,TR,LV,HD'
        ]);

        // Check if date exists in current month
        $date = Carbon::parse($request->attendance_date);
        if ($date->day > $date->daysInMonth) {
            return response()->json(['success' => false, 'message' => 'Invalid date']);
        }

        if ($request->status) {
            Attendance::updateOrCreate(
                [
                    'user_id' => $request->user_id,
                    'attendance_date' => $request->attendance_date
                ],
                ['status' => $request->status]
            );
        } else {
            Attendance::where('user_id', $request->user_id)
                     ->where('attendance_date', $request->attendance_date)
                     ->delete();
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:P,WO,LWP,UL,TR,LV,HD'
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }

    public function export(Request $request)
    {
        $month = $request->get('month', date('n'));
        $year = date('Y');
        $users = User::all();
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set headers
        $sheet->setCellValue('A1', 'User');
        for ($day = 1; $day <= 31; $day++) {
            $colIndex = $day + 1; // Start from column B (index 2)
            $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex);
            if (checkdate($month, $day, $year)) {
                $sheet->setCellValue($col . '1', $day);
            }
        }
        
        // Add user data
        $row = 2;
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user->name);
            
            for ($day = 1; $day <= 31; $day++) {
                $colIndex = $day + 1;
                $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex);
                $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
                
                if (checkdate($month, $day, $year)) {
                    $attendance = $user->attendances()->where('attendance_date', $date)->first();
                    $status = $attendance ? $attendance->status : '';
                    
                    $sheet->setCellValue($col . $row, $status);
                    
                    // Apply colors
                    $color = match($status) {
                        'P' => '28a745',   // Green
                        'WO' => '6c757d',  // Gray
                        'LWP' => 'ffc107', // Yellow
                        'UL' => '17a2b8',  // Cyan
                        'TR' => '007bff',  // Blue
                        'LV' => 'dc3545',  // Red
                        'HD' => '343a40',  // Dark
                        default => 'ffffff' // White
                    };
                    
                    $sheet->getStyle($col . $row)->getFill()
                          ->setFillType(Fill::FILL_SOLID)
                          ->setStartColor(new Color($color));
                }
            }
            $row++;
        }
        
        $filename = 'attendance_' . date('F_Y', mktime(0,0,0,$month,1,$year)) . '.xlsx';
        
        $writer = new Xlsx($spreadsheet);
        
        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}