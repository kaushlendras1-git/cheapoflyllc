@extends('web.layouts.main')
@section('content')

<style>
.table-2 tbody td {
    padding: 4px 16px !important;
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
                <span class="iconify" data-icon="mdi:office-building-outline"
                    style="vertical-align: middle; font-size: 14px"></span>
                Unit Reports (Manager)
            </h2>
        </div>

        <!--  Breadcrumb -->
        <nav aria-label="breadcrumb" class="lob__breadcrumb">
            <ol class="lob__breadcrumb-list mb-0">
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('user.dashboard') }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:view-dashboard-outline"></span>
                        Dashboard
                    </a>
                </li>
                <li class="lob__breadcrumb-item active" aria-current="page">
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:chart-box-outline"></span>
                    Unit Reports
                </li>
            </ol>
        </nav>
    </div>

    <!--  Main Row -->
    <div class="row gy-4">
        <div class="col-12">

            <!-- Flash Messages -->
            @include('web.layouts.flash')

            <!--  Filter Card -->
            <div class="lob-card p-4">
                <form method="GET" action="{{ route('reports.unit') }}"
                    class="filter-form lob-filter p-4 rounded-3 d-flex flex-wrap align-items-end gap-3">

                    <!-- Period -->
                    <div class="col-md-2 position-relative">
                        <div class="floating-group lob-card">
                            <select name="period" id="period" class="form-control input-style w-100">
                                <option value="">Select Period</option>
                                <option value="daily" {{ request('period') == 'daily' ? 'selected' : '' }}>Daily
                                </option>
                                <option value="weekly" {{ request('period') == 'weekly' ? 'selected' : '' }}>Weekly
                                </option>
                                <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>Monthly
                                </option>
                            </select>
                            <label for="period" class="form-label">
                                <span class="iconify me-1" data-icon="mdi:calendar-clock-outline"></span>
                                Period
                            </label>
                        </div>
                    </div>

                    <!-- Start Date -->
                    <div class="col-md-2 position-relative">
                        <div class="floating-group lob-card">
                            <input type="date" name="start_date" id="start_date" class="form-control input-style"
                                value="{{ request('start_date') }}">
                            <label for="start_date" class="form-label">
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
                            <label for="end_date" class="form-label">
                                <span class="iconify me-1" data-icon="mdi:calendar-end"></span>
                                End Date
                            </label>
                        </div>
                    </div>

                    <!-- Booking Status -->
                    <div class="col-md-2 position-relative">
                        <div class="floating-group lob-card">
                            <select name="booking_status" id="booking_status" class="form-control input-style w-100">
                                <option value="">Booking Status</option>
                                @foreach($bookingStatuses as $status)
                                <option value="{{ $status->id }}"
                                    {{ request('booking_status') == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                                @endforeach
                            </select>
                            <label for="booking_status" class="form-label">
                                <span class="iconify me-1" data-icon="mdi:book-check-outline"></span>
                                Booking Status
                            </label>
                        </div>
                    </div>

                    <!-- Payment Status -->
                    <div class="col-md-2 position-relative">
                        <div class="floating-group lob-card">
                            <select name="payment_status" id="payment_status" class="form-control input-style w-100">
                                <option value="">Payment Status</option>
                                @foreach($paymentStatuses as $status)
                                <option value="{{ $status->id }}"
                                    {{ request('payment_status') == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                                @endforeach
                            </select>
                            <label for="payment_status" class="form-label">
                                <span class="iconify me-1" data-icon="mdi:credit-card-outline"></span>
                                Payment Status
                            </label>
                        </div>
                    </div>

                    <!-- Team -->
                    <div class="col-md-2 position-relative">
                        <div class="floating-group lob-card">
                            <select name="team" id="team" class="form-control input-style w-100">
                                <option value="">Select Team</option>
                                @foreach($teams as $team)
                                <option value="{{ $team->id }}" {{ request('team') == $team->id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                                @endforeach
                            </select>
                            <label for="team" class="form-label">
                                <span class="iconify me-1" data-icon="mdi:account-multiple-outline"></span>
                                Team
                            </label>
                        </div>
                    </div>

                    <!-- Campaign -->
                    <div class="col-md-2 position-relative">
                        <div class="floating-group lob-card">
                            <select name="campaign" id="campaign" class="form-control input-style w-100">
                                <option value="">Select Campaign</option>
                                @foreach($campaigns as $campaign)
                                <option value="{{ $campaign->id }}"
                                    {{ request('campaign') == $campaign->id ? 'selected' : '' }}>
                                    {{ $campaign->name }}
                                </option>
                                @endforeach
                            </select>
                            <label for="campaign" class="form-label">
                                <span class="iconify me-1" data-icon="mdi:bullhorn-outline"></span>
                                Campaign
                            </label>
                        </div>
                    </div>

                    <!-- Filter Button -->
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit"
                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2 button-style px-4 py-3">
                            <span class="iconify fs-5" data-icon="mdi:magnify"></span>
                            Search
                        </button>
                    </div>

                    <!-- Export Button -->
                    <div class="col-md-1 d-flex align-items-end">
                        <a href="{{ route('reports.unit.export', request()->query()) }}"
                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2 button-style px-4 py-3"
                            style="background-color: red !important;" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Export to Excel">
                            <span class="iconify fs-5" data-icon="mdi:file-excel-outline"></span>
                        </a>
                    </div>
                </form>
            </div>

            <!--  Table Section -->
            <div class="lob-card p-4 mt-4">
                <div class="table-container table-2">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Agent Name</th>
                                    <th>Charge Back</th>
                                    <th>Refund</th>
                                    <th>Gross Amount</th>
                                    <th>Net Amount</th>
                                    <th>Net Profit</th>
                                    <th>QC Score</th>
                                    <th>Booking Status</th>
                                    <th>Payment Status</th>
                                    <th>Email Status</th>
                                    <th>Auth Status</th>
                                    <th>RPC</th>
                                    <th>Convention</th>
                                    <th>No of Calls</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($agents as $index => $agent)
                                <tr>
                                    <td>{{ $agents->firstItem() + $index }}</td>
                                    <td>{{ $agent->name }}</td>
                                    <td><span
                                            class="text-danger">${{ number_format($agent->charge_back ?? 0, 2) }}</span>
                                    </td>
                                    <td><span class="text-warning">${{ number_format($agent->refund ?? 0, 2) }}</span>
                                    </td>
                                    <td>${{ number_format($agent->gross_amount ?? 0, 2) }}</td>
                                    <td>${{ number_format($agent->net_amount ?? 0, 2) }}</td>
                                    <td><span
                                            class="text-success">${{ number_format($agent->net_profit ?? 0, 2) }}</span>
                                    </td>
                                    <td><span class="badge bg-label-primary">
                                            {{ number_format($agent->avg_qc_score ?? 0, 1) }}
                                        </span>
                                    </td>
                                    <td>{{ $agent->booking_status_count }}</td>
                                    <td>{{ $agent->payment_status_count }}</td>
                                    <td><span class="badge bg-label-success">Sent</span></td>
                                    <td><span class="badge bg-label-success">Authorized</span></td>
                                    <td>{{ $agent->total_bookings }}</td>
                                    <td>Standard</td>
                                    <td>{{ $agent->no_of_calls ?? 0 }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="15" class="text-center">No records found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        {{ $agents->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

            <!--  Chart Section -->
            <div class="lob-card p-4 mt-4">
                <h5 class="mb-3 fw-semibold text-dark d-flex align-items-center gap-2"
                    style="font-size: 14px; color: #1c316d;!important">
                    <span class="iconify" data-icon="mdi:chart-timeline-variant"></span>
                    Unit Performance Chart
                </h5>
                <canvas id="unitChart" height="120"></canvas>
            </div>

        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('unitChart').getContext('2d');
const chartData = @json($chartData);

new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartData.labels,
        datasets: [{
                label: 'Gross Amount ($)',
                data: chartData.gross_amounts,
                borderColor: getComputedStyle(document.documentElement).getPropertyValue('--success')
                    .trim(),
                backgroundColor: 'rgba(78, 205, 196, 0.1)',
                tension: 0.3,
                fill: true,
                borderWidth: 2
            },
            {
                label: 'Net Amount ($)',
                data: chartData.net_amounts,
                borderColor: getComputedStyle(document.documentElement).getPropertyValue('--primary')
                    .trim(),
                backgroundColor: 'rgba(28, 49, 109, 0.1)',
                tension: 0.3,
                fill: true,
                borderWidth: 2
            },
            {
                label: 'Charge Back ($)',
                data: chartData.charge_backs,
                borderColor: getComputedStyle(document.documentElement).getPropertyValue('--danger').trim(),
                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                tension: 0.3,
                fill: true,
                borderWidth: 2
            },
            {
                label: 'Refund ($)',
                data: chartData.refunds,
                borderColor: getComputedStyle(document.documentElement).getPropertyValue('--warning')
                    .trim(),
                backgroundColor: 'rgba(255, 205, 86, 0.1)',
                tension: 0.3,
                fill: true,
                borderWidth: 2
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    color: getComputedStyle(document.documentElement).getPropertyValue('--text-dark')
                }
            },
            title: {
                display: false
            }
        },
        scales: {
            x: {
                grid: {
                    color: 'rgba(0,0,0,0.05)'
                },
                ticks: {
                    color: getComputedStyle(document.documentElement).getPropertyValue('--text-dark')
                }
            },
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0,0,0,0.05)'
                },
                ticks: {
                    color: getComputedStyle(document.documentElement).getPropertyValue('--text-dark')
                },
                title: {
                    display: true,
                    text: 'Amount ($)'
                }
            }
        }
    }
});
</script>

@endsection