@extends('web.layouts.main')

@section('content')

<form id="bookingForm" action="{{ route('travel.bookings.submit') }}" method="POST" enctype="multipart/form-data">

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
                            <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox" id="booking-flight" value="Flight" {{ in_array('Flight', old('booking-type', ['Flight'])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-flight">Flight</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox" id="booking-hotel" value="Hotel" {{ in_array('Hotel', old('booking-type', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-hotel">Hotel</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox" id="booking-cruise" value="Cruise" {{ in_array('Cruise', old('booking-type', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-cruise">Cruise</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox" id="booking-car" value="Car" {{ in_array('Car', old('booking-type', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-car">Car</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox" id="booking-train" value="Train" {{ in_array('Train', old('booking-type', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-train">Train</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-primary text-center">
                            <i class="icon-base ri ri-save-2-fill"></i> Save
                        </button>
                        <!-- <button type="button" class="btn btn-sm btn-dark text-center">
                            <i class="icon-base ri ri-mail-send-fill"></i> Send
                        </button> -->
                    </div>
                </div>
            </div>

            <!-- Booking Form Card -->
            <div class="card p-4 mb-4">
                <div class="row mb-3">

                    <div class="col-md-3">
                        <label class="form-label">PNR <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="pnr" value="{{ $pnr }}" readonly>
                    </div>


                    <fieldset id="flight-inputs" class="toggle-section">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">Airline PNR</label>
                                <input type="text" class="form-control" name="airlinepnr" value="{{ old('airlinepnr', '') }}" placeholder="Airline PNR">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Amadeus/Sabre PNR</label>
                                <input type="text" class="form-control" name="amadeus_sabre_pnr" value="{{ old('amadeus_sabre_pnr', '') }}">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label"> PNR Type</label>
                                <select class="form-control" name="pnrtype">
                                    <option value="">Select</option>
                                    <option value="HK">HK</option>
                                    <option value="GK">GK</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>


                    <div class="col-md-3"  id="hotel-inputs">
                        <label class="form-label">Hotel Ref</label>
                        <input type="text" class="form-control" name="hotel_ref" value="{{ old('hotel_ref', '') }}" placeholder="Hotel Ref">
                    </div>


                    <div class="col-md-3"  id="cruise-inputs">
                        <label class="form-label">Cruise Ref</label>
                        <input type="text" class="form-control" name="cruise_ref" value="{{ old('cruise_ref', '') }}" placeholder="Cruise Ref">
                    </div>

                    <div class="col-md-3"  id="car-inputs" >
                        <label class="form-label">Car Ref</label>
                        <input type="text" class="form-control" name="car_ref" value="{{ old('car_ref', '') }}" placeholder="Car Ref">
                    </div>


                    <div class="col-md-3" id="train-inputs">
                        <label class="form-label">Train Ref</label>
                        <input type="text" class="form-control" name="train_ref" value="{{ old('train_ref', '') }}" placeholder="Train Ref">
                    </div>



                    <div class="col-md-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', '') }}">
                    </div>


                    <div class="col-md-3">
                        <label class="form-label">Calling Phone No. <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone', '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', '') }}">
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
                        <label class="form-label">Booking Status</label>
                        <select class="form-control" name="booking_status">
                            <option value="under process">under process</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Payment Status</label>
                        <select class="form-control" name="payment_status">
                            <option value="pending">pending</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Query Type</label>
                        <select id="query_type" class="form-control" name="query_type">
                            <option value="N">New Booking</option>
                            <option value="NC">New Booking(Credit)</option>
                            <option value="M">New Booking(Miles)</option>
                            <option value="UMNR">Unaccompanied Minor Reservation</option>
                            <option value="CC">Cancel(Credit)</option>
                            <option value="CR">Cancel(Refund)</option>
                            <option value="CH">Change</option>
                            <option value="U">Upgrade</option>
                            <option value="NMC">Name Correction</option>
                            <option value="S">Seat Assignment</option>
                            <option value="B">Baggage Addition</option>
                            <option value="CBP">Change Bed Preference</option>
                            <option value="AI">Infant Addition</option>
                            <option value="AE">Adding Excursion</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Company Organisation</label>
                         <select id="selected_company" name="selected_company" class="form-control">
                            <option value="1">flydreamz</option>
                            <option value="3">fareticketsllc</option>
                            <option value="5">fareticketsus</option>
                            <option value="6">cruiselineservice</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label"> Campaign</label>
                        <select class="form-control" name="campaign">
                            <option value="">Select</option>
                            <option value="Agency">Agency</option>
                            <option value="Airline Mix">Airline Mix</option>
                            <option value="Buffer Mix">Buffer Mix</option>
                            <option value="Cruise">Cruise</option>
                            <option value="International">International</option>
                            <option value="LCC ">LCC </option>
                            <option value="Major Mix">Major Mix</option>
                            <option value="Premium Amtrak Bing Calls">Premium Amtrak Bing Calls</option>
                            <option value="Pure AA">Pure AA</option>
                            <option value="Spanish">Spanish</option>
                        </select>
                    </div>





                </div>
            </div>

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs my-5" id="bookingTabs" role="tablist">


    <li class="nav-item" role="presentation" data-tab="Flight">
        <a class="nav-link" id="flightbooking-tab" data-bs-toggle="tab" href="#flightbooking" role="tab" aria-controls="flightbooking" aria-selected="true">Flight Booking</a>
    </li>
    <li class="nav-item" role="presentation" data-tab="Hotel">
        <a class="nav-link" id="hotelbooking-tab" data-bs-toggle="tab" href="#hotelbooking" role="tab" aria-controls="hotelbooking" aria-selected="true">Hotel Booking</a>
    </li>
    <li class="nav-item" role="presentation" data-tab="Cruise">
        <a class="nav-link" id="cruisebooking-tab" data-bs-toggle="tab" href="#cruisebooking" role="tab" aria-controls="cruisebooking" aria-selected="true">Cruise Booking</a>
    </li>
    <li class="nav-item" role="presentation" data-tab="Car">
        <a class="nav-link" id="carbooking-tab" data-bs-toggle="tab" href="#carbooking" role="tab" aria-controls="carbooking" aria-selected="true">Car Booking</a>
    </li>
    <li class="nav-item" role="presentation" data-tab="Train">
        <a class="nav-link" id="trainbooking-tab" data-bs-toggle="tab" href="#trainbooking" role="tab" aria-controls="trainbooking" aria-selected="true">Train Booking</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="passenger-tab" data-bs-toggle="tab" href="#passenger" role="tab" aria-controls="passenger" aria-selected="false">Passengers</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="billing-tab" data-bs-toggle="tab" href="#billing" role="tab" aria-controls="billing" aria-selected="false">Billing</a>
    </li>

    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pricing-tab" data-bs-toggle="tab" href="#pricing" role="tab" aria-controls="pricing" aria-selected="false">Pricing</a>
    </li>

    <li class="nav-item" role="presentation">
        <a class="nav-link" id="remarks-tab" data-bs-toggle="tab" href="#remarks" role="tab" aria-controls="remarks" aria-selected="false">Booking Remarks</a>
    </li>
     <!-- <li class="nav-item" role="presentation">
                    <a class="nav-link" id="feedback-tab" data-bs-toggle="tab" href="#feedback" role="tab" aria-controls="feedback" aria-selected="false">Quality Feedback</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="screenshots-tab" data-bs-toggle="tab" href="#screenshots" role="tab" aria-controls="screenshots" aria-selected="false">Screenshots</a>
                </li> -->
</ul>




            <!-- Tab Content -->
            <div class="tab-content" id="bookingTabsContent">

                <div class="tab-pane fade" id="flightbooking" role="tabpanel" aria-labelledby="flightbooking-tab">
                    <div class="card p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-header border-0 p-0">Flight Booking Details</h5>
                            </div>
                            <div class="card-body pt-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12 table-responsive">
                                        <table id="flightTable" class="table">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Direction</th>
                                                    <th>Date</th>
                                                    <th>Airlines (Code)</th>
                                                    <th>Flight No</th>
                                                    <th>Cabin</th>
                                                    <th>Class of Service</th>
                                                    <th>Departure Airport</th>
                                                    <th>Hrs</th>
                                                    <th>mm</th>
                                                    <th>Arrival Airport</th>
                                                    <th>Hrs</th>
                                                    <th>mm</th>
                                                    <th>Duration</th>
                                                    <th>Transit</th>
                                                    <th>Arrival Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="flightForms"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="carbooking" role="tabpanel" aria-labelledby="carbooking-tab">
                    <div class="card p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-header border-0 p-0">Car Booking Details</h5>
                            </div>
                            <div class="card-body pt-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12 table-responsive">
                                        <table id="carTable" class="table">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Car Rental Provider</th>
                                                    <th>Car Type</th>
                                                    <th>Pick-up Location</th>
                                                    <th>Drop-off Location</th>
                                                    <th>Pick-up Date</th>
                                                    <th>Pick-up Time</th>
                                                    <th>Drop-off Date</th>
                                                    <th>Drop-off Time</th>
                                                    <th>Confirmation Number</th>
                                                    <th>Remarks</th>
                                                    <th>Rental Provider's Address</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="carForms"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="cruisebooking" role="tabpanel" aria-labelledby="cruisebooking-tab">
                    <div class="card p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-header border-0 p-0">Cruise Booking Details</h5>
                            </div>
                            <div class="card-body pt-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12 table-responsive">
                                    <table id="cruiseTable" class="table">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Date</th>
                                                <th>Cruise Line</th>
                                                <th>Name of the Ship</th>
                                                <th>Category</th>
                                                <th>Stateroom</th>
                                                <th>Departure Port</th>
                                                <th>Departure Date</th>
                                                <th>Hrs</th>
                                                <th>mm</th>
                                                <th>Arrival Port</th>
                                                <th>Arrival Date</th>
                                                <th>Hrs</th>
                                                <th>mm</th>
                                                <th>Remarks</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cruiseForms"></tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="hotelbooking" role="tabpanel" aria-labelledby="hotelbooking-tab">
                    <div class="card p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-header border-0 p-0">Hotel Booking Details</h5>
                            </div>
                            <div class="card-body pt-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12 table-responsive">
                                        <table id="hotelTable" class="table">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Hotel Name</th>
                                                    <th>Room Category</th>
                                                    <th>Check-in Date</th>
                                                    <th>Check-out Date</th>
                                                    <th>No. Of Rooms</th>
                                                    <th>Confirmation Number</th>
                                                    <th>Hotel Address</th>
                                                    <th>Remarks</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="hotelForms"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="tab-pane fade " id="passenger" role="tabpanel" aria-labelledby="passenger-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">Passenger Details</h4>
                        </div>
                        <div class="excel-like-container table-responsive">
                            <table class="passenger-table table">
                                <thead>
                                    <tr>
                                       <th>S.No</th>
                                        <th>Type</th>
                                        <th>Gender</th>
                                        <th>Title</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>DOB</th>
                                        <th>Seat</th>
                                        <th>Credit Note</th>
                                        <th>E-Ticket</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="passengerForms">
                                    <tr class="passenger-form" data-index="0">
                                        <td>
                                            <span class="billing-card-title"> 1</span>
                                        </td>
                                        <td>
                                            <select class="form-control" style="width:7.5rem" name="passenger[0][passenger_type]">
                                                <option value="">Select</option>
                                                <option value="Adult" {{ old('passenger.0.passenger_type') === 'Adult' ? 'selected' : '' }}>Adult</option>
                                                <option value="Child" {{ old('passenger.0.passenger_type') === 'Child' ? 'selected' : '' }}>Child</option>
                                                <option value="Infant" {{ old('passenger.0.passenger_type') === 'Infant' ? 'selected' : '' }}>Infant</option>
                                                <option value="Seat Infant" {{ old('passenger.0.passenger_type') === 'Seat Infant' ? 'selected' : '' }}>Seat Infant</option>
                                                <option value="Lap Infant" {{ old('passenger.0.passenger_type') === 'Lap Infant' ? 'selected' : '' }}>Lap Infant</option>
                                            </select>
                                        </td>
                                        <td>
                                           <select class="form-control" style="width:7.5rem" name="passenger[0][gender]">
                                                <option value="">Select</option>
                                                <option value="Male" {{ old('passenger.0.gender', 'Male') === 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ old('passenger.0.gender') === 'Female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="width:7.5rem" name="passenger[0][title]">
                                                <option value="">Select</option>
                                                <option value="Mr" {{ old('passenger.0.title', 'Ms') === 'Mr' ? 'selected' : '' }}>Mr</option>
                                                <option value="Mrs" {{ old('passenger.0.title', 'Ms') === 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                                <option value="Ms" {{ old('passenger.0.title', 'Ms') === 'Ms' ? 'selected' : '' }}>Ms</option>
                                                <option value="Master" {{ old('passenger.0.title', 'Ms') === 'Master' ? 'selected' : '' }}>Master</option>
                                                <option value="Miss" {{ old('passenger.0.title', 'Ms') === 'Miss' ? 'selected' : '' }}>Miss</option>
                                            </select>
                                        </td>

                                        <td>
                                            <input type="text" style="width:7.5rem" class="form-control" name="passenger[0][first_name]" placeholder="First Name">
                                        </td>
                                        <td>
                                            <input type="text" style="width:7.5rem" class="form-control" name="passenger[0][middle_name]" placeholder="Middle Name">
                                        </td>
                                        <td>
                                            <input type="text" style="width:7.5rem" class="form-control" name="passenger[0][last_name]" placeholder="Last Name">
                                        </td>
                                        <td>
                                            <input type="date"  class="form-control" name="passenger[0][dob]" >
                                        </td>
                                        <td>
                                            <input type="text" style="width:7.5rem" class="form-control" name="passenger[0][seat_number]" placeholder="Seat">
                                        </td>
                                        <td>
                                            <input type="number" style="width:7.5rem" class="form-control" name="passenger[0][credit_note]" placeholder="0" step="0.01">
                                        </td>
                                        <td>
                                            <input type="text" style="width:7.5rem" class="form-control" name="passenger[0][e_ticket_number]" placeholder="E Ticket">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-passenger">
                                                <i class="icon-base ri ri-delete-bin-2-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-header border-0 p-0">Billing Details</h5>
                            <div>
                                <button type="button" class="btn btn-outline-secondary btn-sm submit-paylink-btn">Submit Paylink</button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="excel-like-container table-responsive">
                                <table class="billing-table table">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Card Type</th>
                                            <th>CC Number</th>
                                            <th>CC Holder Name</th>
                                            <th>MM</th>
                                            <th>YYYY</th>
                                            <th>CVV</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Contact No</th>
                                            <th>City</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>ZIP Code</th>
                                            <th>Currency</th>
                                            <th>Amount</th>
                                            <th>Active</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="billingForms">
                                        <tr class="billing-card" data-index="0">
                                            <td><h6 class="billing-card-title mb-0"> 1</h6></td>
                                            <td>
                                               <select style="width:7.5rem" class="form-control" name="billing[0][card_type]">
                                                    <option value="">Select</option>
                                                    <option value="VISA" {{ old('billing.0.card_type', 'VISA') === 'VISA' ? 'selected' : '' }}>VISA</option>
                                                    <option value="Mastercard" {{ old('billing.0.card_type') === 'Mastercard' ? 'selected' : '' }}>Mastercard</option>
                                                    <option value="AMEX" {{ old('billing.0.card_type') === 'AMEX' ? 'selected' : '' }}>AMEX</option>
                                                    <option value="DISCOVER" {{ old('billing.0.card_type') === 'DISCOVER' ? 'selected' : '' }}>DISCOVER</option>
                                                </select>
                                            </td>

                                            <td><input type="text" style="width:7.5rem" class="form-control" placeholder="CC Number" name="billing[0][cc_number]" ></td>
                                            <td><input type="text" style="width:10rem" class="form-control" placeholder="CC Holder Name" name="billing[0][cc_holder_name]" ></td>

                                            <td>
                                                <select class="form-control" style="width:7.5rem" name="billing[0][exp_month]">
                                                    <option value="">MM</option>
                                                    <option value="01" {{ old('billing.0.exp_month', '01') === '01' ? 'selected' : '' }}>01</option>
                                                    <option value="02" {{ old('billing.0.exp_month') === '02' ? 'selected' : '' }}>02</option>
                                                    <option value="03" {{ old('billing.0.exp_month') === '03' ? 'selected' : '' }}>03</option>
                                                    <option value="04" {{ old('billing.0.exp_month') === '04' ? 'selected' : '' }}>04</option>
                                                    <option value="05" {{ old('billing.0.exp_month') === '05' ? 'selected' : '' }}>05</option>
                                                    <option value="06" {{ old('billing.0.exp_month') === '06' ? 'selected' : '' }}>06</option>
                                                    <option value="07" {{ old('billing.0.exp_month') === '07' ? 'selected' : '' }}>07</option>
                                                    <option value="08" {{ old('billing.0.exp_month') === '08' ? 'selected' : '' }}>08</option>
                                                    <option value="09" {{ old('billing.0.exp_month') === '09' ? 'selected' : '' }}>09</option>
                                                    <option value="10" {{ old('billing.0.exp_month') === '10' ? 'selected' : '' }}>10</option>
                                                    <option value="11" {{ old('billing.0.exp_month') === '11' ? 'selected' : '' }}>11</option>
                                                    <option value="12" {{ old('billing.0.exp_month') === '12' ? 'selected' : '' }}>12</option>
                                                </select>
                                            </td>

                                           <td>
                                                <select class="form-control" style="width:7.5rem" name="billing[0][exp_year]">
                                                    <option value="">YYYY</option>
                                                    <option value="2024" {{ old('billing.0.exp_year', '2024') === '2024' ? 'selected' : '' }}>2024</option>
                                                    <option value="2025" {{ old('billing.0.exp_year') === '2025' ? 'selected' : '' }}>2025</option>
                                                    <option value="2026" {{ old('billing.0.exp_year') === '2026' ? 'selected' : '' }}>2026</option>
                                                    <option value="2027" {{ old('billing.0.exp_year') === '2027' ? 'selected' : '' }}>2027</option>
                                                    <option value="2028" {{ old('billing.0.exp_year') === '2028' ? 'selected' : '' }}>2028</option>
                                                    <option value="2029" {{ old('billing.0.exp_year') === '2029' ? 'selected' : '' }}>2029</option>
                                                    <option value="2030" {{ old('billing.0.exp_year') === '2030' ? 'selected' : '' }}>2030</option>
                                                    <option value="2031" {{ old('billing.0.exp_year') === '2031' ? 'selected' : '' }}>2031</option>
                                                    <option value="2032" {{ old('billing.0.exp_year') === '2032' ? 'selected' : '' }}>2032</option>
                                                    <option value="2033" {{ old('billing.0.exp_year') === '2033' ? 'selected' : '' }}>2033</option>
                                                    <option value="2034" {{ old('billing.0.exp_year') === '2034' ? 'selected' : '' }}>2034</option>
                                                </select>
                                            </td>

                                            <td><input type="text" style="width:7.5rem" class="form-control" placeholder="CVV" name="billing[0][cvv]"></td>
                                            <td><input type="text" style="width:7.5rem" class="form-control" placeholder="Address" name="billing[0][address]"></td>
                                            <td><input type="email" style="width:7.5rem" class="form-control" placeholder="Email" name="billing[0][email]" ></td>
                                            <td><input type="text" style="width:7.5rem" class="form-control" placeholder="Contact No" name="billing[0][contact_no]"></td>
                                            <td><input type="text" style="width:7.5rem" class="form-control" placeholder="City" name="billing[0][city]"></td>

                                            <td>
                                                <select id="country-0" style="width:9rem" class="form-control country-select" name="billing[0][country]">
                                                    <option value="">Select Country</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="state-0" style="width:7.5rem" class="form-control state-select" name="billing[0][state]">
                                                    <option value="">Select State</option>
                                                </select>
                                            </td>

                                            <td><input type="text" style="width:7.5rem" class="form-control" placeholder="ZIP Code" name="billing[0][zip_code]" ></td>

                                            <td>
                                                <select class="form-control" style="width:7.5rem" name="billing[0][currency]">
                                                    <option value="">Select Currency</option>
                                                    <option value="USD" {{ old('billing.0.currency', 'USD') === 'USD' ? 'selected' : '' }}>USD</option>
                                                    <option value="CAD" {{ old('billing.0.currency') === 'CAD' ? 'selected' : '' }}>CAD</option>
                                                    <option value="EUR" {{ old('billing.0.currency') === 'EUR' ? 'selected' : '' }}>EUR</option>
                                                    <option value="GBP" {{ old('billing.0.currency') === 'GBP' ? 'selected' : '' }}>GBP</option>
                                                    <option value="AUD" {{ old('billing.0.currency') === 'AUD' ? 'selected' : '' }}>AUD</option>
                                                    <option value="INR" {{ old('billing.0.currency') === 'INR' ? 'selected' : '' }}>INR</option>
                                                    <option value="MXN" {{ old('billing.0.currency') === 'MXN' ? 'selected' : '' }}>MXN</option>
                                                </select>
                                            </td>

                                            <td><input type="number" style="width:7.5rem" class="form-control" placeholder="0.00" name="billing[0][amount]" value="0" step="0.01"></td>
                                            <td><input class="form-check-input" type="radio" name="activeCard" value="0" checked></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-danger delete-billing-btn">
                                                    <i class="ri ri-delete-bin-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-header border-0 p-0">Pricing Details</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="excel-like-container table-responsive">
                                <table class="pricing-table table">
                                    <thead>
                                    <tr>
                                        <th data-column="flight">Flight Cost($)</th>
                                        <th data-column="hotel">Hotel Cost ($)</th>
                                        <th data-column="cruise">Cruise Cost ($)</th>
                                        <th data-column="car">Car Cost ($)</th>
                                        <th data-column="train">Train Cost ($)</th>
                                        <th>Total Amount ($)</th>
                                        <th data-column="flight">Issuance Fee ($)</th>
                                        <th>Advisor MCO ($)</th>
                                        <th data-column="flight">Airline Commission ($)</th>
                                        <th>Final Amount ($)</th>
                                        <th>Merchant</th>
                                        <th>Net MCO ($)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td data-column="flight">
                                            <input type="number" style="width:7.5rem" class="form-control" name="flight_cost" value="0.00" placeholder="0.00" step="0.01">
                                        </td>
                                        <td data-column="hotel">
                                            <input type="number" style="width:7.5rem" class="form-control" name="hotel_cost" value="0.00" placeholder="0.00" step="0.01">
                                        </td>
                                        <td data-column="cruise">
                                            <input type="number" style="width:7.5rem" class="form-control" name="cruise_cost" value="0.00" placeholder="0.00" step="0.01">
                                        </td>
                                        <td data-column="car">
                                            <input type="number" style="width:7.5rem" class="form-control" name="car_cost" value="0.00" placeholder="0.00" step="0.01">
                                        </td>
                                        <td data-column="train">
                                            <input type="number" style="width:7.5rem" class="form-control" name="train_cost" value="0.00" placeholder="0.00" step="0.01">
                                        </td>
                                        <td>
                                            <input type="number" style="width:7.5rem" class="form-control" name="total_amount" value="0.00" placeholder="0.00" step="0.01">
                                        </td>
                                        <td data-column="flight">
                                            <input type="number" style="width:7.5rem" class="form-control" name="issuance_fee" value="0.00" placeholder="0.00" step="0.01">
                                        </td>
                                        <td>
                                            <input type="number" style="width:7.5rem" class="form-control" name="advisor_mco" value="12.00" placeholder="0.00" step="0.01">
                                        </td>
                                        <td data-column="flight">
                                            <input type="number" style="width:10rem" class="form-control" name="airline_commission" value="0.00" placeholder="0.00" step="0.01">
                                        </td>
                                        <td>
                                            <input type="number" style="width:7.5rem" class="form-control" name="final_amount" value="12.00" placeholder="0.00" step="0.01">
                                        </td>
                                        <td>
                                            <select class="form-control" style="width:9rem" name="merchant">
                                                <option value="">Select Merchant</option>
                                                <option value="15">Flydreamz</option>
                                                <option value="15">CruiseLineService</option>
                                                <option value="15">FareTickets</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" style="width:7.5rem" class="form-control" name="net_mco" value="0.00" placeholder="0.00" step="0.01">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

             <!-----------------------------------Pricing ------------------------------------------>

                <!-- Booking Remarks -->
                <div class="tab-pane fade" id="remarks" role="tabpanel" aria-labelledby="remarks-tab"   >
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-header border-0 p-0">Booking Remarks</h5>
                        </div>
                        <div class="card-body p-0">
                            <textarea class="form-control mb-4" name="particulars" rows="4" placeholder="Enter remarks here...">{{ old('particulars', '') }}</textarea>
                        </div>
                    </div>


                </div>


            </div>
        </div>
    </div>
</form>

                <!-- FilePond styles -->
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet" />

<!-- FilePond scripts -->
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
@vite('resources/js/booking/create.js')

@endsection
