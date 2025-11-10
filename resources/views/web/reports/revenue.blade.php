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
                <span class="iconify" data-icon="mdi:chart-line-variant"
                    style="vertical-align: middle; font-size: 14px"></span>
                Revenue Report
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
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:cash-multiple"></span>
                    Revenue Report
                </li>
            </ol>
        </nav>
    </div>

    <!--  Main Row -->
    <div class="row gy-4">
        <div class="col-12">

            <!-- Flash Messages -->
            @include('web.layouts.flash')

            <!--  Filter Section -->
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
                            <label for=" campaign_id" class="form-label">
                                <span class="iconify me-1" data-icon="mdi:bullhorn-outline"></span>
                                Campaign
                            </label>
                        </div>
                    </div>

                    <!-- Date From -->
                    <div class="col-md-2 position-relative">
                        <div class="floating-group lob-card">
                            <input type="date" name="date_from" id="date_from" class=" form-control input-style"
                                placeholder=" " value="{{ request('date_from') }}">
                            <label for=" date_from" class="form-label">
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
                            <label for=" date_to" class="form-label">
                                <span class="iconify me-1" data-icon="mdi:calendar-end"></span>
                                Date To
                            </label>
                        </div>
                    </div>

                    <!-- Filter -->
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit"
                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2 button-style px-4 py-3">
                            <span class="iconify fs-5" data-icon="mdi:magnify"></span>
                            Filter
                        </button>
                    </div>

                    <!-- Reset -->
                    <div class="col-md-1 d-flex align-items-end">
                        <a href=" {{ route('reports.revenue') }}" class=" btn btn-primary btn-gray w-100 d-flex
                                align-items-center justify-content-center gap-2 button-style px-4 py-3">
                            <span class="iconify fs-5" data-icon="mdi:refresh"></span>
                            Reset
                        </a>
                    </div>

                    <!-- Export -->
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
                <!-- Sticky Total Net Value -->
                <div class="campaign-stats-card text-center flex-shrink-0 sticky-card">
                    <h5 class=" fw-bold mb-1 total-calls">${{ number_format($stats['total_net_value'], 2) }}</h5>
                    <p class="text-muted mb-0">Total Net Value</p>
                </div>

                <div class="campaign-stats-card text-center flex-shrink-0">
                    <h5 class=" fw-bold mb-1">${{ number_format($stats['total_gross_mco'], 2) }}</h5>
                    <p class="text-muted mb-0">Total Gross MCO</p>
                </div>

                <div class="campaign-stats-card text-center flex-shrink-0">
                    <h5 class=" fw-bold mb-1">{{ $stats['total_bookings'] }}</h5>
                    <p class="text-muted mb-0">Total Bookings</p>
                </div>
            </div>

            <!--  Campaign Wise Revenue Table -->
            <div class="lob-card p-4 mt-4">
                <div class="table-container table-2">
                    <div class="table-responsive">
                        <table class="table align-middle">
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
                                    <td>Campaign {{ $stat->campaign ?? 'N/A' }}</td>
                                    <td>${{ number_format($stat->total_net_value, 2) }}</td>
                                    <td>${{ number_format($stat->total_gross_mco, 2) }}</td>
                                    <td>{{ $stat->total_bookings }}</td>
                                </tr> @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="pagination-container">
                      
                    </div>
                </div>
            </div>

            <!--  Bookings Table -->
            <div class="lob-card p-4 mt-4">
                <div class="table-container table-2">
                    <div class="table-responsive">
                        <table class="table align-middle">
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
                                </tr> @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        {{ $bookings->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--  End Content Wrapper -->

@endsection