<!------------------------ Flight Booking Details ------------------------------>

<div class="tab-pane fade" id="flightbooking" role="tabpanel" aria-labelledby="flightbooking-tab">
    <div class="card p-4 show-booking-card">
        <div class="d-flex justify-content-between align-items-center mb-0">
            <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Flight Booking Details</h5>
            <button class="btn btn-primary no-btn add-no-btn add-bank" type="button" id="flight-booking-button">
                <i class="ri ri-add-circle-fill pointer"></i>
            </button>
        </div>
        <div class="card-body p-0">
            <div class="row g-3 align-items-center">
                <div class="col-md-12">
                    <div class="table-responsive details-table-wrappper">
                        <table id="flightTable" class="table">
                            <thead>
                                <tr>
                                    <th colspan="9" style="text-align: center;"><i class="ri ri-flight-takeoff-line"
                                            title="Flight" style="color: #1e90ff; font-size: 18px;"></i> Departure</th>
                                    <th colspan="8" style="text-align: center;"><i class="ri ri-flight-land-line"
                                            title="Flight" style="color: #1e90ff; font-size: 18px;"></i> Arrival</th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Direction</th>
                                    <th>Date</th>
                                    <th title="Airline (Code)">AL<br>(Code)</th>
                                    <th>Flight<br> No</th>
                                    <th>Cabin</th>
                                    <th title="Class of Service">Operating<br>Airline</th>
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

                                @if ($booking->travelFlight->isNotEmpty())
                                    @foreach ($booking->travelFlight as $index => $flight)
                                        <input type="hidden" name="flight_files[{{ $index }}]"
                                            data-files='@json($flight->files)'>
                                        <tr class="flight-row" data-index="{{ $index }}">
                                            <td><span class="flight-title">{{ $index + 1 }}</span></td>

                                            <td>
                                                <select class="form-control"
                                                    name="flight[{{ $index }}][direction]" style="width: 80px;">
                                                    <option value="">Select </option>
                                                    <option value="Inbound"
                                                        {{ $flight->direction == 'Inbound' ? 'selected' : '' }}>
                                                        Inbound</option>
                                                    <option value="Outbound"
                                                        {{ $flight->direction == 'Outbound' ? 'selected' : '' }}>
                                                        Outbound</option>
                                                </select>
                                            </td>


                                            <td><input type="text" style="width: 6.7rem;" class="form-control flatpickr-hotel-checkin"
                                                    name="flight[{{ $index }}][departure_date]"
                                                    value="{{ $flight->departure_date?->format('d-m-Y') }}"></td>

                                            <td>
                                                <input type="text" class="form-control airline_code_input"
                                                    style="width: 40px;"
                                                    name="flight[{{ $index }}][airline_code]"
                                                    value="{{ old("flight.$index.airlines_code", $flight->airline_code) }}"
                                                    placeholder="Airlines (Code)" autocomplete="off">

                                                <div class="flight-code-suggestions-list"
                                                    style="position:absolute; background:#fff; border:1px solid #ccc; display:none; z-index:1000;">
                                                </div>
                                            </td>

                                            <td><input type="text" class="form-control" style="width: 3.5rem;"
                                                    name="flight[{{ $index }}][flight_number]"
                                                    value="{{ old("flight.$index.flight_no", $flight->flight_number) }}"
                                                    placeholder="Flight No">
                                            </td>


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
                                                    <option value="First Class"
                                                        {{ old("flight.$index.cabin", $flight->cabin) == 'First Class' ? 'selected' : '' }}>
                                                        First Class</option>

                                                </select>
                                            </td>

                                            <td><input type="text" class="form-control operating_service_search"
                                                    name="flight[{{ $index }}][class_of_service]"
                                                    value="{{ old("flight.$index.class_of_service", $flight->class_of_service) }}"
                                                    placeholder="Class of Service" style="width: 37px;" min="0"
                                                   autocomplete="off"
                                                    max="1">
                                                <div class="operating-flight-suggestions-list"
                                                    style="position:absolute; background:#fff; border:1px solid #ccc; display:none; z-index:1000;">
                                                </div>
                                            </td>


                                            <td>
                                                <input type="text" class="form-control departure-airport"
                                                    style="width: 10rem;"
                                                    name="flight[{{ $index }}][departure_airport]"
                                                    value="{{ old("flight.$index.departure_airport", $flight->departure_airport) }}"
                                                    placeholder="Departure Airport"
                                                   autocomplete="off"
                                                >
                                                <div class="flight-suggestions-list"
                                                    style="position:absolute; background:#fff; border:1px solid #ccc; display:none; z-index:1000;">
                                                </div>
                                            </td>


                                            <td style="position: relative;">
                                                <input type="text" class="form-control time-12hr" style="width: 86px;" name="flight[{{ $index }}][departure_hours]" placeholder="HH:MM" maxlength="5" value="{{ old('flight.'.$index.'.departure_hours', $flight->departure_hours) }}" title="Enter time in 12-hour (3:30 PM) or 24-hour (15:30) format">
                                                <span class="time-format-indicator" style="display: none;"></span>
                                            </td>

                                            <!-- <td><input type="text" class="form-control" style="width: 36px;"
                                                        name="flight[{{ $index }}][departure_minutes]"
                                                        value="{{ old("flight.$index.departure_mm", $flight->departure_minutes) }}"
                                                        placeholder="mm" min="0" max="2"></td> -->

                                            <td><input type="text" class="form-control arrival-airport"
                                                    name="flight[{{ $index }}][arrival_airport]"
                                                    style="width: 90px;"
                                                    value="{{ old("flight.$index.arrival_airport", $flight->arrival_airport) }}"
                                                    placeholder="Arrival Airport"
                                                   autocomplete="off"
                                                />
                                                <div class="flight-suggestions-list"
                                                    style="position:absolute; background:#fff; border:1px solid #ccc; display:none; z-index:1000;">
                                                </div>
                                            </td>


                                            <td style="position: relative;">
                                                <input type="text" class="form-control time-12hr" style="width: 86px;" name="flight[{{ $index }}][arrival_hours]" placeholder="HH:MM" maxlength="5" value="{{ old('flight.'.$index.'.arrival_hours', $flight->arrival_hours) }}" title="Enter time in 12-hour (3:30 PM) or 24-hour (15:30) format">
                                                <span class="time-format-indicator" style="display: none;"></span>
                                            </td>

                                            <!-- <td><input type="text" class="form-control" style="width: 36px;"
                                                        name="flight[{{ $index }}][arrival_minutes]"
                                                        value="{{ old("flight.$index.arrival_mm", $flight->arrival_minutes) }}"
                                                        placeholder="mm" min="0" max="2"></td> -->

                                            <td style="position: relative;"><input type="text" class="form-control time-12hr" style="width: 4.5rem;"
                                                    name="flight[{{ $index }}][duration]"
                                                    value="{{ old("flight.$index.duration", $flight->duration) }}"
                                                    placeholder="Duration" title="Enter time in 12-hour (3:30 PM) or 24-hour (15:30) format">
                                                <!-- <span class="time-format-indicator" style="display: none;"></span> -->
                                            </td>

                                            <td style="position: relative;"><input type="text" class="form-control time-12hr" style="width: 4.5rem;"
                                                    name="flight[{{ $index }}][transit]"
                                                    value="{{ old("flight.$index.transit", $flight->transit) }}"
                                                    placeholder="Transit" title="Enter time in 12-hour (3:30 PM) or 24-hour (15:30) format">
                                                <!-- <span class="time-format-indicator" style="display: none;"></span> -->
                                            </td>

                                            <td><input type="text" class="form-control flatpickr-hotel-checkin" style="width: 105px;"
                                                    name="flight[{{ $index }}][arrival_date]"
                                                    value="{{ $flight->arrival_date?->format('d-m-Y') }}"></td>
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
            <input type="file" id="flight-screenshots-upload" name="flightbookingimage[]" multiple>
        </div>



    @if(isset($flight_images) && $flight_images->count())
        <div class="" style="margin-top:20px">

                <table class="table table-bordered table-striped crm-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image Preview</th>
                            <th>Agent Name</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flight_images as $key => $img)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="{{ asset($img->file_path) }}" target="_blank"><img width="50"
                                            src="{{ asset($img->file_path) }}" class="img-thumbnail"
                                            style="max-height: 100px;" alt="Flight Image"></a></td>
                                <td>{{ $img->get_agent?->name }}</td>
                                <td>{{ $img->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm delete-flight-image" data-id="{{ $img->id }}">
                                        <i class="ri ri-delete-bin-line"></i>
                                    </button>
                                </td>                            </tr>
                        @endforeach
                    </tbody>
                </table>

        </div>
    @endif

    </div>
</div>



<!------------------------ End Flight Booking Details ------------------------------>
