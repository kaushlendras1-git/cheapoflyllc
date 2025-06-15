@extends('web.layouts.main')
@section('content')


            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row gy-6">
                <div class="d-flex justify-content-between align-items-center flex-wrap p-0">
                  <div class="d-flex align-items-center flex-wrap gap-2">
                    <strong>Ticket Information</strong>
                    <span>Created by Testagent on 4/7/2025 12:40:28 PM</span>
                  </div>
                  <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm rounded-pill">
                      Copy Authorization Link
                    </button>
                    <button class="btn btn-outline-secondary btn-sm rounded-pill">
                      Mail History
                    </button>
                  </div>
                </div>
                
                <!-- Top Bar -->
                <div class="card p-3 mt-2">
                  <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                      <div class="form-check form-check-inline">
                        <input name="booking-type" class="form-check-input" type="radio" id="booking-flight" checked>
                        <label class="form-check-label" for="booking-flight">Flight</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="booking-type" class="form-check-input" type="radio" id="booking-hotel">
                        <label class="form-check-label" for="booking-hotel">Hotel</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="booking-type" class="form-check-input" type="radio" id="booking-cruise">
                        <label class="form-check-label" for="booking-cruise">Cruise</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="booking-type" class="form-check-input" type="radio" id="booking-car">
                        <label class="form-check-label" for="booking-car">Car</label>
                      </div>
                    </div>
              
                    <div class="d-flex gap-2">
                      <button class="btn btn-sm btn-primary text-center">
                        <i class="icon-base ri ri-save-2-fill"></i>
                      </button>
                      <button class="btn btn-sm btn-dark text-center">
                        <i class="icon-base ri ri-mail-send-fill"></i>
                      </button>
                    </div>
                  </div>
                </div>
              
                <!-- Booking Form Card -->
                <div class="card p-4 mb-4">
                  <div class="row mb-3">
                    <div class="col-md-3">
                      <label class="form-label">PNR <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" value="AIR07043712227">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Hotel Ref</label>
                      <input type="text" class="form-control" value="xxxxxxxxxxxxxxxxur i">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Cruise Ref</label>
                      <input type="text" class="form-control" value="xxxxxxxxxxxxxxxxxolor">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" value="Eric Banks">
                    </div>
                  </div>
              
                  <div class="row mb-3">
                    <div class="col-md-3">
                      <label class="form-label">Calling Phone No. <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" value="xxxxxxx9136">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Email <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" value="huf*****@mailinator.com">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Query Type</label>
                      <input type="text" class="form-control" value="New Booking">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Company ID</label>
                      <input type="text" class="form-control" value="cruiseroyals" readonly>
                    </div>
                  </div>
              
                  <div class="row mb-3">
                    <div class="col-md-3">
                      <label class="form-label">Booking Status</label>
                      <input type="text" class="form-control" value="under process">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Payment Status</label>
                      <input type="text" class="form-control" value="pending">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Reservation Source</label>
                      <input type="text" class="form-control" value="ET VOLUPTATEM PROVI" readonly>
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Descriptor</label>
                      <input type="text" class="form-control" value="Eu Amet Qui Facilis">
                    </div>
                  </div>
                </div>
              
                <!-- Tab buttons -->
                <div class="d-flex flex-wrap gap-2 my-5 p-0">
                  <a href="#" class="btn btn-light border active rounded-pill">Sector Details</a>
                  <a href="#" class="btn btn-light border rounded-pill">Passenger Details</a>
                  <a href="#" class="btn btn-light border rounded-pill">Pricing Details</a>
                  <a href="#" class="btn btn-light border rounded-pill">Billing Details</a>
                  <a href="#" class="btn btn-light border rounded-pill">Booking Remarks</a>
                  <a href="#" class="btn btn-light border rounded-pill">Quality Feedback</a>
                  <a href="#" class="btn btn-light border rounded-pill">Screenshots</a>
                </div>

                <!-- Tab Content -->
                <div class="card p-4">
                    <h5 class="card-header px-0">Pricing Details</h5>
                  
                    <div class="card-body p-0">
                      <div class="row g-3">
                  
                        <div class="col-md-3">
                          <label class="form-label">Hotel Cost ($)<span class="text-danger">*</span></label>
                          <input type="text" class="form-control" value="0.00" placeholder="0.00">
                        </div>
                  
                        <div class="col-md-3">
                          <label class="form-label">Cruise Cost ($)<span class="text-danger">*</span></label>
                          <input type="text" class="form-control" value="0.00" placeholder="0.00">
                        </div>
                  
                        <div class="col-md-3">
                          <label class="form-label">Total Amount ($)<span class="text-danger">*</span></label>
                          <input type="text" class="form-control" value="0.00" placeholder="0.00">
                        </div>
                  
                        <div class="col-md-3">
                          <label class="form-label">Advisor MCO ($)</label>
                          <input type="text" class="form-control" value="12.00" placeholder="0.00">
                        </div>
                  
                        <div class="col-md-3">
                          <label class="form-label">Airline Commission ($)</label>
                          <input type="text" class="form-control" value="0.00" placeholder="0.00">
                        </div>
                  
                        <div class="col-md-3">
                          <label class="form-label">Final Amount ($)</label>
                          <input type="text" class="form-control" value="12.00" placeholder="0.00">
                        </div>
                  
                        <div class="col-md-3">
                          <label class="form-label">Merchant</label>
                          <input type="text" class="form-control" value="Cheapofly" placeholder="Merchant Name">
                        </div>
                  
                        <div class="col-md-3">
                          <label class="form-label">Net MCO ($)</label>
                          <input type="text" class="form-control" value="0.20" placeholder="0.00">
                        </div>
                  
                      </div>
                    </div>
                    <!-- Nav Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-light px-4">Prev</button>
                        <button class="btn btn-primary px-4">Next</button>
                    </div>
                  </div>
                                
              </div>              
            </div>
            <!--/ Content -->

@endsection          