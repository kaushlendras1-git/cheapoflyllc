

            <!------------------------ Car Booking Details ------------------------------>
            <div class="tab-pane fade" id="carbooking" role="tabpanel" aria-labelledby="carbooking-tab">
                <div class="card p-4 show-booking-card">
                    <div class="d-flex justify-content-between mb-0">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Car Booking Details</h5>
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