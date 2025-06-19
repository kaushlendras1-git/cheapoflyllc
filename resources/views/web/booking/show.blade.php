
@extends('web.layouts.main')

@section('content')
<form id="bookingForm" action="{{ route('booking.update', $booking->id ?? '') }}" method="POST">
    @csrf
    @method('PUT') 

        <input type="hidden" name="booking_id" value="{{ $booking->id ?? '' }}">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-6">
            <div class="d-flex justify-content-between align-items-center flex-wrap p-0">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <strong>Ticket Information</strong>
                    <span>Created by {{ $booking->created_by ?? 'Testagent' }} on {{ $booking->created_at->format('m/d/Y h:i:s A') ?? '4/7/2025 12:40:28 PM' }}</span>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill">
                        Copy Authorization Link
                    </button>
                   <a href="{{ route('booking.mail.history.index', ['id' => $hashids->encode($booking->id)]) }}"> <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill">
                        Mail History
                    </button></a>
                </div>
            </div>
            
                        @include('web.layouts.flash')
                        
            <!-- Top Bar -->
            <div class="card p-3 mt-2">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input" type="checkbox" id="booking-flight" value="Flight" {{ in_array('Flight', $booking->bookingTypes->pluck('type')->toArray()) || old('booking-type', []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-flight">Flight</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input" type="checkbox" id="booking-hotel" value="Hotel" {{ in_array('Hotel', $booking->bookingTypes->pluck('type')->toArray()) || old('booking-type', []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-hotel">Hotel</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input" type="checkbox" id="booking-cruise" value="Cruise" {{ in_array('Cruise', $booking->bookingTypes->pluck('type')->toArray()) || old('booking-type', []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-cruise">Cruise</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input" type="checkbox" id="booking-car" value="Car" {{ in_array('Car', $booking->bookingTypes->pluck('type')->toArray()) || old('booking-type', []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-car">Car</label>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-primary text-center">
                            <i class="icon-base ri ri-save-2-fill"></i> Save
                        </button>
                        
                       <a href="{{ route('booking.auth-email.index', ['id' => $booking->id]) }}"> 
                            <button type="button" class="btn btn-sm btn-dark text-center">
                                <i class="icon-base ri ri-mail-send-fill"></i> Send
                            </button>
                        </a>

                    </div>
                </div>
            </div>

            <!-- Booking Form Card -->
            <div class="card p-4 mb-4">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">PNR <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="pnr" value="{{ old('pnr', $booking->pnr ?? '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Hotel Ref</label>
                        <input type="text" class="form-control" name="hotel_ref" value="{{ old('hotel_ref', $booking->hotel_ref ?? '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cruise Ref</label>
                        <input type="text" class="form-control" name="cruise_ref" value="{{ old('cruise_ref', $booking->cruise_ref ?? '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $booking->name ?? '') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Calling Phone No. <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone', $booking->phone ?? '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $booking->email ?? '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Query Type</label>
                        <input type="text" class="form-control" name="query_type" value="{{ old('query_type', $booking->query_type ?? 'New Booking') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Company Organisation</label>
                        <input type="text" class="form-control" name="selected_company" value="{{ old('selected_company', $booking->selected_company ?? 'cruiseroyals') }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Booking Status</label>
                        <input type="text" class="form-control" name="booking_status" value="{{ old('booking_status', $booking->booking_status ?? 'under process') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Payment Status</label>
                        <input type="text" class="form-control" name="payment_status" value="{{ old('payment_status', $booking->payment_status ?? 'pending') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Reservation Source</label>
                        <input type="text" class="form-control" name="reservation_source" value="{{ old('reservation_source', $booking->reservation_source ?? '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Descriptor</label>
                        <input type="text" class="form-control" name="descriptor" value="{{ old('descriptor', $booking->descriptor ?? '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Amadeus/Sabre PNR</label>
                        <input type="text" class="form-control" name="amadeus_sabre_pnr" value="{{ old('amadeus_sabre_pnr', $booking->amadeus_sabre_pnr ?? '') }}">
                    </div>
                </div>
            </div>

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs my-5" id="bookingTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="sector-tab" data-bs-toggle="tab" href="#sector" role="tab" aria-controls="sector" aria-selected="true">Sector Details</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="passenger-tab" data-bs-toggle="tab" href="#passenger" role="tab" aria-controls="passenger" aria-selected="false">Passenger Details</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="billing-tab" data-bs-toggle="tab" href="#billing" role="tab" aria-controls="billing" aria-selected="false">Billing Details</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pricing-tab" data-bs-toggle="tab" href="#pricing" role="tab" aria-controls="pricing" aria-selected="false">Pricing Details</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="remarks-tab" data-bs-toggle="tab" href="#remarks" role="tab" aria-controls="remarks" aria-selected="false">Booking Remarks</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="feedback-tab" data-bs-toggle="tab" href="#feedback" role="tab" aria-controls="feedback" aria-selected="false">Quality Feedback</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="screenshots-tab" data-bs-toggle="tab" href="#screenshots" role="tab" aria-controls="screenshots" aria-selected="false">Screenshots</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="bookingTabsContent">
                <!-- Sector Details -->
                <div class="tab-pane fade show active" id="sector" role="tabpanel" aria-labelledby="sector-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-header border-0 p-0">Sector Details</h5>
                            <button type="button" class="btn btn-outline-secondary btn-sm">Delete Image</button>
                        </div>
                        <div class="card-body pt-3">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-3">
                                    <!-- Assuming images come from API or stored in sectorDetail -->
                                    @if($booking->sectorDetail && $booking->sectorDetail->images)
                                        @foreach(json_decode($booking->sectorDetail->images, true) as $image)
                                            <img src="{{ url($image) }}" alt="Sector Image">
                                        @endforeach
                                    @endif
                                    <label class="form-label visually-hidden">Sector Type</label>
                                    <input type="text" class="form-control" name="sector_type" value="{{ old('sector_type', $booking->sectorDetail->type ?? 'Flight') }}" placeholder="Enter sector type">
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-warning">
                                        <i class="ri ri-download-2-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-light px-4" data-bs-target="#screenshots" data-bs-toggle="tab">Prev</button>
                            <button type="button" class="btn btn-primary px-4" data-bs-target="#passenger" data-bs-toggle="tab">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Passenger Details -->
                <div class="tab-pane fade" id="passenger" role="tabpanel" aria-labelledby="passenger-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">Passenger Details</h4>
                            <button type="button" class="btn btn-sm btn-primary waves-effect waves-light" id="addPassengerBtn">
                                <i class="icon-base ri ri-add-circle-fill"></i>
                            </button>
                        </div>

                        <div id="passengerForms">
                            @foreach($booking->passengers as $index => $passenger)
                                <div class="row mb-5 mt-2 passenger-form" data-index="{{ $index }}">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0 billing-card-title">Passenger {{ $index + 1 }}</h6>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-passenger">
                                            <i class="icon-base ri ri-delete-bin-2-line"></i> Delete
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Type</label>
                                        <input type="text" class="form-control" name="passenger[{{ $index }}][passenger_type]" value="{{ old("passenger.$index.passenger_type", $passenger->passenger_type ?? 'Adult') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Gender</label>
                                        <input type="text" class="form-control" name="passenger[{{ $index }}][gender]" value="{{ old("passenger.$index.gender", $passenger->gender ?? 'Male') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">DOB</label>
                                        <input type="date" class="form-control" name="passenger[{{ $index }}][dob]" value="{{ old("passenger.$index.dob", $passenger->dob ? $passenger->dob->format('Y-m-d') : '') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Seat</label>
                                        <input type="text" class="form-control" name="passenger[{{ $index }}][seat_number]" value="{{ old("passenger.$index.seat_number", $passenger->seat_number ?? '') }}" placeholder="Seat">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="passenger[{{ $index }}][title]" value="{{ old("passenger.$index.title", $passenger->title ?? 'Ms') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Credit Note Amount</label>
                                        <input type="number" class="form-control" name="passenger[{{ $index }}][credit_note]" value="{{ old("passenger.$index.credit_note", $passenger->credit_note ?? 0) }}" step="0.01">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" name="passenger[{{ $index }}][first_name]" value="{{ old("passenger.$index.first_name", $passenger->first_name ?? '') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" name="passenger[{{ $index }}][middle_name]" value="{{ old("passenger.$index.middle_name", $passenger->middle_name ?? '') }}" placeholder="Middle Name">
                                    </div>
                                    <div class="col-md-3 position-relative">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" name="passenger[{{ $index }}][last_name]" value="{{ old("passenger.$index.last_name", $passenger->last_name ?? '') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">E-Ticket</label>
                                        <input type="text" class="form-control" name="passenger[{{ $index }}][e_ticket_number]" value="{{ old("passenger.$index.e_ticket_number", $passenger->e_ticket_number ?? '') }}" placeholder="E Ticket">
                                    </div>
                                </div>
                            @endforeach
                            <!-- Fallback for new passenger form -->
                            @if($booking->passengers->isEmpty())
                                <div class="row mb-5 mt-2 passenger-form" data-index="0">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0 billing-card-title">Passenger 1</h6>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-passenger">
                                            <i class="icon-base ri ri-delete-bin-2-line"></i> Delete
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Type</label>
                                        <input type="text" class="form-control" name="passenger[0][passenger_type]" value="{{ old('passenger.0.passenger_type', 'Adult') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Gender</label>
                                        <input type="text" class="form-control" name="passenger[0][gender]" value="{{ old('passenger.0.gender', 'Male') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">DOB</label>
                                        <input type="date" class="form-control" name="passenger[0][dob]" value="{{ old('passenger.0.dob') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Seat</label>
                                        <input type="text" class="form-control" name="passenger[0][seat_number]" value="{{ old('passenger.0.seat_number') }}" placeholder="Seat">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="passenger[0][title]" value="{{ old('passenger.0.title', 'Ms') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Credit Note Amount</label>
                                        <input type="number" class="form-control" name="passenger[0][credit_note]" value="{{ old('passenger.0.credit_note', 0) }}" step="0.01">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" name="passenger[0][first_name]" value="{{ old('passenger.0.first_name') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" name="passenger[0][middle_name]" value="{{ old('passenger.0.middle_name') }}" placeholder="Middle Name">
                                    </div>
                                    <div class="col-md-3 position-relative">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" name="passenger[0][last_name]" value="{{ old('passenger.0.last_name') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">E-Ticket</label>
                                        <input type="text" class="form-control" name="passenger[0][e_ticket_number]" value="{{ old('passenger.0.e_ticket_number') }}" placeholder="E Ticket">
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-light px-4" data-bs-target="#sector" data-bs-toggle="tab">Prev</button>
                            <button type="button" class="btn btn-primary px-4" data-bs-target="#billing" data-bs-toggle="tab">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Billing Details -->
                <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-header border-0 p-0">Billing Details</h5>
                            <div>
                                <button type="button" class="btn btn-outline-secondary btn-sm">Send Paylink</button>
                                <button type="button" class="btn btn-sm btn-primary waves-effect waves-light" id="addBillingBtn"><i class="icon-base ri ri-add-circle-fill"></i></button>
                            </div>
                        </div>
                        <div class="card-body pt-2">
                            @foreach($booking->billingDetails as $index => $billing)
                                <div class="row g-3 billing-card pt-2" data-index="{{ $index }}">
                                    <h6 class="mb-0 billing-card-title">Card Details {{ $index + 1 }}</h6>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Card Type" name="billing[{{ $index }}][card_type]" value="{{ old("billing.$index.card_type", $billing->card_type ?? 'VISA') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="CC Number" name="billing[{{ $index }}][cc_number]" value="{{ old("billing.$index.cc_number", $billing->cc_number ?? '') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="CC Holder Name" name="billing[{{ $index }}][cc_holder_name]" value="{{ old("billing.$index.cc_holder_name", $billing->cc_holder_name ?? '') }}">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" class="form-control" placeholder="MM" name="billing[{{ $index }}][exp_month]" value="{{ old("billing.$index.exp_month", $billing->exp_month ?? '01') }}">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" class="form-control" placeholder="YYYY" name="billing[{{ $index }}][exp_year]" value="{{ old("billing.$index.exp_year", $billing->exp_year ?? '2024') }}">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" class="form-control" placeholder="CVV" name="billing[{{ $index }}][cvv]" value="{{ old("billing.$index.cvv", $billing->cvv ?? '') }}">
                                    </div>
                                    <div class="col-md-3 d-flex align-items-center">
                                        <input type="text" class="form-control" placeholder="Address" name="billing[{{ $index }}][address]" value="{{ old("billing.$index.address", $billing->address ?? '') }}">
                                        <button type="button" class="btn btn-outline-danger ms-2 delete-billing-btn">
                                            <i class="ri ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="email" class="form-control" placeholder="Email" name="billing[{{ $index }}][email]" value="{{ old("billing.$index.email", $billing->email ?? '') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Contact No" name="billing[{{ $index }}][contact_no]" value="{{ old("billing.$index.contact_no", $billing->contact_no ?? '') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="City" name="billing[{{ $index }}][city]" value="{{ old("billing.$index.city", $billing->city ?? '') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Country" name="billing[{{ $index }}][country]" value="{{ old("billing.$index.country", $billing->country ?? 'Afghanistan') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="State" name="billing[{{ $index }}][state]" value="{{ old("billing.$index.state", $billing->state ?? 'Badakhshan') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="ZIP Code" name="billing[{{ $index }}][zip_code]" value="{{ old("billing.$index.zip_code", $billing->zip_code ?? '') }}">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" class="form-control" placeholder="Currency" name="billing[{{ $index }}][currency]" value="{{ old("billing.$index.currency", $billing->currency ?? 'USD') }}">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control" placeholder="0.00" name="billing[{{ $index }}][amount]" value="{{ old("billing.$index.amount", $billing->amount ?? 0) }}" step="0.01">
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center">
                                        <label class="me-2">Active</label>
                                        <input class="form-check-input" type="radio" name="activeCard" value="{{ $index }}" {{ old('activeCard') == $index || $billing->is_active ? 'checked' : '' }}>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Fallback for new billing form -->
                            @if($booking->billingDetails->isEmpty())
                                <div class="row g-3 billing-card pt-2" data-index="0">
                                    <h6 class="mb-0 billing-card-title">Card Details 1</h6>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Card Type" name="billing[0][card_type]" value="{{ old('billing.0.card_type', 'VISA') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="CC Number" name="billing[0][cc_number]" value="{{ old('billing.0.cc_number') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="CC Holder Name" name="billing[0][cc_holder_name]" value="{{ old('billing.0.cc_holder_name') }}">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" class="form-control" placeholder="MM" name="billing[0][exp_month]" value="{{ old('billing.0.exp_month', '01') }}">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" class="form-control" placeholder="YYYY" name="billing[0][exp_year]" value="{{ old('billing.0.exp_year', '2024') }}">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" class="form-control" placeholder="CVV" name="billing[0][cvv]" value="{{ old('billing.0.cvv') }}">
                                    </div>
                                    <div class="col-md-3 d-flex align-items-center">
                                        <input type="text" class="form-control" placeholder="Address" name="billing[0][address]" value="{{ old('billing.0.address') }}">
                                        <button type="button" class="btn btn-outline-danger ms-2 delete-billing-btn">
                                            <i class="ri ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="email" class="form-control" placeholder="Email" name="billing[0][email]" value="{{ old('billing.0.email') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" placeholder="Contact No" name="billing[0][contact_no]" value="{{ old('billing.0.contact_no') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="City" name="billing[0][city]" value="{{ old('billing.0.city') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Country" name="billing[0][country]" value="{{ old('billing.0.country', 'Afghanistan') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="State" name="billing[0][state]" value="{{ old('billing.0.state', 'Badakhshan') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="ZIP Code" name="billing[0][zip_code]" value="{{ old('billing.0.zip_code') }}">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" class="form-control" placeholder="Currency" name="billing[0][currency]" value="{{ old('billing.0.currency', 'USD') }}">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control" placeholder="0.00" name="billing[0][amount]" value="{{ old('billing.0.amount', 0) }}" step="0.01">
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center">
                                        <label class="me-2">Active</label>
                                        <input class="form-check-input" type="radio" name="activeCard" value="0" {{ old('activeCard') == '0' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer mt-4 d-flex justify-content-between">
                            <button type="button" class="btn btn-light px-4" data-bs-target="#passenger" data-bs-toggle="tab">Prev</button>
                            <button type="button" class="btn btn-primary px-4" data-bs-target="#pricing" data-bs-toggle="tab">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Pricing Details -->
                <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
                    <div class="card p-4">
                        <h5 class="card-header px-0">Pricing Details</h5>
                        <div class="card-body p-0">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Hotel Cost ($)<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="hotel_cost" value="{{ old('hotel_cost', $booking->pricingDetail->hotel_cost ?? 0.00) }}" placeholder="0.00" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Cruise Cost ($)<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="cruise_cost" value="{{ old('cruise_cost', $booking->pricingDetail->cruise_cost ?? 0.00) }}" placeholder="0.00" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Total Amount ($)<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="total_amount" value="{{ old('total_amount', $booking->pricingDetail->total_amount ?? 0.00) }}" placeholder="0.00" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Advisor MCO ($)</label>
                                    <input type="number" class="form-control" name="advisor_mco" value="{{ old('advisor_mco', $booking->pricingDetail->advisor_mco ?? 12.00) }}" placeholder="0.00" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Conversion Charge ($)</label>
                                    <input type="number" class="form-control" name="conversion_charge" value="{{ old('conversion_charge', $booking->pricingDetail->conversion_charge ?? 12.00) }}" placeholder="0.00" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Airline Commission ($)</label>
                                    <input type="number" class="form-control" name="airline_commission" value="{{ old('airline_commission', $booking->pricingDetail->airline_commission ?? 0.00) }}" placeholder="0.00" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Final Amount ($)</label>
                                    <input type="number" class="form-control" name="final_amount" value="{{ old('final_amount', $booking->pricingDetail->final_amount ?? 12.00) }}" placeholder="0.00" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Merchant</label>
                                    <input type="text" class="form-control" name="merchant" value="{{ old('merchant', $booking->pricingDetail->merchant ?? 'Cheapofly') }}" placeholder="Merchant Name">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Net MCO ($)</label>
                                    <input type="number" class="form-control" name="net_mco" value="{{ old('net_mco', $booking->pricingDetail->net_mco ?? 0.20) }}" placeholder="0.00" step="0.01">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-light px-4" data-bs-target="#billing" data-bs-toggle="tab">Prev</button>
                            <button type="button" class="btn btn-primary px-4" data-bs-target="#remarks" data-bs-toggle="tab">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Booking Remarks -->
                <div class="tab-pane fade" id="remarks" role="tabpanel" aria-labelledby="remarks-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-header border-0 p-0">Remarks</h5>
                            <div>
                                <button type="button" class="btn btn-warning me-2">
                                    <i class="ri ri-file-text-line"></i>
                                </button>
                                <button type="button" class="btn btn-warning">
                                    <i class="ri ri-save-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <textarea class="form-control mb-4" name="particulars" rows="4" placeholder="Enter remarks here...">{{ old('particulars', $booking->bookingRemark->particulars ?? '') }}</textarea>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="text-white bg-primary small">
                                        <tr>
                                            <th scope="col" class="py-2">Id</th>
                                            <th scope="col" class="py-2">Agent</th>
                                            <th scope="col" class="py-2">Date & Time</th>
                                            <th scope="col" class="py-2">Particulars</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($booking->bookingRemark ? [$booking->bookingRemark] : [] as $remark)
                                            <tr>
                                                <td>{{ $remark->id }}</td>
                                                <td>{{ $remark->agent ?? 'Alex Morgan' }}</td>
                                                <td>{{ $remark->created_at ? $remark->created_at->format('Y-m-d H:i') : '2025-04-10 14:30' }}</td>
                                                <td>{{ $remark->particulars ?? 'Called to confirm ticket details' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-light px-4" data-bs-target="#pricing" data-bs-toggle="tab">Prev</button>
                            <button type="button" class="btn btn-primary px-4" data-bs-target="#feedback" data-bs-toggle="tab">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Quality Feedback -->
                <div class="tab-pane fade" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-header border-0 p-0">Quality Feedback</h5>
                            <button type="button" class="btn btn-warning">
                                <i class="ri ri-save-line"></i>
                            </button>
                        </div>
                        <div class="card-body p-0">
                            <textarea class="form-control mb-4" name="feedback" rows="4" placeholder="Enter quality feedback here...">{{ old('feedback', $booking->qualityFeedback->first()->feedback ?? '') }}</textarea>
                            <div class="row row-cols-2 row-cols-md-4 g-2 mb-4">
                                <div class="col">
                                    <label class="btn btn-outline-secondary w-100">
                                        <input type="radio" name="param" value="Probing & Understanding" {{ old('param', $booking->qualityFeedback->first()->param ?? '') == 'Probing & Understanding' ? 'checked' : '' }}> Probing & Understanding
                                    </label>
                                </div>
                                <!-- Add other radio buttons similarly -->
                            </div>
                            <div class="mb-4" style="max-width: 200px;">
                               <select class="form-select" name="status">
                                    <option value="" {{ old('status', $booking->qualityFeedback->first()->status ?? '') == '' ? 'selected' : '' }}>Select Status</option>
                                    <option value="Pass" {{ old('status', $booking->qualityFeedback->first()->status ?? '') == 'Pass' ? 'selected' : '' }}>Pass</option>
                                    <option value="Fail" {{ old('status', $booking->qualityFeedback->first()->status ?? '') == 'Fail' ? 'selected' : '' }}>Fail</option>
                                    <option value="Pending" {{ old('status', $booking->qualityFeedback->first()->status ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="text-white bg-primary small">
                                        <tr>
                                            <th class="py-2">QA</th>
                                            <th class="py-2">Date & Time</th>
                                            <th class="py-2">Feedback</th>
                                            <th class="py-2">Parameters</th>
                                            <th class="py-2">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($booking->qualityFeedback as $feedback)
                                            <tr>
                                                <td>{{ $feedback->qa ?? 'Sana Maria' }}</td>
                                                <td>{{ $feedback->created_at ? $feedback->created_at->format('Y-m-d H:i') : '2025-04-10 11:15' }}</td>
                                                <td>{{ $feedback->feedback ?? 'Agent showed excellent probing skills.' }}</td>
                                                <td>{{ $feedback->param ?? 'Probing & Understanding, Soft Skills' }}</td>
                                                <td>{{ $feedback->status ?? 'Pass' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-light px-4" data-bs-target="#remarks" data-bs-toggle="tab">Prev</button>
                            <button type="button" class="btn btn-primary px-4" data-bs-target="#screenshots" data-bs-toggle="tab">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Screenshots -->
                <div class="tab-pane fade" id="screenshots" role="tabpanel" aria-labelledby="screenshots-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-header border-0">Screenshots</h5>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-outline-dark rounded-pill px-3">View Screenshots</button>
                                <select class="form-select" name="type" style="width: 120px">
                                    <option value="Flight" {{ old('type', $booking->screenshot->type ?? 'Flight') == 'Flight' ? 'selected' : '' }}>Flight</option>
                                    <option value="Hotel" {{ old('type', $booking->screenshot->type ?? '') == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                                    <option value="Car" {{ old('type', $booking->screenshot->type ?? '') == 'Car' ? 'selected' : '' }}>Car</option>
                                </select>
                                <button type="button" class="btn btn-warning">
                                    <i class="ri ri-save-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="notes" rows="4" placeholder="Enter notes here...">{{ old('notes', $booking->screenshot->notes ?? '') }}</textarea>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <button type="button" class="btn btn-light px-4" data-bs-target="#feedback" data-bs-toggle="tab">Prev</button>
                            <button type="button" class="btn btn-primary px-4" data-bs-target="#sector" data-bs-toggle="tab">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<!---------------- Start History ---- ------------- --------- ----->

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row gy-6">
        
        <div class="col-md-12 p-0 h-100">
                <div class="card card-action mb-6">
                    <div class="card-header align-items-center">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <h5 class="card-action-title mb-0 d-flex align-items-center">
                                <i class="icon-base ri ri-bar-chart-2-line icon-24px text-body me-3"></i><!--Call Log History-->Conversations
                            </h5>
                            <button type="button" class="btn rounded-pill btn-icon btn-primary waves-effect waves-light">
                                <span class="icon-base ri ri-information-2-fill icon-22px"></span>
                            </button>
                        </div>
                    </div>
                    
                    <div class="card-body pt-3">
    <!-- Tab Navigation -->
    <ul class="nav nav-tabs" id="timelineTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab-2025-05-17" data-bs-toggle="tab" data-bs-target="#content-2025-05-17" type="button" role="tab" aria-controls="content-2025-05-17" aria-selected="true">
                    May 17, 2025
                </button>
            </li>
                        </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="timelineTabContent">
                            <div class="tab-pane fade show active" id="content-2025-05-17" role="tabpanel" aria-labelledby="tab-2025-05-17">
                <ul class="timeline card-timeline mb-0">
                                            <li class="timeline-item timeline-item-transparent">
                                                            <span class="timeline-point timeline-point-primary"></span>
                            
                            <div class="timeline-event">
                                <div class="timeline-header mb-3">
                                    <h6 class="mb-0">created</h6>
                                    <small class="text-body-secondary">2025-05-17 20:02:02</small>
                                </div>
                                <p class="mb-2">Call Log created successfully @ 1 month ago</p>
                                <div class="d-flex justify-content-between flex-wrap gap-2">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="avatar avatar-sm me-2">
                                            <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
                                        </div>
                                        <div>
                                            <p class="mb-0 small fw-medium">Admin</p>
                                            <!-- <small>CEO of ThemeSelection</small> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                                    </ul>
            </div>
                        </div>
</div>
             
     
            </div>
       

    </div>              
</div>

<!---------------- End History --------------- ----------------- -->


<!-- JavaScript for Add/Delete Passenger and Billing -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const passengerFormsContainer = document.getElementById('passengerForms');
    const addPassengerBtn = document.getElementById('addPassengerBtn');
    const billingCardContainer = document.querySelector('#billing .card-body');
    const addBillingBtn = document.getElementById('addBillingBtn');

    // Update Passenger Indices
    function updatePassengerIndices() {
        const forms = passengerFormsContainer.querySelectorAll('.passenger-form');
        forms.forEach((form, index) => {
            form.dataset.index = index;
            const header = form.querySelector('h6');
            header.textContent = `Passenger ${index + 1}`;
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => {
                const name = input.name.replace(/passenger\[\d+\]/, `passenger[${index}]`);
                input.name = name;
            });
        });
    }

    // Add Passenger
    addPassengerBtn.addEventListener('click', function () {
        const forms = passengerFormsContainer.querySelectorAll('.passenger-form');
        const lastIndex = forms.length > 0 ? parseInt(forms[forms.length - 1].dataset.index) + 1 : 0;
        const newForm = forms[0].cloneNode(true);
        
        newForm.querySelectorAll('input').forEach(input => {
            input.value = input.placeholder || '';
        });
        
        newForm.dataset.index = lastIndex;
        newForm.querySelector('h6').textContent = `Passenger ${lastIndex + 1}`;
        
        newForm.querySelectorAll('input').forEach(input => {
            const name = input.name.replace(/passenger\[\d+\]/, `passenger[${lastIndex}]`);
            input.name = name;
        });
        
        newForm.querySelectorAll('.delete-passenger').forEach(btn => {
            btn.addEventListener('click', function () {
                if (passengerFormsContainer.querySelectorAll('.passenger-form').length > 1) {
                    newForm.remove();
                    updatePassengerIndices();
                } else {
                    alert('At least one passenger form is required.');
                }
            });
        });
        
        passengerFormsContainer.appendChild(newForm);
    });

    // Delete Passenger
    passengerFormsContainer.querySelectorAll('.delete-passenger').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = btn.closest('.passenger-form');
            if (passengerFormsContainer.querySelectorAll('.passenger-form').length > 1) {
                form.remove();
                updatePassengerIndices();
            } else {
                alert('At least one passenger form is required.');
            }
        });
    });

    // Update Billing Indices and Headers
    function updateBillingIndices() {
        const forms = billingCardContainer.querySelectorAll('.billing-card');
        forms.forEach((form, index) => {
            form.dataset.index = index;
            const header = form.querySelector('h6');
            header.textContent = `Card Details ${index + 1}`;
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => {
                const name = input.name.replace(/\[\d+\]/, `[${index}]`);
                input.name = name;
            });
            const radio = form.querySelector('input[type="radio"]');
            radio.value = index;
        });
    }

    // Add Billing
    addBillingBtn.addEventListener('click', function () {
        const forms = billingCardContainer.querySelectorAll('.billing-card');
        const lastIndex = forms.length;
        const newForm = forms[0].cloneNode(true);
        
        newForm.querySelectorAll('input').forEach(input => {
            input.value = input.placeholder || '';
            input.name = input.name.replace(/\[\d+\]/, `[${lastIndex}]`);
        });
        
        newForm.querySelector('input[type="radio"]').value = lastIndex;
        newForm.querySelector('h6').textContent = `Card Details ${lastIndex + 1}`;
        
        billingCardContainer.appendChild(newForm);
        updateBillingIndices();
    });

    // Delete Billing (Event Delegation)
    billingCardContainer.addEventListener('click', function (event) {
        const deleteButton = event.target.closest('.delete-billing-btn');
        if (deleteButton) {
            const billingCard = deleteButton.closest('.billing-card');
            if (billingCard) {
                if (billingCardContainer.querySelectorAll('.billing-card').length > 1) {
                    billingCard.remove();
                    updateBillingIndices();
                    console.log('Billing card removed successfully');
                } else {
                    alert('At least one billing detail is required.');
                }
            } else {
                console.error('Billing card not found');
            }
        } else {
            console.log('Click was not on a delete button');
        }
    });
});
</script>

<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
@endsection