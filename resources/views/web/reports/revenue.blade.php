@extends('web.layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Revenue Report</h2>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Campaign</label>
                    <select name="campaign_id" class="form-select">
                        <option value="">All Campaigns</option>
                        @foreach($campaigns as $campaign)
                            <option value="{{ $campaign->id }}" {{ request('campaign_id') == $campaign->id ? 'selected' : '' }}>
                                {{ $campaign->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Date From</label>
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Date To</label>
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('reports.revenue') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">${{ number_format($stats['total_net_value'], 2) }}</h5>
                    <p class="card-text">Total Net Value</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">${{ number_format($stats['total_gross_mco'], 2) }}</h5>
                    <p class="card-text">Total Gross MCO</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">{{ $stats['total_bookings'] }}</h5>
                    <p class="card-text">Total Bookings</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h6>Campaign Wise Revenue</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Campaign</th>
                            <th>Net Value</th>
                            <th>Gross MCO</th>
                            <th>Bookings</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['by_campaign'] as $stat)
                        <tr>
                            <td>Campaign {{ $stat->campaign }}</td>
                            <td>${{ number_format($stat->total_net_value, 2) }}</td>
                            <td>${{ number_format($stat->total_gross_mco, 2) }}</td>
                            <td>{{ $stat->total_bookings }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Booking ID</th>
                            <th>Campaign</th>
                            <th>Customer</th>
                            <th>Net Value</th>
                            <th>Gross MCO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->campaign }}</td>
                            <td>{{ $booking->customer_name ?? 'N/A' }}</td>
                            <td>${{ number_format($booking->net_value, 2) }}</td>
                            <td>${{ number_format($booking->gross_mco, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection