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
                <th style="text-align: left; padding: 10px 0px 10px 30px;"> <img width="80"
                        src="{{asset('email-templates/logo.png')}}" alt="logo">
                </th>
                <th style="padding: 10px 30px 10px 0px;"> <span
                        style="display: flex; align-items: center; justify-content: end;"><img
                            style="margin-right: 10px;" width="20" src="{{asset('email-templates/call.png')}}"
                            alt="call"> <a
                            style="font-size: 18px; font-weight: 600; color: #c53d3d; text-decoration: none;"
                            href="tel:+1-844-382-2225">+1-844-382-2225</a></span> </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" style="padding: 0px;"> <img style="height: 300px; width: 100%; object-fit: cover;"
                        src="{{asset('email-templates/flight-banner.png')}}" alt="Banner"> </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 16px; font-weight: 600; padding: 10px 30px 0px 30px;">Dear Zee,</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #787878; padding: 5px 30px 0px 30px;">
                    Thank you
                    for using fareticketsllc for your travel needs. Please take a moment to review the names, date,
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
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #787878; padding: 5px 30px 0px 30px;">
                    Team <a style="color: #c53d3d; text-decoration: none;" href="#">Fareticketsllc</a></td>
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
                                    2000.00</td>
                            </tr>
                            <tr>
                                <th
                                    style="font-size: 14px; font-weight: 600; padding: 0px 0px 10px 20px; text-align: left;">
                                    Total Price for Entire Itinerary including taxes and fees</th>
                                <td
                                    style="font-size: 16px; font-weight: 400; color: #119516; padding: 0px 20px 10px 0px; text-align: right;">
                                    2000.00 </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
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
                <td colspan="2" style="font-size: 18px; font-weight: 700; padding: 30px 30px 10px 30px;">General Flight
                    Terms and Conditions</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    Thank you
                    for using fareticketsllc for your travel needs. Please take a moment to review the names, date,
                    Flight itinerary, price and other relevant details of your booking.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 16px; font-weight: 600; padding: 10px 30px 0px 30px;">General
                    Conditions</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #c53d3d; padding: 5px 30px 0px 30px;">
                    Important Note : Tickets are Non-Refundable/Non-Transferable and name changes are not permitted.
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    <span style="font-weight: 600;">NOTE :</span> Date and routing changes will be subject to Airline
                    Penalty and Fare Difference if any</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">For
                    any modification or changes please contact our Travel Consultant on +1-844-382-2225</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">All
                    customers are advised to verify travel documents (transit visa/entry visa) for the country through
                    which they are transiting and/or entering. fareticketsllc will not be responsible if proper travel
                    documents are not available and you are denied entry or transit into a Country. We request you to
                    consult the embassy of the country(s) you are visiting or transiting through.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">For
                    any modification or any other query please contact our Travel Consultant on +1-844-382-2225.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #000; padding: 5px 30px 40px 30px;">
                    fareticketsllc provides its services, products, and contents either through the phone service or
                    website. This is a legal agreement between you and fareticketsllc. You must read all the information
                    carefully as you agree to these terms and conditions while accessing or using any services or
                    products or contents of fareticketsllc.</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center; padding-bottom: 20px;"><button class="btn btn-primary"
                        data-bs-toggle="modal" data-bs-target="#signatureModal">Add
                        Signature</button></td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 20px 0px;"><div id="signaturePreview" class="signature-preview d-none">No signature added.</div></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center; padding-bottom: 20px;">
                    <form id="authorizationForm" method="POST" action="{{ route('signature.store') }}">
                        @csrf
                        <input type="hidden" name="signature" id="signatureData">
                        <input type="hidden" name="signature_type" id="signatureType">
                        <input type="hidden" name="booking_id" id="booking_id" value="{{ request()->segment(2) }}">
                        <button type="submit" class="btn btn-success mt-3" id="authorizeButton" disabled>I
                            Authorized</button>
                    </form>
                </td>
            </tr>
        </tbody>
        <tfoot style="background-color: #c53d3d;">
            <tr>
                <td colspan="2" style="padding: 30px 0px;">
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
                        style="font-size: 16px; font-weight: 400; color: #fff; text-align: center; display: block; padding-top: 20px;">©
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
    </script>