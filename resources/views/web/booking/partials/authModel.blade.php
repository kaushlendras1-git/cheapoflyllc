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
  <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill auth-button" data-bs-toggle="modal" data-bs-target="#callLogsModal">
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
          
        <button class="btn btn-custom d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#sendMailModal"  
        data-id="{{ $booking->id }}" 
        data-email1="credentials@cheapoflytravel.com" 
        data-email2="kaushlendras1@gmail.com"
        data-bs-dismiss="modal">
        <i class="ri ri-mail-open-fill"></i>  Send Mail</button>


          <button class="btn btn-custom d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#smsModal" data-id="{{ $booking->id }}"  data-bs-dismiss="modal"><i class="ri ri-chat-1-fill"></i> SMS</button>
          <button class="btn btn-custom d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#whatsappModal" data-id="{{ $booking->id }}"  data-bs-dismiss="modal"><i class="ri ri-whatsapp-fill"></i> WhatsApp</button>
          <button class="btn btn-custom d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#surveyModal" data-id="{{ $booking->id }}"  data-bs-dismiss="modal"><i class="ri ri-survey-fill"></i> Survey</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Send Mail Modal -->
<div class="modal fade" id="sendMailModal" tabindex="-1" aria-labelledby="sendMailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Send Mail</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="sendAuthEmail">
          @csrf
          <input type="hidden" name="id" id="auth_id">
          <input type="hidden" name="email1" id="auth_email1">
          <input type="hidden" name="email2" id="auth_email2">

          <div class="mb-3">
            <label><input type="checkbox" name="auth_email[]" value="credentials@cheapoflytravel.com" checked> credentials@cheapoflytravel.com</label><br>
            <label><input type="checkbox" name="auth_email[]" value="kaushlendras1@gmail.com"> kaushlendras1@gmail.com</label><br>
            <label><input type="checkbox" class="check-all" name="terms" value="accepted"> All</label>
        </div>

          <button class="btn btn-info send-auth-btn" style="font-size: 14px; padding: 5px 10px;">Send Auth</button>
        </form>

        <div id="load_model" class="mt-3">
            <!-- Loaded dynamically -->
        </div>
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
