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
<form id="bookingForm" action="{{ route('booking.update', $booking->id) }}" method="POST"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')
<!-- Content -->
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
            <div class="d-flex justify-content-between align-items-center flex-wrap p-0">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <strong>Ticket Information</strong>
                    <span>Created by {{ $booking->user_id }} on {{ $booking->created_at }}</span>
                </div>
                <div class="d-flex gap-2">
                    @include('web.booking.authModel')
                    <a href="{{ route('auth-history', $hashids) }}"
                        class="btn btn-outline-secondary btn-sm rounded-pill">
                        Auth History
                    </a>
                </div>
            </div>

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
                                    <option value=""
                                        {{ old('pnrtype', $booking->pnrtype ?? '') === '' ? 'selected' : '' }}>
                                        Select</option>
                                    <option value="HK"
                                        {{ old('pnrtype', $booking->pnrtype ?? '') === 'HK' ? 'selected' : '' }}>
                                        HK</option>
                                    <option value="GK"
                                        {{ old('pnrtype', $booking->pnrtype ?? '') === 'GK' ? 'selected' : '' }}>
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
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email"
                            value="{{ old('email', $booking->email ?? '') }}">
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
                                {{$status->name}}</option>
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
                        <label class="form-label">Query Type</label>
                        <select id="query_type" class="form-control" name="query_type">
                            <option value="N"
                                {{ old('query_type', $booking->query_type ?? '') === 'N' ? 'selected' : '' }}>New
                                Booking</option>
                            <option value="NC"
                                {{ old('query_type', $booking->query_type ?? '') === 'NC' ? 'selected' : '' }}>New
                                Booking(Credit)</option>
                            <option value="M"
                                {{ old('query_type', $booking->query_type ?? '') === 'M' ? 'selected' : '' }}>New
                                Booking(Miles)</option>
                            <option value="UMNR"
                                {{ old('query_type', $booking->query_type ?? '') === 'UMNR' ? 'selected' : '' }}>
                                Unaccompanied Minor Reservation</option>
                            <option value="CC"
                                {{ old('query_type', $booking->query_type ?? '') === 'CC' ? 'selected' : '' }}>
                                Cancel(Credit)</option>
                            <option value="CR"
                                {{ old('query_type', $booking->query_type ?? '') === 'CR' ? 'selected' : '' }}>
                                Cancel(Refund)</option>
                            <option value="CH"
                                {{ old('query_type', $booking->query_type ?? '') === 'CH' ? 'selected' : '' }}>
                                Change</option>
                            <option value="U"
                                {{ old('query_type', $booking->query_type ?? '') === 'U' ? 'selected' : '' }}>
                                Upgrade</option>
                            <option value="NMC"
                                {{ old('query_type', $booking->query_type ?? '') === 'NMC' ? 'selected' : '' }}>Name
                                Correction</option>
                            <option value="S"
                                {{ old('query_type', $booking->query_type ?? '') === 'S' ? 'selected' : '' }}>Seat
                                Assignment</option>
                            <option value="B"
                                {{ old('query_type', $booking->query_type ?? '') === 'B' ? 'selected' : '' }}>
                                Baggage Addition</option>
                            <option value="CBP"
                                {{ old('query_type', $booking->query_type ?? '') === 'CBP' ? 'selected' : '' }}>
                                Change Bed Preference</option>
                            <option value="AI"
                                {{ old('query_type', $booking->query_type ?? '') === 'AI' ? 'selected' : '' }}>
                                Infant Addition</option>
                            <option value="AE"
                                {{ old('query_type', $booking->query_type ?? '') === 'AE' ? 'selected' : '' }}>
                                Adding Excursion</option>
                        </select>
                    </div>
                    <div class="col-md-2 position-relative mb-5">
                        <label class="form-label">Company Organisation</label>
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
                        <label class="form-label"> Campaign</label>
                        <select class="form-control" name="campaign">
                            <option value=""
                                {{ old('campaign', $booking->campaign ?? '') === '' ? 'selected' : '' }}>Select
                            </option>
                            <option value="Agency"
                                {{ old('campaign', $booking->campaign ?? '') === 'Agency' ? 'selected' : '' }}>
                                Agency</option>
                            <option value="Airline Mix"
                                {{ old('campaign', $booking->campaign ?? '') === 'Airline Mix' ? 'selected' : '' }}>
                                Airline Mix</option>
                            <option value="Buffer Mix"
                                {{ old('campaign', $booking->campaign ?? '') === 'Buffer Mix' ? 'selected' : '' }}>
                                Buffer Mix</option>
                            <option value="Cruise"
                                {{ old('campaign', $booking->campaign ?? '') === 'Cruise' ? 'selected' : '' }}>
                                Cruise</option>
                            <option value="International"
                                {{ old('campaign', $booking->campaign ?? '') === 'International' ? 'selected' : '' }}>
                                International</option>
                            <option value="LCC"
                                {{ old('campaign', $booking->campaign ?? '') === 'LCC' ? 'selected' : '' }}>LCC
                            </option>
                            <option value="Premium Amtrak Bing Calls"
                                {{ old('campaign', $booking->campaign ?? '') === 'Premium Amtrak Bing Calls' ? 'selected' : '' }}>
                                Premium Amtrak Bing Calls</option>
                            <option value="Pure AA"
                                {{ old('campaign', $booking->campaign ?? '') === 'Pure AA' ? 'selected' : '' }}>Pure
                                AA</option>
                            <option value="Spanish"
                                {{ old('campaign', $booking->campaign ?? '') === 'Spanish' ? 'selected' : '' }}>
                                Spanish</option>
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
                    aria-controls="flightbooking" aria-selected="true"><i class="ri ri-flight-takeoff-line" title="Flight" style="color: #1e90ff; font-size: 28px;"></i></a>
            </li>
            <li class="nav-item" role="presentation" data-tab="Hotel"
                style="{{ in_array('Hotel', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
                <a class="nav-link" id="hotelbooking-tab" data-bs-toggle="tab" href="#hotelbooking" role="tab"
                    aria-controls="hotelbooking" aria-selected="true"><i class="ri ri-hotel-fill" title="Hotel" style="color: #8b4513; font-size: 28px;"></i></a>
            </li>
            <li class="nav-item" role="presentation" data-tab="Cruise"
                style="{{ in_array('Cruise', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
                <a class="nav-link" id="cruisebooking-tab" data-bs-toggle="tab" href="#cruisebooking" role="tab"
                    aria-controls="cruisebooking" aria-selected="true"><i class="ri ri-ship-fill" title="Cruise" style="color: #006994; font-size: 28px;"></i></a>
            </li>
            <li class="nav-item" role="presentation" data-tab="Car"
                style="{{ in_array('Car', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
                <a class="nav-link" id="carbooking-tab" data-bs-toggle="tab" href="#carbooking" role="tab"
                    aria-controls="carbooking" aria-selected="true"><i class="ri ri-car-fill" title="Car" style="color: #228b22; font-size: 28px;"></i></a>
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

                    <i class="ri ri-money-dollar-circle-line" style="font-size: 28px; color: #6a5acd;" title="Billing"></i>
                </a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link" id="remarks-tab" data-bs-toggle="tab" href="#remarks" role="tab"
                    aria-controls="remarks" aria-selected="false">
                    <i class="ri ri-sticky-note-line" style="font-size: 28px; color: #d2691e;" title="Booking Remarks"></i>
                 
                </a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link" id="feedback-tab" data-bs-toggle="tab" href="#feedback" role="tab"
                    aria-controls="feedback" aria-selected="false">
                    <i class="ri ri-feedback-line" style="font-size: 28px; color: #4169e1;" title="Quality Feedback"></i>
                  
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
                    </div>
                    <div class="excel-like-container table-responsive details-table-wrappper details-table-wrappper">
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
                                    <th>DOB</th>
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
                                                {{$passengers->passenger_type=="Adult"?'selected':''}}>Adult</option>
                                            <option value="Child"
                                                {{$passengers->passenger_type=="Child"?'selected':''}}>Child</option>
                                            <option value="Infant"
                                                {{$passengers->passenger_type=="Infant"?'selected':''}}>Infant</option>
                                            <option value="Seat Infant"
                                                {{$passengers->passenger_type=="Seat Infant"?'selected':''}}>Seat Infant
                                            </option>
                                            <option value="Lap Infant"
                                                {{$passengers->passenger_type=="Lap Infant"?'selected':''}}>Lap Infant
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" style="width: 70px;"
                                            name="passenger[{{$key}}][gender]">
                                            <option value="">Select</option>
                                            <option value="Male" {{$passengers->gender == 'Male'?'selected':''}}>Male
                                            </option>
                                            <option value="Female" {{$passengers->gender == 'Female'?'selected':''}}>
                                                Female</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" style="width:70px;"
                                            name="passenger[{{$key}}][title]">
                                            <option value="">Select</option>
                                            <option value="Mr" {{$passengers->title=="Mr"?"selected":''}}>Mr</option>
                                            <option value="Mrs" {{$passengers->title=="Mrs"?"selected":''}}>Mrs</option>
                                            <option value="Ms" {{$passengers->title=="Ms"?"selected":''}}>Ms</option>
                                            <option value="Master" {{$passengers->title=="Master"?"selected":''}}>Master
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
                    <div class="mb-4">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Flight Booking Details</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12">
                                <div class="table-responsive details-table-wrappper">
                                    <table id="flightTable" class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="9" style="text-align: center;"><i class="ri ri-flight-takeoff-line" title="Flight" style="color: #1e90ff; font-size: 18px;"></i> Departure</th>
                                                <th colspan="8" style="text-align: center;"><i class="ri ri-flight-land-line" title="Flight" style="color: #1e90ff; font-size: 18px;"></i> Arrival</th>
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
                                                   <select class="form-control" name="flight[{{ $index }}][direction]" style="width: 80px;">
                                                        <option value="">Select </option>
                                                        <option value="Inbound" {{ $flight->direction == 'Inbound' ? 'selected' : '' }}>Inbound</option>
                                                        <option value="Outbound" {{ $flight->direction == 'Outbound' ? 'selected' : '' }}>Outbound</option>
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
                                                    <select class="form-control" style="width: 75px;" name="flight[{{ $index }}][cabin]">
                                                        <option value="">Select</option>
                                                        <option value="B.Eco" {{ old("flight.$index.cabin", $flight->cabin) == 'B.Eco' ? 'selected' : '' }}>B.Eco</option>
                                                        <option value="Eco" {{ old("flight.$index.cabin", $flight->cabin) == 'Eco' ? 'selected' : '' }}>Eco</option>
                                                        <option value="Pre.Eco" {{ old("flight.$index.cabin", $flight->cabin) == 'Pre.Eco' ? 'selected' : '' }}>Pre.Eco</option>
                                                        <option value="Buss." {{ old("flight.$index.cabin", $flight->cabin) == 'Buss.' ? 'selected' : '' }}>Buss.</option>
                                                    </select>
                                                </td>

                                                <td><input type="text" class="form-control"
                                                        name="flight[{{ $index }}][class_of_service]"
                                                        value="{{ old("flight.$index.class_of_service", $flight->class_of_service) }}"
                                                        placeholder="Class of Service" style="width: 37px;" min="0" max="1"></td>
                                                <td><input type="text" class="form-control"
                                                        name="flight[{{ $index }}][departure_airport]"
                                                        value="{{ old("flight.$index.departure_airport", $flight->departure_airport) }}"
                                                        placeholder="Departure Airport"></td>

                                                <td><input type="time" class="form-control"
                                                        name="flight[{{ $index }}][departure_hours]"
                                                        style="width: 86px"
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
                    <div class="mb-4">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Car Booking Details</h5>
                        <input type="file" id="screenshots-upload" name="carbookingimage[]" multiple>
                        <div class="upload-file position-relative">
                            {{--                                <input type="file" id="screenshots-upload" name="carbookingimage[]" multiple>--}}
                            {{--                                <label for="screenshots-upload">Upload Files</label>--}}
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
                </div>
            </div>
            <!------------------------ End Car Booking Details ------------------------------>

            <!------------------------ Cruise Booking Details ------------------------------>
            <div class="tab-pane fade" id="cruisebooking" role="tabpanel" aria-labelledby="cruisebooking-tab">
                <div class="card p-4">
                    <div class="mb-4">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Cruise Booking Details</h5>
                        <input type="file" id="screenshots-upload" name="cruisebookingimage[]" multiple>
                        <div class="upload-file position-relative">

                            {{--                                <label for="screenshots-upload">Upload Files</label>--}}
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
                                            <th>Date</th>
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
                                            <td><input style="width: 105px;" type="date" class="form-control"
                                                    name="cruise[{{$key}}][date]"
                                                    value="{{$travelCruise->date?->format('Y-m-d')}}"></td>
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
                                                    value="{{$travelCruise->stateroom}}" placeholder="Stateroom"></td>
                                            <td><input type="text" class="form-control" style="width:7.5rem"
                                                    name="cruise[{{$key}}][departure_port]"
                                                    value="{{$travelCruise->departure_port}}"
                                                    placeholder="Departure Port"></td>
                                            <td><input style="width: 105px;" type="date" class="form-control"
                                                    name="cruise[{{$key}}][departure_date]"
                                                    value="{{$travelCruise->departure_date?->format('Y-m-d')}}"></td>
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
            </div>
            <!------------------------ End Cruise Booking Details ------------------------------>


            <!------------------------ Hotel Booking Details ------------------------------>

            <div class="tab-pane fade" id="hotelbooking" role="tabpanel" aria-labelledby="hotelbooking-tab">
                <div class="card p-4">
                    <div class="mb-4">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Hotel Booking Details</h5>
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
                                                    value="{{$travelHotel->hotel_name}}" placeholder="Hotel Name"></td>
                                            <td><input type="text" class="form-control" style="width:8rem"
                                                    name="hotel[{{$key}}][room_category]"
                                                    value="{{$travelHotel->room_category}}" placeholder="Room Category">
                                            </td>

                                            <td><input type="date" class="form-control"
                                                    name="hotel[{{$key}}][checkin_date]"
                                                    value="{{$travelHotel->checkin_date?->format('Y-m-d')}}" style="width: 114px;"></td>

                                            <td><input type="date" class="form-control"
                                                    name="hotel[{{$key}}][checkout_date]"
                                                    value="{{$travelHotel->checkout_date?->format('Y-m-d')}}" style="width: 114px;"></td>
                                            
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
                    <div class="mb-4">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Train Booking Details</h5>
                        <input type="file" id="screenshots-upload" name="trainbookingimage[]" multiple>
                        <div class="upload-file position-relative">
                            {{--                                <label for="screenshots-upload">Upload Files</label>--}}
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
                                                    value="{{$trainBookingDetails->cabin}}" placeholder="Cabin"></td>
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
                </div>
            </div>
            <!------------------------ End Train Booking Details ------------------------------>




            <!--------------------------------------Billing Details ---------------------------->
            <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-header border-0 p-0">Billing Details</h5>
                        <div>
                            <button type="button" class="btn btn-outline-secondary btn-sm submit-paylink-btn">Submit
                                Paylink</button>
                        </div>
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
                                                        {{$billingDetails->card_type == 'VISA' ? 'selected' : ''}}>VISA
                                                    </option>
                                                    <option value="Mastercard"
                                                        {{$billingDetails->card_type == 'Mastercard' ? 'selected' : ''}}>
                                                        Mastercard</option>
                                                    <option value="AMEX"
                                                        {{$billingDetails->card_type == 'AMEX' ? 'selected' : ''}}>AMEX
                                                    </option>
                                                    <option value="DISCOVER"
                                                        {{$billingDetails->card_type == 'DISCOVER' ? 'selected' : ''}}>
                                                        DISCOVER</option>
                                                </select>
                                            </td>
                                            <td><input style="width: 140px;" inputmode="numeric" pattern="\d{15}"
                                                    maxlength="16"
                                                    oninput="this.value = this.value.replace(/\D/g, '').slice(0,16)"
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
                                            <td><input style="width: 57px;" inputmode="numeric" pattern="\d{4}"
                                                    maxlength="4"
                                                    oninput="this.value = this.value.replace(/\D/g, '').slice(0,5)"
                                                    class="form-control" placeholder="CVV" name="billing[{{$key}}][cvv]"
                                                    value="{{$billingDetails->cvv}}"></td>
                                            <td><input style="width: 180px;" type="text" class="form-control"
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
                                                    <!-- Populated by JavaScript -->
                                                </select>
                                            </td>
                                            <td>
                                                <select id="state-{{$key}}" style="width:7.5rem"
                                                    class="form-control state-select" name="billing[{{$key}}][state]">
                                                    <option value="India">Select State</option>
                                                    <!-- Populated by JavaScript -->
                                                </select>
                                            </td>
                                            <td><input style="width: 65px;" type="text" class="form-control"
                                                    placeholder="ZIP Code" name="billing[{{$key}}][zip_code]"
                                                    value="{{$billingDetails->zip_code}}"></td>
                                            <td>
                                                <select class="form-control" name="billing[{{$key}}][currency]">
                                                    <option value="">Select Currency</option>
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
                                            <td><input style="width: 120px;" type="number" class="form-control"
                                                    placeholder="0.00" name="billing[{{$key}}][amount]"
                                                    value="{{$billingDetails->amount}}" step="0.01"></td>
                                            <td class="text-center"><input class="form-check-input" type="radio"
                                                    name="activeCard" value="{{$key}}"
                                                    {{$billingDetails->is_active == 1 ? 'checked' : ''}}>
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

                        <table class="pricing-table table">
                            <thead>
                                <tr>
                                    <td colspan="3" rowspan="1"><strong>Gross Amount Collected</strong></td>
                                    <td colspan="2" rowspan="1"><strong>Net Amount (Paid)</strong></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Passengers*</th>
                                    <th>No. of Pax</th>
                                    <th>Price*</th>
                                    <th>Total*</th>
                                    <th>Price*</th>
                                    <th>Total</th>
                                    <th>Details</th>
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
                                        </select>
                                    </td>
                                    <td><input style="width: 120px" type="number" class="form-control"
                                            name="pricing[0][num_passengers]" placeholder="No. of Passengers" min="0">
                                    </td>
                                    <td><input style="width: 110px;" type="number" class="form-control"
                                            name="pricing[0][gross_price]" placeholder="Gross Price" min="0"
                                            step="0.01"></td>
                                    <td><span class="gross-total">0.00</span></td>
                                    <td><input type="number" style="width: 110px;" class="form-control"
                                            name="pricing[0][net_price]" placeholder="Net Price" min="0" step="0.01">
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
                                                {{$pricingDetails->details=='ticket_cost'?'selected':''}}>Ticket Cost
                                            </option>
                                            <option value="merchant_fee"
                                                {{$pricingDetails->details=='merchant_fee'?'selected':''}}>Merchant Fee
                                            </option>
                                            <option value="company_card_used"
                                                {{$pricingDetails->details=='company_card_used'?'selected':''}}>Company
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
                                    <tr>
                                        <td>Sno.</td>
                                        <td>Remark</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody id="bookingtableremarktable">
                                    @if($booking->remarks)
                                    @foreach($booking->remarks as $key=>$remar)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$remar->particulars}}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger deleteRemark"
                                                data-id="{{$remar->id}}">
                                                Delete
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


            <!--------------------------- feedback --------------------------->
            <!-- Quality Feedback -->
            <div class="tab-pane fade" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Quality Feedback</h5>
                        <button id="saveRemark" type="button" class="btn btn-primary">Save Feedback</button>
                    </div>
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <textarea class="inputs1 form-control" id="qltynotes" name="qltynotes"
                                    spellcheck="false"></textarea>
                            </div>
                            @php

                            $option =
                            !empty($booking->qualityFeedback[0]->parameters)?json_decode($booking->qualityFeedback[0]->parameters):[];
                            @endphp
                            <div class="col-lg-3 col-md-4 col-12 mt-4">
                                <label
                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check"
                                    for="Probing & Understanding">
                                    <input class="form-check-input chkqlty" type="checkbox"
                                        value="Probing & Understanding" id="Probing & Understanding"
                                        name="quality_feedback[]"
                                        {{in_array('Probing & Understanding',$option)?'checked':''}} />
                                    <span class="form-check-label text-dark">Probing & Understanding</span>
                                </label>
                            </div>
                            <div class="col-lg-3 col-md-4 col-12 mt-4">
                                <label
                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check"
                                    for="Dead air/Hold procedure">
                                    <input class="form-check-input chkqlty" type="checkbox"
                                        value="Dead air/Hold procedure" id="Dead air/Hold procedure"
                                        name="quality_feedback[]"
                                        {{in_array('Dead air/Hold procedure',$option)?'checked':''}} />
                                    <span class="form-check-label text-dark">Dead air/Hold procedure</span>
                                </label>
                            </div>
                            <div class="col-lg-3 col-md-4 col-12 mt-4">
                                <label
                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check"
                                    for="Soft Skills">
                                    <input class="form-check-input chkqlty" type="checkbox" value="Soft Skills"
                                        id="Soft Skills" name="quality_feedback[]"
                                        {{in_array('Soft Skills',$option)?'checked':''}}>
                                    <span class="form-check-label text-dark">Soft Skills</span>
                                </label>
                            </div>
                            <div class="col-lg-3 col-md-4 col-12 mt-4">
                                <label
                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check"
                                    for="Active Listening/Interruption">
                                    <input class="form-check-input chkqlty" type="checkbox"
                                        value="Active Listening/Interruption" id="Active Listening/Interruption"
                                        name="quality_feedback[]"
                                        {{in_array('Active Listening/Interruption',$option)?'checked':''}}>
                                    <span class="form-check-label text-dark">Active Listening/Interruption</span>
                                </label>
                            </div>
                            <div class="col-lg-3 col-md-4 col-12 mt-4">
                                <label
                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check"
                                    for="Call Handling">
                                    <input class="form-check-input chkqlty" type="checkbox" value="Call Handling"
                                        id="Call Handling" name="quality_feedback[]"
                                        {{in_array('Call Handling',$option)?'checked':''}}>
                                    <span class="form-check-label text-dark">Call Handling</span>
                                </label>
                            </div>
                            <div class="col-lg-3 col-md-4 col-12 mt-4">
                                <label
                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check"
                                    for="Selling Skills">
                                    <input class="form-check-input chkqlty" type="checkbox" value="Selling Skills"
                                        id="Selling Skills" name="quality_feedback[]"
                                        {{in_array('Selling Skills',$option)?'checked':''}}>
                                    <span class="form-check-label text-dark">Selling Skills</span>
                                </label>
                            </div>
                            <div class="col-lg-3 col-md-4 col-12 mt-4">
                                <label
                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check"
                                    for="Cross Selling">
                                    <input class="form-check-input chkqlty" type="checkbox" value="Cross Selling"
                                        id="Cross Selling" name="quality_feedback[]"
                                        {{in_array('Cross Selling',$option)?'checked':''}}>
                                    <span class="form-check-label text-dark">Cross Selling</span>
                                </label>
                            </div>
                            <div class="col-lg-3 col-md-4 col-12 mt-4">
                                <label
                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check"
                                    for="Documentation">
                                    <input class="form-check-input chkqlty" type="checkbox" value="Documentation"
                                        id="Documentation" name="quality_feedback[]"
                                        {{in_array('Documentation',$option)?'checked':''}}>
                                    <span class="form-check-label text-dark">Documentation</span>
                                </label>
                            </div>
                            <div class="col-lg-3 col-md-4 col-12 mt-4">
                                <label
                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check"
                                    for="Disposition">
                                    <input class="form-check-input chkqlty" type="checkbox" value="Disposition"
                                        id="Disposition" name="quality_feedback[]"
                                        {{in_array('Disposition',$option)?'checked':''}}>
                                    <span class="form-check-label text-dark">Disposition</span>
                                </label>
                            </div>
                            <div class="col-lg-3 col-md-4 col-12 mt-4">
                                <label
                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check"
                                    for="Call Closing">
                                    <input class="form-check-input chkqlty" type="checkbox" value="Call Closing"
                                        id="Call Closing" name="quality_feedback[]"
                                        {{in_array('Call Closing',$option)?'checked':''}}>
                                    <span class="form-check-label text-dark">Call Closing</span>
                                </label>
                            </div>
                            <div class="col-lg-3 col-md-4 col-12 mt-4">
                                <label
                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check"
                                    for="Fatal - Misrepresentation">
                                    <input class="form-check-input chkqlty" type="checkbox"
                                        value="Fatal - Misrepresentation" id="Fatal - Misrepresentation"
                                        name="quality_feedback[]"
                                        {{in_array('Fatal - Misrepresentation',$option)?'checked':''}}>
                                    <span class="form-check-label text-dark">Fatal - Misrepresentation</span>
                                </label>
                            </div>
                            <div class="col-lg-3 col-md-4 col-12 mt-4">
                                <label
                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check"
                                    for="Fatal - Rude/Sarcastic behaviour">
                                    <input class="form-check-input chkqlty" type="checkbox"
                                        value="Fatal - Rude/Sarcastic behaviour" id="Fatal - Rude/Sarcastic behaviour"
                                        name="quality_feedback[]"
                                        {{in_array('Fatal - Rude/Sarcastic behaviour',$option)?'checked':''}}>
                                    <span class="form-check-label text-dark">Fatal - Rude/Sarcastic behaviour</span>
                                </label>
                            </div>
                            <div class="col-lg-3 col-md-4 col-12 mt-4">
                                <label
                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check"
                                    for="Fatal - Unethical sale">
                                    <input class="form-check-input chkqlty" type="checkbox"
                                        value="Fatal - Unethical sale" id="Fatal - Unethical sale"
                                        name="quality_feedback[]"
                                        {{in_array('Fatal - Unethical sale',$option)?'checked':''}}>
                                    <span class="form-check-label text-dark">Fatal - Unethical sale</span>
                                </label>
                            </div>
                            <div class="col-lg-3 col-md-4 col-12 mt-4">
                                <label
                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check"
                                    for="Paraphrasing">
                                    <input class="form-check-input chkqlty" type="checkbox" value="Paraphrasing"
                                        id="Paraphrasing" name="quality_feedback[]"
                                        {{in_array('Paraphrasing',$option)?'checked':''}}>
                                    <span class="form-check-label text-dark">Paraphrasing</span>
                                </label>
                            </div>
                            <div class="col-lg-3 col-md-4 col-12 mt-4">
                                <select id="selqlstatus" name="selqlstatus" class="form-select rm-check">
                                    <option value="">Status</option>
                                    <option value="Pending"
                                        {{ old('selqlstatus', $booking->quality_status ?? '') === 'Pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="Rejected"
                                        {{ old('selqlstatus', $booking->quality_status ?? '') === 'Rejected' ? 'selected' : '' }}>
                                        Rejected</option>
                                    <option value="Approved"
                                        {{ old('selqlstatus', $booking->quality_status ?? '') === 'Approved' ? 'selected' : '' }}>
                                        Approved</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--------------------------- End feedback --------------------------->


            <!--------------------------- Screenshots --------------------------->
            <div class="tab-pane fade" id="screenshots" role="tabpanel" aria-labelledby="screenshots-tab">
                <div class="card p-4">
                    <div class="mb-4">
                        <h5 class="card-header border-0 p-0 mb-4 detail-passanger">Screenshots</h5>
                        <input type="file" id="screenshots-upload" name="screenshots[]" multiple>
                        <div class="upload-file position-relative">
                            {{--                                <label for="screenshots-upload">Upload Files</label>--}}
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if($booking->screenshots->isNotEmpty())
                        @foreach($booking->screenshots as $index => $screenshot)
                        <input type="hidden" name="screenshots[{{ $index }}][id]" value="{{ $screenshot->id }}">
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!---------------------------End  Screenshots --------------------------->





        </div>
    </div>
</div>

</form>


@vite('resources/js/booking/edit.js')

@vite('resources/js/auth/sendAuth.js')


<style>
    .booked-content table thead th, .booked-content table tbody td {
    padding: 5px !important;
}
</style>

@endsection
