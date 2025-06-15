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
                          <input name="booking-type" class="form-check-input" type="checkbox" id="booking-flight" checked>
                          <label class="form-check-label" for="booking-flight">Flight</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input name="booking-type" class="form-check-input" type="checkbox" id="booking-hotel">
                          <label class="form-check-label" for="booking-hotel">Hotel</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input name="booking-type" class="form-check-input" type="checkbox" id="booking-cruise">
                          <label class="form-check-label" for="booking-cruise">Cruise</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input name="booking-type" class="form-check-input" type="checkbox" id="booking-car">
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
                        <input type="text" class="form-control" name="pnr" value="AIR07043712227">
                      </div>
                      <div class="col-md-3">
                        <label class="form-label">Hotel Ref</label>
                        <input type="text" class="form-control" name="hotel_ref" value="xxxxxxxxxxxxxxxxur i">
                      </div>
                      <div class="col-md-3">
                        <label class="form-label">Cruise Ref</label>
                        <input type="text" class="form-control" name="cruise_ref" value="xxxxxxxxxxxxxxxxxolor">
                      </div>
                      <div class="col-md-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="Eric Banks">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="form-label">Calling Phone No. <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" value="xxxxxxx9136">
                      </div>
                      <div class="col-md-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" value="huf*****@mailinator.com">
                      </div>
                      <div class="col-md-3">
                        <label class="form-label">Query Type</label>
                        <input type="text" class="form-control" name="query_type" value="New Booking">
                      </div>
                      <div class="col-md-3">
                        <label class="form-label">Company Organisation</label>
                        <input type="text" class="form-control" name="selected_company" value="cruiseroyals" readonly>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label class="form-label">Booking Status</label>
                        <input type="text" class="form-control" name="booking_status" value="under process">
                      </div>
                      <div class="col-md-3">
                        <label class="form-label">Payment Status</label>
                        <input type="text" class="form-control" name="payment_status" value="pending">
                      </div>
                      <div class="col-md-3">
                        <label class="form-label">Reservation Source</label>
                        <input type="text" class="form-control" name="reservation_source" value="ET VOLUPTATEM PROVI" readonly>
                      </div>
                      <div class="col-md-3">
                        <label class="form-label">Descriptor</label>
                        <input type="text" class="form-control" name="descriptor" value="Eu Amet Qui Facilis">
                      </div>
                      <div class="col-md-3">
                        <label class="form-label">Amadeaus/Sabre PNR (When we select HK )</label>
                        <input type="text" class="form-control" name="descriptor" value="Eu Amet Qui Facilis">
                      </div>
                    </div>
                  </div>
                <!-- End Booking Form Card -->


                


                <!-- Tab Navigation -->
                <ul class="nav nav-tabs my-5" id="bookingTabs" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="sector-tab" data-bs-toggle="tab" href="#sector" role="tab" aria-controls="sector" aria-selected="true">Sector Details</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="passenger-tab" data-bs-toggle="tab" href="#passenger" role="tab" aria-controls="passenger" aria-selected="false">Passenger Details</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="billing-tab" data-bs-toggle="tab" href="#billing" role="tab" aria-controls="billing" aria-selected="false">Billing Details</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pricing-tab" data-bs-toggle="tab" href="#pricing" role="tab" aria-controls="pricing" aria-selected="false">Pricing Details</a>
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
                  <!-- Sector Details -->
                  <div class="tab-pane fade show active" id="sector" role="tabpanel" aria-labelledby="sector-tab">
                    <div class="card p-4">
                      <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-header border-0 p-0">Sector Details</h5>
                        <button type="button" class="btn btn-outline-secondary btn-sm">Delete Image</button>
                      </div>

                      <div class="card-body pt-3">
                        <div class="row g-3 align-items-center">
                          <div class="col-md-3">
                            <label class="form-label visually-hidden">Sector Type</label>
                            <input type="text" class="form-control" value="Flight" placeholder="Enter sector type">
                          </div>
                          <div class="col-auto">
                            <button type="button" class="btn btn-warning">
                              <i class="ri ri-download-2-line"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                  
                      <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-light px-4" data-bs-target="#screenshots" data-bs-toggle="tab">Prev</button>
                        <button class="btn btn-primary px-4" data-bs-target="#passenger" data-bs-toggle="tab">Next</button>
                      </div>
                  
                    </div>
                  </div>



                  <!-- Passenger Details -->
                  <div class="tab-pane fade" id="passenger" role="tabpanel" aria-labelledby="passenger-tab">
                    <div class="card p-4">
                      <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Passenger Details</h4>
                        <button class="btn btn-sm btn-primary waves-effect waves-light" id="addPassengerBtn">
                          <i class="icon-base ri ri-add-circle-fill"></i>
                        </button>
                      </div>
                
                      <div id="passengerForms">
                        <!-- Passenger 1 -->
                        <div class="row mb-5 mt-2 passenger-form" data-index="0">
                          <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">Passenger 1</h6>
                            <button class="btn btn-sm btn-outline-danger delete-passenger">
                              <i class="icon-base ri ri-delete-bin-2-line"></i> Delete
                            </button>
                          </div>
                          <div class="col-md-2">
                            <label class="form-label">Type</label>
                            <input type="text" class="form-control" name="passenger[0][passenger_type]" value="Adult">
                          </div>
                          <div class="col-md-2">
                            <label class="form-label">Gender</label>
                            <input type="text" class="form-control" name="passenger[0][gender]" value="Male">
                          </div>
                          <div class="col-md-2">
                            <label class="form-label">DOB</label>
                            <input type="text" class="form-control" name="passenger[0][dob]" value="10-Apr-2025">
                          </div>
                          <div class="col-md-2">
                            <label class="form-label">Seat</label>
                            <input type="text" class="form-control" name="passenger[0][seat_number]" placeholder="Seat">
                          </div>
                          <div class="col-md-2">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="passenger[0][title]" value="Ms">
                          </div>
                          <div class="col-md-2">
                            <label class="form-label">Credit Note Amount</label>
                            <input type="text" class="form-control" name="passenger[0][credit_note]" value="0">
                          </div>
                          <div class="col-md-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="passenger[0][first_name]" value="mnnfksdfs fsdjfds">
                          </div>
                          <div class="col-md-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="passenger[0][middle_name]" placeholder="Middle Name">
                          </div>
                          <div class="col-md-3 position-relative">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="passenger[0][last_name]" value="cshcjxhds">
                          </div>
                          <div class="col-md-3">
                            <label class="form-label">E-Ticket</label>
                            <input type="text" class="form-control" name="passenger[0][e_ticket_number]" placeholder="E Ticket">
                          </div>
                        </div>

                        <!--  End Passenger 1 -->


                      </div>
                
                      <!-- Nav Buttons -->
                      <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-light px-4" data-bs-target="#sector" data-bs-toggle="tab">Prev</button>
                        <button class="btn btn-primary px-4" data-bs-target="#billing" data-bs-toggle="tab">Next</button>
                      </div>
                    </div>
                  </div>

                  <!-- Billing Details -->
                  <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
                    <div class="card p-4">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-header border-0 p-0">Billing Details</h5>
                        <div>
                          <button type="button" class="btn btn-outline-secondary btn-sm">Send Paylink</button>
                          <button class="btn btn-sm btn-primary waves-effect waves-light">
                            <i class="icon-base ri ri-add-circle-fill"></i>
                          </button>
                        </div>
                      </div>

                      <div class="card-body pt-2">
                        <h6 class="mb-3">Card Details</h6>
                        <div class="row g-3">
                          <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="Card Type" name="card_type[]" value="VISA">
                          </div>
                          <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="CC Number" name="cc_number[]">
                          </div>
                          <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="CC Holder Name" name="cc_holder_name">
                          </div>
                          <div class="col-md-1">
                            <input type="text" class="form-control" placeholder="Exp Month" value="01" name="exp_month[]">
                          </div>
                          <div class="col-md-1">
                            <input type="text" class="form-control" placeholder="Exp Year" value="2024" name="exp_year[]">
                          </div>
                          <div class="col-md-1">
                            <input type="text" class="form-control" placeholder="CVV" name="cvv[]">
                          </div>
                          <div class="col-md-3 d-flex align-items-center">
                            <input type="text" class="form-control" placeholder="Address" name="address[]">
                            <button class="btn btn-outline-danger ms-2" type="button">
                              <i class="ri ri-delete-bin-line"></i>
                            </button>
                          </div>
                          <div class="col-md-3">
                            <input type="email" class="form-control" placeholder="Email" name="email[]">
                          </div>
                          <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Contact No" name="contact_no[]">
                          </div>
                          <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="City" name="city[]">
                          </div>
                          <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="Country" value="Afghanistan" name="country[]">
                          </div>
                          <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="State" value="Badakhshan" name="state[]">
                          </div>
                          <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="ZIP Code" name="zip_code[]">
                          </div>
                          <div class="col-md-1">
                            <input type="text" class="form-control" placeholder="Currency" value="USD" name="currency[]">
                          </div>
                          <div class="col-md-1">
                            <input type="number" class="form-control" placeholder="Amount (USD)" value="0" name="amount[]">
                          </div>
                          <div class="col-md-2 d-flex align-items-center">
                            <label class="me-2">Active</label>
                            <input class="form-check-input" type="radio" name="activeCard" value="1">
                          </div>
                        </div>
                      </div>
                      <div class="card-footer mt-4 d-flex justify-content-between">
                        <button class="btn btn-light px-4" data-bs-target="#passenger" data-bs-toggle="tab">Prev</button>
                        <button class="btn btn-primary px-4" data-bs-target="#pricing" data-bs-toggle="tab">Next</button>
                      </div>
                    </div>
                  </div>

                  <!-- Pricing Details -->
                  <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
                    <div class="card p-4">
                      <h5 class="card-header px-0">Pricing Details</h5>
                      <div class="card-body p-0">
                        <div class="row g-3">
                          <div class="col-md-3">
                            <label class="form-label">Hotel Cost ($)<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="hotel_cost" value="0.00" placeholder="0.00">
                          </div>
                          <div class="col-md-3">
                            <label class="form-label">Cruise Cost ($)<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="cruise_cost" value="0.00" placeholder="0.00">
                          </div>
                          <div class="col-md-3">
                            <label class="form-label">Total Amount ($)<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="total_amount" value="0.00" placeholder="0.00">
                          </div>
                          <div class="col-md-3">
                            <label class="form-label">Advisor MCO ($)</label>
                            <input type="text" class="form-control" name="advisor_mco" value="12.00" placeholder="0.00">
                          </div>
                          <div class="col-md-3">
                            <label class="form-label">Convertion Charge ($) Advisor MCO*5%</label>
                            <input type="text" class="form-control" name="advisor_mco" value="12.00" placeholder="0.00">
                          </div>
                          <div class="col-md-3">
                            <label class="form-label">Airline Commission ($)</label>
                            <input type="text" class="form-control" name="airline_commission" value="0.00" placeholder="0.00">
                          </div>
                          <div class="col-md-3">
                            <label class="form-label">Final Amount ($)</label>
                            <input type="text" class="form-control" name="final_amount" value="12.00" placeholder="0.00">
                          </div>
                          <div class="col-md-3">
                            <label class="form-label">Merchant</label>
                            <input type="text" class="form-control" name="merchant" value="Cheapofly" placeholder="Merchant Name">
                          </div>
                          <div class="col-md-3">
                            <label class="form-label">Net MCO ($)</label>
                            <input type="text" class="form-control" name="net_mco" value="0.20" placeholder="0.00">
                          </div>
                        </div>
                      </div>
                      <!-- Nav Buttons -->
                      <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-light px-4" data-bs-target="#billing" data-bs-toggle="tab">Prev</button>
                        <button class="btn btn-primary px-4" data-bs-target="#remarks" data-bs-toggle="tab">Next</button>
                      </div>
                    </div>
                  </div>

                  <!-- Booking Remarks -->
                  <div class="tab-pane fade" id="remarks" role="tabpanel" aria-labelledby="remarks-tab">
                    <div class="card p-4">
                      <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-header border-0 p-0">Remarks</h5>
                        <div>
                          <button type="button" class="btn btn-warning me-2">
                            <i class="ri ri-file-text-line"></i>
                          </button>
                          <button type="button" class="btn btn-warning">
                            <i class="ri ri-save-line"></i>
                          </button>
                        </div>
                      </div>

                      <div class="card-body p-0">
                        <textarea class="form-control mb-4" rows="4" placeholder="Enter remarks here..."></textarea>
                        <div class="table-responsive">
                          <table class="table table-bordered text-center align-middle">
                            <thead class="text-white bg-primary small">
                              <tr>
                                <th scope="col" class="py-2">Id</th>
                                <th scope="col" class="py-2">Agent</th>
                                <th scope="col" class="py-2">Date & Time</th>
                                <th scope="col" class="py-2">Particulars</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>Alex Morgan</td>
                                <td>2025-04-10 14:30</td>
                                <td>Called to confirm ticket details</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                          <div>
                            <label>Show
                              <select class="form-select d-inline-block w-auto mx-1">
                                <option>10</option>
                                <option>25</option>
                                <option>50</option>
                              </select>
                              entries
                            </label>
                          </div>
                          <div>
                            <label class="me-2">Search:</label>
                            <input type="text" class="form-control d-inline-block w-auto" placeholder="">
                          </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                          <div>
                            Showing 1 to 3 of 3 entries
                          </div>
                          <div>
                            <button class="btn btn-outline-primary btn-sm me-2">Previous</button>
                            <button class="btn btn-outline-primary btn-sm">Next</button>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-light px-4" data-bs-target="#pricing" data-bs-toggle="tab">Prev</button>
                        <button class="btn btn-primary px-4" data-bs-target="#feedback" data-bs-toggle="tab">Next</button>
                      </div>
                    </div>
                  </div>

                  <!-- Quality Feedback -->
                  <div class="tab-pane fade" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
                    <div class="card p-4">
                      <div class="d-flex justify-content-between align-items-start mb-3">
                        <h5 class="card-header border-0 p-0">Quality Feedback</h5>
                        <button type="button" class="btn btn-warning">
                          <i class="ri ri-save-line"></i>
                        </button>
                      </div>

                      <div class="card-body p-0">
                        <textarea class="form-control mb-4" rows="4" placeholder="Enter quality feedback here..."></textarea>
                        <div class="row row-cols-2 row-cols-md-4 g-2 mb-4">
                          <div class="col">
                            <label class="btn btn-outline-secondary w-100">
                              <input type="radio" name="param" class="me-2"> Probing & Understanding
                            </label>
                          </div>
                          <div class="col">
                            <label class="btn btn-outline-secondary w-100">
                              <input type="radio" name="param" class="me-2"> Dead air/Hold procedure
                            </label>
                          </div>
                          <div class="col">
                            <label class="btn btn-outline-secondary w-100">
                              <input type="radio" name="param" class="me-2"> Soft Skills
                            </label>
                          </div>
                          <div class="col">
                            <label class="btn btn-outline-secondary w-100">
                              <input type="radio" name="param" class="me-2"> Active Listening/Interruption
                            </label>
                          </div>
                          <div class="col">
                            <label class="btn btn-outline-secondary w-100">
                              <input type="radio" name="param" class="me-2"> Call Handling
                            </label>
                          </div>
                          <div class="col">
                            <label class="btn btn-outline-secondary w-100">
                              <input type="radio" name="param" class="me-2"> Selling Skills
                            </label>
                          </div>
                          <div class="col">
                            <label class="btn btn-outline-secondary w-100">
                              <input type="radio" name="param" class="me-2"> Cross Selling
                            </label>
                          </div>
                          <div class="col">
                            <label class="btn btn-outline-secondary w-100">
                              <input type="radio" name="param" class="me-2"> Documentation
                            </label>
                          </div>
                          <div class="col">
                            <label class="btn btn-outline-secondary w-100">
                              <input type="radio" name="param" class="me-2"> Disposition
                            </label>
                          </div>
                          <div class="col">
                            <label class="btn btn-outline-secondary w-100">
                              <input type="radio" name="param" class="me-2"> Call Closing
                            </label>
                          </div>
                          <div class="col">
                            <label class="btn btn-outline-danger w-100">
                              <input type="radio" name="param" class="me-2"> Fatal - Misrepresentation
                            </label>
                          </div>
                          <div class="col">
                            <label class="btn btn-outline-secondary w-100">
                              <input type="radio" name="param" class="me-2"> Status
                            </label>
                          </div>
                          <div class="col">
                            <label class="btn btn-outline-danger w-100">
                              <input type="radio" name="param" class="me-2"> Fatal - Unethical sale
                            </label>
                          </div>
                          <div class="col">
                            <label class="btn btn-outline-secondary w-100">
                              <input type="radio" name="param" class="me-2"> Paraphrasing
                            </label>
                          </div>
                          <div class="col">
                            <label class="btn btn-outline-danger w-100">
                              <input type="radio" name="param" class="me-2"> Fatal - Rude/Sarcastic behaviour
                            </label>
                          </div>
                        </div>
                        <div class="mb-4" style="max-width: 200px;">
                          <select class="form-select">
                            <option>Status</option>
                            <option>Pass</option>
                            <option>Fail</option>
                            <option>Pending</option>
                          </select>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered text-center align-middle">
                            <thead class="text-white bg-primary small" style="background-color: #8C9EFF;">
                              <tr>
                                <th class="py-2">QA</th>
                                <th class="py-2">Date & Time</th>
                                <th class="py-2">Feedback</th>
                                <th class="py-2">Parameters</th>
                                <th class="py-2">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Sana Khan</td>
                                <td>2025-04-10 11:15</td>
                                <td>Agent showed excellent probing skills and maintained soft tone.</td>
                                <td>Probing & Understanding, Soft Skills</td>
                                <td>Pass</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                          <div>
                            <label>Show
                              <select class="form-select d-inline-block w-auto mx-1">
                                <option>10</option>
                                <option>25</option>
                                <option>50</option>
                              </select>
                              entries
                            </label>
                          </div>
                          <div>
                            <label class="me-2">Search:</label>
                            <input type="text" class="form-control d-inline-block w-auto" placeholder="">
                          </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                          <div>
                            Showing 1 to 3 of 3 entries
                          </div>
                          <div>
                            <button class="btn btn-outline-primary btn-sm me-2">Previous</button>
                            <button class="btn btn-outline-primary btn-sm">Next</button>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-light px-4" data-bs-target="#remarks" data-bs-toggle="tab">Prev</button>
                        <button class="btn btn-primary px-4" data-bs-target="#screenshots" data-bs-toggle="tab">Next</button>
                      </div>
                    </div>
                  </div>

                  <!-- Screenshots -->
                  <div class="tab-pane fade" id="screenshots" role="tabpanel" aria-labelledby="screenshots-tab">
                    <div class="card p-4">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-header border-0 p-0">Screenshots</h5>
                        <div class="d-flex align-items-center gap-2">
                          <button class="btn btn-outline-dark rounded-pill px-3">
                            View Screenshots
                          </button>
                          <select class="form-select" style="width: 120px;">
                            <option selected>Flight</option>
                            <option>Hotel</option>
                            <option>Car</option>
                          </select>
                          <button class="btn btn-warning ms-2">
                            <i class="ri ri-save-line"></i>
                          </button>
                        </div>
                      </div>
                      <div class="mb-3">
                        <textarea class="form-control" rows="4" placeholder="Enter notes here..."></textarea>
                      </div>
                      <div class="d-flex justify-content-between mt-2">
                        <button class="btn btn-light px-4" data-bs-target="#feedback" data-bs-toggle="tab">Prev</button>
                        <button class="btn btn-primary px-4" data-bs-target="#sector" data-bs-toggle="tab">Next</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <!--/ Content -->

            <!-- JavaScript for Add/Delete Passenger -->
            <script>
              document.addEventListener('DOMContentLoaded', function () {
                const passengerFormsContainer = document.getElementById('passengerForms');
                const addPassengerBtn = document.getElementById('addPassengerBtn');

                // Function to update passenger indices and headers
                function updatePassengerIndices() {
                  const forms = passengerFormsContainer.querySelectorAll('.passenger-form');
                  forms.forEach((form, index) => {
                    form.dataset.index = index;
                    const header = form.querySelector('h6');
                    header.textContent = `Passenger ${index + 1}`;
                    const inputs = form.querySelectorAll('input');
                    inputs.forEach(input => {
                      const name = input.name.replace(/passenger\[\d+\]/, `passenger[${index}]`);
                      input.name = name;
                    });
                  });
                }

                // Add new passenger form
                addPassengerBtn.addEventListener('click', function () {
                  const forms = passengerFormsContainer.querySelectorAll('.passenger-form');
                  const lastIndex = forms.length > 0 ? parseInt(forms[forms.length - 1].dataset.index) + 1 : 0;
                  const newForm = forms[0].cloneNode(true);
                  
                  // Clear input values
                  const inputs = newForm.querySelectorAll('input');
                  inputs.forEach(input => {
                    input.value = input.placeholder || '';
                  });
                  
                  // Update index and header
                  newForm.dataset.index = lastIndex;
                  newForm.querySelector('h6').textContent = `Passenger ${lastIndex + 1}`;
                  
                  // Update input names
                  inputs.forEach(input => {
                    const name = input.name.replace(/passenger\[\d+\]/, `passenger[${lastIndex}]`);
                    input.name = name;
                  });
                  
                  // Add delete event to new buttons
                  newForm.querySelectorAll('.delete-passenger').forEach(btn => {
                    btn.addEventListener('click', function () {
                      if (passengerFormsContainer.querySelectorAll('.passenger-form').length > 1) {
                        newForm.remove();
                        updatePassengerIndices();
                      } else {
                        alert('At least one passenger form is required.');
                      }
                    });
                  });
                  
                  passengerFormsContainer.appendChild(newForm);
                });

                passengerFormsContainer.querySelectorAll('.delete-passenger').forEach(btn => {
                  btn.addEventListener('click', function () {
                    const form = btn.closest('.passenger-form');
                    if (passengerFormsContainer.querySelectorAll('.passenger-form').length > 1) {
                      form.remove();
                      updatePassengerIndices();
                    } else {
                      alert('At least one passenger form is required.');
                    }
                  });
                });
              });
            </script>
<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
@endsection