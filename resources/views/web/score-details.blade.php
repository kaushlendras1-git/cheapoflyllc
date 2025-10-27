@extends('web.layouts.main')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Breadcrumb -->
        <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Score Details</h2>
        <div class="breadcrumb">
            <a href="{{ route('user.dashboard') }}" class="active">Dashboard</a>
            <a href="javascript:void(0);">Score Details</a>
        </div>
    </div>

    <div class="row gy-6">
        <div class="col-md-12">
            <div class="card p-4">

                
                <form method="GET">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="marketing-upper-form mb-5 d-flex booking-form gen_form flex-wrap">
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">Period</label>
                                <select name="period" class="form-select input-style w140">
                                    <option value="">All Time</option>
                                    <option value="today" {{ request('period') == 'today' ? 'selected' : '' }}>Today</option>
                                    <option value="weekly" {{ request('period') == 'weekly' ? 'selected' : '' }}>This Week</option>
                                    <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>This Month</option>
                                </select>
                            </div>
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">Date From</label>
                                <input type="date" name="date_from" class="form-control input-style" value="{{ request('date_from') }}">
                            </div>
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">Date To</label>
                                <input type="date" name="date_to" class="form-control input-style" value="{{ request('date_to') }}">
                            </div>
                            <div class="me-4 position-relative">
                                <label class="form-label mb-1">Booking Type</label>
                                <select name="booking_type" class="form-select input-style w140">
                                    <option value="">All Types</option>
                                    <option value="Flight" {{ request('booking_type') == 'Flight' ? 'selected' : '' }}>Flight</option>
                                    <option value="Hotel" {{ request('booking_type') == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                                    <option value="Cruise" {{ request('booking_type') == 'Cruise' ? 'selected' : '' }}>Cruise</option>
                                    <option value="Car" {{ request('booking_type') == 'Car' ? 'selected' : '' }}>Car</option>
                                    <option value="Train" {{ request('booking_type') == 'Train' ? 'selected' : '' }}>Train</option>
                                </select>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary px-4 py-3 d-flex align-items-center gap-1 button-style m-auto">
                                    <i class="ri ri-search-line fs-5"></i> Search
                                </button>
                            </div>
                        </div>
                        <div class="add-follow-btn export-btn">
                            <a href="{{ route('score.details') }}" class="btn btn-success px-4 py-3 gap-1 w-auto button-style">
                                <i class="ri ri-refresh-line fs-5"></i>
                            </a>
                        </div>
                    </div>
                </form>


                    @if($bookings->count() > 0)
                        <div class="booking-table-wrapper py-2 crm-table">
                            <table class="table table-hover table-sm booking-table w-100 mb-0">
                                <thead class="bg-dark text-white sticky-top">
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
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach($bookings as $key => $booking)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <span class="fw-medium">{{ $booking->pnr ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <div>
                                                <span class="fw-medium">{{ $booking->name }}</span>
                                                <br>
                                                <small class="text-muted">{{ $booking->email }}</small>
                                            </div>
                                        </td>
                                        <td>
                                           
                                            @php
                                            $types = collect($booking->bookingTypes)->pluck('type')->map(fn($t) => strtolower($t))->toArray();
                                        @endphp

                                        {{-- Flight Icon --}}
                                        @if(in_array('flight', $types))
                                            <i class="ri ri-flight-takeoff-line" title="Flight" style="color: #1e90ff; font-size: 18px;"></i>
                                        @endif

                                        {{-- Hotel Icon --}}
                                        @if(in_array('hotel', $types))
                                            <i class="ri ri-hotel-fill" title="Hotel" style="color: #8b4513; font-size: 18px;"></i>
                                        @endif

                                        {{-- Cruise Icon --}}
                                        @if(in_array('cruise', $types))
                                            <i class="ri ri-ship-fill" title="Cruise" style="color: #006994; font-size: 18px;"></i>
                                        @endif

                                        {{-- Car Icon --}}
                                        @if(in_array('car', $types))
                                            <i class="ri ri-car-fill" title="Car" style="color: #228b22; font-size: 18px;"></i>
                                        @endif

                                         {{-- Train Icon --}}
                                        @if(in_array('train', $types))
                                            <i class="ri ri-train-line" title="Train" style="color: #8a2be2; font-size: 18px;"></i>
                                        @endif
                                        </td>
                                        
                                       
                                        <td>
                                            <span class="text-muted">{{ $booking->created_at->format('M d, Y') }}</span>
                                            <br>
                                            <small class="text-muted">{{ $booking->created_at->format('h:i A') }}</small>
                                        </td>
                                         <td>{{$booking->bookingStatus->name}}</td>  
                                         <td>{{$booking->paymentStatus->name}}</td>  
                                         <td><span class="fw-medium text-success">${{ number_format($booking->net_value, 2) }}</span></td>
                                         <td>{{$booking->gross_mco}}</td>  
                                         <td>{{$booking->quality_score}}</td>  
                                         <td>Email Status</td>  
                                        
                                        <!-- <td>
                                            <a href="{{ route('booking.show', encode($booking->id)) }}" class="btn btn-sm btn-label-primary">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </td> -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <p class="text-muted mb-0">
                                    Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} of {{ $bookings->total() }} results
                                </p>
                            </div>
                            <div>
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
                            <p class="text-muted mb-0">No bookings match your current filters for the selected period.</p>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>

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
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}
</style>

@endsection