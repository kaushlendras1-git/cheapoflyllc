  <!-- Tab Navigation -->
        <ul class="nav nav-tabs tabs-booked" id="bookingTabs" role="tablist">

            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="passenger-tab" data-bs-toggle="tab" href="#passenger" role="tab"
                    aria-controls="passenger" aria-selected="true">
                    <i class="ri ri-user-3-fill" title="Passengers" style="color: #00008b; font-size: 20px;"></i>
                </a>
            </li>

            <li class="nav-item" role="presentation" data-tab="Flight"
                style="{{ in_array('Flight', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
                <a class="nav-link" id="flightbooking-tab" data-bs-toggle="tab" href="#flightbooking" role="tab"
                    aria-controls="flightbooking" aria-selected="true">
                   

  <i class="ri ri-flight-takeoff-line" style="font-size: 20px;"></i>
  <i class="ri ri-flight-land-line" style="font-size: 18px; margin-top: 2px; transform: scaleX(-1);"></i>
 

                    </a>
            </li>

            <li class="nav-item" role="presentation" data-tab="Hotel"
                style="{{ in_array('Hotel', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
                <a class="nav-link" id="hotelbooking-tab" data-bs-toggle="tab" href="#hotelbooking" role="tab"
                    aria-controls="hotelbooking" aria-selected="true"><i class="ri ri-hotel-fill" title="Hotel"
                        style="color: #8b4513; font-size: 20px;"></i></a>
            </li>

            <li class="nav-item" role="presentation" data-tab="Cruise"
                style="{{ in_array('Cruise', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
                <a class="nav-link" id="cruisebooking-tab" data-bs-toggle="tab" href="#cruisebooking" role="tab"
                    aria-controls="cruisebooking" aria-selected="true"><i class="ri ri-ship-fill" title="Cruise"
                        style="color: #006994; font-size: 20px;"></i></a>
            </li>

            <li class="nav-item" role="presentation" data-tab="Car"
                style="{{ in_array('Car', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
                <a class="nav-link" id="carbooking-tab" data-bs-toggle="tab" href="#carbooking" role="tab"
                    aria-controls="carbooking" aria-selected="true"><i class="ri ri-car-fill" title="Car"
                        style="color: #228b22; font-size: 20px;"></i></a>
            </li>

            <li class="nav-item" role="presentation" data-tab="Train"
                style="{{ in_array('Train', $bookingTypes) ? 'display:block;' : 'display:none;' }}">
                <a class="nav-link" id="trainbooking-tab" data-bs-toggle="tab" href="#trainbooking" role="tab"
                    aria-controls="trainbooking" aria-selected="true">
                    <i class="ri ri-train-line" title="Train" style="color: #8a2be2; font-size: 20px;"></i></a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link" id="billing-tab" data-bs-toggle="tab" href="#billing" role="tab"
                    aria-controls="billing" aria-selected="false">
                    <i class="ri ri-bank-line" style="font-size: 20px; color: #2e8b57;" title="Billing"></i>
                </a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pricing-tab" data-bs-toggle="tab" href="#pricing" role="tab"
                    aria-controls="pricing" aria-selected="false">

                    <i class="ri ri-money-dollar-circle-line" style="font-size: 20px; color: #6a5acd;"
                        title="Pricing"></i>
                </a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link" id="remarks-tab" data-bs-toggle="tab" href="#remarks" role="tab"
                    aria-controls="remarks" aria-selected="false">
                    <i class="ri ri-sticky-note-line" style="font-size: 20px; color: #d2691e;"
                        title="Booking Remarks"></i>

                </a>
            </li>




            <li class="nav-item" role="presentation">
                <a class="nav-link" id="screenshots-tab" data-bs-toggle="tab" href="#screenshots" role="tab"
                    aria-controls="screenshots" aria-selected="false">
                    <i class="ri ri-image-line" style="font-size: 20px; color: #ff6347;" title="Screenshots"></i>
                </a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ringcentral-tab" data-bs-toggle="tab" href="#ringcentral" role="tab"
                    aria-controls="ringcentral" aria-selected="false">
                    <i class="ri ri-phone-line" style="font-size: 20px; color: #ff4500;" title="RingCentral"></i>
                </a>
            </li>

        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-0 p-0 booked-content" id="bookingTabsContent">

            <!-- Passeengers Tab -->
            @include('web.booking.partials.passeenger')

            <!-- Flight Tab -->
            @include('web.booking.partials.flight')

             <!-- Car Tab -->
            @include('web.booking.partials.car')

            <!-- Cruise Tab -->
            @include('web.booking.partials.cruise')

              <!-- Hotel Tab -->
            @include('web.booking.partials.hotel')

            <!-- Train Tab -->
            @include('web.booking.partials.train')

            <!-- Biling Tab -->
            @include('web.booking.partials.billing')

            <!-- Pricing Tab -->
            @include('web.booking.partials.pricing')

            <!-- Remarks Tab -->
            @include('web.booking.partials.remarks', ['remarks' => $booking->remarks])



            <!-- Screenshots Tab -->
            @include('web.booking.partials.screenshots', ['screenshot_images' => $screenshot_images])

            <!-- RingCentral Tab -->
            @include('web.booking.partials.ringcentral')

        </div>