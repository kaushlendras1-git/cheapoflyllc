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
                <span class="iconify" data-icon="mdi:account-group-outline"
                    style="vertical-align: middle; font-size: 14px"></span>
                Team Reports
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
                    Team Reports
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
                <form method="GET" action="{{ route('reports.team') }}"
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

                    <!-- LOB -->
                    <div class="col-md-2 position-relative">
                        <div class="floating-group lob-card">
                            <select name="lob" id="lob" class="form-control input-style w-100">
                                <option value="">Select LOB</option>
                                @foreach($lobs as $lob)
                                <option value="{{ $lob->id }}" {{ request('lob') == $lob->id ? 'selected' : '' }}>
                                    {{ $lob->name }}
                                </option>
                                @endforeach
                            </select>
                            <label for="lob" class="form-label">
                                <span class="iconify me-1" data-icon="mdi:office-building-outline"></span>
                                LOB
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
                        <a href="{{ route('reports.team.export', request()->query()) }}"
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
                                    <th>Date</th>
                                    <th>Agent Name</th>
                                    <th>Gross Amount</th>
                                    <th>Net Amount</th>
                                    <th>Net Profit</th>
                                    <th>QC Score</th>
                                    <th>Booking Status</th>
                                    <th>Payment Status</th>
                                    <th>Email Status</th>
                                    <th>Auth Status</th>
                                    <th>RPC</th>
                                    <th>Conversion</th>
                                    <th>No of Calls</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $index => $booking)
                                <tr>
                                    <td>{{ $bookings->firstItem() + $index }}</td>
                                    <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                    <td>${{ number_format($booking->gross_value ?? 0, 2) }}</td>
                                    <td>${{ number_format($booking->net_value ?? 0, 2) }}</td>
                                    <td>${{ number_format($booking->net_profit ?? 0, 2) }}</td>
                                    <td>{{ $booking->qc_score ?? 'N/A' }}</td>
                                    <td>{{ $booking->bookingStatus->name ?? 'N/A' }}</td>
                                    <td>{{ $booking->paymentStatus->name ?? 'N/A' }}</td>
                                    <td><span class="badge bg-label-success">Sent</span></td>
                                    <td><span class="badge bg-label-success">Authorized</span></td>
                                    <td>-</td>
                                    <td>Standard</td>
                                    <td>1</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="14" class="text-center">No records found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        {{ $bookings->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

            <!--  Chart Section -->
            <div class="lob-card p-4 mt-4">
                <h5 class="mb-3 fw-semibold text-dark d-flex align-items-center gap-2"
                    style="font-size: 14px; color: #1c316d;">
                    <span class="iconify" data-icon="mdi:chart-timeline-variant"></span>
                    Team Performance Chart
                </h5>
                <canvas id="teamChart" height="120"></canvas>
            </div>

        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('teamChart').getContext('2d');
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
                label: 'Booking Count',
                data: chartData.booking_counts,
                borderColor: getComputedStyle(document.documentElement).getPropertyValue('--info').trim(),
                backgroundColor: 'rgba(22, 177, 255, 0.1)',
                tension: 0.3,
                fill: true,
                borderWidth: 2,
                yAxisID: 'y1'
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
            },
            y1: {
                beginAtZero: true,
                position: 'right',
                grid: {
                    drawOnChartArea: false
                },
                ticks: {
                    color: getComputedStyle(document.documentElement).getPropertyValue('--text-dark')
                },
                title: {
                    display: true,
                    text: 'Booking Count'
                }
            }
        }
    }
});
</script>

@endsection