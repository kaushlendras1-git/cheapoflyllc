@extends('web.layouts.main')
@section('content')

<!-- Content Wrapper -->
<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Page Header -->
    <div class="lob-header d-flex align-items-center justify-content-between">
        <div>
            <h2 class="lob-title mb-1">
                <span class="iconify" data-icon="mdi:magnify" style="vertical-align: middle; font-size: 14px;"></span>
                Find Booking
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
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:magnify"></span>
                    Find Booking
                </li>
            </ol>
        </nav>
    </div>

    <!-- Flash Messages -->
    @include('web.layouts.flash')

    <!-- Main Card -->
    <div class="lob-card p-4">

        <!-- Filter Form -->
        <form method="GET" action="{{ route('booking.search') }}"
            class="filter-form lob-filter p-4 rounded-3 d-flex flex-wrap align-items-end gap-2">

            <!-- Keyword -->
            <div class="col-md-2 position-relative">
                <div class="floating-group lob-card">
                    <input type="text" name="keyword" class="form-control input-style" value="{{ request('keyword') }}"
                        placeholder="e.g. PNR / name / email / phone">
                    <label for="keyword" class="form-label">
                        <span class="iconify me-1" data-icon="mdi:account-search-outline"></span>
                        Keyword
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
            <div class="col-md-1 position-relative">
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
                    <select name="booking_status" class="form-control input-style w-100">
                        <option value="">All</option>
                        @foreach($booking_status as $status)
                        <option value="{{ $status->id }}"
                            {{ request('booking_status') == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                        @endforeach
                    </select>
                    <label class="form-label">
                        <span class="iconify me-1" data-icon="mdi:clipboard-check-outline"></span>
                        Booking Status
                    </label>
                </div>
            </div>

            <!-- Payment Status -->
            <div class="col-md-2 position-relative">
                <div class="floating-group lob-card">
                    <select name="payment_status" class="form-control input-style w-100">
                        <option value="">All</option>
                        @foreach($payment_status as $payment)
                        <option value="{{ $payment->id }}"
                            {{ request('payment_status') == $payment->id ? 'selected' : '' }}>
                            {{ $payment->name }}
                        </option>
                        @endforeach
                    </select>
                    <label class="form-label">
                        <span class="iconify me-1" data-icon="mdi:credit-card-outline"></span>
                        Payment Status
                    </label>
                </div>
            </div>
            <!-- Buttons -->
            <div class="col-md-2 d-flex justify-content-start gap-2 mt-2">
                <button type="submit" class="btn btn-primary button-style d-flex align-items-center gap-2 px-4 py-3">
                    <span class="iconify fs-5" data-icon="mdi:magnify"></span> Search
                </button>

                <a href="{{ route('booking.search') }}"
                    class="btn btn-primary d-flex align-items-center gap-2 px-4 py-3"
                    style="background-color: var(--accent)!important;">
                    <span class="iconify fs-5" data-icon="mdi:refresh"></span> Reset
                </a>
                <a href="{{ route('booking.export', request()->all()) }}"
                    class="btn btn-primary button-style d-flex align-items-center gap-2 px-4 py-3"
                    style="background-color:green;">
                    <span class="iconify fs-5" data-icon="mdi:file-excel-outline"></span>
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
                            <th>Booking Date</th>
                            <th>Agent</th>
                            <th>Booking Status</th>
                            <th>Payment Status</th>
                            <th>Total</th>
                            <th>Agent MCO</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>
                                <a href="{{ route('booking.show', ['id' => encode($booking->id)]) }}">
                                    {{ $booking->id }}
                                </a>
                            </td>
                            <td>{{ $booking->pnr }}</td>
                            <td>{{ $booking->created_at->format('d-m-Y H:i:s') }}</td>
                            <td>{{ $booking->user->name ?? 'N/A' }}</td>
                            <td>
                                @if($booking->bookingStatus)
                                <span class="badge" style="background-color: {{ $booking->bookingStatus->color }}">
                                    {{ $booking->bookingStatus->name }}
                                </span>
                                @else
                                <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($booking->paymentStatus)
                                <span class="badge" style="background-color: {{ $booking->paymentStatus->color }}">
                                    {{ $booking->paymentStatus->name }}
                                </span>
                                @else
                                <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td>${{ number_format($booking->pricingDetails->sum('total_amount'), 2) }}</td>
                            <td>${{ number_format($booking->pricingDetails->sum('advisor_mco'), 2) }}</td>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->email }}</td>
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
                <p class="text-muted mb-0">No data matches your current search filters.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection