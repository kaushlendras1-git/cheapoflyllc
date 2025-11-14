@extends('web.layouts.main')
@section('content')

<style>
.table-2 tbody td {
    padding: 6px 8px !important;
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
                <span class="iconify" data-icon="mdi:book-open-page-variant-outline"
                    style="vertical-align: middle; font-size: 14px"></span>
                Booking
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
                    <span class="iconify lob__breadcrumb-icon" data-icon="mdi:book-open-page-variant-outline"></span>
                    Booking
                </li>
            </ol>
        </nav>
    </div>

    <div class="row gy-4">
        <!-- Booking Table Card -->
        <div class="col-12">
            <div class="lob-card p-4">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('booking.index') }}"
                    class="filter-form lob-filter p-4 rounded-3 mb-3">
                    <div class="row g-4 align-items-end">

                        <!-- Summary Stats -->
                        <div class="col-md-6">
                            <div class="d-flex flex-wrap gap-3 booking-summary__row">
                                <div class="lob-summary__card">Flights: <span>{{$flight_booking}}</span></div>
                                <div class="lob-summary__card">Hotel: <span>{{$hotel_booking}}</span></div>
                                <div class="lob-summary__card">Cruise: <span>{{$cruise_booking}}</span></div>
                                <div class="lob-summary__card">Car: <span>{{$car_booking}}</span></div>
                                <div class="lob-summary__card">Train: <span>{{$train_booking}}</span></div>
                                <div class="lob-summary__card blinker">Pending: <span>{{$pending_booking}}</span></div>
                            </div>
                        </div>

                        <!-- Search Input -->
                        <div class="col-md-4 position-relative d-flex justify-end">
                            <div class="floating-group lob-card">
                                <input id="search-table" type="text" name="search" value="{{ request('search') }}"
                                    class="form-control input-style w-100" placeholder=" ">
                                <label for="search-table" class="form-label">
                                    <span class="iconify me-1" data-icon="mdi:magnify"></span>
                                    Search (PNR / Name / Email / Status)
                                </label>
                                <span class="clear-icon position-absolute end-0 top-50 translate-middle-y pe-3">
                                    <a href="{{ route('booking.index') }}" class="text-muted fs-4">&times;</a>
                                </span>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="col-md-2 d-flex align-items-end justify-evenly">
                            <button type="submit"
                                class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2 button-style">
                                <span class="iconify fs-5" data-icon="mdi:magnify"></span> Search
                            </button>
                        </div>


                    </div>
                </form>

                <!-- Booking Table -->
                <div class="booking-table-wrapper py-2 table-container table-2">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Booking Type</th>
                                <th>PNR</th>
                                <th>Booking Date</th>
                                <th>Booking Status</th>
                                <th>Payment Status</th>
                                <th>Gross MCO</th>
                                <th>Agent MCO</th>
                                <th>Pax Name</th>
                                @if(!(auth()->user()->role == 'User' && auth()->user()->departments == 'Sales'))
                                <th>Agent</th>
                                @endif
                                <!-- <th title="Post Sales Status">PSS</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr>
                                <td>
                                    <a title="{{ $booking->id }}"
                                        href="{{ route('booking.show', ['id' => encode($booking->id)]) }}">
                                        {{ ($bookings->currentPage() - 1) * $bookings->perPage() + $loop->iteration }}
                                    </a>
                                </td>

                                <!-- Booking Type Icons -->
                                <td>
                                    <a title="{{ $booking->id }}"
                                        href="{{ route('booking.show', ['id' => encode($booking->id)]) }}">
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
                                    </a>
                                </td>

                                <td>{{ $booking->pnr }}</td>
                                <td>{{ $booking->created_at->format('d-m-Y H:i:s') }}</td>

                                <!-- Booking Status -->
                                <td>
                                    @if($booking->bookingStatus)
                                    <span class="badge bg-secondary">
                                        {{ $booking->bookingStatus->name }}
                                    </span>
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

                                <!-- Gross / Agent MCO -->
                                <td>{{ $booking->gross_mco }}</td>
                                <td>{{ $booking->net_mco }}</td>
                                <td>{{ $booking->name }}</td>

                                @if(!(auth()->user()->role == 'User' && auth()->user()->departments == 'Sales'))
                                <td>{{ $booking->user->pseudo ?? 'N/A' }}</td>
                                @endif
                                <!-- <td><i class="ri-shake-hands-line text-primary fs-5"></i></td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination-container mt-3">
                        {{ $bookings->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
.lob-summary__card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 6px;
    padding: 6px 6px;
    font-weight: 600;
    color: var(--text-dark);
    box-shadow: var(--shadow-sm);
}

.blinker {
    animation: blink 1.5s infinite;
    color: #e63946;
    font-weight: 700;
}

@keyframes blink {
    50% {
        opacity: 0.4;
    }
}

.table td,
.table th {
    font-size: 0.8rem;
}
</style>

@endsection