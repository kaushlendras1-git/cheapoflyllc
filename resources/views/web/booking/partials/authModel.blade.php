<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

<!-- Button to trigger call logs modal -->

<button type="button"
    class="btn btn-primary btn-sm rounded-pill auth-button d-flex align-items-center gap-1 lob-auth-btn"
    data-bs-toggle="modal" data-bs-target="#callLogsModal">
    <span class="iconify" data-icon="mdi:email-send-outline" style="font-size: 16px;"></span>
    Send Mail
</button>

<!-- Call Logs Modal without fade -->
<div class="modal fade lob-modal-premium" id="callLogsModal" tabindex="-1" aria-labelledby="callLogsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 724px;">
        <div class="modal-content shadow-lg border-0">

            <!-- Header -->
            <div class="modal-header text-white p-4 border-0">
                <h6 class="modal-title fw-semibold d-flex align-items-center gap-2" id="callLogsModalLabel">
                    <span class="iconify fs-4" data-icon="mdi:email-send-outline"></span>
                    Send Mail
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body auth-btn-style">

                @php
                $firstCcHolderName = $booking->billingDetails->first()->cc_holder_name;
                $muiltiple = false;
                foreach($booking->billingDetails as $billingDetails) {
                if ($billingDetails->cc_holder_name !== $firstCcHolderName) {
                $muiltiple = true;
                break;
                }
                }
                @endphp

                @foreach($booking->billingDetails as $loop => $billingDetails)
                @if($billingDetails->authorized_amt > 1)
                @php
                $billing_address = \App\Models\BillingDetail::where('id', $billingDetails->state)->first();
                @endphp
                @if($muiltiple || $loop->first)
                <button class="btn btn-primary d-flex align-items-center sendAuthMail mb-3 w-100"
                    style="padding: 16px !important; font-size: 16px !important;" data-bs-toggle="modal"
                    data-bs-target="#sendAuthMailModal" data-booking_id="{{ $billingDetails->booking_id }}"
                    data-card_id="{{ $billingDetails->state }}" data-card_billing_id="{{ $billingDetails->id }}"
                    data-email="{{ $billingDetails->getBillingDetail->email }}"
                    data-cc_number="{{ $billingDetails['cc_number'] }}" data-bs-dismiss="modal" data-href="{{ route('i_authorized', [
                                    'booking_id' => encode($billingDetails->booking_id),
                                    'card_id' => encode($billingDetails->state),
                                    'card_billing_id' => encode($billingDetails->id),
                                    'refund_status' => encode(1)
                                ]) }}">
                    <span class="iconify me-2 fs-5" data-icon="mdi:email-lock-outline"></span>
                    Send Auth Email **** {{ substr($billingDetails->cc_number, -4) }}
                </button>
                @endif
                @endif
                @endforeach

                <!-- Survey Button -->
                <button class="btn d-flex align-items-center w-100 mt-2"
                    style="background-color: #28a745 !important; color: white !important; padding: 16px !important; font-size: 16px !important;"
                    data-bs-toggle="modal" data-bs-target="#surveyModal" data-booking_id="1" data-card_id="1"
                    data-card_billing_id="1" data-id="1" data-bs-dismiss="modal">
                    <span class="iconify me-2 fs-5" data-icon="mdi:form-select"></span>
                    Send Auth Survey
                </button>

            </div>
        </div>
    </div>
</div>



<!-- Send Mail Modal -->
<div class="modal fade lob-modal-premium" id="sendAuthMailModal" tabindex="-1" aria-labelledby="sendMailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg border-0">

            <!-- Header -->
            <div class="modal-header text-white p-4 border-0">
                <h5 class="modal-title fw-semibold d-flex align-items-center gap-2" id="sendMailModalLabel">
                    <span class="iconify fs-4" data-icon="mdi:email-send-outline"></span>
                    Send Mail
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <form id="sendAuthEmail" action="{{ route('mail-sent') }}">
                    @csrf
                    <input type="hidden" name="id" id="auth_id" value="{{ $booking->id }}">
                    <input type="hidden" name="booking_id_encode" id="booking_id_encode"
                        value="{{ encode($booking->id) }}">
                    <input type="hidden" name="booking_id" id="booking_id" />
                    <input type="hidden" name="card_id" id="card_id" />
                    <input type="hidden" name="card_billing_id" id="card_billing_id" />
                    <input type="hidden" name="email" id="email" />

                    <div class="row checkbox-servis">

                        <!-- Refund Status -->
                        <div class="col-md-4 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2 d-block">
                                <span class="iconify me-1" data-icon="mdi:cash-refund"></span>
                                Refund Status
                            </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="refund_status" id="refundable"
                                    value="refundable">
                                <label class="form-check-label" for="refundable">Refundable</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="refund_status" id="non-refundable"
                                    value="non-refundable">
                                <label class="form-check-label" for="non-refundable">Non-Refundable</label>
                            </div>
                        </div>

                        <!-- Send Type -->
                        <div class="col-md-4 position-relative">
                            <label class="form-label fw-semibold text-dark mb-2 d-block">
                                <span class="iconify me-1" data-icon="mdi:email-multiple-outline"></span>
                                Send Via
                            </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="send_type" id="email-type"
                                    value="email">
                                <label class="form-check-label text-dark" for="email-type">Email</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="send_type" id="sms-type" value="sms">
                                <label class="form-check-label text-dark" for="sms-type">SMS</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="send_type" id="whatsapp-type"
                                    value="whatsapp">
                                <label class="form-check-label text-dark" for="whatsapp-type">WhatsApp</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-4 d-flex align-items-end justify-content-end">
                            <button class="btn btn-primary button-style d-flex align-items-center gap-2 px-4 py-3"
                                style="background-color: var(--primary); color: #fff !important;">
                                <span class="iconify fs-5" data-icon="mdi:send-check-outline"
                                    style="color: #fff !important;"></span>
                                Send Auth
                            </button>
                        </div>

                    </div>
                </form>

                <div id="load_model" class="mt-4 send_auth_mail_popup">
                    <!-- Loaded dynamically -->
                </div>

            </div>

        </div>
    </div>
</div>




<!-- Survey Modal -->
<div class="modal fade lob-modal-premium" id="surveyModal" tabindex="-1" aria-labelledby="surveyModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg border-0">

            <!-- Header -->
            <div class="modal-header text-white p-4 border-0">
                <h5 class="modal-title fw-semibold d-flex align-items-center gap-2" id="surveyModalLabel">
                    <span class="iconify fs-4" data-icon="mdi:form-select"></span>
                    Create Survey
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <!-- Preview Section -->
                <div class="survey-preview mb-4 p-3 rounded-3 border">
                    <p>Hello (Customer Name),</p>
                    <p>It’s been a pleasure working with you. We’re always looking to improve, and your feedback would
                        be incredibly valuable to us.</p>
                    <p>Would you be open to writing a short review or testimonial?</p>
                    <p>➤ [Review Link]</p>
                    <p>Thank you again for trusting Faretickets LLC.</p>
                </div>

                <!-- Send Survey Form -->
                <form id="sendSurvey" action="{{ route('survey', $booking->id) }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-end">
                        <button class="btn button-style d-flex align-items-center gap-2 px-5 py-3"
                            style="background-color: var(--primary); color: #fff !important;">
                            <span class="iconify fs-5" data-icon="mdi:send-circle-outline"
                                style="color: #fff !important;"></span>
                            Send Survey
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>