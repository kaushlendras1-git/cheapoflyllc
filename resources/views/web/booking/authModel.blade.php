<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
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
</head>
<body>

<!-- Button to trigger call logs modal -->
  <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#callLogsModal">
    Send Auth
  </button>

  <!-- Call Logs Modal without fade -->
  <div class="modal" id="callLogsModal" tabindex="-1" aria-labelledby="callLogsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 470px;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="callLogsModalLabel">Send Auth</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body auth-btn-style">
          <button class="btn btn-custom d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#sendMailModal" data-bs-dismiss="modal"><i class="ri ri-mail-open-fill"></i>  Send Mail</button>
          <button class="btn btn-custom d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#smsModal" data-bs-dismiss="modal"><i class="ri ri-chat-1-fill"></i> SMS</button>
          <button class="btn btn-custom d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#whatsappModal" data-bs-dismiss="modal"><i class="ri ri-whatsapp-fill"></i> WhatsApp</button>
          <button class="btn btn-custom d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#surveyModal" data-bs-dismiss="modal"><i class="ri ri-survey-fill"></i> Survey</button>
          <a style="color: #fff !important;" class="btn btn-custom d-block text-center" href="{{ route('signature.form') }}" >Authorization Link</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Send Mail Modal -->
  <div class="modal fade" id="sendMailModal" tabindex="-1" aria-labelledby="sendMailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="sendMailModalLabel">Send Mail</h5>

     <!-- <a href="{{ route('signature.form') }}" >Authorization Link</a> -->
          
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>
        <div class="modal-body">
          
            <form id="sendAuthEmail" action="{{ route('booking.auth-email.sendmail', $booking->id) }}" method="POST">
            @csrf
                   <div class="d-flex align-items-center">
                     <label class="me-3" style="display: flex; align-items: center; gap: 5px;">
                        <input type="checkbox" name="subscribe" value="yes"> xxx8956
                    </label>
                    <label class="me-3" style="display: flex; align-items: center; gap: 5px;">
                        <input type="checkbox" name="terms" value="accepted"> xxx7412
                    </label>
                    <label style="display: flex; align-items: center; gap: 5px;">
                        <input type="checkbox" name="terms" value="accepted"> All
                    </label>
                   </div>
                    <button class="btn btn-info send-auth-btn" style="font-size: 14px; padding: 5px 10px;">Send Auth</button>
            </form>

          <table align="center" border="0" cellpadding="0" cellspacing="0" style="max-width: 600px; width: 100%; margin: 20px auto; background: #fff; border: 1px solid #ddd;">
            <tr>
              <td style="padding: 20px;">
                <!-- Header -->
                <table width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td style="width: 33%; padding: 10px;">
                      <img src="https://www.fareticketsllc.com/assets/img/logo-dark.webp" alt="Faretickets LLC Logo" style="max-width: 120px; height: auto;">
                    </td>
                    <td style="width: 33%; text-align: center; font-size: 14px; color: #333; line-height: 24px;">
                      Book Online or Call Us 24/7
                    </td>
                    <td style="width: 33%; text-align: right; padding: 10px;">
                      <img src="https://www.cheapoflyllc.com/images/24hour.png" alt="24/7 Support" style="max-width: 50px; height: auto; vertical-align: middle;">
                      <strong style="color: #ff1a09; font-size: 16px;">+1-844-382-2225</strong>
                    </td>
                  </tr>
                </table>

                <!-- Greeting -->
                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 20px;">
                  <tr>
                    <td style="padding: 20px; font-size: 14px; line-height: 24px;">
                      <strong>Dear Customer,</strong>
                      <p style="margin: 10px 0;">Thank you for choosing Faretickets LLC for your travel needs. Please review your booking details below. This is a confirmation of your booking and not your E-ticket.</p>
                      <p style="margin: 10px 0;">Team <a href="https://www.fareticketsllc.com" style="color: #0867c9; text-decoration: none; font-weight: bold;">Faretickets LLC</a></p>
                    </td>
                  </tr>
                </table>

                <!-- Booking Status -->
                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 10px; border: 1px solid #ddd;">
                  <tr>
                    <td style="background: #273c75; color: #fff; font-size: 16px; padding: 10px; font-weight: bold;">
                      <img src="https://www.cheapoflyllc.com/images/img-3.png" alt="Booking Status Icon" style="vertical-align: middle; margin-right: 5px;"> Booking Status
                    </td>
                  </tr>
                  <tr>
                    <td style="padding: 15px;">
                      <span style="color: #07910c; font-weight: bold;">
                        <svg style="vertical-align: middle; margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16">
                          <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708l-2 2zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708l-2 2zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"></path>
                        </svg>
                        Your Booking is Under Process!
                      </span>
                      <p style="font-size: 14px; line-height: 22px; margin: 10px 0;">
                        Thank you for your booking. Your payment method will be verified, and your E-ticket will be emailed within 24 hours.
                      </p>
                      <p style="font-size: 14px; line-height: 22px; margin: 10px 0;">
                        <strong>Booking Reference:</strong> INT29060202244<br>
                        <strong>Booking Date:</strong> Sunday, Jun 29, 2025
                      </p>
                    </td>
                  </tr>
                </table>

                <!-- Customer Information -->
                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 10px; border: 1px solid #ddd;">
                  <tr>
                    <td style="background: #273c75; color: #fff; font-size: 16px; padding: 10px; font-weight: bold;">
                      <svg style="vertical-align: middle; margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square-fill" viewBox="0 0 16 16">
                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path>
                      </svg>
                      Customer Information
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <table width="100%" cellpadding="0" cellspacing="0">
                        <tr style="background: #e9ebf1;">
                          <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd;">Card Holder Name</td>
                          <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd; font-weight: bold;">Gordon Scott Mcknight</td>
                        </tr>
                        <tr>
                          <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd; background: #e9ebf1;">Email</td>
                          <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd; font-weight: bold;">maryann.guitar@yahoo.ca</td>
                        </tr>
                        <tr style="background: #e9ebf1;">
                          <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd;">Booking Date</td>
                          <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd; font-weight: bold;">Sunday, Jun 29, 2025</td>
                        </tr>
                        <tr>
                          <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd; background: #e9ebf1;">Airline Ref</td>
                          <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd; font-weight: bold;">4QO44P/4QNGLG</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>

                <!-- Passenger Details -->
                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 10px; border: 1px solid #ddd;">
                  <tr>
                    <td style="background: #273c75; color: #fff; font-size: 16px; padding: 10px; font-weight: bold;">
                      <svg style="vertical-align: middle; margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"></path>
                      </svg>
                      Passenger Details
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <table width="100%" cellpadding="0" cellspacing="0">
                        <tr style="background: #e9ebf1;">
                          <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd; font-weight: bold;">Passenger Name</td>
                          <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd; font-weight: bold;">Type</td>
                        </tr>
                        <tr>
                          <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd;">Mary Ann Mcknight</td>
                          <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd;">Adult</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>

                <!-- Itinerary Summary -->
                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 10px; border: 1px solid #ddd;">
                  <tr>
                    <td style="background: #273c75; color: #fff; font-size: 16px; padding: 10px; font-weight: bold;">
                      <svg style="vertical-align: middle; margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89.471-1.178-1.178.471L5.93 9.363l.338.215a.5.5 0 0 1 .154.154l.215.338 7.494-7.494Z"></path>
                      </svg>
                      Itinerary Summary
                    </td>
                  </tr>
                  <tr>
                    <td style="padding: 10px;">
                      <img src="http://www.cheapoflyllc.com/images/F/29062025120225.png" alt="Itinerary Image 1" style="max-width: 100%; height: auto; display: block;">
                      <img src="http://www.cheapoflyllc.com/images/F/29062025120642.png" alt="Itinerary Image 2" style="max-width: 100%; height: auto; display: block; margin-top: 10px;">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        
        </div>
      </div>
    </div>
  </div>

  <!-- SMS Modal -->
  <div class="modal fade" id="smsModal" tabindex="-1" aria-labelledby="smsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="smsModalLabel">Send SMS</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="sms-preview">
            <p>Dear Mary Ann Mcknight, your booking (Ref: INT29060202244) is under process. E-ticket will be sent within 24 hours. Contact +1-844-382-2225 for assistance. - Faretickets LLC</p>
          </div>

          <form id="sendSMS" action="{{ route('sms', $booking->id) }}" method="POST">
            @csrf
            <button class="send-btn">Send SMS</button>
        </form>


         
        </div>
      </div>
    </div>
  </div>

  <!-- WhatsApp Modal -->
  <div class="modal fade" id="whatsappModal" tabindex="-1" aria-labelledby="whatsappModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="whatsappModalLabel">Send WhatsApp Message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="whatsapp-preview">
            <p>Dear Mary Ann Mcknight, your booking (Ref: INT29060202244) is under process. Your E-ticket will be emailed within 24 hours. For assistance, call +1-844-382-2225. - Faretickets LLC</p>
          </div>
          
           <form id="sendWhatsApp" action="{{ route('whatsup', $booking->id) }}" method="POST">
            @csrf
            <button class="send-btn">Send WhatsApp</button>
           </form>


        
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
            <p>How satisfied are you with your booking experience at Faretickets LLC? Please rate from 1 to 5 and share your feedback. Ref: INT29060202244</p>
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
