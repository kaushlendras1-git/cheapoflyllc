@extends('web.layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">My Profile</h2>
        <div class="breadcrumb">
            <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
            <a class="active" aria-current="page">Profile</a>
        </div>
    </div>
   
    <div class="row">
        <!-- Profile Information -->
        <div class="col-xl-4 col-lg-5 col-md-5">
            <div class="card mb-6">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center mb-4" style="width: 120px; height: 120px;">
                                @php
                                    $initials = collect(explode(' ', $user->name))->map(fn($word) => strtoupper(substr($word, 0, 1)))->join('');
                                @endphp
                                <span style="font-size: 48px; font-weight: bold;">{{ $initials }}</span>
                            </div>
                            <div class="user-info text-center">
                                <h4>{{ $user->name }}</h4>
                                <span class="badge bg-label-secondary mt-1">{{ ucfirst($user->role) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">
                        <div class="d-flex align-items-center me-5 gap-4">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded w-px-40 h-px-40">
                                    <i class="icon-base ri ri-check-line icon-24px"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $user->attendances()->whereMonth('attendance_date', $currentMonth)->where('status', 'P')->count() }}</h5>
                                <span>Present Days</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-4">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-success rounded w-px-40 h-px-40">
                                    <i class="icon-base ri ri-user-check-line icon-24px"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $user->attendances()->whereMonth('attendance_date', $currentMonth)->whereIn('status', ['P', 'HD'])->count() }}</h5>
                                <span>Working Days</span>
                            </div>
                        </div>
                    </div>
                    <h5 class="pb-4 border-bottom mb-4">Details</h5>
                    <div class="info-container">
                        <ul class="list-unstyled mb-6">
                            <li class="mb-2">
                                <span class="h6">Email:</span>
                                <span>{{ $user->email }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6">Phone:</span>
                                <span>{{ $user->phone ?? 'Not provided' }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6">Employee ID:</span>
                                <span>{{ $user->id }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance Calendar -->
        <div class="col-xl-8 col-lg-7 col-md-7">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Attendance - {{ date('F Y', mktime(0, 0, 0, $currentMonth, 1, $currentYear)) }}</h5>
                    <div class="d-flex gap-2">
                        <select id="profileMonth" class="form-control" style="width: 120px; padding: 5px; font-size: 12px;" onchange="changeProfileMonth()">
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $i == $currentMonth ? 'selected' : '' }}>{{ date('F', mktime(0,0,0,$i,1)) }}</option>
                            @endfor
                        </select>
                        <select id="profileYear" class="form-control" style="width: 100px; padding: 5px; font-size: 12px;" onchange="changeProfileMonth()">
                            @foreach($availableYears as $y)
                                <option value="{{ $y }}" {{ $y == $currentYear ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-3 mb-4">
                                <span class="badge bg-success">P - Present</span>
                                <span class="badge bg-secondary">WO - Week Off</span>
                                <span class="badge bg-warning">LWP - Leave Without Pay</span>
                                <span class="badge bg-info">UL - Unplanned Leave</span>
                                <span class="badge bg-primary">TR - Training</span>
                                <span class="badge bg-danger">LV - Leave</span>
                                <span class="badge bg-dark">HD - Half Day</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mon</th>
                                    <th>Tue</th>
                                    <th>Wed</th>
                                    <th>Thu</th>
                                    <th>Fri</th>
                                    <th>Sat</th>
                                    <th>Sun</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $startOfMonth = \Carbon\Carbon::create($currentYear, $currentMonth, 1);
                                    $endOfMonth = $startOfMonth->copy()->endOfMonth();
                                    $startDay = $startOfMonth->dayOfWeek;
                                    $mondayStart = $startDay == 0 ? 6 : $startDay - 1;
                                    $totalDays = $endOfMonth->day;
                                    $weeks = [];
                                    $currentWeek = [];
                                    
                                    // Add empty cells for days before month starts
                                    for ($i = 0; $i < $mondayStart; $i++) {
                                        $currentWeek[] = null;
                                    }
                                    
                                    // Add all days of the month
                                    foreach($calendar as $day) {
                                        $currentWeek[] = $day;
                                        if (count($currentWeek) == 7) {
                                            $weeks[] = $currentWeek;
                                            $currentWeek = [];
                                        }
                                    }
                                    
                                    // Add remaining days to complete the last week
                                    if (!empty($currentWeek)) {
                                        while (count($currentWeek) < 7) {
                                            $currentWeek[] = null;
                                        }
                                        $weeks[] = $currentWeek;
                                    }
                                @endphp
                                
                                @foreach($weeks as $week)
                                    <tr>
                                        @foreach($week as $day)
                                            @if($day === null)
                                                <td class="text-muted"></td>
                                            @else
                                                @php
                                                    $badgeClass = match($day['status']) {
                                                        'P' => 'bg-success',
                                                        'WO' => 'bg-secondary', 
                                                        'LWP' => 'bg-warning',
                                                        'UL' => 'bg-info',
                                                        'TR' => 'bg-primary',
                                                        'LV' => 'bg-danger',
                                                        'HD' => 'bg-dark',
                                                        default => 'bg-light'
                                                    };
                                                @endphp
                                                <td class="text-center p-2">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <span class="fw-medium">{{ $day['date'] }}</span>
                                                        @if($day['status'])
                                                            <span class="badge {{ $badgeClass }} mt-1">{{ $day['status'] }}</span>
                                                        @else
                                                            <span class="badge bg-light text-muted mt-1">-</span>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Next Week Roster -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Next Week Roster</h5>
                </div>
                <div class="card-body">
                    @if(empty($nextWeekRoster))
                        <p class="text-muted mb-0">No week off days scheduled. WO can be marked on any day as needed.</p>
                    @else
                        <div class="row">
                            @foreach($nextWeekRoster as $day => $status)
                                <div class="col-md-6 col-12 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="fw-medium me-2">{{ $day }}:</span>
                                        <span class="badge bg-secondary">{{ $status }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function changeProfileMonth() {
    const month = document.getElementById('profileMonth').value;
    const year = document.getElementById('profileYear').value;
    window.location.href = `{{ route('profile') }}?month=${month}&year=${year}`;
}
</script>
@endsection