<!----------------------------------------Passeenger-------------------------------------------------->
<div class="tab-pane fade show active" id="passenger" role="tabpanel" aria-labelledby="passenger-tab">
    <div class="card p-4 show-booking-card">
        <div class="d-flex justify-content-between align-items-center mb-0">
            <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Passenger Details</h5>
            <button class="btn btn-primary no-btn add-no-btn add-bank" type="button" id="passenger-detail-button">
                <i class="ri ri-add-circle-fill pointer"></i>
            </button>
        </div>

        <div class="excel-like-container table-responsive details-table-wrappper details-table-wrappper">
            <table class="passenger-table table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Gender</th>
                        <th>Title</th>
                        <th>First & Middle Name</th>
                        <th>Last Name</th>
                        <th>DOB</th>
                        <th>Seat</th>
                        <th>Credit/Refund Amt.</th>
                        <th>E-Ticket</th>
                        <th id="room-category-column" style="display:none">Room Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="passengerForms">
                    @foreach ($booking->passengers as $key => $passengers)
                        <tr class="passenger-form" data-index="{{ $key }}">
                            <td>
                                <span class="billing-card-title"> {{ $key + 1 }}</span>
                            </td>
                            <input type="hidden" name="passenger[{{ $key }}][booking_id]"
                                value="{{ $passengers->booking_id }}" />
                            <td>
                                <select class="form-control" style="width:5.5rem"
                                    name="passenger[{{ $key }}][passenger_type]">
                                    <option value="">Select</option>
                                    <option value="Adult"
                                        {{ $passengers->passenger_type == 'Adult' ? 'selected' : '' }}>
                                        Adult
                                    </option>
                                    <option value="Child"
                                        {{ $passengers->passenger_type == 'Child' ? 'selected' : '' }}>
                                        Child
                                    </option>
                                    <option value="Seat Infant"
                                        {{ $passengers->passenger_type == 'Seat Infant' ? 'selected' : '' }}>Seat
                                        Infant
                                    </option>
                                    <option value="Lap Infant"
                                        {{ $passengers->passenger_type == 'Lap Infant' ? 'selected' : '' }}>Lap
                                        Infant
                                    </option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="width: 70px;"
                                    name="passenger[{{ $key }}][gender]">
                                    <option value="">Select</option>
                                    <option value="Male" {{ $passengers->gender == 'Male' ? 'selected' : '' }}>
                                        Male
                                    </option>
                                    <option value="Female" {{ $passengers->gender == 'Female' ? 'selected' : '' }}>
                                        Female</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="width:70px;"
                                    name="passenger[{{ $key }}][title]">
                                    <option value="">Select</option>
                                    <option value="Mr" {{ $passengers->title == 'Mr' ? 'selected' : '' }}>Mr
                                    </option>
                                    <option value="Mrs" {{ $passengers->title == 'Mrs' ? 'selected' : '' }}>Mrs
                                    </option>
                                    <option value="Ms" {{ $passengers->title == 'Ms' ? 'selected' : '' }}>Ms
                                    </option>
                                    <option value="Master" {{ $passengers->title == 'Master' ? 'selected' : '' }}>
                                        Master
                                    </option>
                                    <option value="Miss" {{ $passengers->title == 'Miss' ? 'selected' : '' }}>Miss
                                    </option>
                                </select>
                            </td>

                            <td>
                                <input type="text" class="form-control w-100"
                                    name="passenger[{{ $key }}][first_name]"
                                    value="{{ $passengers->first_name }}" placeholder="First Name">
                            </td>

                            <td>
                                <input type="text" class="form-control" style="width: 7.5rem"
                                    name="passenger[{{ $key }}][last_name]"
                                    value="{{ $passengers->last_name }}" placeholder="Last Name">
                            </td>
                            <td>
                                <input type="date" style="width: 105px;" class="form-control"
                                    name="passenger[{{ $key }}][dob]"
                                    value="{{ $passengers->dob?->format('Y-m-d') }}">
                            </td>
                            <td>
                                <input type="text" style="width:50px;" class="form-control"
                                    name="passenger[{{ $key }}][seat_number]"
                                    value="{{ $passengers->seat_number }}" placeholder="Seat">
                            </td>
                            <td>
                                <input type="number" style="width:80px" class="form-control"
                                    name="passenger[{{ $key }}][credit_note_amount]"
                                    value="{{ $passengers->credit_note_amount }}" placeholder="0" step="0.01">
                            </td>
                            <td>
                                <input type="text" class="form-control w-100"
                                    name="passenger[{{ $key }}][e_ticket_number]"
                                    value="{{ $passengers->e_ticket_number }}" placeholder="E Ticket">
                            </td>
                            
                         
                                <td id="cruise_room_category" style="display: none;">
                                    <input type="text" class="form-control w-100 room_category"
                                        name="passenger[{{ $key }}][room_category]"
                                        value="{{ $passengers->room_category }}"
                                        placeholder="Room Category">
                                </td>
                         

                                 <input type="hidden" name="passenger[{{ $key }}][id]"
                                                    value="{{ $passengers->id }}">

                            <td>
                                <button type="button" class="btn btn-sm btn-outline-danger delete-passenger">
                                    <i class="icon-base ri ri-delete-bin-2-line"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<!------------------------------------End Passeenger------------------------------------------------------>
