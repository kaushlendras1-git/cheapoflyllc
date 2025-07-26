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
    <!-- <table style="background-color: #fff; margin: auto; width: 45%; border: 1px solid #d2d2d2;">
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
                            +1-844-382-2225</a> </ p>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size: 18px; font-weight: 700; padding: 20px 30px 5px 30px;" colspan="2"> Dear
                    {{ $user->name ?? 'Customer' }},
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
                            <td style="padding-bottom: 20px; color: #646464;">
                                {{ $booking->date ?? 'Sunday, Jun 29, 2025' }}</td>
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
                            <td style="padding: 5px 30px 5px 20px; font-size: 14px; color: #646464;">
                                {{ $user->name ?? 'Gordon Scott Mcknight' }}</td>
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
                            <td style="padding: 5px 30px 5px 20px; font-size: 14px; color: #646464;">
                                {{ $booking->date ?? 'Sunday, Jun 29, 2025' }}</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #dfdfdf;">
                            <td
                                style="font-size: 14px; font-weight: 600; padding: 5px 0px 5px 30px; width: 50%; border-right: 1px solid #dfdfdf;">
                                Airline Ref</td>
                            <td style="padding: 5px 30px 5px 20px; font-size: 14px; color: #646464;">
                                {{ $booking->airline_ref ?? '4QO44P/4QNGLG' }}</td>
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
                            <td style="padding: 5px 30px 5px 20px; font-size: 14px; color: #646464;">
                                {{ $passenger->type ?? 'Adult' }}</td>
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
                                    <button
                                        style="background:#119516; padding:10px 20px; border-radius:2px;font-size:14px; color:#fff; font-weight:500; border: 1px solid transparent; border-radius: 3px;"
                                        type="submit" id="authorizeButton">I Authorized</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tfoot>
    </table> -->

    <table style="width: 45%; margin: auto; background-color: #fff;">
        <thead>
            <tr>
                <td style="padding-left: 15px; padding-top: 10px; padding-bottom: 10px;"> <img width="100"
                        src="https://www.fareticketsllc.com/assets/img/logo-dark.webp" alt="logo"> </td>
                <td style="text-align: end; padding-right: 30px; padding-top: 10px; padding-bottom: 10px;"> <a
                        style="color: #ff1a09; font-size: 16px; font-weight: 600; text-decoration: none;"
                        href="tel:+1-844-382-2225">
                        <img style="margin-right: 10px;" src="https://www.cheapoflyllc.com/images/24hour.png" alt="call"
                            style="max-width: 50px; height: auto; vertical-align: middle;"> +1-844-382-2225
                    </a>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size: 20px; font-weight: 700; color: #000; padding-left: 30px;" colspan="2">Dear Miker
                    Test,</td>
            </tr>
            <tr>
                <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px;" colspan="2">Thank you
                    for using fareticketsllc for your travel needs. Please take a moment to review the names, date,
                    Flight itinerary, price and other relevant details of your booking.</td>
            </tr>
            <tr>
                <td style="padding: 20px 30px; padding-top: 0px; font-size: 16px; font-weight: 600; color: #696969;">
                    Team <a class="color: #055bdb; text-decoration: none;"
                        href="https://www.fareticketsllc.com/">Fareticketsllc</a> </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 45%; margin: auto; background-color: #fff; margin-top: 10px;">
        <tr>
            <td style="text-align: center; font-size: 20px; font-weight: 700; color: #000; padding: 10px 30px;"
                colspan="2">Booking Status</td>
        </tr>
        <tr>
            <td
                style="font-size: 14px; font-weight: 700; color: #000; text-align: center; padding-top: 10px; padding-bottom: 20px;">
                Booking Reference Number <span style="font-size: 12px; font-weight: 400; display: block;">
                    AGE14073012930 </span> </td>
            <td
                style="font-size: 14px; font-weight: 700; color: #000; text-align: center; padding-top: 10px; padding-bottom: 20px;">
                Booking Date <span style="font-size: 12px; font-weight: 400; display: block;"> Monday, Jul 14,2025
                </span> </td>
        </tr>
    </table>
    <table style="width: 45%; margin: auto; background-color: #fff; border-top: 1px solid #dbdbdb;">
        <tr>
            <td style="text-align: center; font-size: 20px; font-weight: 700; color: #000; padding: 10px 30px;">Customer
                Information</td>
        </tr>
        <tr>
            <td style="padding: 20px 30px;">
                <table style="width: 100%; margin: auto;">
                    <tr>
                        <th
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 600; color: #000;">
                            Card Holder Name</th>
                        <td
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 400; color: #696969;">
                            Miker Test</td>
                    </tr>
                    <tr>
                        <th
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 600; color: #000;">
                            Email</th>
                        <td
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 400; color: #696969;">
                            <a style="color: #055bdb; text-decoration: none;"
                                href="mailto:merv.adams21@gmail.com">merv.adams21@gmail.com</a> </td>
                    </tr>
                    <tr>
                        <th
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 600; color: #000;">
                            Booking Date</th>
                        <td
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 400; color: #696969;">
                            Monday, Jul 14,2025</td>
                    </tr>
                    <tr>
                        <th
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 600; color: #000;">
                            Airline Ref</th>
                        <td
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 400; color: #696969;">
                            DBD60B</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="width: 45%; margin: auto; background-color: #fff; border-top: 1px solid #dbdbdb;">
        <tr>
            <td style="text-align: center; font-size: 20px; font-weight: 700; color: #000; padding: 10px 30px;">
                Passenger Details</td>
        </tr>
        <tr>
            <td style="padding: 20px 30px;">
                <table style="width: 100%; margin: auto;">
                    <tr>
                        <th
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 600; color: #000;">
                            Passenger Name</th>
                        <th
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 600; color: #000;">
                            Type</th>
                    </tr>
                    <tr>
                        <td
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 400; color: #696969;">
                            Merv Testing test</td>
                        <td
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 400; color: #696969;">
                            Adult</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="width: 45%; margin: auto; background-color: #fff; border-top: 1px solid #dbdbdb;">
        <tr>
            <td style="text-align: center; font-size: 20px; font-weight: 700; color: #000; padding: 10px 30px;">Price
                Details (USD)</td>
        </tr>
        <tr>
            <td style="padding: 20px 30px;">
                <table style="width: 100%; margin: auto;">
                    <tr>
                        <th
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 600; color: #000;">
                            Total Price per person including taxes and fees</th>
                        <td
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 400; color: #119516;">
                            2000.00</td>
                    </tr>
                    <tr>
                        <th
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 600; color: #000;">
                            Total Price for Entire Itinerary including taxes and fees</th>
                        <td
                            style="border: 1px solid #dbdbdb; padding: 10px 30px; font-size: 14px; font-weight: 400; color: #119516;">
                            2000.00 </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="width: 45%; margin: auto; background-color: #fff; margin-top: 10px;">
        <tr>
            <td
                style="background-color: #055bdb; font-size: 20px; font-weight: 600; color: #fff; text-align: center; padding: 10px 30px;">
                General Flight Terms and Conditions</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px;">These terms and
                conditions (“terms of use”) apply to you right the moment you access and use our website or make a
                purchase by speaking to an agent on +1-844-382-2225.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 700; color: #000; padding: 10px 30px;">General Conditions</td>
        </tr>
        <tr>
            <td style="font-size: 12px; font-weight: 700; color: #e50000; padding: 10px 30px; padding-top: 0px;">
                Important Note : Tickets are Non-Refundable/Non-Transferable and name changes are not permitted.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px;"> <span
                    style="font-size: 14px; font-weight: 700; color: #000;">NOTE :</span> Date and routing changes will
                be subject to Airline Penalty and Fare Difference if any</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> For
                any modification or changes please contact our Travel Consultant on +1-844-382-2225</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> All
                customers are advised to verify travel documents (transit visa/entry visa) for the country through which
                they are transiting and/or entering. fareticketsllc will not be responsible if proper travel documents
                are not available and you are denied entry or transit into a Country. We request you to consult the
                embassy of the country(s) you are visiting or transiting through.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> For
                any modification or any other query please contact our Travel Consultant on +1-844-382-2225.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;">
                fareticketsllc provides its services, products, and contents either through the phone service or
                website. This is a legal agreement between you and fareticketsllc. You must read all the information
                carefully as you agree to these terms and conditions while accessing or using any services or products
                or contents of fareticketsllc.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px;"> <span
                    style="font-size: 14px; font-weight: 700; color: #000;">Visas:</span> Please check with your local
                embassy regarding any visa requirements as we do not deal with any visa/travel related documents.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px;"> <span
                    style="font-size: 14px; font-weight: 700; color: #000;">Passports:</span> It is advisable that your
                passport must be at least valid for 6 months from the date of return.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px;"> <span
                    style="font-size: 14px; font-weight: 700; color: #000;">Travel Insurance:</span> You are advised to
                take travel insurance to cover any medical expenses.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 700; color: #000; padding: 10px 30px;">Travelers Name</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;">
                Traveler First name and Last name must be entered during the time of reservation exactly as it appears
                on your Government issued identification, be it your passport, Driving License or other acceptable forms
                of identification depending on your type of journey (Domestic/International). Name once entered will not
                be changed. Some ‘Typo Error’ (Name Correction) however, is allowed, depending on Airline Terms of Use,
                & charges would be applicable according as per airline policy.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 700; color: #000; padding: 10px 30px;">Fare Policy</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;">
                Electronic Tickets (e-tickets) will be issued shortly.If we are not able to issue the e ticket, you will
                be notified.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #000; padding: 10px 30px; padding-top: 0px;">
                Passengers are required to reconfirm flights 72 (seventy two) hours prior to departure with the airline
                you are travelling with. Passengers are required to arrive at the gate, 3 (three) hours before departure
                for international travel and 2 (two) hours prior to departure for domestic travel. We are not
                responsible or liable for flight changes made by the airline. If a passenger misses or does not show for
                their flight and does not notify the airline prior to missing or no showing the flight, the passenger
                assumes all responsibility for any change or cancel fee and/or possible loss of ticket value. This no
                show policy is an airline enforced rule and at their discretion to determine how they will deal with it.
                However, most airlines look at no shows as a violation of their ticket policies meaning you forfeit any
                and all funds paid for said ticket. Frequent Flyer Mileage can be accrued on some carriers. Please
                contact your airline to advise your mileage number. Fares are not guaranteed until ticketed.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;">
                Passengers are responsible for all of the required travel documents. If the passenger attempts to fly
                without proper documentation and are turned away from the airport or required to cancel or change their
                tickets because of lack of proper travelling documentation, then the passenger assumes full
                responsibility for any and all change or cancel fees if applicable and/or the loss of the tickets
                purchased.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> All
                Tickets are not guaranteed until ticketed. The fare may alter as revised by the Airline company or
                dealer anytime even after the confirmation of a reservation. fareticketsllc will inform you about the
                fare changes if made without assuming any responsibility – financial or otherwise for any such fare
                alters made by the supplier.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;">
                fareticketsllc will inform you about the new fares. At that point of time you may- depending on your
                requirement – either purchase or cancel the product or service at the new cost. You also can cancel the
                booking at no cost in case there is an increase in fare before ticketing and your card being charged.
                You’ll be charged nothing if you cancel such a booking.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 700; color: #000; padding: 10px 30px;">Payment Policy</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;">
                fareticketsllc accepts Debit Cards and Credit Cards</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;">
                fareticketsllc may divide your total charge into two parts: Taxes and Airline Base. But, the combined
                total amount will be the same as authorized and quoted by you at the time of booking.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> Ticket
                fares don't include baggage fees of the airline.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;">
                Tickets are guaranteed only after the ticketing is completed. The tickets will not be guaranteed upon
                submission of payment. In case, your credit card payment fails to proceed due to any reason, we will
                notify you about this within 24 hours.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 700; color: #000; padding: 10px 30px;">Third Party and
                International Credit & Debit Cards Payment.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> In
                case you are using an International Debit Card or Credit while purchasing Plane Tickets for a personal
                journey, or for somebody else, you need to have some specific documents for processing passenger
                E-Tickets. Documents required for the same have been mentioned below.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> A
                complete ‘Credit Card Authorization Form’.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> A A
                copy of identity proof issued by the Government with front and back side which has photograph and
                signatures and copy of your card from which you are paying for the booking.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> A
                Airline Ticket prices are not guaranteed until ticketed.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 700; color: #000; padding: 10px 30px;">Credit Card Declines</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> On Credit Card being declined while processing your transaction, we will alert you about this by emailing you at your valid email id within 24 to 48 hours. In this case, neither the transaction will be processed nor the fare and any other booking details will be guaranteed.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 700; color: #000; padding: 10px 30px;">Cancellations and Exchanges</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #000; padding: 10px 30px; padding-top: 0px;"> Changes are subject to the following rules/penalties plus any difference in the airfare at the time the changes are made.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> Changes (before or after departure): As per the airline policy</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> Cancel / Refund (before or after departure): Not allowed in most of the airlines/as per the airline policy</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> For all cancellation and exchanges, you agree to request at least 24 hours before scheduled departure. All flight tickets bought from us are 100% non-refundable. You, however, reserve the right to entertain refund or exchange if allowed by the airline fare rules associated with the ticket(s) issued to you. Your ticket(s) may be refunded or exchanged for the original purchase price after the deduction of applicable airline penalties, and any fare difference between the original fares paid and the fare associated with the new ticket(s).</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> Furthermore, fareticketsllc has the right to charge a Change/Refund fees. fareticketsllc has no control over airline penalties associated with refunds or exchanges.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> If you travel internationally, you may often be offered to travel in more than one airline. Each airline has formed its own set of fare rules. If more than one set of fare rules are applied to the total fare, the most restrictive rules will be applicable to the entire booking.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> Thanks for spending your valuable time and using fareticketsllc. For using the website, you are authorized to agree with the aforementioned ‘Terms of Use’.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 700; color: #000; padding: 10px 30px;">24/7 Customer Care</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> Our customer service representatives are available 24x7 to assist you. Our proficient team will make sure that all your travel needs are addressed at the earliest.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> For any modification or changes please contact our Travel Consultant on +1-844-382-2225.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 700; color: #000; padding: 10px 30px;">Safe & Secure Booking</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> Our site comes equipped with the latest technology, so your data and information are always secured.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #696969; padding: 10px 30px; padding-top: 0px;"> We value your business and look forward to serve your travel needs in the near future</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #000; padding: 10px 30px; padding-top: 0px;"> Please feel free to contact us at  <a style="color: #055bdb; text-decoration: none;" href="mailto:+1-844-382-2225">+1-844-382-2225.</a> </td>
        </tr>
    </table>
    <table style="width: 45%; margin: auto; background-color: #fff; margin-top: 10px;">
        <tr>
            <td
                style="background-color: #055bdb; font-size: 20px; font-weight: 600; color: #fff; text-align: center; padding: 10px 30px;">
                Charge Authorization, Your Electronic Signature Copy</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #000; padding: 10px 30px;">I, Miker Test, have read the term & conditions and I understand that fare is non-refundable. I agree to pay a total amount of USD 2000.00 (Credit Card Number ending with. 1111) for this purchase. I understand is to serve as my legal signature.</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #000; padding: 10px 30px;">Thanks you for using fareticketsllc</td>
        </tr>
    </table>
    <table style="width: 45%; margin: auto; background-color: #fff; margin-top: 10px;">
        <tr>
            <td
                style="font-size: 20px; font-weight: 600; color: #000; padding: 10px 30px;">
                Please cancel this Booking!</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #000; padding: 10px 30px;">I, Miker Test, Authorize fareticketsllc to charge my VISA Credit/Debit Card, ending with 1111 for the total amount of USD 2000.00 to cancel the below Flight ticket/tickets</td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #ff0000; padding: 10px 30px;">By Clicking on Authorize button, you agree to below mentioned terms.</td>
        </tr>
        <tr>
            <td style="padding: 20px 30px;">
                <a href="https://www.cheapoflyllc.com/successful.aspx?Bkey=J788lsWix+kxHMS1k6kRVi1sLz4lxhIiwOfM57Cergpz489aZ+zdiXVigTUW6WHmEe+FNXOhI8c8Dqsm5hqUJw==" style="background:#119516;padding:10px 20px;border-radius:2px;font-size:14px;color:#fff;text-decoration:none;font-weight:500;letter-spacing:.5px;display:inline-block" rel="noreferrer" target="_blank" > I Authorize </a>
            </td>
        </tr>
    </table>

    <table style="background-color: #fff; width: 45%; margin: auto;">
        <tr style="background-color: #da3743;">
            <td style="text-align: center; padding: 10px;"> <img width="150" src="https://www.fareticketsllc.com/assets/img/logo-dark.webp" alt="img-logo"> </td>
        </tr>
        <tr>
            <td style="font-size: 36px; font-weight: 800; text-align: center; padding: 40px 30px 0px 30px; color: #fff; background-color: #da3743; border-top: 1px solid #ff5a5a; line-height: 40px;">Done!</td>
        </tr>
        <tr>
            <td style="font-size: 36px; font-weight: 800; text-align: center; padding: 0px 30px 0px 30px; color: #fff; background-color: #da3743; line-height: 40px;">Your Reservation</td>
        </tr>
        <tr>
            <td style="font-size: 36px; font-weight: 800; text-align: center; padding: 0px 30px 30px 30px; color: #fff; background-color: #da3743; line-height: 40px;">Is Canceled</td>
        </tr>
        <tr>
            <td style="text-align: center; padding: 0px 50px; font-size: 14px; font-weight: 400; color: #fff; background-color: #da3743;">Thanks for letting the airline know your plans changed (It helps them better plan and operate efficiently). Whenever you're ready to make new plans, left's finD a seat that matches your occassion. </td>
        </tr>
        <tr style="text-align: center;">
            <td style="background-color: #da3743;"> <a style="background-color: #000; color: #fff; padding: 10px 20px; display: inline-block; text-decoration: none; font-size: 16px; font-weight: 600; border-radius: 5px; margin-top: 40px; margin-bottom: 20px;" href="#">Book A New Flight</a> </td>
        </tr>
        <tr>
            <td style="font-size: 14px; font-weight: 400; color: #000; padding: 10px 30px; text-align: center;">feel free to contact us at <a style="color: #055bdb; text-decoration: none;" href="mailto:+1-844-382-2225">+1-844-382-2225.</a></td>
        </tr>
    </table>
</body>

</html>