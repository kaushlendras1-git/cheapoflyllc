@extends('web.layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Campaign Wise Calls Report</h2>
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
                        <a href="{{ route('reports.campaign-calls') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">{{ $stats['total_calls'] }}</h5>
                    <p class="card-text">Total Calls</p>
                </div>
            </div>
        </div>
        @foreach($stats['by_campaign'] as $stat)
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">{{ $stat->total }}</h5>
                    <p class="card-text">{{ $stat->campaign->name ?? 'Unknown' }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Campaign</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Call Type</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($callLogs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $log->campaign->name ?? 'N/A' }}</td>
                            <td>{{ $log->customer_name }}</td>
                            <td>{{ $log->phone }}</td>
                            <td>{{ $log->call_type }}</td>
                            <td>{{ $log->duration ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $callLogs->links() }}
        </div>
    </div>
</div>
@endsection