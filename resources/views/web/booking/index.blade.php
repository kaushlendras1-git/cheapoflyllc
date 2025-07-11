@extends('web.layouts.main')
@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row gy-4">
        <!-- Booking Table Card -->
        <div class="col-12">
            <div class="card p-4">
                <!-- Table -->
                <form method="GET" action="{{ route('booking.index') }}" class="mb-3">
                    <div class="row g-2 align-items-center">
                        <div class="d-flex align-items-center justify-content-between">
                          <div class="show-data d-flex align-items-center">
                            <div class="data-name me-5">
                              <h3 class="booking-upper-details mb-0">Flights: <span>30</span></h3>
                            </div>
                            <div class="data-name me-5">
                              <h3 class="booking-upper-details mb-0">Cruise: <span>25</span></h3>
                            </div>
                            <div class="data-name me-5">
                              <h3 class="booking-upper-details mb-0">Hotels: <span>15</span></h3>
                            </div>
                            <div class="data-name blinker">
                              <h3 class="booking-upper-details mb-0">Pending: <span>15</span></h3>
                            </div>
                          </div>
                          <div class="searchbox-table position-relative">
                              <input id="search-table" type="text" name="search" value="{{ request('search') }}"
                                class="form-control" placeholder="Search by PNR, name, email, status, etc.">
                              <span class="clear-icon" id="clear-search"> <a href="{{ route('booking.index') }}">&times;</a></span>
                          </div>
                        </div>
                    </div>
                </form>
                <div class="booking-table-wrapper py-2 crm-table">
                    <table class="table table-hover table-sm booking-table w-100 mb-0">
                        <thead class="bg-dark text-white sticky-top">
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
                            <!-- Example Row -->
                            @foreach ($bookings as $booking)
                            <tr>
                                <td>
                                    <a href="{{ route('booking.show', ['id' => $hashids->encode($booking->id)]) }}">
                                        {{ $booking->id }}
                                    </a>
                                </td>
                                <td>{{ $booking->pnr }}</td>
                                <td>{{ $booking->created_at }}</td>
                                <td>{{ $booking->user->name ?? 'N/A' }}</td>

                                <!-- Booking Status -->
                                <td>
                                    @if($booking->bookingStatus)
                                    <span class="badge" style="background-color: {{ $booking->bookingStatus->color }}">
                                        {{ $booking->bookingStatus->name }}
                                    </span>
                                    @else
                                    <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>

                                <!-- Payment Status -->
                                <td>
                                    @if($booking->paymentStatus)
                                    <span class="badge" style="background-color: {{ $booking->paymentStatus->color }}">
                                        {{ $booking->paymentStatus->name }}
                                    </span>
                                    @else
                                    <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>

                                <td>{{ $booking->pricingDetails->sum('total_amount') }}</td>
                                <td>{{ $booking->pricingDetails->sum('advisor_mco') }}</td>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->email }}</td>
                            </tr>
                            @endforeach


                            <!-- Add more rows as needed -->
                            <!-- Render pagination links -->
                        </tbody>
                    </table>

                    {{ $bookings->links('vendor.pagination.bootstrap-5') }}

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
.dark-header {
    background-color: #312d4b;
    color: #fff;
    border-radius: 0.5rem;
}

.dark-header .form-control,
.dark-header .form-select {
    background-color: #fff;
    color: #000;
    border: 1px solid #ced4da;
}

.dark-header .form-label {
    color: #fff;
}

.dark-header .form-control::placeholder {
    color: #666;
}

.dark-header .btn-warning {
    color: #000;
}

.table td,
.table th {
    font-size: 0.75rem;
}
</style>

@endsection