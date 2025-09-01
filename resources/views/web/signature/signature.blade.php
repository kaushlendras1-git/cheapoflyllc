<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Boooking Authorization</title>
</head>
@php
$bookingTypes = $booking->bookingTypes->pluck('type')->toArray();
@endphp

<body style="margin: 0px; padding: 0px;">
    <table
        style="font-family: 'Work Sans', sans-serif; width: 50%; background-color: #fff3f3; margin: auto; border-collapse: collapse;">
        <thead>
            <tr>

                <th style="padding: 10px 30px 10px 30px;">Speak to a travel Expert</th>
                <th style="padding: 10px 30px 10px 0px;">
                    <span style="display: flex; align-items: center; justify-content: end;">
                        <img style="margin-right: 10px;" width="20" src="{{asset('email-templates/call.png')}}"
                            alt="call">
                        <a style="font-size: 18px; font-weight: 600; color: #c53d3d; text-decoration: none;"
                            href="tel:+1-844-382-2225">+1-844-382-2225</a>
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" style="padding: 0px;">
                    @if($bookingTypes[0] == 'Flight')
                    <img style="height: 300px; width: 100%; " src="{{asset('email-templates/flight-banner.png')}}"
                        alt="flight">
                    @elseif($bookingTypes[0] == 'Cruise')
                    <img style="height: 300px; width: 100%; object-fit: cover;"
                        src="{{asset('email-templates/cruise.jpeg')}}" alt="cruise">
                    @elseif($bookingTypes[0] == 'Train')
                    <img style="height: 300px; width: 100%; object-fit: cover;"
                        src="{{asset('email-templates/amtrak.jpeg')}}" alt="amtrak">
                    @elseif($bookingTypes[0] == 'Car')
                    <img style="height: 300px; width: 100%; object-fit: cover;"
                        src="{{asset('email-templates/car.jpeg')}}" alt="car">
                    @elseif($bookingTypes[0] == 'Hotel')
                    <img style="height: 300px; width: 100%; object-fit: cover;"
                        src="{{asset('email-templates/hotel.jpeg')}}" alt="hotel">
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 16px; font-weight: 600; padding: 10px 30px 0px 30px;">Dear
                    {{ $booking->name }},</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #787878; padding: 5px 30px 0px 30px;">
                    Thank you
                    for using {{ $booking->selected_company_name }} for your travel needs. Please take a moment to
                    review the names, date,
                    Flight itinerary, price and other relevant details of your booking.</td>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="container">
                        <div>
                            {{-- Success message --}}
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                ✅ Thank you for your authorization! Your signature has been successfully recorded.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif

                            {{-- Validation errors (all in a list) --}}
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
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


            <tr>
                <td style="font-size: 16px; font-weight: 600; text-align: center; padding: 0px 0px 0px 30px;">
                    <span
                        style="display: inline-block; background-color: #fff; padding: 20px; border-radius: 10px; margin-top: 20px;">
                        <span style="display: block; margin-bottom: 10px;"> <img width="40"
                                src="{{asset('email-templates/sku.png')}}" alt="Number"> </span>
                        Booking Reference Number
                        <span
                            style="font-size: 14px; font-weight: 400; display: block; color: #000; padding-top: 10px;">{{ $booking->pnr }}</span></span>
                </td>
                <td style="font-size: 16px; font-weight: 600; text-align: center; padding: 0px 30px 0px 0px;">
                    <span
                        style="display: inline-block; background-color: #fff; padding: 20px 65px; border-radius: 10px; margin-top: 20px;">
                        <span style="display: block; margin-bottom: 10px;"> <img width="40"
                                src="{{asset('email-templates/event.png')}}" alt="Number"> </span>
                        Booking Date
                        <span
                            style="font-size: 14px; font-weight: 400; display: block; color: #000; padding-top: 10px;">Monday,
                            Jul 14,2025</span></span>
                </td>
            </tr>

            <!-------------Flight --------------->
            @if(in_array('Flight', $bookingTypes))

            @if($booking->travelFlight->isNotEmpty())





            <!-------Flight-------------->
            <tr>
                <td colspan="2" style="padding: 30px 30px 0px 30px;">



                    <table
                        style="width:100%;margin:0 auto;border-collapse:collapse;background-color: #fff;border-radius: 10px;">
                        <tr>
                            <td colspan="2"
                                style="font-size:20px; font-weight:bold; color:#c53d3d; padding:15px; border-bottom:1px solid #ddd;">
                                Flight Details
                            </td>
                        </tr>
                        @foreach($booking->travelFlight as $index => $flight)
                        <tr style="display:flex; flex-direction:column; margin-bottom:5px;">
                            <td style="display:flex; align-items:center; text-align:left; padding: 10px 20px;">
                                <div style="align-items:center; display:flex; margin-right:10px; margin-bottom:16px;">
                                    <img src="https://www.pnrconverter.com/images/airlines/png/150/nz.png"
                                        alt="airline logo" style="max-height:35px; object-fit:scale-down; width:75px;"
                                        width="75">
                                </div>
                                <div style="text-align:left; flex:1;">
                                    <p
                                        style="font-size: 16px; font-weight: 600; color: #000; margin-bottom: 5px; margin-top: 0px; margin-left: 5px;">
                                        {{ $flight->departure_date?->format('D, M j') }} - {{$flight->airline_code}}
                                        {{$flight->flight_number}} <span style="text-transform:capitalize;"></span>-
                                        {{$flight->duration}}
                                    </p>
                                    <p style="font-size: 16px; margin-bottom: 2px; margin-top: 0px; margin-left: 5px;">
                                        <span style="font-weight: 400; color: #000;">Departing:</span>
                                        <span
                                            style="font-size: 14px; font-weight: 400; padding-left: 10px; display: inline-block;">{{$flight->departure_hours}}
                                            from {{$flight->departure_airport}}</span>
                                    </p>
                                    <p style="font-size: 16px; margin-bottom: 5px; margin-top: 0px; margin-left: 5px;">
                                        <span style="font-weight: 400; color: #000;">Arriving:</span>
                                        <span
                                            style="font-size: 14px; font-weight: 400; padding-left: 10px; display: inline-block;">{{$flight->arrival_hours}}
                                            into {{$flight->arrival_airport}}</span>
                                    </p>
                                    <p style="margin-top: 5px;">@if($flight->transit)</p>
                                    <div
                                        style="color:rgb(136, 136, 136); font-size:12px; line-height:16px; margin-bottom:5px; margin-top:5px; text-align:left;">
                                        <div>
                                            --------<span style="color:red; font-weight:600;"></span>--Transit Time:
                                            {{$flight->transit }} --------
                                        </div>
                                    </div>
                                    @endif

                                </div>

                            </td>
                        </tr>
                        @endforeach
                        @if($flight_images)
                        @foreach ($flight_images as $key => $img)
                        <!-- <tr>
                            <td colspan="13" style="padding: 10px 20px;">
                                <img src="{{ asset($img->file_path) }}" class="img-thumbnail">
                            </td>
                        </tr> -->
                        @endforeach
                        @endif
                        @endif
                        @endif

                    </table>




                </td>
            </tr>






            @if(in_array('Hotel', $bookingTypes))

            @if($booking->travelHotel->isNotEmpty())



            <!-- Start Hotel Details -->
            <tr>
                <td colspan="2" style="padding: 30px 30px 0px 30px;">

                    <table border="0" cellspacing="0" cellpadding="0"
                        style="width:100%;margin:0 auto;border-collapse:collapse;background-color: #fff;border-radius: 10px; overflow: hidden;">
                        <tr>
                            <td colspan="2"
                                style="font-size:20px; font-weight:bold; color:#c53d3d; padding:15px; border-bottom:1px solid #ddd;">
                                Hotel Details
                            </td>
                        </tr>
                        <tr>
                            <!-- Hotel Image -->
                            <td style="width:200px; padding:0; vertical-align:top; padding: 10px 20px;">
                                <img src="{{asset('email-templates/bedroom.jpg')}}" alt="Hotel"
                                    style="width:200px; height:150px; border-radius:12px;margin-bottom:10px">
                                <img src="{{asset('email-templates/bedroom.jpg')}}" alt="Hotel"
                                    style="width:200px; height:150px; border-radius:12px;">
                            </td>

                            <td style="padding:12px; padding-left: 30px; vertical-align:top;">
                                <p style="margin:4px 0; font-size:13px; color:#555;">
                                <div style="white-space: pre-line; font-size: 14px;">{{ $booking->hotel_description }}
                                </div>
                                </p>

                            </td>
                        </tr>

                        <!-- Booking Info Row -->
                        <tr>
                            <td colspan="2"
                                style="background:#f8f8f8; padding:12px; text-align:center; border-top:1px solid #eee; border-bottom:1px solid #eee;">
                                <table cellspacing="0" cellpadding="6"
                                    style="width:100%; font-size:14px; text-align:center;">
                                    @foreach($booking->travelHotel as $key=>$travelHotel)

                                    <tr>
                                        <td>
                                            <div style="display: flex; gap: 30px; flex-wrap: wrap;">
                                                <div style="text-align: left;">
                                                    <div style="font-size:12px; color:#000; font-weight:bold;">Hotel
                                                        Name</div>
                                                    <div style="font-weight:normal;">{{$travelHotel->hotel_name}}</div>
                                                </div>
                                                <div style="text-align: left;">
                                                    <div style="font-size:12px; color:#000; font-weight:bold;">Room
                                                        Category
                                                    </div>
                                                    <div style="font-weight:normal;">{{$travelHotel->room_category}}
                                                    </div>
                                                </div>
                                                <div style="text-align: left;">
                                                    <div style="font-size:12px; color:#000; font-weight:bold;">
                                                        Confirmation
                                                        Number</div>
                                                    <div style="font-weight:normal;">
                                                        {{$travelHotel->confirmation_number}}</div>
                                                </div>
                                                <div style="text-align: left;">
                                                    <div style="font-size:12px; color:#000; font-weight:bold;">Hotel
                                                        Address
                                                    </div>
                                                    <div style="font-weight:normal;">{{$travelHotel->hotel_address}}
                                                    </div>
                                                </div>
                                                <div style="text-align: left;">
                                                    <div style="font-size:12px; color:#000; font-weight:bold;">CHECK-IN
                                                    </div>
                                                    <div style="font-weight:normal;">
                                                        {{ $travelHotel->checkin_date ? $travelHotel->checkin_date->format('l, F d, Y') : '' }}
                                                    </div>
                                                </div>
                                                <div style="text-align: left;">
                                                    <div style="font-size:12px; color:#000; font-weight:bold;">CHECK-OUT
                                                    </div>
                                                    <div style="font-weight:normal;">
                                                        {{ $travelHotel->checkout_date ? $travelHotel->checkin_date->format('l, F d, Y') : '' }}
                                                    </div>
                                                </div>
                                                <div style="text-align: left;">
                                                    <div style="font-size:12px; color:#000; font-weight:bold;">ROOMS
                                                    </div>
                                                    <div style="font-weight:normal;"> {{$travelHotel->no_of_rooms}}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @foreach ($hotel_images as $key => $img)
                                    <!-- <tr>
                                        <td colspan="10" style="padding: 30px 30px 0px 30px;"><img width="100%"
                                                src="{{ asset($img->file_path) }}" class="img-thumbnail"></td>
                                    </tr> -->
                                    @endforeach
                                    @endif
                                    @endif

                                </table>
                            </td>
                        </tr>


                    </table>
                </td>
            </tr>







            @if(in_array('Cruise', $bookingTypes))

            <tr>
                <td colspan="2" style="padding: 30px 30px 0px 30px;">
                    <table
                        style="width:100%;margin:0 auto;border-collapse:collapse;background-color: #fff;border-radius: 10px; overflow: hidden;">
                        <tr>
                            <td colspan="2"
                                style="font-size:20px; font-weight:bold; color:#c53d3d; padding:15px; border-bottom:1px solid #ddd;">
                                Cruise Details
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%; padding: 10px 20px;">
                                <img style="width: 100%; border-radius: 10px;"
                                    src="{{asset('email-templates/cruise-auth.jpg')}}" alt="cruise-img">
                            </td>
                            <td style="width: 50%; vertical-align: top; padding: 0px 30px;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td colspan="2" style="padding-left: 30px; padding-bottom: 20px;"><img
                                                width="100" src="{{asset('email-templates/msc-cruise.png')}}"
                                                alt="cruise-logo"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px; font-weight: 600; padding-bottom: 10px;">Ship: </td>
                                        <td style="font-size: 14px; font-weight: 400; padding-bottom: 10px;">
                                            {{$travel_cruise_data->cruise_name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px; font-weight: 600; padding-bottom: 10px;">Lenght:
                                        </td>
                                        <td style="font-size: 14px; font-weight: 400; padding-bottom: 10px;">
                                            {{$travel_cruise_data->length}}
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="font-size: 14px; font-weight: 600; padding-bottom: 10px;">Departure
                                            Post
                                            Port: </td>
                                        <td style="font-size: 14px; font-weight: 400; padding-bottom: 10px;">
                                            {{$travel_cruise_data->departure_port}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px; font-weight: 600; padding-bottom: 10px;">Arrival
                                            Port
                                            Date: </td>
                                        <td style="font-size: 14px; font-weight: 400; padding-bottom: 10px;">
                                            {{$travel_cruise_data->arrival_port}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px; font-weight: 600; padding-bottom: 10px;">Cruise Line
                                            Port: </td>
                                        <td style="font-size: 14px; font-weight: 400; padding-bottom: 10px;">
                                            {{$travel_cruise_data->cruise_line}}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px; font-weight: 600; padding-bottom: 10px;">Category
                                        </td>
                                        <td style="font-size: 14px; font-weight: 400; padding-bottom: 10px;">
                                            {{$travel_cruise_data->category}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px; font-weight: 600; padding-bottom: 10px;">Stateroom
                                        </td>
                                        <td style="font-size: 14px; font-weight: 400; padding-bottom: 10px;">
                                            {{$travel_cruise_data->stateroom}}
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 10px 20px;">
                                <table border="1" cellspacing="0" cellpadding="10"
                                    style="border-collapse:collapse; font-family: 'Work Sans', sans-serif; width: 100%; background-color: #f8f8f8; margin: auto; font-size:14px; text-align:left;">
                                    <tr style="background-color: #ffe0e0; font-weight:bold;">

                                        <td style="width:25%;">DATE</td>
                                        <td style="width:35%;">PORT OF CALL</td>
                                        <td style="width:20%;">ARRIVE</td>
                                        <td style="width:20%;">DEPART</td>
                                    </tr>
                                    @foreach($booking->travelCruise as $key=>$travelCruise)

                                    <!------------cruise----------------->
                                    <tr>
                                        <td style="padding:8px;">
                                            <b> {{ \Carbon\Carbon::parse($travelCruise->departure_date)->format('l') }}
                                            </b><br>
                                            {{ \Carbon\Carbon::parse($travelCruise->departure_date)->format('d-m-Y') }}
                                        </td>
                                        <td style="padding:8px;">{{$travelCruise->departure_port}}</td>
                                        <td style="padding:8px;">{{$travelCruise->departure_hrs}}</td>
                                        <td style="padding:8px;">{{$travelCruise->arrival_hrs}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 10px 20px;">
                                <table style="width: 100%;">
                                    @foreach($travel_cruise_addon as $addon )
                                    <tr style="border-bottom: 1px solid #d2d2d2;">
                                        <td style="padding-top: 10px;">
                                            <p style="margin-bottom: 0px;"><b>{{$addon->services}}</b></p>
                                            <p style="margin-bottom: 10px; font-size: 14px;">{!!
                                                nl2br(e($addon->service_name)) !!}
                                            </p>
                                        </td>
                                    </tr>
                                    @endforeach

                                </table>
                            </td>
                        </tr>
                        @if($cruise_images)
                        @foreach ($cruise_images as $key => $img)
                        <!-- <tr>
                            <td colspan="2" style="padding: 10px 20px;"><img width="100%"
                                    src="{{ asset($img->file_path) }}" class="img-thumbnail"></td>
                        </tr> -->
                        @endforeach
                        @endif
                    </table>
                </td>
            </tr>

            <!------------End cruise----------------->



            @endif

            <!------------ Start Car -------------->
            @if(in_array('Car', $bookingTypes))


            <tr>
                <td colspan="2" style="padding: 30px 30px 0px 30px;">
                    <table border="0" cellpadding="0" cellspacing="0" align="center" width="700"
                        style="font-family: 'Work Sans', sans-serif; background-color: #fff; margin: auto; border:1px solid #ddd; border-radius:12px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,0.1); margin-top: 20px;">
                        <tr>
                            <td colspan="2"
                                style="font-size:20px; font-weight:bold; color:#c53d3d; padding:15px; border-bottom:1px solid #ddd;">
                                Car Details
                            </td>
                        </tr>
                        <tr>
                            <!-- LEFT SIDE -->
                            <!-- <td style="width: 20%;">
                                <table>
                                    <tr>
                                        <td style="padding-bottom:0px; padding-left: 20px;">
                                            <img src="{{asset('email-templates/car_book.png')}}" width="150"
                                                style="display:block; border:0;" />
                                        </td>
                                    </tr>
                                </table>
                            </td> -->
                            <td width="420" valign="top" style="padding:15px; border-right:1px solid #ddd; width: 40%;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <!-- Car image -->
                                        <td style="padding-bottom:0px; padding-left: 20px;">
                                            <img src="{{asset('email-templates/car_book.png')}}" width="150"
                                                style="display:block; border:0;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- Title -->
                                        <td style="color:#000; padding-bottom:8px;">
                                            <div style="white-space: pre-line; font-size: 14px;">
                                                {{ $booking->car_description }}</div>
                                        </td>
                                    </tr>

                                </table>
                            </td>

                            <!-- RIGHT SIDE -->
                            <td width="280" valign="top" style="padding:15px; width: 40%;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="font-size:14px; font-weight:bold; color:#000; padding-bottom:20px;">
                                            Pick-up and drop-off
                                        </td>
                                    </tr>
                                    @foreach($booking->travelCar as $key=>$travelCar)
                                    @if($travelCar->car_rental_provider)
                                    <p style="font-size: 14px; margin-bottom: 5px;"><b>Car Rental Provider</b> :
                                        {{$travelCar->car_rental_provider}}</p>
                                    @endif

                                    @if($travelCar->car_type)
                                    <p style="font-size: 14px; margin-bottom: 5px;"><b>Car Type</b> :
                                        {{$travelCar->car_type}}</p>
                                    @endif

                                    @if($travelCar->confirmation_number)
                                    <p style="font-size: 14px; margin-bottom: 5px;"><b>Confirmation Number</b> :
                                        {{$travelCar->confirmation_number}}</p>
                                    @endif

                                    @if($travelCar->rental_provider_address)
                                    <p style="font-size: 14px; margin-bottom: 5px;"><b>Rental Provider Address</b> :
                                        {{$travelCar->rental_provider_address}}</p>
                                    @endif

                                    <!-- {{$travelCar->car_rental_provider}}
                                            {{$travelCar->car_type}}
                                            {{$travelCar->pickup_location}}
                                            {{$travelCar->dropoff_location}}
                                            {{$travelCar->pickup_date?->format('Y-m-d')}}
                                            {{$travelCar->pickup_time}}
                                            {{$travelCar->dropoff_date?->format('Y-m-d')}}
                                            {{$travelCar->dropoff_time}}
                                            {{$travelCar->confirmation_number}}
                                            {{$travelCar->rental_provider_address}} -->
                                    <tr>
                                        <td style="font-size:13px; color:#333; line-height:20px; padding-bottom:20px;">
                                            <span style="font-size:14px; display: block;">⭕
                                                {{ $travelCar->pickup_date?->format('D, M j') }} -
                                                {{$travelCar->pickup_time}}</span>
                                            <span style="padding-left: 25px; display: block;">
                                                <b>{{$travelCar->pickup_location}}</b> </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px; color:#333; line-height:20px;">
                                            <span style="font-size:14px; display: block;">⭕
                                                {{ $travelCar->dropoff_date?->format('D, M j') }} -
                                                {{$travelCar->dropoff_time}}</span>
                                            <span style="padding-left: 25px; display: block;">
                                                <b>{{$travelCar->dropoff_location}}</b> </span>
                                        </td>
                                    </tr>
                                    @endforeach

                                </table>
                            </td>
                        </tr>
                        @if($car_images)
                        @foreach ($car_images as $key => $img)
                        <!-- <tr>
                            <td colspan="10" style="padding: 10px 20px;"><img width="100%"
                                    src="{{ asset($img->file_path) }}" class="img-thumbnail"></td>
                        </tr> -->
                        @endforeach
                        @endif

                        @endif
                    </table>
                </td>
            </tr>



            <!---------- End Car ----------------->



            <!-------- Start Train  ------>
            @if(in_array('Train', $bookingTypes))



            <tr>
                <td colspan="2">
                    <table border="0" cellpadding="0" cellspacing="0" width="700" align="center"
                        style="font-family: 'Work Sans', sans-serif; background-color: #fff; margin: auto; border:1px solid #ddd; border-radius:12px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,0.1); margin-top: 20px;">
                        <!-- Title -->
                        <tr>
                            <td colspan="2"
                                style="font-size:20px; font-weight:bold; color:#c53d3d; padding:15px; border-bottom:1px solid #ddd;">
                                Train Details
                            </td>
                        </tr>

                        @foreach($booking->trainBookingDetails as $key=>$trainBookingDetails)

                        <!-- {{$trainBookingDetails->direction}}
                {{$trainBookingDetails->departure_hours}}
                {{$trainBookingDetails->arrival_hours}}
                {{$trainBookingDetails->duration}}
                {{$trainBookingDetails->transit}}
                {{$trainBookingDetails->arrival_date?->format('Y-m-d')}} -->

                        <tr>
                            <!-- Departure -->
                            <td width="100%" valign="top" style="padding:15px; border-right:1px solid #ddd;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td
                                            style="font-size:14px; font-weight:bold; color:#c53d3d; padding-bottom:5px;">
                                            Departure :
                                            {{ $trainBookingDetails->departure_date ? $trainBookingDetails->departure_date->format('D, M d, Y') : '' }}
                                            | Arrival :
                                            {{ $trainBookingDetails->departure_date ? $trainBookingDetails->arrival_date->format('D, M d, Y') : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:13px; color:#333; line-height:18px; padding-bottom:10px;">
                                            <b>Direction</b> : {{$trainBookingDetails->departure_station}} |
                                            <b>Cabin</b> : {{$trainBookingDetails->cabin}}
                                        </td>
                                    </tr>
                                    <!-- Route Codes -->
                                    <tr>
                                        <td
                                            style="background:#c53d3d; color:#fff; padding:6px 10px; font-size:16px; font-weight:bold; text-align: center;">
                                            {{$trainBookingDetails->departure_station}} &nbsp;⇀&nbsp;
                                            {{$trainBookingDetails->arrival_station}}
                                        </td>
                                    </tr>
                                    <!-- Train + Times -->
                                    <tr>
                                        <td style="padding:15px 0; font-size:13px; color:#333;">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <!-- Train -->
                                                    <td width="30%" valign="top"
                                                        style="text-align:center; font-size:14px; color:#666;">
                                                        🚆 <b>Train No</b> <br />
                                                        {{$trainBookingDetails->train_number}}<br />

                                                    </td>
                                                    <!-- Depart -->
                                                    <td width="30%" valign="top" style="text-align:center;">
                                                        <div style="font-size:20px; font-weight:bold;">
                                                            {{$trainBookingDetails->departure_hours}}</div>
                                                        <div style="font-size:11px; color:#666;">DEPARTS</div>
                                                    </td>
                                                    <!-- Duration -->
                                                    <td width="10%" valign="middle"
                                                        style="text-align:center; font-size:12px; color:#333;">
                                                        →
                                                        <div style="font-size:11px; color:#666;">
                                                            {{$trainBookingDetails->transit}}</div>
                                                    </td>
                                                    <!-- Arrives -->
                                                    <td width="30%" valign="top" style="text-align:center;">
                                                        <div style="font-size:20px; font-weight:bold;">
                                                            {{$trainBookingDetails->arrival_hours}}</div>
                                                        <div style="font-size:11px; color:#666;">ARRIVES</div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                    <!-- Seat Info -->
                                    <tr>
                                        <td
                                            style="background:#ffe0e0; padding:10px; font-size:14px; color:#c53d3d; font-weight:normal;">
                                            <div style="white-space: pre-line;">{{ $booking->train_description }}</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @endforeach

                        @if($train_images)
                        @foreach ($train_images as $key => $img)
                        <!-- <tr>
                            <td colspan="2" style="padding: 10px 20px"><img width="100%"
                                    src="{{ asset($img->file_path) }}" class="img-thumbnail"></td>
                        </tr> -->

                        @endforeach
                        @endif
                        @endif
                    </table>
                </td>
            </tr>



            <!-----   End Train ------------>


            <tr>
                <td colspan="2" style="padding: 30px 30px 0px 30px;">
                    <div
                        style="border: 2px solid #c53d3d; border-radius: 10px; border-collapse: collapse; overflow: hidden;">
                        <table style="width: 100%; border-radius: 10px; border-collapse: collapse;">
                            <tr>
                                <th colspan="2"
                                    style="font-size: 16px; font-weight: 600; color: #fff; background-color: #c53d3d; padding: 12px 10px;">
                                    <span> <img style="margin-bottom: -2px;" width="16"
                                            src="{{asset('email-templates/information.png')}}" alt="info"> </span>
                                    Customer Information
                                </th>
                            </tr>
                            <tr>
                                <th style="font-size: 14px; font-weight: 600; padding: 10px 20px; text-align: left;">
                                    Card Holder Name</th>
                                <td
                                    style="font-size: 14px; font-weight: 400; color: #000; padding: 10px 20px; text-align: right;">
                                    {{$billingPricingData->cc_holder_name}}</td>
                            </tr>
                            <tr>
                                <th style="font-size: 14px; font-weight: 600; padding: 10px 20px; text-align: left;">
                                    Card Number</th>
                                <td
                                    style="font-size: 14px; font-weight: 400; color: #000; padding: 10px 20px; text-align: right;">

                                    @php
                                    $ccNumber = decode($billingPricingData->cc_number);
                                    $maskedCC = str_repeat('*', max(0, strlen($ccNumber) - 4));
                                    $formatted = chunk_split($maskedCC . substr($ccNumber, -4), 4, ' ');
                                    @endphp
                                    {{ trim($formatted) }}

                                </td>
                            </tr>

                            <tr>
                                <th
                                    style="font-size: 14px; font-weight: 600; padding: 0px 0px 10px 20px; text-align: left;">
                                    Email</th>
                                <td
                                    style="font-size: 14px; font-weight: 400; color: #000; padding: 0px 20px 10px 0px; text-align: right;">
                                    <a style="color: #c53d3d; text-decoration: none;"
                                        href="mailto:{{$billingPricingData->email}}">{{$billingPricingData->email}}</a>
                                </td>
                            </tr>
                            <tr>
                                <th
                                    style="font-size: 14px; font-weight: 600; padding: 0px 0px 10px 20px; text-align: left;">
                                    Booking Date</th>
                                <td
                                    style="font-size: 14px; font-weight: 400; color: #000; padding: 0px 20px 10px 0px; text-align: right;">
                                    Monday, Jul 14,2025 </td>
                            </tr>
                            <tr>
                                <th
                                    style="font-size: 14px; font-weight: 600; padding: 0px 0px 10px 20px; text-align: left;">
                                    Airline Ref</th>
                                <td
                                    style="font-size: 14px; font-weight: 400; color: #000; padding: 0px 20px 10px 0px; text-align: right;">
                                    DBD60B </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <!------Passenger -------->
            <tr>
                <td colspan="2" style="padding: 30px 30px 0px 30px;">
                    <div
                        style="border: 2px solid #c53d3d; border-radius: 10px; border-collapse: collapse; overflow: hidden;">
                        <table style="width: 100%; border-radius: 10px; border-collapse: collapse;">
                            <tr>
                                <th colspan="4"
                                    style="font-size: 16px; font-weight: 600; color: #fff; background-color: #c53d3d; padding: 12px 10px;">
                                    <span> <img style="margin-bottom: -2px;" width="16"
                                            src="{{asset('email-templates/detail.png')}}" alt="details"> </span>
                                    Passenger Details
                                </th>
                            </tr>
                            <tr>
                                <th style="font-size: 14px; font-weight: 600; padding: 10px 20px; text-align: left;">
                                    Type</th>
                                <th style="font-size: 14px; font-weight: 600; padding: 10px 20px; text-align: left;">
                                    Passenger Name</th>
                                <th style="font-size: 14px; font-weight: 600; padding: 10px 20px; text-align: left;">
                                    Seat</th>
                                <th style="font-size: 14px; font-weight: 600; padding: 10px 20px; text-align: left;">
                                    E-Ticket</th>

                            </tr>
                            @foreach($booking->passengers as $key=>$passengers)
                            <tr>
                                <td
                                    style="font-size: 14px; font-weight: 400; color: #000; padding: 0px 20px 10px 20px; text-align: left;">
                                    {{$passengers->passenger_type}} </td>
                                <td
                                    style="font-size: 14px; font-weight: 400; color: #000; padding: 0px 0px 10px 20px; text-align: left;">
                                    {{$passengers->title}} {{$passengers->first_name}} {{$passengers->middle_name}}
                                    {{$passengers->last_name}} </td>
                                <td
                                    style="font-size: 14px; font-weight: 400; color: #000; padding: 0px 20px 10px 20px; text-align: left;">
                                    {{$passengers->seat_number}} </td>
                                <td
                                    style="font-size: 14px; font-weight: 400; color: #000; padding: 0px 20px 10px 20px; text-align: left;">
                                    {{$passengers->e_ticket_number}} </td>
                            </tr>
                            @endforeach

                        </table>
                    </div>
                </td>
            </tr>
            <!-------Price ---------->

            <tr>
                <td colspan="2" style="padding: 30px 30px 0px 30px;">
                    <div
                        style="border: 2px solid #c53d3d; border-radius: 10px; border-collapse: collapse; overflow: hidden;">
                        <table style="width: 100%; border-radius: 10px; border-collapse: collapse;">
                            <tr>
                                <th colspan="2"
                                    style="font-size: 16px; font-weight: 600; color: #fff; background-color: #c53d3d; padding: 12px 10px;">
                                    <span> <img style="margin-bottom: -2px;" width="16"
                                            src="{{asset('email-templates/coin.png')}}" alt="dollor"> </span>
                                    Price Details (USD)
                                </th>
                            </tr>

                            <tr>
                                <th style="font-size: 14px; font-weight: 600; padding: 10px 20px; text-align: left;">
                                    Total Price per person including taxes and fees</th>
                                <td
                                    style="font-size: 16px; font-weight: 400; color: #119516; padding: 10px 20px; text-align: right;">
                                    {{ number_format($billingPricingData->authorized_amt, 2) }}</td>
                            </tr>
                            <tr>
                                <th
                                    style="font-size: 14px; font-weight: 600; padding: 0px 0px 10px 20px; text-align: left;">
                                    Total Price for Entire Itinerary including taxes and fees</th>
                                <td
                                    style="font-size: 16px; font-weight: 400; color: #119516; padding: 0px 20px 10px 0px; text-align: right;">
                                    {{ number_format($billingPricingData->authorized_amt, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 30px 30px 0px 30px;">
                    <div
                        style="border: 2px solid #c53d3d; border-radius: 10px; border-collapse: collapse; overflow: hidden;">
                        <table style="width: 100%; border-radius: 10px; border-collapse: collapse;">
                            <tr>
                                <th colspan="2"
                                    style="font-size: 16px; font-weight: 600; color: #fff; background-color: #c53d3d; padding: 12px 10px;">
                                    <span> <img style="margin-bottom: 0px;" width="16"
                                            src="{{asset('email-templates/information.png')}}" alt="info"> </span>
                                    Please Note:
                                </th>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <ol style="padding-left: 30px; padding-top: 10px;">
                                        <li style="font-size: 12px; font-weight: 400; color: #000;">
                                            <strong>All transactions</strong> will be processed in US Dollars (USD). If
                                            your card was issued in a country other than the USA, your card issuer may
                                            charge a currency conversion fee of up to 4% of the total amount charged.
                                            Kindly check with your financial institution for more information.
                                        </li>
                                        <li style="font-size: 12px; font-weight: 400; color: #000;">
                                            Please be informed that your card may be billed with a single authorization
                                            of <strong>$0.00 USD</strong>, which may appear on your card statement as
                                            <em>Flydreams</em>, <em>FareTicketsLLC</em>, or <em>Cruiseline Service</em>.
                                        </li>
                                    </ol>
                                    <p style="font-size: 12px; font-weight: 400; color: #000; padding-left: 20px;">
                                        <strong>Prices are not guaranteed</strong> until the ticket number(s) are
                                        issued.
                                        Prices may change based on airline inventory availability.
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>




            <tr>
                <td colspan="2" style="text-align:center; padding-bottom: 20px; padding-top: 10px;"><button
                        class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signatureModal">Add
                        Signature</button></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="signaturePreview" class="signature-preview d-none">No signature added.</div>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align:center; padding-bottom: 20px;">
                    <form id="authorizationForm" method="POST" action="{{ route('signature.store') }}">
                        @csrf

                        <input type="hidden" name="card_id" id="card_id" value="{{ $card_id }}">
                        <input type="hidden" name="card_billing_id" id="card_billing_id" value="{{ $card_billing_id }}">
                        <input type="hidden" name="refund_status" id="refund_status" value="{{ $refund_status }}">
                        <input type="hidden" name="signature" id="signatureData">
                        <input type="hidden" name="signature_type" id="signatureType">
                        <input type="hidden" name="booking_id" id="booking_id" value="{{ request()->segment(2) }}">

                        <div style="margin-top: 10px;">
                            <label>
                                <input type="checkbox" id="termsCheckbox" required>
                                <a style="text-decoration: none;" href="{{ route('terms-and-conditions') }}"
                                    target="_blank"> I have read and agree to the Terms and Conditions </a>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-success mt-3" id="authorizeButton" disabled>
                            I Authorized
                        </button>
                    </form>
                </td>
            </tr>



        </tbody>
        <tfoot style="background-color: #c53d3d;">
            <tr>
                <td colspan="2" style="padding: 10px 0px;">
                    <span style="display: flex; align-items: center; justify-content: center;">
                        <img style="margin-right: 10px;" width="20" src="{{asset('email-templates/facebook.png')}}"
                            alt="facebook">
                        <img style="margin-right: 10px;" width="20" src="{{asset('email-templates/linkedin.png')}}"
                            alt="linkdin">
                        <img style="margin-right: 10px;" width="20" src="{{asset('email-templates/instagram.png')}}"
                            alt="instagram">
                        <img style="margin-right: 10px;" width="20" src="{{asset('email-templates/twitter.png')}}"
                            alt="twitter">
                    </span>
                    <span
                        style="font-size: 16px; font-weight: 400; color: #fff; text-align: center; display: block; padding-top: 6px;">©
                        All Rights Reserved.</span>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>



<!-- ============================================================================================================================= -->


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
                        <button class="nav-link" id="type-tab" data-bs-toggle="tab" data-bs-target="#type" type="button"
                            role="tab" aria-controls="type" aria-selected="false">Type</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
            document.getElementById('signatureType').value = 'draw'; // set signature type
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
            document.getElementById('signatureType').value = 'type'; // set signature type
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

function showToast(message, type = "success") {
    const toastId = `toast-${Date.now()}`;

    const styleMap = {
        success: {
            bgColor: "#28a745", // Bootstrap green
            textColor: "#ffffff",
            icon: "✔", // Unicode check mark
            borderColor: "#218838"
        },
        error: {
            bgColor: "#dc3545", // Bootstrap red
            textColor: "#ffffff",
            icon: "⚠",
            borderColor: "#c82333"
        }
    };

    const style = styleMap[type] || styleMap.success;

    const toast = document.createElement("div");
    toast.id = toastId;
    toast.className = "toast-container toast-enter";
    toast.setAttribute("role", "alert");

    toast.style.cssText = `
        background-color: ${style.bgColor};
        color: ${style.textColor};
        border: 1px solid ${style.borderColor};
        padding: 14px 20px;
        border-radius: 4px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        font-family: 'Segoe UI', sans-serif;
        font-size: 16px;
        display: flex;
        align-items: center;
        max-width: 340px;
        z-index: 9999;
        position: fixed;
        top: 20px;
        right: 20px;
    `;

    toast.innerHTML = `
        <div style="display: flex; align-items: center;">
            <strong style="font-size: 18px;">${style.icon}</strong>
            <span style="margin-left: 10px;">${message}</span>
        </div>
    `;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.remove("toast-enter");
        toast.classList.add("toast-exit");
        toast.addEventListener("animationend", () => toast.remove());
    }, 4500);
}
$('#authorizationForm').submit(function(e) {
    e.preventDefault();
    const formdata = new FormData(e.target);
    const href = e.target.action;
    $.ajax({
        url: href,
        type: 'POST',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(data) {
            showToast(data.message);
            $('#authorizeButton').remove();
        },
        error: function(data) {
            showToast(data.responseJSON.message);
        }
    });
});
</script>