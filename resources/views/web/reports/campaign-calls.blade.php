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
                <span class="iconify" data-icon="mdi:phone-in-talk-outline"
                    style="vertical-align: middle; font-size: 14px"></span>
                Campaign Wise Calls Report
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
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:phone-outline"></span>
                    Campaign Calls
                </li>
            </ol>
        </nav>
    </div>

    <!--  Main Row -->
    <div class="row gy-4">
        <div class="col-12">

            <!-- Flash Messages -->
            @include('web.layouts.flash')

            <!--  Campaign Filter Card -->
            <div class="lob-card p-4">

                <form method="GET" class="filter-form lob-filter p-4 rounded-3 d-flex flex-wrap align-items-end gap-3">
                    <!-- Campaign Filter -->
                    <div class="col-md-3 position-relative">
                        <div class="floating-group lob-card">
                            <select name="campaign_id" id="campaign_id" class="form-control input-style w-100">
                                <option value="">All Campaigns</option>
                                @foreach($campaigns as $campaign)
                                <option value="{{ $campaign->id }}"
                                    {{ request('campaign_id') == $campaign->id ? 'selected' : '' }}>
                                    {{ $campaign->name }}
                                </option>
                                @endforeach
                            </select>
                            <label for="campaign_id" class="form-label">
                                <span class="iconify me-1" data-icon="mdi:bullhorn-outline"></span>
                                Campaign
                            </label>
                        </div>
                    </div>

                    <!-- Date From -->
                    <div class="col-md-2 position-relative">
                        <div class="floating-group lob-card">
                            <input type="date" name="date_from" id="date_from" class="form-control input-style"
                                placeholder=" " value="{{ request('date_from') }}">
                            <label for="date_from" class="form-label">
                                <span class="iconify me-1" data-icon="mdi:calendar-start"></span>
                                Date From
                            </label>
                        </div>
                    </div>

                    <!-- Date To -->
                    <div class="col-md-2 position-relative">
                        <div class="floating-group lob-card">
                            <input type="date" name="date_to" id="date_to" class="form-control input-style"
                                placeholder=" " value="{{ request('date_to') }}">
                            <label for="date_to" class="form-label">
                                <span class="iconify me-1" data-icon="mdi:calendar-end"></span>
                                Date To
                            </label>
                        </div>
                    </div>

                    <!-- Filter Button -->
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit"
                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2 button-style px-4 py-3">
                            <span class="iconify fs-5" data-icon="mdi:magnify"></span>
                            Filter
                        </button>
                    </div>

                    <!-- Reset Button -->
                    <div class="col-md-1 d-flex align-items-end">
                        <a href="{{ route('reports.campaign-calls') }}"
                            class="btn btn-primary btn-gray  w-100 d-flex align-items-center justify-content-center gap-2 button-style px-4 py-3">
                            <span class="iconify fs-5" data-icon="mdi:refresh"></span>
                            Reset
                        </a>
                    </div>

                    <!-- Export Button -->
                    <div class="col-md-1 d-flex align-items-end">
                        <a href="#"
                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2 button-style px-4 py-3"
                            style="background-color: red !important;" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Export to Excel">
                            <span class="iconify fs-5" data-icon="mdi:file-excel-outline"></span>
                        </a>
                    </div>
                </form>
            </div>


            <!--   Stats Cards Section -->
            <div class="campaign-stats-row d-flex flex-nowrap gap-3 mt-4 overflow-auto">
                <!-- Sticky Total Calls Card -->
                <div class="campaign-stats-card text-center flex-shrink-0 sticky-card">
                    <h5 class="fw-bold mb-1 total-calls">{{ $stats['total_calls'] }}</h5>
                    <p class="text-muted mb-0">Total Calls</p>
                </div>

                @foreach($stats['by_campaign'] as $stat)
                <div class="campaign-stats-card text-center flex-shrink-0">
                    <h5 class="fw-bold mb-1">{{ $stat->total }}</h5>
                    <p class="text-muted mb-0">{{ $stat->campaign->name ?? 'Unknown' }}</p>
                </div>
                @endforeach
            </div>


            <!--  Calls Table -->
            <div class="lob-card p-4 mt-4">
                <div class="table-container table-2">
                    <div class="table-responsive">
                        <table class="table align-middle">
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
                                @forelse($callLogs as $log)
                                <tr>
                                    <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $log->campaign->name ?? 'N/A' }}</td>
                                    <td>{{ $log->customer_name }}</td>
                                    <td>{{ $log->phone }}</td>
                                    <td>{{ $log->call_type }}</td>
                                    <td>{{ $log->duration ?? 'N/A' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No call records available.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        {{ $callLogs->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--  End Content Wrapper -->

@endsection