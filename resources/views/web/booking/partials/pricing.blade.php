<div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">

                <div class="col-md-12">


                <div class="col-md-5 position-relative checkbox-servis">
                        <!-- <label class="d-block mb-2">PNR Type</label> -->

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pnr_type" id="FXL" value="FXL">
                            <label style="width: auto !important;" class="form-check-label" for="FXL">
                                FXL
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pnr_type" id="GK" value="GK">
                            <label style="width: auto !important;" class="form-check-label" for="GK">
                               GK
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pnr_type" id="HK" value="HK">
                            <label style="width: auto !important;" class="form-check-label" for="HK">
                               HK
                            </label>
                        </div>
                    </div>



                    <div class="card p-4 details-table-wrappper show-booking-card">
                        <div class="d-flex justify-content-end mb-2">
                            <button class="btn btn-primary no-btn add-no-btn add-bank" type="button" id="pricing-booking-button">
                                <i class="ri ri-add-circle-fill pointer"></i>
                            </button>
                        </div>

                        <table class="pricing-table table">
                            <thead>
                                <tr>
                                    <td colspan="4" style="border: solid 1px;">
                                        <div style="color: #ed9900;display: flex; justify-content: space-between; align-items: center;">
                                            <strong>Gross Amount</strong>
                                            <span id="total_gross_profit">0.00</span>
                                            <input name="gross_value" type="hidden" id="gross_value"/>
                                        </div>
                                    </td>
                                    <td colspan="4" >
                                        <div style="color: #ed9900;display: flex; justify-content: space-between; align-items: center;">
                                            <strong >Net Amount</strong>
                                            <span id="total_net_profit">0.00</span>
                                            <input name="net_value" type="hidden" id="net_value"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Passengers*</th>
                                    <th>No. of Pax</th>
                                    <th>Price*</th>
                                    <th>Total*</th>
                                    <th>Price*</th>
                                    <th>Total</th>
                                    <th>Details</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="pricingForms" class="pricing-rows">
                                @if($booking->pricingDetails->isEmpty())
                                <tr class="pricing-row" data-index="0">
                                    <td>
                                        <select name="pricing[0][passenger_type]" class="form-select form-control"
                                            id="passenger_type_0">
                                            <option value="">Select</option>
                                            <option value="adult">Adult</option>
                                            <option value="child">Child</option>
                                            <option value="infant_on_lap">Infant on Lap</option>
                                            <option value="infant_on_seat">Infant on Seat</option>
                                            <option value="Senior">Senior</option>
                                        </select>
                                    </td>
                                    <td><input style="width: 120px" type="number" class="form-control"
                                            name="pricing[0][num_passengers]" placeholder="No. of Passengers" min="0">
                                    </td>
                                    <td><input type="number" class="form-control" name="pricing[0][gross_price]"
                                            placeholder="Gross Price" min="0" step="0.01" style="width: 110px;"></td>

                                    <td><span class="gross-total">0.00</span></td>
                                    <td><input type="number" style="width: 110px;" class="form-control"
                                            name="pricing[0][net_price]" placeholder="Net Price" min="0" step="0.01">
                                    </td>
                                    <td><span class="net-total">0.00</span></td>
                                    <td>
                                        <select style="width: 145px;" name="pricing[0][details]"
                                            class="form-select form-control" id="details_0">
                                            <option value="">Select</option>
                                            <option value="ticket_cost">Ticket Cost</option>
                                            <option value="merchant_fee">Merchant Fee</option>
                                            <option value="company_card_used">Company Card Used</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger delete-pricing-btn">
                                            <i class="ri ri-delete-bin-line"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endif

                                @foreach($booking->pricingDetails as $key=>$pricingDetails)
                                <tr class="pricing-row" data-index="{{$key}}">
                                    <td>
                                        <select class="form-control" name="pricing[{{$key}}][passenger_type]"
                                            id="passenger_type_{{$key}}">
                                            <option value="">Select</option>
                                            <option value="adult"
                                                {{$pricingDetails->passenger_type=='adult'?'selected':''}}>Adult
                                            </option>
                                            <option value="child"
                                                {{$pricingDetails->passenger_type=='child'?'selected':''}}>Child
                                            </option>
                                            <option value="infant_on_lap"
                                                {{$pricingDetails->passenger_type=='infant_on_lap'?'selected':''}}>
                                                Infant on
                                                Lap</option>
                                            <option value="infant_on_seat"
                                                {{$pricingDetails->passenger_type=='infant_on_seat'?'selected':''}}>
                                                Infant
                                                on Seat</option>
                                        </select>
                                    </td>
                                    <td><input type="number" style="width: 120px" class="form-control"
                                            name="pricing[{{$key}}][num_passengers]"
                                            value="{{$pricingDetails->num_passengers}}" placeholder="No. of Passengers"
                                            min="0"></td>

                                    <td><input type="number" style="width: 100px" class="form-control" name="pricing[{{$key}}][gross_price]"
                                            value="{{$pricingDetails->gross_price}}" placeholder="Gross Price" min="0"
                                            step="0.01"></td>

                                    <td><span class="gross-total">0.00</span></td>
                                    <td><input type="number" style="width: 110px;" class="form-control" name="pricing[{{$key}}][net_price]"
                                            value="{{$pricingDetails->net_price}}" placeholder="Net Price" min="0"
                                            step="0.01"></td>
                                    <td><span class="net-total">0.00</span></td>
                                    <td>
                                        <select class="form-control" style="width: 145px;" name="pricing[{{$key}}][details]"
                                            id="details_{{$key}}">

                                            <option {{ $pricingDetails->details == 'Ticket Cost' ? 'selected' : '' }}>Ticket Cost</option>
                                            <option {{ $pricingDetails->details == 'Flight Ticket Cost' ? 'selected' : '' }}>Flight Ticket Cost</option>
                                            <option {{ $pricingDetails->details == 'Hotel Cost' ? 'selected' : '' }}>Hotel Cost</option>
                                            <option {{ $pricingDetails->details == 'Car Rental Cost' ? 'selected' : '' }}>Car Rental Cost</option>
                                            <option {{ $pricingDetails->details == 'Cruise Cost' ? 'selected' : '' }}>Cruise Cost</option>
                                            <option {{ $pricingDetails->details == 'Train Cost' ? 'selected' : '' }}>Train Cost</option>
                                            <option {{ $pricingDetails->details == 'Company card' ? 'selected' : '' }}>Company card</option>
                                            <option {{ $pricingDetails->details == 'Merchant fee' ? 'selected' : '' }}>Merchant fee</option>
                                            <option {{ $pricingDetails->details == 'Partial Refund' ? 'selected' : '' }}>Partial Refund</option>
                                            <option {{ $pricingDetails->details == 'Full Refund' ? 'selected' : '' }}>Full Refund</option>
                                            <option {{ $pricingDetails->details == 'Chargeback Fee' ? 'selected' : '' }}>Chargeback Fee</option>
                                            <option {{ $pricingDetails->details == 'Partial Chargeback Amt.' ? 'selected' : '' }}>Partial Chargeback Amt.</option>
                                            <option {{ $pricingDetails->details == 'Chargeback Amt.' ? 'selected' : '' }}>Chargeback Amt.</option>
                                            <option {{ $pricingDetails->details == 'Issuance Fees - Voyzant' ? 'selected' : '' }}>Issuance Fees - Voyzant</option>
                                            <option {{ $pricingDetails->details == 'company_card_used' ? 'selected' : '' }}>Company Card Used</option>

                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger delete-pricing-btn">
                                            <i class="ri ri-delete-bin-line"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach

                                 <td>
                <select class="form-control" name="pricing[${pricingIndex}][passenger_type]" id="passenger_type_${pricingIndex}">
                    <option value="">Select</option>
                </select>
            </td>
            <td><input type="number" style="width: 120px" class="form-control" name="pricing[${pricingIndex}][num_passengers]" value="0" min="0"></td>
            <td><input type="number" style="width: 110px;" class="form-control" name="pricing[${pricingIndex}][gross_price]" value="0.00" min="0" step="0.01"></td>
            <td><span class="gross-total">0.00</span></td>
            <td><input type="number" style="width: 110px;" class="form-control" name="pricing[${pricingIndex}][net_price]" placeholder=".015*Gross MCO" min="0" step="0.01"></td>
            <td><span class="net-total">0.00</span></td>
            <td>
                <select style="width: 145px;" class="form-control" name="pricing[${pricingIndex}][details]" id="details_${pricingIndex}">
                    <option>Merchant fee</option>                  
                </select>
            </td>
            <td>
                <button type="button" class="btn btn-outline-danger delete-pricing-btn">
                    <i class="ri ri-delete-bin-line"></i>
                </button>
            </td>

                                  <!-- <tr class="pricing-row hkRow" data-index="1">
                                    <td>-</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0.00</td>
                                    <td> 10.00</td>
                                    <td> $10 </td>
                                    <td>Issuance Fees - Voyzant</td>
                                    <td></td>
                                </tr> -->

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="6" class="pb-0" style="border-bottom: 0;">
                                        <strong style="color:#055bdb">Gross MCO</strong> : <span id="total_gross_value">0.00</span>
                                    </td>
                                    <td class="pb-0" style="border-bottom: 0;">
                                        <strong style="color:#055bdb">Net MCO</strong> : <span id="total_netprofit_value">0.00</span>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td class="pb-0" style="border-bottom: 0;">
                                        <strong>- 15%  Merchant fee </strong> : <span id="total_gross_mcq">0.00</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pb-0" style="border-bottom: 0;">
                                        <strong>Total Gross-MCO</strong> : <span id="total_gross_mcq">0.00</span>
                                    </td>
                                </tr> -->
                                <!-- <tr>
                                    <td colspan="5">
                                        <strong>Gross-MCO =  Gross Amount Collected  - (Flight Ticket Cost +Cruise Ticket Cost+Car Rental Cost+Train Cost+Hotel Cost + company cost )</strong>

                                        <br>
                                        Net Profit ==  Gross-MCO -  (15% + Merchant fee + Partial Refund + Full Refund + Chargeback Fee + Partial Chargeback Amt. + Chargeback Amt. + FXL Issuance Fees + Issuance Fees - Voyzant )

                                    </td>

                                    <td></td>
                                    <td></td>
                                </tr> -->
                            </tfoot>
                        </table>


                    </div>
                </div>
            </div>
