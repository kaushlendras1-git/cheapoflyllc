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

    <!-- Filters & Data -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Booking Details</h5>
                </div>
                
                <!-- Filters -->
                <div class="card-body border-bottom">
                    <form method="GET" class="row g-3">
                        <div class="col-md-2">
                            <div class="form-floating">
                                <select name="period" class="form-select" id="period">
                                    <option value="">All Time</option>
                                    <option value="today" {{ request('period') == 'today' ? 'selected' : '' }}>Today</option>
                                    <option value="weekly" {{ request('period') == 'weekly' ? 'selected' : '' }}>This Week</option>
                                    <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>This Month</option>
                                </select>
                                <label for="period">Period</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="date" name="date_from" class="form-control" id="date_from" value="{{ request('date_from') }}">
                                <label for="date_from">Date From</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="date" name="date_to" class="form-control" id="date_to" value="{{ request('date_to') }}">
                                <label for="date_to">Date To</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <select name="booking_type" class="form-select" id="booking_type">
                                    <option value="">All Types</option>
                                    <option value="Flight" {{ request('booking_type') == 'Flight' ? 'selected' : '' }}>Flight</option>
                                    <option value="Hotel" {{ request('booking_type') == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                                    <option value="Cruise" {{ request('booking_type') == 'Cruise' ? 'selected' : '' }}>Cruise</option>
                                    <option value="Car" {{ request('booking_type') == 'Car' ? 'selected' : '' }}>Car</option>
                                    <option value="Train" {{ request('booking_type') == 'Train' ? 'selected' : '' }}>Train</option>
                                </select>
                                <label for="booking_type">Booking Type</label>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-search-line me-1"></i>Filter
                            </button>
                            <a href="{{ route('score.details') }}" class="btn btn-label-secondary">
                                <i class="ri-refresh-line me-1"></i>Reset
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Bookings Table -->
                <div class="card-body">
                    @if($bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th> 
                                        <th>PNR</th>
                                        <th>Customer</th>
                                        <th>Booking Type</th>
                                      
                                        <th>Status</th>
                                        <th>Booking Date</th>   
                                         <th>Booking Status</th>  
                                         <th>Payment Status</th>  
                                         <th>Net Value</th>
                                         <th>Gross MCO</th>  
                                         <th>Quality Score</th>  
                                         <th>Email Status</th>  
                                        
                                        <th>Action</th>
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
                                            <span class="badge bg-label-{{ $booking->bookingStatus->name == 'Confirmed' ? 'success' : 'warning' }}">
                                                {{ $booking->bookingStatus->name ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $booking->created_at->format('M d, Y') }}</span>
                                            <br>
                                            <small class="text-muted">{{ $booking->created_at->format('h:i A') }}</small>
                                        </td>
                                         <td>{{$booking->booking_status_id}}</td>  
                                         <td>{{$booking->payment_status_id}}</td>  
                                         <td><span class="fw-medium text-success">${{ number_format($booking->net_value, 2) }}</span></td>
                                         <td>{{$booking->gross_mco}}</td>  
                                         <td>{{$booking->quality_score}}</td>  
                                         <td>Email Status</td>  
                                        
                                        <td>
                                            <a href="{{ route('booking.show', encode($booking->id)) }}" class="btn btn-sm btn-label-primary">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                        </td>
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
                                {{ $bookings->links() }}
                            </div>
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
</div>
@endsection