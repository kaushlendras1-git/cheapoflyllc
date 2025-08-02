@extends('web.layouts.main')
@section('content')
<style>
/* Ensure FilePond container doesn't shrink weirdly */
.filepond--root {
    width: 100% !important;
    max-width: 100%;
    box-sizing: border-box;
}

/* Optional: give a min-height if it's collapsing */
.filepond--drop-label {
    min-height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

/* Prevent vertical stacking of drag message */
.filepond--drop-label label {
    white-space: nowrap;
    text-align: center;
}

.filepond--item {
    width: calc(50% - 0.5em);
}
</style>

<span id="flight_uploaded_files" data-baseUrl="{{asset('')}}" data-images="{{$booking->flightbookingimage}}"></span>
<span id="hotel_uploaded_files" data-baseUrl="{{asset('')}}" data-images="{{$booking->hotelbookingimage}}"></span>
<span id="cruise_uploaded_files" data-baseUrl="{{asset('')}}" data-images="{{$booking->cruisebookingimage}}"></span>
<span id="car_uploaded_files" data-baseUrl="{{asset('')}}" data-images="{{$booking->carbookingimage}}"></span>
<span id="train_uploaded_files" data-baseUrl="{{asset('')}}" data-images="{{$booking->trainbookingimage}}"></span>
<span id="screenshots_uploaded_files" data-baseUrl="{{asset('')}}" data-images="{{$booking->screenshot}}"></span>


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="upper-titles d-flex align-items-center justify-content-between mb-4">
            <h2 class="mb-0">Edit Booking</h2>
            <nav style="--bs-breadcrumb-divider: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&quot;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb d-flex align-items-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Booking</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="card p-4 create-booking-wrapper">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="d-flex" style="font-size: 12px;">
                            <strong style="color: #1a3c5e; font-weight: 700; margin-right: 5px;">Sales:</strong><span style="color: #2c3e50; margin-right: 20px;">Roger</span>
                            <strong style="color: #1a3c5e; font-weight: 700; margin-right: 5px;">Changes:</strong><span style="color: #2c3e50; margin-right: 20px;">Zee</span>
                            <strong style="color: #1a3c5e; font-weight: 700; margin-right: 5px;">Billing:</strong><span style="color: #2c3e50; margin-right: 20px;">Mark</span>
                            <strong style="color: #1a3c5e; font-weight: 700; margin-right: 5px;">Quality:</strong><span style="color: #2c3e50; margin-right: 20px;">Smith</span>
                            <strong style="color: #1a3c5e; font-weight: 700; margin-right: 5px;">Issued On:</strong><span style="color: #2c3e50; margin-right: 20px;">12 July 2025</span>
                            <strong style="color: #1a3c5e; font-weight: 700; margin-right: 5px;">Shared :</strong><span style="color: #2c3e50;margin-right: 20px;">Agent</span>
                            <strong style="color: #1a3c5e; font-weight: 700; margin-right: 5px;">Booking :</strong><span style="color: #2c3e50;margin-right: 20px;">{{$booking->id}}</span> 
                            <strong style="color: #1a3c5e; font-weight: 700; margin-right: 5px;">Qc Score :</strong><span style="color: #2c3e50;margin-right: 20px;">78%</span> 
                            <strong style="color: #1a3c5e; font-weight: 700; margin-right: 5px;">Qc Status :</strong><span style="color: #2c3e50;">Approved</span> 
                        </div>
                    <div class="d-flex gap-2">
                        @include('web.booking.authModel')
                        <a href="{{ route('auth-history', $hashids) }}"
                            class="btn btn-outline-secondary btn-sm rounded-pill">
                            Auth History
                        </a>
                    </div>
                </div>

            <form id="bookingForm" action="{{ route('booking.update', $booking->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Content -->

                @include('web.layouts.flash')
                @php
                $bookingTypes = $booking->bookingTypes->pluck('type')->toArray();
                @endphp


                <input type="hidden" name="booking_id" value="{{ $booking->id ?? '' }}">
                <!-- Top Bar -->
                <div class="pt-3 mt-2 ps-0">
                    <div class="d-flex justify-content-between align-items-center flex-wrap checkbox-servis">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div class="form-check form-check-inline">
                                <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox"
                                    id="booking-flight" value="Flight"
                                    {{ in_array('Flight', $bookingTypes) ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-flight">Flight</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox"
                                    id="booking-hotel" value="Hotel"
                                    {{ in_array('Hotel', $bookingTypes) ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-hotel">Hotel</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox"
                                    id="booking-cruise" value="Cruise"
                                    {{ in_array('Cruise', $bookingTypes) ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-cruise">Cruise</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox"
                                    id="booking-car" value="Car" {{ in_array('Car', $bookingTypes) ? 'checked' : '' }}>
                                <label class="form-check-label" for="booking-car">Car</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox"
                                    id="booking-train" value="Train"
                                    {{ in_array('Train', $bookingTypes) ? 'checked' : '' }}>
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
                <div class="pt-5 ps-0">
                    <div class="row booking-form">
                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">PNR <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="pnr" value="{{ $booking->pnr }}" readonly>
                        </div>
                        <fieldset id="flight-inputs" class="toggle-section col-md-6">
                            <div class="row">
                                <div class="col-md-4 position-relative mb-5">
                                    <label class="form-label">Airline PNR</label>
                                    <input type="text" class="form-control" name="airlinepnr"
                                        value="{{ $booking->airlinepnr }}" placeholder="Airline PNR">
                                </div>

                                <div class="col-md-4 position-relative mb-5">
                                    <label class="form-label">Amadeus/Sabre PNR</label>
                                    <input type="text" class="form-control" name="amadeus_sabre_pnr"
                                        value="{{ $booking->amadeus_sabre_pnr }}">
                                </div>

                                <div class="col-md-4 position-relative mb-5">
                                    <label class="form-label"> PNR Type</label>
                                    <select class="form-control" name="pnrtype">
                                        <option value="">Select</option>
                                        <option value="HK" {{$booking->pnrtype == 'HK'?'selected':''}}>
                                            HK</option>
                                        <option value="GK" {{$booking->pnrtype == 'GK'?'selected':''}}>
                                            GK</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <div class="col-md-2 position-relative mb-5" id="hotel-inputs">
                            <label class="form-label">Hotel Ref</label>
                            <input type="text" class="form-control" name="hotel_ref"
                                value="{{ old('hotel_ref', $booking->hotel_ref ?? '') }}" placeholder="Hotel Ref">
                        </div>
                        <div class="col-md-2 position-relative mb-5" id="cruise-inputs">
                            <label class="form-label">Cruise Ref</label>
                            <input type="text" class="form-control" name="cruise_ref"
                                value="{{ old('cruise_ref', $booking->cruise_ref ?? '') }}" placeholder="Cruise Ref">
                        </div>
                        <div class="col-md-2 position-relative mb-5" id="car-inputs">
                            <label class="form-label">Car Ref</label>
                            <input type="text" class="form-control" name="car_ref"
                                value="{{ old('car_ref', $booking->car_ref ?? '') }}" placeholder="Car Ref">
                        </div>
                        <div class="col-md-2 position-relative mb-5" id="train-inputs">
                            <label class="form-label">Train Ref</label>
                            <input type="text" class="form-control" name="train_ref"
                                value="{{ old('train_ref', $booking->train_ref ?? '') }}" placeholder="Train Ref">
                        </div>
                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $booking->name ?? '') }}">
                        </div>
                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Calling Phone No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone"
                                value="{{ old('phone', $booking->phone ?? '') }}">
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Reservation Source</label>
                            <input type="text" class="form-control" name="reservation_source"
                                value="{{ old('reservation_source', $booking->reservation_source ?? '') }}">
                        </div>
                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Descriptor</label>
                            <input type="text" class="form-control" name="descriptor"
                                value="{{ old('descriptor', $booking->descriptor ?? '') }}">
                        </div>
                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Booking Status</label>
                            <select class="form-control" name="booking_status_id">
                                @foreach($booking_status as $status)
                                <option value="{{$status->id}}"
                                    {{ old('booking_status_id', $booking->booking_status_id ?? '') === $status->is ? 'selected' : '' }}>
                                    {{ ucwords($status->name ?? '') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Payment Status</label>
                            <select class="form-control" name="payment_status_id">
                                @foreach($payment_status as $payment)
                                <option value="{{$payment->id}}"
                                    {{ old('payment_status_id', $booking->payment_status_id ?? '') === $payment->is ? 'selected' : '' }}>
                                    {{$payment->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">Booking Type</label>
                            <select id="query_type" class="form-control" name="query_type">

                                <option>Package Reservation</option>
                                <option data-type="Flight">Flight Reservation </option>
                                <option data-type="Flight">Flight Reservation with Credits & Vouchers</option>
                                <option data-type="Flight">Flight Reservation with Miles</option>
                                <option data-type="Flight">Passenger Name Corrections</option>
                                <option data-type="Flight">Flight Change Request</option>
                                <option data-type="Flight">Cabin Class Upgrade</option>
                                <option data-type="Flight">Seat Assignment</option>
                                <option data-type="Flight">Pet Reservation</option>
                                <option data-type="Flight">Cancellation for Credits</option>
                                <option data-type="Flight">Cancellation for Refunds</option>
                                <option data-type="Flight">Extention for Expired Credits & Vouchers</option>
                                <option data-type="Cruise">Cruise Reservation</option>
                                <option data-type="Cruise">Cruise Reservation With Credits & Vouchers</option>
                                <option data-type="Cruise">Casino Reservations</option>
                                <option data-type="Cruise">Cabin Upgrade/Change Requests</option>
                                <option data-type="Cruise">Date or Itinerary Changes</option>
                                <option data-type="Cruise">Passenger Name Corrections</option>
                                <option data-type="Cruise">Request for Adding a Passenger</option>
                                <option data-type="Cruise">Collection of Final Payment</option>
                                <option data-type="Cruise">Check-in Procedures</option>
                                <option data-type="Cruise">Booking Excursions</option>
                                <option data-type="Cruise">Dining and Beverage Packages</option>
                                <option data-type="Cruise">Spa and Wellness Pre-Bookings</option>
                                <option data-type="Cruise">Celebration Packages</option>
                                <option data-type="Cruise">Accessibility or Medical Needs</option>
                                <option data-type="Cruise">Speciality Dining Request</option>
                                <option data-type="Cruise">Cancellation for Future Credits</option>
                                <option data-type="Cruise">Cancellation for Refunds</option>
                                <option data-type="Cruise">Extentions on Due Payments</option>
                                <option data-type="Hotel">Hotel Reservation</option>
                                <option data-type="Hotel">Hotel Reservation with Rewards Points</option>
                                <option data-type="Hotel">Date Changes / Rebooking</option>
                                <option data-type="Hotel">Room Upgrade Requests</option>
                                <option data-type="Hotel">Room Change Request</option>
                                <option data-type="Hotel">Adding or Removing Guests</option>
                                <option data-type="Hotel">Guest's Name Correction</option>
                                <option data-type="Hotel">Parking Reservation Request</option>
                                <option data-type="Hotel">Cancellation for Future Credits</option>
                                <option data-type="Hotel">Cancellation for Refunds</option>
                                <option data-type="Car">Car Rental Reservation</option>
                                <option data-type="Car">Date or Time Changes Requests</option>
                                <option data-type="Car">Location Change (Pickup/Drop-off)</option>
                                <option data-type="Car">Cancellation for Refunds</option>
                                <option data-type="Train">New Reservation for Amtrak</option>
                                <option data-type="Train">Date or Time Change Request</option>
                                <option data-type="Train">Change of Route or Destination</option>
                                <option data-type="Train">Name Correction</option>
                                <option data-type="Train">Change in Number of Travelers</option>
                                <option data-type="Train">Upgrading Seat Class or Service</option>
                                <option data-type="Train">Seat Assignment or Preference Request</option>
                                <option data-type="Train">Missed Connections</option>
                                <option data-type="Train">Cancellation for Future Credits</option>
                                <option data-type="Train">Cancellation for Refunds</option>
                            </select>
                        </div>


                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label">LOB</label>
                            <select id="selected_company" name="selected_company" class="form-control">
                                <option value="1"
                                    {{ old('selected_company', $booking->selected_company ?? '') === '1' ? 'selected' : '' }}>
                                    flydreamz</option>
                                <option value="3"
                                    {{ old('selected_company', $booking->selected_company ?? '') === '3' ? 'selected' : '' }}>
                                    fareticketsllc</option>
                                <option value="5"
                                    {{ old('selected_company', $booking->selected_company ?? '') === '5' ? 'selected' : '' }}>
                                    fareticketsus</option>
                                <option value="6"
                                    {{ old('selected_company', $booking->selected_company ?? '') === '6' ? 'selected' : '' }}>
                                    cruiselineservice</option>
                            </select>
                        </div>

                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label"> Call Queue</label>
                            <select class="form-control" name="call_queue">
                                <option value="">Select
                                </option>
                                @foreach($campaigns as $campaign)
                                <option value="{{$campaign->name}}"
                                    {{$campaign->name == $booking->call_queue?'selected':''}}>
                                    {{$campaign->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-2 position-relative mb-5">
                            <label class="form-label"> Is Shared Booking</label>
                            <select class="form-control" name="shared_booking">
                                <option value="">Select
                                </option>
                                @foreach($campaigns as $campaign)
                                <option value="{{$campaign->name}}"
                                    {{$campaign->name == $booking->shared_booking?'selected':''}}>
                                    {{$campaign->name}}</option>
                                @endforeach
                            </select>
                        </div>



                    </div>
                </div>
        </div>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs tabs-booked" id="bookingTabs" role="tablist">

                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="passenger-tab" data-bs-toggle="tab" href="#passenger" role="tab"
                        aria-controls="passenger" aria-selected="true">
                        <i class="ri ri-user-3-fill" title="Passengers" style="color: #00008b; font-size: 28px;"></i>
                    </a>
                </li>


                <li class="nav-item" role="presentation" data-tab="Flight"
                    style="{{ in_array('Flight', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
                    <a class="nav-link" id="flightbooking-tab" data-bs-toggle="tab" href="#flightbooking" role="tab"
                        aria-controls="flightbooking" aria-selected="true"><i class="ri ri-flight-takeoff-line"
                            title="Flight" style="color: #1e90ff; font-size: 28px;"></i></a>
                </li>

                <li class="nav-item" role="presentation" data-tab="Hotel"
                    style="{{ in_array('Hotel', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
                    <a class="nav-link" id="hotelbooking-tab" data-bs-toggle="tab" href="#hotelbooking" role="tab"
                        aria-controls="hotelbooking" aria-selected="true"><i class="ri ri-hotel-fill" title="Hotel"
                            style="color: #8b4513; font-size: 28px;"></i></a>
                </li>

                <li class="nav-item" role="presentation" data-tab="Cruise"
                    style="{{ in_array('Cruise', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
                    <a class="nav-link" id="cruisebooking-tab" data-bs-toggle="tab" href="#cruisebooking" role="tab"
                        aria-controls="cruisebooking" aria-selected="true"><i class="ri ri-ship-fill" title="Cruise"
                            style="color: #006994; font-size: 28px;"></i></a>
                </li>

                <li class="nav-item" role="presentation" data-tab="Car"
                    style="{{ in_array('Car', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
                    <a class="nav-link" id="carbooking-tab" data-bs-toggle="tab" href="#carbooking" role="tab"
                        aria-controls="carbooking" aria-selected="true"><i class="ri ri-car-fill" title="Car"
                            style="color: #228b22; font-size: 28px;"></i></a>
                </li>

                <li class="nav-item" role="presentation" data-tab="Train"
                    style="{{ in_array('Train', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
                    <a class="nav-link" id="trainbooking-tab" data-bs-toggle="tab" href="#trainbooking" role="tab"
                        aria-controls="trainbooking" aria-selected="true">
                        <i class="ri ri-train-line" title="Train" style="color: #8a2be2; font-size: 28px;"></i></a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="billing-tab" data-bs-toggle="tab" href="#billing" role="tab"
                        aria-controls="billing" aria-selected="false">
                        <i class="ri ri-bank-line" style="font-size: 28px; color: #2e8b57;" title="Pricing"></i>
                    </a>
                </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pricing-tab" data-bs-toggle="tab" href="#pricing" role="tab"
                    aria-controls="pricing" aria-selected="false">

                        <i class="ri ri-money-dollar-circle-line" style="font-size: 28px; color: #6a5acd;"
                            title="Billing"></i>
                    </a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="remarks-tab" data-bs-toggle="tab" href="#remarks" role="tab"
                        aria-controls="remarks" aria-selected="false">
                        <i class="ri ri-sticky-note-line" style="font-size: 28px; color: #d2691e;"
                            title="Booking Remarks"></i>

                </a>
            </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="feedback-tab" data-bs-toggle="tab" href="#feedback" role="tab"
                        aria-controls="feedback" aria-selected="false">
                        <i class="ri ri-feedback-line" style="font-size: 28px; color: #4169e1;"
                            title="Quality Feedback"></i>

                </a>
            </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="screenshots-tab" data-bs-toggle="tab" href="#screenshots" role="tab"
                        aria-controls="screenshots" aria-selected="false">
                        <i class="ri ri-image-line" style="font-size: 28px; color: #ff6347;" title="Screenshots"></i>
                    </a>
                </li>

        </ul>




        <!-- Tab Content -->
        <div class="tab-content mt-0 p-0 booked-content" id="bookingTabsContent">


                <!----------------------------------------Passeenger-------------------------------------------------->
                <div class="tab-pane fade show active" id="passenger" role="tabpanel" aria-labelledby="passenger-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Passenger Details</h5>
                            <button class="btn btn-primary" type="button" id="passenger-detail-button">
                                <svg style="fill: white" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                </svg>
                            </button>
                        </div>
                        <div
                            class="excel-like-container table-responsive details-table-wrappper details-table-wrappper">
                            <table class="passenger-table table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Gender</th>
                                        <th>Title</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>DOB(dd-mm-yyyy)</th>
                                        <th>Seat</th>
                                        <th>Cr. OR <br>
                                            Ref. Amt.
                                        </th>
                                        <th>E-Ticket</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="passengerForms">
                                    @foreach($booking->passengers as $key=>$passengers)
                                    <tr class="passenger-form" data-index="{{$key}}">
                                        <td>
                                            <span class="billing-card-title"> {{$key+1}}</span>
                                        </td>
                                        <td>
                                            <select class="form-control" style="width:5.5rem"
                                                name="passenger[{{$key}}][passenger_type]">
                                                <option value="">Select</option>
                                                <option value="Adult"
                                                    {{$passengers->passenger_type=="Adult"?'selected':''}}>Adult
                                                </option>
                                                <option value="Child"
                                                    {{$passengers->passenger_type=="Child"?'selected':''}}>Child
                                                </option>
                                                <option value="Infant"
                                                    {{$passengers->passenger_type=="Infant"?'selected':''}}>Infant
                                                </option>
                                                <option value="Seat Infant"
                                                    {{$passengers->passenger_type=="Seat Infant"?'selected':''}}>Seat
                                                    Infant
                                                </option>
                                                <option value="Lap Infant"
                                                    {{$passengers->passenger_type=="Lap Infant"?'selected':''}}>Lap
                                                    Infant
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="width: 70px;"
                                                name="passenger[{{$key}}][gender]">
                                                <option value="">Select</option>
                                                <option value="Male" {{$passengers->gender == 'Male'?'selected':''}}>
                                                    Male
                                                </option>
                                                <option value="Female"
                                                    {{$passengers->gender == 'Female'?'selected':''}}>
                                                    Female</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="width:70px;"
                                                name="passenger[{{$key}}][title]">
                                                <option value="">Select</option>
                                                <option value="Mr" {{$passengers->title=="Mr"?"selected":''}}>Mr
                                                </option>
                                                <option value="Mrs" {{$passengers->title=="Mrs"?"selected":''}}>Mrs
                                                </option>
                                                <option value="Ms" {{$passengers->title=="Ms"?"selected":''}}>Ms
                                                </option>
                                                <option value="Master" {{$passengers->title=="Master"?"selected":''}}>
                                                    Master
                                                </option>
                                                <option value="Miss" {{$passengers->title=="Miss"?"selected":''}}>Miss
                                                </option>
                                            </select>
                                        </td>

                                    <td>
                                        <input type="text" style="width:7.5rem" class="form-control"
                                            name="passenger[{{$key}}][first_name]" value="{{$passengers->first_name}}"
                                            placeholder="First Name">
                                    </td>
                                    <td>
                                        <input type="text" style="width:7.5rem" class="form-control"
                                            name="passenger[{{$key}}][middle_name]" value="{{$passengers->middle_name}}"
                                            placeholder="Middle Name">
                                    </td>
                                    <td>
                                        <input type="text" style="width:7.5rem" class="form-control"
                                            name="passenger[{{$key}}][last_name]" value="{{$passengers->last_name}}"
                                            placeholder="Last Name">
                                    </td>
                                    <td>
                                        <input type="date" style="width: 105px;" class="form-control"
                                            name="passenger[{{$key}}][dob]"
                                            value="{{$passengers->dob?->format('Y-m-d')}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width:50px;" class="form-control"
                                            name="passenger[{{$key}}][seat_number]" value="{{$passengers->seat_number}}"
                                            placeholder="Seat">
                                    </td>
                                    <td>
                                        <input type="number" style="width:80px" class="form-control"
                                            name="passenger[{{$key}}][credit_note_amount]"
                                            value="{{$passengers->credit_note_amount}}" placeholder="0" step="0.01">
                                    </td>
                                    <td>
                                        <input type="text" style="width:80px;" class="form-control"
                                            name="passenger[{{$key}}][e_ticket_number]"
                                            value="{{$passengers->e_ticket_number}}" placeholder="E Ticket">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-passenger">
                                            <i class="icon-base ri ri-delete-bin-2-line"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!------------------------------------End Passeenger------------------------------------------------------>


            <!------------------------ Flight Booking Details ------------------------------>

            <div class="tab-pane fade" id="flightbooking" role="tabpanel" aria-labelledby="flightbooking-tab">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Flight Booking Details</h5>
                        <button class="btn btn-primary" type="button" id="flight-booking-button">
                            <svg style="fill: white" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true"
                                focusable="false">
                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                            </svg>
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <div class="table-responsive details-table-wrappper">
                                    <table id="flightTable" class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="9" style="text-align: center;"><i
                                                        class="ri ri-flight-takeoff-line" title="Flight"
                                                        style="color: #1e90ff; font-size: 18px;"></i> Departure</th>
                                                <th colspan="8" style="text-align: center;"><i
                                                        class="ri ri-flight-land-line" title="Flight"
                                                        style="color: #1e90ff; font-size: 18px;"></i> Arrival</th>
                                            </tr>
                                            <tr>
                                                <th>#</th>
                                                <th>Direction</th>
                                                <th>Date</th>
                                                <th title="Airline (Code)">AL<br>(Code)</th>
                                                <th>Flight<br> No</th>
                                                <th>Cabin</th>
                                                <th title="Class of Service">CL</th>
                                                <th>Departure Airport</th>
                                                <th>Hrs:MM</th>
                                                <th>Arrival Airport</th>
                                                <th>Hrs:MM</th>
                                                <th>Duration</th>
                                                <th>Transit</th>
                                                <th>Arrival Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="flightForms">

                                            @if($booking->travelFlight->isNotEmpty())
                                            @foreach($booking->travelFlight as $index => $flight)
                                            <input type="hidden" name="flight_files[{{ $index }}]"
                                                data-files='@json($flight->files)'>
                                            <tr class="flight-row" data-index="{{ $index }}">
                                                <td><span class="flight-title">{{ $index + 1 }}</span></td>

                                                <td>
                                                    <select class="form-control" name="flight[{{ $index }}][direction]"
                                                        style="width: 80px;">
                                                        <option value="">Select </option>
                                                        <option value="Inbound"
                                                            {{ $flight->direction == 'Inbound' ? 'selected' : '' }}>
                                                            Inbound</option>
                                                        <option value="Outbound"
                                                            {{ $flight->direction == 'Outbound' ? 'selected' : '' }}>
                                                            Outbound</option>
                                                    </select>
                                                </td>


                                                <td><input type="date" style="width: 6.7rem;" class="form-control"
                                                        name="flight[{{ $index }}][departure_date]"
                                                        value="{{$flight->departure_date?->format('Y-m-d')}}"></td>

                                                <td><input type="text" class="form-control" style="width: 40px;"
                                                        name="flight[{{ $index }}][airline_code]"
                                                        value="{{ old("flight.$index.airlines_code", $flight->airline_code) }}"
                                                        placeholder="Airlines (Code)"></td>

                                                <td><input type="text" class="form-control" style="width: 3.5rem;"
                                                        name="flight[{{ $index }}][flight_number]"
                                                        value="{{ old("flight.$index.flight_no", $flight->flight_number) }}"
                                                        placeholder="Flight No"></td>

                                                <td>
                                                    <select class="form-control" style="width: 75px;"
                                                        name="flight[{{ $index }}][cabin]">
                                                        <option value="">Select</option>
                                                        <option value="B.Eco"
                                                            {{ old("flight.$index.cabin", $flight->cabin) == 'B.Eco' ? 'selected' : '' }}>
                                                            B.Eco</option>
                                                        <option value="Eco"
                                                            {{ old("flight.$index.cabin", $flight->cabin) == 'Eco' ? 'selected' : '' }}>
                                                            Eco</option>
                                                        <option value="Pre.Eco"
                                                            {{ old("flight.$index.cabin", $flight->cabin) == 'Pre.Eco' ? 'selected' : '' }}>
                                                            Pre.Eco</option>
                                                        <option value="Buss."
                                                            {{ old("flight.$index.cabin", $flight->cabin) == 'Buss.' ? 'selected' : '' }}>
                                                            Buss.</option>
                                                    </select>
                                                </td>

                                                <td><input type="text" class="form-control"
                                                        name="flight[{{ $index }}][class_of_service]"
                                                        value="{{ old("flight.$index.class_of_service", $flight->class_of_service) }}"
                                                        placeholder="Class of Service" style="width: 37px;" min="0"
                                                        max="1"></td>
                                                <td><input type="text" class="form-control"
                                                        name="flight[{{ $index }}][departure_airport]"
                                                        value="{{ old("flight.$index.departure_airport", $flight->departure_airport) }}"
                                                        placeholder="Departure Airport"></td>

                                                <td><input type="time" class="form-control"
                                                        name="flight[{{ $index }}][departure_hours]" style="width: 86px"
                                                        value="{{ old("flight.$index.departure_hrs", $flight->departure_hours) }}"
                                                        placeholder="Hrs" min="0" max="2"></td>

                                                <!-- <td><input type="text" class="form-control" style="width: 36px;"
                                                        name="flight[{{ $index }}][departure_minutes]"
                                                        value="{{ old("flight.$index.departure_mm", $flight->departure_minutes) }}"
                                                        placeholder="mm" min="0" max="2"></td> -->

                                                <td><input type="text" class="form-control"
                                                        name="flight[{{ $index }}][arrival_airport]"
                                                        style="width: 90px;"
                                                        value="{{ old("flight.$index.arrival_airport", $flight->arrival_airport) }}"
                                                        placeholder="Arrival Airport"></td>


                                                <td><input type="time" class="form-control" style="width: 86px;"
                                                        name="flight[{{ $index }}][arrival_hours]"
                                                        value="{{ old("flight.$index.arrival_hrs", $flight->arrival_hours) }}"
                                                        placeholder="Hrs" min="0" max="2"></td>

                                                <!-- <td><input type="text" class="form-control" style="width: 36px;"
                                                        name="flight[{{ $index }}][arrival_minutes]"
                                                        value="{{ old("flight.$index.arrival_mm", $flight->arrival_minutes) }}"
                                                        placeholder="mm" min="0" max="2"></td> -->

                                                <td><input type="text" class="form-control" style="width: 4.5rem;"
                                                        name="flight[{{ $index }}][duration]"
                                                        value="{{ old("flight.$index.duration", $flight->duration) }}"
                                                        placeholder="Duration"></td>

                                                <td><input type="text" class="form-control"
                                                        name="flight[{{ $index }}][transit]"
                                                        value="{{ old("flight.$index.transit", $flight->transit) }}"
                                                        placeholder="Transit"></td>

                                                <td><input type="date" class="form-control" style="width: 105px;"
                                                        name="flight[{{ $index }}][arrival_date]"
                                                        value="{{ $flight->arrival_date?->format('Y-m-d') }}"></td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-outline-danger delete-flight-btn">
                                                        <i class="ri ri-delete-bin-line"></i>
                                                    </button>
                                                    <!-- Hidden input to store flight ID for existing records -->
                                                    <input type="hidden" name="flight[{{ $index }}][id]"
                                                        value="{{ $flight->id }}">
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top:20px">
                        <input type="file" id="screenshots-upload" name="flightbookingimage[]" multiple>
                    </div>

                </div>
            </div>
            <!------------------------ End Flight Booking Details ------------------------------>

            <!------------------------ Car Booking Details ------------------------------>
            <div class="tab-pane fade" id="carbooking" role="tabpanel" aria-labelledby="carbooking-tab">
                <div class="card p-4">
                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Car Booking Details</h5>
                        <div>
                            <button class="btn btn-primary" type="button" id="car-booking-button">
                                <svg style="fill: white" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true"
                                    focusable="false">
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                                </svg>
                            </button>
                        </div>

                    </div>
                    <div class="card-body pt-3">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12 table-responsive details-table-wrappper">
                                <table id="carTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
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
                                    <tbody id="carForms">
                                        @foreach($booking->travelCar as $key=>$travelCar)
                                        <tr class="car-row" data-index="{{$key}}">
                                            <td><span class="car-title">{{$key+1}}</span></td>
                                            <td><input type="text" class="form-control" style="width:10rem"
                                                    name="car[{{$key}}][car_rental_provider]"
                                                    value="{{$travelCar->car_rental_provider}}"
                                                    placeholder="Car Rental Provider"></td>
                                            <td><input type="text" class="form-control" style="width:7.5rem"
                                                    name="car[{{$key}}][car_type]" value="{{$travelCar->car_type}}"
                                                    placeholder="Car Type"></td>
                                            <td><input type="text" class="form-control" style="width:9rem"
                                                    name="car[{{$key}}][pickup_location]"
                                                    value="{{$travelCar->pickup_location}}"
                                                    placeholder="Pick-up Location"></td>
                                            <td><input type="text" class="form-control" style="width:10rem"
                                                    name="car[{{$key}}][dropoff_location]"
                                                    value="{{$travelCar->dropoff_location}}"
                                                    placeholder="Drop-off Location"></td>
                                            <td><input style="width: 110px;" type="date" class="form-control"
                                                    name="car[{{$key}}][pickup_date]"
                                                    value="{{$travelCar->pickup_date?->format('Y-m-d')}}"></td>
                                            <td><input type="time" class="form-control" style="width: 105px;"
                                                    name="car[{{$key}}][pickup_time]"
                                                    value="{{ $travelCar->pickup_time ? \Carbon\Carbon::parse($travelCar->pickup_time)?->format('H:i') : '' }}">
                                            </td>
                                            <td><input style="width: 105px;" type="date" class="form-control"
                                                    name="car[{{$key}}][dropoff_date]"
                                                    value="{{$travelCar->dropoff_date?->format('Y-m-d')}}"></td>
                                            <td><input type="time" class="form-control" style="width: 100px;"
                                                    name="car[{{$key}}][dropoff_time]"
                                                    value="{{ $travelCar->dropoff_time ? \Carbon\Carbon::parse($travelCar->dropoff_time)?->format('H:i') : '' }}">
                                            </td>
                                            <td><input type="text" class="form-control" style="width:12rem"
                                                    name="car[{{$key}}][confirmation_number]"
                                                    placeholder="Confirmation Number"
                                                    value="{{$travelCar->confirmation_number}}"></td>
                                            <td><input type="text" class="form-control" style="width:7.5rem"
                                                    name="car[{{$key}}][remarks]" placeholder="Remarks"
                                                    value="{{$travelCar->remarks}}"></td>
                                            <td><input type="text" class="form-control" style="width:13rem"
                                                    name="car[{{$key}}][rental_provider_address]"
                                                    value="{{$travelCar->rental_provider_address}}"
                                                    placeholder="Rental Provider's Address"></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-danger delete-car-btn">
                                                    <i class="ri ri-delete-bin-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div style="margin-top:20px">
                        <input type="file" id="screenshots-upload" name="carbookingimage[]" multiple>
                    </div>
                </div>
            </div>
            <!------------------------ End Car Booking Details ------------------------------>

            <!------------------------ Cruise Booking Details ------------------------------>
            <div class="tab-pane fade" id="cruisebooking" role="tabpanel" aria-labelledby="cruisebooking-tab">
                <div class="card p-4">
                    <div class="mb-4 d-flex align-items-center justify-content-between">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Cruise Booking Details</h5>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary" type="button" id="cruise-booking-button">
                                <svg style="fill: white" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true"
                                    focusable="false">
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                                </svg>
                            </button>
                        </div>

                    </div>
                    <div class="card-body pt-3">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12 table-responsive details-table-wrappper">
                                <!-- Cruise Table -->
                                <table id="cruiseTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>

                                            <th>Cruise Line</th>
                                            <th>Name of the Ship</th>
                                            <th>Category</th>
                                            <th>Stateroom</th>
                                            <th>Departure Port</th>
                                            <th>Departure Date</th>
                                            <th>Hrs:MM</th>
                                            <th>Arrival Port</th>
                                            <th>Arrival Date</th>
                                            <th>Hrs:MM</th>
                                            <!-- <th>Remarks</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cruiseForms">
                                        @foreach($booking->travelCruise as $key=>$travelCruise)
                                        <tr class="cruise-row" data-index="{{$key}}">
                                            <td><span class="cruise-title">{{$key+1}}</span></td>

                                            <td><input type="text" class="form-control" style="width:7.5rem"
                                                    name="cruise[{{$key}}][cruise_line]"
                                                    value="{{$travelCruise->cruise_line}}" placeholder="Cruise Line">
                                            </td>
                                            <td><input type="text" class="form-control" style="width:7.5rem"
                                                    name="cruise[{{$key}}][ship_name]"
                                                    value="{{$travelCruise->ship_name}}" placeholder="Name of the Ship">
                                            </td>
                                            <td><input type="text" class="form-control" style="width:7.5rem"
                                                    name="cruise[{{$key}}][category]"
                                                    value="{{$travelCruise->category}}" placeholder="Category"></td>
                                            <td><input type="text" class="form-control" style="width:7.5rem"
                                                    name="cruise[{{$key}}][stateroom]"
                                                    value="{{$travelCruise->stateroom}}" placeholder="Stateroom">
                                            </td>
                                            <td><input type="text" class="form-control" style="width:7.5rem"
                                                    name="cruise[{{$key}}][departure_port]"
                                                    value="{{$travelCruise->departure_port}}"
                                                    placeholder="Departure Port"></td>
                                            <td><input style="width: 105px;" type="date" class="form-control"
                                                    name="cruise[{{$key}}][departure_date]"
                                                    value="{{$travelCruise->departure_date?->format('Y-m-d')}}">
                                            </td>
                                            <td><input type="time" class="form-control" style="width:50px"
                                                    name="cruise[{{$key}}][departure_hrs]"
                                                    value="{{$travelCruise->departure_hrs}}" placeholder="Hrs" min="0"
                                                    max="23"></td>


                                            <td><input type="text" class="form-control" style="width:7.5rem"
                                                    name="cruise[{{$key}}][arrival_port]"
                                                    value="{{$travelCruise->arrival_port}}" placeholder="Arrival Port">
                                            </td>
                                            <td><input type="date" style="width: 105px;" class="form-control"
                                                    name="cruise[{{$key}}][arrival_date]"
                                                    value="{{$travelCruise->arrival_date?->format('Y-m-d')}}"></td>
                                            <td><input type="time" class="form-control" style="width:50px;"
                                                    name="cruise[{{$key}}][arrival_hrs]"
                                                    value="{{$travelCruise->arrival_hrs}}" placeholder="Hrs" min="0"
                                                    max="23"></td>



                                            <td>
                                                <button type="button" class="btn btn-outline-danger delete-cruise-btn">
                                                    <i class="ri ri-delete-bin-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top:20px">
                    <input type="file" id="screenshots-upload" name="cruisebookingimage[]" multiple>
                </div>


            </div>
            <!------------------------ End Cruise Booking Details ------------------------------>


            <!------------------------ Hotel Booking Details ------------------------------>

            <div class="tab-pane fade" id="hotelbooking" role="tabpanel" aria-labelledby="hotelbooking-tab">
                <div class="card p-4">
                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Hotel Booking Details</h5>
                        <button class="btn btn-primary" type="button" id="hotel-booking-button">
                            <svg style="fill: white" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true"
                                focusable="false">
                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                            </svg>
                        </button>
                    </div>
                    <div class="card-body pt-3">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12 table-responsive details-table-wrappper">
                                <!-- Hotel Table -->
                                <table id="hotelTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
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
                                    <tbody id="hotelForms">
                                        @foreach($booking->travelHotel as $key=>$travelHotel)
                                        <tr class="hotel-row" data-index="{{$key}}">
                                            <td><span class="hotel-title">{{$key+1}}</span></td>
                                            <td><input type="text" class="form-control" style="width:7.5rem"
                                                    name="hotel[{{$key}}][hotel_name]"
                                                    value="{{$travelHotel->hotel_name}}" placeholder="Hotel Name">
                                            </td>
                                            <td><input type="text" class="form-control" style="width:8rem"
                                                    name="hotel[{{$key}}][room_category]"
                                                    value="{{$travelHotel->room_category}}" placeholder="Room Category">
                                            </td>

                                            <td><input type="date" class="form-control"
                                                    name="hotel[{{$key}}][checkin_date]"
                                                    value="{{$travelHotel->checkin_date?->format('Y-m-d')}}"
                                                    style="width: 114px;"></td>

                                            <td><input type="date" class="form-control"
                                                    name="hotel[{{$key}}][checkout_date]"
                                                    value="{{$travelHotel->checkout_date?->format('Y-m-d')}}"
                                                    style="width: 114px;"></td>

                                            <td><input type="number" class="form-control" style="width:8rem"
                                                    name="hotel[{{$key}}][no_of_rooms]"
                                                    value="{{$travelHotel->no_of_rooms}}" placeholder="No. Of Rooms"
                                                    min="1"></td>

                                            <td><input type="text" class="form-control" style="width:10.5rem"
                                                    name="hotel[{{$key}}][confirmation_number]"
                                                    value="{{$travelHotel->confirmation_number}}"
                                                    placeholder="Confirmation Number"></td>

                                            <td><input type="text" class="form-control" style="width:8rem"
                                                    name="hotel[{{$key}}][hotel_address]"
                                                    value="{{$travelHotel->hotel_address}}" placeholder="Hotel Address">
                                            </td>
                                            <td><input type="text" class="form-control" style="width:7.5rem"
                                                    name="hotel[{{$key}}][remarks]" value="{{$travelHotel->remarks}}"
                                                    placeholder="Remarks"></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-danger delete-hotel-btn">
                                                    <i class="ri ri-delete-bin-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div style="margin:20px">
                        <input type="file" id="screenshots-upload" name="hotelbookingimage[]" multiple>
                    </div>
                </div>
            </div>
            <!------------------------ End Hotel Booking Details ------------------------------>

            <!------------------------ Train Booking Details ------------------------------>
            <div class="tab-pane fade" id="trainbooking" role="tabpanel" aria-labelledby="trainbooking-tab">
                <div class="card p-4">
                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Train Booking Details</h5>
                        <div>
                            <button class="btn btn-primary" type="button" id="train-booking-button">
                                <svg style="fill: white" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true"
                                    focusable="false">
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="card-body pt-3 ps-0 pe-0">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12 table-responsive details-table-wrappper">
                                <!-- Car Table -->
                                <table id="carTable" class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="6">Trip to Sherevport</th>
                                            <th colspan="2">Departure </th>
                                            <th></th>
                                            <th>Arrival </th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Direction</th>
                                            <th>Date</th>
                                            <th>Train No</th>
                                            <th>Cabin</th>
                                            <th>Departure station</th>
                                            <th>Hrs</th>
                                            <th>MM</th>
                                            <th>Arrival station</th>
                                            <th>Hrs</th>
                                            <th>MM</th>
                                            <th>Duration</th>
                                            <th>Transit</th>
                                            <th>Arrival date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="trainForms">
                                        @foreach($booking->trainBookingDetails as $key=>$trainBookingDetails)
                                        <tr class="train-row" data-index="{{$key}}">
                                            <td><span class="train-title">{{$key+1}}</span></td>
                                            <td><input type="text" class="form-control" style="width: 7.5rem;"
                                                    name="train[{{$key}}][direction]"
                                                    value="{{$trainBookingDetails->direction}}" placeholder="Direction">
                                            </td>
                                            <td><input type="date" class="form-control" style="width: 105px;"
                                                    name="train[{{$key}}][departure_date]"
                                                    value="{{$trainBookingDetails->departure_date?->format('Y-m-d')}}">
                                            </td>
                                            <td><input type="text" class="form-control" style="width: 108px;"
                                                    name="train[{{$key}}][train_number]"
                                                    value="{{$trainBookingDetails->train_number}}"
                                                    placeholder="Train No"></td>
                                            <td><input type="text" class="form-control" style="width: 7.5rem;"
                                                    name="train[{{$key}}][cabin]"
                                                    value="{{$trainBookingDetails->cabin}}" placeholder="Cabin">
                                            </td>
                                            <td><input type="text" class="form-control" style="width: 10rem;"
                                                    name="train[{{$key}}][departure_station]"
                                                    value="{{$trainBookingDetails->departure_station}}"
                                                    placeholder="Departure Station"></td>
                                            <td><input type="number" class="form-control" style="width: 58px;"
                                                    name="train[{{$key}}][departure_hours]"
                                                    value="{{$trainBookingDetails->departure_hours}}" placeholder="Hrs"
                                                    min="0" max="23"></td>
                                            <td><input type="number" class="form-control" style="width: 58px;"
                                                    name="train[{{$key}}][departure_minutes]"
                                                    value="{{$trainBookingDetails->departure_minutes}}" placeholder="mm"
                                                    min="0" max="59"></td>
                                            <td><input type="text" class="form-control" style="width: 10rem;"
                                                    name="train[{{$key}}][arrival_station]"
                                                    value="{{$trainBookingDetails->arrival_station}}"
                                                    placeholder="Arrival Station"></td>
                                            <td><input type="number" class="form-control" style="width: 7.5rem;"
                                                    name="train[{{$key}}][arrival_hours]"
                                                    value="{{$trainBookingDetails->arrival_hours}}" placeholder="Hrs"
                                                    min="0" max="23"></td>
                                            <td><input type="number" class="form-control" style="width: 7.5rem;"
                                                    name="train[{{$key}}][arrival_minutes]"
                                                    value="{{$trainBookingDetails->arrival_minutes}}" placeholder="mm"
                                                    min="0" max="59"></td>
                                            <td><input type="text" class="form-control" style="width: 7.5rem;"
                                                    name="train[{{$key}}][duration]"
                                                    value="{{$trainBookingDetails->duration}}" placeholder="Duration">
                                            </td>
                                            <td><input type="text" class="form-control" style="width: 7.5rem;"
                                                    name="train[{{$key}}][transit]"
                                                    value="{{$trainBookingDetails->transit}}" placeholder="Transit">
                                            </td>
                                            <td><input type="date" class="form-control"
                                                    name="train[{{$key}}][arrival_date]"
                                                    value="{{$trainBookingDetails->arrival_date?->format('Y-m-d')}}">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-outline-danger delete-train-btn">
                                                    <i class="ri ri-delete-bin-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top:20px">
                        <input type="file" id="screenshots-upload" name="trainbookingimage[]" multiple>
                    </div>

                </div>
            </div>
            <!------------------------ End Train Booking Details ------------------------------>




            <!--------------------------------------Billing Details ---------------------------->
            <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
                <div class="card p-4">


                    <div class="d-flex justify-content-between align-items-center mb-3 add-bank">
                        <h5 class="card-header border-0 p-0">Billing Details</h5>
                        <i data-bs-toggle="modal" data-bs-target="#exampleModal"
                            class="ri ri-add-circle-fill pointer"></i>
                    </div>

                    <div id="billing-table-container">
                        <table id="billing-table" class="mb-3" border="1" cellpadding="8" cellspacing="0"
                            style="border-collapse: collapse; text-align: center; width: 100%;">
                            <thead style="background-color: #f2f2f2;">
                                <tr>
                                    <th>S.No</th>
                                    <th>Email</th>
                                    <th>Contact No.</th>
                                    <th>Street Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zip code</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($billingData as $key=>$bill)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$bill->email}}</td>
                                    <td>{{$bill->contact_number}}</td>
                                    <td>{{$bill->street_address}}</td>
                                    <td>{{$bill->city}}</td>
                                    <td>{{$bill->state}}</td>
                                    <td>{{$bill->zip_code}}</td>
                                    <td>{{$bill->country}}</td>
                                    <td>
                                        <button class="btn btn-danger deleteBillData"
                                            data-href="{{ route('booking.billing-details.destroy', ['id' => $bill->id]) }}">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-header border-0 p-0">Card Details $1052</h5>

                        <button class="btn btn-primary" type="button" id="billing-booking-button">
                            <svg style="fill: white" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true"
                                focusable="false">
                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                            </svg>
                        </button>



                    </div>
                    <div class="card-body p-0">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12 table-responsive details-table-wrappper">
                                <table id="billingTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Card Type</th>
                                            <th>CC Number</th>
                                            <th>CC Holder Name</th>
                                            <th>Exp Month</th>
                                            <th>Exp Year</th>
                                            <th>CVV</th>
                                            <th>Billing </th>
                                            <th>Authorized Amt.<br> (USD)</th>
                                            <th>Currency</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="billingForms">

                                            @foreach($booking->billingDetails as $key => $billingDetails)
                                            <tr class="billing-card" data-index="{{$key}}">
                                                <td>
                                                    <h6 class="billing-card-title mb-0"> {{$key + 1}}</h6>
                                                </td>
                                                <td>
                                                    <select class="form-control" style="width: 90px;"
                                                        name="billing[{{$key}}][card_type]">
                                                        <option value="">Select</option>
                                                        <option value="VISA"
                                                            {{$billingDetails->card_type == 'VISA' ? 'selected' : ''}}>
                                                            VISA
                                                        </option>
                                                        <option value="Mastercard"
                                                            {{$billingDetails->card_type == 'Mastercard' ? 'selected' : ''}}>
                                                            Mastercard</option>
                                                        <option value="AMEX"
                                                            {{$billingDetails->card_type == 'AMEX' ? 'selected' : ''}}>
                                                            AMEX
                                                        </option>
                                                        <option value="DISCOVER"
                                                            {{$billingDetails->card_type == 'DISCOVER' ? 'selected' : ''}}>
                                                            DISCOVER</option>
                                                    </select>
                                                </td>
                                                <td><input style="width: 140px;" inputmode="numeric" maxlength="16"
                                                        class="form-control" placeholder="CC Number"
                                                        name="billing[{{$key}}][cc_number]"
                                                        value="{{$billingDetails->cc_number}}"></td>
                                                <td><input type="text" class="form-control" placeholder="CC Holder Name"
                                                        name="billing[{{$key}}][cc_holder_name]"
                                                        value="{{$billingDetails->cc_holder_name}}"></td>
                                                <td>
                                                    <select style="width: 45px; margin: auto;" class="form-control"
                                                        name="billing[{{$key}}][exp_month]">
                                                        <option value="">MM</option>
                                                        @for($i = 1; $i <= 12; $i++) <option
                                                            value="{{ sprintf('%02d', $i) }}"
                                                            {{$billingDetails->exp_month == sprintf('%02d', $i) ? 'selected' : ''}}>
                                                            {{ sprintf('%02d', $i) }}</option>
                                                            @endfor
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="billing[{{$key}}][exp_year]">
                                                        <option value="">YYYY</option>
                                                        @for($i = 2024; $i <= 2034; $i++) <option value="{{$i}}"
                                                            {{$billingDetails->exp_year == $i ? 'selected' : ''}}>{{$i}}
                                                            </option>
                                                            @endfor
                                                    </select>
                                                </td>


                                            <td><input style="width: 57px;" inputmode="numeric" maxlength="4"
                                                    oninput="this.value = this.value.replace(/\D/g, '').slice(0,5)"
                                                    class="form-control" placeholder="CVV" name="billing[{{$key}}][cvv]"
                                                    value="{{$billingDetails->cvv}}">
                                            </td>

                                            <!--td><input style="width: 180px;" type="text" class="form-control"
                                                    placeholder="Address" name="billing[{{$key}}][address]"
                                                    value="{{$billingDetails->address}}"></td>
                                            <td><input style="width: 180px;" type="email" class="form-control"
                                                    placeholder="Email" name="billing[{{$key}}][email]"
                                                    value="{{$billingDetails->email}}">
                                            </td>
                                            <td><input style="width: 100px;" type="text" class="form-control"
                                                    placeholder="Contact No" name="billing[{{$key}}][contact_no]"
                                                    value="{{$billingDetails->contact_no}}"></td>
                                            <td><input style="width: 100px;" type="text" class="form-control"
                                                    placeholder="City" name="billing[{{$key}}][city]"
                                                    value="{{$billingDetails->city}}">
                                            </td>
                                            <td>
                                                <select id="country-{{$key}}" style="width:9rem"
                                                    class="form-control country-select"
                                                    name="billing[{{$key}}][country]">
                                                    <option value="India">Select Country</option>
                                                    Populated by JavaScript -->
                                            </select>
                                            </td>
                                            <td>
                                                <select id="state-{{$key}}" style="width:7.5rem"
                                                    class="form-control state-select" name="billing[{{$key}}][address]">
                                                    <option value="">Select Billing</option>
                                                    <option value="address"
                                                        {{$billingDetails->address == 'address'?'selected':''}}>Address
                                                    </option>
                                                </select>
                                            </td>

                                            <td><input style="width: 65px;" type="text" class="form-control"
                                                    placeholder="ZIP Code" name="billing[{{$key}}][zip_code]"
                                                    value="{{$billingDetails->zip_code}}"></td>
                                            <td>
                                                <select class="form-control" name="billing[{{$key}}][currency]">
                                                    <option value="">Select</option>
                                                    <option value="USD"
                                                        {{$billingDetails->currency == 'USD' ? 'selected' : ''}}>USD
                                                    </option>
                                                    <option value="CAD"
                                                        {{$billingDetails->currency == 'CAD' ? 'selected' : ''}}>CAD
                                                    </option>
                                                    <option value="EUR"
                                                        {{$billingDetails->currency == 'EUR' ? 'selected' : ''}}>EUR
                                                    </option>
                                                    <option value="GBP"
                                                        {{$billingDetails->currency == 'GBP' ? 'selected' : ''}}>GBP
                                                    </option>
                                                    <option value="AUD"
                                                        {{$billingDetails->currency == 'AUD' ? 'selected' : ''}}>AUD
                                                    </option>
                                                    <option value="INR"
                                                        {{$billingDetails->currency == 'INR' ? 'selected' : ''}}>INR
                                                    </option>
                                                    <option value="MXN"
                                                        {{$billingDetails->currency == 'MXN' ? 'selected' : ''}}>MXN
                                                    </option>
                                                </select>
                                            </td>
                                            <td> AUD<span>90909</span>
                                                <input value="1" name="billing[{{$key}}][amount]" type="hidden" />
                                            </td>

                                            <td>

                                                <button type="button" class="btn btn-outline-danger delete-billing-btn">
                                                    <i class="ri ri-delete-bin-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>









                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!--------------------------------------End Billing Details ---------------------------->


            <!------------------------- Pricing Details ----------------------------------->
            <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">

                <div class="col-md-12">
                    <div class="card p-4 details-table-wrappper">
                        <div class="d-flex justify-content-end mb-2">
                            <button class="btn btn-primary" type="button" id="pricing-booking-button">
                                <svg style="fill: white" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true"
                                    focusable="false">
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                                </svg>
                            </button>
                        </div>

                        <table class="pricing-table table">
                            <thead>
                                <tr>
                                    <td colspan="4" style="border: solid 1px;"><strong>Gross Amount Collected</strong>
                                    </td>
                                    <td colspan="4"><strong>Net Amount (Paid)</strong></td>
                                </tr>
                                <tr>
                                    <th>Passengers*</th>
                                    <th>No. of Pax</th>
                                    <th>Price*</th>
                                    <th>Total*</th>
                                    <th>Price*</th>
                                    <th>Total</th>
                                    <th>Details</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="pricingForms" class="pricing-rows">
                                @if($booking->pricingDetails->isEmpty())
                                <tr class="pricing-row" data-index="0">
                                    <td>
                                        <select name="pricing[0][passenger_type]" class="form-select form-control"
                                            id="passenger_type_0">
                                            <option value="">Select</option>
                                            <option value="adult">Adult</option>
                                            <option value="child">Child</option>
                                            <option value="infant_on_lap">Infant on Lap</option>
                                            <option value="infant_on_seat">Infant on Seat</option>
                                            <option value="Senior">Senior</option>
                                        </select>
                                    </td>
                                    <td><input style="width: 120px" type="number" class="form-control"
                                            name="pricing[0][num_passengers]" placeholder="No. of Passengers" min="0">
                                    </td>
                                    <td><input type="number" class="form-control" name="pricing[0][gross_price]"
                                            placeholder="Gross Price" min="0" step="0.01" style="width: 110px;"></td>

                                        <td><span class="gross-total">0.00</span></td>
                                        <td><input type="number" style="width: 110px;" class="form-control"
                                                name="pricing[0][net_price]" placeholder="Net Price" min="0"
                                                step="0.01">
                                        </td>
                                        <td><span class="net-total">0.00</span></td>
                                        <td>
                                            <select style="width: 145px;" name="pricing[0][details]"
                                                class="form-select form-control" id="details_0">
                                                <option value="">Select</option>
                                                <option value="ticket_cost">Ticket Cost</option>
                                                <option value="merchant_fee">Merchant Fee</option>
                                                <option value="company_card_used">Company Card Used</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger delete-pricing-btn">
                                                <i class="ri ri-delete-bin-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endif

                                @foreach($booking->pricingDetails as $key=>$pricingDetails)
                                <tr class="pricing-row" data-index="{{$key}}">
                                    <td>
                                        <select class="form-control" name="pricing[{{$key}}][passenger_type]"
                                            id="passenger_type_{{$key}}">
                                            <option value="adult"
                                                {{$pricingDetails->passenger_type=='adult'?'selected':''}}>Adult
                                            </option>
                                            <option value="child"
                                                {{$pricingDetails->passenger_type=='child'?'selected':''}}>Child
                                            </option>
                                            <option value="infant_on_lap"
                                                {{$pricingDetails->passenger_type=='infant_on_lap'?'selected':''}}>
                                                Infant on
                                                Lap</option>
                                            <option value="infant_on_seat"
                                                {{$pricingDetails->passenger_type=='infant_on_seat'?'selected':''}}>
                                                Infant
                                                on Seat</option>
                                        </select>
                                    </td>
                                    <td><input type="number" class="form-control"
                                            name="pricing[{{$key}}][num_passengers]"
                                            value="{{$pricingDetails->num_passengers}}" placeholder="No. of Passengers"
                                            min="0"></td>
                                    <td><input type="number" class="form-control" name="pricing[{{$key}}][gross_price]"
                                            value="{{$pricingDetails->gross_price}}" placeholder="Gross Price" min="0"
                                            step="0.01"></td>
                                    <td><span class="gross-total">0.00</span></td>
                                    <td><input type="number" class="form-control" name="pricing[{{$key}}][net_price]"
                                            value="{{$pricingDetails->net_price}}" placeholder="Net Price" min="0"
                                            step="0.01"></td>
                                    <td><span class="net-total">0.00</span></td>
                                    <td>
                                        <select class="form-control" name="pricing[{{$key}}][details]"
                                            id="details_{{$key}}">

                                            <option value="ticket_cost"
                                                {{$pricingDetails->details=='ticket_cost'?'selected':''}}>Ticket
                                                Cost
                                            </option>

                                            <option>Flight Ticket Cost</option>
                                            <option>Cruise Ticket Cost</option>
                                            <option>Car Rental Cost</option>
                                            <option>Train Cost</option>
                                            <option>Hotel Cost</option>
                                            <option>Company Card</option>
                                            <option>Issuance Fees</option>
                                            <option>FXL Issuance Fees</option>
                                            <option>Refund</option>
                                            <option>Charge Back Fee</option>
                                            <option>Charge Back Amount</option>
                                            <option>Voyzant</option>

                                            <option value="merchant_fee"
                                                {{$pricingDetails->details=='merchant_fee'?'selected':''}}>Merchant
                                                Fee
                                            </option>
                                            <option value="company_card_used"
                                                {{$pricingDetails->details=='company_card_used'?'selected':''}}>
                                                Company
                                                Card
                                                Used</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger delete-pricing-btn">
                                            <i class="ri ri-delete-bin-line"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"><strong>Gross Profit</strong></td>
                                    <td><span id="total_gross_profit">0.00</span></td>
                                    <td colspan="2"><strong>Net Profit</strong></td>
                                    <td><span id="total_net_profit">0.00</span></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>


                    </div>
                </div>
            </div>

            <!-----------------------------------End Pricing ------------------------------------------>

            <!--------------------------- Booking Remarks --------------------------->
            <div class="tab-pane fade" id="remarks" role="tabpanel" aria-labelledby="remarks-tab">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Booking Remarks</h5>
                        <button id="saveRemark" type="button" class="btn btn-primary">Save Remark</button>
                    </div>
                    <div class="card-body p-0">
                        <textarea class="form-control" name="particulars" rows="4"
                            placeholder="Enter remarks here..."></textarea>
                    </div>
                    <div class="mt-5">
                        <h5 class="mb-0">Saved booking remarks</h5>
                        <div class="crm-table">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr style="background-color:#e0ecff !important">
                                        <td>Sno.</td>
                                        <td>Remark</td>
                                        <td>Agent</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody id="bookingtableremarktable">
                                    @if($booking->remarks)
                                    @foreach($booking->remarks as $key=>$remar)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$remar->particulars}}</td>
                                        <td>{{$remar->agent}}</td>
                                        <td>
                                            <button data-id="{{$remar->id}}" type="submit" class="no-btn p-0 "
                                                onclick="return confirm('Are you sure you want to delete this call type?')">
                                                <img width="25" src="../../../assets/img/icons/img-icons/delete.png"
                                                    alt="shift-change">
                                            </button>


                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--------------------------- End Booking Remarks --------------------------->


            <!--------------------------- Quality Feedback --------------------------->
            <div class="tab-pane fade" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
                <div class="card p-4" style="font-size: 12px;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Quality Feedback</h5>
                        <button id="saveFeedback" type="button" class="btn btn-primary">Save Feedback</button>
                    </div>
                    <div class="card-body p-0">

                        <!-- Checkboxes for Parameters -->
                        <div class="my-5">



                            <div class="switch-container">


                                <!-- Include this inside your Blade view or HTML form -->

                                    <div class="row">
                                        <!-- Fatal Section -->
                                        <div class="col-12 text-center"><h6 class="text-success fw-bold py-1 px-2" style="background-color: #e6ffe6; display: inline-block; border-radius: 5px; font-size: 0.9rem;">NOT FATAL</h6></div>

                                    
                                    @php
                                        // Create an array of parameters from the feedback collection for easier lookup
                                        $feedbackParameters = $feed_backs->pluck('parameter')->toArray();
                                        // Optionally, create an array to map parameters to their notes (if notes exist in the model)
                                        $feedbackNotes = $feed_backs->pluck('notes', 'parameter')->toArray();
                                    @endphp

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Call Opening" id="CallOpening" name="parameters[]"
                                                {{ in_array('Call Opening', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="CallOpening">Call
                                                Opening</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="CallOpening"
                                            name="parameter_notes[Call Opening]" rows="2"
                                            placeholder="Add comment for Call Opening...">{{ $feedbackNotes['Call Opening'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Call Closing" id="CallClosingfareneeds" name="parameters[]"
                                                {{ in_array('Call Closing', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="CallClosingfareneeds">Call
                                                Closing</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="CallClosingfareneeds"
                                            name="parameter_notes[Call Closing]" rows="2"
                                            placeholder="Add comment for Call Closing...">{{ $feedbackNotes['Call Closing'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Probing" id="Probing" name="parameters[]"
                                                {{ in_array('Probing', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="Probing">Probing</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="Probing"
                                            name="parameter_notes[Probing]" rows="2"
                                            placeholder="Add comment for Probing...">{{ $feedbackNotes['Probing'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Parapharsing" id="Parapharsing" name="parameters[]"
                                                {{ in_array('Parapharsing', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="Parapharsing">Parapharsing</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="Parapharsing"
                                            name="parameter_notes[Parapharsing]" rows="2"
                                            placeholder="Add comment for Parapharsing...">{{ $feedbackNotes['Parapharsing'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Dead air/Hold" id="DeadAirHold" name="parameters[]"
                                                {{ in_array('Dead air/Hold Procedurefareneeds', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="DeadAirHold">Dead
                                                air/Hold</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="DeadAirHold"
                                            name="parameter_notes[Dead air/Hold]" rows="2"
                                            placeholder="Add comment for Dead air/Hold">{{ $feedbackNotes['Dead air/Hold'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Currency" id="Currency" name="parameters[]"
                                                {{ in_array('Currency', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="Currency">Currency</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="Currency"
                                            name="parameter_notes[Currency]" rows="2"
                                            placeholder="Add comment for Currency...">{{ $feedbackNotes['Currency'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Cold/Blind Transfer" id="ColdBlindTransferfareneeds"
                                                name="parameters[]"
                                                {{ in_array('Cold/Blind Transfer', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="ColdBlindTransferfareneeds">Cold/Blind Transfer</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="ColdBlindTransferfareneeds"
                                            name="parameter_notes[Cold/Blind Transfer]" rows="2"
                                            placeholder="Add comment for Cold/Blind Transfer...">{{ $feedbackNotes['Cold/Blind Transfer'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="E-Tickets" id="ETicketsfareneeds" name="parameters[]"
                                                {{ in_array('E-Tickets', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="ETicketsfareneeds">E-Tickets</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="ETicketsfareneeds"
                                            name="parameter_notes[E-Tickets]" rows="2"
                                            placeholder="Add comment for E-Tickets...">{{ $feedbackNotes['E-Tickets'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Active Listening" id="ActiveListening" name="parameters[]"
                                                {{ in_array('Active Listening', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="ActiveListening">Active
                                                Listening</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none"
                                            data-marksvalue="10" data-qualitytype="non_fatal"
                                            data-related="ActiveListening" name="parameter_notes[Active Listening]"
                                            rows="2"
                                            placeholder="Add comment for Active Listening...">{{ $feedbackNotes['Active Listening'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Rebuttals/Objection Handling" id="RebuttalsObjectionHandling"
                                                name="parameters[]"
                                                {{ in_array('Rebuttals/Objection Handling', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="RebuttalsObjectionHandling">Rebuttals/Objection Handling</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none"
                                            data-marksvalue="10" data-qualitytype="non_fatal"
                                            data-related="RebuttalsObjectionHandling"
                                            name="parameter_notes[Rebuttals/Objection Handling]" rows="2"
                                            placeholder="Add comment for Rebuttals/Objection Handling...">{{ $feedbackNotes['Rebuttals/Objection Handling'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Call Handling" id="CallHandling" name="parameters[]"
                                                {{ in_array('Call Handling', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="CallHandling">Call
                                                Handling</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none"
                                            data-marksvalue="10" data-qualitytype="non_fatal"
                                            data-related="CallHandling" name="parameter_notes[Call Handling]" rows="2"
                                            placeholder="Add comment for Call Handling...">{{ $feedbackNotes['Call Handling'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Selling Skills" id="SellingSkills" name="parameters[]"
                                                {{ in_array('Selling Skills', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="SellingSkills">Selling
                                                Skills</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none"
                                            data-marksvalue="10" data-qualitytype="non_fatal"
                                            data-related="SellingSkills" name="parameter_notes[Selling Skills]" rows="2"
                                            placeholder="Add comment for Selling Skills...">{{ $feedbackNotes['Selling Skills'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Cross Selling (HCIL)" id="CrossSellingHCIL" name="parameters[]"
                                                {{ in_array('Cross Selling (HCIL)', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="CrossSellingHCIL">Cross
                                                Selling (HCIL)</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none"
                                            data-marksvalue="10" data-qualitytype="non_fatal"
                                            data-related="CrossSellingHCIL" name="parameter_notes[Cross Selling (HCIL)]"
                                            rows="2"
                                            placeholder="Add comment for Cross Selling (HCIL)...">{{ $feedbackNotes['Cross Selling (HCIL)'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Itinerary Recapping/Call Summary"
                                                id="ItineraryRecappingCallSummary" name="parameters[]"
                                                {{ in_array('Itinerary Recapping/Call Summary', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="ItineraryRecappingCallSummary">Itinerary Recapping/Call
                                                Summary</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none"
                                            data-marksvalue="10" data-qualitytype="non_fatal"
                                            data-related="ItineraryRecappingCallSummary"
                                            name="parameter_notes[Itinerary Recapping/Call Summary]" rows="2"
                                            placeholder="Add comment for Itinerary Recapping/Call Summary...">{{ $feedbackNotes['Itinerary Recapping/Call Summary'] ?? '' }}</textarea>
                                    </div>



                                    <!-- Add more fatal checkboxes with textarea below as needed -->

                                    <!-- Non-Fatal Section -->
                                    <div class="col-12 mt-4">
                                        <h5 class="text-danger">Fatal</h5>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Hold Procedure" id="HoldProcedure" name="parameters[]"
                                                {{ in_array('Hold Procedure', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="HoldProcedure">Hold
                                                Procedure</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="HoldProcedure"
                                            name="parameter_notes[Hold Procedure]" rows="2"
                                            placeholder="Add comment for Hold Procedure...">{{ $feedbackNotes['Hold Procedure'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Misrepresentation" id="Misrepresentation" name="parameters[]"
                                                {{ in_array('Misrepresentation', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="Misrepresentation">Misrepresentation</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="Misrepresentation"
                                            name="parameter_notes[Misrepresentation]" rows="2"
                                            placeholder="Add comment for Misrepresentation...">{{ $feedbackNotes['Misrepresentation'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Rude/Sarcastic behaviour" id="RudeSarcasticBehaviour"
                                                name="parameters[]"
                                                {{ in_array('Rude/Sarcastic behaviour', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="RudeSarcasticBehaviour">Rude/Sarcastic behaviour</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="RudeSarcasticBehaviour"
                                            name="parameter_notes[Rude/Sarcastic behaviour]" rows="2"
                                            placeholder="Add comment for Rude/Sarcastic behaviour...">{{ $feedbackNotes['Rude/Sarcastic behaviour'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Screenshot of services provided"
                                                id="ScreenshotOfServicesProvided" name="parameters[]"
                                                {{ in_array('Screenshot of services provided', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="ScreenshotOfServicesProvided">Screenshot of services
                                                provided</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="ScreenshotOfServicesProvided"
                                            name="parameter_notes[Screenshot of services provided]" rows="2"
                                            placeholder="Add comment for Screenshot of services provided...">{{ $feedbackNotes['Screenshot of services provided'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Merchant Name" id="MerchantName" name="parameters[]"
                                                {{ in_array('Merchant Name', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="MerchantName">Merchant
                                                Name</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="MerchantName"
                                            name="parameter_notes[Merchant Name]" rows="2"
                                            placeholder="Add comment for Merchant Name...">{{ $feedbackNotes['Merchant Name'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Split Charges" id="SplitCharges" name="parameters[]"
                                                {{ in_array('Split Charges', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="SplitCharges">Split
                                                Charges</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="SplitCharges"
                                            name="parameter_notes[Split Charges]" rows="2"
                                            placeholder="Add comment for Split Charges...">{{ $feedbackNotes['Split Charges'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Suspicious Customer" id="SuspiciousCustomer" name="parameters[]"
                                                {{ in_array('Suspicious Customer', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="SuspiciousCustomer">Suspicious Customer</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="SuspiciousCustomer"
                                            name="parameter_notes[Suspicious Customer]" rows="2"
                                            placeholder="Add comment for Suspicious Customer...">{{ $feedbackNotes['Suspicious Customer'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Force Sell" id="ForceSell" name="parameters[]"
                                                {{ in_array('Force Sell', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="ForceSell">Force Sell</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="ForceSell"
                                            name="parameter_notes[Force Sell]" rows="2"
                                            placeholder="Add comment for Force Sell...">{{ $feedbackNotes['Force Sell'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Fake/Unethical Sell" id="FakeUnethicalSell" name="parameters[]"
                                                {{ in_array('Fake/Unethical Sell', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="FakeUnethicalSell">Fake/Unethical Sell</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="FakeUnethicalSell"
                                            name="parameter_notes[Fake/Unethical Sell]" rows="2"
                                            placeholder="Add comment for Fake/Unethical Sell...">{{ $feedbackNotes['Fake/Unethical Sell'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Service Not Provided" id="ServiceNotProvided" name="parameters[]"
                                                {{ in_array('Service Not Provided', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="ServiceNotProvided">Service
                                                Not Provided</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="ServiceNotProvided"
                                            name="parameter_notes[Service Not Provided]" rows="2"
                                            placeholder="Add comment for Service Not Provided...">{{ $feedbackNotes['Service Not Provided'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Call Back Number/Extension" id="CallBackNumberExtension"
                                                name="parameters[]"
                                                {{ in_array('Call Back Number/Extension', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="CallBackNumberExtension">Call
                                                Back Number/Extension</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="CallBackNumberExtension"
                                            name="parameter_notes[Call Back Number/Extension]" rows="2"
                                            placeholder="Add comment for Call Back Number/Extension...">{{ $feedbackNotes['Call Back Number/Extension'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Follow Up" id="FollowUp" name="parameters[]"
                                                {{ in_array('Follow Up', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="FollowUp">Follow Up</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="FollowUp"
                                            name="parameter_notes[Follow Up]" rows="2"
                                            placeholder="Add comment for Follow Up...">{{ $feedbackNotes['Follow Up'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Confirmation Sale" id="ConfirmationSale" name="parameters[]"
                                                {{ in_array('Confirmation Sale', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="ConfirmationSale">Confirmation Sale</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="ConfirmationSale"
                                            name="parameter_notes[Confirmation Sale]" rows="2"
                                            placeholder="Add comment for Confirmation Sale...">{{ $feedbackNotes['Confirmation Sale'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Documentation" id="Documentation" name="parameters[]"
                                                {{ in_array('Documentation', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="Documentation">Documentation</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="Documentation"
                                            name="parameter_notes[Documentation]" rows="2"
                                            placeholder="Add comment for Documentation...">{{ $feedbackNotes['Documentation'] ?? '' }}</textarea>
                                    </div>


                                </div>





                            </div>
                        </div>
                    </div>




                    <div class="col-lg-12 col-md-12 col-12 mt-4">



                                    <div class="mt-5">
                                    <div class="table-responsive">
                                        <table id="booking_feed_back_table" class="table table-bordered align-middle">
                                            <thead class="table-primary text-center">
                                                <tr>
                                                    <th style="width: 20%">Quality strategies</th>
                                                    <th style="width: 50%">Comment</th>
                                                    <th style="width: 10%">Agent</th>
                                                    <th style="width: 20%">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($feed_backs as $feed_back)
                                                    <tr>
                                                        <td>
                                                            <div class="qis-label @if($feed_back->quality == 'non_fatal') bg-success text-white @else bg-danger text-white @endif p-1 rounded">
                                                                <span class="qis-icon">⏱️</span>{{$feed_back->parameter}} 
                                                            </div>
                                                        </td>
                                                        <td>{{$feed_back->note}}</td>
                                                        <td>{{$feed_back->user_id}}</td>
                                                        <td>{{$feed_back->created_at}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>                                
                            
                            </div>
                        </div>
                    </div>
                </div>
                <!--------------------------- End Feedback --------------------------->


                <!--------------------------- Screenshots --------------------------->
                <div class="tab-pane fade" id="screenshots" role="tabpanel" aria-labelledby="screenshots-tab">
                    <div class="card p-4">
                        <div class="mb-4">
                            <h5 class="card-header border-0 p-0 mb-4 detail-passanger">Screenshots</h5>
                                <input type="file" id="screenshots-upload" name="screenshots[]" multiple>
                        </div>
                        
                        <div class="card-body p-2">
                            @php
                            $screenshots = json_decode($booking->screenshot, true);
                        @endphp
                            @if (!empty($screenshots))
                                @foreach ($screenshots as $file)
                                    <div class="mb-2">
                                        <img src="{{ asset($file) }}" alt="Screenshot" class="img-fluid rounded" style="max-height: 200px;">
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted">No screenshots available.</p>
                            @endif
                        </div>

            </div>
        </div>

                <!---------------------------End  Screenshots --------------------------->





    </div>
</div>
</div>

</form>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade bank-details" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Bank Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="billing-close-modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('booking.billing-details',['id'=>$booking->id])}}" id="billing-detail-add">
                    @csrf
                    <div class="row booking-form">
                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">Conatct No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="contact_number">
                        </div>
                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">Street Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="street_address">
                        </div>
                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="city">
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label">State <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="state">
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label">Zip Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="zip_code">
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label">Country <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="country">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-start">
                <button type="button" class="btn btn-primary" id="save-billing-detail">Save</button>
            </div>
        </div>
    </div>
</div>



<style>
.booked-content table thead th,
.booked-content table tbody td {
    padding: 5px !important;
}

.booked-content table thead th,
.booked-content table tbody td {
    padding: 5px !important;
}

.feedback-textarea {
    resize: vertical;
    min-height: 60px;
}
</style>

@vite('resources/js/booking/edit.js')
@endsection