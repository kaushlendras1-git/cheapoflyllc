<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;

class SeedAttendanceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:seed {--month=} {--year=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed attendance data for all users for a specific month';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $month = $this->option('month') ?? Carbon::now()->month;
        $year = $this->option('year') ?? Carbon::now()->year;
        
        $users = User::all();
        $startOfMonth = Carbon::create($year, $month, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        
        $this->info("Seeding attendance for {$startOfMonth->format('F Y')}");
        
        foreach ($users as $user) {
            for ($date = $startOfMonth->copy(); $date <= $endOfMonth; $date->addDay()) {
                $existingAttendance = Attendance::where('user_id', $user->id)
                    ->where('attendance_date', $date->format('Y-m-d'))
                    ->first();
                    
                if (!$existingAttendance) {
                    $status = $date->isWeekend() ? 'WO' : 'P';
                    
                    Attendance::create([
                        'user_id' => $user->id,
                        'attendance_date' => $date->format('Y-m-d'),
                        'status' => $status
                    ]);
                }
            }
            
            $this->info("Seeded attendance for user: {$user->name}");
        }
        
        $this->info('Attendance seeding completed!');
    }
}
