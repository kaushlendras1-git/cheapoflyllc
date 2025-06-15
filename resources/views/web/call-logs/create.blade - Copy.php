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
                <!-- Sector Details -->
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
                </div>

                <!-- Passenger Details -->
                <div class="card p-4 mt-5">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Passenger Details</h4>
                    <button class="btn btn-sm btn-primary">
                      <i class="icon-base ri ri-add-circle-fill"></i>
                    </button>
                  </div>
                
                  <!-- Passenger 1 -->
                  <div class="row mb-5 mt-2">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <h6 class="mb-0">Passenger 1</h6>
                      <button class="btn btn-sm btn-outline-danger">
                        <i class="icon-base ri ri-delete-bin-2-line"></i> Delete
                      </button>
                    </div>
                    <div class="col-md-2">
                      <label class="form-label">Type</label>
                      <input type="text" class="form-control" value="Adult">
                    </div>
                    <div class="col-md-2">
                      <label class="form-label">Gender</label>
                      <input type="text" class="form-control" value="Male">
                    </div>
                    <div class="col-md-2">
                      <label class="form-label">DOB</label>
                      <input type="text" class="form-control" value="10-Apr-2025">
                    </div>
                    <div class="col-md-2">
                      <label class="form-label">Seat</label>
                      <input type="text" class="form-control" placeholder="Seat">
                    </div>
                    <div class="col-md-2">
                      <label class="form-label">Title</label>
                      <input type="text" class="form-control" value="Ms">
                    </div>
                    <div class="col-md-2">
                      <label class="form-label">Credit Note Amount</label>
                      <input type="text" class="form-control" value="0">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">First Name</label>
                      <input type="text" class="form-control" value="mnnfksdfs fsdjfds">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Middle Name</label>
                      <input type="text" class="form-control" placeholder="Middle Name">
                    </div>
                    <div class="col-md-3 position-relative">
                      <label class="form-label">Last Name</label>
                      <input type="text" class="form-control" value="cshcjxhds">
                      <button class="btn btn-sm btn-link text-danger position-absolute top-0 end-0 mt-4 me-2 p-0">
                        <span class="iconify" data-icon="mdi:trash-can-outline" data-width="18"></span>
                      </button>
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">E-Ticket</label>
                      <input type="text" class="form-control" placeholder="E Ticket">
                    </div>
                  </div>
                
                  <!-- Passenger 2 -->
                  <div class="row mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <h6 class="mb-0">Passenger 2</h6>
                      <button class="btn btn-sm btn-outline-danger">
                        <i class="icon-base ri ri-delete-bin-2-line"></i> Delete
                      </button>
                    </div>
                    <div class="col-md-2">
                      <label class="form-label">Type</label>
                      <input type="text" class="form-control" placeholder="Select">
                    </div>
                    <div class="col-md-2">
                      <label class="form-label">Gender</label>
                      <input type="text" class="form-control" placeholder="Select">
                    </div>
                    <div class="col-md-2">
                      <label class="form-label">DOB</label>
                      <input type="text" class="form-control" value="10-OCT-1996">
                    </div>
                    <div class="col-md-2">
                      <label class="form-label">Seat</label>
                      <input type="text" class="form-control" placeholder="Seat">
                    </div>
                    <div class="col-md-2">
                      <label class="form-label">Title</label>
                      <input type="text" class="form-control" placeholder="Select">
                    </div>
                    <div class="col-md-2">
                      <label class="form-label">Credit Note Amount</label>
                      <input type="text" class="form-control" placeholder="Amount">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">First Name</label>
                      <input type="text" class="form-control" placeholder="First Name">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Middle Name</label>
                      <input type="text" class="form-control" placeholder="Middle Name">
                    </div>
                    <div class="col-md-3 position-relative">
                      <label class="form-label">Last Name</label>
                      <input type="text" class="form-control" placeholder="Last Name">
                      <button class="btn btn-sm btn-link text-danger position-absolute top-0 end-0 mt-4 me-2 p-0">
                        <span class="iconify" data-icon="mdi:trash-can-outline" data-width="18"></span>
                      </button>
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">E-Ticket</label>
                      <input type="text" class="form-control" placeholder="E Ticket">
                    </div>
                  </div>
                
                  <!-- Nav Buttons -->
                  <div class="d-flex justify-content-between mt-4">
                    <button class="btn btn-light px-4">Prev</button>
                    <button class="btn btn-primary px-4">Next</button>
                  </div>
                </div>                
              </div>
              
              <!-- Pricing Details -->
              <div class="card p-4 mt-5">
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

                <!-- Billing Details -->
                <div class="card p-4 mt-5">
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
                    <h6 class="mb-3">Card 1</h6>

                    <div class="row g-3">
                      <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="Card Type" value="VISA">
                      </div>
                      <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="CC Number">
                      </div>
                      <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="CC Holder Name">
                      </div>
                      <div class="col-md-1">
                        <input type="text" class="form-control" placeholder="Exp Month" value="01">
                      </div>
                      <div class="col-md-1">
                        <input type="text" class="form-control" placeholder="Exp Year" value="2024">
                      </div>
                      <div class="col-md-1">
                        <input type="text" class="form-control" placeholder="CVV">
                      </div>
                      <div class="col-md-3 d-flex align-items-center">
                        <input type="text" class="form-control" placeholder="Address Line 1">
                        <button class="btn btn-outline-danger ms-2" type="button">
                          <i class="ri ri-delete-bin-line"></i>
                        </button>
                      </div>

                      <div class="col-md-3">
                        <input type="email" class="form-control" placeholder="Email">
                      </div>
                      <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Contact No">
                      </div>
                      <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="City">
                      </div>
                      <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="Country" value="Afghanistan">
                      </div>
                      <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="State" value="Badakhshan">
                      </div>
                      <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="ZIP Code">
                      </div>
                      <div class="col-md-1">
                        <input type="text" class="form-control" placeholder="Currency" value="USD">
                      </div>
                      <div class="col-md-1">
                        <input type="number" class="form-control" placeholder="Amount (USD)" value="0">
                      </div>
                      <div class="col-md-2 d-flex align-items-center">
                        <label class="me-2">Active</label>
                        <input class="form-check-input" type="radio" name="activeCard" value="1">
                      </div>
                    </div>
                  </div>

                  <div class="card-footer mt-4 d-flex justify-content-between">
                    <button class="btn btn-outline-primary">Prev</button>
                    <button class="btn btn-primary">Next</button>
                  </div>
                </div>

                <!-- Booking Remarks -->
                <div class="card p-4 mt-5">
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

                    <!-- DataTable Section -->
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
                          <tr>
                            <td>2</td>
                            <td>Ravi Kumar</td>
                            <td>2025-04-10 16:10</td>
                            <td>Updated billing address</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Fatima Noor</td>
                            <td>2025-04-11 09:45</td>
                            <td>Requested refund status update</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <!-- DataTable Footer -->
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
                </div>

                <!-- Quality Feedback -->
                <div class="card p-4 mt-5">
                  <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="card-header border-0 p-0">Quality Feedback</h5>
                    <button type="button" class="btn btn-warning">
                      <i class="ri ri-save-line"></i>
                    </button>
                  </div>

                  <div class="card-body p-0">
                    <!-- Feedback Textarea -->
                    <textarea class="form-control mb-4" rows="4" placeholder="Enter quality feedback here..."></textarea>

                    <!-- Radio Buttons Grid -->
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

                    <!-- Status Dropdown -->
                    <div class="mb-4" style="max-width: 200px;">
                      <select class="form-select">
                        <option>Status</option>
                        <option>Pass</option>
                        <option>Fail</option>
                        <option>Pending</option>
                      </select>
                    </div>

                    <!-- Table -->
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
                          <tr>
                            <td>James Smith</td>
                            <td>2025-04-10 14:20</td>
                            <td>Missed product detail, misrepresentation.</td>
                            <td>Fatal - Misrepresentation</td>
                            <td>Fail</td>
                          </tr>
                          <tr>
                            <td>Lina Roberts</td>
                            <td>2025-04-11 08:45</td>
                            <td>Call closing was not clear, needs improvement.</td>
                            <td>Call Closing</td>
                            <td>Pending</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <!-- Footer -->
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
                </div>

                <!-- Screenshot -->
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
                      <button class="btn btn-light px-4">Prev</button>
                  </div>
                </div>

            </div>
            <!--/ Content -->
@endsection