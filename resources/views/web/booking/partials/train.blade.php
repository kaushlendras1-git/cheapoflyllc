<div class="tab-pane fade" id="trainbooking" role="tabpanel" aria-labelledby="trainbooking-tab">
                <div class="card p-4 show-booking-card">
                    <div class="d-flex justify-content-between mb-0">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Train Booking Details</h5>
                        <div>
                            <button class="btn btn-primary no-btn add-no-btn add-bank" type="button" id="train-booking-button">
                                <i class="ri ri-add-circle-fill pointer"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body pt-0 ps-0 pe-0">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12 table-responsive details-table-wrappper">
                                <!-- Car Table -->
                                <table id="carTable" class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="5">Trip to Sherevport</th>
                                            <th colspan="3">Departure </th>
                                            <th></th>
                                            <th colspan="4">Arrival </th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Direction</th>
                                            <th>Date</th>
                                            <th>Train No</th>
                                            <th>Cabin</th>
                                            <th>Departure station</th>
                                            <th>Hrs/MM</th>
                                            <th>Arrival station</th>
                                            <th>Hrs/MM</th>
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
                                            <td><input type="text" class="form-control" style="width: 9rem;"
                                                    name="train[{{$key}}][departure_station]"
                                                    value="{{$trainBookingDetails->departure_station}}"
                                                    placeholder="Departure Station"></td>

                                            <td><input type="time" class="form-control" style="width: 80px;"
                                                    name="train[{{$key}}][departure_hours]"
                                                    value="{{$trainBookingDetails->departure_hours}}" placeholder="Hrs"
                                                    min="0" max="23"></td>
                                           
                                            <td><input type="text" class="form-control" style="width: 9rem;"
                                                    name="train[{{$key}}][arrival_station]"
                                                    value="{{$trainBookingDetails->arrival_station}}"
                                                    placeholder="Arrival Station"></td>
                                                    
                                            <td><input type="time" class="form-control" style="width: 80px;"
                                                    name="train[{{$key}}][arrival_hours]"
                                                    value="{{$trainBookingDetails->arrival_hours}}" placeholder="Hrs"
                                                    min="0" max="23"></td>
                                           
                                            <td><input type="text" class="form-control" style="width: 5.5rem;"
                                                    name="train[{{$key}}][duration]"
                                                    value="{{$trainBookingDetails->duration}}" placeholder="Duration">
                                            </td>
                                            <td><input type="text" class="form-control" style="width: 5.5rem;"
                                                    name="train[{{$key}}][transit]"
                                                    value="{{$trainBookingDetails->transit}}" placeholder="Transit">
                                            </td>
                                            <td><input type="date" class="form-control" style="width: 105px;"
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

                    <div class="" style="margin-top:20px">
                        @if($train_images)
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
                                    @foreach ($train_images as $key => $img)
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