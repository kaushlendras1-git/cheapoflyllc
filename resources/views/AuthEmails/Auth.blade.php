<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Auth</title>
</head>
@php
$bookingTypes = $booking->bookingTypes->pluck('type')->toArray();
@endphp
<body style="margin: 0px; padding: 0px;">
    <table style="font-family: 'Work Sans', sans-serif; width: 50%; background-color: #fff3f3; margin: auto; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="text-align: left; padding: 10px 0px 10px 30px;"> <img width="80" src="https://people.sau.int/email-templates/logo.png" alt="logo">
                </th>
                <th style="padding: 10px 30px 10px 0px;"> <span
                        style="display: flex; align-items: center; justify-content: end;"><img
                            style="margin-right: 10px;" width="20" src="https://people.sau.int/email-templates/call.png" alt="call"> <a
                            style="font-size: 18px; font-weight: 600; color: #c53d3d; text-decoration: none;"
                            href="tel:+1-844-382-2225">+1-844-382-2225</a></span> </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" style="padding: 0px;"> <img style="height: 300px; width: 100%; object-fit: cover;" src="https://people.sau.int/email-templates/flight-banner.png" alt="Banner"> </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 16px; font-weight: 600; padding: 10px 30px 0px 30px;">Dear {{ $booking->name }},</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #787878; padding: 5px 30px 0px 30px;">Thank you
                    for using fareticketsllc for your travel needs. Please take a moment to review the names, date,
                    Flight itinerary, price and other relevant details of your booking.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #787878; padding: 5px 30px 0px 30px;">Team <a
                        style="color: #c53d3d; text-decoration: none;" href="#">Fareticketsllc</a></td>
            </tr>
            <tr>
                <td style="font-size: 16px; font-weight: 600; text-align: center; padding: 0px 0px 0px 30px;">
                        <span style="display: inline-block; background-color: #fff; padding: 20px; border-radius: 10px; margin-top: 20px;">
                        <span style="display: block; margin-bottom: 10px;"> <img width="40" src="https://people.sau.int/email-templates/sku.png" alt="Number"> </span>
                        Booking Reference Number
                        <span style="font-size: 14px; font-weight: 400; display: block; color: #000; padding-top: 10px;">{{ $booking->pnr }}Customer Information</span></span>
                </td>
                <td style="font-size: 16px; font-weight: 600; text-align: center; padding: 0px 30px 0px 0px;">
                    <span style="display: inline-block; background-color: #fff; padding: 20px 65px; border-radius: 10px; margin-top: 20px;">
                        <span style="display: block; margin-bottom: 10px;"> <img width="40" src="https://people.sau.int/email-templates/event.png" alt="Number"> </span>
                        Booking Date
                        <span style="font-size: 14px; font-weight: 400; display: block; color: #000; padding-top: 10px;">Monday,
                            Jul 14,2025</span></span> </td>
            </tr>
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
                                    style="font-size: 16px; font-weight: 400; color: #000; padding: 10px 20px; text-align: right;">
                                    {{$billingPricingData->cc_holder_name}}</td>
                            </tr>
                            <tr>
                                <th style="font-size: 14px; font-weight: 600; padding: 10px 20px; text-align: left;">
                                    Card Holder Number</th>
                                <td
                                    style="font-size: 16px; font-weight: 400; color: #000; padding: 10px 20px; text-align: right;">
                                    {{encode($billingPricingData->cc_number)}}</td>
                            </tr>
                            
                            <tr>
                                <th
                                    style="font-size: 14px; font-weight: 600; padding: 0px 0px 10px 20px; text-align: left;">
                                    Email</th>
                                <td
                                    style="font-size: 16px; font-weight: 400; color: #000; padding: 0px 20px 10px 0px; text-align: right;">
                                    <a style="color: #c53d3d; text-decoration: none;"
                                        href="mailto:{{$billingPricingData->email}}">{{$billingPricingData->email}}</a> </td>
                            </tr>
                            <tr>
                                <th
                                    style="font-size: 14px; font-weight: 600; padding: 0px 0px 10px 20px; text-align: left;">
                                    Booking Date</th>
                                <td
                                    style="font-size: 16px; font-weight: 400; color: #000; padding: 0px 20px 10px 0px; text-align: right;">
                                    Monday, Jul 14,2025 </td>
                            </tr>
                            <tr>
                                <th
                                    style="font-size: 14px; font-weight: 600; padding: 0px 0px 10px 20px; text-align: left;">
                                    Airline Ref</th>
                                <td
                                    style="font-size: 16px; font-weight: 400; color: #000; padding: 0px 20px 10px 0px; text-align: right;">
                                    DBD60B </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 30px 30px 0px 30px;">
                    <div style="border: 2px solid #c53d3d; border-radius: 10px; border-collapse: collapse; overflow: hidden;">
                        <table style="width: 100%; border-radius: 10px; border-collapse: collapse;">
                            <tr>
                                <th colspan="2"
                                    style="font-size: 16px; font-weight: 600; color: #fff; background-color: #c53d3d; padding: 12px 10px;">
                                    <span> <img style="margin-bottom: -2px;" width="16" src="https://people.sau.int/email-templates/detail.png" alt="details"> </span>
                                    Passenger Details</th>
                            </tr>
                            <tr>
                                <th style="font-size: 14px; font-weight: 600; padding: 10px 20px; text-align: left;">Passenger Name</th>
                                <th style="font-size: 14px; font-weight: 600; padding: 10px 20px; text-align: right;">Type</th>
                            </tr>
                            @foreach($booking->passengers as $key=>$passengers)
                            <tr>
                                <td
                                    style="font-size: 16px; font-weight: 400; color: #000; padding: 0px 0px 10px 20px; text-align: left;">
                                   {{$passengers->title}} {{$passengers->first_name}} {{$passengers->middle_name}} {{$passengers->last_name}} </td>
                                <td
                                    style="font-size: 16px; font-weight: 400; color: #000; padding: 0px 20px 10px 0px; text-align: right;">
                                    {{$passengers->passenger_type}} </td>
                            </tr>
                            @endforeach

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
                                <th colspan="2"
                                    style="font-size: 16px; font-weight: 600; color: #fff; background-color: #c53d3d; padding: 12px 10px;">
                                    <span> <img style="margin-bottom: -2px;" width="16"
                                            src="{{asset('email-templates/detail.png')}}" alt="details"> </span>
                                    Passenger Details
                                </th>
                            </tr>
                            <tr>
                                <th style="font-size: 14px; font-weight: 600; padding: 10px 20px; text-align: left;">
                                    Passenger Name</th>
                                <th style="font-size: 14px; font-weight: 600; padding: 10px 20px; text-align: right;">
                                    Type</th>
                            </tr>
                              @foreach($booking->passengers as $key=>$passengers)
                            <tr>
                                <td
                                    style="font-size: 16px; font-weight: 400; color: #000; padding: 0px 0px 10px 20px; text-align: left;">
                                   {{$passengers->title}} {{$passengers->first_name}} {{$passengers->middle_name}} {{$passengers->last_name}} </td>
                                <td
                                    style="font-size: 16px; font-weight: 400; color: #000; padding: 0px 20px 10px 0px; text-align: right;">
                                    {{$passengers->passenger_type}} </td>
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
              <!-------------Flight --------------->
            @if(in_array('Flight', $bookingTypes))
            <tr>
                <td colspan="2" style="padding: 30px 30px 0px 30px;">
                    <div
                        style="border: 2px solid #c53d3d; border-radius: 10px; border-collapse: collapse; overflow: hidden;">
                        <table style="width: 100%; border-radius: 10px; border-collapse: collapse;">
                            <tr>
                                <th colspan="13"
                                    style="font-size: 16px; font-weight: 600; color: #fff; background-color: #c53d3d; padding: 12px 10px;">
                                    <span> <img style="margin-bottom: -2px;" width="25"
                                            src="{{asset('email-templates/plane.png')}}" alt="plain"> </span>
                                    Flight Booking Details
                                </th>
                            </tr>
                            @if($booking->travelFlight->isNotEmpty())

                            <tr>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Direction</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Date</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    AL (Code)</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Flight No</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Cabin</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    CL</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Departure Airport</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Hrs:MM</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Arrival Airport</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Hrs:MM</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Duration</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Transit</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Arrival Date</th>
                            </tr>

                            @foreach($booking->travelFlight as $index => $flight)
                            <tr>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$flight->direction}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$flight->departure_date?->format('Y-m-d')}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$flight->airline_code}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$flight->flight_number}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$flight->cabin}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$flight->class_of_service}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$flight->departure_airport}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$flight->departure_hours}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$flight->arrival_airport}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    06: 15 PM</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    2 hrs</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    ....</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 0px 20px 10px 0px;">
                                    08/04/2025 </td>
                            </tr>
                            @endforeach

                            @if($flight_images)
                            @foreach ($flight_images as $key => $img)
                            <tr>
                                <td colspan="13">
                                    <img src="{{ asset($img->file_path) }}" class="img-thumbnail">
                                </td>
                                @endforeach
                                @endif
                                @endif
                        </table>
                    </div>
                </td>
            </tr>
            @endif

            @if(in_array('Hotel', $bookingTypes))
            <tr>
                <td colspan="2" style="padding: 30px 30px 0px 30px;">
                    <div
                        style="border: 2px solid #c53d3d; border-radius: 10px; border-collapse: collapse; overflow: hidden;">
                        <table style="width: 100%; border-radius: 10px; border-collapse: collapse;">
                            <tr>
                                <th colspan="8"
                                    style="font-size: 16px; font-weight: 600; color: #fff; background-color: #c53d3d; padding: 12px 10px;">
                                    <span> <img style="margin-bottom: -2px;" width="20"
                                            src="{{asset('email-templates/hotel.png')}}" alt="hotel"> </span>
                                    Hotel Booking Details
                                </th>
                            </tr>
                            @if($booking->travelHotel->isNotEmpty())
                            <tr>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Hotel Name</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Room Category</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Check-in Date</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Check-out Date</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    No. Of Rooms</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Confirmation Number</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Hotel Address</th>
                            </tr>
                            @foreach($booking->travelHotel as $key=>$travelHotel)
                            <tr>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelHotel->hotel_name}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelHotel->room_category}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelHotel->checkin_date?->format('Y-m-d')}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelHotel->checkout_date?->format('Y-m-d')}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelHotel->no_of_rooms}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelHotel->confirmation_number}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelHotel->hotel_address}}</td>
                            </tr>
                            @endforeach
                            @foreach ($hotel_images as $key => $img)
                            <tr>
                                <td colpan="7"><img width="50" src="{{ asset($img->file_path) }}" class="img-thumbnail"
                                        style="max-height: 100px;" alt="Flight Image"></td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </td>
            </tr>
            @endif

            @if(in_array('Cruise', $bookingTypes))
            <tr>
                <td colspan="2" style="padding: 30px 30px 0px 30px;">
                    <div
                        style="border: 2px solid #c53d3d; border-radius: 10px; border-collapse: collapse; overflow: hidden;">
                        <table style="width: 100%; border-radius: 10px; border-collapse: collapse;">
                            <tr>
                                <th colspan="10"
                                    style="font-size: 16px; font-weight: 600; color: #fff; background-color: #c53d3d; padding: 12px 10px;">
                                    <span> <img style="margin-bottom: -2px;" width="25"
                                            src="{{asset('email-templates/cruise.png')}}" alt="cruise"> </span>
                                    Cruise Booking Details
                                </th>
                            </tr>
                            <tr>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Cruise Line</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Name of the Ship</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Category</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Stateroom</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Departure Port</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Departure Date</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Hrs:MM</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Arrival Port</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Arrival Date</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Hrs:MM</th>
                            </tr>
                            @foreach($booking->travelCruise as $key=>$travelCruise)
                            <tr>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCruise->cruise_line}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCruise->ship_name}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCruise->category}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCruise->stateroom}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCruise->departure_port}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCruise->departure_date?->format('Y-m-d')}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCruise->departure_hrs}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCruise->arrival_port}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCruise->arrival_date?->format('Y-m-d')}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCruise->arrival_hrs}}</td>
                            </tr>
                            @endforeach

                            @if($cruise_images)
                            @foreach ($cruise_images as $key => $img)
                            <tr>
                                <td colspan="10"><img width="50" src="{{ asset($img->file_path) }}"
                                        class="img-thumbnail"></td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </td>
            </tr>
            @endif

            @if(in_array('Car', $bookingTypes))
            <tr>
                <td colspan="2" style="padding: 30px 30px 0px 30px;">
                    <div
                        style="border: 2px solid #c53d3d; border-radius: 10px; border-collapse: collapse; overflow: hidden;">
                        <table style="width: 100%; border-radius: 10px; border-collapse: collapse;">
                            <tr>
                                <th colspan="11"
                                    style="font-size: 16px; font-weight: 600; color: #fff; background-color: #c53d3d; padding: 12px 10px;">
                                    <span> <img style="margin-bottom: -2px;" width="25"
                                            src="{{asset('email-templates/car.png')}}" alt="car"> </span>
                                    Car Booking Details
                                </th>
                            </tr>
                            <tr>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Car Rental Provider</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Car Type</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Pick-up Location</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Drop-off Location</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Pick-up Date</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Pick-up Time</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Drop-off Date</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Drop-off Time</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Confirmation Number</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Rental Provider's Address</th>
                            </tr>
                            @foreach($booking->travelCar as $key=>$travelCar)
                            <tr>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCar->car_rental_provider}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCar->car_type}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCar->pickup_location}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCar->dropoff_location}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCar->pickup_date?->format('Y-m-d')}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCar->pickup_time}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCar->dropoff_date?->format('Y-m-d')}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCar->dropoff_time}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCar->confirmation_number}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$travelCar->rental_provider_address}}</td>
                            </tr>
                            @endforeach

                            @if($car_images)
                            @foreach ($car_images as $key => $img)
                            <tr>
                                <td colspan="10"><img src="{{ asset($img->file_path) }}" class="img-thumbnail"></td>
                            </tr>
                            @endforeach
                            @endif


                        </table>
                    </div>
                </td>
            </tr>
            @endif

            @if(in_array('Train', $bookingTypes))
            <tr>
                <td colspan="2" style="padding: 30px 30px 0px 30px;">
                    <div
                        style="border: 2px solid #c53d3d; border-radius: 10px; border-collapse: collapse; overflow: hidden;">
                        <table style="width: 100%; border-radius: 10px; border-collapse: collapse;">
                            <tr>
                                <th colspan="13"
                                    style="font-size: 16px; font-weight: 600; color: #fff; background-color: #c53d3d; padding: 12px 10px;">
                                    <span> <img style="margin-bottom: -3px;" width="13"
                                            src="{{asset('email-templates/train.png')}}" alt="train"> </span>
                                    Train Booking Details
                                </th>
                            </tr>
                            <tr>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Direction</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Date</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Train No</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Cabin</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Departure station</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Hrs/MM</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Arrival station</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Hrs/MM</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Duration</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Transit</th>
                                <th style="font-size: 12px; font-weight: 600; text-align: center; padding: 10px 10px;">
                                    Arival Date</th>
                            </tr>
                            @foreach($booking->trainBookingDetails as $key=>$trainBookingDetails)
                            <tr>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$trainBookingDetails->direction}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$trainBookingDetails->departure_date?->format('Y-m-d')}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$trainBookingDetails->train_number}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$trainBookingDetails->cabin}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$trainBookingDetails->departure_station}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$trainBookingDetails->departure_hours}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$trainBookingDetails->arrival_station}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$trainBookingDetails->arrival_hours}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$trainBookingDetails->duration}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$trainBookingDetails->transit}}</td>
                                <td
                                    style="font-size: 12px; font-weight: 400; text-align: center; color: #000; padding: 10px 10px;">
                                    {{$trainBookingDetails->arrival_date?->format('Y-m-d')}}</td>
                            </tr>
                            @endforeach

                            @if($train_images)
                            @foreach ($train_images as $key => $img)
                            <tr>
                                <td><img src="{{ asset($img->file_path) }}" class="img-thumbnail"></td>
                            </tr>
                            @endforeach
                            @endif

                        </table>
                    </div>
                </td>
            </tr>
            @endif

            <tr>
                <td colspan="2" style="font-size: 18px; font-weight: 700; padding: 30px 30px 10px 30px;">General Flight Terms and Conditions</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">Thank you
                    for using fareticketsllc for your travel needs. Please take a moment to review the names, date,
                    Flight itinerary, price and other relevant details of your booking.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 16px; font-weight: 600; padding: 10px 30px 0px 30px;">General Conditions</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #c53d3d; padding: 5px 30px 0px 30px;">Important Note : Tickets are Non-Refundable/Non-Transferable and name changes are not permitted.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;"><span style="font-weight: 600;">NOTE :</span> Date and routing changes will be subject to Airline Penalty and Fare Difference if any</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">For any modification or changes please contact our Travel Consultant on +1-844-382-2225</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">All customers are advised to verify travel documents (transit visa/entry visa) for the country through which they are transiting and/or entering. fareticketsllc will not be responsible if proper travel documents are not available and you are denied entry or transit into a Country. We request you to consult the embassy of the country(s) you are visiting or transiting through.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">For any modification or any other query please contact our Travel Consultant on +1-844-382-2225.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #000; padding: 5px 30px 40px 30px;">fareticketsllc provides its services, products, and contents either through the phone service or website. This is a legal agreement between you and fareticketsllc. You must read all the information carefully as you agree to these terms and conditions while accessing or using any services or products or contents of fareticketsllc.</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center; padding: 30px 30px 20px 30px;">
                    <a href="{{ $buttonRoute }}"
                       style="
                display: inline-block;
                background-color: #c53d3d;
                color: #fff;
                font-size: 16px;
                font-weight: 700;
                text-decoration: none;
                padding: 12px 32px;
                border-radius: 6px;
                margin-top: 15px;
            "
                       target="_blank"
                    >
                        Complete Authorization
                    </a>
                </td>
            </tr>
        </tbody>
        <tfoot style="background-color: #c53d3d;">
            <tr>
                <td colspan="2" style="padding: 30px 0px;">
                    <span style="display: flex; align-items: center; justify-content: center;">
                        <img style="margin-right: 10px;" width="20" src="https://people.sau.int/email-templates/facebook.png" alt="facebook">
                        <img style="margin-right: 10px;" width="20" src="https://people.sau.int/email-templates/linkedin.png" alt="linkdin">
                        <img style="margin-right: 10px;" width="20" src="https://people.sau.int/email-templates/instagram.png" alt="instagram">
                        <img style="margin-right: 10px;" width="20" src="https://people.sau.int/email-templates/twitter.png" alt="twitter">
                    </span>
                    <span style="font-size: 16px; font-weight: 400; color: #fff; text-align: center; display: block; padding-top: 20px;">© All Rights Reserved.</span>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
