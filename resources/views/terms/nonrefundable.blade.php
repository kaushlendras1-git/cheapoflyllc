

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Terms and Conditions |  {{ $merchant->name }}</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body.tc__body {
      font-family: 'Work Sans', sans-serif;
      background-color: #f7f8fa;
      color: #222;
      line-height: 1.7;
    }

    /* ===== Keep All Original Styles ===== */
    .tc__wrapper {
      max-width: 900px;
      margin: 60px auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      padding: 50px;
    }

    .tc__header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #f8f9fb;
      border-radius: 10px;
      padding: 15px 25px;
      margin-bottom: 30px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .tc__logo {
      height: 50px;
      width: auto;
    }

    .tc__tfn {
      font-size: 1.1rem;
      font-weight: 600;
      color: #007bff;
    }

    .tc__tfn i {
      margin-right: 6px;
      color: #007bff;
    }

    .tc__footer {
      margin-top: 50px;
      text-align: center;
      border-top: 1px solid #e5e7eb;
      padding-top: 25px;
    }

    .tc__social {
      margin-bottom: 15px;
    }

    .tc__social a {
      display: inline-block;
      margin: 0 8px;
      font-size: 1.2rem;
      color: #007bff;
      transition: all 0.3s ease;
    }

    .tc__social a:hover {
      color: #0056b3;
      transform: translateY(-2px);
    }

    .tc__copy {
      font-size: 0.95rem;
      color: #555;
    }

    .tc__title {
      font-weight: 700;
      color: #111;
      font-size: 2rem;
      margin-bottom: 1rem;
      text-align: start;
    }

    .tc__subtitle {
      font-weight: 700;
      color: #111;
      font-size: 1.4rem;
      margin-top: 2.2rem;
      border-left: 4px solid #007bff;
      padding-left: 12px;
    }

    .tc__text, .tc__list li {
      margin-bottom: 0.7rem;
      font-size: 1rem;
    }

    .tc__list {
      padding-left: 1.3rem;
    }

    .tc__contact {
      background-color: #f1f3f5;
      border-radius: 10px;
      padding: 25px;
      margin-top: 40px;
    }

    .tc__contact i {
      color: #007bff;
      margin-right: 8px;
    }

    /* ===== Added Page Header/Footer Styling ===== */
    .page-header {
      background: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      padding: 15px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 999;
    }

    .page-header img {
      height: 50px;
      width: auto;
    }

    .page-header .header-tfn {
      font-size: 1.1rem;
      font-weight: 600;
      color: #007bff;
      text-decoration: none;
    }

    .page-header .header-tfn i {
      margin-right: 6px;
      color: #007bff;
    }

    .page-footer {
      background-color: #fff;
      border-top: 1px solid #e5e7eb;
      text-align: center;
      padding: 40px 15px 30px;
      margin-top: 60px;
    }

    @media (max-width: 768px) {
      .tc__wrapper {
        padding: 30px 20px;
        margin: 30px 15px;
      }

      .tc__title {
        font-size: 1.6rem;
      }

      .page-header {
        flex-direction: column;
        text-align: center;
        gap: 10px;
        padding: 15px 20px;
      }

      .page-header img {
        height: 40px;
      }

      .page-header .header-tfn {
        font-size: 1rem;
      }
    }
  </style>
</head>

<body class="tc__body">

  <!-- ===== Global Page Header ===== -->
  <header class="page-header">
    <a href="/" class="logo-link">
            <img src="{{ asset('storage/' . $merchant->logo) }}" alt="Logo">
    </a>
    <a href="tel:+18443822225" class="header-tfn">
      <i class="fa-solid fa-phone"></i> Toll Free: <strong>{{ $merchant->phone }}</strong>
    </a>
  </header>

  <!-- ===== Main Content ===== -->
  <main>


      <!-- Car Rental Terms and Conditions -->
@if($booking_type->contains('type', 'Car'))
  <div class="tc__wrapper">   
    <h2 class="tc__title">General Car Rental Terms and Conditions</h2>
    <p class="tc__text">By accessing our website or booking through one of our agents, you acknowledge and agree to the following terms and conditions. Please review them carefully before making any purchase.</p>
    <h2 class="tc__subtitle">1. General Conditions</h2>
    <p class="tc__text"><strong>Intermediary Role:</strong>  {{ $merchant->name }} acts as an <strong>intermediary</strong> between the customer and the car rental supplier. The rental agreement and terms of service are governed by the rental company providing the vehicle.</p>
    <p class="tc__text"><strong>Booking Confirmation:</strong> Car rental reservations are confirmed only once payment has been received and a confirmation voucher has been issued by  {{ $merchant->name }}.</p>
    <p class="tc__text"><strong>Vehicle Category:</strong> Bookings are confirmed by <strong>vehicle category</strong> (e.g., Compact, Sedan, SUV) and not by a specific make, model, or colour. The supplier reserves the right to provide a similar or higher category vehicle if the reserved category is unavailable.</p>
    <p class="tc__text"><strong>Rates:</strong> All rates are based on information provided by the rental supplier and are <strong>subject to change </strong> before confirmation. Local taxes, fees, or surcharges may apply at the rental counter.</p>
    <p class="tc__text"><strong>Late Pick-Up:</strong> Late arrivals may be accommodated at the supplier’s discretion, subject to vehicle availability and potential rebooking charges. If you anticipate a delay, inform us immediately at <strong>{{ $merchant->phone }}.</strong></p>

    <h2 class="tc__subtitle">2. Driver Eligibility and Requirements</h2>
    <p class="tc__text"><strong>Minimum Age:</strong> The minimum age to rent a vehicle varies by country and supplier, typically between <strong>21 and 25 years.</strong> Additional charges may apply for drivers under 25 (“Young Driver Surcharge”).</p>
    <p class="tc__text"><strong>Driver’s License:</strong> A <strong>valid driver’s license</strong> held for at least one year is mandatory. Temporary or learner permits are not accepted.</p>
    <p class="tc__text"><strong>International Driving Permit (IDP):</strong> For rentals outside your home country, an IDP may be required along with your original driver’s license.</p>
    <p class="tc__text"><strong>Additional Drivers:</strong> Only registered and authorized drivers may operate the rental vehicle. Additional drivers must present their valid driver’s license at pickup and may be subject to an extra daily fee.</p>

    <h2 class="tc__subtitle">3. Payment and Security Deposit</h2>
    <p class="tc__text"><strong>Accepted Payments:</strong>  {{ $merchant->name }} accepts major credit, debit, and domestic cards for booking payments. Bookings made using domestic, international, or third-party cards may require additional verification, including:</p>
    <ul class="tc__list">
      <li>Completed Credit Card Authorization Form</li>
      <li>Valid government-issued photo ID (front and back)</li>
      <li>Copy of the payment card (front and back)</li>
    </ul>
    <p class="tc__text">Additional verification may be requested for urgent or high-value bookings.</p>
    <p class="tc__text">If a card transaction is declined, the booking will not be processed, and rates are not guaranteed until successful payment confirmation.</p>
    <p class="tc__text"><strong>Payment Security:</strong> All payments processed through  {{ $merchant->name }} are protected by advanced encryption and fraud-prevention systems. In case of suspected fraud or unauthorized use,  {{ $merchant->name }} reserves the right to cancel the booking and refund verified payments after due verification.</p>
    <p class="tc__text"><strong>Deposit Requirement:</strong> A <strong>security deposit</strong> is required at the time of vehicle collection and will be held on the main driver’s credit card for the duration of the rental. The deposit amount depends on the vehicle type, rental duration, and supplier policy.</p>
    <p class="tc__text"><strong>Credit Card in Driver’s Name:</strong> The main driver must present a <strong>credit card in their own name.</strong> Most suppliers do not accept prepaid or debit cards for deposits.</p>
    <p class="tc__text"><strong>Currency:</strong> Final charges at the counter are processed in local currency and may differ due to exchange rate variations.</p>

    <h2 class="tc__subtitle">4. Booking Modifications, Cancellations, and No-Show Policy</h2>
    <p class="tc__text"><strong>Amendments:</strong> Any change to a confirmed booking (e.g., dates, times, vehicle type) is subject to availability and supplier approval. A fare difference or administrative fee may apply.</p>
    <p class="tc__text"><strong>Cancellations:</strong></p>
    <p class="tc__text"><u>Refundable Tickets:</u> Refundable rentals can be modified or cancelled prior to the scheduled pick-up date, subject to the supplier’s policy and  {{ $merchant->name }} service fees.</p>
    <p class="tc__text">Approved refunds will be processed after deducting applicable supplier penalties and  {{ $merchant->name }} handling charges.</p>
    <p class="tc__text">Refund timelines vary depending on the payment method and supplier policy.</p>
    <p class="tc__text"><u>Non-Refundable Tickets:</u> Non-refundable rentals cannot be cancelled, modified, or refunded once confirmed.</p>
    <p class="tc__text">Full prepayment is required at the time of booking.</p>
    <p class="tc__text">Failure to collect the vehicle on the scheduled date and time without prior notice will be treated as a <strong>no-show,</strong> resulting in the forfeiture of the full rental amount.</p>
    <p class="tc__text"><strong>Important:</strong> All changes or cancellations must be processed through  {{ $merchant->name }}, <strong>not directly with the rental company.</strong> For assistance, contact our Travel Consultant at <strong>{{ $merchant->phone }}.</strong></p>

    <h2 class="tc__subtitle">5. Vehicle Usage and Responsibilities</h2>
    <p class="tc__text"><strong>Authorized Use:</strong> The rented vehicle must only be used by authorized drivers listed in the rental agreement.</p>
    <p class="tc__text"><strong>Prohibited Use:</strong> The vehicle may not be used for illegal activities, off-road driving, racing, towing, or transport of hazardous materials.</p>
    <p class="tc__text"><strong>Fuel Policy:</strong> Fuel policies vary by supplier (Full-to-Full, Prepaid, or Same-to-Same). Failure to comply with the fuel policy may result in additional refuelling charges.</p>
    <p class="tc__text"><strong>Traffic Violations:</strong> The renter is responsible for all fines, tolls, penalties, or violations incurred during the rental period.</p>
    <p class="tc__text"><strong>Return Policy:</strong> The vehicle must be returned at the specified location, date, and time as stated on the rental agreement. Late returns may result in extra charges or additional rental days.</p>

    <h2 class="tc__subtitle">6. Additional Charges and Equipment</h2>
    <p class="tc__text"><strong>Extra Fees:</strong> Charges for <strong>refuelling, additional drivers, late returns, or excess mileage</strong> are not included in the total rental price and must be paid directly to the supplier at the time of return.</p>
    <p class="tc__text"><strong>Special Equipment:</strong> Optional equipment such as <strong>child safety seats, GPS, Wi-Fi devices, snow chains, or roof racks</strong> may be available for hire at pickup, subject to availability and local charges.</p>
    <p class="tc__text"><strong>Voluntary Add-ons:</strong> Renting or purchasing additional equipment or services is a <strong>voluntary decision made directly with the rental supplier.</strong>  {{ $merchant->name }} does not intervene and is not liable for any additional amounts you may be required to pay.</p>
    <p class="tc__text"><strong>Geographical Restrictions:</strong> Some suppliers apply <strong>geographical or border restrictions,</strong> even for contracts featuring unlimited mileage. Certain companies may not allow vehicles to cross specific <strong>domestic or international borders,</strong> or may apply <strong>additional fees</strong> for doing so. Please verify with your rental supplier before travel.</p>

    <h2 class="tc__subtitle">7. Insurance and Damage Protection</h2>
    <p class="tc__text"><strong>Basic Coverage:</strong> Most rentals include <strong>Collision Damage Waiver (CDW)</strong> and <strong>Theft Protection (TP)</strong> with an applicable excess/deductible.</p>
    <p class="tc__text"><strong>Optional Insurance:</strong> Additional protection options such as <strong>Zero-Excess Coverage, Roadside Assistance,</strong> or <strong>Personal Accident Insurance (PAI)</strong> can be purchased directly from the supplier at pickup.</p>
    <p class="tc__text"><strong>Customer Liability:</strong> The renter is liable for damages, loss, or theft not covered by the selected insurance, including damages caused by negligence or violation of the rental terms.</p>

    <h2 class="tc__subtitle">8. Supplier Policies</h2>
    <p class="tc__text">Each car rental supplier has its own detailed rental terms and policies, including mileage limits, deposit amounts, local surcharges, and fuel policies.</p>
    <p class="tc__text">Customers must review and sign the <strong>rental agreement</strong> provided at the pickup counter, as that document governs the final terms of the rental.</p>
    <p class="tc__text"> {{ $merchant->name }} is <strong>not responsible for disputes</strong> arising from changes, fees, or enforcement of the supplier’s individual policies.</p>

    <h2 class="tc__subtitle">9. Involuntary Changes</h2>
    <p class="tc__text">In the event of vehicle unavailability, breakdown, or booking cancellation initiated by the car rental supplier, <strong> {{ $merchant->name }} </strong> will assist in arranging an alternative vehicle of similar category or processing applicable refunds as per the supplier’s policy.</p>
    <p class="tc__text"><strong> {{ $merchant->name }}</strong> is not responsible for any additional costs resulting from such involuntary changes, including accommodation, meals, or alternate transportation expenses incurred by the traveller.</p>

    <h2 class="tc__subtitle">10. Privacy Policy</h2>
    <p class="tc__text"> {{ $merchant->name }} respects your privacy and is committed to protecting your personal information.</p>
    <p class="tc__text">Your data is used solely for processing your car rental booking and related travel services.</p>
    <p class="tc__text">We do not sell or disclose your information to third parties except as required by law or necessary to complete your booking.</p>
    <p class="tc__text">All payment data is processed through PCI-compliant and encrypted systems.
    For details, visit our <strong>Privacy Policy</strong> at <a href="https://www.traveladesk.com/privacy-policy.php" target="_blank">https://www.traveladesk.com/privacy-policy.php</a></p>

    <h2 class="tc__subtitle">11. Customer Support</h2>
    <div class="tc__contact">
      <p class="tc__text"><i class="fa-solid fa-phone"></i> <strong>Phone:</strong> {{ $merchant->phone }}</p>
      <p class="tc__text"><i class="fa-solid fa-envelope"></i> <strong>Email:</strong> support@traveladesk.com</p>
      <p class="tc__text"><i class="fa-solid fa-globe"></i> <strong>Website:</strong> www.traveladesk.com</p>
      <p class="tc__text">For urgent issues related to pick up, payment, or roadside assistance, please contact the <strong>rental supplier directly</strong> using the contact details on your voucher.</p>
      <p class="tc__text">We sincerely appreciate your business and look forward to serving you.</p>
    </div>   
  </div>
@endif

  <!-- Flights Terms and Conditions -->
   @if($booking_type->contains('type', 'Flight'))
  <div class="tc__wrapper">
  <h2 class="tc__title">General Flight Terms and Conditions</h2>
  <p class="tc__text">By accessing our website or booking through one of our authorized agents, you acknowledge and agree to the following Terms and Conditions. Please review them carefully before making any purchase.</p>
  <h2 class="tc__subtitle">1. General Conditions</h2>
  <p class="tc__text"><strong>Ticket Policy:</strong> All flight tickets issued by <strong> {{ $merchant->name }}</strong> are generally <strong>non-refundable, non-transferable,</strong> and <strong>name changes are strictly not permitted.</strong></p>
  <p class="tc__text">However,  {{ $merchant->name }} offers two categories of airfare:</p>
  <ul class="tc__list">
    <li><strong>Refundable Tickets:</strong>
      <ul class="tc__list">
        <li>Refundable fares are subject to airline fare rules and  {{ $merchant->name }}’s service fee.</li>
        <li>Refunds may include a portion of the fare after applicable penalties and processing fees are deducted.</li>
        <li>Processing time may vary based on airline policy and payment method used.</li>
      </ul>
    </li>
    <li><strong>Non-Refundable Tickets:</strong>
      <ul class="tc__list">
        <li>Non-refundable fares cannot be cancelled or refunded once ticketed.</li>
        <li>Name changes or transfers are strictly prohibited.</li>
        <li>Date or route changes, if permitted, may incur additional charges and fare differences.</li>
      </ul>
    </li>
  </ul>
  <p class="tc__text"><strong>Changes to Booking:</strong> Date or route changes are subject to applicable  {{ $merchant->name }} change fees and any fare differences based on current availability.</p>
  <p class="tc__text">For multi-airline itineraries, the most restrictive fare rules will apply to the entire journey.</p>
  <p class="tc__text"><strong>Fare Guarantee:</strong> Fares are not guaranteed until tickets are issued.</p>
  <p class="tc__text">If there is a price change prior to ticket issuance, you will be notified before the payment is processed or booking is finalized.</p>
  <p class="tc__text"><strong>Important:</strong> Any cancellations, amendments, or refund requests must be handled through  {{ $merchant->name }} and <strong>not directly with the Airline</strong>. For assistance, contact our Travel Consultant at <strong>{{ $merchant->phone }}.</strong></p>
  <h2 class="tc__subtitle">2. Traveler Identity and Documentation</h2>
  <p class="tc__text"><strong>Name Accuracy:</strong> Traveler names must match exactly as on government-issued ID or passport.</p>
  <p class="tc__text"><strong>Documentation:</strong> Travelers are solely responsible for holding valid passports, visas, or transit permits.</p>
  <p class="tc__text"><strong>Liability:</strong>  {{ $merchant->name }} will not be responsible for denied boarding or entry due to incomplete or invalid documents.</p>
  <p class="tc__text"><strong>Visa & Passport Validity:</strong> Please verify visa and passport requirements directly with official authorities. Passports should remain valid for at least six (6) months beyond return travel dates.</p>
  <h2 class="tc__subtitle">3. Pre-Travel and Airport Procedures</h2>
  <p class="tc__text"><strong>Flight Confirmation:</strong> Passengers are advised to reconfirm their flight details at least 72 hours prior to departure by contacting  {{ $merchant->name }} at <strong>{{ $merchant->phone }}.</strong></p>
  <p class="tc__text"><strong>Airport Arrival:</strong> Arrive at least 2–3 hours before domestic or international flights.</p>
  <p class="tc__text"><strong>No-Show Policy:</strong> Failure to check in or board may result in cancellation of remaining segments, and the fare may be forfeited.</p>

  <h2 class="tc__subtitle">4. Payment and Credit Card Authorization</h2>
  <p class="tc__text"><strong>Accepted Payments:</strong>  {{ $merchant->name }} accepts all major credit, debit, and domestic payment cards.</p>
  <p class="tc__text"><strong>Verification:</strong> Bookings made using domestic, international, or third-party cards may require:</p>
  <ul class="tc__list">
    <li>Completed Credit Card Authorization Form</li>
    <li>Government-issued ID (front and back)</li>
    <li>Copy of payment card (front and back) showing name and signature</li>
  </ul>
  <p class="tc__text"><strong>Urgent Travel or High-Value Bookings:</strong> Additional verification may be required for last-minute travel or high-value transactions.</p>
  <p class="tc__text"><strong>Declined Payments:</strong> If a card is declined, notification will be sent within 24–48 hours. The fare is not guaranteed until payment is successfully processed.</p>

  <h2 class="tc__subtitle">5. Payment Security</h2>
  <p class="tc__text">Your payment information is protected by advanced encryption and fraud-prevention measures.</p>
  <p class="tc__text"> {{ $merchant->name }} uses PCI DSS-compliant systems for secure credit card transactions.</p>
  <p class="tc__text">In case of suspicious or fraudulent activity,  {{ $merchant->name }} reserves the right to cancel the booking and refund the amount to the original payment method after necessary verification.</p>

  <h2 class="tc__subtitle">6. Baggage Policy</h2>
  <p class="tc__text">Baggage allowance, fees, and restrictions vary by airline and ticket type.</p>
  <p class="tc__text"> {{ $merchant->name }} shares the latest baggage details as per the airline’s policy. For confirmation or assistance, please contact our Travel Consultant at {{ $merchant->phone }}.</p>
  <p class="tc__text">Excess or overweight baggage may incur additional charges, payable directly at the airport.</p>

  <h2 class="tc__subtitle">7. Insurance</h2>
  <p class="tc__text"> {{ $merchant->name }} strongly recommends purchasing travel insurance for protection against trip cancellation, delays, lost baggage, or medical emergencies.</p>
  <p class="tc__text">Insurance coverage and claims are subject to the policy terms of the insurance provider selected at the time of booking.</p>

  <h2 class="tc__subtitle">8. Seats and Meals</h2>
  <p class="tc__text">Seat selection and meal preferences are subject to availability and airline policy.</p>
  <p class="tc__text"> {{ $merchant->name }} will assist in submitting requests but cannot guarantee seat allocation or meal confirmation.</p>
  <p class="tc__text">Some airlines may charge additional fees for preferred seating or special meal requests. For assistance or details, please contact our Travel Consultant at {{ $merchant->phone }}.</p>

  <h2 class="tc__subtitle">9. Involuntary Changes</h2>
  <p class="tc__text">In case of flight cancellations, delays, or schedule changes initiated by the airline,  {{ $merchant->name }} will assist in rebooking or obtaining applicable refunds as per the airline’s policy.</p>
  <p class="tc__text"> {{ $merchant->name }} is not responsible for costs arising from such involuntary changes, including accommodation, meals, or ground transportation.</p>

  <h2 class="tc__subtitle">10. Privacy Policy</h2>
  <p class="tc__text"> {{ $merchant->name }} respects your privacy and is committed to safeguarding your personal and payment information.</p>
  <p class="tc__text">All personal data collected is used solely for processing bookings and delivering travel-related services.</p>
  <p class="tc__text">We do not sell or share your information with third parties except as required by law or necessary for booking fulfilment.</p>
  <p class="tc__text">All payment data is processed through PCI-compliant and encrypted systems. For details, visit our Privacy Policy at 
    <a href="https://www.traveladesk.com/privacy-policy.php" target="_blank">https://www.traveladesk.com/privacy-policy.php</a>
  </p>

  <h2 class="tc__subtitle">11. Customer Support</h2>
  <div class="tc__contact">
    <p class="tc__text">We are committed to providing you with reliable and responsive service before, during, and after your travel.</p>
    <p class="tc__text"><strong>Customer Support (Available 24/7):</strong></p>
    <p class="tc__text"><i class="fa-solid fa-phone"></i> <strong>Phone:</strong> {{ $merchant->phone }}</p>
    <p class="tc__text"><i class="fa-solid fa-envelope"></i> <strong>Email:</strong> support@traveladesk.com</p>
    <p class="tc__text"><i class="fa-solid fa-globe"></i> <strong>Website:</strong> www.traveladesk.com</p>
    <p class="tc__text">Our experienced representatives are here to assist with bookings, schedule changes, cancellations, or any other travel-related inquiries.</p>
    <p class="tc__text">We sincerely appreciate your business and look forward to serving you.</p>
  </div>
</div>
@endif

<!-- Cruise Terms and Conditions -->
 @if($booking_type->contains('type', 'Cruise'))
 <div class="tc__wrapper">  
    <h2 class="tc__title">General Cruise Terms and Conditions</h2>
    <p class="tc__text">By accessing our website or booking through one of our agents, you acknowledge and agree to the following terms and conditions. Please review them carefully before making any purchase.</p>
    <h2 class="tc__subtitle">1. General Conditions</h2>
    <p class="tc__text"><strong>Intermediary Role:</strong>  {{ $merchant->name }} acts solely as an <strong>intermediary</strong> between customers and cruise lines or their authorized representatives. All bookings are subject to the individual <strong>cruise line’s rules, fare conditions, and terms of carriage.</strong></p>
    <p class="tc__text"><strong>Contract of Carriage:</strong> Your cruise booking and participation are governed by the <strong>cruise line’s contract of carriage, </strong> which outlines passenger rights, obligations, and limitations of liability.</p>
    <p class="tc__text"><strong>Reservation Confirmation:</strong> A cruise reservation is confirmed only upon successful payment and issuance of a <strong>cruise confirmation or e-ticket.</strong>  {{ $merchant->name }} is not responsible for changes made by the cruise line after confirmation.</p>
    <p class="tc__text"><strong>Cruise Itineraries:</strong> Cruise itineraries are subject to change by the cruise line due to weather, port conditions, mechanical issues, or other operational factors.  {{ $merchant->name }} shall not be held liable for such changes.</p>
    <h2 class="tc__subtitle">2. Payment and Pricing Policy</h2>
    <p class="tc__text"><strong>Accepted Payments:</strong>  {{ $merchant->name }} accepts all major credit, debit, and domestic cards. Payments made using domestic, international, or third-party cards may require additional verification, including:</p>
    <ul class="tc__list">
      <li>Completed Credit Card Authorization Form</li>
      <li>Valid government-issued photo ID (front and back)</li>
      <li>Copy of the payment card (front and back)</li>
    </ul>
    <p class="tc__text">Additional verification may be required for urgent bookings or high-value cruise fares. If a card transaction is declined or unverified, the booking will not be confirmed, and rates are not guaranteed until successful payment.</p>
    <p class="tc__text"><strong>Deposit and Final Payment:</strong> Some cruise lines require an initial deposit to confirm the booking, with the <strong>remaining balance due prior to the final payment deadline</strong> specified at booking.</p>
    <p class="tc__text"><strong>Fares and Taxes:</strong> All fares are quoted in the specified currency and generally include port charges and taxes unless otherwise stated. Optional onboard purchases, excursions, and gratuities are not included.</p>
    <p class="tc__text"><strong>Price Changes:</strong> Cruise lines reserve the right to modify pricing prior to full payment. If a fare increases before ticketing, you will be notified and may choose to cancel without penalty.</p>
    <h2 class="tc__subtitle">3. Payment Security</h2>
    <p class="tc__text">Your payment information is protected by advanced encryption and fraud-prevention measures.</p>
    <p class="tc__text"> {{ $merchant->name }} uses PCI DSS-compliant systems for secure credit card transactions.</p>
    <p class="tc__text">In case of suspicious or fraudulent activity,  {{ $merchant->name }} reserves the right to cancel the booking and refund the amount to the original payment method after necessary verification.</p>
    <h2 class="tc__subtitle">4. Cancellations, Refunds, and Changes</h2>
    <p class="tc__text"><strong>Cancellation Policy:</strong></p>
    <p class="tc__text"><strong>Refundable Tickets:</strong></p>
    <ul class="tc__list">
      <li>Refundable cruise fares may be cancelled or modified prior to sailing, subject to the cruise line’s policy.</li>
      <li>Approved refunds will be processed after deducting applicable <strong>cruise line penalties and  {{ $merchant->name }} service charges.</strong> Refunds may take 7–30 business days depending on the cruise line and payment method.</li>
    </ul>
    <p class="tc__text"><strong>Non-Refundable Tickets:</strong></p>
    <ul class="tc__list">
      <li>Non-refundable cruise fares are not eligible for cancellation, modification, or refund once confirmed.</li>
      <li>Full payment is required at the time of booking.</li>
      <li>Failure to board on the scheduled departure date will result in forfeiture of the entire booking amount.</li>
    </ul>
    <p class="tc__text"><strong>Modifications:</strong> Any request for changes (such as sailing date, passenger name, or cabin type) is subject to cruise line approval and may incur additional fees or fare differences.</p>
    <p class="tc__text"><strong>Force Majeure:</strong> No refund will be issued for cancellations or disruptions caused by <strong>natural disasters, strikes, pandemics, port closures, or other events beyond control.</strong></p>
    <p class="tc__text"><strong>Important:</strong> All cancellations, amendments, or refund requests must be handled through  {{ $merchant->name }} and <strong>not directly with the cruise line.</strong> For assistance, contact our Travel Consultant at <strong>{{ $merchant->phone }}.</strong></p>
    <h2 class="tc__subtitle">5. Passenger Identification and Travel Documents</h2>
    <p class="tc__text"><strong>Passport and Visa Requirements:</strong> Passengers are responsible for ensuring all required <strong>passports, visas, and travel documents</strong> are valid for the duration of the cruise.</p>
    <p class="tc__text"><strong>Travel Restrictions:</strong> Failure to present proper documentation may result in denied boarding, and  {{ $merchant->name }} will not be liable for any associated costs or penalties.</p>
    <p class="tc__text"><strong>Minor Passengers:</strong> Guests under 18 years of age must be accompanied by an adult or provide notarized parental consent as required by the cruise line.</p>
    <p class="tc__text"><strong>Health and Vaccination:</strong> Certain itineraries may require proof of vaccination or medical clearance. It is the passenger’s responsibility to comply with health regulations of all destinations.</p>
    <h2 class="tc__subtitle">6. Check-In, Boarding, and Disembarkation</h2>
    <p class="tc__text"><strong>Check-In Time:</strong> Passengers must complete the <strong>online check-in process</strong> and arrive at the cruise terminal at <strong>least 2–3 hours prior to departure.</strong> Late arrivals may be denied boarding.</p>
    <p class="tc__text"><strong>Boarding Denial:</strong> Cruise lines reserve the right to deny boarding for safety, health, or behavioural reasons. In such cases, no refund will be provided.</p>
    <p class="tc__text"><strong>Disembarkation:</strong> Passengers must vacate the cabin and complete check-out procedures at the designated time on the day of disembarkation. Late departures may incur additional charges.</p>
    <h2 class="tc__subtitle">7. Onboard Policies and Conduct</h2>
    <p class="tc__text"><strong>Compliance:</strong> Guests must adhere to the cruise line’s onboard rules, safety procedures, and captain’s instructions.</p>
    <p class="tc__text"><strong>Alcohol, Smoking, and Conduct:</strong> Consumption of alcohol, smoking, and behaviour policies vary by cruise line. Failure to comply may result in fines, confinement, or disembarkation without compensation.</p>
    <p class="tc__text"><strong>Damage or Loss:</strong> Passengers are financially responsible for any <strong>damage to ship property</strong> or loss caused by negligence or misconduct.</p>
    <p class="tc__text"><strong>Personal Belongings:</strong> Cruise lines and  {{ $merchant->name }} are not responsible for loss or theft of personal items. Passengers are advised to carry <strong>travel insurance </strong> covering such risks.</p>
    <h2 class="tc__subtitle">8. Shore Excursions and Additional Services</h2>
    <p class="tc__text"><strong>Optional Activities:</strong> Shore excursions, spa treatments, specialty dining, Wi-Fi, and other onboard services are <strong>optional</strong> and may involve additional charges payable directly to the cruise line or local operators.</p>
    <p class="tc__text"><strong>Third-Party Services:</strong>  {{ $merchant->name }} does not operate or control these services and <strong>is not liable for any issues</strong> or disputes arising from participation in such activities.</p>
    <p class="tc__text"><strong>Voluntary Add-Ons:</strong> The selection of additional services is a voluntary decision between the traveller`s and the cruise provider.  {{ $merchant->name }} is not responsible for resulting additional payments or service variations.</p>
    <p class="tc__text"><strong>Cabin Allocation:</strong> Cabin type, view, and location are assigned by the cruise line and subject to availability.</p>
    <p class="tc__text"><strong>Meals:</strong> Meal inclusions depend on the fare package chosen. Specialty dining, beverages, and certain onboard activities may incur additional charges.</p>
    <p class="tc__text"><strong>Special Requests:</strong> Requests for cabin preferences, accessibility needs, special meals, or celebrations (e.g., birthdays or anniversaries) are subject to cruise line approval and availability.</p>

    <h2 class="tc__subtitle">9. Travel Insurance</h2>

    <p class="tc__text">It is <strong>strongly recommended</strong> that all passengers obtain <strong>comprehensive travel insurance</strong> covering medical emergencies, trip interruption, baggage loss, and cancellation.</p>

    <p class="tc__text"> {{ $merchant->name }} does not sell or manage insurance but can provide guidance on third-party insurance providers upon request.</p>

    <h2 class="tc__subtitle">10. Involuntary Changes</h2>

    <p class="tc__text"> {{ $merchant->name }} is <strong>not responsible</strong> for any injury, delay, loss, damage, or expense arising from actions, negligence, or failures of the cruise line or other suppliers.</p>

    <p class="tc__text">We are not liable for changes to itineraries, port substitutions, or missed embarkations due to weather or operational decisions by the cruise company.</p>

    <p class="tc__text"> {{ $merchant->name }}’s liability is limited to the value of the booking made through our platform and does not extend beyond the terms agreed at purchase.</p>

    <h2 class="tc__subtitle">11. Privacy Policy</h2>

    <p class="tc__text"> {{ $merchant->name }} respects your privacy and is committed to protecting your personal information.</p>

    <p class="tc__text">Your data is used solely for processing your cruise booking and related travel services.</p>

    <p class="tc__text">We do not sell or disclose your information to third parties except as required by law or necessary to complete your booking.</p>

    <p class="tc__text">All payment data is processed through PCI-compliant and encrypted systems.
    For details, visit our <strong>Privacy Policy</strong> at https://www.traveladesk.com/privacy-policy.php</p>

    <h2 class="tc__subtitle">12. Customer Support</h2>

    <div class="tc__contact">
      <p class="tc__text">We are committed to providing you with reliable and responsive service before, during, and after your travel.</p>
      <p class="tc__text"><strong>Customer Support (Available 24/7):</strong></p>
      <p class="tc__text"><i class="fa-solid fa-phone"></i> <strong>Phone:</strong> {{ $merchant->phone }}</p>
      <p class="tc__text"><i class="fa-solid fa-envelope"></i> <strong>Email:</strong> support@traveladesk.com</p>
      <p class="tc__text"><i class="fa-solid fa-globe"></i> <strong>Website:</strong> www.traveladesk.com</p>
      <p class="tc__text">For urgent matters while onboard or at port, passengers should contact the <strong>cruise line’s guest services desk</strong> immediately for assistance.</p>
      <p class="tc__text">We sincerely appreciate your business and look forward to serving you.</p>
    </div>
  </div>
@endif
  
  <!-- Hotels Terms and Conditions -->
   @if($booking_type->contains('type', 'Hotel'))
     <div class="tc__wrapper">      
        <h2 class="tc__title">General Hotel Terms and Conditions</h2>

        <p class="tc__text">By accessing our website or booking through one of our agents, you acknowledge and agree to the following terms and conditions. Please review them carefully before making any purchase.</p>

        <h2 class="tc__subtitle">1. General Conditions</h2>

        <p class="tc__text"><strong>Intermediary Role:</strong>  {{ $merchant->name }} acts solely as a booking intermediary between the customer and the hotel or accommodation provider. Your reservation is subject to the individual hotel's policies, rules, and terms of service.</p>

        <p class="tc__text"><strong>Booking Confirmation:</strong> A hotel booking is confirmed only once payment is successfully processed and a confirmation voucher has been issued by  {{ $merchant->name }}.</p>

        <p class="tc__text"><strong>Hotel Rating and Information:</strong> Star ratings, amenities, and images provided on our website are based on hotel-supplied information and industry standards.  {{ $merchant->name }} does not guarantee the accuracy of ratings or facilities.</p>

        <p class="tc__text"><strong>Room Type:</strong> Bookings are made by <strong>room category</strong> (e.g., Standard, Deluxe, Suite). The actual room configuration or view is subject to availability at the hotel upon check-in.</p>

        <p class="tc__text"><strong>Amendments:</strong> Any modification to a confirmed hotel booking (dates, guest name, room type, etc.) is subject to availability and hotel approval. Fare differences or modification fees may apply.</p>

        <h2 class="tc__subtitle">2. Cancellations</h2>

        <p class="tc__text"> {{ $merchant->name }} offers two categories of hotel bookings:</p>

        <p class="tc__text"><strong>a) Refundable Bookings</strong></p>

        <ul class="tc__list">
            <li>Refundable bookings may be cancelled or modified before the check-in date, subject to the property's policy and  {{ $merchant->name }} service fees.</li>
            <li>Refund amounts are processed after deducting applicable hotel penalties and service charges.</li>
            <li>Refund timelines vary based on the hotel's policy and payment method used.</li>
        </ul>

        <p class="tc__text"><strong>b) Non-Refundable Bookings</strong></p>

        <ul class="tc__list">
            <li>Non-refundable bookings cannot be cancelled, modified, or refunded once confirmed.</li>
            <li>Full payment is required at the time of booking, and failure to check in will result in forfeiture of the entire amount.</li>
        </ul>

        <div class="note-box">
            <p class="tc__text"><strong>Important:</strong> Any request for cancellation or amendment must be submitted via  {{ $merchant->name }} and <strong>not directly with the hotel</strong>. For assistance, please contact our Travel Consultant at <strong>{{ $merchant->phone }}</strong>.</p>
        </div>

        <h2 class="tc__subtitle">3. Traveler Identity & Documentation</h2>

        <ul class="tc__list">
            <li>The primary guest must be at least 18 years of age and present a valid government-issued photo ID upon check-in.</li>
            <li>The name on the booking must exactly match the name on the ID.</li>
            <li>Hotels reserve the right to deny check-in if identification does not match the booking details.</li>
            <li>For international stays, travellers are responsible for carrying valid passports, visas, or any required entry documents.</li>
        </ul>

        <h2 class="tc__subtitle">4. Check-in / Check-out Policy</h2>

        <ul class="tc__list">
            <li>Standard check-in and check-out times vary by property and will be stated in your booking confirmation.</li>
            <li>Early check-in or late check-out requests are subject to hotel availability and may incur additional charges.</li>
            <li>Guests arriving later than the scheduled check-in time must inform  {{ $merchant->name }} in advance to avoid a no-show penalty.</li>
        </ul>

        <h2 class="tc__subtitle">5. Payment and Credit Card Authorization</h2>

        <ul class="tc__list">
            <li> {{ $merchant->name }} accepts all major credit, debit, and domestic payment cards.</li>
            <li>Bookings made with domestic, international, or third-party cards may require additional verification, including:
                <ul>
                    <li>Completed Credit Card Authorization Form</li>
                    <li>Valid government-issued photo ID (front and back)</li>
                    <li>Copy of the card used for payment (front and back)</li>
                </ul>
            </li>
            <li>Additional verification may be required for urgent bookings or high-value transactions.</li>
            <li>Declined or unverified transactions will not be processed, and booking prices are not guaranteed until payment is confirmed.</li>
        </ul>

        <h2 class="tc__subtitle">6. Payment Security</h2>

        <p class="tc__text">Your payment information is protected by advanced encryption and fraud-prevention measures.</p>

        <ul class="tc__list">
            <li> {{ $merchant->name }} uses PCI DSS-compliant systems for secure credit card transactions.</li>
            <li>In case of suspicious or fraudulent activity,  {{ $merchant->name }} reserves the right to cancel the booking and refund the amount to the original payment method after necessary verification.</li>
        </ul>

        <h2 class="tc__subtitle">7. Deposit and Taxes</h2>

        <ul class="tc__list">
            <li><strong>Taxes and Fees:</strong> The total price displayed includes room charges and standard taxes unless specified otherwise. Local resort fees, city taxes, or service charges may be collected directly by the hotel at check-in or check-out.</li>
            <li><strong>Incidental Deposits:</strong> Hotels may require a <strong>security deposit</strong> at check-in for incidental expenses such as minibar use, room service, or damages. This deposit is refundable at check-out, subject to hotel policy.</li>
            <li><strong>Currency and Exchange Rates:</strong> All charges are processed in the currency specified at the time of booking. Exchange rate variations may affect the final amount if paying in another currency.</li>
        </ul>

        <h2 class="tc__subtitle">8. No-Show & Early Departure</h2>

        <ul class="tc__list">
            <li>Failure to check in on the scheduled date without prior notice will be treated as a <strong>no-show</strong>, and the entire booking amount will be forfeited.</li>
            <li>Early departures are treated as partial cancellations, and refunds (if applicable) are subject to the hotel's policy.</li>
        </ul>

        <h2 class="tc__subtitle">9. Hotel Facilities, Meals & Special Requests</h2>

        <ul class="tc__list">
            <li><strong>Requests:</strong> Requests for amenities such as <strong>non-smoking rooms, adjoining rooms, high floors, or specific bedding types</strong> are subject to hotel availability and cannot be guaranteed.</li>
            <li><strong>Special Equipment and Services:</strong> Optional services such as <strong>airport transfers, extra beds, breakfast plans, or spa access</strong> may be available for an additional charge, payable directly to the hotel.</li>
            <li><strong>Voluntary Add-ons:</strong> The hiring or purchase of such additional services is a <strong>voluntary arrangement between you and the hotel</strong>.  {{ $merchant->name }} does not intervene and is <strong>not liable</strong> for any additional amounts or service variations.</li>
            <li> {{ $merchant->name }} provides information as per the hotel's current policy; travellers are advised to verify details with our team before travel.</li>
        </ul>

        <h2 class="tc__subtitle">10. Room Type Guarantee & Incidental Charges</h2>

        <ul class="tc__list">
            <li>Room allocation (e.g., bed type, smoking preference, or view) is at the hotel's discretion and cannot be guaranteed.</li>
            <li>Guests are responsible for incidental charges such as minibar usage, phone calls, laundry, parking, or damages during their stay.</li>
            <li>Such charges must be settled directly with the property upon check-out.</li>
        </ul>

        <h2 class="tc__subtitle">11. Involuntary Changes</h2>

        <ul class="tc__list">
            <li>In the event of hotel overbooking, closure, or any changes initiated by the property, <strong> {{ $merchant->name }}</strong> will assist in arranging alternative accommodation of similar category or processing applicable refunds as per the hotel's policy.</li>
            <li><strong> {{ $merchant->name }}</strong> is not responsible for any additional expenses resulting from such involuntary changes, including transportation, meals, or incidental costs incurred by the traveller.</li>
            <li> {{ $merchant->name }} will assist to the best of its ability but is <strong>not responsible for compensation or losses</strong> resulting from hotel relocation decisions.</li>
        </ul>

        <h2 class="tc__subtitle">12. Privacy Policy</h2>

        <p class="tc__text"> {{ $merchant->name }} respects your privacy and is committed to safeguarding your personal and payment information.</p>

        <ul class="tc__list">
            <li>All personal data collected is used solely for processing bookings and delivering travel-related services.</li>
            <li>We do not sell or share your information with third parties except as required by law or necessary for booking fulfilment.</li>
            <li>All payment data is processed through PCI-compliant and encrypted systems.</li>
        </ul>

        <p class="tc__text">For details, visit our <strong>Privacy Policy</strong> at <a href="https://www.traveladesk.com/privacy-policy.php">https://www.traveladesk.com/privacy-policy.php</a></p>

        <h2 class="tc__subtitle">13. Customer Support</h2>

        <div class="tc__contact">
            <p class="tc__text">We are committed to providing you with reliable and responsive service before, during, and after your travel.</p>
           <p class="tc__text"><strong>Customer Support (Available 24/7):</strong></p>
      <p class="tc__text"><i class="fa-solid fa-phone"></i> <strong>Phone:</strong> {{ $merchant->phone }}</p>
      <p class="tc__text"><i class="fa-solid fa-envelope"></i> <strong>Email:</strong> support@traveladesk.com</p>
      <p class="tc__text"><i class="fa-solid fa-globe"></i> <strong>Website:</strong> www.traveladesk.com</p>
            </div>
            
            <p class="tc__text" style="margin-top: 15px;">For urgent issues at check-in or during your stay, please contact the <strong>hotel front desk directly</strong> for immediate assistance.</p>
            <p class="tc__text">We sincerely appreciate your business and look forward to serving you.</p>    
    </div>
    @endif

    <!-- Train Terms and Conditons -->
    @if($booking_type->contains('type', 'Train'))
      <div class="tc__wrapper">
        
        <h2 class="tc__title">General Train Terms and Conditions</h2>

        <p class="tc__text">By accessing our website or booking through one of our agents, you acknowledge and agree to the following terms and conditions. Please review them carefully before making any purchase.</p>

        <h2 class="tc__subtitle">1. General Conditions</h2>

        <ul class="tc__list">
            <li><strong>Intermediary Role:</strong>  {{ $merchant->name }} acts solely as an <strong>intermediary</strong> between customers and railway operators or authorized ticket distributors. All bookings are governed by the <strong>respective rail operator's terms, fare rules, and travel policies</strong>.</li>
            <li><strong>Contract of Carriage:</strong> Your train booking and journey are subject to the <strong>terms and conditions of carriage</strong> of the railway company providing the service. These terms form a binding contract between you and the operator.</li>
            <li><strong>Booking Confirmation:</strong> A reservation is confirmed only once full payment is received and the <strong>e-ticket or booking reference</strong> is issued.</li>
            <li><strong>Train Schedules and Availability:</strong> Train times, seat classes, and routes are subject to availability and may change without prior notice due to operational or safety reasons.</li>
        </ul>

        <h2 class="tc__subtitle">2. Passenger Information and Documentation</h2>

        <ul class="tc__list">
            <li><strong>Accurate Details:</strong> Passenger names must match the valid <strong>government-issued photo ID</strong> presented during travel. Incorrect or incomplete details may result in denied boarding without refund.</li>
            <li><strong>Identification:</strong> A valid photo ID (such as passport, national ID, or driver's license) is mandatory for all passengers during ticket verification and boarding.</li>
            <li><strong>Travel Documents:</strong> It is the traveller's responsibility to verify if any <strong>additional travel permits or documents</strong> are required for cross-border or regional train journeys.</li>
            <li><strong>Minors and Special Assistance:</strong> Passengers requiring special assistance or minors traveling alone must comply with the specific rules of the railway operator.</li>
        </ul>

        <h2 class="tc__subtitle">3. Fares, Payment, and Taxes</h2>

        <ul class="tc__list">
            <li><strong>Accepted Payments:</strong>  {{ $merchant->name }} accepts all major credit, debit, and domestic payment cards.</li>
            <li><strong>Verification:</strong> Bookings made using domestic, international, or third-party cards may require:
                <ul>
                    <li>Completed Credit Card Authorization Form</li>
                    <li>Government-issued ID (front and back)</li>
                    <li>Copy of payment card (front and back) showing name and signature</li>
                </ul>
            </li>
            <li><strong>Urgent Travel or High-Value Bookings:</strong> Additional verification may be required for last-minute travel or high-value transactions.</li>
            <li><strong>Declined Payments:</strong> If a card is declined, notification will be sent within 24-48 hours. The fare is not guaranteed until payment is successfully processed.</li>
            <li><strong>Fares and Taxes:</strong> Fares include applicable railway base fares and taxes unless otherwise specified. Optional services such as meal plans, seat upgrades, or sleeper arrangements may incur additional charges.</li>
            <li><strong>Currency:</strong> All fares are processed in the currency specified at booking.  {{ $merchant->name }} is not responsible for fluctuations in exchange rates or currency conversion fees.</li>
            <li><strong>Price Changes:</strong> Train fares are subject to change prior to ticket issuance. If the fare increases before ticketing, customers will be informed and may cancel without penalty.</li>
        </ul>

        <h2 class="tc__subtitle">4. Payment Security</h2>

        <p class="tc__text">Your payment information is protected by advanced encryption and fraud-prevention measures.</p>

        <ul class="tc__list">
            <li> {{ $merchant->name }} uses PCI DSS-compliant systems for secure credit card transactions.</li>
            <li>In case of suspicious or fraudulent activity,  {{ $merchant->name }} reserves the right to cancel the booking and refund the amount to the original payment method after necessary verification.</li>
        </ul>

        <h2 class="tc__subtitle">5. Amendments, Cancellations, and Refunds</h2>

        <ul class="tc__list">
            <li><strong>Amendments:</strong>
                <ul>
                    <li>Changes to travel dates, passenger details, or train classes depend on the rail operator's policy and availability.</li>
                    <li>Amendment fees and fare differences may apply.</li>
                </ul>
            </li>
        </ul>

        <p class="tc__text"><strong>Cancellations:</strong></p>

        <p class="tc__text"><strong>a) Refundable Tickets:</strong></p>

        <ul class="tc__list">
            <li>Refundable train tickets may be cancelled or modified before departure, subject to the carrier's policy and  {{ $merchant->name }} service fees.</li>
            <li>Approved refunds will be processed after deducting applicable operator penalties and  {{ $merchant->name }} processing fees.</li>
            <li>Refund timelines may vary based on the train operator and payment method.</li>
        </ul>

        <p class="tc__text"><strong>b) Non-Refundable Tickets:</strong></p>

        <ul class="tc__list">
            <li>Non-refundable tickets cannot be cancelled, modified, or refunded once issued.</li>
            <li>Full payment is required at the time of booking.</li>
            <li>Failure to board the train on the scheduled date or time will result in forfeiture of the entire ticket value.</li>
            <li>Missed trains due to late arrival will be considered a <strong>no-show</strong>, and no refund will apply.</li>
        </ul>

        <div class="note-box">
            <p class="tc__text"><strong>Important:</strong> Any cancellations, amendments, or refund requests must be handled through  {{ $merchant->name }} and <strong>not with the train operator</strong>. For assistance, contact our Travel Consultant at <strong>{{ $merchant->phone }}</strong>.</p>
        </div>

        <h2 class="tc__subtitle">6. Boarding and Travel Requirements</h2>

        <ul class="tc__list">
            <li><strong>Check-In Time:</strong> Passengers are advised to arrive at the station <strong>at least 30-60 minutes before departure</strong> to allow for check-in, security, or platform allocation.</li>
            <li><strong>Seat Allocation:</strong> Seat preferences (window, aisle, upper/lower berth, etc.) are subject to availability and may not always be guaranteed.</li>
            <li><strong>Ticket Validity:</strong> Tickets are valid only for the <strong>specified train, class, and travel date</strong> mentioned on the e-ticket.</li>
            <li><strong>Missed Connections:</strong>  {{ $merchant->name }} is not responsible for missed connections caused by delays in other modes of transportation.</li>
        </ul>

        <h2 class="tc__subtitle">7. Baggage and Onboard Policy</h2>

        <ul class="tc__list">
            <li><strong>Baggage Allowance:</strong> Each railway operator determines the <strong>baggage weight and size limits</strong>. Excess baggage may incur additional fees or be refused.</li>
            <li><strong>Prohibited Items:</strong> Dangerous goods, flammable substances, and illegal materials are strictly prohibited.</li>
            <li><strong>Lost or Damaged Luggage:</strong>  {{ $merchant->name }} is not liable for lost or damaged luggage. Claims must be made directly with the railway company.</li>
            <li><strong>Onboard Conduct:</strong> Passengers must follow the train staff's instructions and maintain proper behaviour. Operators may deny travel to passengers under the influence of alcohol or causing disturbances.</li>
        </ul>

        <h2 class="tc__subtitle">8. Optional and Additional Services</h2>

        <ul class="tc__list">
            <li><strong>Add-On Purchases:</strong> Optional services such as <strong>meal reservations, Wi-Fi, seat upgrades, or lounge access</strong> may be available for an extra fee payable directly to the operator. Requests for special assistance (e.g., wheelchair access, priority seating, or extra luggage) are subject to availability and the train operator's approval.</li>
            <li><strong>Voluntary Services:</strong> Purchasing these services is a <strong>voluntary agreement between you and the railway company</strong>.  {{ $merchant->name }} does not intervene and is <strong>not liable for additional costs or service quality</strong>.</li>
            <li><strong>Geographical Restrictions:</strong> Some train passes or regional tickets may not be valid on all routes or trains. Always verify route eligibility before booking.</li>
        </ul>

        <h2 class="tc__subtitle">9. Service Interruptions and Delays</h2>

        <ul class="tc__list">
            <li><strong>Operational Changes:</strong> Train schedules may be adjusted or canceled due to weather, technical failures, strikes, or other unforeseen circumstances.</li>
            <li><strong>Responsibility:</strong>  {{ $merchant->name }} is not responsible for delays, cancellations, or disruptions caused by the rail operator.</li>
            <li><strong>Alternative Arrangements:</strong> In such cases, the railway company's <strong>compensation or rescheduling policy</strong> will apply.</li>
        </ul>

        <h2 class="tc__subtitle">10. Liability Disclaimer</h2>

        <ul class="tc__list">
            <li> {{ $merchant->name }} serves only as an intermediary and does not operate trains or control rail services.</li>
            <li>We are <strong>not liable</strong> for personal injury, loss, damage, or delay caused by the railway operator, third-party suppliers, or events beyond our control.</li>
            <li>Our liability is limited to the <strong>amount paid for the booking</strong> and shall not extend beyond the scope of our services as an agent.</li>
        </ul>

        <h2 class="tc__subtitle">11. Travel Insurance</h2>

        <ul class="tc__list">
            <li>It is strongly advised that all passengers obtain <strong>comprehensive travel insurance</strong> covering train delays, cancellations, accidents, and baggage loss.</li>
            <li> {{ $merchant->name }} does not provide insurance but can recommend external providers upon request.</li>
        </ul>

        <h2 class="tc__subtitle">12. Involuntary Changes</h2>

        <ul class="tc__list">
            <li>Train operators may alter or cancel services due to operational reasons, weather, or other unforeseen circumstances.</li>
            <li>In such cases,  {{ $merchant->name }} will assist in arranging rebooking or refunds in line with the train operator's policy.</li>
            <li> {{ $merchant->name }} is not responsible for any additional costs, such as hotel stays or alternate transportation, resulting from such changes.</li>
        </ul>

        <h2 class="tc__subtitle">13. Privacy Policy</h2>

        <p class="tc__text"> {{ $merchant->name }} respects your privacy and is committed to safeguarding your personal and payment information.</p>

        <ul class="tc__list">
            <li>All personal data collected is used solely for processing bookings and delivering travel-related services.</li>
            <li>We do not sell or share your information with third parties except as required by law or necessary for booking fulfilment.</li>
            <li>All payment data is processed through PCI-compliant and encrypted systems.</li>
        </ul>

        <p class="tc__text">For details, visit our <strong>Privacy Policy</strong> at <a href="https://www.traveladesk.com/privacy-policy.php">https://www.traveladesk.com/privacy-policy.php</a></p>

        <h2 class="tc__subtitle">14. Customer Support</h2>

        <div class="tc__contact">
            <p class="tc__text">We are committed to providing you with reliable and responsive service before, during, and after your travel.</p>
           <p class="tc__text"><strong>Customer Support (Available 24/7):</strong></p>
      <p class="tc__text"><i class="fa-solid fa-phone"></i> <strong>Phone:</strong> {{ $merchant->phone }}</p>
      <p class="tc__text"><i class="fa-solid fa-envelope"></i> <strong>Email:</strong> support@traveladesk.com</p>
      <p class="tc__text"><i class="fa-solid fa-globe"></i> <strong>Website:</strong> www.traveladesk.com</p>
            
            <p class="tc__text" style="margin-top: 15px;">For last-minute changes or issues at the station, please contact the <strong>rail operator's help desk</strong> immediately for on-site assistance.</p>
            <p class="tc__text">We sincerely appreciate your business and look forward to serving you.</p>
        </div>
          @endif
    </div>
  </main>

  <!-- ===== Global Page Footer ===== -->
  <footer class="page-footer">
    <p class="tc__copy">© 2025  {{ $merchant->name }}. All Rights Reserved.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
