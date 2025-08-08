<div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
                <div class="card p-4 show-booking-card">
                    <div class="d-flex justify-content-between align-items-center add-bank">
                        <h5 class="card-header border-0 p-0 detail-passanger">Billing Details</h5>
                        <i data-bs-toggle="modal" data-bs-target="#exampleModal"
                            class="ri ri-add-circle-fill pointer"></i>
                    </div>
                    <div class="details-table-wrappper" id="billing-table-container">
                        <table id="billing-table" class="mb-3 billing_detalis_table" border="1" cellpadding="8" cellspacing="0"
                            style="border-collapse: collapse; text-align: center; width: 100%;">
                            <thead style="background-color: #f2f2f2;">
                                <tr>
                                    <th>S.No</th>
                                    <th>Email</th>
                                    <th>Contact No.</th>
                                    <th>Street Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zip code</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($billingData as $key=>$bill)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$bill->email}}</td>
                                    <td>{{$bill->contact_number}}</td>
                                    <td>{{$bill->street_address}}</td>
                                    <td>{{$bill->city}}</td>
                                    <td>{{$bill->state}}</td>
                                    <td>{{$bill->zip_code}}</td>
                                    <td>{{$bill->country}}</td>
                                    <td class="text-center">
                                            <button data-href="{{ route('booking.billing-details.destroy', ['id' => $bill->id]) }}" class="btn btn-outline-danger deleteBillData">
                                                    <i class="ri ri-delete-bin-line"></i> </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
                <div class="card p-4 mt-4 show-booking-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-header border-0 p-0 detail-passanger">Card Details $1052</h5>
                        <button class="btn btn-primary no-btn add-no-btn add-bank" type="button" id="billing-booking-button">
                            <i  class="ri ri-add-circle-fill pointer"></i>
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-12 table-responsive details-table-wrappper">
                                <table id="billingTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Card Type</th>
                                            <th>CC Number</th>
                                            <th>CC Holder Name</th>
                                            <th>Exp Month</th>
                                            <th>Exp Year</th>
                                            <th>CVV</th>
                                            <th>Billing </th>
                                            <th>Authorized Amt.<br> (USD)</th>
                                            <th>Currency</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="billingForms">

                                        @foreach($booking->billingDetails as $key => $billingDetails)
                                        <tr class="billing-card" data-index="{{$key}}">
                                            <td>
                                                <h6 class="billing-card-title mb-0"> {{$key + 1}}</h6>
                                            </td>
                                            <td>
                                                <select class="form-control" style="width: 90px;"
                                                    name="billing[{{$key}}][card_type]">
                                                    <option value="">Select</option>
                                                    <option value="VISA"
                                                        {{$billingDetails['card_type'] == 'VISA' ? 'selected' : ''}}>
                                                        VISA
                                                    </option>
                                                    <option value="Mastercard"
                                                        {{$billingDetails['card_type'] == 'Mastercard' ? 'selected' : ''}}>
                                                        Mastercard</option>
                                                    <option value="AMEX"
                                                        {{$billingDetails['card_type'] == 'AMEX' ? 'selected' : ''}}>
                                                        AMEX
                                                    </option>
                                                    <option value="DISCOVER"
                                                        {{$billingDetails['card_type'] == 'DISCOVER' ? 'selected' : ''}}>
                                                        DISCOVER</option>
                                                </select>
                                            </td>
                                            <td><input style="width: 140px;" inputmode="numeric" maxlength="16"
                                                    class="form-control" placeholder="CC Number"
                                                    name="billing[{{$key}}][cc_number]"
                                                   value="{{$billingDetails['cc_number']}}"></td>


                                                    <td><input type="text" class="form-control" placeholder="CC Holder Name"
                                                    name="billing[{{$key}}][cc_holder_name]"
                                                    value="{{$billingDetails['cc_holder_name']}}"></td>
                                            <td>
                                                <select style="width: 45px; margin: auto;" class="form-control"
                                                    name="billing[{{$key}}][exp_month]">
                                                    <option value="">MM</option>
                                                    @for($i = 1; $i <= 12; $i++) <option
                                                        value="{{ sprintf('%02d', $i) }}"
                                                        {{$billingDetails['exp_month'] == sprintf('%02d', $i) ? 'selected' : ''}}>
                                                        {{ sprintf('%02d', $i) }}</option>
                                                        @endfor
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="billing[{{$key}}][exp_year]">
                                                    <option value="">YYYY</option>
                                                    @for($i = 2024; $i <= 2034; $i++) <option value="{{$i}}"
                                                        {{$billingDetails['exp_year'] == $i ? 'selected' : ''}}>{{$i}}
                                                        </option>
                                                        @endfor
                                                </select>
                                            </td>


                                            <td><input style="width: 57px;" inputmode="numeric" maxlength="4"
                                                    oninput="this.value = this.value.replace(/\D/g, '').slice(0,5)"
                                                    class="form-control" placeholder="CVV" name="billing[{{$key}}][cvv]"
                                                    value="{{$billingDetails['cvv']}}">
                                            </td>


                                            </select>
                                            </td>
                                            <td>
                                                <select id="state-{{$key}}" style="width:7.5rem"
                                                    class="form-control state-select" name="billing[{{$key}}][address]">
                                                    <option value="">Select Billing</option>
                                                    @foreach($billingData as $bi)
                                                        <option value="{{$bi->id}}" {{$bi->id == $billingDetails['address']?'selected':''}}>{{$bi->street_address}}</option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td><input style="width: 65px;" type="text" class="form-control"
                                                    placeholder="ZIP Code" name="billing[{{$key}}][zip_code]"
                                                    value="{{$billingDetails['zip_code']}}"></td>
                                            <td>
                                                <select class="form-control" name="billing[{{$key}}][currency]">
                                                    <option value="">Select</option>
                                                    <option value="USD"
                                                        {{$billingDetails['currency'] == 'USD' ? 'selected' : ''}}>USD
                                                    </option>
                                                    <option value="CAD"
                                                        {{$billingDetails['currency'] == 'CAD' ? 'selected' : ''}}>CAD
                                                    </option>
                                                    <option value="EUR"
                                                        {{$billingDetails['currency'] == 'EUR' ? 'selected' : ''}}>EUR
                                                    </option>
                                                    <option value="GBP"
                                                        {{$billingDetails['currency'] == 'GBP' ? 'selected' : ''}}>GBP
                                                    </option>
                                                    <option value="AUD"
                                                        {{$billingDetails['currency'] == 'AUD' ? 'selected' : ''}}>AUD
                                                    </option>
                                                    <option value="INR"
                                                        {{$billingDetails['currency'] == 'INR' ? 'selected' : ''}}>INR
                                                    </option>
                                                    <option value="MXN"
                                                        {{$billingDetails['currency'] == 'MXN' ? 'selected' : ''}}>MXN
                                                    </option>
                                                </select>
                                            </td>
                                            <td> AUD<span>90909</span>
                                                <input value="1" name="billing[{{$key}}][amount]" type="hidden" />
                                            </td>

                                            <td>

                                                <button type="button" class="btn btn-outline-danger delete-billing-btn">
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
            </div>



            <!-- Modal -->
<div class="modal fade bank-details" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Bank Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="billing-close-modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('booking.billing-details',['id'=>$booking->id])}}" id="billing-detail-add">
                    @csrf
                    <div class="row booking-form">
                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">Conatct No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="contact_number">
                        </div>
                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">Street Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="street_address">
                        </div>
                        <div class="col-md-3 position-relative mb-5">
                            <label class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="city">
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label">State <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="state">
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label">Zip Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="zip_code">
                        </div>
                        <div class="col-md-3 position-relative">
                            <label class="form-label">Country <span class="text-danger">*</span></label>
                            <select class="form-control" name="country">
                                <option value="">Select country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-start">
                <button type="button" class="btn btn-primary" id="save-billing-detail">Save</button>
            </div>
        </div>
    </div>
</div>