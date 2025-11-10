@extends('web.layouts.main')
@section('content')

<style>
.table-2 tbody td {
    padding: 6px 8px !important;
    border: 1px solid var(--border);
    vertical-align: middle;
    font-size: 12px;
    color: var(--text-dark);
    background: #fff;
}
</style>

<!--  Content Wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">

    <!--  Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">
        <div>
            <h2 class="lob-title mb-1">
                <span class="iconify" data-icon="mdi:phone-log-outline"
                    style="vertical-align: middle; font-size: 14px"></span>
                Call Logs
            </h2>
        </div>

        <!--  Breadcrumb -->
        <nav aria-label="breadcrumb" class="lob__breadcrumb">
            <ol class="lob__breadcrumb-list mb-0">
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('user.dashboard') }}" class=" lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:view-dashboard-outline"></span>
                        Dashboard
                    </a>
                </li>
                <li class="lob__breadcrumb-item active" aria-current="page">
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:phone-log-outline"></span>
                    Call Logs
                </li>
            </ol>
        </nav>
    </div>

    <!--  Main Row -->
    <div class="row gy-4">
        <div class="col-12">

            <!-- Flash Messages -->
            @if(session('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
            @endif

            <!--  Call Logs Card -->
            <div class="lob-card p-4">

                <!-- Filter Form -->
                <form method="GET" action="{{ route('call-logs.index') }}" class=" filter-form lob-filter p-4
                                        rounded-3">
                    <div class="row g-4 align-items-end">

                        <!-- Keyword Search -->
                        <div class="col-md-4 position-relative">
                            <div class="floating-group lob-card">
                                <input type="text" name="keyword" id="keyword" class="form-control input-style w-100"
                                    placeholder=" " value="{{ request('keyword') }}">
                                <label for=" keyword" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:account-search-outline"></span>
                                    Keyword (PNR / Name / Email / Contact)
                                </label>
                            </div>
                        </div>

                        <!-- Start Date -->
                        <div class="col-md-2 position-relative">
                            <div class="floating-group lob-card">
                                <input type="date" name="start_date" id="start_date" class="form-control input-style"
                                    value="{{ request('start_date') }}">
                                <label for=" start_date" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:calendar-start"></span>
                                    Start Date
                                </label>
                            </div>
                        </div>

                        <!-- End Date -->
                        <div class="col-md-2 position-relative">
                            <div class="floating-group lob-card">
                                <input type="date" name="end_date" id="end_date" class="form-control input-style"
                                    value="{{ request('end_date') }}">
                                <label for=" end_date" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:calendar-end"></span>
                                    End Date
                                </label>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit"
                                class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2 button-style">
                                <span class="iconify fs-5" data-icon="mdi:magnify"></span> Search
                            </button>
                        </div>

                        <!-- Add New -->
                        <div class="col-md-2 d-flex align-items-end">
                            <a href="{{ route('call-logs.create') }}" class=" btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2
                                                    button-style" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Add New Entry">
                                <span class="iconify" data-icon="mdi:plus-circle-outline"></span> Add New Logs
                            </a>
                        </div>
                    </div>
                </form>

                <!--  Table Section -->
                <div class="table-container table-2 mt-3">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Booking Type</th>
                                <th>PNR</th>
                                <th>Created On</th>
                                <th>Pax Name</th>
                                <th>Contact</th>
                                <th>Campaign</th>
                                <th>Reservation Source</th>
                                <th>Converted</th>
                                <th>Follow-up Date</th>
                                @if(!(auth()->user()->role == 'User' && auth()->user()->departments == 'Sales'))
                                <th>Agent</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($callLogs as $key => $log)
                            <tr>
                                <td>
                                    <a href="{{ route('call-logs.edit', encode($log->id)) }}">
                                        {{ $callLogs->firstItem() + $key }}
                                    </a>
                                </td>

                                <!-- Booking Type Icons -->
                                <td>
                                    <a href=" {{ route('call-logs.edit', encode($log->id)) }}">
                                        <div class="d-flex justify-content-center gap-2">
                                            @if($log->chkflight)
                                            <i class="ri ri-flight-takeoff-line text-primary fs-5" title="Flight"></i>
                                            @endif
                                            @if($log->chkhotel)
                                            <i class="ri ri-hotel-fill text-warning fs-5" title="Hotel"></i>
                                            @endif
                                            @if($log->chkcruise)
                                            <i class="ri ri-ship-fill text-info fs-5" title="Cruise"></i>
                                            @endif
                                            @if($log->chkcar)
                                            <i class="ri ri-car-fill text-success fs-5" title="Car"></i>
                                            @endif
                                            @if($log->chktrain)
                                            <i class="ri ri-train-line text-purple fs-5" title="Train"></i>
                                            @endif
                                        </div>
                                    </a>
                                </td>

                                <td>{{ $log->pnr }}</td>
                                <td>{{ $log->created_at->format('d-m-Y H:i:s') }}</td>
                                <td>{{ $log->name }}</td>

                                <!-- Phone Format -->
                                <td>
                                    @php
                                    $phone = $log->phone;
                                    $countryCode = $log->country_code ?? 'US';
                                    $countryCodes = [
                                    'US' => '+1',
                                    'CA' => '+1',
                                    'GB' => '+44',
                                    'AU' => '+61',
                                    'IN' =>
                                    '+91',
                                    'DE' => '+49',
                                    'FR' => '+33',
                                    'MX' => '+52'
                                    ];
                                    $code = $countryCodes[$countryCode] ?? '+1';
                                    if ($phone && !str_starts_with($phone, '+')) {
                                    $digits = preg_replace('/\D/', '', $phone);
                                    $codeDigits = preg_replace('/\D/', '', $code);
                                    if (str_starts_with($digits, $codeDigits)) {
                                    $digits = substr($digits, strlen($codeDigits));
                                    }
                                    if (strlen($digits) > 6) {
                                    $formatted = substr($digits, 0, 3) . ' ' . substr($digits, 3, 3) . ' ' .
                                    substr($digits, 6);
                                    } elseif (strlen($digits) > 3) {
                                    $formatted = substr($digits, 0, 3) . ' ' . substr($digits, 3);
                                    } else {
                                    $formatted = $digits;
                                    }
                                    $displayPhone = $code . ' ' . $formatted;
                                    } else {
                                    $displayPhone = $phone;
                                    }
                                    @endphp
                                    {{ $displayPhone }}
                                </td>
                                <td>{{ $log->campaign ? $log->campaign->name : 'No Campaign' }}</td>
                                <td>{{ $log->reservation_source }}</td>
                                <td>
                                    @if($log->call_converted)
                                    <span class="iconify text-success fs-5" data-icon="mdi:check-circle-outline"
                                        title="Converted"></span>
                                    @else
                                    <span class="iconify text-danger fs-5" data-icon="mdi:close-circle-outline"
                                        title="Not Converted"></span>
                                    @endif
                                </td>
                                <td>{{ $log->updated_at->format('d-m-Y H:i:s') }}</td>

                                @if(!(auth()->user()->role == 'User' && auth()->user()->departments == 'Sales'))
                                <td>{{ $log->user_name }}</td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="text-center">No call logs available.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination-container mt-3">
                        {{ $callLogs->links('pagination::bootstrap-4') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection