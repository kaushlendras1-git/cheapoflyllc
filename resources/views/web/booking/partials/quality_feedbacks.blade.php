<div class="tab-pane fade" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
                <div class="card p-4 show-booking-card" style="font-size: 12px;">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h5 class="card-header border-0 p-0 mb-0 detail-passanger">Quality Feedback</h5>
                        <button id="saveFeedback" type="button" class="btn btn-primary">Save Feedback</button>
                    </div>
                    <div class="card-body p-0">
                        <!-- Checkboxes for Parameters -->
                        <div class="my-5">
                            <div class="switch-container">
                                <!-- Include this inside your Blade view or HTML form -->
                                <div class="row">
                                    <!-- Fatal Section -->
                                    <div class="col-12">
                                        <h6 class="text-success fw-bold py-1 px-2"
                                            style="background-color: #e6ffe6; display: inline-block; border-radius: 5px; font-size: 0.9rem;">
                                            NOT FATAL</h6>
                                    </div>
                                    @php

                                    $feedbackParameters = $feed_backs->pluck('parameter')->toArray();

                                    $feedbackNotes = $feed_backs->pluck('notes', 'parameter')->toArray();
                                    @endphp

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Call Opening" id="CallOpening" name="parameters[]"
                                                {{ in_array('Call Opening', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="CallOpening">Call
                                                Opening</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="CallOpening"
                                            name="parameter_notes[Call Opening]" rows="2"
                                            placeholder="Add comment for Call Opening...">{{ $feedbackNotes['Call Opening'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Call Closing" id="CallClosingfareneeds" name="parameters[]"
                                                {{ in_array('Call Closing', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="CallClosingfareneeds">Call
                                                Closing</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="CallClosingfareneeds"
                                            name="parameter_notes[Call Closing]" rows="2"
                                            placeholder="Add comment for Call Closing...">{{ $feedbackNotes['Call Closing'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Probing" id="Probing" name="parameters[]"
                                                {{ in_array('Probing', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="Probing">Probing</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="Probing"
                                            name="parameter_notes[Probing]" rows="2"
                                            placeholder="Add comment for Probing...">{{ $feedbackNotes['Probing'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Parapharsing" id="Parapharsing" name="parameters[]"
                                                {{ in_array('Parapharsing', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="Parapharsing">Parapharsing</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="Parapharsing"
                                            name="parameter_notes[Parapharsing]" rows="2"
                                            placeholder="Add comment for Parapharsing...">{{ $feedbackNotes['Parapharsing'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Dead air/Hold" id="DeadAirHold" name="parameters[]"
                                                {{ in_array('Dead air/Hold Procedurefareneeds', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="DeadAirHold">Dead
                                                air/Hold</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="DeadAirHold"
                                            name="parameter_notes[Dead air/Hold]" rows="2"
                                            placeholder="Add comment for Dead air/Hold">{{ $feedbackNotes['Dead air/Hold'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Currency" id="Currency" name="parameters[]"
                                                {{ in_array('Currency', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="Currency">Currency</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="Currency"
                                            name="parameter_notes[Currency]" rows="2"
                                            placeholder="Add comment for Currency...">{{ $feedbackNotes['Currency'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Cold/Blind Transfer" id="ColdBlindTransferfareneeds"
                                                name="parameters[]"
                                                {{ in_array('Cold/Blind Transfer', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="ColdBlindTransferfareneeds">Cold/Blind Transfer</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="ColdBlindTransferfareneeds"
                                            name="parameter_notes[Cold/Blind Transfer]" rows="2"
                                            placeholder="Add comment for Cold/Blind Transfer...">{{ $feedbackNotes['Cold/Blind Transfer'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="E-Tickets" id="ETicketsfareneeds" name="parameters[]"
                                                {{ in_array('E-Tickets', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="ETicketsfareneeds">E-Tickets</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="5"
                                            data-qualitytype="non_fatal" data-related="ETicketsfareneeds"
                                            name="parameter_notes[E-Tickets]" rows="2"
                                            placeholder="Add comment for E-Tickets...">{{ $feedbackNotes['E-Tickets'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Active Listening" id="ActiveListening" name="parameters[]"
                                                {{ in_array('Active Listening', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="ActiveListening">Active
                                                Listening</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none"
                                            data-marksvalue="10" data-qualitytype="non_fatal"
                                            data-related="ActiveListening" name="parameter_notes[Active Listening]"
                                            rows="2"
                                            placeholder="Add comment for Active Listening...">{{ $feedbackNotes['Active Listening'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Rebuttals/Objection Handling" id="RebuttalsObjectionHandling"
                                                name="parameters[]"
                                                {{ in_array('Rebuttals/Objection Handling', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="RebuttalsObjectionHandling">Rebuttals/Objection Handling</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none"
                                            data-marksvalue="10" data-qualitytype="non_fatal"
                                            data-related="RebuttalsObjectionHandling"
                                            name="parameter_notes[Rebuttals/Objection Handling]" rows="2"
                                            placeholder="Add comment for Rebuttals/Objection Handling...">{{ $feedbackNotes['Rebuttals/Objection Handling'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Call Handling" id="CallHandling" name="parameters[]"
                                                {{ in_array('Call Handling', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="CallHandling">Call
                                                Handling</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none"
                                            data-marksvalue="10" data-qualitytype="non_fatal"
                                            data-related="CallHandling" name="parameter_notes[Call Handling]" rows="2"
                                            placeholder="Add comment for Call Handling...">{{ $feedbackNotes['Call Handling'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Selling Skills" id="SellingSkills" name="parameters[]"
                                                {{ in_array('Selling Skills', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="SellingSkills">Selling
                                                Skills</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none"
                                            data-marksvalue="10" data-qualitytype="non_fatal"
                                            data-related="SellingSkills" name="parameter_notes[Selling Skills]" rows="2"
                                            placeholder="Add comment for Selling Skills...">{{ $feedbackNotes['Selling Skills'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Cross Selling (HCIL)" id="CrossSellingHCIL" name="parameters[]"
                                                {{ in_array('Cross Selling (HCIL)', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="CrossSellingHCIL">Cross
                                                Selling (HCIL)</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none"
                                            data-marksvalue="10" data-qualitytype="non_fatal"
                                            data-related="CrossSellingHCIL" name="parameter_notes[Cross Selling (HCIL)]"
                                            rows="2"
                                            placeholder="Add comment for Cross Selling (HCIL)...">{{ $feedbackNotes['Cross Selling (HCIL)'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Itinerary Recapping/Call Summary"
                                                id="ItineraryRecappingCallSummary" name="parameters[]"
                                                {{ in_array('Itinerary Recapping/Call Summary', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="ItineraryRecappingCallSummary">Itinerary Recapping/Call
                                                Summary</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none"
                                            data-marksvalue="10" data-qualitytype="non_fatal"
                                            data-related="ItineraryRecappingCallSummary"
                                            name="parameter_notes[Itinerary Recapping/Call Summary]" rows="2"
                                            placeholder="Add comment for Itinerary Recapping/Call Summary...">{{ $feedbackNotes['Itinerary Recapping/Call Summary'] ?? '' }}</textarea>
                                    </div>
                                <hr>

                                    <!-- Add more fatal checkboxes with textarea below as needed -->

                                    <!-- Non-Fatal Section -->
                                    <div class="col-12 mt-4">
                                        <h5 class="text-danger">Fatal</h5>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Hold Procedure" id="HoldProcedure" name="parameters[]"
                                                {{ in_array('Hold Procedure', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="HoldProcedure">Hold
                                                Procedure</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="HoldProcedure"
                                            name="parameter_notes[Hold Procedure]" rows="2"
                                            placeholder="Add comment for Hold Procedure...">{{ $feedbackNotes['Hold Procedure'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Misrepresentation" id="Misrepresentation" name="parameters[]"
                                                {{ in_array('Misrepresentation', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="Misrepresentation">Misrepresentation</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="Misrepresentation"
                                            name="parameter_notes[Misrepresentation]" rows="2"
                                            placeholder="Add comment for Misrepresentation...">{{ $feedbackNotes['Misrepresentation'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Rude/Sarcastic behaviour" id="RudeSarcasticBehaviour"
                                                name="parameters[]"
                                                {{ in_array('Rude/Sarcastic behaviour', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="RudeSarcasticBehaviour">Rude/Sarcastic behaviour</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="RudeSarcasticBehaviour"
                                            name="parameter_notes[Rude/Sarcastic behaviour]" rows="2"
                                            placeholder="Add comment for Rude/Sarcastic behaviour...">{{ $feedbackNotes['Rude/Sarcastic behaviour'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Screenshot of services provided"
                                                id="ScreenshotOfServicesProvided" name="parameters[]"
                                                {{ in_array('Screenshot of services provided', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="ScreenshotOfServicesProvided">Screenshot of services
                                                provided</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="ScreenshotOfServicesProvided"
                                            name="parameter_notes[Screenshot of services provided]" rows="2"
                                            placeholder="Add comment for Screenshot of services provided...">{{ $feedbackNotes['Screenshot of services provided'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Merchant Name" id="MerchantName" name="parameters[]"
                                                {{ in_array('Merchant Name', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="MerchantName">Merchant
                                                Name</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="MerchantName"
                                            name="parameter_notes[Merchant Name]" rows="2"
                                            placeholder="Add comment for Merchant Name...">{{ $feedbackNotes['Merchant Name'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Split Charges" id="SplitCharges" name="parameters[]"
                                                {{ in_array('Split Charges', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="SplitCharges">Split
                                                Charges</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="SplitCharges"
                                            name="parameter_notes[Split Charges]" rows="2"
                                            placeholder="Add comment for Split Charges...">{{ $feedbackNotes['Split Charges'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Suspicious Customer" id="SuspiciousCustomer" name="parameters[]"
                                                {{ in_array('Suspicious Customer', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="SuspiciousCustomer">Suspicious Customer</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="SuspiciousCustomer"
                                            name="parameter_notes[Suspicious Customer]" rows="2"
                                            placeholder="Add comment for Suspicious Customer...">{{ $feedbackNotes['Suspicious Customer'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Force Sell" id="ForceSell" name="parameters[]"
                                                {{ in_array('Force Sell', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="ForceSell">Force Sell</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="ForceSell"
                                            name="parameter_notes[Force Sell]" rows="2"
                                            placeholder="Add comment for Force Sell...">{{ $feedbackNotes['Force Sell'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Fake/Unethical Sell" id="FakeUnethicalSell" name="parameters[]"
                                                {{ in_array('Fake/Unethical Sell', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="FakeUnethicalSell">Fake/Unethical Sell</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="FakeUnethicalSell"
                                            name="parameter_notes[Fake/Unethical Sell]" rows="2"
                                            placeholder="Add comment for Fake/Unethical Sell...">{{ $feedbackNotes['Fake/Unethical Sell'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Service Not Provided" id="ServiceNotProvided" name="parameters[]"
                                                {{ in_array('Service Not Provided', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="ServiceNotProvided">Service
                                                Not Provided</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="ServiceNotProvided"
                                            name="parameter_notes[Service Not Provided]" rows="2"
                                            placeholder="Add comment for Service Not Provided...">{{ $feedbackNotes['Service Not Provided'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Call Back Number/Extension" id="CallBackNumberExtension"
                                                name="parameters[]"
                                                {{ in_array('Call Back Number/Extension', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="CallBackNumberExtension">Call
                                                Back Number/Extension</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="CallBackNumberExtension"
                                            name="parameter_notes[Call Back Number/Extension]" rows="2"
                                            placeholder="Add comment for Call Back Number/Extension...">{{ $feedbackNotes['Call Back Number/Extension'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Follow Up" id="FollowUp" name="parameters[]"
                                                {{ in_array('Follow Up', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="FollowUp">Follow Up</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="FollowUp"
                                            name="parameter_notes[Follow Up]" rows="2"
                                            placeholder="Add comment for Follow Up...">{{ $feedbackNotes['Follow Up'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Confirmation Sale" id="ConfirmationSale" name="parameters[]"
                                                {{ in_array('Confirmation Sale', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="ConfirmationSale">Confirmation Sale</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="ConfirmationSale"
                                            name="parameter_notes[Confirmation Sale]" rows="2"
                                            placeholder="Add comment for Confirmation Sale...">{{ $feedbackNotes['Confirmation Sale'] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input chkqlty" type="checkbox" role="switch"
                                                value="Documentation" id="Documentation" name="parameters[]"
                                                {{ in_array('Documentation', $feedbackParameters) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark"
                                                for="Documentation">Documentation</label>
                                        </div>
                                        <textarea class="form-control mt-2 feedback-textarea d-none" data-marksvalue="0"
                                            data-qualitytype="fatal" data-related="Documentation"
                                            name="parameter_notes[Documentation]" rows="2"
                                            placeholder="Add comment for Documentation...">{{ $feedbackNotes['Documentation'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12 col-12 mt-4">

                        <div class="mt-5">
                            <div class="table-responsive">
                                <table id="booking_feed_back_table" class="table table-bordered align-middle" style="border-collapse: separate;">
                                    <thead class="table-primary text-center">
                                        <tr>
                                            <th style="width: 25%;border: none !important;background-color: #3569df;font-size: 14px;text-align: center;border-radius: 6px;color: #fff;padding: 20px 10px !important;">Quality strategies</th>
                                            <th style="width: 25%;border: none !important;background-color: #273960;font-size: 14px;text-align: center;border-radius: 6px;color: #fff;padding: 20px 10px !important;">Comment</th>
                                            <th style="width: 25%; border: none !important; background-color: #00a5fe; font-size: 14px; text-align: center; border-radius: 6px; color: #fff; padding: 20px 10px !important;">Agent</th>
                                            <th style="width: 25%; border: none !important; background-color: #fda305; font-size: 14px; text-align: center; border-radius: 6px; color: #fff; padding: 20px 10px !important;">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($feed_backs as $feed_back)
                                        <tr>
                                            <td>
                                                <div
                                                    class="qis-label @if($feed_back->quality == 'non_fatal') green_feedback @else red_feedback @endif p-1 rounded">
                                                    <span class="qis-icon">⏱️</span>{{$feed_back->parameter}}
                                                </div>
                                            </td>
                                            <td class="text-center">{{$feed_back->note}}</td>
                                            <td class="text-center">{{$feed_back->user_id}}</td>
                                            <td class="text-center">{{$feed_back->created_at}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>