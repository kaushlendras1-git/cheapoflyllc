@extends('web.layouts.main')

@section('content')

<form id="bookingForm" action="{{ route('travel.bookings.submit') }}" method="POST" enctype="multipart/form-data">

    @csrf
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-6">
            <div class="d-flex justify-content-between align-items-center flex-wrap p-0">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <strong>Ticket Information</strong>
                    <span>Created by Testagent on 4/7/2025 12:40:28 PM</span>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill">
                        Copy Authorization Link
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill">
                        Mail History
                    </button>
                </div>
            </div>
            
            @include('web.layouts.flash')

            <!-- Top Bar -->
            <div class="card p-3 mt-2">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input" type="checkbox" id="booking-flight" value="Flight" {{ in_array('Flight', old('booking-type', ['Flight'])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-flight">Flight</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input" type="checkbox" id="booking-hotel" value="Hotel" {{ in_array('Hotel', old('booking-type', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-hotel">Hotel</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input" type="checkbox" id="booking-cruise" value="Cruise" {{ in_array('Cruise', old('booking-type', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-cruise">Cruise</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input" type="checkbox" id="booking-car" value="Car" {{ in_array('Car', old('booking-type', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-car">Car</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="booking-type[]" class="form-check-input" type="checkbox" id="booking-car" value="Car" {{ in_array('Car', old('booking-type', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="booking-car">Train</label>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-sm btn-primary text-center">
                            <i class="icon-base ri ri-save-2-fill"></i> Save
                        </button>
                        <!-- <button type="button" class="btn btn-sm btn-dark text-center">
                            <i class="icon-base ri ri-mail-send-fill"></i> Send
                        </button> -->
                    </div>
                </div>
            </div>

            <!-- Booking Form Card -->
            <div class="card p-4 mb-4">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">PNR <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="pnr" value="{{ old('pnr', '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Hotel Ref</label>
                        <input type="text" class="form-control" name="hotel_ref" value="{{ old('hotel_ref', '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cruise Ref</label>
                        <input type="text" class="form-control" name="cruise_ref" value="{{ old('cruise_ref', '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', '') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Calling Phone No. <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone', '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Query Type</label>
                        <input type="text" class="form-control" name="query_type" value="{{ old('query_type', 'New Booking') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Company Organisation</label>
                        <input type="text" class="form-control" name="selected_company" value="{{ old('selected_company', 'cruiseroyals') }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Booking Status</label>
                        <input type="text" class="form-control" name="booking_status" value="{{ old('booking_status', 'under process') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Payment Status</label>
                        <input type="text" class="form-control" name="payment_status" value="{{ old('payment_status', 'pending') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Reservation Source</label>
                        <input type="text" class="form-control" name="reservation_source" value="{{ old('reservation_source', '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Descriptor</label>
                        <input type="text" class="form-control" name="descriptor" value="{{ old('descriptor', '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Amadeus/Sabre PNR</label>
                        <input type="text" class="form-control" name="amadeus_sabre_pnr" value="{{ old('amadeus_sabre_pnr', '') }}">
                    </div>
                </div>
            </div>

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs my-5" id="bookingTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="sector-tab" data-bs-toggle="tab" href="#sector" role="tab" aria-controls="sector" aria-selected="true">Sector Details</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="passenger-tab" data-bs-toggle="tab" href="#passenger" role="tab" aria-controls="passenger" aria-selected="false">Passenger Details</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pricing-tab" data-bs-toggle="tab" href="#pricing" role="tab" aria-controls="pricing" aria-selected="false">Pricing Details</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="billing-tab" data-bs-toggle="tab" href="#billing" role="tab" aria-controls="billing" aria-selected="false">Billing Details</a>
                </li>
               
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="remarks-tab" data-bs-toggle="tab" href="#remarks" role="tab" aria-controls="remarks" aria-selected="false">Booking Remarks</a>
                </li>
                
                <!-- <li class="nav-item" role="presentation">
                    <a class="nav-link" id="feedback-tab" data-bs-toggle="tab" href="#feedback" role="tab" aria-controls="feedback" aria-selected="false">Quality Feedback</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="screenshots-tab" data-bs-toggle="tab" href="#screenshots" role="tab" aria-controls="screenshots" aria-selected="false">Screenshots</a>
                </li> -->

            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="bookingTabsContent">
                <!-- Sector Details -->
                <div class="tab-pane fade show active" id="sector" role="tabpanel" aria-labelledby="sector-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-header border-0 p-0">Sector Details</h5>
                          
                        </div>
                        <div class="card-body pt-3">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                    
                             
<!------------------------ Sector ------------------------------>

<!-- Bootstrap Modal -->
<div class="modal fade" id="addDetailsModal" tabindex="-1" aria-labelledby="addDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="addDetailsModalLabel">Add Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <!-- You can place your form or content here -->
        <form>
          <div class="mb-3">
            <label for="detailInput" class="form-label">Detail</label>
            <input type="text" class="form-control" id="detailInput" placeholder="Enter detail">
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>

    </div>
  </div>
</div>
    
    



<!-------------------------------------Sector ---------------------------------------------------------------->

     <!-- File input -->
      
<input type="file" name="sector_details[]" id="filepondFile" multiple />


<!-- FilePond styles -->
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet" />

<!-- FilePond scripts -->
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>



@if(1==2)

 <!-- Cruise Booking Details -->
    <h2>Cruise Booking Details</h2>
    <table id="cruiseTable">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Date</th>
                <th>Cruise Line</th>
                <th>Name of the Ship</th>
                <th>Category</th>
                <th>Stateroom</th>
                <th>Departure Port</th>
                <th>Departure Date</th>
                <th>Hrs</th>
                <th>mm</th>
                <th>Arrival Port</th>
                <th>Arrival Date</th>
                <th>Hrs</th>
                <th>mm</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <a class="add-row" onclick="addCruiseRow()">Add Row</a>

    <!-- Car Booking Details -->
    <h2>Car Booking Details</h2>
    <table id="carTable">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Car Rental Provider</th>
                <th>Car Type</th>
                <th>Pick-up Location</th>
                <th>Drop-off Location</th>
                <th>Pick-up Date</th>
                <th>Pick-up Time</th>
                <th>Drop-off Date</th>
                <th>Drop-off Time</th>
                <th>Confirmation Number</th>
                <th>Remarks</th>
                <th>Rental Provider's Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <a class="add-row" onclick="addCarRow()">Add Row</a>

    <!-- Hotel Booking Details -->
    <h2>Hotel Booking Details</h2>
    <table id="hotelTable">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Hotel Name</th>
                <th>Room Category</th>
                <th>Check-in Date</th>
                <th>Check-out Date</th>
                <th>No. Of Rooms</th>
                <th>Confirmation Number</th>
                <th>Hotel Address</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <a class="add-row" onclick="addHotelRow()">Add Row</a>

    <!-- Flight Booking Details -->
    <h2>Flight Booking Details</h2>
    <table id="flightTable">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Direction</th>
                <th>Date</th>
                <th>Airlines (Code)</th>
                <th>Flight No</th>
                <th>Cabin</th>
                <th>Class of Service</th>
                <th>Departure Airport</th>
                <th>Hrs</th>
                <th>mm</th>
                <th>Arrival Airport</th>
                <th>Hrs</th>
                <th>mm</th>
                <th>Duration</th>
                <th>Transit</th>
                <th>Arrival Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <a class="add-row" onclick="addFlightRow()">Add Row</a>

    <style>
         table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        a.add-row {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 20px;
        }
        a.add-row:hover {
            background-color: #45a049;
        }
        a.delete-row {
            background-color: #ff4444;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        a.delete-row:hover {
            background-color: #cc0000;
        }
        input {
            width: 90%;
            padding: 5px;
        }
    </style>
    @endif
<!-------------------------------------Sector ---------------------------------------------------------------->









                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <!-- Passenger Details -->
                <div class="tab-pane fade" id="passenger" role="tabpanel" aria-labelledby="passenger-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">Passenger Details</h4>
                            
                        </div>

           <!------------------------------------------------------------------------------------------>

           <style>
        .excel-like-container {
            background-color: #fff;
            border: 1px solid #d1d3e2;
            border-radius: 6px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .passenger-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f8f9fc;
        }
        .passenger-table th, .passenger-table td {
            border: 1px solid #d1d3e2;
            padding: 8px;
            font-size: 14px;
            text-align: left;
            vertical-align: middle;
        }
        .passenger-table th {
            background-color: #e9ecef;
            font-weight: 600;
            color: #1f2a44;
        }
        .passenger-table td {
            background-color: #fff;
        }
        .passenger-table .form-control {
            border: 1px solid #d1d3e2;
            background-color: #fff;
            font-size: 14px;
            padding: 6px;
            width: 100%;
        }
        .delete-passenger {
            font-size: 14px;
            padding: 5px 10px;
        }
        .add-passenger-btn {
            background-color: #1f2a44;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 4px;
            margin-top: 15px;
        }
        .add-passenger-btn:hover {
            background-color: #2a3b5e;
        }
        .billing-card-title {
            font-size: 16px;
            font-weight: 600;
            color: #1f2a44;
        }
    </style>
</head>
<body>
    <div class="container excel-like-container">
        <table class="passenger-table">
            <thead>
                <tr>
                    <th>Passenger</th>
                    <th>Type</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Seat</th>
                    <th>Title</th>
                    <th>Credit Note</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>E-Ticket</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="passengerForms">
                <tr class="passenger-form" data-index="0">
                    <td><span class="billing-card-title"> 1</span></td>
                    <td><input type="text" class="form-control" name="passenger[0][passenger_type]" value="Adult"></td>
                    <td><input type="text" class="form-control" name="passenger[0][gender]" value="Male"></td>
                    <td><input type="date" class="form-control" name="passenger[0][dob]" value="2025-04-10"></td>
                    <td><input type="text" class="form-control" name="passenger[0][seat_number]" placeholder="Seat"></td>
                    <td><input type="text" class="form-control" name="passenger[0][title]" value="Ms"></td>
                    <td><input type="number" class="form-control" name="passenger[0][credit_note]" value="0" step="0.01"></td>
                    <td><input type="text" class="form-control" name="passenger[0][first_name]" value="mnnfksdfs fsdjfds"></td>
                    <td><input type="text" class="form-control" name="passenger[0][middle_name]" placeholder="Middle Name"></td>
                    <td><input type="text" class="form-control" name="passenger[0][last_name]" value="cshcjxhds"></td>
                    <td><input type="text" class="form-control" name="passenger[0][e_ticket_number]" placeholder="E Ticket"></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-danger delete-passenger">
                            <i class="icon-base ri ri-delete-bin-2-line"></i> Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn add-passenger-btn" id="addPassenger">Add More</button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const passengerFormsContainer = document.getElementById('passengerForms');
            let passengerIndex = 1;

            // Add new passenger row
            document.getElementById('addPassenger').addEventListener('click', () => {
                const newRow = document.createElement('tr');
                newRow.className = 'passenger-form';
                newRow.dataset.index = passengerIndex;
                newRow.innerHTML = `
                    <td><span class="billing-card-title"> ${passengerIndex + 1}</span></td>
                    <td><input type="text" class="form-control" name="passenger[${passengerIndex}][passenger_type]" value="Adult"></td>
                    <td><input type="text" class="form-control" name="passenger[${passengerIndex}][gender]" value="Male"></td>
                    <td><input type="date" class="form-control" name="passenger[${passengerIndex}][dob]" value="2025-04-10"></td>
                    <td><input type="text" class="form-control" name="passenger[${passengerIndex}][seat_number]" placeholder="Seat"></td>
                    <td><input type="text" class="form-control" name="passenger[${passengerIndex}][title]" value="Ms"></td>
                    <td><input type="number" class="form-control" name="passenger[${passengerIndex}][credit_note]" value="0" step="0.01"></td>
                    <td><input type="text" class="form-control" name="passenger[${passengerIndex}][first_name]" value=""></td>
                    <td><input type="text" class="form-control" name="passenger[${passengerIndex}][middle_name]" placeholder="Middle Name"></td>
                    <td><input type="text" class="form-control" name="passenger[${passengerIndex}][last_name]" value=""></td>
                    <td><input type="text" class="form-control" name="passenger[${passengerIndex}][e_ticket_number]" placeholder="E Ticket"></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-danger delete-passenger">
                            <i class="icon-base ri ri-delete-bin-2-line"></i> Delete
                        </button>
                    </td>
                `;
                passengerFormsContainer.appendChild(newRow);
                passengerIndex++;
            });

            // Delete passenger row
            passengerFormsContainer.addEventListener('click', (e) => {
                if (e.target.closest('.delete-passenger')) {
                    const row = e.target.closest('.passenger-form');
                    if (passengerFormsContainer.children.length > 1) {
                        row.remove();
                        updatePassengerTitles();
                    }
                }
            });

            // Update passenger titles and indices after deletion
            function updatePassengerTitles() {
                const rows = passengerFormsContainer.querySelectorAll('.passenger-form');
                rows.forEach((row, index) => {
                    const title = row.querySelector('.billing-card-title');
                    title.textContent = `Passenger ${index + 1}`;
                    row.dataset.index = index;
                    const inputs = row.querySelectorAll('input');
                    inputs.forEach(input => {
                        const name = input.name.replace(/passenger\[\d+\]/, `passenger[${index}]`);
                        input.name = name;
                    });
                });
                passengerIndex = rows.length;
            }
        });
    </script>
</body>
</html>
           <!------------------------------------------------------------------------------------------>
                        
                        
                    </div>
                </div>

<!--------------------------------------Billing Details ---------------------------->
 <style>
      
        .billing-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f8f9fc;
        }
        .billing-table th, .billing-table td {
            border: 1px solid #d1d3e2;
            padding: 8px;
            text-align: left;
            font-size: 14px;
        }
        .billing-table th {
            background-color: #e9ecef;
            font-weight: 600;
            color: #1f2a44;
        }
        .billing-table td {
            background-color: #fff;
        }
        .billing-table .form-control {
            border: 1px solid #d1d3e2;
            font-size: 14px;
            padding: 6px;
            width: 100%;
        }
        .billing-table .form-check-input {
            margin: 0;
        }
        .billing-card-title {
            font-size: 16px;
            font-weight: 600;
            color: #1f2a44;
            margin-bottom: 10px;
        }
        .delete-billing-btn {
            font-size: 14px;
            padding: 5px 10px;
        }
        .add-billing-btn {
            background-color: #1f2a44;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 4px;
            margin-top: 10px;
        }
        .add-billing-btn:hover {
            background-color: #2a3b5e;
        }
        .submit-paylink-btn {
            font-size: 14px;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-header border-0 p-0">Billing Details</h5>
                <div>
                    <button type="button" class="btn btn-outline-secondary btn-sm submit-paylink-btn">Submit Paylink</button>
                   
                </div>
            </div>
            <div class="card-body p-0">
                <div class="excel-like-container">
                    <table class="billing-table">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Card Type</th>
                                <th>CC Number</th>
                                <th>CC Holder Name</th>
                                <th>MM</th>
                                <th>YYYY</th>
                                <th>CVV</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Contact No</th>
                                <th>City</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>ZIP Code</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="billingForms">
                            <tr class="billing-card" data-index="0">
                                <td><h6 class="billing-card-title mb-0"> 1</h6></td>
                                <td><input type="text" class="form-control" placeholder="Card Type" name="billing[0][card_type]" value="VISA"></td>
                                <td><input type="text" class="form-control" placeholder="CC Number" name="billing[0][cc_number]" value="123 789 346"></td>
                                <td><input type="text" class="form-control" placeholder="CC Holder Name" name="billing[0][cc_holder_name]" value="test"></td>
                                <td><input type="text" class="form-control" placeholder="MM" name="billing[0][exp_month]" value="01"></td>
                                <td><input type="text" class="form-control" placeholder="YYYY" name="billing[0][exp_year]" value="2024"></td>
                                <td><input type="text" class="form-control" placeholder="CVV" name="billing[0][cvv]" value="134"></td>
                                <td><input type="text" class="form-control" placeholder="Address" name="billing[0][address]" value="laxmi Nagrr"></td>
                                <td><input type="email" class="form-control" placeholder="Email" name="billing[0][email]" value="test@gmail.com"></td>
                                <td><input type="text" class="form-control" placeholder="Contact No" name="billing[0][contact_no]" value="8510810544"></td>
                                <td><input type="text" class="form-control" placeholder="City" name="billing[0][city]" value="delhi"></td>
                                <td><input type="text" class="form-control" placeholder="Country" name="billing[0][country]" value="Afghanistan"></td>
                                <td><input type="text" class="form-control" placeholder="State" name="billing[0][state]" value="Badakhshan"></td>
                                <td><input type="text" class="form-control" placeholder="ZIP Code" name="billing[0][zip_code]" value="110092"></td>
                                <td><input type="text" class="form-control" placeholder="Currency" name="billing[0][currency]" value="USD"></td>
                                <td><input type="number" class="form-control" placeholder="0.00" name="billing[0][amount]" value="0" step="0.01"></td>
                                <td><input class="form-check-input" type="radio" name="activeCard" value="0" checked></td>
                                <td>
                                    <button type="button" class="btn btn-outline-danger delete-billing-btn">
                                        <i class="ri ri-delete-bin-line"></i>
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                     <a class="btn add-billing-btn" id="addBillingBtn"><i class="icon-base ri ri-add-circle-fill"></i> Add More</a>
                </div>
            </div>
        </div>
    </div>

   
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const billingFormsContainer = document.getElementById('billingForms');
            let billingIndex = 1;

            // Add new billing row
            document.getElementById('addBillingBtn').addEventListener('click', () => {
                const newRow = document.createElement('tr');
                newRow.className = 'billing-card';
                newRow.dataset.index = billingIndex;
                newRow.innerHTML = `
                    <td><h6 class="billing-card-title mb-0"> ${billingIndex + 1}</h6></td>
                    <td><input type="text" class="form-control" placeholder="Card Type" name="billing[${billingIndex}][card_type]" value="VISA"></td>
                    <td><input type="text" class="form-control" placeholder="CC Number" name="billing[${billingIndex}][cc_number]" value=""></td>
                    <td><input type="text" class="form-control" placeholder="CC Holder Name" name="billing[${billingIndex}][cc_holder_name]" value=""></td>
                    <td><input type="text" class="form-control" placeholder="MM" name="billing[${billingIndex}][exp_month]" value="01"></td>
                    <td><input type="text" class="form-control" placeholder="YYYY" name="billing[${billingIndex}][exp_year]" value="2024"></td>
                    <td><input type="text" class="form-control" placeholder="CVV" name="billing[${billingIndex}][cvv]" value=""></td>
                    <td><input type="text" class="form-control" placeholder="Address" name="billing[${billingIndex}][address]" value=""></td>
                    <td><input type="email" class="form-control" placeholder="Email" name="billing[${billingIndex}][email]" value=""></td>
                    <td><input type="text" class="form-control" placeholder="Contact No" name="billing[${billingIndex}][contact_no]" value=""></td>
                    <td><input type="text" class="form-control" placeholder="City" name="billing[${billingIndex}][city]" value=""></td>
                    <td><input type="text" class="form-control" placeholder="Country" name="billing[${billingIndex}][country]" value=""></td>
                    <td><input type="text" class="form-control" placeholder="State" name="billing[${billingIndex}][state]" value=""></td>
                    <td><input type="text" class="form-control" placeholder="ZIP Code" name="billing[${billingIndex}][zip_code]" value=""></td>
                    <td><input type="text" class="form-control" placeholder="Currency" name="billing[${billingIndex}][currency]" value="USD"></td>
                    <td><input type="number" class="form-control" placeholder="0.00" name="billing[${billingIndex}][amount]" value="0" step="0.01"></td>
                    <td><input class="form-check-input" type="radio" name="activeCard" value="${billingIndex}"></td>
                    <td>
                        <button type="button" class="btn btn-outline-danger delete-billing-btn">
                            <i class="ri ri-delete-bin-line"></i>
                        </button>
                    </td>
                `;
                billingFormsContainer.appendChild(newRow);
                billingIndex++;
            });

            // Delete billing row
            billingFormsContainer.addEventListener('click', (e) => {
                if (e.target.closest('.delete-billing-btn')) {
                    const row = e.target.closest('tr');
                    if (billingFormsContainer.children.length > 1) {
                        row.remove();
                        updateBillingTitles();
                    }
                }
            });

            // Update billing titles and indices
            function updateBillingTitles() {
                const rows = billingFormsContainer.querySelectorAll('.billing-card');
                rows.forEach((row, index) => {
                    const title = row.querySelector('.billing-card-title');
                    title.textContent = `Card Details ${index + 1}`;
                    row.dataset.index = index;
                    const inputs = row.querySelectorAll('input');
                    inputs.forEach(input => {
                        if (input.type === 'radio') {
                            input.value = index;
                        } else {
                            const name = input.name.replace(/billing\[\d+\]/, `billing[${index}]`);
                            input.name = name;
                        }
                    });
                });
                billingIndex = rows.length;
            }
        });
    </script>
</body>
</html>
                

<!--------------------------------------Billing Details ---------------------------->
                       
                    </div>
                </div>

                <!------------------------- Pricing Details -->
                <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
                    <div class="excel-like-container">
                <table class="pricing-table">
                    <thead>
                        <tr>
                            <th>Hotel Cost ($)</th>
                            <th>Cruise Cost ($)</th>
                            <th>Total Amount ($)</th>
                            <th>Advisor MCO ($)</th>
                            <th>Conversion Charge ($)</th>
                            <th>Airline Commission ($)</th>
                            <th>Final Amount ($)</th>
                            <th>Merchant</th>
                            <th>Net MCO ($)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <label class="form-label">Hotel Cost ($)<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="hotel_cost" value="0.00" placeholder="0.00" step="0.01">
                            </td>
                            <td>
                                <label class="form-label">Cruise Cost ($)<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="cruise_cost" value="0.00" placeholder="0.00" step="0.01">
                            </td>
                            <td>
                                <label class="form-label">Total Amount ($)<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="total_amount" value="0.00" placeholder="0.00" step="0.01">
                            </td>
                            <td>
                                <label class="form-label">Advisor MCO ($)</label>
                                <input type="number" class="form-control" name="advisor_mco" value="12.00" placeholder="0.00" step="0.01">
                            </td>
                            <td>
                                <label class="form-label">Conversion Charge ($)</label>
                                <input type="number" class="form-control" name="conversion_charge" value="12.00" placeholder="0.00" step="0.01">
                            </td>
                            <td>
                                <label class="form-label">Airline Commission ($)</label>
                                <input type="number" class="form-control" name="airline_commission" value="0.00" placeholder="0.00" step="0.01">
                            </td>
                            <td>
                                <label class="form-label">Final Amount ($)</label>
                                <input type="number" class="form-control" name="final_amount" value="12.00" placeholder="0.00" step="0.01">
                            </td>
                            <td>
                                <label class="form-label">Merchant</label>
                                <input type="text" class="form-control" name="merchant" value="Cheapofly" placeholder="Merchant Name">
                            </td>
                            <td>
                                <label class="form-label">Net MCO ($)</label>
                                <input type="number" class="form-control" name="net_mco" value="0.00" placeholder="0.00" step="0.01">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    
                </div>

             <!-----------------------------------Pricing ------------------------------------------>   

                <!-- Booking Remarks -->
                <div class="tab-pane fade" id="remarks" role="tabpanel" aria-labelledby="remarks-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-header border-0 p-0">Booking Remarks</h5>
                        </div>
                        <div class="card-body p-0">
                            <textarea class="form-control mb-4" name="particulars" rows="4" placeholder="Enter remarks here...">{{ old('particulars', '') }}</textarea>
                        </div>
                        
                    </div>
                </div>

                <!-- Quality Feedback -->
                <!-- <div class="tab-pane fade" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-header border-0 p-0">Quality Feedback</h5>
                            <button type="button" class="btn btn-warning">
                                <i class="ri ri-save-line"></i>
                            </button>
                        </div>
                        <div class="card-body p-0">
                            <textarea class="form-control mb-4" name="feedback" rows="4" placeholder="Enter feedback here...">{{ old('feedback', '') }}</textarea>
                            <div class="row row-cols-2 row-cols-md-4 g-2 mb-4">
                                <div class="col">
                                    <label class="btn btn-outline-secondary w-100">
                                        <input type="radio" name="param" value="Probing & Understanding" {{ old('param') == 'Probing & Understanding' ? 'checked' : '' }}> Probing & Understanding
                                    </label>
                                </div>
                            </div>
                            <div class="mb-4" style="max-width: 200px;">
                                <select class="form-select" name="status">
                                    <option value="" {{ old('status') == '' ? 'selected' : '' }}>Select Status</option>
                                    <option value="Pass" {{ old('status') == 'Pass' ? 'selected' : '' }}>Pass</option>
                                    <option value="Fail" {{ old('status') == 'Fail' ? 'selected' : '' }}>Fail</option>
                                    <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="text-white bg-primary small">
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
                                            <td>Sana Maria</td>
                                            <td>2025-04-10 11:15</td>
                                            <td>Agent showed excellent probing skills.</td>
                                            <td>Probing & Understanding, Soft Skills</td>
                                            <td>Pass</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-light px-4" data-bs-target="#remarks" data-bs-toggle="tab">Prev</button>
                            <button type="button" class="btn btn-primary px-4" data-bs-target="#screenshots" data-bs-toggle="tab">Next</button>
                        </div>
                    </div>
                </div> -->

                <!-- Screenshots -->
                <!--div class="tab-pane fade" id="screenshots" role="tabpanel" aria-labelledby="screenshots-tab">
                    <div class="card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-header border-0">Screenshots</h5>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-outline-dark rounded-pill px-3">View Screenshots</button>
                                <select class="form-select" name="type" style="width: 120px">
                                    <option value="Flight" {{ old('type') == 'Flight' ? 'selected' : '' }}>Flight</option>
                                    <option value="Hotel" {{ old('type') == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                                    <option value="Car" {{ old('type') == 'Car' ? 'selected' : '' }}>Car</option>
                                </select>
                                <button type="button" class="btn btn-warning">
                                    <i class="ri ri-save-line"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="notes" rows="4" placeholder="Enter notes here...">{{ old('notes', '') }}</textarea>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <button type="button" class="btn btn-light px-4" data-bs-target="#feedback" data-bs-toggle="tab">Prev</button>
                            <button type="button" class="btn btn-primary px-4" data-bs-target="#sector" data-bs-toggle="tab">Next</button>
                        </div>
                    </div>
                </div-->
            </div>
        </div>
    </div>
</form>

<!-- JavaScript for Add/Delete Passenger and Billing -->


<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/booking.js"></script>
<script src="/assets/js/addMore.js"></script>


@endsection