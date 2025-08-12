@if(auth()->user()->role === 'billing')
<div class="tab-pane show active" id="billing" role="tabpanel" aria-labelledby="billing-tab">
@else    
<div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
@endif
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
                                    <td>Card No. {{$key+1}}</td>
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
                        <h5 class="card-header border-0 p-0 detail-passanger">Card Details </h5>
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
                                                <select class="form-control w-100"
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
                                            <td><input inputmode="numeric" maxlength="16"
                                                    class="form-control w-100" placeholder="CC Number"
                                                    name="billing[{{$key}}][cc_number]"
                                                   value="{{$billingDetails['cc_number']}}"></td>


                                                    <td><input type="text" class="form-control w-100" placeholder="CC Holder Name"
                                                    name="billing[{{$key}}][cc_holder_name]"
                                                    value="{{$billingDetails['cc_holder_name']}}"></td>
                                            <td>
                                                <select style="margin: auto;" class="form-control w-100"
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
                                                <select class="form-control w-100" name="billing[{{$key}}][exp_year]">
                                                    <option value="">YYYY</option>
                                                    @for($i = 2024; $i <= 2034; $i++) <option value="{{$i}}"
                                                        {{$billingDetails['exp_year'] == $i ? 'selected' : ''}}>{{$i}}
                                                        </option>
                                                        @endfor
                                                </select>
                                            </td>


                                            <td><input style="width: 57px !important;" inputmode="numeric" maxlength="4"
                                                    oninput="this.value = this.value.replace(/\D/g, '').slice(0,5)"
                                                    class="form-control w-100" placeholder="CVV" name="billing[{{$key}}][cvv]"
                                                    value="{{$billingDetails['cvv']}}">
                                            </td>


                                            </select>
                                            </td>
                                            <td>
                                                <select id="state-{{$key}}"
                                                    class="form-control state-select w-100" name="billing[{{$key}}][address]">
                                                    <option value="">Select Billing</option>
                                                    @foreach($billingData as $biKey=>$bi)
                                                        <option value="{{$bi->id}}" {{$bi->id == $billingDetails['address']?'selected':''}}>Card No.{{$biKey+1}}</option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td><input style="width: 65px; !important;" type="text" class="form-control usdAmount"
                                                    placeholder="" name="billing[{{$key}}][authorized_amt]"
                                                    value="{{$billingDetails['authorized_amt']}}">
                                            </td>

                                            <td>
                                                <select class="form-control w-100 currencyField" name="billing[{{$key}}][currency]">
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
                                            <td>
                                                <span class="textAmount">{{$billingDetails['amount']}}</span>
                                                <input value="{{$billingDetails['amount']??0}}" name="billing[{{$key}}][amount]" class="finalAmount" type="hidden" />
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
                <div class="card mt-2 p-1">
                    <div class="payment-form">
    <h2>Payment Details</h2>

    <H1>Merchent - flydreamz</H1>


    <h2>Card 1</h2>

<h3>    MCO  = $521</h3>

    <div class="form-group">
        <label>Cardholder Name</label>
        <input type="text" placeholder="John Doe">
    </div>
    <div class="form-group">
        <label>Card Number</label>
        <input type="text" placeholder="1234 5678 9012 3456">
    </div>
    <div class="row">
        <div class="form-group">
            <label>Expiry Date</label>
            <input type="text" placeholder="MM/YY">
        </div>
        <div class="form-group">
            <label>CVV</label>
            <input type="password" placeholder="123">
        </div>
    </div>

    <h2>Billing Address</h2>
    <div class="form-group">
        <label>Street Address</label>
        <input type="text" placeholder="123 Main Street">
    </div>
    <div class="form-group">
        <label>City</label>
        <input type="text" placeholder="New York">
    </div>
    <div class="row">
        <div class="form-group">
            <label>State</label>
            <input type="text" placeholder="NY">
        </div>
        <div class="form-group">
            <label>Zip Code</label>
            <input type="text" placeholder="10001">
        </div>
    </div>
    <div class="form-group">
        <label>Country</label>
        <select>
            <option>United States</option>
            <option>Canada</option>
            <option>United Kingdom</option>
        </select>
    </div>

</div>

<hr>
<h2>Card 2</h2>
<h3>    MCO  = $321</h3>

<div class="form-group">
        <label>Cardholder Name</label>
        <input type="text" placeholder="John Doe">
    </div>
    <div class="form-group">
        <label>Card Number</label>
        <input type="text" placeholder="1234 5678 9012 3456">
    </div>
    <div class="row">
        <div class="form-group">
            <label>Expiry Date</label>
            <input type="text" placeholder="MM/YY">
        </div>
        <div class="form-group">
            <label>CVV</label>
            <input type="password" placeholder="123">
        </div>
    </div>

    <h2>Billing Address</h2>
    <div class="form-group">
        <label>Street Address</label>
        <input type="text" placeholder="123 Main Street">
    </div>
    <div class="form-group">
        <label>City</label>
        <input type="text" placeholder="New York">
    </div>
    <div class="row">
        <div class="form-group">
            <label>State</label>
            <input type="text" placeholder="NY">
        </div>
        <div class="form-group">
            <label>Zip Code</label>
            <input type="text" placeholder="10001">
        </div>
    </div>
    <div class="form-group">
        <label>Country</label>
        <select>
            <option>United States</option>
            <option>Canada</option>
            <option>United Kingdom</option>
        </select>
    </div>


<hr>

    <h2>Card 3</h2>
<h3>    MCO  = $921</h3>

<div class="form-group">
        <label>Cardholder Name</label>
        <input type="text" placeholder="John Doe">
    </div>
    <div class="form-group">
        <label>Card Number</label>
        <input type="text" placeholder="1234 5678 9012 3456">
    </div>
    <div class="row">
        <div class="form-group">
            <label>Expiry Date</label>
            <input type="text" placeholder="MM/YY">
        </div>
        <div class="form-group">
            <label>CVV</label>
            <input type="password" placeholder="123">
        </div>
    </div>

    <h2>Billing Address</h2>
    <div class="form-group">
        <label>Street Address</label>
        <input type="text" placeholder="123 Main Street">
    </div>
    <div class="form-group">
        <label>City</label>
        <input type="text" placeholder="New York">
    </div>
    <div class="row">
        <div class="form-group">
            <label>State</label>
            <input type="text" placeholder="NY">
        </div>
        <div class="form-group">
            <label>Zip Code</label>
            <input type="text" placeholder="10001">
        </div>
    </div>
    <div class="form-group">
        <label>Country</label>
        <select>
            <option>United States</option>
            <option>Canada</option>
            <option>United Kingdom</option>
        </select>
    </div>
                </div>
            </div>

            



