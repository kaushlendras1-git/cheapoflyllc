@extends('web.layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
            <h2 class="mb-0">Campaign Wise Calls Report</h2>
        </div>

        <div class="card p-4 mb-4">
            <div class="d-flex justify-content-between">
                <form method="GET" class="marketing-upper-form mb-4 d-flex booking-form gen_form flex-wrap">
                    <!-- Campaign Filter -->
                    <div class="me-4 position-relative mb-3 ">
                        <label class="form-label mb-1">Campaign</label>
                        <select name="campaign_id" class="form-select input-style w180">
                            <option value="">All Campaigns</option>
                            @foreach($campaigns as $campaign)
                                <option value="{{ $campaign->id }}" {{ request('campaign_id') == $campaign->id ? 'selected' : '' }}>
                                    {{ $campaign->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date From -->
                    <div class="me-4 position-relative mb-3 ">
                        <label class="form-label mb-1">Date From</label>
                        <input type="date" name="date_from" class="form-control input-style" value="{{ request('date_from') }}">
                    </div>

                    <!-- Date To -->
                    <div class="me-4 position-relative mb-3 ">
                        <label class="form-label mb-1">Date To</label>
                        <input type="date" name="date_to" class="form-control input-style" value="{{ request('date_to') }}">
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 mb-3 ">
                        <button type="submit" class="btn btn-primary px-4 py-3 d-flex align-items-center gap-1 button-style">
                            <i class="ri ri-search-line fs-5"></i> Filter
                        </button>
                        <a href="{{ route('reports.campaign-calls') }}"
                            class="btn btn-label-secondary px-4 py-3 d-flex align-items-center gap-1 button-style">
                            <i class="ri ri-refresh-line fs-5"></i> Reset
                        </a>
                    </div>
                </form>

                <!-- Export Button (Optional, consistent with design) -->
                <div class="add-follow-btn export-btn">
                    <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Export To Excel" href="#"
                        class="btn btn-success px-4 py-3 gap-1 w-auto button-style">
                        <i class="ri ri-file-excel-2-line fs-5"></i>
                    </a>
                </div>
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
            <div class="booking-table-wrapper py-2 crm-table">
                <table class="table table-hover table-sm booking-table w-100 mb-0">
                    <thead class="bg-dark text-white sticky-top">
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