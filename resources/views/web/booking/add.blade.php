@extends('web.layouts.main')

@section('content')
<form id="bookingForm" action="{{ route('travel.bookings.submit') }}" method="POST">
    @csrf
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-6">
            <div class="d-flex justify-content-between align-items-center flex-wrap p-0">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <strong>Ticket Information</strong>
                    <span>Created by Testagent on 4/7/2025 12:40:28 PM</span>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill">
                        Copy Authorization Link
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill">
                        Mail History
                    </button>
                </div>
            </div>
            
            @include('web.layouts.flash')

            <!-- Top Bar -->
            <div class="card p-3 mt-2">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input" type="checkbox" id="booking-flight" value="Flight" {{ in_array('Flight', old('booking-type', ['Flight'])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-flight">Flight</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input" type="checkbox" id="booking-hotel" value="Hotel" {{ in_array('Hotel', old('booking-type', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-hotel">Hotel</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input" type="checkbox" id="booking-cruise" value="Cruise" {{ in_array('Cruise', old('booking-type', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-cruise">Cruise</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input" type="checkbox" id="booking-car" value="Car" {{ in_array('Car', old('booking-type', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-car">Car</label>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-primary text-center">
                            <i class="icon-base ri ri-save-2-fill"></i> Save
                        </button>
                        <button type="button" class="btn btn-sm btn-dark text-center">
                            <i class="icon-base ri ri-mail-send-fill"></i> Send
                        </button>
                    </div>
                </div>
            </div>

            <!-- Booking Form Card -->
            <div class="card p-4 mb-4">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">PNR <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="pnr" value="{{ old('pnr', '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Hotel Ref</label>
                        <input type="text" class="form-control" name="hotel_ref" value="{{ old('hotel_ref', '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cruise Ref</label>
                        <input type="text" class="form-control" name="cruise_ref" value="{{ old('cruise_ref', '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', '') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Calling Phone No. <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone', '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Query Type</label>
                        <input type="text" class="form-control" name="query_type" value="{{ old('query_type', 'New Booking') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Company Organisation</label>
                        <input type="text" class="form-control" name="selected_company" value="{{ old('selected_company', 'cruiseroyals') }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Booking Status</label>
                        <input type="text" class="form-control" name="booking_status" value="{{ old('booking_status', 'under process') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Payment Status</label>
                        <input type="text" class="form-control" name="payment_status" value="{{ old('payment_status', 'pending') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Reservation Source</label>
                        <input type="text" class="form-control" name="reservation_source" value="{{ old('reservation_source', '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Descriptor</label>
                        <input type="text" class="form-control" name="descriptor" value="{{ old('descriptor', '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Amadeus/Sabre PNR</label>
                        <input type="text" class="form-control" name="amadeus_sabre_pnr" value="{{ old('amadeus_sabre_pnr', '') }}">
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
                                    Its Come From API
                                    <img src="{{ url('flight.png') }}" alt="Flight Screen">
                                    {{-- <img src="{{ url('hotel.png') }}" alt="Flight Screen">
                                    <img src="{{ url('car.png') }}" alt="Flight Screen"> --}}
                                    <label class="form-label visually-hidden">Sector Type</label>
                                    <input type="text" class="form-control" name="sector_type" value="{{ old('sector_type', 'Flight') }}" placeholder="Enter sector type">
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
                            <button type="btn btn-sm btn-primary waves-effect waves-light" id="addPassengerBtn">
                                <i class="icon-base ri ri-add-circle-fill"></i>
                            </button>
                        </div>

                        <div id="passengerForms">
                            <!-- Passenger 1 -->
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
                                <div>
                                    <label class="form-label">DOB</label>
                                    <input type="date" class="form-control" name="passenger[0][dob]" value="{{ old('passenger.0.dob', '2025-04-10') }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Seat</label>
                                    <input type="text" class="form-control" name="passenger[0][seat_number]" value="{{ old('passenger.0.seat_number', '') }}" placeholder="Seat">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="passenger[0][title]" value="{{ old('passenger.0.title', 'Ms') }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Credit Note Amount</label>
                                    <input type="number" class="form-control" name="passenger[0][credit_note]" value="{{ old('passenger.0.credit_note', '0') }}" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="passenger[0][first_name]" value="{{ old('passenger.0.first_name', 'mnnfksdfs fsdjfds') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" name="passenger[0][middle_name]" value="{{ old('passenger.0.middle_name', '') }}" placeholder="Middle Name">
                                </div>
                                <div class="col-md-3 position-relative">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="passenger[0][last_name]" value="{{ old('passenger.0.last_name', 'cshcjxhds') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">E-Ticket</label>
                                    <input type="text" class="form-control" name="passenger[0][e_ticket_number]" value="{{ old('passenger.0.e_ticket_number', '') }}" placeholder="E Ticket">
                                </div>
                            </div>
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
                                <button type="button" class="btn btn-outline-secondary btn-sm">Submit Paylink</button>
                                <button type="btn btn-sm btn-primary waves-effect waves-light" id="addBillingBtn"><i class="icon-base ri ri-add-circle-fill"></i></button>
                            </div>
                        </div>
                        
                        <div class="card-body p-0">
                            <div class="row g-3 billing-card pt-2" data-index="0">
                                <h6 class="mb-0 billing-card-title">Card Details 1</h6>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder="Card Type" name="billing[0][card_type]" value="{{ old('billing.0.card_type', 'VISA') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder="CC Number" name="billing[0][cc_number]" value="{{ old('billing.0.cc_number', '123 789 346') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder="CC Holder Name" name="billing[0][cc_holder_name]" value="{{ old('billing.0.cc_holder_name', 'test') }}">
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control" placeholder="MM" name="billing[0][exp_month]" value="{{ old('billing.0.exp_month', '01') }}">
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control" placeholder="YYYY" name="billing[0][exp_year]" value="{{ old('billing.0.exp_year', '2024') }}">
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control" placeholder="CVV" name="billing[0][cvv]" value="{{ old('billing.0.cvv', '134') }}">
                                </div>
                                <div class="col-md-3 d-flex align-items-center">
                                    <input type="text" class="form-control" placeholder="Address" name="billing[0][address]" value="{{ old('billing.0.address', 'laxmi Nagrr') }}">
                                    <button type="button" class="btn btn-outline-danger ms-2 delete-billing-btn">
                                        <i class="ri ri-delete-bin-line"></i>
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <input type="email" class="form-control" placeholder="Email" name="billing[0][email]" value="{{ old('billing.0.email', 'test@gmail.com') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" placeholder="Contact No" name="billing[0][contact_no]" value="{{ old('billing.0.contact_no', '8510810544') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder="City" name="billing[0][city]" value="{{ old('billing.0.city', 'delhi') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder="Country" name="billing[0][country]" value="{{ old('billing.0.country', 'Afghanistan') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder="State" name="billing[0][state]" value="{{ old('billing.0.state', 'Badakhshan') }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder="ZIP Code" name="billing[0][zip_code]" value="{{ old('billing.0.zip_code', '110092') }}">
                                </div>
                                <div class="col-md-1">
                                    <input type="text" class="form-control" placeholder="Currency" name="billing[0][currency]" value="{{ old('billing.0.currency', 'USD') }}">
                                </div>
                                <div class="col-md-1">
                                    <input type="number" class="form-control" placeholder="0.00" name="billing[0][amount]" value="{{ old('billing.0.amount', '0') }}" step="0.01">
                                </div>
                                <div class="col-md-2 d-flex align-items-center">
                                    <label class="me-2">Active</label>
                                    <input class="form-check-input" type="radio" name="activeCard" value="1" checked {{ old('activeCard') == '0' ? 'checked' : '' }}>
                                </div>
                            </div>
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
                                    <input type="number" class="form-control" name="hotel_cost" value="{{ old('hotel_cost', '0.00') }}" placeholder="0.00" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Cruise Cost ($)<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="cruise_cost" value="{{ old('cruise_cost', '0.00') }}" placeholder="0.00" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Total Amount ($)<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="total_amount" value="{{ old('total_amount', '0.00') }}" placeholder="0.00" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Advisor MCO ($)</label>
                                    <input type="number" class="form-control" name="advisor_mco" value="{{ old('advisor_mco', '12.00') }}" placeholder="0.00" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Conversion Charge ($)</label>
                                    <input type="number" class="form-control" name="conversion_charge" value="{{ old('conversion_charge', '12.00') }}" placeholder="0.00" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Airline Commission ($)</label>
                                    <input type="number" class="form-control" name="airline_commission" value="{{ old('airline_commission', '0.00') }}" placeholder="0.00" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Final Amount ($)</label>
                                    <input type="number" class="form-control" name="final_amount" value="{{ old('final_amount', '12.00') }}" placeholder="0.00" step="0.01">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Merchant</label>
                                    <input type="text" class="form-control" name="merchant" value="{{ old('merchant', 'Cheapofly') }}" placeholder="Merchant Name">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Net MCO ($)</label>
                                    <input type="number" class="form-control" name="net_mco" value="{{ old('net_mco', '0.00') }}" placeholder="0.00" step="0.01">
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
                            <h5 class="card-header border-0 p-0">Booking Remarks</h5>
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
                            <textarea class="form-control mb-4" name="particulars" rows="4" placeholder="Enter remarks here...">{{ old('particulars', '') }}</textarea>
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
                                        <tr>
                                            <td>1</td>
                                            <td>Alex Morgan</td>
                                            <td>2025-04-10 14:30</td>
                                            <td>Called to confirm ticket details</td>
                                        </tr>
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
                            <textarea class="form-control mb-4" name="feedback" rows="4" placeholder="Enter feedback here...">{{ old('feedback', '') }}</textarea>
                            <div class="row row-cols-2 row-cols-md-4 g-2 mb-4">
                                <div class="col">
                                    <label class="btn btn-outline-secondary w-100">
                                        <input type="radio" name="param" value="Probing & Understanding" {{ old('param') == 'Probing & Understanding' ? 'checked' : '' }}> Probing & Understanding
                                    </label>
                                </div>
                            </div>
                            <div class="mb-4" style="max-width: 200px;">
                                <select class="form-select" name="status">
                                    <option value="" {{ old('status') == '' ? 'selected' : '' }}>Select Status</option>
                                    <option value="Pass" {{ old('status') == 'Pass' ? 'selected' : '' }}>Pass</option>
                                    <option value="Fail" {{ old('status') == 'Fail' ? 'selected' : '' }}>Fail</option>
                                    <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
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
                                        <tr>
                                            <td>Sana Maria</td>
                                            <td>2025-04-10 11:15</td>
                                            <td>Agent showed excellent probing skills.</td>
                                            <td>Probing & Understanding, Soft Skills</td>
                                            <td>Pass</td>
                                        </tr>
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
                                    <option value="Flight" {{ old('type') == 'Flight' ? 'selected' : '' }}>Flight</option>
                                    <option value="Hotel" {{ old('type') == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                                    <option value="Car" {{ old('type') == 'Car' ? 'selected' : '' }}>Car</option>
                                </select>
                                <button type="button" class="btn btn-warning">
                                    <i class="ri ri-save-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="notes" rows="4" placeholder="Enter notes here...">{{ old('notes', '') }}</textarea>
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