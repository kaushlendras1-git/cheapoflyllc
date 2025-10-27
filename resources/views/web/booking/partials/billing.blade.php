@if (auth()->user()->department_id == 5)
    <div class="tab-pane show active" id="billing" role="tabpanel" aria-labelledby="billing-tab">
    @else
    <div class="tab-pane fade" id="billing" role="tabpanel" aria-labelledby="billing-tab">
@endif



        @if (auth()->user()->department_id != 5 )
            <div class="card p-4 show-booking-card">
                <div class="d-flex justify-content-between align-items-center add-bank">
                    <h5 class="card-header border-0 p-0 detail-passanger">Billing Details</h5>
                    <i data-bs-toggle="modal" data-bs-target="#exampleModal" class="ri ri-add-circle-fill pointer"></i>
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

                            @foreach ($billingData as $key => $bill)
                                <tr>
                                    <td>Billing No. {{ $key + 1 }}</td>
                                    <td> @if(auth()->user()->role_id == 1 && $booking->payment_status_id >= 7) 
                                            {{ substr($bill->email, 0, 1) . '***@' . explode('@', $bill->email)[1] }}
                                        @else
                                              {{ $bill->email }}
                                        @endif                                      
                                    </td>
                                    
                                    <td>  @if(auth()->user()->role_id == 1 && $booking->payment_status_id >= 7) 
                                             {{ substr($bill->contact_number, 0, 2) . '******' . substr($bill->contact_number, -2) }}
                                        @else
                                             {{ $bill->contact_number }}
                                        @endif  
                                    </td>
                                    <td>{{ $bill->street_address }}</td>
                                    <td>{{ $bill->city }}</td>
                                    <td>{{ $bill->get_state->name ?? '' }}</td>
                                    <td>{{ $bill->zip_code }}</td>
                                    <td>{{ $bill->get_country->country_name ?? '' }}</td>
                                    <td class="text-center">
                                        <button data-href="{{ route('booking.billing-details.edit', $bill->id) }}"
                                            class="btn btn-outline-primary editBillData me-2"  {{ $disabled }} >
                                            <i class="ri ri-edit-line"></i>
                                        </button>
                                        <button data-href="{{ route('booking.billing-details.destroy', ['id' => $bill->id]) }}"
                                            class="btn btn-outline-danger deleteBillData" {{ $disabled }} >
                                            <i class="ri ri-delete-bin-line"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card p-4 mt-4 show-booking-card">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-header border-0 p-0 detail-passanger">Card Details <span style="color:red"> (Billing Details
                            must be entered before adding Card Details.) </span> </h5>
                    <button class="btn btn-primary no-btn add-no-btn add-bank" type="button" id="billing-booking-button">
                        <i class="ri ri-add-circle-fill pointer"></i>
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

                                    @foreach ($booking->billingDetails as $key => $billingDetails)
                                        <tr class="billing-card" data-index="{{ $key }}">
                                            <td>
                                                <h6 class="billing-card-title mb-0"> {{ $key + 1 }}</h6>
                                            </td>
                                            <td>
                                                <select class="form-control w-100"
                                                    name="billing[{{ $key }}][card_type]"  {{ $disabled }} >
                                                    <option value="">Select</option>
                                                    <option value="VISA"
                                                        {{ $billingDetails['card_type'] == 'VISA' ? 'selected' : '' }}>
                                                        VISA
                                                    </option>
                                                    <option value="Mastercard"
                                                        {{ $billingDetails['card_type'] == 'Mastercard' ? 'selected' : '' }}>
                                                        Mastercard</option>
                                                    <option value="AMEX"
                                                        {{ $billingDetails['card_type'] == 'AMEX' ? 'selected' : '' }}>
                                                        AMEX
                                                    </option>
                                                    <option value="DISCOVER"
                                                        {{ $billingDetails['card_type'] == 'DISCOVER' ? 'selected' : '' }}>
                                                        DISCOVER</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" maxlength="16" pattern="[0-9]*" inputmode="numeric" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" class="form-control cc-number-input"
                                                    style="width: 140px;" placeholder="CC Number"
                                                    name="billing[{{ $key }}][cc_number]"
                                                    value="{{ $billingDetails['cc_number'] }}"
                                                    data-original="{{ $billingDetails['cc_number'] }}"
                                                    onfocus="showFullNumber(this)" onblur="maskNumber(this)"  {{ $disabled }} >
                                            </td>


                                            <td><input type="text" class="form-control w-100 cc_holder_name"
                                                    placeholder="CC Holder Name"
                                                    name="billing[{{ $key }}][cc_holder_name]"
                                                     value="{{ (auth()->user()->role_id == 1 && $booking->payment_status_id >= 7) ? (strlen($billingDetails['cc_holder_name']) > 2 ? substr($billingDetails['cc_holder_name'], 0, 2) . 'xxx' : $billingDetails['cc_holder_name']) : $billingDetails['cc_holder_name'] }}"
                                                     {{ $disabled }} 
                                                >
                                            </td>

                                            <td>
                                                <select style="margin: auto;" class="form-control w-100"
                                                    name="billing[{{ $key }}][exp_month]"  {{ $disabled }} >
                                                    <option value="">MM</option>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <option value="{{ sprintf('%02d', $i) }}"
                                                            {{ $billingDetails['exp_month'] == sprintf('%02d', $i) ? 'selected' : '' }}>
                                                            {{ sprintf('%02d', $i) }}</option>
                                                    @endfor
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control w-100"
                                                    name="billing[{{ $key }}][exp_year]"  {{ $disabled }} >
                                                    <option value="">YYYY</option>
                                                    @for ($i = 2024; $i <= 2034; $i++)
                                                        <option value="{{ $i }}"
                                                            {{ $billingDetails['exp_year'] == $i ? 'selected' : '' }}>
                                                            {{ (auth()->user()->role_id == 1 && $booking->payment_status_id >= 7) ? '20xx' : $i }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </td>


                                            <td><input style="width: 57px !important;" inputmode="numeric" maxlength="4"
                                                    oninput="this.value = this.value.replace(/\D/g, '').slice(0,5)"
                                                    class="form-control w-100" placeholder="CVV"
                                                    name="billing[{{ $key }}][cvv]"
                                                    value="{{ (auth()->user()->role_id == 1 && $booking->payment_status_id >= 7) ? $billingDetails['cvv'] : $billingDetails['cvv'] }}"  {{ $disabled }} >
                                            </td>


                                            </select>
                                            </td>
                                            <td>
                                                <select id="state-{{ $key }}" class="form-control state-select"
                                                    style="width:7.5rem" name="billing[{{ $key }}][state]"  {{ $disabled }} >
                                                <option value="">Select Billing</option>
                                                @foreach ($billingData as $biKey => $bi)
                                                    <option value="{{ $bi->id }}"
                                                        {{ $bi->id == $billingDetails['state'] ? 'selected' : '' }}>Billing
                                                        No.{{ $biKey + 1 }}</option>
                                                @endforeach
                                            </select>                                    </td>

                                            <td><input style="width: 65px; !important;" type="text"
                                                    class="form-control usdAmount" placeholder=""
                                                    name="billing[{{ $key }}][authorized_amt]"
                                                    value="{{ $billingDetails['authorized_amt'] }}"  {{ $disabled }} >
                                            </td>

                                            <td>
                                                <select class="form-control w-100 currencyField"
                                                    name="billing[{{ $key }}][currency]"  {{ $disabled }} >
                                                    <option value="">Select</option>
                                                    <option value="USD"
                                                        {{ $billingDetails['currency'] == 'USD' ? 'selected' : '' }}>USD
                                                    </option>
                                                    <option value="CAD"
                                                        {{ $billingDetails['currency'] == 'CAD' ? 'selected' : '' }}>CAD
                                                    </option>
                                                    <option value="EUR"
                                                        {{ $billingDetails['currency'] == 'EUR' ? 'selected' : '' }}>EUR
                                                    </option>
                                                    <option value="GBP"
                                                        {{ $billingDetails['currency'] == 'GBP' ? 'selected' : '' }}>GBP
                                                    </option>
                                                    <option value="AUD"
                                                        {{ $billingDetails['currency'] == 'AUD' ? 'selected' : '' }}>AUD
                                                    </option>
                                                    <option value="INR"
                                                        {{ $billingDetails['currency'] == 'INR' ? 'selected' : '' }}>INR
                                                    </option>
                                                    <option value="MXN"
                                                        {{ $billingDetails['currency'] == 'MXN' ? 'selected' : '' }}>MXN
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <span class="textAmount">{{ $billingDetails['amount'] }}</span>
                                                <input value="{{ $billingDetails['amount'] ?? 0 }}"
                                                    name="billing[{{ $key }}][amount]" class="finalAmount"
                                                    type="hidden"  {{ $disabled }} />
                                            </td>


                                            <input type="hidden" name="billing[{{ $key }}][id]"
                                                            value="{{ $billingDetails->id }}" >


                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            <div class="card p-4 mt-4" id="deposit-pending-payment">
                <div class="row g-3 align-items-center">
                    <div class="col-md-12 table-responsive details-table-wrappper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Total Amount</th>
                                    <th>Deposit Amount</th>
                                    <th>Pending Amount</th>
                                    <th>Due Date</th>
                                </tr>
                            </thead>
                            <tr data-payment="car" class="{{isset($booking->card_details_json['Car'])?'':'d-none'}}" id="car-deposit-billing">
                                <td>
                                    Car
                                    <input type="hidden" name="deposit_type[]" value="Car" />
                                </td>
                                <td>
                                    <input type="text" name="total_amount[]" class="form-control"
                                        value="{{!empty($booking->card_details_json['Car'])?$booking->card_details_json['Car']['total_amount']:''}}" />
                                </td>
                                <td>
                                    <input type="text" name="deposit_amount[]" class="form-control"
                                        value="{{!empty($booking->card_details_json['Car'])?$booking->card_details_json['Car']['deposit_amount']:''}}" />
                                </td>
                                <td>
                                    <input type="text" name="pending_amount[]" class="form-control"
                                        value="{{!empty($booking->card_details_json['Car'])?$booking->card_details_json['Car']['pending_amount']:''}}" />
                                </td>
                                <td>
                                    <input type="date" name="due_date[]" class="form-control"
                                        value="{{!empty($booking->card_details_json['Car'])?$booking->card_details_json['Car']['due_date']:''}}" />
                                </td>
                            </tr>

                            <tr data-payment="cruise" class="{{isset($booking->card_details_json['Cruise'])?'':'d-none'}}" id="cruise-deposit-billing">
                                <td>
                                    Cruise
                                    <input type="hidden" name="deposit_type[]" value="Cruise" />
                                </td>
                                <td>
                                    <input type="text" name="total_amount[]" class="form-control"
                                        value="{{!empty($booking->card_details_json['Cruise'])?$booking->card_details_json['Cruise']['total_amount']:''}}" />
                                </td>
                                <td>
                                    <input type="text" name="deposit_amount[]" class="form-control"
                                        value="{{!empty($booking->card_details_json['Cruise'])?$booking->card_details_json['Cruise']['deposit_amount']:''}}" />
                                </td>
                                <td>
                                    <input type="text" name="pending_amount[]" class="form-control"
                                        value="{{!empty($booking->card_details_json['Cruise'])?$booking->card_details_json['Cruise']['pending_amount']:''}}" />
                                </td>
                                <td>
                                    <input type="date" name="due_date[]" class="form-control"
                                        value="{{!empty($booking->card_details_json['Cruise'])?$booking->card_details_json['Cruise']['due_date']:''}}" />
                                </td>
                            </tr>

                            <tr data-payment="hotel" class="{{isset($booking->card_details_json['Hotel'])?'':'d-none'}}" id="hotel-deposit-billing">
                                <td>
                                    Hotel
                                    <input type="hidden" name="deposit_type[]" value="Hotel" />
                                </td>
                                <td>
                                    <input type="text" name="total_amount[]" class="form-control"
                                        value="{{!empty($booking->card_details_json['Hotel'])?$booking->card_details_json['Hotel']['total_amount']:''}}" />
                                </td>
                                <td>
                                    <input type="text" name="deposit_amount[]" class="form-control"
                                        value="{{!empty($booking->card_details_json['Hotel'])?$booking->card_details_json['Hotel']['deposit_amount']:''}}" />
                                </td>
                                <td>
                                    <input type="text" name="pending_amount[]" class="form-control"
                                        value="{{!empty($booking->card_details_json['Hotel'])?$booking->card_details_json['Hotel']['pending_amount']:''}}" />
                                </td>
                                <td>
                                    <input type="date" name="due_date[]" class="form-control"
                                        value="{{!empty($booking->card_details_json['Hotel'])?$booking->card_details_json['Hotel']['due_date']:''}}" />
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

<script>
function maskNumber(input) {
    const original = input.getAttribute('data-original');
    if (original && original.length > 4) {
        const lastFour = original.slice(-4);
        const maskedPart = 'x'.repeat(original.length - 4);
        input.value = maskedPart + lastFour;
    }
}

function showFullNumber(input) {
    const original = input.getAttribute('data-original');
    // if (original) {
    //     input.value = original;
    // }
}

// Initialize masking on page load
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.cc-number-input').forEach(input => {
        if (input.value) {
            input.setAttribute('data-original', input.value);
            maskNumber(input);
        }
    });
});

// Before form submission, restore original values
document.getElementById('bookingForm').addEventListener('submit', function() {
    document.querySelectorAll('.cc-number-input').forEach(input => {
        const original = input.getAttribute('data-original');
        if (original) {
            input.value = original;
        }
    });
});


</script>

        @else

            <div class="card mt-2">
                <div class="payment-form">
                    <h2 class="card-header border-0 p-0 detail-passanger card_bil-head">Transation Details</h2>

                    <h4 class="merchant-name mb-0">Merchent -
                        @if ($booking->selected_company == 1)
                            Fly Dreamz
                        @elseif($booking->selected_company == 2)
                            Fare Tickets LLC
                        @elseif($booking->selected_company == 3)
                            Fare Ticketsus
                        @elseif($booking->selected_company == 4)
                            Cruise Line Service
                        @endif
                    </h4>
                    <div class="row mt-4">
                        @foreach ($booking->billingDetails as $key => $billingDetails)
                            @php
                                $card_billing_data = \App\Models\BillingDetail::with(
                                    'get_country:id,country_name',
                                )->find($billingDetails['state']);
                            @endphp
                            <div class="col-md-3">
                                <div class="card-partisal">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h5 class="no-card mb-0">Card {{ $key + 1 }} <span style="color: #ff0000;">(MCO =
                                                ${{ $billingDetails['authorized_amt'] }})</span></h5>
                                        <form method="POST" action="{{ route('booking.update-payment-status') }}" style="margin: 0;">
                                            @csrf
                                            <input type="hidden" name="billing_id" value="{{ $billingDetails->id }}">
                                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                            <input type="hidden" name="card_type" value="{{ $billingDetails['card_type'] }}">
                                            <input type="hidden" name="cc_holder" value="{{ $billingDetails['cc_holder_name'] }}">
                                            <input type="hidden" name="cc_number" value="{{ $billingDetails['cc_number'] }}">
                                            <input type="hidden" name="exp_month" value="{{ $billingDetails['exp_month'] }}">
                                            <input type="hidden" name="exp_year" value="{{ $billingDetails['exp_year'] }}">
                                            <input type="hidden" name="billing_email" value="{{ $card_billing_data->email ?? '' }}">
                                            <input type="hidden" name="billing_mobile" value="{{ $card_billing_data->contact_number ?? '' }}">
                                            <input type="hidden" name="billing_street" value="{{ $card_billing_data->street_address ?? '' }}">
                                            <input type="hidden" name="billing_city" value="{{ $card_billing_data->city ?? '' }}">
                                            <input type="hidden" name="billing_state" value="{{ $card_billing_data->get_state->name ?? '' }}">
                                            <input type="hidden" name="billing_zip" value="{{ $card_billing_data->zip_code ?? '' }}">
                                            <input type="hidden" name="billing_country" value="{{ $card_billing_data->get_country->country_name ?? '' }}">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" 
                                                    name="is_paid" value="1" id="billing-card-{{ $billingDetails->id }}"
                                                    {{ $billingDetails->is_paid == 1 ? 'checked' : '' }}
                                                    onchange="this.form.submit()">
                                                <label class="form-check-label text-dark" for="billing-card-{{ $billingDetails->id }}">Paid</label>
                                            </div>
                                        </form>
                                    </div>
                                    
                                    <div class="detail_namer">
                                        <p>Card Type: <span>{{ $billingDetails['card_type'] }}</span></p>
                                        <p>Cardholder Name: <span>{{ $billingDetails['cc_holder_name'] }}</span></p>
                                        <p>Card Number: <span>{{ $billingDetails['cc_number'] }}</span></p>
                                        <p>Expiry Date:
                                            <span>{{ $billingDetails['exp_month'] }}/{{ $billingDetails['exp_year'] }}</span>
                                        </p>
                                        <p>CVV: <span>{{ $billingDetails['cvv'] }}</span></p>
                                    </div>
                                    <h4 class="bill-add mb-4">Billing Address</h4>
                                    <div class="detail_namer">
                                        <p>Email: <span>{{ $card_billing_data->email ?? '' }}</span></p>
                                        <p>Mobile: <span>{{ $card_billing_data->contact_number ?? '' }}</span></p>
                                        <p>Street Address: <span>{{ $card_billing_data->street_address ?? '' }}</span></p>
                                        <p>City: <span>  {{ $card_billing_data->city ?? '' }}</span></p>
                                        <p>State: <span>  {{ $card_billing_data->get_state->name ?? '' }} </span></p>
                                        <p>Zip Code: <span> {{ $card_billing_data->zip_code ?? '' }}</span></p>
                                        <p>Country <span> {{ $card_billing_data->get_country->country_name ?? '' }}</span></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

                @if(1 !== 1)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Merchant</th>
                                    <th>MCO</th>
                                    <th>Card Type</th>
                                    <th>Cardholder Name</th>
                                    <th>Card Number</th>
                                    <th>Expiry Date</th>
                                    <th>CVV</th>
                                    <th>Billing Address</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking->billingDetails as $key => $billingDetails)
                                    @php
                                        $card_billing_data = \App\Models\BillingDetail::with(
                                            'get_country:id,country_name',
                                        )->find($billingDetails['state']);
                                        $merchant = '';
                                        if ($booking->selected_company == 1) $merchant = 'Fly Dreamz';
                                        elseif ($booking->selected_company == 2) $merchant = 'Fare Tickets LLC';
                                        elseif ($booking->selected_company == 3) $merchant = 'Fare Ticketsus';
                                        elseif ($booking->selected_company == 4) $merchant = 'Cruise Line Service';
                                    @endphp
                                    <tr>
                                        <td>{{ $merchant }}</td>
                                        <td>${{ $billingDetails['authorized_amt'] }}</td>
                                        <td>{{ $billingDetails['card_type'] }}</td>
                                        <td>{{ $billingDetails['cc_holder_name'] }}</td>
                                        <td>****{{ substr($billingDetails['cc_number'], -4) }}</td>
                                        <td>{{ $billingDetails['exp_month'] }}/{{ $billingDetails['exp_year'] }}</td>
                                        <td>{{ $billingDetails['cvv'] }}</td>
                                        <td>{{ $card_billing_data->street_address ?? '' }}, {{ $card_billing_data->city ?? '' }}, {{ $card_billing_data->get_state->name ?? '' }} {{ $card_billing_data->zip_code ?? '' }}, {{ $card_billing_data->get_country->country_name ?? '' }}</td>
                                       
                                        <td>{{ $card_billing_data->email ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
              @endif         


</div>

