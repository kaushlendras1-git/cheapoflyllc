<div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">

                <div class="col-md-12">
                    <div class="card p-4 details-table-wrappper show-booking-card">
                        <div class="d-flex justify-content-end mb-2">
                            <button class="btn btn-primary no-btn add-no-btn add-bank" type="button" id="pricing-booking-button">
                                <i class="ri ri-add-circle-fill pointer"></i>
                            </button>
                        </div>

                        <table class="pricing-table table">
                            <thead>
                                <tr>
                                    <td colspan="4" style="border: solid 1px;"><strong>Gross Amount Collected</strong>
                                    </td>
                                    <td colspan="4"><strong>Net Amount (Paid)</strong></td>
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
                                    <td><input type="number" class="form-control"
                                            name="pricing[{{$key}}][num_passengers]"
                                            value="{{$pricingDetails->num_passengers}}" placeholder="No. of Passengers"
                                            min="0"></td>
                                    <td><input type="number" class="form-control" name="pricing[{{$key}}][gross_price]"
                                            value="{{$pricingDetails->gross_price}}" placeholder="Gross Price" min="0"
                                            step="0.01"></td>
                                    <td><span class="gross-total">0.00</span></td>
                                    <td><input type="number" class="form-control" name="pricing[{{$key}}][net_price]"
                                            value="{{$pricingDetails->net_price}}" placeholder="Net Price" min="0"
                                            step="0.01"></td>
                                    <td><span class="net-total">0.00</span></td>
                                    <td>
                                        <select class="form-control" name="pricing[{{$key}}][details]"
                                            id="details_{{$key}}">

                                            <option value="ticket_cost"
                                                {{$pricingDetails->details=='ticket_cost'?'selected':''}}>Ticket
                                                Cost
                                            </option>

                                            <option>Flight Ticket Cost</option>
                                            <option>Cruise Ticket Cost</option>
                                            <option>Car Rental Cost</option>
                                            <option>Train Cost</option>
                                            <option>Hotel Cost</option>
                                            <option>Company Card</option>
                                            <option>Issuance Fees</option>
                                            <option>FXL Issuance Fees</option>
                                            <option>Refund</option>
                                            <option>Charge Back Fee</option>
                                            <option>Charge Back Amount</option>
                                            <option>Voyzant</option>

                                            <option value="merchant_fee"
                                                {{$pricingDetails->details=='merchant_fee'?'selected':''}}>Merchant
                                                Fee
                                            </option>
                                            <option value="company_card_used"
                                                {{$pricingDetails->details=='company_card_used'?'selected':''}}>
                                                Company
                                                Card
                                                Used</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger delete-pricing-btn">
                                            <i class="ri ri-delete-bin-line"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"><strong>Gross Profit</strong></td>
                                    <td><span id="total_gross_profit">0.00</span></td>
                                    <td colspan="2"><strong>Net Profit</strong></td>
                                    <td><span id="total_net_profit">0.00</span></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>


                    </div>
                </div>
            </div>