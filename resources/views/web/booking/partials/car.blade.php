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





                <div class="card p-4 show-booking-card">
                    <div class=" position-relative checkbox-servis mb-1 mt-1">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input payment_type" type="radio" name="car_payment_type" id="car_full_payment" value="full_payment" {{$booking->car_payment_type=="full_payment"?'checked':''}}>
                            <label class="form-check-label" for="fullPayment" style="width: 100px;">Full Payment</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input payment_type" type="radio" name="car_payment_type" id="car_deposit" value="deposit" {{$booking->car_payment_type=="deposit"?'checked':''}}>
                            <label class="form-check-label" for="deposit">Deposit</label>
                        </div>
                </div>
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
                                                    placeholder="Car Rental Provider" {{ $disabled }} ></td>
                                            <td><input type="text" class="form-control" style="width:7.5rem"
                                                    name="car[{{$key}}][car_type]" value="{{$travelCar->car_type}}"
                                                    placeholder="Car Type" {{ $disabled }} ></td>
                                            <td><input type="text" class="form-control" style="width:9rem"
                                                    name="car[{{$key}}][pickup_location]"
                                                    value="{{$travelCar->pickup_location}}"
                                                    placeholder="Pick-up Location" {{ $disabled }} ></td>
                                            <td><input type="text" class="form-control" style="width:10rem"
                                                    name="car[{{$key}}][dropoff_location]"
                                                    value="{{$travelCar->dropoff_location}}"
                                                    placeholder="Drop-off Location" {{ $disabled }} ></td>

                                            <td><input style="width: 110px;" type="text" class="form-control flatpickr-hotel-checkin"
                                                    name="car[{{$key}}][pickup_date]"
                                                    value="{{$travelCar->pickup_date?->format('d-m-Y')}}" {{ $disabled }} ></td>

                                            <td style="position: relative;">
                                                <input type="text" class="form-control time-12hr" style="width: 105px;" name="car[{{$key}}][pickup_time]" value="{{ $travelCar->pickup_time ? \Carbon\Carbon::parse($travelCar->pickup_time)?->format('H:i') : '' }}" placeholder="HH:MM" maxlength="5" title="Enter time in 12-hour (3:30 PM) or 24-hour (15:30) format" {{ $disabled }} >
                                                <span class="time-format-indicator" style="display: none;"></span></td>

                                                <td><input style="width: 105px;" type="text" class="form-control flatpickr-hotel-checkin"
                                                    name="car[{{$key}}][dropoff_date]"
                                                    value="{{$travelCar->dropoff_date?->format('d-m-Y')}}" {{ $disabled }} ></td>

                                            <td style="position: relative;">
                                                <input type="text" class="form-control time-12hr" style="width: 100px;" name="car[{{$key}}][dropoff_time]" value="{{ $travelCar->dropoff_time ? \Carbon\Carbon::parse($travelCar->dropoff_time)?->format('H:i') : '' }}" placeholder="HH:MM" maxlength="5" title="Enter time in 12-hour (3:30 PM) or 24-hour (15:30) format" {{ $disabled }} >
                                                <span class="time-format-indicator" style="display: none;"></span></td>
                                            
                                                <td><input type="text" class="form-control" style="width:12rem"
                                                    name="car[{{$key}}][confirmation_number]"
                                                    placeholder="Confirmation Number"
                                                    value="{{$travelCar->confirmation_number}}" {{ $disabled }} ></td>

                                                      <input type="hidden" name="car[{{ $key }}][id]"
                                                    value="{{ $travelCar->id }}">


                                            <td>
                                                <button type="button" class="btn btn-outline-danger delete-car-btn" {{ $disabled }} >
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

                                </tr>
                            </thead>
                            <tr>
                                @if($disabled)
                                        <td>
                                            <div class="form-control" style="background:#f8f9fa;">{!! $booking->car_description !!}</div>
                                        </td>
                                    @else
                                        <td>
                                            <textarea class="form-control" name="car_description" placeholder="Car Description">{{ $booking->car_description }}</textarea>
                                        </td>
                                    @endif
                            </tr>
                        </table>
                    </div>
             </div>


              <div style="margin-top:20px">
                        <input type="file" id="screenshots-upload" name="carbookingimage[]" multiple>
                    </div>

                @if(isset($car_images) && $car_images->count())

                    <div class="" style="margin-top:20px">
                            <table class="table table-bordered table-striped crm-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image Preview</th>
                                        <th>Agent Name</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($car_images as $key => $img)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><a href="{{ asset($img->file_path) }}" target="_blank"><img width="50" src="{{ asset($img->file_path) }}" class="img-thumbnail" style="max-height: 100px;" alt="Flight Image"></a></td>
                                            <td>{{ $img->get_agent?->name }}</td>
                                            <td>{{ $img->created_at }}</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-danger delete-car-image-btn" data-id="{{ $img->id }}">
                                                    <i class="ri ri-delete-bin-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                @endif
                </div>
            </div>
            <!------------------------ End Car Booking Details ------------------------------>
