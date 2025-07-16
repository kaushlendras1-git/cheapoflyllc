<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - Faretickets LLC</title>
</head>

<body style="margin: 0; padding: 0; font-family: 'Roboto', Arial, sans-serif; background-color: #f4f4f4; color: #333;">
    <!-- <table align="center" border="0" cellpadding="0" cellspacing="0"
        style="max-width: 600px; width: 100%; margin: 20px auto; background: #fff; border: 1px solid #ddd;">
        <tr>
            <td style="padding: 20px;">
          
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="width: 33%; padding: 10px;">
                            <img src="https://www.fareticketsllc.com/assets/img/logo-dark.webp"
                                alt="Faretickets LLC Logo" style="max-width: 120px; height: auto;">
                        </td>
                        <td style="width: 33%; text-align: center; font-size: 14px; color: #333; line-height: 24px;">
                            Book Online or Call Us 24/7
                        </td>
                        <td style="width: 33%; text-align: right; padding: 10px;">
                            <img src="https://www.cheapoflyllc.com/images/24hour.png" alt="24/7 Support"
                                style="max-width: 50px; height: auto; vertical-align: middle;">
                            <strong style="color: #ff1a09; font-size: 16px;">+1-844-382-2225</strong>
                        </td>
                    </tr>
                </table>

                
                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 20px;">
                    <tr>
                        <td style="padding: 20px; font-size: 14px; line-height: 24px;">
                            <strong>Dear {{ $user->name ?? 'Customer' }},</strong>
                            <p style="margin: 10px 0;">Thank you for choosing Faretickets LLC for your travel needs.
                                Please review your booking details below. This is a confirmation of your booking and not
                                your E-ticket.</p>
                            <p style="margin: 10px 0;">Team <a href="https://www.fareticketsllc.com"
                                    style="color: #0867c9; text-decoration: none; font-weight: bold;">Faretickets
                                    LLC</a></p>
                        </td>
                    </tr>
                </table>

               
                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 10px; border: 1px solid #ddd;">
                    <tr>
                        <td
                            style="background: #273c75; color: #fff; font-size: 16px; padding: 10px; font-weight: bold;">
                            <img src="https://www.cheapoflyllc.com/images/img-3.png" alt="Booking Status Icon"
                                style="vertical-align: middle; margin-right: 5px;"> Booking Status
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 15px;">
                            <span style="color: #07910c; font-weight: bold;">
                                <svg style="vertical-align: middle; margin-right: 5px;"
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-ui-checks" viewBox="0 0 16 16">
                                    <path
                                        d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708l-2 2zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708l-2 2zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z">
                                    </path>
                                </svg>
                                Your Booking is Under Process!
                            </span>
                            <p style="font-size: 14px; line-height: 22px; margin: 10px 0;">
                                Thank you for your booking. Your payment method will be verified, and your E-ticket will
                                be emailed within 24 hours.
                            </p>
                            <p style="font-size: 14px; line-height: 22px; margin: 10px 0;">
                                <strong>Booking Reference:</strong> {{ $booking->reference ?? 'INT29060202244' }}<br>
                                <strong>Booking Date:</strong> {{ $booking->date ?? 'Sunday, Jun 29, 2025' }}
                            </p>
                        </td>
                    </tr>
                </table>

                
                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 10px; border: 1px solid #ddd;">
                    <tr>
                        <td
                            style="background: #273c75; color: #fff; font-size: 16px; padding: 10px; font-weight: bold;">
                            <svg style="vertical-align: middle; margin-right: 5px;" xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-info-square-fill"
                                viewBox="0 0 16 16">
                                <path
                                    d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z">
                                </path>
                            </svg>
                            Customer Information
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr style="background: #e9ebf1;">
                                    <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd;">Card Holder Name
                                    </td>
                                    <td
                                        style="font-size: 14px; padding: 10px; border: 1px solid #ddd; font-weight: bold;">
                                        {{ $user->name ?? 'Gordon Scott Mcknight' }}</td>
                                </tr>
                                <tr>
                                    <td
                                        style="font-size: 14px; padding: 10px; border: 1px solid #ddd; background: #e9ebf1;">
                                        Email</td>
                                    <td
                                        style="font-size: 14px; padding: 10px; border: 1px solid #ddd; font-weight: bold;">
                                        {{ $user->email ?? 'maryann.guitar@yahoo.ca' }}</td>
                                </tr>
                                <tr style="background: #e9ebf1;">
                                    <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd;">Booking Date
                                    </td>
                                    <td
                                        style="font-size: 14px; padding: 10px; border: 1px solid #ddd; font-weight: bold;">
                                        {{ $booking->date ?? 'Sunday, Jun 29, 2025' }}</td>
                                </tr>
                                <tr>
                                    <td
                                        style="font-size: 14px; padding: 10px; border: 1px solid #ddd; background: #e9ebf1;">
                                        Airline Ref</td>
                                    <td
                                        style="font-size: 14px; padding: 10px; border: 1px solid #ddd; font-weight: bold;">
                                        {{ $booking->airline_ref ?? '4QO44P/4QNGLG' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                
                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 10px; border: 1px solid #ddd;">
                    <tr>
                        <td
                            style="background: #273c75; color: #fff; font-size: 16px; padding: 10px; font-weight: bold;">
                            <svg style="vertical-align: middle; margin-right: 5px;" xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill"
                                viewBox="0 0 16 16">
                                <path
                                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z">
                                </path>
                            </svg>
                            Passenger Details
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr style="background: #e9ebf1;">
                                    <td
                                        style="font-size: 14px; padding: 10px; border: 1px solid #ddd; font-weight: bold;">
                                        Passenger Name</td>
                                    <td
                                        style="font-size: 14px; padding: 10px; border: 1px solid #ddd; font-weight: bold;">
                                        Type</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd;">
                                        {{ $passenger->name ?? 'Mary Ann Mcknight' }}</td>
                                    <td style="font-size: 14px; padding: 10px; border: 1px solid #ddd;">
                                        {{ $passenger->type ?? 'Adult' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                
                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 10px; border: 1px solid #ddd;">
                    <tr>
                        <td
                            style="background: #273c75; color: #fff; font-size: 16px; padding: 10px; font-weight: bold;">
                            <svg style="vertical-align: middle; margin-right: 5px;" xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89.471-1.178-1.178.471L5.93 9.363l.338.215a.5.5 0 0 1 .154.154l.215.338 7.494-7.494Z">
                                </path>
                            </svg>
                            Itinerary Summary
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">
                            <img src="{{ $itinerary->image1 ?? 'http://www.cheapoflyllc.com/images/F/29062025120225.png' }}"
                                alt="Itinerary Image 1" style="max-width: 100%; height: auto; display: block;">
                            <img src="{{ $itinerary->image2 ?? 'http://www.cheapoflyllc.com/images/F/29062025120642.png' }}"
                                alt="Itinerary Image 2"
                                style="max-width: 100%; height: auto; display: block; margin-top: 10px;">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table> -->
</body>

</html>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signature Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Dancing+Script&family=Sacramento&family=Pacifico&family=Satisfy&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <style>
    #signatureCanvas {
        border: 1px solid #007bff;
        border-radius: 8px;
        width: 100%;
        height: 100px;
    }

    .signature-preview {
        border: 1px dashed #007bff;
        padding: 10px;
        text-align: center;
        margin-top: 10px;
        font-size: 30px;
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <!-- Add Signature Button -->
        <div class="text-center my-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signatureModal">Add
                Signature</button>
        </div>

        <!-- Signature Preview -->
        <div id="signaturePreview" class="signature-preview d-none">No signature added.</div>

        <!-- I Authorized Button -->
        <form id="authorizationForm" method="POST" action="{{ route('signature.store') }}">
            @csrf
            <input type="hidden" name="signature" id="signatureData">
            <button type="submit" class="btn btn-success mt-3" id="authorizeButton" disabled>I Authorized</button>
        </form>
    </div>

    <!-- Signature Modal -->
    <div class="modal fade" id="signatureModal" tabindex="-1" aria-labelledby="signatureModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signatureModalLabel">Add Signature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" id="signatureTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="draw-tab" data-bs-toggle="tab" data-bs-target="#draw"
                                type="button" role="tab" aria-controls="draw" aria-selected="true">Draw</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="type-tab" data-bs-toggle="tab" data-bs-target="#type"
                                type="button" role="tab" aria-controls="type" aria-selected="false">Type</button>
                        </li>
                    </ul>
                    <div class="tab-content mt-3">
                        <!-- Draw Tab -->
                        <div class="tab-pane fade show active" id="draw" role="tabpanel" aria-labelledby="draw-tab">
                            <canvas id="signatureCanvas"></canvas>
                            <button type="button" class="btn btn-secondary mt-2" id="clearButton">Clear</button>
                        </div>
                        <!-- Type Tab -->
                        <div class="tab-pane fade" id="type" role="tabpanel" aria-labelledby="type-tab">
                            <label for="typedName" class="form-label">Type your name:</label>
                            <input type="text" id="typedName" class="form-control" placeholder="Enter your name">
                            <label for="fontSelect" class="form-label mt-2">Select Font:</label>
                            <select id="fontSelect" class="form-select">
                                <option value="Great Vibes">Great Vibes</option>
                                <option value="Dancing Script">Dancing Script</option>
                                <option value="Sacramento">Sacramento</option>
                                <option value="Pacifico">Pacifico</option>
                                <option value="Satisfy">Satisfy</option>
                            </select>
                            <div id="preview" class="signature-preview mt-2">Preview: </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="addSignatureButton">Add Signature</button>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const canvas = document.getElementById('signatureCanvas');
        const signaturePad = new SignaturePad(canvas);
        const clearButton = document.getElementById('clearButton');
        const addSignatureButton = document.getElementById('addSignatureButton');
        const typedNameInput = document.getElementById('typedName');
        const fontSelect = document.getElementById('fontSelect');
        const preview = document.getElementById('preview');
        const signaturePreview = document.getElementById('signaturePreview');
        const authorizeButton = document.getElementById('authorizeButton');
        const signatureDataInput = document.getElementById('signatureData');

        // Function to resize the canvas
        const resizeCanvas = () => {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext('2d').scale(ratio, ratio);
            signaturePad.clear();
        };

        // Resize canvas when the modal is shown
        const signatureModal = document.getElementById('signatureModal');
        signatureModal.addEventListener('shown.bs.modal', () => {
            resizeCanvas(); // Resize the canvas when the modal opens
        });

        // Clear Button for Draw Signature
        clearButton.addEventListener('click', () => {
            signaturePad.clear();
        });

        // Update Preview for Typed Signature
        const updatePreview = () => {
            const name = typedNameInput.value;
            const font = fontSelect.value;
            preview.style.fontFamily = font;
            preview.textContent = name ? name : 'Preview: ';
        };

        typedNameInput.addEventListener('input', updatePreview);
        fontSelect.addEventListener('change', updatePreview);

        // Add Signature Button Logic
        addSignatureButton.addEventListener('click', () => {
            const activeTab = document.querySelector('.nav-link.active').id;
            if (activeTab === 'draw-tab') {
                if (signaturePad.isEmpty()) {
                    alert('Please draw a signature.');
                    return;
                }
                const signatureData = signaturePad.toDataURL();
                signatureDataInput.value = signatureData;
                signaturePreview.innerHTML =
                    `<img src="${signatureData}" alt="Signature" style="max-width: 100%;">`;
            } else if (activeTab === 'type-tab') {
                const name = typedNameInput.value;
                const font = fontSelect.value;
                if (!name) {
                    alert('Please type your name.');
                    return;
                }
                const signatureHTML =
                    `<span style="font-family: ${font}; font-size: 24px;">${name}</span>`;
                signatureDataInput.value = signatureHTML; // Save as HTML for backend
                signaturePreview.innerHTML = signatureHTML;
            }

            // Update UI
            signaturePreview.classList.remove('d-none');
            authorizeButton.disabled = false;

            // Close modal
            const modal = bootstrap.Modal.getInstance(signatureModal);
            modal.hide();
        });

        // Reset Modal on Close
        signatureModal.addEventListener('hidden.bs.modal', () => {
            signaturePad.clear();
            typedNameInput.value = '';
            preview.textContent = 'Preview: ';
        });
    });
    </script>
    <table style="background-color: #fff; margin: auto; width: 45%; border: 1px solid #d2d2d2;">
        <thead>
            <tr style="background-color: #e4e4e4;">
                <th style="padding: 10px;"><img width="120"
                        src="https://www.fareticketsllc.com/assets/img/logo-dark.webp" alt="Faretickets LLC Logo"></th>
                <th style="text-align: right; padding: 20px 20px 10px 10px;">
                    <p style="font-size: 16px; margin-bottom: 0px; font-weight: 600;"> Book Online or Call Us 24/7 </p>
                    <p style="font-size: 16px; margin-bottom: 0px; font-weight: 600; color: #ff1c0b;"> <a
                            style="color: #ff1c0b; text-decoration: none;" href="tel:+1-844-382-2225"><img
                                style="margin-right: 10px;" src="https://www.cheapoflyllc.com/images/24hour.png"
                                alt="24/7 Support" style="max-width: 50px; height: auto; vertical-align: middle;">
                            +1-844-382-2225</a> </p>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size: 18px; font-weight: 700; padding: 20px 30px 5px 30px;" colspan="2"> Dear {{ $user->name ?? 'Customer' }}, 
                </td>
            </tr>
            <tr>
                <td style="font-size: 14px; padding: 0px 30px 5px 30px; text-align: justify; color: #646464;"
                    colspan="2">Thank you for choosing Faretickets LLC for your travel needs. Please review your booking
                    details below. This is a confirmation of your booking and not your E-ticket.</td>
            </tr>
            <tr>
                <td style="text-align: right; padding: 10px 30px 5px 30px; font-size: 16px; font-weight: 500;"
                    colspan="2">Team <a style="color: #ff1a09; font-weight: 600;" href="#">Faretickets LLC</a> </td>
            </tr>
            <tr>
                <td style="padding: 10px 30px 5px 30px;" colspan="2">
                    <table style="width: 100%; border: 1px solid #dbdbdb;">
                        <tr style="background-color: #65ad8c;">
                            <td style="font-size: 14px; font-weight: 600; color: #fff; padding: 10px;" colspan="2">
                                <img src="https://www.cheapoflyllc.com/images/img-3.png" alt="Booking Status Icon"
                                    style="vertical-align: middle; margin-right: 5px;"> Booking Status
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"
                                style="color: #c0ad31; text-align: center; font-size: 14px; font-weight: 700; padding: 10px 30px 10px 30px;">
                                Your Booking is Under Process!
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"
                                style="font-size: 14px; font-weight: 400; color: #646464; padding: 0px 32px 20px 32px; text-align: center;">
                                Thank you for your booking. Your payment method will be verified, and your E-ticket will
                                be emailed within 24 hours.</td>
                        </tr>
                        <tr>
                            <td style="font-size: 16px; font-weight: 600; padding: 0px 0px 0px 120px; width: 50%;">
                                Booking Reference:</td>
                            <td style="color: #646464;">{{ $booking->reference ?? 'INT29060202244' }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 16px; font-weight: 600; padding: 0px 0px 20px 120px; width: 50%;">
                                Booking Date:</td>
                            <td style="padding-bottom: 20px; color: #646464;">{{ $booking->date ?? 'Sunday, Jun 29, 2025' }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px 30px 5px 30px;" colspan="2">
                    <table style="width: 100%; border: 1px solid #dbdbdb;">
                        <tr style="background-color: #65ad8c;">
                            <td style="font-size: 14px; font-weight: 600; color: #fff; padding: 10px;" colspan="2">
                                <svg style="vertical-align: middle; margin-right: 5px;"
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-info-square-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z">
                                    </path>
                                </svg>
                                Customer Information
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #dfdfdf;">
                            <td
                                style="font-size: 14px; font-weight: 600; padding: 5px 0px 5px 30px; width: 50%; border-right: 1px solid #dfdfdf;">
                                Card Holder Name</td>
                            <td style="padding: 5px 30px 5px 20px; font-size: 14px; color: #646464;">{{ $user->name ?? 'Gordon Scott Mcknight' }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #dfdfdf;">
                            <td
                                style="font-size: 14px; font-weight: 600; padding: 5px 0px 5px 30px; width: 50%; border-right: 1px solid #dfdfdf;">
                                Email</td>
                            <td style="padding: 5px 30px 5px 20px; font-size: 14px; color: #646464;">
                                {{ $user->email ?? 'maryann.guitar@yahoo.ca' }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #dfdfdf;">
                            <td
                                style="font-size: 14px; font-weight: 600; padding: 5px 0px 5px 30px; width: 50%; border-right: 1px solid #dfdfdf;">
                                Booking Date</td>
                            <td style="padding: 5px 30px 5px 20px; font-size: 14px; color: #646464;">{{ $booking->date ?? 'Sunday, Jun 29, 2025' }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #dfdfdf;">
                            <td
                                style="font-size: 14px; font-weight: 600; padding: 5px 0px 5px 30px; width: 50%; border-right: 1px solid #dfdfdf;">
                                Airline Ref</td>
                            <td style="padding: 5px 30px 5px 20px; font-size: 14px; color: #646464;">{{ $booking->airline_ref ?? '4QO44P/4QNGLG' }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px 30px 5px 30px;" colspan="2">
                    <table style="width: 100%; border: 1px solid #dbdbdb;">
                        <tr style="background-color: #65ad8c;">
                            <td style="font-size: 14px; font-weight: 600; color: #fff; padding: 10px;" colspan="2">
                                <svg style="vertical-align: middle; margin-right: 5px;"
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z">
                                    </path>
                                </svg>
                                Passenger Details
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #dfdfdf;">
                            <td
                                style="font-size: 14px; font-weight: 600; padding: 5px 0px 5px 30px; width: 50%; border-right: 1px solid #dfdfdf;">
                                Passenger Name</td>
                            <td style="font-size: 14px; font-weight: 600; padding: 5px 30px 5px 20px; width: 50%; ">Type
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #dfdfdf;">
                            <td
                                style="padding: 5px 0px 5px 30px; font-size: 14px; border-right: 1px solid #dfdfdf; color: #646464;">
                                {{ $passenger->name ?? 'Mary Ann Mcknight' }}</td>
                            <td style="padding: 5px 30px 5px 20px; font-size: 14px; color: #646464;">{{ $passenger->type ?? 'Adult' }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="padding: 10px 30px 5px 30px;">
                    <table style="width: 100%; border: 1px solid #dbdbdb;">
                        <tr>
                            <td
                                style="font-size: 16px; font-weight: 700; color: #000; text-align: center; padding: 20px 30px 10px 30px;">
                                Please cancel this Booking!</td>
                        </tr>
                        <tr>
                            <td
                                style="font-size: 14px; font-weight: 400; color: #646464; padding: 0px 30px 10px 30px; text-align:center;">
                                I, Miker Test, Authorize fareticketsllc to charge my VISA Credit/Debit Card, ending with
                                1111 for the total amount of USD 2000.00 to cancel the below Flight ticket/tickets</td>
                        </tr>
                        <tr>
                            <td
                                style="font-size: 14px; font-weight: 400; color: #000; padding: 0px 30px 10px 30px; text-align:center;">
                                By Clicking on Authorize button, you agree to below mentioned terms.</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; padding: 0px 30px 20px 30px;">
                                <form id="authorizationForm" method="POST" action="{{ route('signature.store') }}">
                                    @csrf
                                    <input type="hidden" name="signature" id="signatureData">
                                    <button style="background:#119516; padding:10px 20px; border-radius:2px;font-size:14px; color:#fff; font-weight:500; border: 1px solid transparent; border-radius: 3px;" type="submit" id="authorizeButton">I Authorized</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>