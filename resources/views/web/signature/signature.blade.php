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
                <td colspan="2" style="padding: 0px;"> 
                    @if($bookingTypes[0] == 'Flight')
                        <img style="height: 300px; width: 100%; object-fit: cover;" src="{{asset('email-templates/flight-banner.png')}}" alt="flight">
                    @elseif($bookingTypes[0] == 'Cruise')
                         <img style="height: 300px; width: 100%; object-fit: cover;" src="{{asset('email-templates/cruise.jpeg')}}" alt="cruise">
                    @elseif($bookingTypes[0] == 'Train')
                         <img style="height: 300px; width: 100%; object-fit: cover;" src="{{asset('email-templates/amtrak.jpeg')}}" alt="amtrak">     
                    @elseif($bookingTypes[0] == 'Car')
                         <img style="height: 300px; width: 100%; object-fit: cover;" src="{{asset('email-templates/car.jpeg')}}" alt="car">     
                     @elseif($bookingTypes[0] == 'Hotel')
                         <img style="height: 300px; width: 100%; object-fit: cover;" src="{{asset('email-templates/hotel.jpeg')}}" alt="hotel">     
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 16px; font-weight: 600; padding: 10px 30px 0px 30px;">Dear Zee,</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 400; color: #787878; padding: 5px 30px 0px 30px;">
                    Thank you
                    for using {{ $booking->selected_company_name }} for your travel needs. Please take a moment to review the names, date,
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
                    Team <a style="color: #c53d3d; text-decoration: none;" href="#">{{ $booking->selected_company_name }}</a></td>
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
                                <th style="font-size: 14px; font-weight: 600; padding: 10px 20px; text-align: left;">
                                    Card Number</th>
                                <td
                                    style="font-size: 16px; font-weight: 400; color: #000; padding: 10px 20px; text-align: right;">
                                
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
            
                            @if($booking->travelFlight->isNotEmpty())

                            

                            @foreach($booking->travelFlight as $index => $flight)
                               

                                <!-------Flight-------------->
                                <tr>
                                    <td colspan="2" style="padding: 30px 30px 0px 30px;">

                                        <table
                                            style="font-family: 'Work Sans', sans-serif; width: 100%; background-color: #f8f8f8; margin: auto; margin-top: 20px;">
                                            <tr>
                                                <td>
                                                    <table style="width: 100%; padding: 20px;">
                                                        <tr>
                                                            <td style="vertical-align: text-top;"> <span><img width="30"
                                                                        src="{{asset('email-templates/flight-icon.png')}}" alt="icon-flight"></span> </td>
                                                            <td>
                                                                <p
                                                                    style="font-size: 20px; font-weight: 600; color: #000; margin-bottom: 20px; margin-top: 0px; margin-left: 34px;">
                                                                        @if($flight->direction == 'Outbound') Departing flight @endif
                                                                         @if($flight->direction == 'Inbound') Return flight @endif
                                                                     . {{ $flight->departure_date?->format('D, M j') }}</p>
                                                                <div style="display: flex; align-items: self-start;">
                                                                    <div>
                                                                        <!-- Vertical dots with large circles at ends -->
                                                                        <svg width="26" height="87" viewBox="0 0 26 87"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <defs>
                                                                                <style>
                                                                                    .dot {
                                                                                        fill: #d9d9d9;
                                                                                    }

                                                                                    .ring {
                                                                                        fill: none;
                                                                                        stroke: #d9d9d9;
                                                                                        stroke-width: 2;
                                                                                    }
                                                                                </style>
                                                                            </defs>
                                                                            <circle class="ring" cx="13" cy="16" r="6" />
                                                                            <circle class="dot" cx="13" cy="28" r="2" />
                                                                            <circle class="dot" cx="13" cy="37" r="2" />
                                                                            <circle class="dot" cx="13" cy="46" r="2" />
                                                                            <circle class="dot" cx="13" cy="54" r="2" />
                                                                            <circle class="dot" cx="13" cy="63" r="2" />
                                                                            <circle class="ring" cx="13" cy="75" r="6" />
                                                                        </svg>
                                                                    </div>
                                                                    <div style="padding-left: 10px;">
                                                                        <p
                                                                            style="font-size: 16px; font-weight: 600; color: #000; margin-bottom: 5px; margin-top: 0px;">
                                                                            {{$flight->departure_hours}} . {{$flight->departure_airport}}</p>
                                                                        <p
                                                                            style="font-size: 14px; font-weight: 400; margin-top: 0px; color: #70757a;">
                                                                            Travel time: {{$flight->duration}}</p>
                                                                        <p
                                                                            style="font-size: 16px; font-weight: 600; color: #000; margin-bottom: 5px; margin-top: 0px;">
                                                                            {{$flight->arrival_hours}} . {{$flight->arrival_airport}}</p>
                                                                        <p
                                                                            style="font-size: 14px; font-weight: 400; margin-top: 0px; color: #70757a;">
                                                                            {{$flight->airline_code}} {{$flight->cabin}}  {{$flight->flight_number}}</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            
                                                           
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>
                                               @php
                                                    if($flight->transit){
                                                        $time = $flight->transit ?? '00:00'; // Default to 00:00 if null
                                                        $parts = explode(':', $time, 2);

                                                        $hours = isset($parts[0]) ? (int)$parts[0] : 0;
                                                        $minutes = isset($parts[1]) ? (int)$parts[1] : 0;

                                                        echo ($hours > 0 ? $hours . ' hr ' : '') . ($minutes > 0 ? $minutes . ' min' : '') . ' Layover';
                                                    }
                                                @endphp

                                                 </td>
                                            </tr>

                                        
                                        @if($index > 0)    
                                            <tr>
                                                <td style="border-top: 1px dashed #e2e2e2">
                                                </td>
                                            </tr>
                                        @endif    

                                        </table>
                                    </td>
                                </tr>
                            @endforeach



                            @if($flight_images)
                                @foreach ($flight_images as $key => $img)
                                    <tr>
                                        <td colspan="13">
                                            <img src="{{ asset($img->file_path) }}" class="img-thumbnail">
                                        </td>
                                    </tr>    
                                    @endforeach
                            @endif
                        @endif
            @endif


            @if(in_array('Hotel', $bookingTypes))

                    @if($booking->travelHotel->isNotEmpty())
                    
                    
                    @foreach($booking->travelHotel as $key=>$travelHotel)
                        {{$travelHotel->hotel_name}}
                        {{$travelHotel->room_category}}
                        {{$travelHotel->checkin_date?->format('Y-m-d')}}
                        {{$travelHotel->checkout_date?->format('Y-m-d')}}
                        {{$travelHotel->no_of_rooms}}
                        {{$travelHotel->confirmation_number}}
                        {{$travelHotel->hotel_address}}

                         <!-- Start Hotel Details -->
                                <tr>
                                    <td colspan="2" style="padding: 30px 30px 0px 30px;">
                                
                        <table border="0" cellspacing="0" cellpadding="0"
                            style=" font-family: 'Work Sans', sans-serif; width: 100%; background-color: #f8f8f8; margin: auto; border:1px solid #ddd; border-radius:12px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,0.1); margin-top: 20px;">
                            <tr>
                                <!-- Hotel Image -->
                                <td style="width:200px; padding:0; vertical-align:top;">
                                    <img src="{{asset('email-templates/bedroom.jpg')}}" alt="Hotel"
                                        style="width:200px; height:150px; border-top-left-radius:12px; border-bottom-left-radius:12px;">
                                </td>


                                <td style="padding:12px; padding-left: 30px; vertical-align:top;">
                                    <h2 style="margin:0; font-size:18px; color:#333;">citizenM Chicago Downtown</h2>
                                    <p style="margin:4px 0; font-size:13px; color:#555;">Downtown Chicago - Millennium Park</p>

                                    <table cellspacing="0" cellpadding="4" style="margin:6px 0; font-size:13px;">
                                        <tr>
                                            <td
                                                style="background:#f15b2a; color:#fff; font-weight:bold; border-radius:4px; padding:2px 8px;">
                                                8.9</td>
                                            <td style="font-weight:bold; color:#333;">VERY GOOD</td>
                                            <td style="color:#333;">| 4-STAR HOTEL</td>
                                        </tr>
                                    </table>

                                    <p style="margin:6px 0; font-size:13px; color:#28a745; font-weight:bold;">
                                        ✓ Fully Refundable
                                        <span style="font-weight:normal; color:#333;">until 11:59PM (property local time) on Sep 20</span>
                                    </p>
                                </td>
                            </tr>

                            <!-- Booking Info Row -->
                            <tr>
                                <td colspan="2"
                                    style="background:#ebebeb; padding:12px; text-align:center; border-top:1px solid #eee; border-bottom:1px solid #eee;">
                                    <table cellspacing="0" cellpadding="6" style="width:100%; font-size:14px; text-align:center;">
                                        <tr>
                                            <td>
                                                <div style="font-size:12px; color:#888; font-weight:bold;">CHECK-IN</div>
                                                <div style="font-weight:bold;">Mon, Sep 22, 2025</div>
                                            </td>
                                            <td>
                                                <div style="font-size:12px; color:#888; font-weight:bold;">CHECK-OUT</div>
                                                <div style="font-weight:bold;">Wed, Sep 24, 2025</div>
                                            </td>
                                            <td>
                                                <div style="font-size:12px; color:#888; font-weight:bold;">NIGHTS</div>
                                                <div style="font-weight:bold;">2</div>
                                            </td>
                                            <td>
                                                <div style="font-size:12px; color:#888; font-weight:bold;">ROOMS</div>
                                                <div style="font-weight:bold;">1</div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <!-- Room Info -->
                            <tr>
                                <td colspan="2" style="padding:12px;">
                                    <div style="font-weight:bold; margin-bottom:6px;">King Room</div>
                                    <table cellspacing="0" cellpadding="4" style="font-size:13px; color:#333;">
                                        <tr>
                                            <td>🛏️</td>
                                            <td>1 King Bed</td>
                                        </tr>
                                        <tr>
                                            <td>🧊</td>
                                            <td>Fridge</td>
                                        </tr>
                                        <tr>
                                            <td>📶</td>
                                            <td>Free Wifi</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                                    </td>
                                </tr>

                        
                    @endforeach

                    @foreach ($hotel_images as $key => $img)
                    <tr>
                        <td colpan="7"><img width="50" src="{{ asset($img->file_path) }}" class="img-thumbnail"
                                style="max-height: 100px;" alt="Flight Image"></td>
                    </tr>
                    @endforeach
                    @endif
            @endif


            @if(in_array('Cruise', $bookingTypes))
            
          
            <tr>
                <td colspan="2" style="padding: 30px 30px 0px 30px;">                  
                    <table
                        style="font-family: 'Work Sans', sans-serif; width: 100%; background-color: #f8f8f8; margin: auto; margin-top: 20px;">
                        <tr>
                            <td style="width: 50%;">
                                <img style="width: 100%; border-radius: 10px;" src="{{asset('email-templates/cruise-auth.jpg')}}" alt="cruise-img">
                            </td>
                            <td style="width: 50%; vertical-align: top;">
                                <table style="width: 100%; padding: 0px 30px;">
                                    <tr>
                                        <td colspan="2" style="padding-left: 30px; padding-bottom: 20px;"><img
                                                width="100" src="msc-cruise.png" alt="cruise-logo"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px; font-weight: 500; padding-bottom: 10px;">Ship: </td>
                                        <td style="font-size: 16px; font-weight: 400; padding-bottom: 10px;">MSC Divina
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px; font-weight: 500; padding-bottom: 10px;">Lenght:
                                        </td>
                                        <td style="font-size: 16px; font-weight: 400; padding-bottom: 10px;">10 Nights
                                        </td>
                                    </tr>
                                   
                                    
                                    <tr>
                                        <td style="font-size: 16px; font-weight: 500; padding-bottom: 10px;">Departure
                                            Port: </td>
                                        <td style="font-size: 16px; font-weight: 400; padding-bottom: 10px;">Miami</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px; font-weight: 500; padding-bottom: 10px;">Departure
                                            Date: </td>
                                        <td style="font-size: 16px; font-weight: 400; padding-bottom: 10px;">Jan 15 2026
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px; font-weight: 500; padding-bottom: 10px;">Arival
                                            Port: </td>
                                        <td style="font-size: 16px; font-weight: 400; padding-bottom: 10px;">Miami</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px; font-weight: 500; padding-bottom: 10px;">Arival
                                            Date: </td>
                                        <td style="font-size: 16px; font-weight: 400; padding-bottom: 10px;">Jan 25 2026
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>


                    <table border="1" cellspacing="0" cellpadding="10"
                        style="border-collapse:collapse; font-family: 'Work Sans', sans-serif; width: 100%; background-color: #f8f8f8; margin: auto; font-size:14px; text-align:left;">
                        <tr style="background-color:#a8c9f0; font-weight:bold;">
                            <td style="width:25%;">DATE</td>
                            <td style="width:35%;">PORT OF CALL</td>
                            <td style="width:20%;">ARRIVE</td>
                            <td style="width:20%;">DEPART</td>
                        </tr>
                         @foreach($booking->travelCruise as $key=>$travelCruise)
                       
                        <!------------cruise----------------->
                        <tr>
                            <td style="padding:8px;">
                                Monday<br>
                                Jul/28/2025
                            </td>
                            <td style="padding:8px;">Long Beach (Los Angeles), CA</td>
                            <td style="padding:8px;"></td>
                            <td style="padding:8px;">4:00 PM</td>
                        </tr>
                         @endforeach
                    </table>

                </td>
            </tr>
            <!------------End cruise----------------->
                      

                    @if($cruise_images)
                        @foreach ($cruise_images as $key => $img)
                        <tr>
                            <td colspan="10"><img width="50" src="{{ asset($img->file_path) }}"
                                    class="img-thumbnail"></td>
                        </tr>
                        @endforeach
                    @endif
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

            <!-- ======================================================== -->
            <!--tr>
                <td colspan="2" style="font-size: 16px; font-weight: 700; padding: 30px 30px 10px 30px;">General Flight
                    Terms and Conditions</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    These terms and conditions (“terms of use”) apply to you right the moment you access and use our website or make a purchase by speaking to an agent on +1 (844) 362-2566.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 600; padding: 10px 30px 0px 30px;">General
                    Conditions</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #c53d3d; padding: 5px 30px 0px 30px;">
                    Important Note : Tickets are Non-Refundable/Non-Transferable and name changes are not permitted.
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    <span style="font-weight: 600;">NOTE :</span> Date and routing changes will be subject to Airline Penalty and Fare Difference if any</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">For
                    For any modification or changes please contact our Travel Consultant on +1 (844) 362-2566</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">All customers are advised to verify travel documents (transit visa/entry visa) for the country through which they are transiting and/or entering. flydreamz will not be responsible if proper travel documents are not available and you are denied entry or transit into a Country. We request you to consult the embassy of the country(s) you are visiting or transiting through.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">For any modification or any other query please contact our Travel Consultant on +1 (844) 362-2566.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    flydreamz provides its services, products, and contents either through the phone service or website. This is a legal agreement between you and flydreamz. You must read all the information carefully as you agree to these terms and conditions while accessing or using any services or products or contents of flydreamz.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    <span style="font-weight: 600;">Visas:</span> Please check with your local embassy regarding any visa requirements as we do not deal with any visa/travel related documents.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    <span style="font-weight: 600;">Passports:</span> It is advisable that your passport must be at least valid for 6 months from the date of return.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    <span style="font-weight: 600;">Travel Insurance:</span> You are advised to take travel insurance to cover any medical expenses.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 600; padding: 10px 30px 0px 30px;">Travelers Name</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    Traveler First name and Last name must be entered during the time of reservation exactly as it appears on your Government issued identification, be it your passport, Driving License or other acceptable forms of identification depending on your type of journey (Domestic/International). Name once entered will not be changed. Some ‘Typo Error’ (Name Correction) however, is allowed, depending on Airline Terms of Use, & charges would be applicable according as per airline policy.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 600; padding: 10px 30px 0px 30px;">Fare Policy</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    Electronic Tickets (e-tickets) will be issued shortly.If we are not able to issue the e ticket, you will be notified.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 500; color: #000; padding: 5px 30px 0px 30px;">
                    Passengers are required to reconfirm flights 72 (seventy two) hours prior to departure with the airline you are travelling with. Passengers are required to arrive at the gate, 3 (three) hours before departure for international travel and 2 (two) hours prior to departure for domestic travel. We are not responsible or liable for flight changes made by the airline. If a passenger misses or does not show for their flight and does not notify the airline prior to missing or no showing the flight, the passenger assumes all responsibility for any change or cancel fee and/or possible loss of ticket value. This no show policy is an airline enforced rule and at their discretion to determine how they will deal with it. However, most airlines look at no shows as a violation of their ticket policies meaning you forfeit any and all funds paid for said ticket. Frequent Flyer Mileage can be accrued on some carriers. Please contact your airline to advise your mileage number. Fares are not guaranteed until ticketed.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    Passengers are responsible for all of the required travel documents. If the passenger attempts to fly without proper documentation and are turned away from the airport or required to cancel or change their tickets because of lack of proper travelling documentation, then the passenger assumes full responsibility for any and all change or cancel fees if applicable and/or the loss of the tickets purchased.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    All Tickets are not guaranteed until ticketed. The fare may alter as revised by the Airline company or dealer anytime even after the confirmation of a reservation. flydreamz will inform you about the fare changes if made without assuming any responsibility – financial or otherwise for any such fare alters made by the supplier.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    flydreamz will inform you about the new fares. At that point of time you may- depending on your requirement – either purchase or cancel the product or service at the new cost. You also can cancel the booking at no cost in case there is an increase in fare before ticketing and your card being charged. You’ll be charged nothing if you cancel such a booking.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 600; padding: 10px 30px 0px 30px;">Payment Policy</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    flydreamz accepts Debit Cards and Credit Cards</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    flydreamz may divide your total charge into two parts: Taxes and Airline Base. But, the combined total amount will be the same as authorized and quoted by you at the time of booking.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    Ticket fares don't include baggage fees of the airline.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    Tickets are guaranteed only after the ticketing is completed. The tickets will not be guaranteed upon submission of payment. In case, your credit card payment fails to proceed due to any reason, we will notify you about this within 24 hours.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 600; padding: 10px 30px 0px 30px;">Third Party and International Credit & Debit Cards Payment.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    In case you are using an International Debit Card or Credit while purchasing Plane Tickets for a personal journey, or for somebody else, you need to have some specific documents for processing passenger E-Tickets. Documents required for the same have been mentioned below.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    A complete ‘Credit Card Authorization Form’.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    A copy of identity proof issued by the Government with front and back side which has photograph and signatures and copy of your card from which you are paying for the booking.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    Airline Ticket prices are not guaranteed until ticketed.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 600; padding: 10px 30px 0px 30px;">Credit Card Declines</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    On Credit Card being declined while processing your transaction, we will alert you about this by emailing you at your valid email id within 24 to 48 hours. In this case, neither the transaction will be processed nor the fare and any other booking details will be guaranteed.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 600; padding: 10px 30px 0px 30px;">Cancellations and Exchanges</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    Changes are subject to the following rules/penalties plus any difference in the airfare at the time the changes are made.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    Changes (before or after departure): As per the airline policy</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    Cancel / Refund (before or after departure): Not allowed in most of the airlines/as per the airline policy</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    For all cancellation and exchanges, you agree to request at least 24 hours before scheduled departure. All flight tickets bought from us are 100% non-refundable. You, however, reserve the right to entertain refund or exchange if allowed by the airline fare rules associated with the ticket(s) issued to you. Your ticket(s) may be refunded or exchanged for the original purchase price after the deduction of applicable airline penalties, and any fare difference between the original fares paid and the fare associated with the new ticket(s).</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    Furthermore, flydreamz has the right to charge a Change/Refund fees. flydreamz has no control over airline penalties associated with refunds or exchanges.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                    If you travel internationally, you may often be offered to travel in more than one airline. Each airline has formed its own set of fare rules. If more than one set of fare rules are applied to the total fare, the most restrictive rules will be applicable to the entire booking.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                   Thanks for spending your valuable time and using flydreamz. For using the website, you are authorized to agree with the aforementioned ‘Terms of Use’.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 600; padding: 10px 30px 0px 30px;">24/7 Customer Care</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                   Our customer service representatives are available 24x7 to assist you. Our proficient team will make sure that all your travel needs are addressed at the earliest.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                   For any modification or changes please contact our Travel Consultant on +1 (844) 362-2566.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 600; padding: 10px 30px 0px 30px;">Safe & Secure Booking</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                   Our site comes equipped with the latest technology, so your data and information are always secured.</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 12px; font-weight: 400; color: #000; padding: 5px 30px 0px 30px;">
                   We value your business and look forward to serve your travel needs in the near future</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px; font-weight: 600; padding: 15px 30px 40px 30px;">Please feel free to contact us at +1 (844) 362-2566.</td>
            </tr-->
                <!-- ======================================================== -->
            
            
            
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

            <input type="hidden" name="card_id" id="card_id" value="{{ $card_id }}">
            <input type="hidden" name="card_billing_id" id="card_billing_id" value="{{ $card_billing_id }}">
            <input type="hidden" name="refund_status" id="refund_status" value="{{ $refund_status }}">
            <input type="hidden" name="signature" id="signatureData">
            <input type="hidden" name="signature_type" id="signatureType">
            <input type="hidden" name="booking_id" id="booking_id" value="{{ request()->segment(2) }}">

     
            
            <div style="margin-top: 10px;">
                <label>
                    <input type="checkbox" id="termsCheckbox" required > 
                    <a href="{{ route('terms-and-conditions') }}" target="_blank"> I have read and agree to the Terms and Conditions </a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                bgColor: "#28a745",     // Bootstrap green
                textColor: "#ffffff",
                icon: "✔",              // Unicode check mark
                borderColor: "#218838"
            },
            error: {
                bgColor: "#dc3545",     // Bootstrap red
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
    $('#authorizationForm').submit(function(e){
        e.preventDefault();
        const formdata = new FormData(e.target);
        const href = e.target.action;
        $.ajax({
            url:href,
            type:'POST',
            data:formdata,
            contentType:false,
            processData:false,
            success:function(data){
                showToast(data.message);
                $('#authorizeButton').remove();
            },
            error:function(data){
                showToast(data.responseJSON.message);
            }
        });
    });
    </script>
