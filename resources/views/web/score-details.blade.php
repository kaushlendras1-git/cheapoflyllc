@extends('web.layouts.main')
@section('content')

<!-- Content Wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">
        <div>
            <h2 class="lob-title mb-1">
                <span class="iconify" data-icon="mdi:chart-line"
                    style="vertical-align: middle; font-size: 14px;"></span>
                Score Details
            </h2>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="lob__breadcrumb">
            <ol class="lob__breadcrumb-list mb-0">
                <li class="lob__breadcrumb-item">
                    <a href="{{ route('user.dashboard') }}" class="lob__breadcrumb-link">
                        <span class="iconify lob__breadcrumb-icon" data-icon="mdi:view-dashboard-outline"></span>
                        Dashboard
                    </a>
                </li>
                <li class="lob__breadcrumb-item active" aria-current="page">
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:chart-line"></span>
                    Score Details
                </li>
            </ol>
        </nav>
    </div>

    <!-- Flash Messages -->
    @include('web.layouts.flash')

    <!-- Main Card -->
    <div class="lob-card p-4">
        <!-- Filter Form -->
        <form method="GET" action="{{ route('score.details') }}"
            class="filter-form lob-filter p-4 rounded-3 d-flex flex-wrap align-items-end gap-2">
            <!-- Department -->
            <div class="col-md-3 position-relative">
                <div class="floating-group lob-card">
                    <select name="period" id="period" class="form-control input-style w-100">
                        <option value="">Select Period</option>
                        <option value="">All Time</option>
                        <option value="today" {{ request('period') == 'today' ? 'selected' : '' }}>Today</option>
                        <option value="weekly" {{ request('period') == 'weekly' ? 'selected' : '' }}>This Week</option>
                        <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>This Month
                        </option>

                    </select>
                    <label for="period" class="form-label">
                        <span class="iconify me-1" data-icon="mdi:office-building-outline"></span>
                        Period
                    </label>
                </div>
            </div>

            <!-- Role -->
            <div class="col-md-2 position-relative">
                <div class="floating-group lob-card">
                    <select name="booking_type" id="booking_type" class="form-control input-style w-100">
                        <option value="">Select Role</option>
                        <option value="">All Types</option>
                        <option value="Flight" {{ request('booking_type') == 'Flight' ? 'selected' : '' }}>Flight
                        </option>
                        <option value="Hotel" {{ request('booking_type') == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                        <option value="Cruise" {{ request('booking_type') == 'Cruise' ? 'selected' : '' }}>Cruise
                        </option>
                        <option value="Car" {{ request('booking_type') == 'Car' ? 'selected' : '' }}>Car</option>
                        <option value="Train" {{ request('booking_type') == 'Train' ? 'selected' : '' }}>Train</option>
                    </select>
                    <label for="booking_type" class="form-label">
                        <span class="iconify me-1" data-icon="mdi:account-badge-outline"></span>
                        Booking Type
                    </label>
                </div>
            </div>

            <div class="col-md-2 position-relative">
                <div class="floating-group lob-card">
                    <input type="date" name="date_to" id="date_to" class="form-control input-style"
                        value="{{ request('date_to') }}">
                    <label for="date_to" class="form-label">
                        <span class="iconify me-1" data-icon="mdi:calendar-start"></span>
                        Date To
                    </label>
                </div>
            </div>

            <!-- End Date -->
            <div class="col-md-2 position-relative">
                <div class="floating-group lob-card">
                    <input type="date" name="date_from" id="date_from" class="form-control input-style"
                        value="{{ request('date_from') }}">
                    <label for=" date_from" class="form-label">
                        <span class="iconify me-1" data-icon="mdi:calendar-end"></span>
                        End Date
                    </label>
                </div>
            </div>

            <div class="col-md-2 d-flex justify-content-start gap-2 mt-2">
                <button type="submit" class="btn btn-primary button-style d-flex align-items-center gap-2 px-4 py-3">
                    <span class="iconify fs-5" data-icon="mdi:magnify"></span> Search
                </button>
                <a href="{{ route('score.details') }}" class="btn btn-primary d-flex align-items-center gap-2 px-4 py-3"
                    style="background-color:var(--accent)!important;>
                    <span class=" iconify fs-5" data-icon="mdi:refresh"></span> Reset
                </a>
            </div>



        </form>

        <!-- Table Section -->
        <div class="table-container table-2 mt-4">
            @if($bookings->count() > 0)
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>PNR</th>
                            <th>Customer</th>
                            <th>Booking Type</th>
                            <th>Booking Date</th>
                            <th>Booking Status</th>
                            <th>Payment Status</th>
                            <th>Gross MCO</th>
                            <th>Net Value</th>
                            <th>Quality Score</th>
                            <th>Email Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $key => $booking)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $booking->pnr ?? 'N/A' }}</td>
                            <td>
                                <div>
                                    <span class="fw-semibold">{{ $booking->name }}</span><br>
                                    <small class="text-muted">{{ $booking->email }}</small>
                                </div>
                            </td>
                            <td>
                                @php
                                $types = collect($booking->bookingTypes)->pluck('type')->map(fn($t) =>
                                strtolower($t))->toArray();
                                @endphp
                                @if(in_array('flight', $types))
                                <i class="ri ri-flight-takeoff-line text-primary fs-5" title="Flight"></i>
                                @endif
                                @if(in_array('hotel', $types))
                                <i class="ri ri-hotel-fill text-warning fs-5" title="Hotel"></i>
                                @endif
                                @if(in_array('cruise', $types))
                                <i class="ri ri-ship-fill text-info fs-5" title="Cruise"></i>
                                @endif
                                @if(in_array('car', $types))
                                <i class="ri ri-car-fill text-success fs-5" title="Car"></i>
                                @endif
                                @if(in_array('train', $types))
                                <i class="ri ri-train-line text-purple fs-5" title="Train"></i>
                                @endif
                            </td>
                            <td>{{ $booking->created_at->format('d-m-Y H:i:s') }}</td>
                            <td>{{ $booking->bookingStatus->name }}</td>
                            <td>{{ $booking->paymentStatus->name }}</td>
                            <td>${{ number_format($booking->gross_mco, 2) }}</td>
                            <td><span class="fw-medium text-success">${{ number_format($booking->net_value, 2) }}</span>
                            </td>
                            <td>{{ $booking->quality_score }}</td>
                            <td>Email Status</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-container mt-3">
                {{ $bookings->links('pagination::bootstrap-5') }}
            </div>
            @else
            <div class="text-center py-5">
                <div class="avatar avatar-xl mx-auto mb-3">
                    <div class="avatar-initial bg-label-secondary rounded">
                        <i class="ri-file-list-line ri-2x"></i>
                    </div>
                </div>
                <h5 class="mb-2">No bookings found</h5>
                <p class="text-muted mb-0">No data matches your current filters for the selected period.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Table Styling -->
<style>

</style>

@endsection