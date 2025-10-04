@extends('web.layouts.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Team Reports</h2>
        <div class="breadcrumb">
            <a class="active" href="#">Dashboard</a>
            <a class="active" aria-current="page">Team Reports</a>
        </div>
    </div>
    
    <div class="row gy-6">
        <div class="col-md-12">
            @include('web.layouts.flash')
            
            <div class="card p-4">
                <form method="GET" action="{{ route('reports.team') }}">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="marketing-upper-form mb-5 d-flex booking-form gen_form">
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">Period</label>
                                <select name="period" class="form-select input-style w130">
                                    <option value="">Select Period</option>
                                    <option value="daily" {{ request('period') == 'daily' ? 'selected' : '' }}>Daily</option>
                                    <option value="weekly" {{ request('period') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                    <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                </select>
                            </div>
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">Start Date</label>
                                <input type="date" name="start_date" class="form-control input-style" value="{{ request('start_date') }}">
                            </div>
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">End Date</label>
                                <input type="date" name="end_date" class="form-control input-style" value="{{ request('end_date') }}">
                            </div>
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">Booking Status</label>
                                <select name="booking_status" class="form-select input-style w140">
                                    <option value="">Booking Status</option>
                                    @foreach($bookingStatuses as $status)
                                        <option value="{{ $status->id }}" {{ request('booking_status') == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">Payment Status</label>
                                <select name="payment_status" class="form-select input-style w140">
                                    <option value="">Payment Status</option>
                                    @foreach($paymentStatuses as $status)
                                        <option value="{{ $status->id }}" {{ request('payment_status') == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">LOB</label>
                                <select name="lob" class="form-select input-style w140">
                                    <option value="">Select LOB</option>
                                    @foreach($lobs as $lob)
                                        <option value="{{ $lob->id }}" {{ request('lob') == $lob->id ? 'selected' : '' }}>
                                            {{ $lob->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">Team</label>
                                <select name="team" class="form-select input-style w140">
                                    <option value="">Select Team</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ request('team') == $team->id ? 'selected' : '' }}>
                                            {{ $team->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary px-4 py-3 d-flex align-items-center gap-1 button-style m-auto">
                                    <i class="ri ri-search-line fs-5"></i> Search
                                </button>
                            </div>
                        </div>
                        <div class="add-follow-btn export-btn">
                            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Export To Excel" href="#" class="btn btn-success px-4 py-3 gap-1 w-auto button-style">
                                <i class="ri ri-file-excel-2-line fs-5"></i>
                            </a>
                        </div>
                    </div>
                </form>
                
                <div class="booking-table-wrapper py-2 crm-table">
                    <table class="table table-hover table-sm booking-table w-100 mb-0">
                        <thead class="bg-dark text-white sticky-top">
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
                                <th>Convention</th>
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
                                    <td><span class="badge bg-success">Sent</span></td>
                                    <td><span class="badge bg-success">Authorized</span></td>
                                    <td>{{ $booking->pnr ?? 'N/A' }}</td>
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
                    
                    <div class="mt-3">
                        {{ $bookings->appends(request()->query())->links() }}
                    </div>
                </div>
                
                <!-- Chart Section -->
                <div class="mt-5">
                    <h4>Performance Chart</h4>
                    <canvas id="teamChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

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
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.1)',
            tension: 0.1,
            fill: true
        }, {
            label: 'Net Amount ($)',
            data: chartData.net_amounts,
            borderColor: 'rgb(255, 99, 132)',
            backgroundColor: 'rgba(255, 99, 132, 0.1)',
            tension: 0.1,
            fill: true
        }, {
            label: 'Booking Count',
            data: chartData.booking_counts,
            borderColor: 'rgb(54, 162, 235)',
            backgroundColor: 'rgba(54, 162, 235, 0.1)',
            tension: 0.1,
            yAxisID: 'y1',
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Team Performance Over Time'
            },
            legend: {
                display: true,
                position: 'top'
            }
        },
        scales: {
            y: {
                type: 'linear',
                display: true,
                position: 'left',
                title: {
                    display: true,
                    text: 'Amount ($)'
                }
            },
            y1: {
                type: 'linear',
                display: true,
                position: 'right',
                title: {
                    display: true,
                    text: 'Booking Count'
                },
                grid: {
                    drawOnChartArea: false,
                },
            }
        }
    }
});
</script>

<style>
.table th {
    background-color: #343a40 !important;
    color: white !important;
    font-weight: 600;
    font-size: 0.85rem;
}
.table td {
    font-size: 0.8rem;
    vertical-align: middle;
}
.badge {
    font-size: 0.75rem;
}
.text-success {
    font-weight: 600;
}
.text-danger {
    font-weight: 600;
}
.text-warning {
    font-weight: 600;
}
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}
</style>

@endsection