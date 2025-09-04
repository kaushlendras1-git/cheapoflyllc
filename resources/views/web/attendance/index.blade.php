@extends('web.layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Attendance Management</h2>
        <div class="breadcrumb">
            <a class="active" href="{{ route('user.dashboard') }}">Dashboard</a>
            <a class="active" aria-current="page">Attendance</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ date('F Y', mktime(0,0,0,$month,1,$year)) }} Attendance</h5>
            <div class="d-flex gap-2">
                <select id="viewMonth" class="form-control" style="width: 120px; padding: 5px; font-size: 12px;" onchange="changeMonth()">
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $i == $month ? 'selected' : '' }}>{{ date('F', mktime(0,0,0,$i,1)) }}</option>
                    @endfor
                </select>
                <select id="viewYear" class="form-control" style="width: 100px; padding: 5px; font-size: 12px;" onchange="changeMonth()">
                    @foreach($availableYears as $y)
                        <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>


            </div>
        </div>
        <div class="card-body">
            <div class="row booking-form mb-4">
                <div class="col-md-2 position-relative mb-3">
                    <label class="form-label">Search Users</label>
                    <input type="text" id="userSearch" class="form-control" placeholder="Search by name..." onkeyup="filterUsers()">
                </div>
                <div class="col-md-2 position-relative mb-3">
                    <div class="btn-group" role="group">
                        <button class="btn btn-sm btn-outline-primary" style="padding: 5px; font-size: 12px;" onclick="changeWeek(-1)">← Prev</button>
                        <button class="btn btn-sm btn-outline-primary" style="padding: 5px; font-size: 12px;" onclick="changeWeek(0)">Current</button>
                        <button class="btn btn-sm btn-outline-primary" style="padding: 5px; font-size: 12px;" onclick="changeWeek(1)">Next →</button>
                    </div>
                </div>
                <div class="col-md-2 position-relative mb-3">
                    <label class="form-label">Status for Bulk Update</label>
                    <select id="bulkStatus" class="form-control">
                        <option value="">- (Clear)</option>
                        <option value="P">Present</option>
                        <option value="WO">Week Off</option>
                        <option value="LWP">Leave Without Pay</option>
                        <option value="UL">Unplanned Leave</option>
                        <option value="TR">Training</option>
                        <option value="LV">Leave</option>
                        <option value="HD">Half Day</option>
                    </select>
                </div>
                <div class="col-md-2 position-relative mb-3">
                    <label class="form-label">Select Day</label>
                    <select id="daySelect" class="form-control">
                        <option value="">Select Day</option>
                        @for($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2 position-relative mb-3">
                  
                    <div class="d-flex gap-1">
                        <button class="btn btn-sm btn-success" style="padding: 5px; font-size: 12px;" onclick="selectAllUsers()">
                            <i class="ri ri-check-line" style="width: 14px; height: 14px;"></i> All
                        </button>
                        <button class="btn btn-sm btn-primary" style="padding: 5px; font-size: 12px;" onclick="bulkUpdate()">
                            <i class="ri ri-refresh-line" style="width: 14px; height: 14px;"></i> Week
                        </button>
                        <button class="btn btn-sm btn-warning" style="padding: 5px; font-size: 12px;" onclick="bulkUpdateDay()">
                            <i class="ri ri-calendar-line" style="width: 14px; height: 14px;"></i> Day
                        </button>
                    </div>
                </div>
                <div class="col-md-2 position-relative mb-3">
                  
                    <button class="btn btn-sm btn-info" style="padding: 5px; font-size: 12px;" onclick="exportExcel()">
                        <i class="ri ri-file-excel-line" style="width: 14px; height: 14px;"></i> Export Excel
                    </button>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAllCheckbox" onchange="toggleAllUsers()"></th>
                            <th>User</th>
                            @for($i = 1; $i <= 31; $i++)
                                @php
                                    $date = sprintf('%04d-%02d-%02d', $year, $month, $i);
                                    $dayName = checkdate($month, $i, $year) ? date('D', strtotime($date)) : '';
                                @endphp
                                <th class="text-center" style="min-width: 50px;">
                                    <div>{{ $i }}</div>
                                    <small>{{ $dayName }}</small>
                                </th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody id="attendanceTableBody">
                        @foreach($users as $user)
                        <tr>
                            <td><input type="checkbox" class="user-checkbox" value="{{ $user->id }}"></td>
                            <td>{{ $user->name }}</td>
                            @for($day = 1; $day <= 31; $day++)
                                @php
                                    $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
                                    $attendance = $user->attendances()->where('attendance_date', $date)->first();
                                    $status = $attendance ? $attendance->status : '';
                                    $isValidDate = checkdate($month, $day, $year);
                                @endphp
                                <td class="text-center p-1 {{ !$isValidDate ? 'bg-light' : '' }}">
                                    @if($isValidDate)
                                        <select class="form-select form-select-sm attendance-select" 
                                                data-user="{{ $user->id }}" 
                                                data-date="{{ $date }}" 
                                                style="font-size: 10px; padding: 2px;">
                                            <option value="" {{ $status == '' ? 'selected' : '' }}>-</option>
                                            <option value="P" {{ $status == 'P' ? 'selected' : '' }}>P</option>
                                            <option value="WO" {{ $status == 'WO' ? 'selected' : '' }}>WO</option>
                                            <option value="LWP" {{ $status == 'LWP' ? 'selected' : '' }}>LWP</option>
                                            <option value="UL" {{ $status == 'UL' ? 'selected' : '' }}>UL</option>
                                            <option value="TR" {{ $status == 'TR' ? 'selected' : '' }}>TR</option>
                                            <option value="LV" {{ $status == 'LV' ? 'selected' : '' }}>LV</option>
                                            <option value="HD" {{ $status == 'HD' ? 'selected' : '' }}>HD</option>
                                        </select>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.week-highlight {
    background-color: #e3f2fd !important;
    border: 2px solid #2196f3 !important;
}

.attendance-select {
    width: 60px;
    font-size: 10px;
    padding: 2px 4px;
}

.table th, .table td {
    vertical-align: middle;
    text-align: center;
}

.table th:first-child, .table td:first-child {
    text-align: left;
}

.table th:nth-child(2), .table td:nth-child(2) {
    text-align: left;
    min-width: 120px;
    position: sticky;
    left: 0;
    background-color: white;
    z-index: 10;
    border-right: 2px solid #dee2e6;
}

.table th:first-child, .table td:first-child {
    position: sticky;
    left: 0;
    background-color: white;
    z-index: 11;
    border-right: 2px solid #dee2e6;
}
</style>

<script>
let currentWeekOffset = 0;

function selectAllUsers() {
    document.getElementById('selectAllCheckbox').checked = true;
    toggleAllUsers();
}

function toggleAllUsers() {
    const selectAll = document.getElementById('selectAllCheckbox');
    const checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(cb => cb.checked = selectAll.checked);
}

function bulkUpdate() {
    const selectedUsers = Array.from(document.querySelectorAll('.user-checkbox:checked')).map(cb => cb.value);
    const status = document.getElementById('bulkStatus').value;
    
    if (selectedUsers.length === 0) {
        alert('Please select at least one user');
        return;
    }
    
    if (confirm(`Update attendance status to ${status} for ${selectedUsers.length} user(s)?`)) {
        // Get current week dates
        const dates = getCurrentWeekDates();
        
        selectedUsers.forEach(userId => {
            dates.forEach(date => {
                const select = document.querySelector(`select[data-user="${userId}"][data-date="${date}"]`);
                if (select) {
                    select.value = status;
                    updateAttendance(userId, date, status);
                }
            });
        });
    }
}

function bulkUpdateDay() {
    const day = document.getElementById('daySelect').value;
    const status = document.getElementById('bulkStatus').value;
    
    if (!day) {
        alert('Please select a day');
        return;
    }
    
    if (confirm(`Update all users' attendance to ${status || 'clear'} for day ${day}?`)) {
        const year = {{ $year }};
        const month = {{ $month }};
        const date = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        
        // Update all users for this day
        document.querySelectorAll(`select[data-date="${date}"]`).forEach(select => {
            select.value = status;
            const userId = select.dataset.user;
            updateAttendance(userId, date, status);
        });
    }
}

function getCurrentWeekDates() {
    const today = new Date();
    const currentDate = new Date(today.getFullYear(), today.getMonth(), today.getDate() + (currentWeekOffset * 7));
    const monday = new Date(currentDate);
    const dayOfWeek = currentDate.getDay();
    const diff = dayOfWeek === 0 ? -6 : 1 - dayOfWeek; // Monday = 1
    monday.setDate(currentDate.getDate() + diff);
    
    const dates = [];
    for (let i = 0; i < 7; i++) {
        const date = new Date(monday);
        date.setDate(monday.getDate() + i);
        dates.push(date.toISOString().split('T')[0]);
    }
    return dates;
}

function changeWeek(offset) {
    currentWeekOffset += offset;
    highlightCurrentWeek();
}

function highlightCurrentWeek() {
    // Remove previous highlights
    document.querySelectorAll('.week-highlight').forEach(el => el.classList.remove('week-highlight'));
    
    // Highlight current week columns
    const dates = getCurrentWeekDates();
    dates.forEach(date => {
        const day = parseInt(date.split('-')[2]);
        const columns = document.querySelectorAll(`td:nth-child(${day + 2})`);
        columns.forEach(col => col.classList.add('week-highlight'));
    });
}

function updateAttendance(userId, date, status) {
    fetch('{{ route("attendance.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            user_id: userId,
            attendance_date: date,
            status: status
        })
    });
}

// Auto-save on select change
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('attendance-select')) {
        const userId = e.target.dataset.user;
        const date = e.target.dataset.date;
        const status = e.target.value;
        updateAttendance(userId, date, status);
    }
});

function exportExcel() {
    const month = document.getElementById('viewMonth').value;
    window.open(`{{ route('attendance.export') }}?month=${month}`, '_blank');
}

function changeMonth() {
    const month = document.getElementById('viewMonth').value;
    const year = document.getElementById('viewYear').value;
    window.location.href = `{{ route('attendance.index') }}?month=${month}&year=${year}`;
}

function filterUsers() {
    const searchTerm = document.getElementById('userSearch').value.toLowerCase();
    const rows = document.querySelectorAll('#attendanceTableBody tr');
    
    rows.forEach(row => {
        const userName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        if (userName.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    highlightCurrentWeek();
});
</script>
@endsection