<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Authorization</title>
    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        background-color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, Arial, sans-serif;
        font-size: 12px;
        line-height: 1.4;
        -webkit-print-color-adjust: exact !important;
        color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .main-container {
        width: 700px;
        max-width: 700px;
        margin: 0 auto;
        background-color: #ffffff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        page-break-inside: avoid;
    }

    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }

    td {
        vertical-align: top;
    }

    .section {
        margin: 10px 0;
        border: 1px solid #e9ecef;
        border-radius: 6px;
        overflow: hidden;
        page-break-inside: auto;
    }

    .section-header {
        background-color: #274481;
        color: #ffffff;
        padding: 8px 10px;
        font-size: 14px;
        font-weight: 500;
    }

    .section-content {
        padding: 10px;
        page-break-inside: auto;
    }

    .info-box {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 6px;

    }

    .passenger-table {
        width: 100%;
        border-collapse: collapse;
    }

    .passenger-table th,
    .passenger-table td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #e9ecef;
        font-size: 12px;
    }

    .passenger-table th {
        background-color: #deecfb;
        font-weight: 600;
        color: #0f172a;
    }

    .price-row {
        width: 100%;
        border-bottom: 1px solid #e9ecef;
        padding: 5px 0;
    }

    .total-row {
        width: 100%;
        border-top: 2px solid #e9ecef;
        padding: 12px 0;
        font-weight: 600;
    }

    /* Print-specific styles */
    @media print {
        body {
            margin: 0;
            padding: 0;
            background: #fff !important;
        }

        .main-container {
            width: 100%;
            max-width: 100%;
            margin: 0;
            box-shadow: none;
        }

        .section {
            margin: 5px 0;
            border: 1px solid #e9ecef;
        }

        /* Ensure background colors print */
        .section-header,
        .passenger-table th {
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            print-color-adjust: exact;
        }
    }
    </style>
</head>

@php
$bookingTypes = $booking->bookingTypes->pluck('type')->toArray();
@endphp

<body>
    <!-- Main Container -->
    <div class="main-container">
        <!-- Header -->
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td style="background-color: #ffffff; padding: 0;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td
                                style="background: #1C316D; padding: 10px; color: #ffffff; font-size: 16px; font-weight: 600;">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="50%"
                                            style="text-align: left; font-size: 14px; font-weight: 600; color: #ffffff;">
                                            Speak to a Travel Expert
                                        </td>
                                        <td width="50%"
                                            style="text-align: right; font-size: 14px; font-weight: 600; color: #ffffff;">
                                            <img src="{{ public_path('email-templates/call.png') }}" width="12"
                                                height="12" alt="Call"
                                                style="vertical-align: middle; display: inline-block; margin-right: 5px; filter: brightness(0) invert(1);" />
                                            +1-844-362-2566
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Banner Image -->
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td style="background-color: #ffffff; padding: 0;">
                    @if($bookingTypes[0] == 'Flight')
                    <img src="{{ public_path('email-templates/flight-banner.png') }}" alt="Flight"
                        style="display: block; width: 100%; height: auto; max-height: 250px;">
                    @elseif($bookingTypes[0] == 'Cruise')
                    <img src="{{ public_path('email-templates/cruise.jpeg') }}" alt="Cruise"
                        style="display: block; width: 100%; height: auto; max-height: 250px;">
                    @elseif($bookingTypes[0] == 'Train')
                    <img src="{{ public_path('email-templates/amtrak.jpeg') }}" alt="Train"
                        style="display: block; width: 100%; height: auto; max-height: 250px;">
                    @elseif($bookingTypes[0] == 'Car')
                    <img src="{{ public_path('email-templates/car.jpeg') }}" alt="Car"
                        style="display: block; width: 100%; height: auto; max-height: 250px;">
                    @elseif($bookingTypes[0] == 'Hotel')
                    <img src="{{ public_path('email-templates/hotel.jpeg') }}" alt="Hotel"
                        style="display: block; width: 100%; height: auto; max-height: 250px;">
                    @endif
                </td>
            </tr>
        </table>


        <!-- Greeting -->
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td style="font-size: 12px; font-weight: 600; padding: 5px 0 5px 0; color: #0f172a;">
                    Dear {{ $booking->name }},
                </td>
            </tr>
            <tr>
                <td style="font-size: 12px; line-height: 1.3; color: #4a5568; padding: 0 0 5px 0;">
                    Thank you for using {{ $booking->selected_company_name }} for your travel needs. Please take a
                    moment to review the names, date, itinerary, price and other relevant details of your booking.
                    AGENTNAME has requested you to review the document for DOCUMENTNAME.
                </td>
            </tr>
        </table>

        <!-- Success Message -->
        @if(session('success') || $errors->any())
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td style="padding: 0 0 15px 0;">
                    @if(session('success'))
                    <div
                        style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; border-left: 4px solid #28a745; font-size: 12px;">
                        ✅ Thank you for your authorization! Your signature has been successfully recorded.
                    </div>
                    @endif

                    @if($errors->any())
                    <div
                        style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; border-left: 4px solid #dc3545; font-size: 12px;">
                        <ul style="margin: 0; padding-left: 15px;">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </td>
            </tr>
        </table>
        @endif

        <!-- Order Reference Number -->
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%" style="padding: 0 5px 0 0;">
                    <div class="info-box">
                        <table width="100%">
                            <tr>
                                <td width="40" style="padding-right: 10px; vertical-align: middle;">
                                    <img width="28" height="28"
                                        src="{{ public_path('email-templates/ordered-records.png') }}" alt="Number"
                                        style="display: block;">
                                </td>
                                <td style="vertical-align: middle;">
                                    <div style="font-size: 12px; font-weight: 500; color: #0f172a; ">
                                        Order Reference Number</div>
                                    <div style="font-size: 12px; color: #4a5568; font-weight: 400;">{{ $booking->pnr }}
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>

                <td width="50%" style="padding: 0 0 0 5px;">
                    <div class="info-box">
                        <table width="100%">
                            <tr>
                                <td width="40" style="padding-right: 10px; vertical-align: middle;">
                                    <img width="28" height="28" src="{{ public_path('email-templates/calendar.png') }}"
                                        alt="Date" style="display: block;">
                                </td>
                                <td style="vertical-align: middle;">
                                    <div style="font-size: 12px; font-weight: 500; color: #0f172a; ">
                                        Order Date</div>
                                    <div style="font-size: 12px; color: #4a5568; font-weight: 400;">
                                        {{ $booking->created_at->format('l, M d, Y') }}
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Flight Details -->
        @if(in_array('Flight', $bookingTypes))
        <div class="section">
            <div class="section-header">Flight Details :-</div>
            <div class="section-content">
                @if($booking->travelFlight->isNotEmpty())
                @foreach($booking->travelFlight as $index => $flight)
                <table width="100%" style="margin-bottom: 15px;">
                    <tr>
                        <td width="50" style="padding-right: 10px; vertical-align: top; padding-right:20px">
                            @php
                            $airline = \App\Models\Airline::where('airline_code', $flight->airline_code)->first();
                            $logoPath = $airline && $airline->logo ? public_path($airline->logo) :
                            public_path('email-templates/default-airline.png');
                            @endphp
                            <img src="{{ $logoPath }}" alt="airline logo"
                                style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td style="vertical-align: top; padding-left: 10px;">
                            <table width="100%">
                                <tr>
                                    <td style="font-size: 12px; font-weight: 600; color: #0f172a; ">
                                        {{ $flight->departure_date?->format('D, M j') }} - {{$flight->airline_code}}
                                        {{$flight->flight_number}} - {{$flight->duration}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 12px; color: #4a5568; ">
                                        <strong style="font-weight: 600; color: #0f172a;">Departing:</strong>
                                        {{ date('h:i A', strtotime($flight->departure_hours)) }} from
                                        {{$flight->departure_airport}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 12px; color: #4a5568;">
                                        <strong style="font-weight: 600; color: #0f172a;">Arriving:</strong>
                                        {{ date('h:i A', strtotime($flight->arrival_hours)) }} into
                                        {{$flight->arrival_airport}}
                                    </td>
                                </tr>
                                @if($flight->transit && $flight->transit != '00:00')
                                <tr>
                                    <td style="color: #718096; font-size: 12px; padding: 8px 0;">
                                        -------- Transit Time: {{$flight->transit }} --------
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                </table>
                @if(!$loop->last)
                <div style="width: 90%; margin: 10px auto; border-top: 1px dashed #cbd5e0; opacity: 0.9;"></div>
                @endif
                @endforeach
                @endif

                @if($flight_images)
                @foreach ($flight_images as $key => $img)
                <div style="padding-top: 10px;">
                    <img src="{{ public_path($img->file_path) }}"
                        style="max-width: 100%; height: auto; border-radius: 4px;">
                </div>
                @endforeach
                @endif
            </div>
        </div>
        @endif

        <!-- Hotel Details -->
        @if(in_array('Hotel', $bookingTypes) && $booking->travelHotel->isNotEmpty())
        <div class="section">
            <div class="section-header">Hotel Details :-</div>
            <div class="section-content">

                <!-- Hotel Image -->
                <div style="margin-bottom: 10px;">
                    <img src="{{ public_path('email-templates/bedroom.jpg') }}" alt="Hotel"
                        style="width:100%; height:200px; border-radius: 4px; object-fit: cover;">
                </div>

                <!-- ✅ Loop each hotel as its own printable block -->
                @foreach($booking->travelHotel as $key => $travelHotel)
                <div
                    style="background:#f8f9fa; padding:10px 15px; border-radius: 6px; margin-bottom: 15px; page-break-inside: avoid;">
                    <table width="100%">
                        <tr>
                            <td width="25%" style="padding: 5px; vertical-align: top;">
                                <div style="font-size: 12px; color:#0f172a; font-weight:600;">Hotel Name</div>
                                <div style="font-weight:normal; color: #4a5568; font-size: 12px;">
                                    {{ $travelHotel->hotel_name }}
                                </div>
                            </td>
                            <td width="25%" style="padding: 5px; vertical-align: top;">
                                <div style="font-size: 12px; color:#0f172a; font-weight:600;">Room Category</div>
                                <div style="font-weight:normal; color: #4a5568; font-size: 12px;">
                                    {{ $travelHotel->room_category }}
                                </div>
                            </td>
                            <td width="25%" style="padding: 5px; vertical-align: top;">
                                <div style="font-size: 12px; color:#0f172a; font-weight:600;">Confirmation Number</div>
                                <div style="font-weight:normal; color: #4a5568; font-size: 12px;">
                                    {{ $travelHotel->confirmation_number }}
                                </div>
                            </td>
                            <td width="25%" style="padding: 5px; vertical-align: top;">
                                <div style="font-size: 12px; color:#0f172a; font-weight:600;">Rooms</div>
                                <div style="font-weight:normal; color: #4a5568; font-size: 12px;">
                                    {{ $travelHotel->no_of_rooms }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 5px; vertical-align: top;">
                                <div style="font-size: 12px; color:#0f172a; font-weight:600;">Hotel Address</div>
                                <div style="font-weight:normal; color: #4a5568; font-size: 12px;">
                                    {{ $travelHotel->hotel_address }}
                                </div>
                            </td>
                            <td style="padding: 5px; vertical-align: top;">
                                <div style="font-size: 12px; color:#0f172a; font-weight:600;">Check-In</div>
                                <div style="font-weight:normal; color: #4a5568; font-size: 12px;">
                                    {{ $travelHotel->checkin_date ? $travelHotel->checkin_date->format('l, F d, Y') : '' }}
                                </div>
                            </td>
                            <td style="padding: 5px; vertical-align: top;">
                                <div style="font-size: 12px; color:#0f172a; font-weight:600;">Check-Out</div>
                                <div style="font-weight:normal; color: #4a5568; font-size: 12px;">
                                    {{ $travelHotel->checkout_date ? $travelHotel->checkout_date->format('l, F d, Y') : '' }}
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                @endforeach

                <!-- Hotel Description -->
                <div style="padding:0px; color:#4a5568;">
                    <div style="white-space: pre-line; font-size:12px; line-height: 1.4;">
                        {!! $booking->hotel_description !!}
                    </div>
                </div>

                <!-- Hotel Images -->
                @if($hotel_images)
                @foreach ($hotel_images as $key => $img)
                <div style="padding: 10px 0; page-break-inside: avoid;">
                    <img src="{{ public_path($img->file_path) }}"
                        style="max-width: 100%; height: auto; border-radius: 4px;">
                </div>
                @endforeach
                @endif

            </div>
        </div>
        @endif


        <!-- Cruise Details -->
        @if(in_array('Cruise', $bookingTypes))
        <div class="section">
            <div class="section-header">Cruise Details :-</div>
            <div class="section-content">
                <table width="100%" style="margin-bottom: 10px;">
                    <tr>
                        <td>
                            <table width="100%"
                                style="font-size: 12px; font-weight:500; color:#0f172a; padding:8px; background-color: #f8f9fa;">
                                <tr>
                                    <td width="50%"> <span style="font-weight: 600; color:#0f172a;"> Cruise Line -
                                        </span>
                                        {{ $travel_cruise_data->cruise_line ?? '' }}</td>
                                    <td width="50%" style="text-align: right;"> <span
                                            style="font-weight: 600; color:#0f172a;">Name of
                                            Ship -</span>
                                        {{ $travel_cruise_data->ship_name ?? '' }}
                                    </td>
                                </tr>
                            </table>

                            <table width="100%"
                                style="background:#f8f9fa; padding:10px; border:1px solid #e9ecef; margin-bottom: 15px; border-radius: 6px;">
                                <tr>
                                    <td width="25%" style="padding: 5px; vertical-align: top;">
                                        <div
                                            style="font-size: 12px; color:#0f172a; font-weight:500; margin-bottom: 0px;">
                                            Length</div>
                                        <div style="font-weight:normal; color: #4a5568; font-size: 12px;">
                                            {{ $travel_cruise_data->length ?? '' }}
                                        </div>
                                    </td>
                                    <td width="25%" style="padding: 5px; vertical-align: top;">
                                        <div
                                            style="font-size: 12px; color:#0f172a; font-weight:600; margin-bottom: 0px;">
                                            Departure Port</div>
                                        <div style="font-weight:normal; color: #4a5568; font-size: 12px;">
                                            {{ $travel_cruise_data->departure_port ?? '' }}
                                        </div>
                                    </td>
                                    <td width="25%" style="padding: 5px; vertical-align: top;">
                                        <div
                                            style="font-size: 12px; color:#0f172a; font-weight:600; margin-bottom: 0px;">
                                            Arrival Port</div>
                                        <div style="font-weight:normal; color: #4a5568; font-size: 12px;">
                                            {{ $travel_cruise_data->arrival_port ?? '' }}
                                        </div>
                                    </td>
                                    <td width="25%" style="padding: 5px; vertical-align: top;">
                                        <div
                                            style="font-size: 12px; color:#0f172a; font-weight:600; margin-bottom: 0px;">
                                            Category</div>
                                        <div style="font-weight:normal; color: #4a5568; font-size: 12px;">
                                            {{ $travel_cruise_data->category ?? '' }}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding: 5px; vertical-align: top;">
                                        <div
                                            style="font-size: 12px; color:#0f172a; font-weight:600; margin-bottom: 0px;">
                                            Stateroom</div>
                                        <div style="font-weight:normal; color: #4a5568; font-size: 12px;">
                                            {{ $travel_cruise_data->stateroom ?? '' }}
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <!-- Itinerary Details -->
                <div style="margin-bottom: 10px;">
                    <div class="section-header" style="border-radius: 6px 6px 0 0;">Itinerary Details :-</div>
                    <div style="overflow-x: auto;">
                        <table
                            style="width: 100%; border-collapse: collapse; font-size: 12px; background-color: #f8f9fa; margin-top: 10px;">
                            <thead>
                                <tr style="background-color: #deecfb; font-weight: 600;">
                                    <td style="padding: 5px 8px; width: 25%; border: 1px solid #e9ecef;">Date</td>
                                    <td style="padding: 5px 8px; width: 35%; border: 1px solid #e9ecef;">Port of Call
                                    </td>
                                    <td style="padding: 5px 8px; width: 20%; border: 1px solid #e9ecef;">Depart</td>
                                    <td style="padding: 5px 8px; width: 20%; border: 1px solid #e9ecef;">Arrive</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking->travelCruise as $key => $travelCruise)
                                <tr>
                                    <td style="padding:4px 8px; border: 1px solid #e9ecef;">
                                        <div style="font-weight: 500; color: #0f172a; font-size: 12px;">
                                            {{ date('D', strtotime($travelCruise->departure_date)) }},
                                            {{ date('d-m-Y', strtotime($travelCruise->departure_date)) }}
                                        </div>

                                    </td>
                                    <td
                                        style="padding: 4px 8px; border: 1px solid #e9ecef; color: #4a5568; font-size: 12px;">
                                        {{ $travelCruise->departure_port }}
                                    </td>
                                    <td
                                        style="padding: 4px 8px; border: 1px solid #e9ecef; color: #4a5568; font-size: 12px;">
                                        @if($travelCruise->departure_hrs)
                                        {{ date('h:i A', strtotime($travelCruise->departure_hrs)) }}
                                        @endif
                                    </td>
                                    <td
                                        style="padding: 4px 8px; border: 1px solid #e9ecef; color: #4a5568; font-size: 12px;">
                                        @if($travelCruise->arrival_hrs)
                                        {{ date('h:i A', strtotime($travelCruise->arrival_hrs)) }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                @if($travel_cruise_addon && count($travel_cruise_addon) > 0)
                <div>
                    <div
                        style="background-color: #f8f9fa; padding: 8px; font-weight: 600; color: #0f172a; font-size: 12px; border-radius: 4px;">
                        Add-on Services
                    </div>
                    @foreach($travel_cruise_addon as $addon)
                    <div style="padding: 8px; border-bottom: 1px solid #e9ecef;">
                        <div style="font-weight: 600; font-size: 12px; color: #0f172a; margin-bottom: 0px;">
                            {{ $addon->services }} :
                        </div>
                        <div style="font-size: 12px; color: #4a5568; line-height: 1.3;">{!! $addon->service_name !!}
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                @if($cruise_images)
                @foreach ($cruise_images as $key => $img)
                <div style="padding: 10px 0;">
                    <img src="{{ public_path($img->file_path) }}"
                        style="max-width: 100%; height: auto; border-radius: 4px;">
                </div>
                @endforeach
                @endif
            </div>
        </div>
        @endif

        <!-- Car Details -->
        @if(in_array('Car', $bookingTypes))
        <div class="section">
            <div class="section-header">Car Details :-</div>
            <div class="section-content">
                @foreach($booking->travelCar as $travelCar)
                <div style="margin-bottom: 15px;">
                    <div
                        style="font-size: 12px; font-weight: 600; color: #0f172a; padding-bottom: 0px; border-bottom: 1px solid #e0e0e0;">
                        Pick-up and Drop-off
                    </div>
                    <div style="padding-top: 10px;">
                        <table width="100%"
                            style="font-size: 12px; border-collapse: collapse; border: 1px solid #e9ecef;">
                            @if($travelCar->car_rental_provider)
                            <tr>
                                <td width="40%"
                                    style="font-weight: 500; color: #0f172a; padding: 4px 8px; border: 1px solid #e9ecef;">
                                    Car Rental Provider :
                                </td>
                                <td width="60%" style="color: #0f172a; padding: 4px 8px; border: 1px solid #e9ecef;">
                                    {{ $travelCar->car_rental_provider }}
                                </td>
                            </tr>
                            @endif

                            @if($travelCar->car_type)
                            <tr>
                                <td
                                    style="font-weight: 500; color: #0f172a; padding: 4px 8px; border: 1px solid #e9ecef;">
                                    Car Type :
                                </td>
                                <td style="color: #0f172a; padding: 4px 8px; border: 1px solid #e9ecef;">
                                    {{ $travelCar->car_type }}
                                </td>
                            </tr>
                            @endif

                            @if($travelCar->confirmation_number)
                            <tr>
                                <td
                                    style="font-weight: 500; color: #0f172a; padding: 4px 8px; border: 1px solid #e9ecef;">
                                    Confirmation Number :
                                </td>
                                <td style="color: #0f172a; padding: 4px 8px; border: 1px solid #e9ecef;">
                                    {{ $travelCar->confirmation_number }}
                                </td>
                            </tr>
                            @endif
                        </table>


                        <!-- Pickup & Drop-off -->
                        <div
                            style="background-color: #f8f9fa; padding: 10px; margin: 10px 0; font-size: 12px; border-radius: 4px;">
                            <div style="color: #1a202c;">
                                <span style="font-weight: 600;">Pickup :</span>
                                {{ $travelCar->pickup_date?->format('D, M j') }} - {{ $travelCar->pickup_time }} ,
                                <span style="font-weight: 500;">{{ $travelCar->pickup_location }}</span>
                            </div>
                            <div style="color: #1a202c; padding-top: 5px;">
                                <span style="font-weight: 600;">Drop-off :</span>
                                {{ $travelCar->dropoff_date?->format('D, M j') }} - {{ $travelCar->dropoff_time }} ,
                                <span style="font-weight: 500;">{{ $travelCar->dropoff_location }}</span>
                            </div>
                        </div>

                        @if($travelCar->rental_provider_address)
                        <table width="100%" style="font-size: 12px;">
                            <tr>
                                <td style="font-weight: 500; color: #0f172a; padding: 5px 0;">Rental Provider Address
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #4a5568;">{{ $travelCar->rental_provider_address }}</td>
                            </tr>
                        </table>
                        @endif
                    </div>
                </div>
                @if(!$loop->last)
                <div style="width: 90%; margin: 10px auto; border-top: 1px dashed #cbd5e0; opacity: 0.9;"></div>
                @endif
                @endforeach

                <div style="font-size: 12px; line-height: 1.6; color: #555;">
                    {!! $booking->car_description !!}
                </div>

                @if($car_images)
                @foreach ($car_images as $img)
                <div style="padding: 15px 0;">
                    <img src="{{ public_path($img->file_path) }}"
                        style="max-width: 100%; height: auto; border-radius: 6px;">
                </div>
                @endforeach
                @endif
            </div>
        </div>
        @endif

        <!-- Train Details -->
        @if(in_array('Train', $bookingTypes))
        <div class="section">
            <div class="section-header">Train Details :-</div>
            <div class="section-content">
                @foreach($booking->trainBookingDetails as $key => $trainBookingDetails)
                <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #e9ecef;">
                    <!-- Route Codes -->
                    <div
                        style="background:#f8f9fa; color:#0f172a; padding:8px; font-size:12px; font-weight:600; text-align: center; border-radius: 4px; margin-bottom: 10px;">
                        {{$trainBookingDetails->departure_station}} &nbsp;→&nbsp;
                        {{$trainBookingDetails->arrival_station}}
                    </div>

                    <div style="font-size:12px; color:#0f172a; ">
                        <strong style="font-weight: 500; color:#4a5568;">Departure:</strong>
                        <span
                            style="color:#4a5568;">{{ $trainBookingDetails->departure_date ? $trainBookingDetails->departure_date->format('D, M d, Y') : '' }}</span>
                        |
                        <strong style="font-weight: 500; color:#4a5568;">Arrival:</strong>
                        <span
                            style="color:#4a5568;">{{ $trainBookingDetails->arrival_date ? $trainBookingDetails->arrival_date->format('D, M d, Y') : '' }}</span>
                    </div>

                    <div style="font-size:12px; color:#4a5568; line-height:1.6; padding-bottom: 10px;">
                        <strong style="font-weight: 500;">Direction</strong>:
                        <span>{{$trainBookingDetails->departure_station}}</span>
                        |
                        <span><strong style="font-weight: 500;">Cabin</strong>: {{$trainBookingDetails->cabin}}</span> |
                        <strong style="font-weight: 500;">Train Ref</strong>: {{$booking->train_ref}}
                    </div>

                    <!-- Train + Times -->
                    <div
                        style="padding: 20px 0; font-size: 12px; color: #4a5568; background-color: #f8f9fa; border-radius: 4px;">
                        <table width="100%">
                            <tr>
                                <!-- Train Number -->
                                <td width="25%" style="text-align: center; vertical-align: middle;">
                                    <!-- <div style="font-size: 24px;">🚆</div> -->
                                    <div style="font-size: 16px; font-weight: bold; color: #0f172a;">Train No</div>
                                    <div style="font-size: 11px;">{{ $trainBookingDetails->train_number }}</div>
                                </td>
                                <!-- Departure Time -->
                                <td width="25%" style="text-align: center;">
                                    <div style="font-size: 16px; font-weight: bold; color: #0f172a;">
                                        {{ date('h:i A', strtotime($trainBookingDetails->departure_hours)) }}
                                    </div>
                                    <div style="font-size: 11px; color: #718096;">Depart</div>
                                </td>
                                <!-- Duration -->
                                <td width="25%" style="text-align: center;">
                                    <div style="font-size: 16px; color: #0f172a;">→</div>
                                    <div style="font-size: 11px; color: #718096;">{{ $trainBookingDetails->transit }}
                                    </div>
                                </td>
                                <!-- Arrival Time -->
                                <td width="25%" style="text-align: center;">
                                    <div style="font-size: 16px; font-weight: bold; color: #0f172a;">
                                        {{ date('h:i A', strtotime($trainBookingDetails->arrival_hours)) }}
                                    </div>
                                    <div style="font-size: 11px; color: #718096;">Arrives</div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Seat Info -->
                    <div
                        style="background: #f8f9fa; padding: 10px; font-size: 12px; color: #0f172a; margin-top: 10px; border-radius: 4px;">
                        <div style="line-height: 1.6;">{!! $booking->train_description !!}</div>
                    </div>
                </div>
                @endforeach

                @if($train_images)
                @foreach ($train_images as $key => $img)
                <div style="padding: 10px 0;">
                    <img src="{{ public_path($img->file_path) }}"
                        style="max-width: 100%; height: auto; border-radius: 4px;">
                </div>
                @endforeach
                @endif
            </div>
        </div>
        @endif

        <!-- Contact Information -->
        <div class="section">
            <div class="section-header">Customer Information :-</div>
            <div style="padding: 12px;  border-radius: 4px; background-color: #ffffff;">
                <table width="100%" style="font-size: 12px; border-collapse: collapse; border: 1px solid #e9ecef;">
                    @if($billingPricingData->cc_holder_name)
                    <tr>
                        <td width="40%"
                            style="font-weight: 500; color: #0f172a; padding: 4px 8px; border: 1px solid #e9ecef;">
                            Card Holder Name
                        </td>
                        <td width="60%" style="color: #4a5568; padding: 4px 8px; border: 1px solid #e9ecef;">
                            {{ $billingPricingData->cc_holder_name }}
                        </td>
                    </tr>
                    @endif

                    @if($billingPricingData->cc_number)
                    <tr>
                        <td style="font-weight: 500; color: #0f172a; padding: 4px 8px; border: 1px solid #e9ecef;">
                            Card Number
                        </td>
                        <td style="color: #4a5568; padding: 4px 8px; border: 1px solid #e9ecef;">
                            {{ str_repeat('*', strlen($billingPricingData->cc_number) - 4) . substr($billingPricingData->cc_number, -4) }}
                        </td>
                    </tr>
                    @endif

                    @if($billingPricingData->card_type)
                    <tr>
                        <td style="font-weight: 500; color: #0f172a; padding: 4px 8px; border: 1px solid #e9ecef;">
                            Card Type
                        </td>
                        <td style="color: #4a5568; padding: 4px 8px; border: 1px solid #e9ecef;">
                            {{ $billingPricingData->card_type }}
                        </td>
                    </tr>
                    @endif

                    @if($billingPricingData->email)
                    <tr>
                        <td style="font-weight: 500; color: #0f172a; padding: 4px 8px; border: 1px solid #e9ecef;">
                            Email
                        </td>
                        <td style="color: #4a5568; padding: 4px 8px; border: 1px solid #e9ecef;">
                            {{ $billingPricingData->email }}
                        </td>
                    </tr>
                    @endif

                    <tr>
                        <td style="font-weight: 500; color: #0f172a; padding: 4px 8px; border: 1px solid #e9ecef;">
                            Booking Date
                        </td>
                        <td style="color: #4a5568; padding: 4px 8px; border: 1px solid #e9ecef;">
                            {{ $booking->created_at->format('l, M d, Y') }}
                        </td>
                    </tr>

                    @if($booking->airlinepnr)
                    <tr>
                        <td style="font-weight: 500; color: #0f172a; padding: 4px 8px; border: 1px solid #e9ecef;">
                            Airline Ref
                        </td>
                        <td style="color: #4a5568; padding: 4px 8px; border: 1px solid #e9ecef;">
                            {{ $booking->airlinepnr }}
                        </td>
                    </tr>
                    @endif

                    @if($booking->cruise_ref)
                    <tr>
                        <td style="font-weight: 500; color: #0f172a; padding: 4px 8px; border: 1px solid #e9ecef;">
                            Cruise Ref
                        </td>
                        <td style="color: #4a5568; padding: 4px 8px; border: 1px solid #e9ecef;">
                            {{ $booking->cruise_ref }}
                        </td>
                    </tr>
                    @endif

                    @if($booking->car_ref)
                    <tr>
                        <td style="font-weight: 500; color: #0f172a; padding: 4px 8px; border: 1px solid #e9ecef;">
                            Car Ref
                        </td>
                        <td style="color: #4a5568; padding: 4px 8px; border: 1px solid #e9ecef;">
                            {{ $booking->car_ref }}
                        </td>
                    </tr>
                    @endif

                    @if($booking->train_ref)
                    <tr>
                        <td style="font-weight: 500; color: #0f172a; padding: 4px 8px; border: 1px solid #e9ecef;">
                            Train Ref
                        </td>
                        <td style="color: #4a5568; padding: 4px 8px; border: 1px solid #e9ecef;">
                            {{ $booking->train_ref }}
                        </td>
                    </tr>
                    @endif
                </table>
            </div>

        </div>

        <!-- Passenger Details -->
        <div class="section">
            <div class="section-header">Passenger Details :-</div>
            <div style="padding: 8px 5px;">
                <table width="100%" style="font-size: 12px; border-collapse: collapse; border: 1px solid #e9ecef;">
                    <thead>
                        <tr style="background-color: #deecfb; font-weight: 600; color: #0f172a;">
                            <th width="20%" style="padding: 5px 8px; border: 1px solid #e9ecef; text-align: left;">Type
                            </th>
                            <th width="40%" style="padding: 5px 8px; border: 1px solid #e9ecef; text-align: left;">
                                Passenger Name</th>
                            @if($booking->passengers->whereNotNull('seat_number')->count() > 0)
                            <th width="20%" style="padding: 5px 8px; border: 1px solid #e9ecef; text-align: left;">Seat
                            </th>
                            @endif
                            @if($booking->passengers->whereNotNull('e_ticket_number')->count() > 0)
                            <th width="20%" style="padding: 5px 8px; border: 1px solid #e9ecef; text-align: left;">
                                E-Ticket</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($booking->passengers as $key => $passengers)
                        <tr>
                            <td style="padding: 5px 8px; border: 1px solid #e9ecef; color: #4a5568;">
                                {{ $passengers->passenger_type }}
                            </td>
                            <td style="padding: 5px 8px; border: 1px solid #e9ecef; color: #4a5568;">
                                {{ $passengers->title }} {{ $passengers->first_name }} {{ $passengers->middle_name }}
                                {{ $passengers->last_name }}
                            </td>
                            @if($booking->passengers->whereNotNull('seat_number')->count() > 0)
                            <td style="padding: 5px 8px; border: 1px solid #e9ecef; color: #4a5568;">
                                {{ $passengers->seat_number }}
                            </td>
                            @endif
                            @if($booking->passengers->whereNotNull('e_ticket_number')->count() > 0)
                            <td style="padding: 5px 8px; border: 1px solid #e9ecef; color: #4a5568;">
                                {{ $passengers->e_ticket_number }}
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <!-- Price Details -->
        <div class="section" style="margin: 0; padding: 0;">
            <div class="section-header" style="margin: 0; padding: 8px 12px; font-size: 14px; font-weight: 600;">
                Price Details (USD) :-
            </div>

            <!-- Reduced padding here to fix space below header -->
            <div style="padding: 10px 12px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, Arial, sans-serif;">

                @php
                $mergedPrices = [];
                foreach ($booking->pricingDetails as $pricingDetails) {
                if ($pricingDetails->passenger_type) {
                if (!isset($mergedPrices[$pricingDetails->passenger_type])) {
                $mergedPrices[$pricingDetails->passenger_type] = 0;
                }
                $mergedPrices[$pricingDetails->passenger_type] += $pricingDetails->gross_price;
                }
                }
                @endphp

                @if(
                $booking->query_type == 26 || $booking->query_type == 27 || $booking->query_type == 49 ||
                $booking->query_type == 2 || $booking->query_type == 38 || $booking->query_type == 30 ||
                $booking->query_type == 46
                )
                @foreach($booking->pricingDetails as $ExcursionPrice)
                <div class="price-row" style="padding: 6px 0; border-bottom: 1px solid #e9ecef;">
                    <div style="width: 70%; float: left; font-size: 12px; color: #0f172a; font-weight: 500;">
                        {{ $ExcursionPrice->details }} (per person) :
                    </div>
                    <div style="width: 30%; float: right; font-size: 12px; color: #0f9b0f; text-align: right;">
                        ${{ $ExcursionPrice->gross_price }}
                    </div>
                    <div style="clear: both;"></div>
                </div>
                @endforeach
                @else
                @foreach($mergedPrices as $passengerType => $totalPrice)
                <div class="price-row" style="padding: 6px 0; border-bottom: 1px solid #e9ecef;">
                    <div style="width: 70%; float: left; font-size: 12px; color: #0f172a; font-weight: 500;">
                        Total Price per person including taxes and fees. ({{ ucfirst($passengerType) }})
                    </div>
                    <div style="width: 30%; float: right; font-size: 12px; color: #0f9b0f; text-align: right;">
                        ${{ number_format($totalPrice, 2) }}
                    </div>
                    <div style="clear: both;"></div>
                </div>
                @endforeach
                @endif

                <div class="total-row" style="padding: 8px 0; font-weight: 600; border-top: 2px solid #e9ecef;">
                    <div style="width: 70%; float: left; font-size: 12px; color: #0f172a;">
                        Total Amount including taxes & Fees.
                    </div>
                    <div style="width: 30%; float: right; font-size: 12px; color: #0f9b0f; text-align: right;">
                        ${{ number_format($booking->gross_value, 2) }}
                    </div>
                    <div style="clear: both;"></div>
                </div>


                <div
                    style="background-color: #f8f9fa; border-radius: 4px; margin-top: 12px; padding: 10px; font-size: 12px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, Arial, sans-serif; color: #4a5568; line-height: 1.5;">
                    <ul style="margin: 0; padding-left: 15px; list-style-type: disc;">
                        <li>
                            <strong>All transactions</strong> will be processed in US Dollars (USD). If your card was
                            issued in a country other than the USA, your card issuer may charge a currency conversion
                            fee of up to 4% of the total amount charged. Kindly check with your financial institution
                            for more information.
                        </li>
                        <li>
                            <strong>Prices are not guaranteed</strong> until the ticket number(s) are issued. Prices may
                            change based on airline inventory availability.
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <!-- Disclaimer -->
        <div class="section" style="margin: 0; padding: 0;">
            <div class="section-header" style="margin: 0; padding: 8px 12px; font-size: 14px; font-weight: 600;">
                Disclaimer :-
            </div>


            <div style="padding: 10px 12px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, Arial, sans-serif;">
                <div style="font-size: 12px; color: #4a5568; line-height: 1.6;">

                    <p style="margin: 0 0 10px;">
                        I, <strong>{{ $billingPricingData->cc_holder_name }}</strong>, hereby acknowledge receipt of
                        this
                        communication outlining the associated charges. I have thoroughly reviewed and confirmed the
                        accuracy of the itinerary, including all passenger names, flight schedules, dates, and times.
                    </p>

                    <p style="margin: 0 0 10px;">
                        I acknowledge and accept that the total cost of the booking is
                        <strong>USD {{ number_format($booking->gross_value, 2) }}</strong>, which will be processed
                        through
                        <strong>single or multiple transactions</strong>. I understand that, regardless of the number of
                        transactions, the <strong>total amount charged will not exceed
                            USD {{ number_format($booking->gross_value, 2) }}</strong>.
                    </p>

                    <p style="margin: 0 0 10px;">
                        I further acknowledge that the charges may appear on my credit card statements under one or more
                        of the following descriptors:<br>
                        {{ $booking->descriptor }} <strong>{{ $booking->selected_company_name }}</strong>.
                    </p>

                    <p style="margin: 0 0 10px;">
                        By this statement, I hereby authorize
                        <strong>{{ $booking->selected_company_name }}</strong> and its affiliated service providers to
                        charge the following amounts to my cards for the related travel services:
                    </p>

                    <ul
                        style="margin: 8px 0 12px 20px; padding: 0; list-style-type: disc; font-size: 12px; color: #4a5568;">
                        @foreach($billingPricingDataAll as $billing)
                        <li style="margin-bottom: 6px;">
                            <strong>USD {{ number_format($billing->authorized_amt, 2) }}</strong> to my
                            <strong>{{ $billing->card_type }} ending in
                                ****{{ substr($billing->cc_number, -4) }}</strong>
                        </li>
                        @endforeach
                    </ul>

                    <p style="margin: 0;">
                        I confirm that I am the authorized cardholder for the above payment methods and consent to the
                        processing of these charges as outlined.
                    </p>

                </div>
            </div>
        </div>



        <!-- Terms and Conditions Agreement -->
        <div class="section" style="margin: 15px 0 0 0; padding: 0;">
            <div style="padding: 12px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, Arial, sans-serif; border: 1px solid #e9ecef; border-radius: 8px; background-color: #f8f9fa;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 20px; vertical-align: top; padding-right: 8px;">
                            @{{Checkbox}}
                        </td>
                        <td style="font-size: 12px; color: #374151; line-height: 1.5;">
                          <a href="{{ route('terms.nonrefundable', ['refundStatus' => 'nonrefundable', 'booking_id' => $booking->id]) }}" 
                                target="_blank" 
                                style="color: #1a56db; text-decoration: none;">
                                I have read and agree to the Terms and Conditions
                                </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Signature Section -->
        <div class="section" style="margin: 20px 0 0 0; padding: 0;">
            <div style="padding: 12px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, Arial, sans-serif;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 60%; height:100px; vertical-align: bottom; padding-bottom: 5px;">
                        </td>
                        
                        <td style="width: 60%; text-align: right; font-size: 32px; color: #374151; font-weight: 500; vertical-align: bottom; padding-bottom: 5px; padding-left: 20px;">
                               @{{S}}
                        </td>
                          <td style="width: 40%; text-align: right; font-size: 18px; color: #374151; font-weight: 500; vertical-align: bottom; padding-bottom: 5px; padding-left: 20px;">
                            Signature
                        </td>    

                    </tr>
                </table>
            </div>
        </div>


        <!-- Footer -->
        <div style="background-color: #ffffff; padding: 0;">
            <div style="background: #1c316d; padding: 15px; text-align: center; border-radius: 4px;">
                <!-- Social Icons -->
                <div style="margin-bottom: 10px; display: inline-block;">
                    <img width="18" height="18" src="{{ public_path('email-templates/instagram.png') }}" alt="instagram"
                        style="display: inline-block; margin: 0 7px;">
                    <img width="18" height="18" src="{{ public_path('email-templates/twitter.png') }}" alt="twitter"
                        style="display: inline-block; margin: 0 7px;">
                </div>
                <!-- Footer Text -->
                <div style="font-size: 11px; font-weight: 400; color: #e2e8f0; text-align: center;">
                    © {{ date('Y') }} All Rights Reserved.
                </div>
            </div>
        </div>
    </div>
</body>
</html>