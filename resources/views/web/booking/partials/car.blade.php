<style>
    /* Hide only the input with class 'custom-file-input' */
    .custom-file-input {
        display: none;
    }

    /* Style the specific label linked to that input as a plus button */
    .custom-file-label {
        display: inline-block;
        cursor: pointer;
        width: 25px;
        height: 25px;
        border: 2px solid #333;
        border-radius: 8px;
        font-size: 32px;
        line-height: 36px;
        text-align: center;
        font-weight: bold;
        user-select: none;
    }
</style>

            <!------------------------ Car Booking Details ------------------------------>
            <div class="tab-pane fade" id="carbooking" role="tabpanel" aria-labelledby="carbooking-tab">


                <div class=" position-relative checkbox-servis mb-1 mt-1">    
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment_type" id="car_full_payment" value="full_payment" checked>
                            <label class="form-check-label" for="fullPayment" style="width: 100px;">Full Payment</label>
                        </div>
                    
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="payment_type" id="car_deposit" value="deposit">
                            <label class="form-check-label" for="deposit">Deposit</label>
                        </div>
                </div>


                <div class="card p-4 show-booking-card">
                    <div class="d-flex justify-content-between mb-0">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">
                            Car Booking Itinerary
                           
                        </h5>
                        <div>
                            <button class="btn btn-primary no-btn add-no-btn add-bank" type="button" id="car-booking-button">
                                <i class="ri ri-add-circle-fill pointer"></i>
                            </button>
                        </div>

                    </div>

                    
                    <div class="card-body pt-0 ps-0 pe-0">
                        <div class="g-3 align-items-center">
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

                                            <td><input type="text" pattern="^([01]\d|2[0-3]):([0-5]\d)$" placeholder="HH:mm (24-hour)" title="Enter time as HH:mm in 24-hour format (00:00 to 23:59)" class="form-control time_24_hrs" style="width: 105px;"
                                                    name="car[{{$key}}][pickup_time]"
                                                    value="{{ $travelCar->pickup_time ? \Carbon\Carbon::parse($travelCar->pickup_time)?->format('H:i') : '' }}">
                                            </td>
                                            <td><input style="width: 105px;" type="date" class="form-control"
                                                    name="car[{{$key}}][dropoff_date]"
                                                    value="{{$travelCar->dropoff_date?->format('Y-m-d')}}"></td>
                                            <td><input type="text" pattern="^([01]\d|2[0-3]):([0-5]\d)$" placeholder="HH:mm (24-hour)" title="Enter time as HH:mm in 24-hour format (00:00 to 23:59)" class="form-control time_24_hrs" style="width: 100px;"
                                                    name="car[{{$key}}][dropoff_time]"
                                                    value="{{ $travelCar->dropoff_time ? \Carbon\Carbon::parse($travelCar->dropoff_time)?->format('H:i') : '' }}">
                                            </td>
                                            <td><input type="text" class="form-control" style="width:12rem"
                                                    name="car[{{$key}}][confirmation_number]"
                                                    placeholder="Confirmation Number"
                                                    value="{{$travelCar->confirmation_number}}"></td>

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

                <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Car Booking Details</h5>
                <div class="row">
                    <div class="col-md-12 table-responsive details-table-wrappper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Car Description</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tr>
                                <td><textarea class="form-control" name="car_description" placeholder="Car Description" cols="30" rows="6">{{$booking->car_description}}</textarea></td>
                                <td>  <input id="fileInput" type="file" multiple class="custom-file-input destroy_filepond" accept="image/*" name="car_main_image[]" />
                            <label for="fileInput" class="custom-file-label" style="border:none">
                                <i style="font-size: 20px;color:#055bdb" class="ri ri-add-circle-fill pointer"></i>
                            </label>
                            <div id="imagePreviewContainer" class="mb-3" style="margin-top: 10px; display:flex; gap: 10px; flex-wrap: wrap;"></div></td>
                            </tr>
                        </table>
                    </div>             				
             </div>


                  
                    <div style="margin-top:20px">
                        <input type="file" id="screenshots-upload" name="carbookingimage[]" multiple>
                    </div>

                    <div class="" style="margin-top:20px">
                        @if($car_images)
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
                                    @foreach ($car_images as $key => $img)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><a href="{{ asset($img->file_path) }}" target="_blank"><img width="50" src="{{ asset($img->file_path) }}" class="img-thumbnail" style="max-height: 100px;" alt="Flight Image"></a></td>
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
            <!------------------------ End Car Booking Details ------------------------------>
