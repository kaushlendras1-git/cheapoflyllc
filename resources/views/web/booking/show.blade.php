
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
                    <span>Created by Testagent on 4/7/2025 12:40:28 PM</span>
                </div>
                <div class="d-flex gap-2">
                    
                    <a href="{{route('signature.form')}}">
                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill">
                            Copy Authorization Link
                        </button>
                    </a>

                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill">
                        Mail History
                    </button>
                    
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill">
                        Survey
                    </button>
                    
                </div>
            </div>

              @include('web.layouts.flash')

               @php
                    $bookingTypes = $booking->bookingTypes->pluck('type')->toArray();
                @endphp


            <!-- Top Bar -->
            <div class="card p-3 mt-2">
                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox" id="booking-flight" value="Flight" {{ in_array('Flight', $bookingTypes) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-flight">Flight</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox" id="booking-hotel" value="Hotel" {{ in_array('Hotel', $bookingTypes) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-hotel">Hotel</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox" id="booking-cruise" value="Cruise" {{ in_array('Cruise', $bookingTypes) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-cruise">Cruise</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox" id="booking-car" value="Car" {{ in_array('Car', $bookingTypes) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-car">Car</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input toggle-tab" type="checkbox" id="booking-train" value="Train" {{ in_array('Train', $bookingTypes) ? 'checked' : '' }}>
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
                        <input type="text" class="form-control" name="pnr" value="{{ $booking->pnr }}" readonly>
                    </div>


                    <fieldset id="flight-inputs" class="toggle-section">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">Airline PNR</label>
                                <input type="text" class="form-control" name="airlinepnr" value="{{ $booking->airlinepnr }}" placeholder="Airline PNR">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Amadeus/Sabre PNR</label>
                                <input type="text" class="form-control" name="amadeus_sabre_pnr" value="{{ $booking->amadeus_sabre_pnr }}">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label"> PNR Type</label>
                                <select class="form-control" name="pnrtype">
                                    <option value="" {{ old('pnrtype', $booking->pnrtype ?? '') === '' ? 'selected' : '' }}>Select</option>
                                    <option value="HK" {{ old('pnrtype', $booking->pnrtype ?? '') === 'HK' ? 'selected' : '' }}>HK</option>
                                    <option value="GK" {{ old('pnrtype', $booking->pnrtype ?? '') === 'GK' ? 'selected' : '' }}>GK</option>
                                </select>
                            </div>
                        </div>
                    </fieldset >


                    <div class="col-md-3"  id="hotel-inputs">
                        <label class="form-label">Hotel Ref</label>
                        <input type="text" class="form-control" name="hotel_ref" value="{{ old('hotel_ref', $booking->hotel_ref ?? '') }}" placeholder="Hotel Ref">
                    </div>


                    <div class="col-md-3"  id="cruise-inputs">
                        <label class="form-label">Cruise Ref</label>
                         <input type="text" class="form-control" name="cruise_ref" value="{{ old('cruise_ref', $booking->cruise_ref ?? '') }}" placeholder="Cruise Ref">
                    </div>

                    <div class="col-md-3"  id="car-inputs" >
                        <label class="form-label">Car Ref</label>
                        <input type="text" class="form-control" name="car_ref" value="{{ old('car_ref', $booking->car_ref ?? '') }}" placeholder="Car Ref">
                    </div>


                    <div class="col-md-3" id="train-inputs">
                        <label class="form-label">Train Ref</label>
                        <input type="text" class="form-control" name="train_ref" value="{{ old('train_ref', $booking->train_ref ?? '') }}" placeholder="Train Ref">
                    </div>



                    <div class="col-md-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                         <input type="text" class="form-control" name="name" value="{{ old('name', $booking->name ?? '') }}">
                    </div>


                    <div class="col-md-3">
                        <label class="form-label">Calling Phone No. <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone', $booking->phone ?? '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $booking->email ?? '') }}">
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
                        <label class="form-label">Booking Status</label>
                        <select class="form-control" name="booking_status">
                            <option value="under process" {{ old('booking_status', $booking->booking_status ?? '') === 'under process' ? 'selected' : '' }}>under process</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Payment Status</label>
                        <select class="form-control" name="payment_status">
                            <option value="pending" {{ old('payment_status', $booking->payment_status ?? '') === 'pending' ? 'selected' : '' }}>pending</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Query Type</label>
                        <select id="query_type" class="form-control" name="query_type">
                            <option value="N" {{ old('query_type', $booking->query_type ?? '') === 'N' ? 'selected' : '' }}>New Booking</option>
                            <option value="NC" {{ old('query_type', $booking->query_type ?? '') === 'NC' ? 'selected' : '' }}>New Booking(Credit)</option>
                            <option value="M" {{ old('query_type', $booking->query_type ?? '') === 'M' ? 'selected' : '' }}>New Booking(Miles)</option>
                            <option value="UMNR" {{ old('query_type', $booking->query_type ?? '') === 'UMNR' ? 'selected' : '' }}>Unaccompanied Minor Reservation</option>
                            <option value="CC" {{ old('query_type', $booking->query_type ?? '') === 'CC' ? 'selected' : '' }}>Cancel(Credit)</option>
                            <option value="CR" {{ old('query_type', $booking->query_type ?? '') === 'CR' ? 'selected' : '' }}>Cancel(Refund)</option>
                            <option value="CH" {{ old('query_type', $booking->query_type ?? '') === 'CH' ? 'selected' : '' }}>Change</option>
                            <option value="U" {{ old('query_type', $booking->query_type ?? '') === 'U' ? 'selected' : '' }}>Upgrade</option>
                            <option value="NMC" {{ old('query_type', $booking->query_type ?? '') === 'NMC' ? 'selected' : '' }}>Name Correction</option>
                            <option value="S" {{ old('query_type', $booking->query_type ?? '') === 'S' ? 'selected' : '' }}>Seat Assignment</option>
                            <option value="B" {{ old('query_type', $booking->query_type ?? '') === 'B' ? 'selected' : '' }}>Baggage Addition</option>
                            <option value="CBP" {{ old('query_type', $booking->query_type ?? '') === 'CBP' ? 'selected' : '' }}>Change Bed Preference</option>
                            <option value="AI" {{ old('query_type', $booking->query_type ?? '') === 'AI' ? 'selected' : '' }}>Infant Addition</option>
                            <option value="AE" {{ old('query_type', $booking->query_type ?? '') === 'AE' ? 'selected' : '' }}>Adding Excursion</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Company Organisation</label>
                          <select id="selected_company" name="selected_company" class="form-control">
                            <option value="1" {{ old('selected_company', $booking->selected_company ?? '') === '1' ? 'selected' : '' }}>flydreamz</option>
                            <option value="3" {{ old('selected_company', $booking->selected_company ?? '') === '3' ? 'selected' : '' }}>fareticketsllc</option>
                            <option value="5" {{ old('selected_company', $booking->selected_company ?? '') === '5' ? 'selected' : '' }}>fareticketsus</option>
                            <option value="6" {{ old('selected_company', $booking->selected_company ?? '') === '6' ? 'selected' : '' }}>cruiselineservice</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label"> Campaign</label>
                        <select class="form-control" name="campaign">
                            <option value="" {{ old('campaign', $booking->campaign ?? '') === '' ? 'selected' : '' }}>Select</option>
                            <option value="Agency" {{ old('campaign', $booking->campaign ?? '') === 'Agency' ? 'selected' : '' }}>Agency</option>
                            <option value="Airline Mix" {{ old('campaign', $booking->campaign ?? '') === 'Airline Mix' ? 'selected' : '' }}>Airline Mix</option>
                            <option value="Buffer Mix" {{ old('campaign', $booking->campaign ?? '') === 'Buffer Mix' ? 'selected' : '' }}>Buffer Mix</option>
                            <option value="Cruise" {{ old('campaign', $booking->campaign ?? '') === 'Cruise' ? 'selected' : '' }}>Cruise</option>
                            <option value="International" {{ old('campaign', $booking->campaign ?? '') === 'International' ? 'selected' : '' }}>International</option>
                            <option value="LCC" {{ old('campaign', $booking->campaign ?? '') === 'LCC' ? 'selected' : '' }}>LCC</option>
                            <option value="Premium Amtrak Bing Calls" {{ old('campaign', $booking->campaign ?? '') === 'Premium Amtrak Bing Calls' ? 'selected' : '' }}>Premium Amtrak Bing Calls</option>
                            <option value="Pure AA" {{ old('campaign', $booking->campaign ?? '') === 'Pure AA' ? 'selected' : '' }}>Pure AA</option>
                            <option value="Spanish" {{ old('campaign', $booking->campaign ?? '') === 'Spanish' ? 'selected' : '' }}>Spanish</option>
                        </select>
                    </div>


                </div>
            </div>




            <!-- Tab Navigation -->
            <ul class="nav nav-tabs my-5" id="bookingTabs" role="tablist">




    <li class="nav-item" role="presentation" data-tab="Flight" style="{{ in_array('Flight', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
        <a class="nav-link" id="flightbooking-tab" data-bs-toggle="tab" href="#flightbooking" role="tab" aria-controls="flightbooking" aria-selected="true">Flight Booking</a>
    </li>
    <li class="nav-item" role="presentation" data-tab="Hotel" style="{{ in_array('Hotel', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
        <a class="nav-link" id="hotelbooking-tab" data-bs-toggle="tab" href="#hotelbooking" role="tab" aria-controls="hotelbooking" aria-selected="true">Hotel Booking</a>
    </li>
    <li class="nav-item" role="presentation" data-tab="Cruise" style="{{ in_array('Cruise', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
        <a class="nav-link" id="cruisebooking-tab" data-bs-toggle="tab" href="#cruisebooking" role="tab" aria-controls="cruisebooking" aria-selected="true">Cruise Booking</a>
    </li>
    <li class="nav-item" role="presentation" data-tab="Car" style="{{ in_array('Car', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
        <a class="nav-link" id="carbooking-tab" data-bs-toggle="tab" href="#carbooking" role="tab" aria-controls="carbooking" aria-selected="true">Car Booking</a>
    </li>
    <li class="nav-item" role="presentation" data-tab="Train" style="{{ in_array('Train', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
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
     <li class="nav-item" role="presentation">
            <a class="nav-link" id="feedback-tab" data-bs-toggle="tab" href="#feedback" role="tab" aria-controls="feedback" aria-selected="false">Quality Feedback</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="screenshots-tab" data-bs-toggle="tab" href="#screenshots" role="tab" aria-controls="screenshots" aria-selected="false">Screenshots</a>
        </li>
</ul>




            <!-- Tab Content -->
            <div class="tab-content" id="bookingTabsContent">



        <!------------------------ Flight Booking Details ------------------------------>

                <div class="tab-pane fade" id="flightbooking" role="tabpanel" aria-labelledby="flightbooking-tab">
                    <div class="card p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-header border-0 p-0">Flight Booking Details</h5>
                            </div>
                            <div class="card-body pt-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12">
                                        <input type="file" id="screenshots-upload" name="screenshots[]" multiple>
                                    </div>

                                    <div class="col-md-12">
                                        <table id="flightTable">
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
                                            <tbody id="flightForms">
                                                @if($booking->travelFlight->isNotEmpty())
                                                    @foreach($booking->travelFlight as $index => $flight)
                                                        <tr class="flight-row" data-index="{{ $index }}">
                                                            <td><span class="flight-title">{{ $index + 1 }}</span></td>
                                                            <td><input type="text" class="form-control" name="flight[{{ $index }}][direction]" value="{{ old("flight.$index.direction", $flight->direction) }}" placeholder="Direction"></td>
                                                            <td><input type="date" class="form-control" name="flight[{{ $index }}][departure_date]" value="{{ old("flight.$index.date", $flight->departure_date) }}"></td>
                                                            <td><input type="text" class="form-control" name="flight[{{ $index }}][airline_code]" value="{{ old("flight.$index.airlines_code", $flight->airline_code) }}" placeholder="Airlines (Code)"></td>
                                                            <td><input type="text" class="form-control" name="flight[{{ $index }}][flight_number]" value="{{ old("flight.$index.flight_no", $flight->flight_number) }}" placeholder="Flight No"></td>
                                                            <td><input type="text" class="form-control" name="flight[{{ $index }}][cabin]" value="{{ old("flight.$index.cabin", $flight->cabin) }}" placeholder="Cabin"></td>
                                                            <td><input type="text" class="form-control" name="flight[{{ $index }}][class_of_service]" value="{{ old("flight.$index.class_of_service", $flight->class_of_service) }}" placeholder="Class of Service"></td>
                                                            <td><input type="text" class="form-control" name="flight[{{ $index }}][departure_airport]" value="{{ old("flight.$index.departure_airport", $flight->departure_airport) }}" placeholder="Departure Airport"></td>
                                                            <td><input type="number" class="form-control" name="flight[{{ $index }}][departure_hours]" value="{{ old("flight.$index.departure_hrs", $flight->departure_hours) }}" placeholder="Hrs" min="0" max="23"></td>
                                                            <td><input type="number" class="form-control" name="flight[{{ $index }}][departure_minutes]" value="{{ old("flight.$index.departure_mm", $flight->departure_minutes) }}" placeholder="mm" min="0" max="59"></td>
                                                            <td><input type="text" class="form-control" name="flight[{{ $index }}][arrival_airport]" value="{{ old("flight.$index.arrival_airport", $flight->arrival_airport) }}" placeholder="Arrival Airport"></td>
                                                            <td><input type="number" class="form-control" name="flight[{{ $index }}][arrival_hours]" value="{{ old("flight.$index.arrival_hrs", $flight->arrival_hours) }}" placeholder="Hrs" min="0" max="23"></td>
                                                            <td><input type="number" class="form-control" name="flight[{{ $index }}][arrival_minutes]" value="{{ old("flight.$index.arrival_mm", $flight->arrival_minutes) }}" placeholder="mm" min="0" max="59"></td>
                                                            <td><input type="text" class="form-control" name="flight[{{ $index }}][duration]" value="{{ old("flight.$index.duration", $flight->duration) }}" placeholder="Duration"></td>
                                                            <td><input type="text" class="form-control" name="flight[{{ $index }}][transit]" value="{{ old("flight.$index.transit", $flight->transit) }}" placeholder="Transit"></td>
                                                            <td><input type="date" class="form-control" name="flight[{{ $index }}][arrival_date]" value="{{ old("flight.$index.arrival_date", $flight->arrival_date) }}"></td>
                                                            <td>
                                                                <button type="button" class="btn btn-outline-danger delete-flight-btn">
                                                                    <i class="ri ri-delete-bin-line"></i>
                                                                </button>
                                                                <!-- Hidden input to store flight ID for existing records -->
                                                                <input type="hidden" name="flight[{{ $index }}][id]" value="{{ $flight->id }}">
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
                </div>
            <!------------------------ End Flight Booking Details ------------------------------>

              <!------------------------ Car Booking Details ------------------------------>
                <div class="tab-pane fade" id="carbooking" role="tabpanel" aria-labelledby="carbooking-tab">
                    <div class="card p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-header border-0 p-0">Car Booking Details</h5>
                            </div>
                            <div class="card-body pt-3">
                                <div class="row g-3 align-items-center">
                                    
                                    <div class="col-md-12">
                                        <input type="file" id="screenshots-upload" name="screenshots[]" multiple>
                                    </div>

                                    <div class="col-md-12">
                                        <!-- Car Table -->
                                        <table id="carTable">
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
                                            <tbody id="carForms">
                                                @if($booking->travelCar->isNotEmpty())
                                                    @foreach($booking->travelCar as $index => $car)
                                                        <tr class="car-row" data-index="{{ $index }}">
                                                            <td><span class="car-title">{{ $index + 1 }}</span></td>
                                                            <td><input type="text" class="form-control" name="car[{{ $index }}][car_rental_provider]" value="{{ old("car.$index.car_rental_provider", $car->car_rental_provider) }}" placeholder="Car Rental Provider"></td>
                                                            <td><input type="text" class="form-control" name="car[{{ $index }}][car_type]" value="{{ old("car.$index.car_type", $car->car_type) }}" placeholder="Car Type"></td>
                                                            <td><input type="text" class="form-control" name="car[{{ $index }}][pickup_location]" value="{{ old("car.$index.pickup_location", $car->pickup_location) }}" placeholder="Pick-up Location"></td>
                                                            <td><input type="text" class="form-control" name="car[{{ $index }}][dropoff_location]" value="{{ old("car.$index.dropoff_location", $car->dropoff_location) }}" placeholder="Drop-off Location"></td>
                                                            <td><input type="date" class="form-control" name="car[{{ $index }}][pickup_date]" value="{{ old("car.$index.pickup_date", $car->pickup_date) }}"></td>
                                                            <td><input type="time" class="form-control" name="car[{{ $index }}][pickup_time]" value="{{ old("car.$index.pickup_time", $car->pickup_time) }}"></td>
                                                            <td><input type="date" class="form-control" name="car[{{ $index }}][dropoff_date]" value="{{ old("car.$index.dropoff_date", $car->dropoff_date) }}"></td>
                                                            <td><input type="time" class="form-control" name="car[{{ $index }}][dropoff_time]" value="{{ old("car.$index.dropoff_time", $car->dropoff_time) }}"></td>
                                                            <td><input type="text" class="form-control" name="car[{{ $index }}][confirmation_number]" value="{{ old("car.$index.confirmation_number", $car->confirmation_number) }}" placeholder="Confirmation Number"></td>
                                                            <td><input type="text" class="form-control" name="car[{{ $index }}][remarks]" value="{{ old("car.$index.remarks", $car->remarks) }}" placeholder="Remarks"></td>
                                                            <td><input type="text" class="form-control" name="car[{{ $index }}][rental_provider_address]" value="{{ old("car.$index.rental_provider_address", $car->rental_provider_address) }}" placeholder="Rental Provider's Address"></td>
                                                            <td>
                                                                <button type="button" class="btn btn-outline-danger delete-car-btn">
                                                                    <i class="ri ri-delete-bin-line"></i>
                                                                </button>
                                                                <input type="hidden" name="car[{{ $index }}][id]" value="{{ $car->id }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr id="noCars">
                                                        <td colspan="13" class="text-center">No car rental details available. Click "Add Car" to start.</td>
                                                    </tr>
                                                @endif
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
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-header border-0 p-0">Cruise Booking Details</h5>
                            </div>
                            <div class="card-body pt-3">
                                <div class="row g-3 align-items-center">
                                    
                                <div class="col-md-12">
                                        <input type="file" id="screenshots-upload" name="screenshots[]" multiple>
                                    </div>


                                    <div class="col-md-12">
                                        <!-- Cruise Table -->
                                        <table id="cruiseTable">
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
                                            <tbody id="cruiseForms">
                                                @if($booking->travelCruise->isNotEmpty())
                                                    @foreach($booking->travelCruise as $index => $cruise)
                                                        <tr class="cruise-row" data-index="{{ $index }}">
                                                            <td><span class="cruise-title">{{ $index + 1 }}</span></td>
                                                            <td><input type="date" class="form-control" name="cruise[{{ $index }}][date]" value="{{ old("cruise.$index.date", $cruise->date) }}"></td>
                                                            <td><input type="text" class="form-control" name="cruise[{{ $index }}][cruise_line]" value="{{ old("cruise.$index.cruise_line", $cruise->cruise_line) }}" placeholder="Cruise Line"></td>
                                                            <td><input type="text" class="form-control" name="cruise[{{ $index }}][ship_name]" value="{{ old("cruise.$index.ship_name", $cruise->ship_name) }}" placeholder="Name of the Ship"></td>
                                                            <td><input type="text" class="form-control" name="cruise[{{ $index }}][category]" value="{{ old("cruise.$index.category", $cruise->category) }}" placeholder="Category"></td>
                                                            <td><input type="text" class="form-control" name="cruise[{{ $index }}][stateroom]" value="{{ old("cruise.$index.stateroom", $cruise->stateroom) }}" placeholder="Stateroom"></td>
                                                            <td><input type="text" class="form-control" name="cruise[{{ $index }}][departure_port]" value="{{ old("cruise.$index.departure_port", $cruise->departure_port) }}" placeholder="Departure Port"></td>
                                                            <td><input type="date" class="form-control" name="cruise[{{ $index }}][departure_date]" value="{{ old("cruise.$index.departure_date", $cruise->departure_date) }}"></td>
                                                            <td><input type="number" class="form-control" name="cruise[{{ $index }}][departure_hrs]" value="{{ old("cruise.$index.departure_hrs", $cruise->departure_hrs) }}" placeholder="Hrs" min="0" max="23"></td>
                                                            <td><input type="number" class="form-control" name="cruise[{{ $index }}][departure_mm]" value="{{ old("cruise.$index.departure_mm", $cruise->departure_mm) }}" placeholder="mm" min="0" max="59"></td>
                                                            <td><input type="text" class="form-control" name="cruise[{{ $index }}][arrival_port]" value="{{ old("cruise.$index.arrival_port", $cruise->arrival_port) }}" placeholder="Arrival Port"></td>
                                                            <td><input type="date" class="form-control" name="cruise[{{ $index }}][arrival_date]" value="{{ old("cruise.$index.arrival_date", $cruise->arrival_date) }}"></td>
                                                            <td><input type="number" class="form-control" name="cruise[{{ $index }}][arrival_hrs]" value="{{ old("cruise.$index.arrival_hrs", $cruise->arrival_hrs) }}" placeholder="Hrs" min="0" max="23"></td>
                                                            <td><input type="number" class="form-control" name="cruise[{{ $index }}][arrival_mm]" value="{{ old("cruise.$index.arrival_mm", $cruise->arrival_mm) }}" placeholder="mm" min="0" max="59"></td>
                                                            <td><input type="text" class="form-control" name="cruise[{{ $index }}][remarks]" value="{{ old("cruise.$index.remarks", $cruise->remarks) }}" placeholder="Remarks"></td>
                                                            <td>
                                                                <button type="button" class="btn btn-outline-danger delete-cruise-btn">
                                                                    <i class="ri ri-delete-bin-line"></i>
                                                                </button>
                                                                <input type="hidden" name="cruise[{{ $index }}][id]" value="{{ $cruise->id }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr id="noCruises">
                                                        <td colspan="16" class="text-center">No cruise details available. Click "Add Cruise" to start.</td>
                                                    </tr>
                                                @endif
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
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-header border-0 p-0">Hotel Booking Details</h5>
                            </div>
                            <div class="card-body pt-3">
                                <div class="row g-3 align-items-center">

                                <div class="col-md-12">
                                        <input type="file" id="screenshots-upload" name="screenshots[]" multiple>
                                    </div>

                                <div class="col-md-12">
                                    <!-- Hotel Table -->
                                <table id="hotelTable">
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
                                    <tbody id="hotelForms">
                                        @if($booking->travelHotel->isNotEmpty())
                                            @foreach($booking->travelHotel as $index => $hotel)
                                                <tr class="hotel-row" data-index="{{ $index }}">
                                                    <td><span class="hotel-title">{{ $index + 1 }}</span></td>
                                                    <td><input type="text" class="form-control" name="hotel[{{ $index }}][hotel_name]" value="{{ old("hotel.$index.hotel_name", $hotel->hotel_name) }}" placeholder="Hotel Name"></td>
                                                    <td><input type="text" class="form-control" name="hotel[{{ $index }}][room_category]" value="{{ old("hotel.$index.room_category", $hotel->room_category) }}" placeholder="Room Category"></td>
                                                    <td><input type="date" class="form-control" name="hotel[{{ $index }}][checkin_date]" value="{{ old("hotel.$index.checkin_date", $hotel->checkin_date) }}"></td>
                                                    <td><input type="date" class="form-control" name="hotel[{{ $index }}][checkout_date]" value="{{ old("hotel.$index.checkout_date", $hotel->checkout_date) }}"></td>
                                                    <td><input type="number" class="form-control" name="hotel[{{ $index }}][no_of_rooms]" value="{{ old("hotel.$index.no_of_rooms", $hotel->no_of_rooms) }}" placeholder="No. Of Rooms" min="1"></td>
                                                    <td><input type="text" class="form-control" name="hotel[{{ $index }}][confirmation_number]" value="{{ old("hotel.$index.confirmation_number", $hotel->confirmation_number) }}" placeholder="Confirmation Number"></td>
                                                    <td><input type="text" class="form-control" name="hotel[{{ $index }}][hotel_address]" value="{{ old("hotel.$index.hotel_address", $hotel->hotel_address) }}" placeholder="Hotel Address"></td>
                                                    <td><input type="text" class="form-control" name="hotel[{{ $index }}][remarks]" value="{{ old("hotel.$index.remarks", $hotel->remarks) }}" placeholder="Remarks"></td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-danger delete-hotel-btn">
                                                            <i class="ri ri-delete-bin-line"></i>
                                                        </button>
                                                        <input type="hidden" name="hotel[{{ $index }}][id]" value="{{ $hotel->id }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr id="noHotels">
                                                <td colspan="10" class="text-center">No hotel details available. Click "Add Hotel" to start.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
        <!------------------------ End Hotel Booking Details ------------------------------>


      <!----------------------------------------Passeenger-------------------------------------------------->
        <div class="tab-pane fade " id="passenger" role="tabpanel" aria-labelledby="passenger-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">Passenger Details</h4>
                        </div>
                        <div class="col-md-12">                        
                            <table class="passenger-table">
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
                                    @if($booking->passengers->isNotEmpty())
                                        @foreach($booking->passengers as $index => $passenger)
                                            <tr class="passenger-form" data-index="{{ $index }}">
                                                <td><span class="billing-card-title">{{ $index + 1 }}</span></td>
                                                <td>
                                                    <select class="form-control" name="passenger[{{ $index }}][passenger_type]">
                                                        <option value="">Select</option>
                                                        <option value="Adult" {{ old("passenger.$index.passenger_type", $passenger->passenger_type) === 'Adult' ? 'selected' : '' }}>Adult</option>
                                                        <option value="Child" {{ old("passenger.$index.passenger_type", $passenger->passenger_type) === 'Child' ? 'selected' : '' }}>Child</option>
                                                        <option value="Infant" {{ old("passenger.$index.passenger_type", $passenger->passenger_type) === 'Infant' ? 'selected' : '' }}>Infant</option>
                                                        <option value="Seat Infant" {{ old("passenger.$index.passenger_type", $passenger->passenger_type) === 'Seat Infant' ? 'selected' : '' }}>Seat Infant</option>
                                                        <option value="Lap Infant" {{ old("passenger.$index.passenger_type", $passenger->passenger_type) === 'Lap Infant' ? 'selected' : '' }}>Lap Infant</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="passenger[{{ $index }}][gender]">
                                                        <option value="">Select</option>
                                                        <option value="Male" {{ old("passenger.$index.gender", $passenger->gender) === 'Male' ? 'selected' : '' }}>Male</option>
                                                        <option value="Female" {{ old("passenger.$index.gender", $passenger->gender) === 'Female' ? 'selected' : '' }}>Female</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="passenger[{{ $index }}][title]">
                                                        <option value="">Select</option>
                                                        <option value="Mr" {{ old("passenger.$index.title", $passenger->title) === 'Mr' ? 'selected' : '' }}>Mr</option>
                                                        <option value="Mrs" {{ old("passenger.$index.title", $passenger->title) === 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                                        <option value="Ms" {{ old("passenger.$index.title", $passenger->title) === 'Ms' ? 'selected' : '' }}>Ms</option>
                                                        <option value="Master" {{ old("passenger.$index.title", $passenger->title) === 'Master' ? 'selected' : '' }}>Master</option>
                                                        <option value="Miss" {{ old("passenger.$index.title", $passenger->title) === 'Miss' ? 'selected' : '' }}>Miss</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="passenger[{{ $index }}][first_name]" value="{{ old("passenger.$index.first_name", $passenger->first_name) }}" placeholder="First Name" required></td>
                                                <td><input type="text" class="form-control" name="passenger[{{ $index }}][middle_name]" value="{{ old("passenger.$index.middle_name", $passenger->middle_name) }}" placeholder="Middle Name"></td>
                                                <td><input type="text" class="form-control" name="passenger[{{ $index }}][last_name]" value="{{ old("passenger.$index.last_name", $passenger->last_name) }}" placeholder="Last Name" required></td>
                                                <td><input type="date" class="form-control" name="passenger[{{ $index }}][dob]" value="{{ old("passenger.$index.dob", $passenger->dob) }}" required></td>
                                                <td><input type="text" class="form-control" name="passenger[{{ $index }}][seat_number]" value="{{ old("passenger.$index.seat_number", $passenger->seat_number) }}" placeholder="Seat"></td>
                                                <td><input type="number" class="form-control" name="passenger[{{ $index }}][credit_note]" value="{{ old("passenger.$index.credit_note", $passenger->credit_note) }}" placeholder="0" step="0.01" min="0"></td>
                                                <td><input type="text" class="form-control" name="passenger[{{ $index }}][e_ticket_number]" value="{{ old("passenger.$index.e_ticket_number", $passenger->e_ticket_number) }}" placeholder="E Ticket"></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-danger delete-passenger" aria-label="Delete passenger">
                                                        <i class="ri ri-delete-bin-line"></i>
                                                    </button>
                                                    <input type="hidden" name="passenger[{{ $index }}][id]" value="{{ $passenger->id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr id="noPassengers">
                                            <td colspan="12" class="text-center">No passenger details available. Click "Add Passenger" to start.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    <!------------------------------------End Passeenger------------------------------------------------------>


    <!--------------------------------------Billing Details ---------------------------->
    <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-header border-0 p-0">Billing Details</h5>
                <div>
                    <button type="button" class="btn btn-outline-secondary btn-sm submit-paylink-btn">Submit Paylink</button>
                </div>
            </div>
                    <!--------------------------------------Billing Details ---------------------------->
                                   <div class="col-md-12">     

                    <table class="billing-table" id="billingTable">
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
                            @if($booking->billingDetails->isNotEmpty())
                                @foreach($booking->billingDetails as $index => $billing)
                                    <tr class="billing-card" data-index="{{ $index }}">
                                        <td><span class="billing-card-title">{{ $index + 1 }}</span></td>
                                        <td>
                                            <select class="form-control" name="billing[{{ $index }}][card_type]">
                                                <option value="">Select</option>
                                                <option value="VISA" {{ old("billing.$index.card_type", $billing->card_type) === 'VISA' ? 'selected' : '' }}>VISA</option>
                                                <option value="Mastercard" {{ old("billing.$index.card_type", $billing->card_type) === 'Mastercard' ? 'selected' : '' }}>Mastercard</option>
                                                <option value="AMEX" {{ old("billing.$index.card_type", $billing->card_type) === 'AMEX' ? 'selected' : '' }}>AMEX</option>
                                                <option value="DISCOVER" {{ old("billing.$index.card_type", $billing->card_type) === 'DISCOVER' ? 'selected' : '' }}>DISCOVER</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" name="billing[{{ $index }}][cc_number]" value="{{ old("billing.$index.cc_number", $billing->cc_number) }}" placeholder="CC Number"></td>
                                        <td><input type="text" class="form-control" name="billing[{{ $index }}][cc_holder_name]" value="{{ old("billing.$index.cc_holder_name", $billing->cc_holder_name) }}" placeholder="CC Holder Name"></td>
                                        <td>
                                            <select class="form-control" name="billing[{{ $index }}][exp_month]">
                                                <option value="">MM</option>
                                                @for($i = 1; $i <= 12; $i++)
                                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ old("billing.$index.exp_month", $billing->exp_month) === str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" name="billing[{{ $index }}][exp_year]">
                                                <option value="">YYYY</option>
                                                @for($i = date('Y'); $i <= date('Y') + 10; $i++)
                                                    <option value="{{ $i }}" {{ old("billing.$index.exp_year", $billing->exp_year) === $i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" name="billing[{{ $index }}][cvv]" value="{{ old("billing.$index.cvv", $billing->cvv) }}" placeholder="CVV"></td>
                                        <td><input type="text" class="form-control" name="billing[{{ $index }}][address]" value="{{ old("billing.$index.address", $billing->address) }}" placeholder="Address"></td>
                                        <td><input type="email" class="form-control" name="billing[{{ $index }}][email]" value="{{ old("billing.$index.email", $billing->email) }}" placeholder="Email"></td>
                                        <td><input type="text" class="form-control" name="billing[{{ $index }}][contact_no]" value="{{ old("billing.$index.contact_no", $billing->contact_no) }}" placeholder="Contact No"></td>
                                        <td><input type="text" class="form-control" name="billing[{{ $index }}][city]" value="{{ old("billing.$index.city", $billing->city) }}" placeholder="City"></td>
                                        <td>
                                            <select id="country-{{ $index }}" class="form-control country-select" name="billing[{{ $index }}][country]">
                                                <option value="">Select Country</option>

                                            </select>
                                        </td>
                                        <td>
                                            <select id="state-{{ $index }}" class="form-control state-select" name="billing[{{ $index }}][state]">
                                                <option value="">Select State</option>
                                                <!-- Populate dynamically via JavaScript based on selected country -->
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" name="billing[{{ $index }}][zip_code]" value="{{ old("billing.$index.zip_code", $billing->zip_code) }}" placeholder="ZIP Code"></td>
                                        <td>
                                            <select class="form-control" name="billing[{{ $index }}][currency]">
                                                <option value="">Select Currency</option>
                                                <option value="USD" {{ old("billing.$index.currency", $billing->currency) === 'USD' ? 'selected' : '' }}>USD</option>
                                                <option value="CAD" {{ old("billing.$index.currency", $billing->currency) === 'CAD' ? 'selected' : '' }}>CAD</option>
                                                <option value="EUR" {{ old("billing.$index.currency", $billing->currency) === 'EUR' ? 'selected' : '' }}>EUR</option>
                                                <option value="GBP" {{ old("billing.$index.currency", $billing->currency) === 'GBP' ? 'selected' : '' }}>GBP</option>
                                                <option value="AUD" {{ old("billing.$index.currency", $billing->currency) === 'AUD' ? 'selected' : '' }}>AUD</option>
                                                <option value="INR" {{ old("billing.$index.currency", $billing->currency) === 'INR' ? 'selected' : '' }}>INR</option>
                                                <option value="MXN" {{ old("billing.$index.currency", $billing->currency) === 'MXN' ? 'selected' : '' }}>MXN</option>
                                            </select>
                                        </td>
                                        <td><input type="number" class="form-control" name="billing[{{ $index }}][amount]" value="{{ old("billing.$index.amount", $billing->amount) }}" placeholder="0.00" step="0.01"></td>
                                        <td><input class="form-check-input" type="radio" name="activeCard" value="{{ $index }}" {{ old('activeCard', $billing->is_active) ? 'checked' : '' }}></td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger delete-billing-btn">
                                                <i class="ri ri-delete-bin-line"></i>
                                            </button>
                                            <!-- Hidden input to store billing ID for existing records -->
                                            <input type="hidden" name="billing[{{ $index }}][id]" value="{{ $billing->id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr id="noBilling">
                                    <td colspan="18" class="text-center">No billing details available. Click "Add Billing" to start.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
         <!--------------------------------------Billing Details ---------------------------->
    


        <!------------------------- Pricing Details ----------------------------------->
                <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
                     <div class="col-md-12">     

                     <table class="pricing-table">
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
                                <input type="number" class="form-control" name="flight_cost" value="{{$booking->pricingDetails->flight_cost}}" placeholder="0.00" step="0.01">
                            </td>

                                <td data-column="hotel">
                                    <input type="number" class="form-control" name="hotel_cost" value="{{$booking->pricingDetails->hotel_cost}}" placeholder="0.00" step="0.01">
                                </td>


                            <td data-column="cruise">
                                <input type="number" class="form-control" name="cruise_cost" value="{{$booking->pricingDetails->cruise_cost}}" placeholder="0.00" step="0.01">
                            </td>
                            <td data-column="car">
                                <input type="number" class="form-control" name="car_cost" value="{{$booking->pricingDetails->car_cost}}" placeholder="0.00" step="0.01">
                            </td>
                            <td data-column="train">
                                <input type="number" class="form-control" name="train_cost" value="{{$booking->pricingDetails->train_cost}}" placeholder="0.00" step="0.01">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="total_amount" value="{{$booking->pricingDetails->total_amount}}" placeholder="0.00" step="0.01">
                            </td>
                            <td data-column="flight">
                                <input type="number" class="form-control" name="issuance_fee" value="{{$booking->pricingDetails->issuance_fee}}" placeholder="0.00" step="0.01">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="advisor_mco" value="{{$booking->pricingDetails->advisor_mco}}" placeholder="0.00" step="0.01">
                            </td>
                            <td data-column="flight">
                                <input type="number" class="form-control" name="airline_commission" value="{{$booking->pricingDetails->airline_commission}}" placeholder="0.00" step="0.01">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="final_amount" value="{{$booking->pricingDetails->final_amount}}" placeholder="0.00" step="0.01">
                            </td>
                            <td>

                                <select class="form-control" name="pricing[{{ $index }}][merchant]">
                                    <option value="">Select Merchant</option>
                                    <option value="11" {{ $booking->pricingDetails->merchant == '11' ? 'selected' : '' }}>Flydreamz</option>
                                    <option value="12" {{ $booking->pricingDetails->merchant == '12' ? 'selected' : '' }}>CruiseLineService</option>
                                    <option value="13" {{ $booking->pricingDetails->merchant == '13' ? 'selected' : '' }}>FareTickets</option>
                                </select>


                            </td>
                            <td>
                                <input type="number" class="form-control" name="net_mco" value="{{$booking->pricingDetails->net_mco}}" placeholder="0.00" step="0.01">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>

             <!-----------------------------------End Pricing ------------------------------------------>

           <!--------------------------- Booking Remarks --------------------------->
                <div class="tab-pane fade" id="remarks" role="tabpanel" aria-labelledby="remarks-tab">

                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-header border-0 p-0">Booking Remarks</h5>
                        </div>
                        <div class="card-body p-0">
                            <textarea class="form-control mb-4" name="particulars" rows="4" placeholder="Enter remarks here...">{{ old('particulars', '') }}</textarea>
                        </div>
                </div>

                <!--------------------------- End Booking Remarks --------------------------->


        <!--------------------------- feedback --------------------------->
         <!-- Quality Feedback -->
                <div class="tab-pane fade" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-header border-0 p-0">Quality Feedback</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="row">
                                 <div class="col-lg-12 col-md-12 col-12 mt-4">
                                    <textarea class="inputs1"  id="qltynotes" name="qltynotes" spellcheck="false"></textarea> 
                                </div>

                                <div class="col-lg-3 col-md-4 col-12 mt-4">
                                    <label class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check" for="Probing & Understanding">
                                        <input class="form-check-input chkqlty" type="checkbox" value="Probing & Understanding" id="Probing & Understanding" name="quality_feedback[]">
                                        <span class="form-check-label text-dark">Probing & Understanding</span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 mt-4">
                                    <label class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check" for="Dead air/Hold procedure">
                                        <input class="form-check-input chkqlty" type="checkbox" value="Dead air/Hold procedure" id="Dead air/Hold procedure" name="quality_feedback[]">
                                        <span class="form-check-label text-dark">Dead air/Hold procedure</span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 mt-4">
                                    <label class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check" for="Soft Skills">
                                        <input class="form-check-input chkqlty" type="checkbox" value="Soft Skills" id="Soft Skills" name="quality_feedback[]">
                                        <span class="form-check-label text-dark">Soft Skills</span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 mt-4">
                                    <label class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check" for="Active Listening/Interruption">
                                        <input class="form-check-input chkqlty" type="checkbox" value="Active Listening/Interruption" id="Active Listening/Interruption" name="quality_feedback[]">
                                        <span class="form-check-label text-dark">Active Listening/Interruption</span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 mt-4">
                                    <label class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check" for="Call Handling">
                                        <input class="form-check-input chkqlty" type="checkbox" value="Call Handling" id="Call Handling" name="quality_feedback[]">
                                        <span class="form-check-label text-dark">Call Handling</span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 mt-4">
                                    <label class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check" for="Selling Skills">
                                        <input class="form-check-input chkqlty" type="checkbox" value="Selling Skills" id="Selling Skills" name="quality_feedback[]">
                                        <span class="form-check-label text-dark">Selling Skills</span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 mt-4">
                                    <label class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check" for="Cross Selling">
                                        <input class="form-check-input chkqlty" type="checkbox" value="Cross Selling" id="Cross Selling" name="quality_feedback[]">
                                        <span class="form-check-label text-dark">Cross Selling</span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 mt-4">
                                    <label class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check" for="Documentation">
                                        <input class="form-check-input chkqlty" type="checkbox" value="Documentation" id="Documentation" name="quality_feedback[]">
                                        <span class="form-check-label text-dark">Documentation</span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 mt-4">
                                    <label class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check" for="Disposition">
                                        <input class="form-check-input chkqlty" type="checkbox" value="Disposition" id="Disposition" name="quality_feedback[]">
                                        <span class="form-check-label text-dark">Disposition</span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 mt-4">
                                    <label class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check" for="Call Closing">
                                        <input class="form-check-input chkqlty" type="checkbox" value="Call Closing" id="Call Closing" name="quality_feedback[]">
                                        <span class="form-check-label text-dark">Call Closing</span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 mt-4">
                                    <label class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check" for="Fatal - Misrepresentation">
                                        <input class="form-check-input chkqlty" type="checkbox" value="Fatal - Misrepresentation" id="Fatal - Misrepresentation" name="quality_feedback[]">
                                        <span class="form-check-label text-dark">Fatal - Misrepresentation</span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 mt-4">
                                    <label class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check" for="Fatal - Rude/Sarcastic behaviour">
                                        <input class="form-check-input chkqlty" type="checkbox" value="Fatal - Rude/Sarcastic behaviour" id="Fatal - Rude/Sarcastic behaviour" name="quality_feedback[]">
                                        <span class="form-check-label text-dark">Fatal - Rude/Sarcastic behaviour</span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 mt-4">
                                    <label class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check" for="Fatal - Unethical sale">
                                        <input class="form-check-input chkqlty" type="checkbox" value="Fatal - Unethical sale" id="Fatal - Unethical sale" name="quality_feedback[]">
                                        <span class="form-check-label text-dark">Fatal - Unethical sale</span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 mt-4">
                                    <label class="form-check form-check-custom form-check-solid form-check-sm form-check-dark rm-check" for="Paraphrasing">
                                        <input class="form-check-input chkqlty" type="checkbox" value="Paraphrasing" id="Paraphrasing" name="quality_feedback[]">
                                        <span class="form-check-label text-dark">Paraphrasing</span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 mt-4">
                                    <select id="selqlstatus" name="selqlstatus" class="form-select rm-check">
                                        <option value="">Status</option>
                                        <option value="Pending" {{ old('selqlstatus', $booking->quality_status ?? '') === 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Rejected" {{ old('selqlstatus', $booking->quality_status ?? '') === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                        <option value="Approved" {{ old('selqlstatus', $booking->quality_status ?? '') === 'Approved' ? 'selected' : '' }}>Approved</option>
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
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-header border-0 p-0">Screenshots</h5>
                        </div>
                        <div class="card-body p-0">
                            <!-- FilePond input for screenshots -->
                            <input type="file" id="screenshots-upload" name="screenshots[]" multiple>
                            <!-- Hidden input to store existing screenshot IDs (if needed for updates) -->
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


<!-- FilePond styles -->
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet" />

<!-- FilePond scripts -->
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>

@vite('resources/js/booking/edit.js')
@endsection
