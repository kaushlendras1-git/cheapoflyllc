<!------------------------ Cruise Booking Details ------------------------------>
<div class="tab-pane fade" id="cruisebooking" role="tabpanel" aria-labelledby="cruisebooking-tab">
    <div class="card p-4 show-booking-card">
        
        <div class="position-relative checkbox-servis mb-2 mt-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="payment_type" id="fullPayment"
                    value="cruise_full_payment" checked>
                <label class="form-check-label" for="fullPayment" style="width: 100px;">Full Payment</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="payment_type" id="cruise_deposit" value="deposit">
                <label class="form-check-label" for="deposit">Deposit</label>
            </div>
        </div>
        

        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Cruise Booking Details</h5>

        <div class="row">
            <div class="col-md-12 table-responsive details-table-wrappper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Cruise Line</th>
                            <th>Name of the Ship</th>
                            <th>Cruise Trip Name</th>
                            <th>Length</th>
                            <th>Departure Port</th>
                            <th>Arrival Port</th>
                            <th>No. of Rooms</th>
                        </tr>
                    </thead>
                    <tr>
                        <td> <input type="text" class="form-control" placeholder="Cruise Line" name="cruise_line"
                                value="{{$travel_cruise_data?->cruise_line}}"></td>
                        <td><input type="text" class="form-control" placeholder="Name of the Ship"
                                placeholder="Name of the Ship" name="ship_name"
                                value="{{$travel_cruise_data?->ship_name}}">
                        </td>
                        <td><input type="text" class="form-control" placeholder="Cruise Trip Name" name="cruise_name"
                                value="{{$travel_cruise_data?->cruise_name}}"></td>
                        <td> <input type="text" class="form-control" placeholder="Length" placeholder="length"
                                name="length" value="{{$travel_cruise_data?->length}}"></td>
                        <td><input type="text" class="form-control" placeholder="Departure Port" name="departure_port"
                                value="{{$travel_cruise_data?->departure_port}}"></td>
                        <td> <input type="text" class="form-control" placeholder="Arival Port" name="arrival_port"
                                value="{{$travel_cruise_data?->arrival_port}}"></td>
                        <td><input type="text" class="form-control" placeholder="Stateroom" name="stateroom"
                                value="{{$travel_cruise_data?->stateroom}}"></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="mb-0 d-flex align-items-center justify-content-between">
            <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Cruise Booking Itinerary </h5>
            <div class="d-flex gap-2">
                <button class="btn btn-primary no-btn add-no-btn add-bank" type="button" id="cruise-booking-button">
                    <i class="ri ri-add-circle-fill pointer"></i>
                </button>
            </div>

        </div>
        <div class="card-body pt-0 px-0">
            <div class="g-3 align-items-center">
                <div class="col-md-12 table-responsive details-table-wrappper">
                    <!-- Cruise Table -->
                    <table id="cruiseTable" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th> Port</th>
                                <th>Depart Time<br>Hrs:MM</th>

                                <th>Arrival Time<br>Hrs:MM</th>
                                <!-- <th>Remarks</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="cruiseForms">
                            @foreach($booking->travelCruise as $key=>$travelCruise)
                            <tr class="cruise-row" data-index="{{$key}}">
                                <td><span class="cruise-title">{{$key+1}}</span></td>

                                <td><input style="width: 125px;" type="date" class="form-control"
                                        name="cruise[{{$key}}][departure_date]"
                                        value="{{$travelCruise->departure_date?->format('Y-m-d')}}">
                                </td>
                                <td><input type="text" class="form-control" style="width:39.5rem"
                                        name="cruise[{{$key}}][departure_port]"
                                        value="{{$travelCruise->departure_port}}" placeholder="Port"></td>

                                <td><input type="text" class="form-control time_24_hrs" style="width:50px"
                                        name="cruise[{{$key}}][departure_hrs]" value="{{$travelCruise->departure_hrs}}"
                                        placeholder="Hrs" min="0" max="23"></td>



                                <td><input type="text" class="form-control time_24_hrs" style="width:50px;"
                                        name="cruise[{{$key}}][arrival_hrs]" value="{{$travelCruise->arrival_hrs}}"
                                        placeholder="Hrs" min="0" max="23"></td>



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

    <!------------ Start Addons ------------------------------>        
    <div class="mb-0 d-flex align-items-center justify-content-between">
    <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Cruise Addons</h5>
    <div class="d-flex gap-2">

        <button class="btn btn-primary no-btn add-no-btn add-bank" type="button" id="cruise-addon-button">
                    <i class="ri ri-add-circle-fill pointer"></i>
                </button>



    </div>
</div>

<div class="row">
    <div class="col-md-12 table-responsive details-table-wrappper">
        <table class="table">
            <thead>
                <tr>
                    <th>Services</th>
                    <th>Name of Service</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="cruise-addon-container">
                @foreach($travel_cruise_addon as $key => $addon)
                    <tr class="cruise-addon-row">
                        <td style="width: 200px">
                            <select class="form-control" name="cruiseaddon[{{ $key }}][services]">
                                <option value="">Select</option>
                                <option value="Excursions" {{ $addon->services == 'Excursions' ? 'selected' : '' }}>Excursions</option>
                                <option value="WiFi Packages" {{ $addon->services == 'WiFi Packages' ? 'selected' : '' }}>WiFi Packages</option>
                                <!-- Add all other options -->
                            </select>
                        </td>
                        <td style="width:400px">
                            <textarea class="form-control ckeditor" name="cruiseaddon[{{ $key }}][service_name]" rows="6">{{ $addon->service_name }}</textarea>
                        </td>
                        <td>
                            <div class="mb-2">
                                @foreach(json_decode($addon->image, true) ?? [] as $img)
                                    <img src="{{ asset('storage/' . $img) }}" alt="Cruise Addon Image" width="80" height="80">
                                @endforeach
                            </div>
                            <input type="file" multiple class="form-control" name="cruiseaddon[{{ $key }}][image][]" />
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-danger delete-addon-cruise-btn">
                                <i class="ri ri-delete-bin-line"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
             </tbody>
          </table>
    </div>
</div>

<input type="hidden" id="cruise-addon-index" value="{{ isset($travel_cruise_addon) ? $travel_cruise_addon->count() : 1 }}">
    <!------------ End Addons ------------------------------>        




        <div style="margin-top:20px">
            <input type="file" id="screenshots-upload" name="cruisebookingimage[]" multiple>
        </div>

        <div class="" style="margin-top:20px">
            @if($cruise_images)
            <table class="table table-bordered table-striped crm-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image Preview</th>
                        <th>Agent Name</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cruise_images as $key => $img)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="{{ asset($img->file_path) }}" target="_blank"><img width="50"
                                    src="{{ asset($img->file_path) }}" class="img-thumbnail" style="max-height: 100px;"
                                    alt="Flight Image"></a></td>
                        <td>{{ $img->get_agent?->name }}</td>
                        <td>{{ $img->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No images found.</p>
            @endif
        </div>
    </div>







</div>
<!------------------------ End Cruise Booking Details ------------------------------>
