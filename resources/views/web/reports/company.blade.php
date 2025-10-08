@extends('web.layouts.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Company Reports</h2>
        <div class="breadcrumb">
            <a class="active" href="#">Dashboard</a>
            <a class="active" aria-current="page">Company Reports</a>
        </div>
    </div>
    
    <div class="row gy-6">
        <div class="col-md-12">
            @include('web.layouts.flash')
            
            <div class="card p-4">
                <form method="GET" action="{{ route('reports.company') }}">
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
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">Campaign</label>
                                <select name="campaign" class="form-select input-style w140">
                                    <option value="">Select Campaign</option>
                                    @foreach($campaigns as $campaign)
                                        <option value="{{ $campaign->id }}" {{ request('campaign') == $campaign->id ? 'selected' : '' }}>
                                            {{ $campaign->name }}
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
                            <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Export To Excel" href="{{ route('reports.company.export', request()->query()) }}" class="btn btn-success px-4 py-3 gap-1 w-auto button-style">
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
                                <th>LOBs</th>
                                <th>Agent Profit Reports</th>
                                <th>Call Cost</th>
                                <th>Gross Amount</th>
                                <th>Net Amount</th>
                                <th>Charge Back</th>
                                <th>Refund</th>
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
                            @forelse($lobReports as $index => $lob)
                                <tr>
                                    <td>{{ $lobReports->firstItem() + $index }}</td>
                                    <td><strong>{{ $lob->name }}</strong></td>
                                    <td><span class="text-success">${{ number_format($lob->net_profit ?? 0, 2) }}</span></td>
                                    <td><span class="text-info">${{ number_format($lob->call_cost ?? 0, 2) }}</span></td>
                                    <td>${{ number_format($lob->gross_amount ?? 0, 2) }}</td>
                                    <td>${{ number_format($lob->net_amount ?? 0, 2) }}</td>
                                    <td><span class="text-danger">${{ number_format($lob->charge_back ?? 0, 2) }}</span></td>
                                    <td><span class="text-warning">${{ number_format($lob->refund ?? 0, 2) }}</span></td>
                                    <td><span class="text-success">${{ number_format($lob->net_profit ?? 0, 2) }}</span></td>
                                    <td><span class="badge bg-primary">{{ number_format($lob->avg_qc_score ?? 0, 1) }}</span></td>
                                    <td>{{ $lob->booking_status_count }}</td>
                                    <td>{{ $lob->payment_status_count }}</td>
                                    <td><span class="badge bg-success">Sent</span></td>
                                    <td><span class="badge bg-success">Authorized</span></td>
                                    <td>{{ $lob->total_bookings }}</td>
                                    <td>Standard</td>
                                    <td>{{ $lob->no_of_calls ?? 0 }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="17" class="text-center">No records found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-3">
                        {{ $lobReports->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
                
                <!-- Chart Section -->
                <div class="mt-5">
                    <h4>Company Performance Chart</h4>
                    <canvas id="companyChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('companyChart').getContext('2d');
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
            label: 'Net Profit ($)',
            data: chartData.net_profits,
            borderColor: 'rgb(54, 162, 235)',
            backgroundColor: 'rgba(54, 162, 235, 0.1)',
            tension: 0.1,
            fill: true
        }, {
            label: 'Charge Back ($)',
            data: chartData.charge_backs,
            borderColor: 'rgb(255, 205, 86)',
            backgroundColor: 'rgba(255, 205, 86, 0.1)',
            tension: 0.1,
            fill: true
        }, {
            label: 'Refund ($)',
            data: chartData.refunds,
            borderColor: 'rgb(153, 102, 255)',
            backgroundColor: 'rgba(153, 102, 255, 0.1)',
            tension: 0.1,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Company Performance Overview'
            },
            legend: {
                display: true,
                position: 'top'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Amount ($)'
                }
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
.text-info {
    font-weight: 600;
}
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}
</style>

@endsection