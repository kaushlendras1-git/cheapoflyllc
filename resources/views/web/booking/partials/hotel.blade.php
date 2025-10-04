

            <!------------------------ Hotel Booking Details ------------------------------>

            <div class="tab-pane fade" id="hotelbooking" role="tabpanel" aria-labelledby="hotelbooking-tab">




                <div class="card p-4 show-booking-card">
                    <div class="position-relative checkbox-servis mb-1 mt-1">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hotel_payment_type" id="hotel_full_payment" value="full_payment" {{$booking->hotel_payment_type=="full_payment"?'checked':''}}>
                            <label class="form-check-label" for="fullPayment" style="width: 100px;">Full Payment</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hotel_payment_type" id="hotel_deposit" value="deposit" {{$booking->hotel_payment_type=="deposit"?'checked':''}}>
                            <label class="form-check-label" for="deposit">Deposit</label>
                        </div>
                </div>
                    <div class="d-flex justify-content-between mb-0">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Hotel Booking Details</h5>
                        <button class="btn btn-primary no-btn add-no-btn add-bank" type="button" id="hotel-booking-button">
                            <i class="ri ri-add-circle-fill pointer"></i>
                        </button>
                    </div>
                    <div class="card-body pt-0 ps-0 pe-0">
                        <div class="g-3 align-items-center">
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
                                            <th>Special Notes</th>
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

                                            <td><input type="text" class="form-control flatpickr-hotel-checkin"
                                                    name="hotel[{{$key}}][checkin_date]"
                                                    value="{{$travelHotel->checkin_date?->format('d-m-Y')}}"
                                                    style="width: 114px;"></td>

                                            <td><input type="text" class="form-control flatpickr-hotel-checkout"
                                                    name="hotel[{{$key}}][checkout_date]"
                                                    value="{{$travelHotel->checkout_date?->format('d-m-Y')}}"
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

                                            <td><input type="text" class="form-control" style="width:8rem"
                                                    name="hotel[{{$key}}][special_notes]"
                                                    value="{{$travelHotel->special_notes}}" placeholder="Refundable">
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-outline-danger delete-hotel-btn">
                                                    <i class="ri ri-delete-bin-line"></i>
                                                </button>
                                            </td>

                                            <input type="hidden" name="hotel[{{ $key }}][id]"
                                                    value="{{ $travelHotel->id }}">

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                     <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Hotel Details</h5>
                    <div class="row">
                        <div class="col-md-12 table-responsive details-table-wrappper">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Hotel Description</th>

                                    </tr>
                                </thead>
                                <tr>
                                    <!--ckeditor-->
                                    <td><textarea class="form-control" name="hotel_description" placeholder="Hotel Description" >{{$booking->hotel_description}}</textarea></td>
                                </tr>
                            </table>
                        </div>
                </div>




                    <div style="margin:20px">
                        <input type="file" id="screenshots-upload" name="hotelbookingimage[]" multiple>
                    </div>




        @if(isset($hotel_images) && $hotel_images->count())
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
                            @foreach ($hotel_images as $key => $img)
                                    <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><a href="{{ asset($img->file_path) }}" target="_blank"><img width="50" src="{{ asset($img->file_path) }}" class="img-thumbnail" style="max-height: 100px;" alt="Flight Image"></a></td>
                                    <td>{{ $img->get_agent?->name }}</td>
                                    <td>{{ $img->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger delete-hotel-image-btn" data-id="{{ $img->id }}">
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
            <!------------------------ End Hotel Booking Details ------------------------------>
