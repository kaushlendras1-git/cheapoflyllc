<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Authorization</title>



</head>

@php
$bookingTypes = $booking->bookingTypes->pluck('type')->toArray();
@endphp

<body style="margin: 0px; padding: 0px; background-color: #f8fafc; font-family: 'Segoe UI', Tahoma, Geneva, Verdana,Arial, sans-serif;-webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;">
    <table
        style="width: 700px; max-width: 800px; background-color: #ffffff; margin: 0px auto;   border-radius: 6px;  overflow: hidden;">
        <thead>
            <tr>
                <td colspan="2" style="background-color: #ffffff; padding: 0 10px;">
                    <!-- Inner box with background -->
                    <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="">
                        <tr>
                            <td style="
           background: linear-gradient(135deg, #1C316D, #3A4CA4);
            padding: 10px;
            color: #ffffff;
            font-size: 18px;
            font-weight: 600;
          
          ">
                                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="">
                                    <tr>
                                        <!-- Left Content -->
                                        <td
                                            style="text-align: left; font-size: 16px; font-weight: 600; color: #ffffff;">
                                            Speak to a Travel Expert
                                        </td>

                                        <!-- Right Content -->
                                        <td style="text-align: right;">
                                            <table cellpadding="0" cellspacing="0" role="presentation"
                                                style=" display: inline-block;">
                                                <tr>
                                                    <td style="padding-right: 10px;">
                                                        <img width="16"
                                                            style="display: block; filter: brightness(0) invert(1);"
                                                            src="{{ asset('email-templates/call.png') }}" alt="call">
                                                    </td>
                                                    <td>
                                                        <a href="tel:+1-844-362-2566"
                                                            style="font-size: 16px; font-weight: 600; color: #ffffff; text-decoration: none;">
                                                            +1-844-362-2566
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>


        </thead>
        <tbody>
            <tr>
                <td colspan="2" style="background-color: #ffffff; padding: 0 10px;">
                    <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="">
                        <tr>
                            <td style="padding: 0;">
                                @if($bookingTypes[0] == 'Flight')
                                <img style="height: 250px; width: 100%; object-fit: cover; display: block;     object-position: top right; margin-top: -2px;"
                                    src="{{ asset('email-templates/flight_banner.png') }}" alt="flight">
                                @elseif($bookingTypes[0] == 'Cruise')
                                <img style="height: 250px; width: 100%; object-fit: cover; display: block;      object-position: top right;"
                                    src="{{ asset('email-templates/cruise_banner.png') }}" alt="cruise">
                                @elseif($bookingTypes[0] == 'Train')
                                <img style="height: 250px; width: 100%; object-fit: cover; display: block;     object-position: top right; "
                                    src="{{ asset('email-templates/train_banner.png') }}" alt="amtrak">
                                @elseif($bookingTypes[0] == 'Car')
                                <img style="height: 250px; width: 100%; object-fit: cover; display: block;      object-position: top right;"
                                    src="{{ asset('email-templates/car_banner.png') }}" alt="car">
                                @elseif($bookingTypes[0] == 'Hotel')
                                <img style="height: 250px; width: 100%; object-fit: cover; display: block;      object-position: top right;"
                                    src="{{ asset('email-templates/hotel_banner.png') }}" alt="hotel">
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>


            <tr>
                <td colspan="2" style="font-size: .875rem; font-weight: 600; padding: 5px 10px; color: #0f172a;">
                    Dear {{ $booking->name }},</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: .875rem; line-height: 1.3; color: #4a5568; padding: 0px 10px">
                    Thank you for using {{ $booking->selected_company_name }} for your travel needs. Please take a
                    moment to review the names, date, itinerary, price and other relevant details of your booking.
                </td>
            </tr>
            <!-- Success Message -->
            <tr>
                <td colspan="2">
                    <div class="container">
                        <div>
                            {{-- Success message --}}
                            @if(session('success'))
                            <div
                                style="background-color: #d4edda; color: #155724; padding: 12px 15px; border-radius: 6px; margin: 0 30px 20px 30px; border-left: 4px solid #28a745;">
                                ✅ Thank you for your authorization! Your signature has been successfully recorded.
                            </div>
                            @endif

                            {{-- Validation errors (all in a list) --}}
                            @if($errors->any())
                            <div
                                style="background-color: #f8d7da; color: #721c24; padding: 12px 15px; border-radius: 6px; margin: 0 30px 20px 30px; border-left: 4px solid #dc3545;">
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            <!--  Order Reference Number -->
            <tr>
                <td style="padding: 0px 10px; width: 50%;">
                    <div
                        style="background-color: #f8f9fa; padding: 20px; border-radius: 6px;  margin-top: 10px; border: 1px solid #e9ecef; display: flex; align-items: center;">

                        <!-- Icon -->
                        <div style="flex-shrink: 0; margin-right: 15px;">
                            <img width="32" height="32" src="{{ asset('email-templates/ordered-records.png') }}"
                                alt="Number" style="display: block;">
                        </div>

                        <!-- Content -->
                        <div style="text-align: left;">
                            <div style="font-size: .875rem; font-weight: 600; color: #0f172a; margin-bottom: 4px;">
                                Order Reference Number
                            </div>
                            <div style="font-size: .875rem; color: #4a5568; font-weight: 400;">
                                {{ $booking->pnr }}
                            </div>
                        </div>
                    </div>
                </td>

                <td style="padding: 0px 10px; width: 50%;">
                    <div
                        style="background-color: #f8f9fa; padding: 20px; border-radius: 6px;  margin-top: 10px; border: 1px solid #e9ecef; display: flex; align-items: center;">

                        <!-- Icon -->
                        <div style="flex-shrink: 0; margin-right: 15px;">
                            <img width="32" height="32" src="{{ asset('email-templates/calendar.png') }}" alt="Date"
                                style="display: block;">
                        </div>

                        <!-- Content -->
                        <div style="text-align: left;">
                            <div style="font-size: .875rem; font-weight: 600; color: #0f172a; margin-bottom: 4px;">
                                Order Date
                            </div>
                            <div style="font-size: .875rem; color: #4a5568; font-weight: 400;">
                                {{ $booking->created_at->format('l, M d, Y') }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>



            <!-------------Flight --------------->
            @if(in_array('Flight', $bookingTypes))
            <tr>
                <td colspan="2" style="padding: 5px 10px;">
                    <div style="width:100%; border-radius: 6px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style="  padding:8px 5px;
    color: #fff;  font-size: 1rem;  font-weight:500;   background-color: #274481; border-bottom:1px solid #e9ecef;">
                            Flight Details :-
                        </div>
                        <div style="padding: 10px;">
                            @if($booking->travelFlight->isNotEmpty())
                            @foreach($booking->travelFlight as $index => $flight)
                            <div style="display: flex; align-items: flex-start;  padding-bottom: 0px; flex-wrap: wrap;">
                                <div style="flex-shrink: 0; width: 50px; height: 50px; margin-right: 10px;">
                                    @php
                                    $airline = \App\Models\Airline::where('airline_code',
                                    $flight->airline_code)->first();
                                    $logoPath = $airline && $airline->logo ? asset($airline->logo) :
                                    asset('email-templates/default-airline.png');
                                    @endphp
                                    <img src="{{ $logoPath }}" alt="airline logo"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="flex: 1; min-width: 280px; padding-bottom:10px;">
                                    <div
                                        style="font-size: .875rem; font-weight: 600; color: #0f172a; margin-bottom: 0px;">
                                        {{ $flight->departure_date?->format('D, M j') }} - {{$flight->airline_code}}
                                        {{$flight->flight_number}} - {{$flight->duration}}
                                    </div>
                                    <div style="font-size: .875rem; color: #4a5568; margin-bottom: 0px;">
                                        <span style="display: inline-block; margin-right: 15px; font-size: .875rem;">
                                            <strong
                                                style="font-weight: 600; color: #0f172a; font-size: .875rem;">Departing:</strong>
                                            {{ date('h:i A', strtotime($flight->departure_hours)) }} from
                                            {{$flight->departure_airport}}
                                        </span>
                                    </div>
                                    <div style="font-size: .875rem; color: #4a5568;">
                                        <span style="display: inline-block; font-size: .875rem;">
                                            <strong
                                                style="font-weight: 600; color: #0f172a; font-size: .875rem;">Arriving:</strong>
                                            {{ date('h:i A', strtotime($flight->arrival_hours)) }} into
                                            {{$flight->arrival_airport}}
                                        </span>
                                    </div>

                                    @if($flight->transit && $flight->transit != '00:00')
                                    <div style="color: #718096; font-size:.875rem; margin-top:0px; padding: 8px 0;">
                                        <div>-------- Transit Time: {{$flight->transit }} --------</div>
                                    </div>
                                    @endif


                                </div>
                                <!-- ✅ Centered & styled inline <hr> -->
                                <hr style="
                            width: 90%;
                         
                            border: none;
                            border-top: 1px dashed #cbd5e0;
                            opacity: 0.9;
                        ">
                            </div>
                            @endforeach
                            @endif

                            @if($flight_images)
                            @foreach ($flight_images as $key => $img)
                            <div style="padding-top: 10px;">
                                <img src="{{ asset($img->file_path) }}"
                                    style="max-width: 100%; height: auto; border-radius: 6px;">
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            @endif


            @if(in_array('Hotel', $bookingTypes))
            @if($booking->travelHotel->isNotEmpty())


            <!-- Start Hotel Details -->
            <tr>
                <td colspan="2" style="padding: 5px 10px;">
                    <div style="width:100%; border-radius: 6px;  overflow: hidden; border: 1px solid #e9ecef;">
                        <div style=" padding:8px 5px;
    color: #fff;  font-size: 1rem;  font-weight:500;   background-color: #274481; border-bottom:1px solid #e9ecef;">
                            Hotel Details :-
                        </div>
                        <div style="padding: 10px;">
                            <!-- Hotel Image -->
                            <div style="padding:0; margin-bottom: 10px;">
                                <img src="{{asset('email-templates/bedroom.jpg')}}" alt="Hotel"
                                    style="width:100%; height:200px; border-radius: 6px;  object-fit: cover;">
                            </div>

                            <!-- Booking Info Row -->
                            <div
                                style="background:#f8f9fa; padding:10px 20px; text-align:center;  border-radius: 6px;  #e9ecef; margin-bottom: 20px;">
                                @foreach($booking->travelHotel as $key=>$travelHotel)
                                <div
                                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px; text-align: left;">
                                    <div>
                                        <div
                                            style="font-size: .875rem; color:#0f172a; font-weight:500; margin-bottom: 0px;">
                                            Hotel Name</div>
                                        <div style="font-weight:normal; color: #4a5568; font-size: .875rem;">
                                            {{$travelHotel->hotel_name}}
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            style="font-size: .875rem; color:#0f172a; font-weight:500; margin-bottom: 0px;">
                                            Room Category</div>
                                        <div style="font-weight:normal; color: #4a5568; font-size: .875rem;">
                                            {{$travelHotel->room_category}}
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            style="font-size: .875rem; color:#0f172a; font-weight:500; margin-bottom: 0px;">
                                            Confirmation Number</div>
                                        <div style="font-weight:normal; color: #4a5568; font-size: .875rem;">
                                            {{$travelHotel->confirmation_number}}</div>
                                    </div>
                                    <div>
                                        <div
                                            style="font-size: .875rem; color:#0f172a; font-weight:500; margin-bottom: 0px;">
                                            Hotel Address</div>
                                        <div style="font-weight:normal; color: #4a5568; font-size: .875rem;">
                                            {{$travelHotel->hotel_address}}
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            style="font-size: .875rem; color:#0f172a; font-weight:500; margin-bottom: 0px;">
                                            Check-In</div>
                                        <div style="font-weight:normal; color: #4a5568; font-size: .875rem;">
                                            {{ $travelHotel->checkin_date ? $travelHotel->checkin_date->format('l, F d, Y') : '' }}
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            style="font-size: .875rem; color:#0f172a; font-weight:500; margin-bottom: 0px;">
                                            Check-Out</div>
                                        <div style="font-weight:normal; color: #4a5568; font-size: .875rem;">
                                            {{ $travelHotel->checkout_date ? $travelHotel->checkout_date->format('l, F d, Y') : '' }}
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            style="font-size: .875rem; color:#0f172a; font-weight:500; margin-bottom: 0px;">
                                            Rooms</div>
                                        <div style="font-weight:normal; color: #4a5568; font-size: .875rem;">
                                            {{$travelHotel->no_of_rooms}}
                                        </div>
                                    </div>
                                </div>
                                <hr style="
                            width: 90%;
                         
                            border: none;
                            border-top: 1px dashed #cbd5e0;
                            opacity: 0.9;
                        ">

                                @endforeach
                            </div>

                            <div style="padding:0px; padding-left: 0; color:#4a5568;">
                                <div style="white-space: pre-line; font-size:.875rem; line-height: 1.3;">{!!
                                    $booking->hotel_description !!}</div>
                            </div>


                            @if($hotel_images)
                            @foreach ($hotel_images as $key => $img)
                            <div style="padding: 10px 0;">
                                <img src="{{ asset($img->file_path) }}"
                                    style="max-width: 100%; height: auto; border-radius: 6px;">
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            @endif
            @endif



            @if(in_array('Cruise', $bookingTypes))


            <tr>
                <td colspan="2" style="padding: 0px 10px;">
                    <div style="width:100%; border-radius: 6px;  overflow: hidden; border: 1px solid #e9ecef;">
                        <div style="padding:8px 5px;
    color: #fff;  font-size: 1rem;  font-weight:500;   background-color: #274481; border-bottom:1px solid #e9ecef;">
                            Cruise Details :-
                        </div>
                        <div style="padding: 5px">
                            <div
                                style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 00px; border-radius: 6px; ">
                                <div style="flex: 1; min-width: 300px;    margin-bottom: -10px;border-radius: 6px;  ">
                                    <div
                                        style="     font-size: .875rem; font-weight:500; color:#0f172a; padding:5px; background-color: #f8f9fa; border-bottom:1px solid #e9ecef;">
                                        <div style="display: flex; justify-content: space-between;">
                                            <span>Cruise Line - {{ $travel_cruise_data->cruise_line ?? '' }}</span>
                                            <span>Name of Ship - {{ $travel_cruise_data->ship_name ?? '' }}</span>
                                        </div>

                                    </div>

                                    <div
                                        style="background:#f8f9fa;  padding:5px; text-align:center; border-top:1px solid #e9ecef; border-bottom:1px solid #e9ecef; margin-bottom: 20px;">
                                        @foreach([$travel_cruise_data] as $cruise)
                                        <div
                                            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px; text-align: left;">



                                            <div>
                                                <div
                                                    style="font-size: .875rem; color:#0f172a; font-weight:500; margin-bottom: 0px;">
                                                    Length</div>
                                                <div style="font-weight:normal; color: #4a5568; font-size: .875rem;">
                                                    {{ $cruise->length }}
                                                </div>
                                            </div>

                                            <div>
                                                <div
                                                    style="font-size: .875rem; color:#0f172a; font-weight:500; margin-bottom: 0px;">
                                                    Departure Port</div>
                                                <div style="font-weight:normal; color: #4a5568; font-size: .875rem;">
                                                    {{ $cruise->departure_port }}</div>
                                            </div>

                                            <div>
                                                <div
                                                    style="font-size: .875rem; color:#0f172a; font-weight:500; margin-bottom: 0px;">
                                                    Arrival Port</div>
                                                <div style="font-weight:normal; color: #4a5568; font-size: .875rem;">
                                                    {{ $cruise->arrival_port }}</div>
                                            </div>


                                            <div>
                                                <div
                                                    style="font-size: .875rem; color:#0f172a; font-weight:500; margin-bottom: 0px;">
                                                    Category</div>
                                                <div style="font-weight:normal; color: #4a5568; font-size: .875rem;">
                                                    {{ $cruise->category }}
                                                </div>
                                            </div>

                                            <div>
                                                <div
                                                    style="font-size: .875rem; color:#0f172a; font-weight:500; margin-bottom: 0px;">
                                                    Stateroom</div>
                                                <div style="font-weight:normal; color: #4a5568; font-size: .875rem;">
                                                    {{ $cruise->stateroom }}</div>
                                            </div>

                                        </div>

                                        @endforeach
                                    </div>

                                </div>
                            </div>

                            <div style="margin-bottom: 0px;">
                                <div
                                    style="padding:8px 5px;
    color: #fff;  font-size: 1rem;  font-weight:500;   background-color: #274481; border-bottom:1px solid #e9ecef; border-radius: 6px; ">
                                    Itinerary Details :-</div>
                                <div style="overflow-x: auto;  margin-top: 10px; border-radius: 6px; ">
                                    <table
                                        style=" width: 100%; font-size: .875rem; text-align:left; background-color: #f8f9fa; border-radius: 6px; ">
                                        <thead>
                                            <tr
                                                style="background-color: #deecfb; font-size: .875rem; font-weight:500; margin-top: 20px;">
                                                <td style="padding:5px; width:25%; border: 1px solid #e9ecef;">Date
                                                </td>
                                                <td style="padding:5px; width:35%; border: 1px solid #e9ecef;">Port
                                                    of Call</td>
                                                <td style="padding:5px; width:20%; border: 1px solid #e9ecef;">
                                                    Depart</td>
                                                <td style="padding:5px; width:20%; border: 1px solid #e9ecef;">
                                                    Arrive</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($booking->travelCruise as $key=>$travelCruise)
                                            <tr>
                                                <td style="padding:5px; border: 1px solid #e9ecef;">
                                                    <div style="font-weight: 400; color: #0f172a; font-size: .875rem;">
                                                        {{ date('l', strtotime($travelCruise->departure_date)) }}</div>
                                                    <div style="color: #4a5568; font-size: .875rem;">
                                                        {{ date('d-m-Y', strtotime($travelCruise->departure_date)) }}
                                                    </div>
                                                </td>
                                                <td
                                                    style="padding:5px; border: 1px solid #e9ecef; color: #4a5568; font-size: .875rem;">
                                                    {{$travelCruise->departure_port}}</td>
                                                <td
                                                    style="padding:5px; border: 1px solid #e9ecef; color: #4a5568; font-size: .875rem;">
                                                    @if($travelCruise->departure_hrs)
                                                    {{ date('h:i A', strtotime($travelCruise->departure_hrs)) }}
                                                    @endif
                                                </td>
                                                <td
                                                    style="padding:5px; border: 1px solid #e9ecef; color: #4a5568; font-size: .875rem;">
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
                                    style="background-color: #f8f9fa; padding: 5px; border-radius: 6px;  font-weight: 600; color: #0f172a;">
                                    Add-on Services
                                </div>
                                @foreach($travel_cruise_addon as $addon)
                                <div style="padding: 5px ; border-bottom: 1px solid #e9ecef;">
                                    <div
                                        style="font-weight: 600; font-size: .875rem; color: #0f172a; margin-bottom: 0px;">
                                        {{ $addon->services }} :
                                    </div>
                                    <div style="font-size: .875rem;  color: #4a5568; line-height: 1.3;">
                                        {!! $addon->service_name !!}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif


                            @if($cruise_images)
                            @foreach ($cruise_images as $key => $img)
                            <div style="padding: 10px 0;">
                                <img src="{{ asset($img->file_path) }}"
                                    style="max-width: 100%; height: auto; border-radius: 6px;">
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            @endif

            <!------------ Start Car -------------->
            @if(in_array('Car', $bookingTypes))
            <tr>
                <td colspan="2" style="padding: 6px 10px;">
                    <div style="width:100%; border-radius: 6px;  overflow: hidden; border: 1px solid #e9ecef;">
                        <div style="padding:8px 5px;
    color: #fff;  font-size: 1rem;  font-weight:500;   background-color: #274481; border-bottom:1px solid #e9ecef;">
                            Car Details :-
                        </div>
                        <div style="padding: 0px; background-color: #ffffff;  color: #333;">

                            <div style="display: flex; flex-wrap: wrap; gap: 5px; border-radius: 6px;  padding: 5px;">



                                <!-- RIGHT SIDE: Structured Details + Pickup & Drop-off Block -->
                                <div style="flex: 1;">

                                    <div
                                        style="font-size: .875rem; font-weight: 500; color: #0f172a; border-bottom: 1px solid #e0e0e0; padding-bottom: 5px;">
                                        Pick-up and Drop-off
                                    </div>

                                    @foreach($booking->travelCar as $travelCar)
                                    <table
                                        style="width: 100%; border-collapse: separate; border-spacing: 0 10px; font-size: .875rem; color: #555; ">
                                        @if($travelCar->car_rental_provider)

                                        <tr>
                                            <td
                                                style="font-weight: 500;background-color: #fafafa;  border-radius: 6px;   color: #0f172a; font-size: .875rem;">
                                                Car Rental Provider :</td>
                                            <td
                                                style="font-weight: 400;background-color: #fafafa;  border-radius: 6px;   color: #0f172a; font-size: .875rem;">
                                                {{ $travelCar->car_rental_provider }}</td>
                                        </tr>
                                        @endif

                                        @if($travelCar->car_type)
                                        <tr>
                                            <td
                                                style="font-weight: 500;background-color: #fafafa;  border-radius: 6px;   color: #0f172a; font-size: .875rem;">
                                                Car Type :</td>
                                            <td
                                                style="font-weight: 400;background-color: #fafafa;  border-radius: 6px;   color: #0f172a; font-size: .875rem;">
                                                {{ $travelCar->car_type }}</td>
                                        </tr>
                                        @endif

                                        @if($travelCar->confirmation_number)
                                        <tr>
                                            <td
                                                style="font-weight: 500;background-color: #fafafa;  border-radius: 6px;   color: #0f172a; font-size: .875rem;">
                                                Confirmation Number :</td>
                                            <td
                                                style="font-weight: 400;background-color: #fafafa;  border-radius: 6px;   color: #0f172a; font-size: .875rem;">
                                                {{ $travelCar->confirmation_number }}</td>
                                        </tr>
                                        @endif

                                        @if($travelCar->rental_provider_address)
                                        <tr>
                                            <td
                                                style="font-weight: 500; padding: 14px; background-color: #fafafa; border-radius: 6px; color: #0f172a;">
                                                Rental Provider Address</td>
                                            <td style="padding: 14px; background-color: #fafafa; border-radius: 6px;">
                                                {{ $travelCar->rental_provider_address }}</td>
                                        </tr>
                                        @endif
                                    </table>



                                    <!-- Pickup & Drop-off Card -->
                                    <div
                                        style="padding: 6px;background-color: #f8f9fa;border-radius: 6px;  margin-bottom: 10px;">
                                        <div style="font-size: .875rem;  color: #1a202c; "><span
                                                style="font-weight: 500;">Pickup :</span>
                                            {{ $travelCar->pickup_date?->format('D, M j') }} -
                                            {{ $travelCar->pickup_time }} ,
                                            <span
                                                style="font-weight: 500; font-size: .875rem;">{{ $travelCar->pickup_location }}</span>
                                        </div>

                                        <div style="font-size: .875rem; color: #1a202c; "><span
                                                style="font-weight: 500;">Drop-off :</span>
                                            {{ $travelCar->dropoff_date?->format('D, M j') }} -
                                            {{ $travelCar->dropoff_time }} ,
                                            <span
                                                style="font-weight: 500; font-size: .875rem;">{{ $travelCar->dropoff_location }}</span>
                                        </div>
                                    </div>
                                    <hr style="
                            width: 90%;
                         
                            border: none;
                            border-top: 1px dashed #cbd5e0;
                            opacity: 0.9;
                        ">
                                    @endforeach

                                    <div style="font-size: .875rem; line-height: 1.6; color: #555; ">
                                        {!! $booking->car_description !!}
                                    </div>

                                </div>

                            </div>

                            <!-- Additional Car Images -->
                            @if($car_images)
                            @foreach ($car_images as $img)
                            <div style="padding: 15px 0;">
                                <img src="{{ asset($img->file_path) }}"
                                    style="max-width: 100%; height: auto; border-radius: 10px; box-shadow: 0 3px 8px rgba(0,0,0,0.1);">
                            </div>
                            @endforeach
                            @endif

                        </div>

                    </div>
                </td>
            </tr>
            @endif



            <!-------- Start Train  ------>
            @if(in_array('Train', $bookingTypes))
            <tr>
                <td colspan="2" style="padding: 0px 10px;">
                    <div style="width:100%; border-radius: 6px;  overflow: hidden; border: 1px solid #e9ecef;">
                        <div style="padding:8px 5px;
    color: #fff;  font-size: 1rem;  font-weight:500;   background-color: #274481; border-bottom:1px solid #e9ecef;">
                            Train Details :-
                        </div>
                        <div style="padding: 5px;">
                            @foreach($booking->trainBookingDetails as $key=>$trainBookingDetails)
                            <div style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #e9ecef;">
                                <!-- Route Codes -->
                                <div
                                    style="background:#deecfb; color:#0f172a; padding:5px; font-size:.875rem; font-weight:500; text-align: center; border-radius: 6px;  margin-bottom: 10px;">
                                    {{$trainBookingDetails->departure_station}} &nbsp;→&nbsp;
                                    {{$trainBookingDetails->arrival_station}}
                                </div>

                                <div style="font-size:.875rem; color:#0f172a; margin-bottom:5px;">
                                    <strong
                                        style="font-weight: 500; color:#4a5568; font-size:.875rem;">Departure:</strong>
                                    <span style=" color:#4a5568; font-size:.875rem;">
                                        {{ $trainBookingDetails->departure_date ? $trainBookingDetails->departure_date->format('D, M d, Y') : '' }}</span>
                                    |
                                    <strong
                                        style="font-weight: 500; color:#4a5568; font-size:.875rem;">Arrival:</strong>
                                    <span style=" color:#4a5568; font-size:.875rem;">
                                        {{ $trainBookingDetails->arrival_date ? $trainBookingDetails->arrival_date->format('D, M d, Y') : '' }}</span>
                                </div>

                                <div style="font-size:.875rem; color:#4a5568; line-height:1.6; margin-bottom:10px;">
                                    <strong style="font-weight: 500;">Direction</strong>: <span
                                        style=" color:#4a5568; font-size:.875rem;">{{$trainBookingDetails->departure_station}}</span>
                                    |
                                    <span style=" color:#4a5568; font-size:.875rem;"><strong
                                            style="font-weight: 500;">Cabin</strong>:
                                        {{$trainBookingDetails->cabin}}</span> |
                                    <strong style="font-weight: 500;">Train Ref</strong>: {{$booking->train_ref}}
                                </div>

                                <!-- Train + Times -->
                                <div
                                    style="padding: 20px 0; font-size: .875rem; color: #4a5568; background-color: #deecfb; border-radius: 6px; ">
                                    <div
                                        style="display: grid; grid-template-columns: repeat(4, 1fr); align-items: center; gap: 10px; text-align: center;">

                                        <!-- Train Number -->
                                        <div style="    display: flex
;
border-radius: 6px; 
    align-items: center;
    justify-content: center;">
                                            <div style="font-size: 30px;">🚆</div>
                                            <div class="">
                                                <div style="font-weight: 500; color: #0f172a; ">Train No</div>
                                                <div style="font-size: 12px;">{{ $trainBookingDetails->train_number }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Departure Time -->
                                        <div>
                                            <div style="font-size: 20px; font-weight: bold; color: #0f172a;">
                                                {{ date('h:i A', strtotime($trainBookingDetails->departure_hours)) }}
                                            </div>
                                            <div style="font-size: 12px; color: #718096; ">Depart</div>
                                        </div>

                                        <!-- Duration -->
                                        <div>
                                            <div style="font-size: 20px; color: #0f172a;">→</div>
                                            <div style="font-size: 12px; color: #718096; ">
                                                {{ $trainBookingDetails->transit }}
                                            </div>
                                        </div>

                                        <!-- Arrival Time -->
                                        <div>
                                            <div style="font-size: 20px; font-weight: bold; color: #0f172a;">
                                                {{ date('h:i A', strtotime($trainBookingDetails->arrival_hours)) }}
                                            </div>
                                            <div style="font-size: 12px; color: #718096; ">Arrives</div>
                                        </div>

                                    </div>
                                </div>


                                <!-- Seat Info -->
                                <div
                                    style="background: #deecfb;padding: 10px;font-size: .875rem;color: #0f172a;margin-top: 10px; border-radius: 6px; ">
                                    <div style="line-height: 1.6;">{!!
                                        $booking->train_description !!}</div>
                                </div>
                            </div>
                            @endforeach

                            @if($train_images)
                            @foreach ($train_images as $key => $img)
                            <div style="padding: 10px 0;">
                                <img src="{{ asset($img->file_path) }}"
                                    style="max-width: 100%; height: auto; border-radius: 6px;">
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            @endif

            <!-- Contact Information -->
            <tr>
                <td colspan="2" style="padding: 5px 10px 0px 10px;">
                    <div style="border-radius: 6px;  overflow: hidden; border: 1px solid #e9ecef;">
                        <div style="padding:8px 5px;
    color: #fff;  font-size: 1rem;  font-weight:500;   background-color: #274481; border-bottom:1px solid #e9ecef;">
                            Customer Information :-
                        </div>
                        <div style="padding: 0;">
                            <div
                                style="display: flex; justify-content: space-between; padding: 5px; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: .875rem; font-weight: 400; color: #0f172a;">Card Holder Name
                                </div>
                                <div style="font-size: .875rem; color: #4a5568;">{{$billingPricingData->cc_holder_name}}
                                </div>
                            </div>
                            <div
                                style="display: flex; justify-content: space-between; padding: 5px; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: .875rem; font-weight: 400; color: #0f172a;">Card Number</div>
                                <div style="font-size: .875rem; color: #4a5568;">
                                    {{ str_repeat('*', strlen($billingPricingData->cc_number) - 4) . substr($billingPricingData->cc_number, -4) }}

                                </div>
                            </div>
                            <div
                                style="display: flex; justify-content: space-between; padding: 5px; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: .875rem; font-weight: 400; color: #0f172a;">Card Type</div>
                                <div style="font-size: .875rem; color: #4a5568;">
                                    {{$billingPricingData->card_type}}
                                </div>
                            </div>



                            <div
                                style="display: flex; justify-content: space-between; padding: 5px; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: .875rem; font-weight: 400; color: #0f172a;">Email</div>
                                <div style="font-size: .875rem;">
                                    <a style="color: #1a56db; text-decoration: none;"
                                        href="mailto:{{$billingPricingData->email}}">{{$billingPricingData->email}}</a>
                                </div>
                            </div>
                            <div
                                style="display: flex; justify-content: space-between; padding: 5px; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: .875rem; font-weight: 400; color: #0f172a;">Booking Date</div>
                                <div style="font-size: .875rem; color: #4a5568;">
                                    {{ $booking->created_at->format('l, M d, Y') }}</div>
                            </div>
                            @if($booking->airlinepnr)
                            <div
                                style="display: flex; justify-content: space-between; padding: 5px; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: .875rem; font-weight: 400; color: #0f172a;">Airline Ref</div>
                                <div style="font-size: .875rem; color: #4a5568;">{{ $booking->airlinepnr }}</div>
                            </div>
                            @endif



                            @if($booking->cruise_ref)
                            <div
                                style="display: flex; justify-content: space-between; padding: 5px; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: .875rem; font-weight: 400; color: #0f172a;">Cruise Ref</div>
                                <div style="font-size: .875rem; color: #4a5568;">{{ $booking->cruise_ref }}</div>
                            </div>
                            @endif

                            @if($booking->car_ref)
                            <div
                                style="display: flex; justify-content: space-between; padding: 5px; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: .875rem; font-weight: 400; color: #0f172a;">Car Ref</div>
                                <div style="font-size: .875rem; color: #4a5568;">{{ $booking->car_ref }}</div>
                            </div>
                            @endif

                            @if($booking->train_ref)
                            <div
                                style="display: flex; justify-content: space-between; padding: 5px; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: .875rem; font-weight: 400; color: #0f172a;">Train Ref</div>
                                <div style="font-size: .875rem; color: #4a5568;">{{ $booking->train_ref }}</div>
                            </div>
                            @endif


                        </div>
                    </div>
                </td>
            </tr>

            <!------Passenger -------->
            <tr>
                <td colspan="2" style="padding: 6px 10px;">
                    <div
                        style="border-radius: 6px;  overflow: hidden; border-top: 1px solid #e9ecef; border-left: 1px solid #e9ecef; border-right: 1px solid #e9ecef;">
                        <div style="padding:8px 5px;
    color: #fff;  font-size: 1rem;  font-weight:500;   background-color: #274481; border-bottom:1px solid #e9ecef;">
                            Passenger Details :-
                        </div>
                        <div style=" overflow-x: auto;  padding: 8px 5px; border-radius: 6px;">
                            <table style="width: 100%;   ">
                                <thead>
                                    <tr style="background-color: #deecfb;">
                                        <th
                                            style="font-size: .875rem; font-weight: 500; padding: 5px ; text-align: left; color: #0f172a; border-bottom: 1px solid #e9ecef;">
                                            Type</th>
                                        <th
                                            style="font-size: .875rem; font-weight: 500; padding: 5px ; text-align: left; color: #0f172a; border-bottom: 1px solid #e9ecef;">
                                            Passenger Name</th>
                                        @if($booking->passengers->whereNotNull('seat_number')->count() > 0)
                                        <th
                                            style="font-size: .875rem; font-weight: 500; padding: 5px ; text-align: left; color: #0f172a; border-bottom: 1px solid #e9ecef;">
                                            Seat</th>
                                        @endif
                                        @if($booking->passengers->whereNotNull('e_ticket_number')->count() > 0)
                                        <th
                                            style="font-size: .875rem; font-weight: 500; padding: 5px ; text-align: left; color: #0f172a; border-bottom: 1px solid #e9ecef;">
                                            E-Ticket</th>
                                        @endif
                                        @if($booking->passengers->whereNotNull('room_category')->count() > 0)
                                        <th
                                            style="font-size: .875rem; font-weight: 500; padding: 5px ; text-align: left; color: #0f172a; border-bottom: 1px solid #e9ecef;">
                                            Room Category</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($booking->passengers as $key=>$passengers)
                                    <tr>
                                        <td
                                            style="font-size: .875rem; color: #4a5568; padding: 5px ; border-bottom: 1px solid #e9ecef;">
                                            {{$passengers->passenger_type}}</td>
                                        <td
                                            style="font-size: .875rem; color: #4a5568; padding: 5px ; border-bottom: 1px solid #e9ecef;">
                                            {{$passengers->title}} {{$passengers->first_name}}
                                            {{$passengers->middle_name}} {{$passengers->last_name}}</td>
                                        @if($booking->passengers->whereNotNull('seat_number')->count() > 0)
                                        <td
                                            style="font-size: .875rem; color: #4a5568; padding: 5px ; border-bottom: 1px solid #e9ecef;">
                                            {{$passengers->seat_number}}</td>
                                        @endif
                                        @if($booking->passengers->whereNotNull('e_ticket_number')->count() > 0)
                                        <td
                                            style="font-size: .875rem; color: #4a5568; padding: 5px ; border-bottom: 1px solid #e9ecef;">
                                            {{$passengers->e_ticket_number}}</td>
                                        @endif
                                        @if($booking->passengers->whereNotNull('room_category')->count() > 0)
                                        <td
                                            style="font-size: .875rem; color: #4a5568; padding: 5px ; border-bottom: 1px solid #e9ecef;">
                                            {{$passengers->room_category}}</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>



            <!-------Start Price ---------->
            <tr class="price-details">
                <td colspan="2" style="padding: 0px 10px;">
                    <div style="border-radius: 6px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style="padding:8px 5px;
    color: #fff;  font-size: 1rem;  font-weight:500;   background-color: #274481; border-bottom:1px solid #e9ecef;">
                            Price Details (USD) :-
                        </div>
                        <div style="padding: 5px;">

                            @php
                            $mergedPrices = [];
                            foreach($booking->pricingDetails as $pricingDetails) {
                            if($pricingDetails->passenger_type) {
                            if(!isset($mergedPrices[$pricingDetails->passenger_type])) {
                            $mergedPrices[$pricingDetails->passenger_type] = 0;
                            }
                            $mergedPrices[$pricingDetails->passenger_type] += $pricingDetails->gross_price;
                            }
                            }
                            @endphp



                            @if($booking->query_type == 26 || $booking->query_type == 27 || $booking->query_type == 49
                            || $booking->query_type == 38 || $booking->query_type == 30 ||
                            $booking->query_type == 46)

                            @foreach($booking->pricingDetails as $ExcursionPrice)
                            <div
                                style="display: flex; justify-content: space-between; padding-bottom:5px; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: .875rem; color: #2d3748; font-weight: 500;">
                                    {{$ExcursionPrice->details}} (per person) :
                                    {{ ucfirst($ExcursionPrice->passenger_type) }}

                                </div>
                                <div style="font-size: .875rem; color: #0f9b0f;">${{$ExcursionPrice->gross_price}}</div>
                            </div>

                            @if($booking->query_type == 26)
                            <div style="font-size: 10px; color: #666; padding: 0 0 10px 0;">inc. taxes & fees.</div>
                            @endif
                            @endforeach

                            @else



                            @if(in_array($booking->query_type, [11,12]))
                            <div
                                style="display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: 14px;  color: #2d3748;"> Pet in cargo Fees :</div>
                                <div style="font-size: 16px; color: #0f9b0f;">
                                    ${{ number_format(array_sum($mergedPrices), 2) }}</div>
                            </div>

                            @else
                            @foreach($mergedPrices as $passengerType => $totalPrice)
                            <div
                                style="display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: .875rem; color: #2d3748;">
                                    @if(in_array($booking->query_type, [3,7,8]))
                                    Total Price per person including taxes and fees. ({{ ucfirst($passengerType) }})
                                    @elseif($booking->query_type == 2)

                                    Rebooking fees per person. ({{ ucfirst($passengerType) }})
                                    @elseif($booking->query_type == 4)
                                    Baggage fees per Bag. ({{ ucfirst($passengerType) }})
                                    @elseif($booking->query_type == 9)
                                    Travel Insurance per person. ({{ ucfirst($passengerType) }})
                                    @elseif($booking->query_type == 17)
                                    Cruise Fare - Per Guest - ({{ ucfirst($passengerType) }})
                                    @elseif($booking->query_type == 13 || $booking->query_type == 14 ||
                                    $booking->query_type ==18 || $booking->query_type == 19 || $booking->query_type ==
                                    20 || $booking->query_type ==29 || $booking->query_type == 33 ||
                                    $booking->query_type == 34 || $booking->query_type == 41 || $booking->query_type ==
                                    43 || $booking->query_type == 44 || $booking->query_type == 50 ||
                                    $booking->query_type == 51)
                                    Cancellation fee per person - ({{ ucfirst($passengerType) }})
                                    @else
                                    Total Price per person including taxes and fees. ({{ ucfirst($passengerType) }})
                                    @endif</div>
                                <div style="font-size: .875rem; color: #0f9b0f;">
                                    ${{ number_format($totalPrice, 2) }}
                                </div>
                            </div>
                            @endforeach
                            @endif
                            @endif

                            @if(isset($billing_deposits))



                            @if($billing_deposits->deposit_amount > 0)
                            <div
                                style="display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: .875rem; color: #2d3748;"> Deposit to be collected</div>
                                <div style="font-size: .875rem; color: #0f9b0f;">
                                    ${{$billing_deposits->deposit_amount }} </div>
                            </div>
                            @endif

                            @if($billing_deposits->pending_amount > 0)
                            <div
                                style="display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: .875rem; color: #2d3748;"> Remaining Balance</div>
                                <div style="font-size: .875rem; color: #0f9b0f;">
                                    ${{$billing_deposits->pending_amount }} </div>
                            </div>
                            @endif


                            @if($billing_deposits->due_date)
                            <div
                                style="display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: .875rem; color: #2d3748;"> Due Date</div>
                                <div style="font-size: .875rem; color: #0f9b0f;">
                                    {{ \Carbon\Carbon::parse($billing_deposits->due_date)->format('d M Y') }} </div>
                            </div>
                            @endif

                            @endif


                            <div style="display: flex; justify-content: space-between; padding: 5px 0;">
                                <div style="font-size: .875rem; font-weight: 600; color: #2d3748;">Total Amount
                                    including
                                    taxes & Fees. </div>
                                <div style="font-size: .875rem; font-weight: 600; color: #0f9b0f;">
                                    ${{ number_format($booking->gross_value, 2) }}
                                </div>
                            </div>


                            <div>

                            </div>


                            <div style=" padding:  5px 0px; background-color: #f8f9fa; border-radius: 0px;">
                                <ul style="margin: 0; padding-left: 20px; color: #4a5568; font-size: 12px;">
                                    <li style=" line-height: 1.6;">
                                        <strong>All transactions</strong> will be processed in US Dollars (USD). If your
                                        card was issued in a country other than the USA, your card issuer may charge a
                                        currency conversion fee of up to 4% of the total amount charged. Kindly check
                                        with your financial institution for more information.
                                    </li>

                                    @if($booking->query_type != 13 || $booking->query_type != 14 || $booking->query_type
                                    != 18 || $booking->query_type != 19 || $booking->query_type != 20 ||
                                    $booking->query_type != 29 || $booking->query_type != 33 || $booking->query_type !=
                                    34 || $booking->query_type != 41 || $booking->query_type != 43 ||
                                    $booking->query_type != 44 || $booking->query_type != 50 || $booking->query_type !=
                                    51)
                                    <li style="line-height: 1.6;">
                                        <strong>Prices are not guaranteed</strong> until the ticket number(s) are
                                        issued. Prices may change based on airline inventory availability.
                                    </li>
                                    @endif

                                </ul>
                            </div>
                </td>
            </tr>



            <!--  End Price Details -->



            <tr>
                <td colspan="2" style="padding: 6px 10px;">
                    <div style="border-radius: 6px;  overflow: hidden; border: 1px solid #e9ecef;">
                        <div style="padding:8px 5px;
    color: #fff;  font-size: 1rem;  font-weight:500;   background-color: #274481; border-bottom:1px solid #e9ecef;">
                            Disclaimer :-
                        </div>
                        <div style="padding: 5px;">
                            <div style="font-size: 12px; color: #4a5568; line-height: 1.6;">
                                <p style="">I,&nbsp;<strong>{{$billingPricingData->cc_holder_name}}
                                    </strong>, hereby acknowledge receipt of this communication outlining the associated
                                    charges. I have thoroughly reviewed and confirmed the accuracy of the itinerary,
                                    including all passenger names, flight schedules, dates, and times.</p>
                                <p style="">I acknowledge and accept that the total cost of the
                                    booking is <strong>USD {{ number_format($booking->gross_value, 2) }} </strong>,
                                    which will be processed through <strong>single or multiple transactions</strong>. I
                                    understand that, regardless of the number of transactions, the <strong>total amount
                                        charged will not exceed USD {{ number_format($booking->gross_value, 2) }}
                                    </strong>.</p>
                                <p style="">I further acknowledge that the charges may appear on my
                                    credit card statements under one or more of the following descriptors:
                                {{ $booking->descriptor }} <strong>{{ $booking->selected_company_name }}</strong>.
                                </p>
                                <p style="">By this statement, I hereby authorize
                                    <strong>{{ $booking->selected_company_name }}</strong> and its affiliated service
                                    providers to charge the following amounts to my cards for the related travel
                                    services:
                                </p>


                                <ul style=" margin-bottom: -6px;">
                                    @foreach($billingPricingDataAll as $billing)
                                    @if($billing->authorized_amt > 0)
                                    <li style="margin-bottom: 10px;"><b> USD
                                            {{ number_format($billing->authorized_amt, 2) }} </b> to my <b>
                                            {{ $billing->card_type }} ending in
                                            **** **** **** {{ substr($billing->cc_number, -4) }}</b>
                                    </li>
                                    @endif
                                    @endforeach
                                               
                                </ul>
                                <p style="margin-top: 5px;">I confirm that I am the authorized cardholder for the above
                                    payment methods and consent to the processing of these charges as outlined.</p>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 5px 10px;">
                    <div style="margin-bottom: 12px;">
                        <label
                            style="display: flex; align-items: center; font-size: 14px; color: #4a5568; cursor: pointer;">
                            @{{Checkbox}} &nbsp;
                            <a href="{{ route('terms.nonrefundable', ['refundStatus' => 'nonrefundable', 'booking_id' => $booking->id]) }}"
                                target="_blank" style="color: #1a56db; text-decoration: none;">
                                I have read and agree to the Terms and Conditions
                            </a>
                        </label>
                    </div>

            </tr>
            <tr>
                <td>
                            <div style="font-size: 12px; color: #4a5568; line-height: 1.6;">

                                <p>
                                    <strong>Your Personal Assistence </strong>: {{ auth()->user()->name }}
                                </p>
                                <p style="margin-top: -10px;">
                                    <strong>Extension </strong>: +1 (123) 456-7890
                                </p>


                            </div>

                        </td>

                <td colspan="2" style="padding: 0px 30px 20px 30px;">
                    <!-- Signature Space -->
                    <div style="margin-top: 30px; text-align: right;">
                        <div
                            style="width: 200px; height: 60px; border-bottom: 2px solid #1a2a6c; margin-left: auto; margin-bottom: 10px;">
                            @{{S}}</div>
                        <label style="font-size: 16px; font-weight: 600; color: #1a2a6c; display: inline-block;">
                            Signature
                        </label>
                    </div>
                </td>
                           
            </tr>





        </tbody>
        <tfoot>
            <tr>
                <!-- ✅ Outer white space (same padding as header) -->
                <td colspan="2" style="background-color: #ffffff; padding: 0 10px;">
                    <!-- ✅ Inner full-width gradient section -->
                    <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="">
                        <tr>
                            <td
                                style="background: linear-gradient(135deg, #1c316d, #285274); padding: 5px 30px; text-align: center; border-radius: 0px; ">




                                <!-- Footer Text -->
                                <div style="font-size: 12px; font-weight: 400; color: #e2e8f0; text-align: center;">
                                    © {{ date('Y') }} All Rights Reserved.
                                </div>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tfoot>


    </table>




</body>

</html>