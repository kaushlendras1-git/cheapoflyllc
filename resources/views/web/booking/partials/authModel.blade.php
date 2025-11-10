<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

<style>
.btn-mail { background-color: #007bff !important; color: white !important; }
.btn-sms { background-color: #28a745 !important; color: white !important; }
.btn-whatsapp { background-color: #25d366 !important; color: white !important; }
.btn-survey { background-color: #17a2b8 !important; color: white !important; }
</style>



<!-- Button to trigger call logs modal -->
  <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill auth-button" data-bs-toggle="modal" data-bs-target="#callLogsModal">
    Send Mail
  </button>

  <!-- Call Logs Modal without fade -->
  <div class="modal" id="callLogsModal" tabindex="-1" aria-labelledby="callLogsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 670px;">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="callLogsModalLabel">Send Mail</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body auth-btn-style">

        <!---
              1 => Non-Refundable Default
              0 => Refundable

        -->

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
                      <button class="btn btn-custom d-flex align-items-center sendAuthMail"
                              data-bs-toggle="modal"
                              data-bs-target="#sendAuthMailModal"
                              data-booking_id="{{ $billingDetails->booking_id }}"
                              data-card_id="{{ $billingDetails->state }}"
                              data-card_billing_id="{{ $billingDetails->id }}"
                              data-email="{{ $billingDetails->getBillingDetail->email }}"
                              data-cc_number="{{ $billingDetails['cc_number'] }}"
                              data-bs-dismiss="modal"
                              data-href="{{ route('i_authorized', ['booking_id' => encode($billingDetails->booking_id), 'card_id' => encode($billingDetails->state), 'card_billing_id' => encode($billingDetails->id), 'refund_status' => encode(1)]) }}"
                      >
                          <i class="ri ri-mail-open-fill"></i>
                          Send Auth Email **** {{ substr($billingDetails->cc_number, -4) }}  <!-- state: {{$billingDetails->state}} , card : {{$billingDetails->id}} -->
                      </button>
                   @endif
                 @endif
            @endforeach

        
                
            
                <button class="btn btn-custom btn-mail d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#sendMailModal"
                 data-booking_id="1"
                data-card_id="1"
                data-card_billing_id="1"
                data-email="1"
                data-bs-dismiss="modal"><i class="ri ri-mail-open-fill"></i>  Send Auth Mail
                </button>
          

                <button class="btn btn-custom btn-survey d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#surveyModal" 
                data-booking_id="1"
                data-card_id="1"
                data-card_billing_id="1"
                data-id="1" data-bs-dismiss="modal"><i class="ri ri-survey-fill"></i> Send Auth Survey </button>
         
            
        </div>
      </div>
    </div>
  </div>



  <!-- Send Mail Modal -->
  <div class="modal fade" id="sendAuthMailModal" tabindex="-1" aria-labelledby="sendMailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Send Mail</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form id="sendAuthEmail" action="{{route('mail-sent')}}">
              @csrf
               <input type="hidden" name="id" id="auth_id" value="{{$booking->id}}">
               <input type="hidden" name="booking_id_encode" id="booking_id_encode" value="{{encode($booking->id)}}">
                <input type="hidden" name="booking_id" id="booking_id"/>
                <input type="hidden" name="card_id" id="card_id"/>
                <input type="hidden" name="card_billing_id" id="card_billing_id"/>
                <input type="hidden" name="email" id="email"/>
                <div class="row checkbox-servis">
                    
                      <div class="col-md-4 position-relative">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="refund_status" id="refundable" value="refundable">
                            <label style="width: auto !important;" class="form-check-label" for="refundable">
                                Refundable
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="refund_status" id="non-refundable" value="non-refundable">
                            <label style="width: auto !important;" class="form-check-label" for="non-refundable">
                                Non-Refundable
                            </label>
                        </div>


                       
                      </div>

                      <div class="col-md-4 position-relative">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="auth_type" id="EMAIL" value="EMAIL" cheked>
                            <label style="width: auto !important; color:#000!important;" class="form-check-label" for="EMAIL">
                                Email
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="auth_type" id="EMAIL_SMS" value="EMAIL_SMS">
                            <label style="width: auto !important; color:#000!important;" class="form-check-label" for="EMAIL_SMS">
                                 SMS
                            </label>
                        </div>


                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="auth_type" id="EMAIL_WHATSAPP" value="EMAIL_WHATSAPP" disabled >
                            <label style="width: auto !important; color:#000!important;" class="form-check-label" for="EMAIL_WHATSAPP">
                                whatsapp
                            </label>
                        </div>
                      </div>

                    <div class="col-md-4 d-flex align-items-end justify-content-end">
                        <button id="sendAuthBtn" class="btn btn-sm btn-primary text-center" style="font-size: 14px;" onclick="this.disabled=true; this.innerHTML='Sending...';">Send Auth</button>
                    </div>

                </div>
            </form>

            <div id="load_model" class="mt-3 send_auth_mail_popup">
                <!-- Loaded dynamically -->
            </div>

        </div>

      </div>
    </div>
  </div>



  <!-- Survey Modal -->
  <div class="modal fade" id="surveyModal" tabindex="-1" aria-labelledby="surveyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="surveyModalLabel">Create Survey</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="survey-preview">
            <p>Hello (Customer Name),</p>
            <p>It’s been a pleasure working with you. We’re always looking to improve, and your feedback would be incredibly valuable to us.</p>
            <p>Would you be open to writing a short review or testimonial?</p>
            <p>➤ [Review Link]</p>
            <p>Thank you again for trusting Faretickets LLC.</p>
          </div>

          <form id="sendSurvey" action="{{ route('survey', $booking->id) }}" method="POST">
            @csrf
            <button class="send-btn">Send Survey</button>
          </form>

        </div>
      </div>
    </div>
  </div>

  <!-- <script>
    // Function to show buttons with delay
    document.addEventListener('DOMContentLoaded', function () {
      const callLogsModal = document.getElementById('callLogsModal');
      callLogsModal.addEventListener('shown.bs.modal', function () {
        const buttons = document.querySelectorAll('#callLogsModal .btn-custom');
        buttons.forEach((button, index) => {
          setTimeout(() => {
            button.style.display = 'block';
            button.classList.add('animate__animated', 'animate__fadeInUp');
          }, index * 1000); // 1-second delay for each button
        });
      });

      // Reset button visibility when modal is hidden
      callLogsModal.addEventListener('hidden.bs.modal', function () {
        const buttons = document.querySelectorAll('#callLogsModal .btn-custom');
        buttons.forEach(button => {
          button.style.display = 'none';
          button.classList.remove('animate__animated', 'animate__fadeInUp');
        });
      });
    });
  </script> -->

    <style>
    .btn-custom {
      display: none; /* Initially hidden for animation */
      width: 100%;
      margin-bottom: 10px;
      padding: 10px;
      background-color: #25D366; /* WhatsApp green */
      color: white;
      border-radius: 20px;
      text-align: left;
      font-size: 16px;
      transition: background-color 0.2s;
    }
    .btn-custom:hover {
      background-color: #1ebe57; /* Darker green on hover */
    }
    .btn-custom i {
      margin-right: 10px;
    }
    .modal-content {
      border-radius: 15px;
    }
    .modal-body {
      padding: 20px;
    }
    .send-btn {
      background-color: #25D366;
      color: white;
      border-radius: 20px;
      padding: 10px 20px;
      border: none;
      font-size: 16px;
      margin-top: 20px;
      display: block;
      margin-left: auto;
    }
    .send-btn:hover {
      background-color: #1ebe57;
    }
    .preview-box {
      background-color: #f0f0f0;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
      font-size: 14px;
      line-height: 22px;
    }
    .sms-preview, .whatsapp-preview, .survey-preview {
      background-color: #ECE5DD; /* WhatsApp chat background */
      border-radius: 10px;
      padding: 10px;
      margin-bottom: 20px;
    }
    .sms-preview p, .whatsapp-preview p, .survey-preview p {
      background-color: #FFFFFF;
      border-radius: 10px;
      padding: 10px;
      margin: 5px 10px 5px 10px;
      display: inline-block;
    }
  </style>
