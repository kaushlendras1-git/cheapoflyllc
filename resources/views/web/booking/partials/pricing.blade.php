<div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
    <div class="col-md-12">

        <div class="card p-4 details-table-wrappper show-booking-card">

            <div class="col-md-5 position-relative checkbox-servis" id="pnr-type-section" style="display: none;">
                <!-- <label class="d-block mb-2">PNR Type</label> -->
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pnrtype" id="FXL" value="FXL"
                        {{ $booking->pnrtype == 'FXL' ? 'checked' : '' }} {{ $disabled }} >
                    <label class="form-check-label" for="FXL">FXL</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pnrtype" id="GK" value="GK"
                        {{ $booking->pnrtype == 'GK' ? 'checked' : '' }}  >
                    <label class="form-check-label" for="GK">GK</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pnrtype" id="HK" value="HK"
                        {{ $booking->pnrtype == 'HK' ? 'checked' : '' }} {{ $disabled }} >
                    <label class="form-check-label" for="HK">HK</label>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const flightCheckbox = document.getElementById('booking-flight');
                    const pnrTypeSection = document.getElementById('pnr-type-section');

                    function togglePnrType() {
                        if (flightCheckbox.checked) {
                            pnrTypeSection.style.display = 'block';
                        } else {
                            pnrTypeSection.style.display = 'none';
                            // Clear radio button selection when hiding
                            document.querySelectorAll('input[name="pnrtype"]').forEach(radio => {
                                radio.checked = false;
                            });
                        }
                    }
                    // Check initial state
                    togglePnrType();
                    
                    // Listen for changes
                    flightCheckbox.addEventListener('change', togglePnrType);
                });
            </script>

        @if(!$disabled)
            <div class="d-flex justify-content-end mb-2">
                <button class="btn btn-primary no-btn add-no-btn add-bank" type="button" id="pricing-booking-button">
                    <i class="ri ri-add-circle-fill pointer"></i>
                </button>
            </div>
        @endif

            <!-- Hidden inputs for gross and net values -->
            <input name="gross_value" type="hidden" id="gross_value" />
            <input name="net_value" type="hidden" id="net_value" />
            
            <table class="pricing-table table">
                <thead>
                    <tr>
                        <td colspan="5" style="border: solid 1px;">
                            <div
                                style="color: #ed9900;display: flex; justify-content: space-between; align-items: center;">
                                <strong>Gross Amount</strong>
                                <span id="total_gross_profit">0.00</span>
                            </div>
                        </td>
                        <td colspan="4">
                            <div
                                style="color: #ed9900;display: flex; justify-content: space-between; align-items: center;">
                                <strong>Net Amount</strong>
                                <span id="total_net_profit">0.00</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Passengers*</th>
                        <th>No. of Pax</th>
                        <th>Price*</th>
                        <th>Total*</th>
                        <th>Price Description</th>
                        <th>Price*</th>
                        <th>Total</th>
                        <th>Cost Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="pricingForms" class="pricing-rows">
                    @if($booking->pricingDetails->isEmpty())
                    <tr class="pricing-row" data-index="0">
                        <td>
                            <select name="pricing[0][passenger_type]" class="form-select form-control passenger_type"
                                id="passenger_type_0" >
                                <option value="">Select</option>
                                <option value="adult">Adult</option>
                                <option value="child">Child</option>
                                <option value="infant_on_lap">Infant on Lap</option>
                                <option value="infant_on_seat">Infant on Seat</option>
                                <option value="Senior">Senior</option>
                            </select>
                        </td>
                        <td><input style="width: 120px" type="number" class="form-control num_passengers"
                                name="pricing[0][num_passengers]" placeholder="No. of Passengers" min="0" value="1">
                        </td>
                        <td><input type="number" class="form-control" name="pricing[0][gross_price]"
                                placeholder="Gross Price" min="0" step="0.01" style="width: 110px;"></td>

                        <td><span class="gross-total">0.002</span></td>
                        <td>
                            <select style="width: 160px;" name="pricing[0][price_description]" class="form-select form-control">
                            <option value="">Select</option>
                            <option data-type="Flight" value="Flight Price Offered">Flight Price Offered</option>
                            <option data-type="Hotel" value="Hotel Price Offered">Hotel Price Offered</option>
                            <option data-type="Car" value="Car Price Offered">Car Price Offered</option>
                            <option data-type="Train" value="Train Price Offered">Train Price Offered</option>
                            <option data-type="Cruise" value="Cruise Price Offered">Cruise Price Offered</option>
                            <option data-type="Cruise" value="Excursions">Excursions</option>
                            <option data-type="Cruise" value="Spa Services">Spa Services</option>
                            <option data-type="Cruise" value="WiFi Packages">WiFi Packages</option>
                            <option data-type="Cruise" value="Crew Appreciation Fees/Gratuities">Crew Appreciation Fees/Gratuities</option>
                            <option data-type="Cruise" value="Shuttle Services">Shuttle Services</option>
                            <option data-type="Cruise" value="Speciality Dining">Speciality Dining</option>
                            <option data-type="Flight,Cruise" value="Drink Packages">Drink Packages</option>
                            <option data-type="Flight,Cruise,Car,Train" value="Trip Insurance">Trip Insurance Price Offered</option>
                            <option data-type="Cruise" value="Check-in Proces Luggage Tags &amp; Sailing Pass">Check-in Proces Luggage Tags &amp; Sailing Pass</option>
                            <option data-type="Flight,Cruise" value="Special Occasion Package">Special Occasion Package</option>
                            <option data-type="Cruise" value="Water Bottle or Distilled Water Package">Water Bottle or Distilled Water Package</option>
                            <option data-type="Flight,Cruise" value="Pet-in Cabin Price Offered">Pet-in Cabin Price Offered</option>
                            <option data-type="Cruise" value="Vacation Packages">Vacation Packages</option>
                            <option data-type="Flight,Cruise" value="Seat Assignment">Seat Assignment</option>
                            <option value="Package Booking">Package Booking</option>         
                            </select>
                        </td>


                        <td><input type="number" style="width: 110px;" class="form-control" name="pricing[0][net_price]"
                                placeholder="Net Price" min="0" step="0.01">
                        </td>
                        <td><span class="net-total">0.00</span></td>
                        <td>
                            <select style="width: 145px;" name="pricing[0][details]"
                                class="form-select form-control detailDropdown" id="details_0">
                                <option value="">Select</option>
                                <option data-grossmco="1" value="Flight Cost">Flight Cost</option>
                                <option data-grossmco="1" value="Hotel Cost">Hotel Cost</option>
                                <option data-grossmco="1" value="Car Rental Cost">Car Rental Cost</option>
                                <option data-grossmco="1" value="Cruise Cost">Cruise Cost</option>
                                <option data-grossmco="1" value="Train Cost">Train Cost</option>
                                <option data-grossmco="1" value="Company card">Company card</option>
                                <option data-grossmco="0" value="Partial Refund">Partial Refund</option>
                                <option data-grossmco="0" value="Full Refund">Full Refund</option>
                                <option data-grossmco="0" value="Chargeback Fee">Chargeback Fee</option>
                                <option data-grossmco="0" value="Partial Chargeback Amt.">Partial Chargeback Amt.</option>
                                <option data-grossmco="0" value="Chargeback Amt.">Chargeback Amt.</option>
                                <option data-grossmco="1" data-cruise="1" value="Excursions">Excursions</option>
                                <option data-grossmco="1" data-cruise="1" value="Spa Services">Spa Services</option>
                                <option data-grossmco="1" data-cruise="1" value="WiFi Packages">WiFi Packages</option>
                                <option data-grossmco="1" data-cruise="1" value="Crew Appreciation Fees/Gratuities">Crew Appreciation Fees/Gratuities</option>
                                <option data-grossmco="1" data-cruise="1" value="Shuttle Services">Shuttle Services</option>
                                <option data-grossmco="1" data-cruise="1" value="Speciality Dining">Speciality Dining</option>
                                <option data-grossmco="1" data-cruise="1" value="Drink Packages">Drink Packages</option>
                                <option data-grossmco="1" data-cruise="1" value="Trip Insurance">Trip Insurance</option>
                                <option data-grossmco="1" data-cruise="1" value="Check-in Proces Luggage Tags & Sailing Pass">Check-in Proces Luggage Tags & Sailing Pass</option>
                                <option data-grossmco="1" data-cruise="1" value="Special Occasion Package">Special Occasion Package</option>
                                <option data-grossmco="1" data-cruise="1" value="Water Bottle or Distilled Water Package">Water Bottle or Distilled Water Package</option>
                                <option data-grossmco="1" data-cruise="1" value="Old Itinerary">Old Itinerary</option>
                                <option data-grossmco="1" data-cruise="1" value="Changed Itinerary">Changed Itinerary</option>

                            </select>
                        </td>
                        
                        <td>
                            <button type="button" class="btn btn-outline-danger delete-pricing-btn">
                                <i class="ri ri-delete-bin-line"></i>
                            </button>
                        </td>
                    </tr>
                    @endif

                    @php
                    $mechantfee = 0.00;
                    @endphp
                   
                    @foreach($booking->pricingDetails as $key=>$pricingDetails)
                            @if($pricingDetails->details === 'FXL Issuance Fees')
                                <tr class="pricing-row fxlRow" data-index="{{$key}}">
                                    <td>
                                        <select class="form-control passenger_type" name="pricing[{{$key}}][passenger_type]"
                                            id="passenger_type_{{$key}}" disabled >
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" style="width: 120px" class="form-control num_passengers"
                                            name="pricing[{{$key}}][num_passengers]" value="{{$pricingDetails->num_passengers}}"
                                            placeholder="No. of Passengers" min="0" disabled >
                                    </td>

                                    <td><input type="number" style="width: 100px" class="form-control"
                                            name="pricing[{{$key}}][gross_price]" value="{{$pricingDetails->gross_price}}"
                                            placeholder="Gross Price" min="0" step="0.01" disabled ></td>

                                    <td>
                                        <span class="gross-total">0.00</span>
                                    </td>
                                    <td>FXL Issuance Fees</td>
                                    <td>
                                        <input type="number" style="width: 110px;" class="form-control"
                                            name="pricing[{{$key}}][net_price]" value="{{$pricingDetails->net_price}}"
                                            placeholder="Net Price" min="0" step="0.01" disabled >
                                    </td>
                                    <td><span class="net-total">{{$pricingDetails->net_price}}</span></td>
                                    <td>
                                        <select class="form-control detailDropdown" style="width: 145px;"
                                            name="pricing[{{$key}}][details]" id="details_{{$key}}">
                                            <option data-grossmco="1" value="FXL Issuance Fees"
                                                {{ $pricingDetails->details == 'FXL Issuance Fees' ? 'selected' : '' }}>FXL Issuance
                                                Fees</option>
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            @elseif($pricingDetails->details === 'Issuance Fees - Voyzant')
                                <tr class="pricing-row hkRow" data-index="{{$key}}">
                                    <td>
                                        <select class="form-control passenger_type" name="pricing[{{$key}}][passenger_type]"
                                            id="passenger_type_{{$key}}">
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" style="width: 120px" class="form-control num_passengers"
                                            name="pricing[{{$key}}][num_passengers]" value="{{$pricingDetails->num_passengers}}"
                                            placeholder="No. of Passengers" min="0">
                                    </td>

                                    <td><input type="number" style="width: 100px" class="form-control"
                                            name="pricing[{{$key}}][gross_price]" value="{{$pricingDetails->gross_price}}"
                                            placeholder="Gross Price" min="0" step="0.01"></td>

                                    <td>
                                        <span class="gross-total">0.00</span>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="number" style="width: 110px;" class="form-control"
                                            name="pricing[{{$key}}][net_price]" value="{{$pricingDetails->net_price}}"
                                            placeholder="Net Price" min="0" step="0.01">
                                    </td>
                                    <td><span class="net-total">{{$pricingDetails->net_price}}</span></td>
                                    <td>
                                        <select class="form-control detailDropdown" style="width: 145px;"
                                            name="pricing[{{$key}}][details]" id="details_{{$key}}">
                                            <option data-grossmco="1" value="Issuance Fees - Voyzant"
                                                {{ $pricingDetails->details == 'Issuance Fees - Voyzant' ? 'selected' : '' }}>
                                                Issuance Fees - Voyzant</option>
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            @else
                                <tr class="pricing-row" data-index="{{$key}}">
                                    <td>
                                        <select class="form-control passenger_type" name="pricing[{{$key}}][passenger_type]"
                                            id="passenger_type_{{$key}}"  {{ $disabled }} >
                                            <option value="">Select</option>
                                            <option value="adult" {{$pricingDetails->passenger_type=='adult'?'selected':''}}>Adult
                                            </option>
                                            <option value="child" {{$pricingDetails->passenger_type=='child'?'selected':''}}>Child
                                            </option>

                                            <option value="infant" {{$pricingDetails->passenger_type=='infant'?'selected':''}}>
                                                Infant
                                            </option>

                                            <option value="infant_on_lap"
                                                {{$pricingDetails->passenger_type=='infant_on_lap'?'selected':''}}>
                                                Infant on Lap</option>

                                            <option value="infant_on_seat"
                                                {{$pricingDetails->passenger_type=='infant_on_seat'?'selected':''}}>
                                                Infant
                                                on Seat</option>

                                                <option value="infant_on_seat"
                                                {{$pricingDetails->passenger_type=='Pet-in Cargo'?'selected':''}}>
                                                Pet-in Cargo</option>

                                                <option value="infant_on_seat"
                                                {{$pricingDetails->passenger_type=='Pet-in Cabin'?'selected':''}}>
                                                Pet-in Cabin</option>


                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" style="width: 120px" class="form-control num_passengers"
                                            name="pricing[{{$key}}][num_passengers]" value="{{$pricingDetails->num_passengers}}"
                                            placeholder="No. of Passengers" min="0"  {{ $disabled }} >
                                    </td>

                                    <td><input type="number" style="width: 100px" class="form-control"
                                            name="pricing[{{$key}}][gross_price]" value="{{$pricingDetails->gross_price}}"
                                            placeholder="Gross Price" min="0" step="0.01"  {{ $disabled }} ></td>

                                            

                                    <td>
                                        <span class="gross-total">{{$pricingDetails->gross_price??'0.00'}}</span>
                                    </td>

                                    <td>
                                        <select style="width: 160px;" name="pricing[{{$key}}][price_description]" class="form-select form-control price-description-select" {{ $disabled }} >
                                        <option value="">Select</option>
                                        <option data-type="Flight" value="Flight Price Offered" {{$pricingDetails->price_description=='Flight Price Offered'?'selected':''}} > Flight Price Offered</option>
                                        <option data-type="Hotel" value="Hotel Price Offered" {{$pricingDetails->price_description=='Hotel Price Offered'?'selected':''}} >Hotel Price Offered</option>
                                        <option data-type="Car" value="Car Price Offered" {{$pricingDetails->price_description=='Car Price Offered'?'selected':''}} >Car Price Offered</option>
                                        <option data-type="Cruise" value="Cruise Price Offered" {{$pricingDetails->price_description=='Cruise Price Offered'?'selected':''}} >Cruise Price Offered</option>
                                        <option data-type="Train" value="Train Price Offered" {{$pricingDetails->price_description=='Train Price Offered'?'selected':''}} >Train Price Offered</option>
                                        <option data-type="Cruise" value="Excursions" {{$pricingDetails->price_description=='Excursions'?'selected':''}} >Excursions</option>
                                        <option data-type="Cruise" value="Spa Services" {{$pricingDetails->price_description=='Spa Services'?'selected':''}} >Spa Services</option>
                                        <option data-type="Cruise" value="WiFi Packages" {{$pricingDetails->price_description=='WiFi Packages'?'selected':''}} >WiFi Packages</option>
                                        <option data-type="Cruise" value="Crew Appreciation Fees/Gratuities" {{$pricingDetails->price_description=='Crew Appreciation Fees/Gratuities'?'selected':''}} >Crew Appreciation Fees/Gratuities</option>
                                        <option data-type="Cruise" value="Shuttle Services" {{$pricingDetails->price_description=='Shuttle Services'?'selected':''}} >Shuttle Services</option>
                                        <option data-type="Cruise" value="Speciality Dining" {{$pricingDetails->price_description=='Speciality Dining'?'selected':''}} >Speciality Dining</option>
                                        <option data-type="Cruise" value="Drink Packages" {{$pricingDetails->price_description=='Drink Packages'?'selected':''}} >Drink Packages</option>
                                        <option data-type="Cruise" value="Trip Insurance" {{$pricingDetails->price_description=='Trip Insurance'?'selected':''}} >Trip Insurance</option>
                                        <option data-type="Cruise" value="Check-in Proces Luggage Tags &amp; Sailing Pass" {{$pricingDetails->price_description=='Check-in Proces Luggage Tags & Sailing Pass'?'selected':''}} >Check-in Proces Luggage Tags & Sailing Pass</option>
                                        <option data-type="Cruise" value="Special Occasion Package" {{$pricingDetails->price_description=='Special Occasion Package'?'selected':''}} >Special Occasion Package</option>
                                        <option data-type="Cruise" value="Water Bottle or Distilled Water Package" {{$pricingDetails->price_description=='Water Bottle or Distilled Water Package'?'selected':''}} >Water Bottle or Distilled Water Package</option>
                                        <option data-type="Cruise" value="Pet-in Cabin" {{$pricingDetails->price_description=='Pet-in Cabin'?'selected':''}} >Pet-in Cabin</option>
                                        <option data-type="Cruise" value="Pet-in Cargo" {{$pricingDetails->price_description=='Pet-in Cargo'?'selected':''}} >Pet-in Cargo</option>
                                        <option data-type="Flight" value="Cancellation Fee" {{$pricingDetails->price_description=='Cancellation Fee'?'selected':''}} >Cancellation Fee</option>
                                        <option data-type="Cruise" value="Vacation Packages" {{$pricingDetails->price_description=='Vacation Packages'?'selected':''}}>Vacation Packages</option>
                                        <option data-type="Flight" value="Seat Assignment" {{$pricingDetails->price_description=='Seat Assignment'?'selected':''}}>Seat Assignment</option>
                                        <option value="Package Booking" {{$pricingDetails->price_description=='Package Booking'?'selected':''}}>Package Booking</option>
                                      </select>
                                    </td>
                                    
                                    <td>
                                        <input type="number" style="width: 110px;" class="form-control"
                                            name="pricing[{{$key}}][net_price]" value="{{$pricingDetails->net_price}}"
                                            placeholder="Net Price" min="0" step="0.01"  {{ $disabled }} >
                                    </td>

                                    <td><span class="net-total">{{$pricingDetails->net_price}}</span></td>
                                    
                                    <td>
                                        <select class="form-control detailDropdown" style="width: 145px;"
                                            name="pricing[{{$key}}][details]" id="details_{{$key}}"  {{ $disabled }} >
                                            <option data-grossmco="1" value="Flight Cost"
                                                {{ $pricingDetails->details == 'Flight Cost' ? 'selected' : '' }}>Flight
                                                Cost</option>
                                            <option data-grossmco="1" value="Hotel Cost"
                                                {{ $pricingDetails->details == 'Hotel Cost' ? 'selected' : '' }}>Hotel Cost</option>
                                            <option data-grossmco="1" value="Car Rental Cost"
                                                {{ $pricingDetails->details == 'Car Rental Cost' ? 'selected' : '' }}>Car Rental
                                                Cost</option>
                                            <option data-grossmco="1" value="Cruise Cost"
                                                {{ $pricingDetails->details == 'Cruise Cost' ? 'selected' : '' }}>Cruise Cost
                                            </option>
                                            <option data-grossmco="1" value="Train Cost"
                                                {{ $pricingDetails->details == 'Train Cost' ? 'selected' : '' }}>Train Cost</option>
                                            <option data-grossmco="1" value="Company card"
                                                {{ $pricingDetails->details == 'Company card' ? 'selected' : '' }}>Company card
                                            </option>
                                            <option data-grossmco="1" value="company_card_used"
                                                {{ $pricingDetails->details == 'company_card_used' ? 'selected' : '' }}>Company Card
                                                Used</option>
                                            <option data-grossmco="0" value="Partial Refund"
                                                {{ $pricingDetails->details == 'Partial Refund' ? 'selected' : '' }}>Partial Refund
                                            </option>
                                            <option data-grossmco="0" value="Full Refund"
                                                {{ $pricingDetails->details == 'Full Refund' ? 'selected' : '' }}>Full Refund
                                            </option>
                                            <option data-grossmco="0" value="Chargeback Fee"
                                                {{ $pricingDetails->details == 'Chargeback Fee' ? 'selected' : '' }}>Chargeback Fee
                                            </option>
                                            <option data-grossmco="0" value="Partial Chargeback Amt."
                                                {{ $pricingDetails->details == 'Partial Chargeback Amt.' ? 'selected' : '' }}>
                                                Partial Chargeback Amt.</option>
                                            <option data-grossmco="0" value="Chargeback Amt."
                                                {{ $pricingDetails->details == 'Chargeback Amt.' ? 'selected' : '' }}>Chargeback
                                                Amt.</option>

                                            <option data-grossmco="1" data-cruise="1" value="Excursions" {{ $pricingDetails->details == 'Excursions' ? 'selected' : '' }} >Excursions</option>
                                            <option data-grossmco="1" data-cruise="1" value="Spa Services" {{ $pricingDetails->details == 'Spa Services' ? 'selected' : '' }} >Spa Services</option>
                                            <option data-grossmco="1" data-cruise="1" value="WiFi Packages" {{ $pricingDetails->details == 'WiFi Packages' ? 'selected' : '' }} >WiFi Packages</option>
                                            <option data-grossmco="1" data-cruise="1" value="Gratuities"  {{ $pricingDetails->details == 'Crew Appreciation Fees/Gratuities' ? 'selected' : '' }} >Crew Appreciation Fees/Gratuities</option>
                                            <option data-grossmco="1" data-cruise="1" value="Shuttle Services" {{ $pricingDetails->details == 'Shuttle Services' ? 'selected' : '' }}>Shuttle Services</option>
                                            <option data-grossmco="1" data-cruise="1" value="Speciality Dining"  {{ $pricingDetails->details == 'Speciality Dining' ? 'selected' : '' }}>Speciality Dining</option>
                                            <option data-grossmco="1" data-cruise="1" value="Drink Packages" {{ $pricingDetails->details == 'Drink Packages' ? 'selected' : '' }}>Drink Packages</option>
                                            <option data-grossmco="1" data-cruise="1" value="Trip Insurance" {{ $pricingDetails->details == 'Trip Insurance' ? 'selected' : '' }}>Trip Insurance</option>
                                            <option data-grossmco="1" data-cruise="1" value="Check-in Proces Luggage Tags & Sailing Pass" {{ $pricingDetails->details == 'Check-in Proces Luggage Tags & Sailing Pass' ? 'selected' : '' }}>Check-in Proces Luggage Tags & Sailing Pass</option>
                                            <option data-grossmco="1" data-cruise="1" value="Special Occasion Package" {{ $pricingDetails->details == 'Special Occasion Package' ? 'selected' : '' }}>Special Occasion Package</option>
                                            <option data-grossmco="1" data-cruise="1" value="Water Bottle or Distilled Water Package" {{ $pricingDetails->details == 'Water Bottle or Distilled Water Package' ? 'selected' : '' }}>Water Bottle or Distilled Water Package</option>
                                        
                                            <option data-grossmco="1" data-change="1" value="Change Fee" {{ $pricingDetails->details == 'Change Fee' ? 'selected' : '' }}>Change Fee</option>
                                            <option data-grossmco="1" data-change="1" value="Fare Difference"  {{ $pricingDetails->details == 'Fare Difference' ? 'selected' : '' }}>Fare Difference</option>


                                        </select>
                                    </td>
                                    <input type="hidden" name="pricing[{{ $key }}][id]"
                                                                value="{{ $pricingDetails->id }}"  {{ $disabled }} >
                                    <td>
                                        <button type="button" class="btn btn-outline-danger delete-pricing-btn"  {{ $disabled }} >
                                            <i class="ri ri-delete-bin-line"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                    @endforeach
                </tbody>

                <tfoot>

                    <tr>
                        <td class="pb-0" style="border-bottom: 1;border-right: 1px solid #000 !important;"></td>
                        <td class="pb-0" style="border-bottom: 1;border-right: 1px solid #000 !important;"></td>
                        <td class="pb-0" style="border-bottom: 1;border-right: 1px solid #000 !important;"></td>
                        <td class="pb-0" style="border-bottom: 1;border-right: 1px solid #000 !important;"></td>
                        <td class="pb-0" style="border-bottom: 1;border-right: 1px solid #000 !important;"></td>
                        <td class="pb-0" style="border-bottom: 1;border-right: 1px solid #000 !important;"><span
                                id="merchant_fee_text1">0.00</span></td>

                        <td class="pb-0" style="border-bottom: 1;border-right: 1px solid #000 !important;"><span
                                id="merchant_fee_text2">0.00</span></td>
                        <td class="pb-0" style="border-bottom: 1;border-right: 1px solid #000 !important;">Merchant Fee
                        </td>
                        <td class="pb-0" style="border-bottom: 1;"></td>
                    </tr>

                    <tr>
                        <td colspan="5" class="pb-0" style="border-bottom: 0;border-right: 1px solid #000 !important;">
                            <strong style="color:#055bdb">Gross MCO</strong> : <span id="total_gross_value">0.00</span>
                            <input name="gross_mco" type="hidden" id="gross_mco" />
                        </td>

                        <td class="pb-0" style="border-bottom: 0;">
                            <strong style="color:#055bdb">Net MCO</strong> : <span
                                id="total_netprofit_value">0.00</span>
                            <input name="net_mco" type="hidden" id="net_mco" />
                        </td>
                    </tr>

                            <input name="merchant_fee" type="hidden" id="merchant_fee" />
                       
                    </tr>
                </tfoot>
            </table>


        </div>
    </div>
</div>