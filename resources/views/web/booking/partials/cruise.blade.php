
            <!------------------------ Cruise Booking Details ------------------------------>
            <div class="tab-pane fade" id="cruisebooking" role="tabpanel" aria-labelledby="cruisebooking-tab">
                
              <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Cruise Booking Details</h5>

              				

  <!-- <div class="row g-2">
    <div class="col-md">
      <input type="text" class="form-control" placeholder="Cruise Trip Name">
    </div>

     <div class="col-md">
      <input type="text" class="form-control" placeholder="Name of the Ship	">
    </div>


    <div class="col-md">
      <input type="text" class="form-control" placeholder="Lenght">
    </div>
    <div class="col-md">
      <input type="text" class="form-control" placeholder="Departure Port">
    </div>
    <div class="col-md">
      <input type="text" class="form-control" placeholder="Arival Port">
    </div>

     <div class="col-md">
      <input type="text" class="form-control" placeholder=" Cruise Line">
    </div>

     <div class="col-md">
      <input type="text" class="form-control" placeholder="Category">
    </div>

     <div class="col-md">
      <input type="text" class="form-control" placeholder="Stateroom">
    </div> -->

    

             

            
            
            
                <div class="card p-4 show-booking-card">
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
                                            <th>Type</th>
                                         
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

                                            <td>
                                                
                                          
                                            
  <!-- <input class="form-check-input" type="radio" name="cruise_type" id="dayAtSea" value="day_at_sea">
  <label class="form-check-label" for="dayAtSea">Day at Sea</label>

  
  <input class="form-check-input" type="radio" name="cruise_type" id="trip" value="trip">
  <label class="form-check-label" for="trip">Trip</label> -->

  
                                            </td>
                                            
                                            
                                            <td><input type="text" class="form-control" style="width:7.5rem"
                                                    name="cruise[{{$key}}][departure_port]"
                                                    value="{{$travelCruise->departure_port}}"
                                                    placeholder="Departure Port"></td>
                                            <td><input style="width: 105px;" type="date" class="form-control"
                                                    name="cruise[{{$key}}][departure_date]"
                                                    value="{{$travelCruise->departure_date?->format('Y-m-d')}}">
                                            </td>
                                            <td><input type="text" class="form-control time_24_hrs" style="width:50px"
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
                                            <td><input type="text" class="form-control time_24_hrs" style="width:50px;"
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
            <!------------------------ End Cruise Booking Details ------------------------------>
