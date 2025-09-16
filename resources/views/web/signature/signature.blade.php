<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Booking Authorization</title>
</head>
@php
$bookingTypes = $booking->bookingTypes->pluck('type')->toArray();
@endphp

<body style="margin: 0px; padding: 0px; background-color: #f8f9fa;">
    <table style="font-family: 'Inter', sans-serif; width: 100%; max-width: 700px; background-color: #ffffff; margin: 0px auto; border-collapse: collapse; box-shadow: 0 5px 20px rgba(0,0,0,0.05); border-radius: 0px; overflow: hidden;">
        <thead>
            <tr>
                <th style="padding: 10px 20px; background: linear-gradient(135deg, #1a2a6c, #2b5876); color: white; text-align: left; font-weight: 600; font-size: 18px;">Speak to a Travel Expert</th>
                <th style="padding: 10px 20px; background: linear-gradient(135deg, #1a2a6c, #2b5876); text-align: right;">
                    <span style="display: flex; align-items: center; justify-content: end;">
                        <img style="margin-right: 10px; filter: brightness(0) invert(1);" width="20" src="{{asset('email-templates/call.png')}}" alt="call">
                        <a style="font-size: 18px; font-weight: 600; color: #ffffff; text-decoration: none;" href="tel:+1-844-382-2225">+1-844-362-2566</a>
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" style="padding: 0px;">
                    @if($bookingTypes[0] == 'Flight')
                    <img style="height: 200px; width: 100%; object-fit: cover;" src="{{asset('email-templates/flight-banner.png')}}" alt="flight">
                    @elseif($bookingTypes[0] == 'Cruise')
                    <img style="height: 200px; width: 100%; object-fit: cover;" src="{{asset('email-templates/cruise.jpeg')}}" alt="cruise">
                    @elseif($bookingTypes[0] == 'Train')
                    <img style="height: 200px; width: 100%; object-fit: cover;" src="{{asset('email-templates/amtrak.jpeg')}}" alt="amtrak">
                    @elseif($bookingTypes[0] == 'Car')
                    <img style="height: 200px; width: 100%; object-fit: cover;" src="{{asset('email-templates/car.jpeg')}}" alt="car">
                    @elseif($bookingTypes[0] == 'Hotel')
                    <img style="height: 200px; width: 100%; object-fit: cover;" src="{{asset('email-templates/hotel.jpeg')}}" alt="hotel">
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 16px; font-weight: 600; padding: 5px 30px 0px 30px; color: #2d3748;">Dear {{ $booking->name }},</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 15px; line-height: 1.3; color: #4a5568; padding: 0px 30px 0px 30px;">
                    Thank you for using {{ $booking->selected_company_name }} for your travel needs. Please take a moment to review the names, date, itinerary, price and other relevant details of your booking.
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="container">
                        <div>
                            {{-- Success message --}}
                            @if(session('success'))
                            <div style="background-color: #d4edda; color: #155724; padding: 12px 15px; border-radius: 6px; margin: 0 30px 20px 30px; border-left: 4px solid #28a745;">
                                ✅ Thank you for your authorization! Your signature has been successfully recorded.
                            </div>
                            @endif

                            {{-- Validation errors (all in a list) --}}
                            @if($errors->any())
                            <div style="background-color: #f8d7da; color: #721c24; padding: 12px 15px; border-radius: 6px; margin: 0 30px 20px 30px; border-left: 4px solid #dc3545;">
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

            <tr>
                <td style="padding: 0 15px 0 30px; width: 50%;">
                    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 0px; margin-top: 10px; text-align: center; border: 1px solid #e9ecef;">
                        <div style="margin-bottom: 12px;"> 
                            <img width="40" src="{{asset('email-templates/sku.png')}}" alt="Number"> 
                        </div>
                        <div style="font-size: 14px; font-weight: 600; color: #2d3748; margin-bottom: 0px;">Order Reference Number</div>
                        <div style="font-size: 14px; color: #4a5568; font-weight: 500;">{{ $booking->pnr }}</div>
                    </div>
                </td>
                <td style="padding: 0 30px 0 15px; width: 50%;">
                    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 0px; margin-top: 10px; text-align: center; border: 1px solid #e9ecef;">
                        <div style="margin-bottom: 12px;"> 
                            <img width="40" src="{{asset('email-templates/event.png')}}" alt="Number"> 
                        </div>
                        <div style="font-size: 14px; font-weight: 600; color: #2d3748; margin-bottom: 0px;">Order Date</div>
                        <div style="font-size: 14px; color: #4a5568; font-weight: 500;">{{ $booking->created_at->format('l, M d, Y') }}</div>
                    </div>
                </td>
            </tr>

            <!-------------Flight --------------->
            @if(in_array('Flight', $bookingTypes))
            @php
                $allAirlines = [];
            @endphp

            <tr>
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="width:100%; border-radius: 0px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style=" font-size:16px; font-weight:600; color:#1a2a6c; padding:10px 20px; background-color: #f8f9fa; border-bottom:1px solid #e9ecef;">
                            Flight Details
                        </div>
                        <div style="padding: 10px 20px;">
                            @if($booking->travelFlight->isNotEmpty())    
                                @foreach($booking->travelFlight as $index => $flight)
                                <div style="display: flex; align-items: flex-start; margin-bottom: 18px; padding-bottom: 0px; border-bottom: 1px solid #e9ecef; flex-wrap: wrap;">
                                    <div style="flex-shrink: 0; margin-right: 15px; margin-bottom: 15px;">
                                        <img src="https://www.pnrconverter.com/images/airlines/png/150/nz.png" alt="airline logo" style="height:35px; width:75px; object-fit: contain;">
                                    </div>
                                    <div style="flex: 1; min-width: 280px;">
                                        <div style="font-size: 14px; font-weight: 600; color: #2d3748; margin-bottom: 0px;">
                                            {{ $flight->departure_date?->format('D, M j') }} - {{$flight->airline_code}} {{$flight->flight_number}} - {{$flight->duration}}
                                        </div>
                                        <div style="font-size: 14px; color: #4a5568; margin-bottom: 0px;">
                                            <span style="display: inline-block; margin-right: 15px;">
                                                <strong>Departing:</strong> {{ date('h:i A', strtotime($flight->departure_hours)) }} from {{$flight->departure_airport}}
                                            </span>
                                        </div>
                                        <div style="font-size: 14px; color: #4a5568;">
                                            <span style="display: inline-block;">
                                                <strong>Arriving:</strong> {{ date('h:i A', strtotime($flight->arrival_hours)) }} into {{$flight->arrival_airport}}
                                            </span>
                                        </div>
                                        @if($flight->transit)
                                        <div style="color: #718096; font-size:13px; margin-top:0px; padding: 8px 0;">
                                            <div>-------- Transit Time: {{$flight->transit }} --------</div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                        @php 
                                            $codes = explode(',', $flight->airline_code);
                                            $allAirlines = array_unique(array_merge($allAirlines, $codes));
                                        @endphp
                                @endforeach
                            @endif


                            @if($flight_images)
                                @foreach ($flight_images as $key => $img)
                                    <div style="padding-top: 10px;">
                                        <img src="{{ asset($img->file_path) }}" style="max-width: 100%; height: auto; border-radius: 6px;">
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
                     @php
                        $allHotelNames = [];
                    @endphp

                <!-- Start Hotel Details -->
            <tr>
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="width:100%; border-radius: 0px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style=" font-size:16px; font-weight:600; color:#1a2a6c; padding:10px 20px; background-color: #f8f9fa; border-bottom:1px solid #e9ecef;">
                            Hotel Details
                        </div>
                        <div style="padding: 10px;">
                            <!-- Hotel Image -->
                            <div style="padding:0; margin-bottom: 20px;">
                                <img src="{{asset('email-templates/bedroom.jpg')}}" alt="Hotel" style="width:100%; height:200px; border-radius:0px; object-fit: cover;">
                            </div>
                            
                            <!-- Booking Info Row -->
                            <div style="background:#f8f9fa; padding:10px 20px; text-align:center; border-top:1px solid #e9ecef; border-bottom:1px solid #e9ecef; margin-bottom: 20px;">
                                @foreach($booking->travelHotel as $key=>$travelHotel)
                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px; text-align: left;">
                                    <div>
                                        <div style="font-size:14px; color:#2d3748; font-weight:bold; margin-bottom: 0px;">Hotel Name</div>
                                        <div style="font-weight:normal; color: #4a5568;">{{$travelHotel->hotel_name}}</div>
                                    </div>
                                    <div>
                                        <div style="font-size:14px; color:#2d3748; font-weight:bold; margin-bottom: 0px;">Room Category</div>
                                        <div style="font-weight:normal; color: #4a5568;">{{$travelHotel->room_category}}</div>
                                    </div>
                                    <div>
                                        <div style="font-size:14px; color:#2d3748; font-weight:bold; margin-bottom: 0px;">Confirmation Number</div>
                                        <div style="font-weight:normal; color: #4a5568;">{{$travelHotel->confirmation_number}}</div>
                                    </div>
                                    <div>
                                        <div style="font-size:14px; color:#2d3748; font-weight:bold; margin-bottom: 0px;">Hotel Address</div>
                                        <div style="font-weight:normal; color: #4a5568;">{{$travelHotel->hotel_address}}</div>
                                    </div>
                                    <div>
                                        <div style="font-size:14px; color:#2d3748; font-weight:bold; margin-bottom: 0px;">CHECK-IN</div>
                                        <div style="font-weight:normal; color: #4a5568;">
                                            {{ $travelHotel->checkin_date ? $travelHotel->checkin_date->format('l, F d, Y') : '' }}
                                        </div>
                                    </div>
                                    <div>
                                        <div style="font-size:14px; color:#2d3748; font-weight:bold; margin-bottom: 0px;">CHECK-OUT</div>
                                        <div style="font-weight:normal; color: #4a5568;">
                                            {{ $travelHotel->checkout_date ? $travelHotel->checkout_date->format('l, F d, Y') : '' }}
                                        </div>
                                    </div>
                                    <div>
                                        <div style="font-size:14px; color:#2d3748; font-weight:bold; margin-bottom: 0px;">ROOMS</div>
                                        <div style="font-weight:normal; color: #4a5568;"> {{$travelHotel->no_of_rooms}}</div>
                                    </div>
                                </div>
                                    @php 
                                        $hotel_names = explode(',', $travelHotel->hotel_name);
                                        $allHotelNames = array_unique(array_merge($allHotelNames, $hotel_names));
                                    @endphp
                                    
                                @endforeach
                            </div>
                            
                            <div style="padding:0px; padding-left: 0; color:#4a5568;">
                                <div style="white-space: pre-line; font-size: 14px; line-height: 1.3;">{!! $booking->hotel_description !!}</div>
                            </div>
                            
                            @if($hotel_images)
                                @foreach ($hotel_images as $key => $img)
                                <div style="padding: 10px 0;">
                                    <img src="{{ asset($img->file_path) }}" style="max-width: 100%; height: auto; border-radius: 6px;">
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

            @php
                $allCruiseProvider = [];
            @endphp

           

            <tr>
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="width:100%; border-radius: 0px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style=" font-size:16px; font-weight:600; color:#1a2a6c; padding:10px 20px; background-color: #f8f9fa; border-bottom:1px solid #e9ecef;">
                            Cruise Details
                        </div>
                        <div style="padding: 10px 20px;">
                            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 00px;">
                                <div style="flex: 1; min-width: 300px;    margin-bottom: -10px;">
                                    <div style=" font-size:16px; font-weight:600; color:#1a2a6c; padding:10px 20px; background-color: #f8f9fa; border-bottom:1px solid #e9ecef;">
                                     Royal Caribbean
                                    </div>

                                  <div style="background:#f8f9fa; padding:10px 20px; text-align:center; border-top:1px solid #e9ecef; border-bottom:1px solid #e9ecef; margin-bottom: 20px;">
    @foreach([$travel_cruise_data] as $cruise)
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px; text-align: left;">
        
       

        <div>
            <div style="font-size:14px; color:#2d3748; font-weight:bold; margin-bottom: 0px;">Length</div>
            <div style="font-weight:normal; color: #4a5568;">{{ $cruise->length }}</div>
        </div>

        <div>
            <div style="font-size:14px; color:#2d3748; font-weight:bold; margin-bottom: 0px;">Departure Port</div>
            <div style="font-weight:normal; color: #4a5568;">{{ $cruise->departure_port }}</div>
        </div>

        <div>
            <div style="font-size:14px; color:#2d3748; font-weight:bold; margin-bottom: 0px;">Arrival Port</div>
            <div style="font-weight:normal; color: #4a5568;">{{ $cruise->arrival_port }}</div>
        </div>


        <div>
            <div style="font-size:14px; color:#2d3748; font-weight:bold; margin-bottom: 0px;">Category</div>
            <div style="font-weight:normal; color: #4a5568;">{{ $cruise->category }}</div>
        </div>

        <div>
            <div style="font-size:14px; color:#2d3748; font-weight:bold; margin-bottom: 0px;">Stateroom</div>
            <div style="font-weight:normal; color: #4a5568;">{{ $cruise->stateroom }}</div>
        </div>

    </div>

    @php 
        $cruise_providers = explode(',', $cruise->cruise_line);
        $allCruiseProvider = array_unique(array_merge($allCruiseProvider, $cruise_providers));
    @endphp

    @endforeach
</div>

                                </div>
                            </div>
                            
                            <div style="margin-bottom: 20px;">
                                <div style="background-color: #f8f9fa; padding: 10px 15px; border-radius: 0px; margin-bottom: 10px; font-weight: 600; color: #1a2a6c;">Itinerary Details</div>
                                <div style="overflow-x: auto; margin-bottom: -10px;">
                                    <table style="border-collapse: collapse; width: 100%; font-size:14px; text-align:left; background-color: #f8f9fa; border-radius: 0px;">
                                        <thead>
                                            <tr style="background-color: #e6eeff; font-weight:bold;">
                                                <td style="padding:6px 12px; width:25%; border: 1px solid #e9ecef;">DATE</td>
                                                <td style="padding:6px 12px; width:35%; border: 1px solid #e9ecef;">PORT OF CALL</td>
                                                <td style="padding:6px 12px; width:20%; border: 1px solid #e9ecef;">DEPART</td>
                                                <td style="padding:6px 12px; width:20%; border: 1px solid #e9ecef;">ARRIVE</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($booking->travelCruise as $key=>$travelCruise)
                                            <tr>
                                                <td style="padding:2px 12px; border: 1px solid #e9ecef;">
                                                    <div style="font-weight: 600; color: #2d3748;">{{ date('l', strtotime($travelCruise->departure_date)) }}</div>
                                                    <div style="color: #4a5568;">{{ date('d-m-Y', strtotime($travelCruise->departure_date)) }}</div>
                                                </td>
                                                <td style="padding:2px 12px; border: 1px solid #e9ecef; color: #4a5568;">{{$travelCruise->departure_port}}</td>
                                                <td style="padding:2px 12px; border: 1px solid #e9ecef; color: #4a5568;">
                                                     @if($travelCruise->departure_hrs)
                                                        {{ date('h:i A', strtotime($travelCruise->departure_hrs)) }}
                                                    @endif  
                                                </td>
                                                <td style="padding:2px 12px; border: 1px solid #e9ecef; color: #4a5568;">
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
                                    <div style="background-color: #f8f9fa; padding: 10px 15px; border-radius: 0px; font-weight: 600; color: #1a2a6c;">
                                        Add-on Services
                                    </div>
                                    @foreach($travel_cruise_addon as $addon)
                                        <div style="padding: 5px 15px; border-bottom: 1px solid #e9ecef;">
                                            <div style="font-weight: 600; font-size: 12px; color: #1a2a6c; margin-bottom: 0px;">
                                                {{ $addon->services }} :
                                            </div>
                                            <div style="font-size: 12px; color: #4a5568; line-height: 1.3;">
                                                {!! $addon->service_name !!}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            
                            @if($cruise_images)
                                @foreach ($cruise_images as $key => $img)
                                <div style="padding: 10px 0;">
                                    <img src="{{ asset($img->file_path) }}" style="max-width: 100%; height: auto; border-radius: 6px;">
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
                @php
                    $allCarProviders = [];
                @endphp
            <tr>
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="width:100%; border-radius: 0px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style=" font-size:16px; font-weight:600; color:#1a2a6c; padding:10px 20px; background-color: #f8f9fa; border-bottom:1px solid #e9ecef;">
                            Car Details
                        </div>
                       <div style="padding: 0px; background-color: #ffffff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333;">

    <div style="display: flex; flex-wrap: wrap; gap: 5px; border-radius: 0px; padding: 10px 20px 0px;">

        <!-- LEFT SIDE: Car Image + Description -->
        <div style="  padding-right: 20px; border-right: 1px solid #e0e0e0;">
            <div style="padding-bottom: 10px; text-align: center;">
                <img src="{{ asset('email-templates/car_book.png') }}" width="150" style="display: block; border: 0; border-radius: 10px;">
            </div>
            <div style="font-size: 14px; line-height: 1.6; color: #555; white-space: pre-line;">
                {!! $booking->car_description !!}
            </div>
        </div>

        <!-- RIGHT SIDE: Structured Details + Pickup & Drop-off Block -->
        <div style="flex: 1;">

            <div style="font-size: 14px; font-weight: 600; color: #1a2a6c; border-bottom: 2px solid #e0e0e0; padding-bottom: 5px;">
                Pick-up and Drop-off
            </div>

            @foreach($booking->travelCar as $travelCar)
                <table style="width: 100%; border-collapse: separate; border-spacing: 0 10px; font-size: 14px; color: #555; ">
                    @if($travelCar->car_rental_provider)
                 
                    <tr>
                         <div class="">
                             <td style="font-weight: 500; padding: 4px; background-color: #fafafa;  border-radius: 0px;  color: #2d3748; font-size: 14px;">Car Rental Provider :</td>
                          
                        <td style="font-weight: 400; padding: 10px; background-color: #fafafa;  border-radius: 0px;  color: #2d3748; font-size: 14px;">{{ $travelCar->car_rental_provider }}</td>
                         </div>
                    </tr>
                
                    @endif

                    @if($travelCar->car_type)
                    <tr>
                        <td style="font-weight: 500; padding: 4px; background-color: #fafafa;  border-radius: 0px;  color: #2d3748; font-size: 14px;">Car Type :</td>
                        <td style="font-weight: 400; padding: 10px; background-color: #fafafa;  border-radius: 0px;  color: #2d3748; font-size: 14px;">{{ $travelCar->car_type }}</td>
                    </tr>
                    @endif

                    @if($travelCar->confirmation_number)
                    <tr>
                        <td style="font-weight: 500; padding: 4px; background-color: #fafafa;  border-radius: 0px;  color: #2d3748; font-size: 14px;">Confirmation Number :</td>
                        <td style="font-weight: 400; padding: 10px; background-color: #fafafa;  border-radius: 0px;  color: #2d3748; font-size: 14px;">{{ $travelCar->confirmation_number }}</td>
                    </tr>
                    @endif

                    @if($travelCar->rental_provider_address)
                    <tr>
                        <td style="font-weight: 600; padding: 14px; background-color: #fafafa; border-radius: 6px; color: #2d3748;">Rental Provider Address</td>
                        <td style="padding: 14px; background-color: #fafafa; border-radius: 6px;">{{ $travelCar->rental_provider_address }}</td>
                    </tr>
                    @endif
                </table>

                <!-- Pickup & Drop-off Card -->
                <div style="    padding: 6px;
    background-color: #f8f9fa;
    border-radius: 0px; margin-bottom: 10px;">
                    <div style="font-size: 14px; font-weight: 600; color: #1a202c; margin-bottom: 5px;">Pickup</div>
                    <div style="font-size: 14px; color: #555; margin-bottom: 10px;">
                        ⭕ {{ $travelCar->pickup_date?->format('D, M j') }} - {{ $travelCar->pickup_time }}<br>
                        <span style="font-weight: 600;">{{ $travelCar->pickup_location }}</span>
                    </div>

                    <div style="font-size: 14px; font-weight: 600; color: #1a202c; margin-bottom: 5px;">Drop-off</div>
                    <div style="font-size: 14px; color: #555;">
                        ⭕ {{ $travelCar->dropoff_date?->format('D, M j') }} - {{ $travelCar->dropoff_time }}<br>
                        <span style="font-weight: 600;">{{ $travelCar->dropoff_location }}</span>
                    </div>
                </div>
                @php 
                    $car_providers = explode(',', $travelCar->car_rental_provider);
                    $allCarProviders = array_unique(array_merge($allCarProviders, $car_providers));
                @endphp
            @endforeach

        </div>

    </div>

    <!-- Additional Car Images -->
    @if($car_images)
        @foreach ($car_images as $img)
        <div style="padding: 15px 0;">
            <img src="{{ asset($img->file_path) }}" style="max-width: 100%; height: auto; border-radius: 10px; box-shadow: 0 3px 8px rgba(0,0,0,0.1);">
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
            @php
                $allTrainProviders = [];
            @endphp
            <tr>
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="width:100%; border-radius: 0px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style="f font-size:16px; font-weight:600; color:#1a2a6c; padding:10px 20px; background-color: #f8f9fa; border-bottom:1px solid #e9ecef;">
                            Train Details
                        </div>
                        <div style="padding: 10px;">
                            @foreach($booking->trainBookingDetails as $key=>$trainBookingDetails)
                            <div style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #e9ecef;">
                                <!-- Route Codes -->
                                <div style="background: linear-gradient(135deg, #1a2a6c, #2b5876); color:#fff; padding:10px 15px; font-size:16px; font-weight:bold; text-align: center; border-radius: 0px; margin-bottom: 10px;">
                                    {{$trainBookingDetails->departure_station}} &nbsp;→&nbsp; {{$trainBookingDetails->arrival_station}}
                                </div>

                                <div style="font-size:14px; font-weight:600; color:#2d3748; margin-bottom:5px;">
                                    Departure: {{ $trainBookingDetails->departure_date ? $trainBookingDetails->departure_date->format('D, M d, Y') : '' }} | 
                                    Arrival: {{ $trainBookingDetails->arrival_date ? $trainBookingDetails->arrival_date->format('D, M d, Y') : '' }}
                                </div>
                                
                                <div style="font-size:14px; color:#4a5568; line-height:1.6; margin-bottom:10px;">
                                    <strong>Direction</strong>: {{$trainBookingDetails->departure_station}} | 
                                    <strong>Cabin</strong>: {{$trainBookingDetails->cabin}} | 
                                    <strong>Train Ref</strong>: {{$booking->train_ref}}
                                </div>

                                <!-- Train + Times -->
                               <div style="padding: 20px 0; font-size: 14px; color: #4a5568; background-color: #f8f9fa; border-radius: 0px;">
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); align-items: center; gap: 10px; text-align: center;">
        
        <!-- Train Number -->
        <div style="    display: flex
;
border-radius: 0px;
    align-items: center;
    justify-content: center;">
            <div style="font-size: 30px;">🚆</div>
          <div class="">
              <div style="font-weight: 600; color: #1a2a6c; ">Train No</div>
            <div style="font-size: 12px;">{{ $trainBookingDetails->train_number }}</div>
          </div>
        </div>

        <!-- Departure Time -->
        <div>
            <div style="font-size: 20px; font-weight: bold; color: #1a2a6c;">
                {{ date('h:i A', strtotime($trainBookingDetails->departure_hours)) }}
            </div>
            <div style="font-size: 12px; color: #718096; ">DEPARTS</div>
        </div>

        <!-- Duration -->
        <div>
            <div style="font-size: 20px; color: #1a2a6c;">→</div>
            <div style="font-size: 12px; color: #718096; ">
                {{ $trainBookingDetails->transit }}
            </div>
        </div>

        <!-- Arrival Time -->
        <div>
            <div style="font-size: 20px; font-weight: bold; color: #1a2a6c;">
                {{ date('h:i A', strtotime($trainBookingDetails->arrival_hours)) }}
            </div>
            <div style="font-size: 12px; color: #718096; ">ARRIVES</div>
        </div>

    </div>
</div>


                                <!-- Seat Info -->
                                <div style="background: #e6eeff;padding: 10px;font-size: 12px;color: #1a2a6c;margin-top: 10px;">
                                    <div style="white-space: pre-line; line-height: 1.6;">{{ $booking->train_description }}</div>
                                </div>
                            </div>
                                @php 
                                    $train_providers = explode(',', $trainBookingDetails->train_provider);
                                    $allTrainProviders = array_unique(array_merge($allTrainProviders, $train_providers));
                                @endphp
                            @endforeach

                            @if($train_images)
                                @foreach ($train_images as $key => $img)
                                <div style="padding: 10px 0;">
                                    <img src="{{ asset($img->file_path) }}" style="max-width: 100%; height: auto; border-radius: 6px;">
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            @endif


            <tr>
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="border-radius: 0px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style="font-weight: 600;color: #1a2a6c;padding: 10px 20px;background-color: #f8f9fa;border-bottom: 1px solid #e9ecef;">
                            Customer Information
                        </div>
                        <div style="padding: 0;">
                            <div style="display: flex; justify-content: space-between; padding: 8px 20px; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: 14px; font-weight: 600; color: #2d3748;">Card Holder Name</div>
                                <div style="font-size: 14px; color: #4a5568;">{{$billingPricingData->cc_holder_name}}</div>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 8px 20px; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: 14px; font-weight: 600; color: #2d3748;">Card Number</div>
                                <div style="font-size: 14px; color: #4a5568;">
                                  {{ str_repeat('*', strlen($billingPricingData->cc_number) - 4) . substr($billingPricingData->cc_number, -4) }}

                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 8px 20px; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: 14px; font-weight: 600; color: #2d3748;">Card Type</div>
                                <div style="font-size: 14px; color: #4a5568;">
                                   {{$billingPricingData->card_type}}
                                </div>
                            </div>

                            

                            <div style="display: flex; justify-content: space-between; padding: 8px 20px; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: 14px; font-weight: 600; color: #2d3748;">Email</div>
                                <div style="font-size: 14px;">
                                    <a style="color: #1a56db; text-decoration: none;" href="mailto:{{$billingPricingData->email}}">{{$billingPricingData->email}}</a>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 8px 20px; border-bottom: 1px solid #e9ecef;">
                                <div style="font-size: 14px; font-weight: 600; color: #2d3748;">Booking Date</div>
                                <div style="font-size: 14px; color: #4a5568;">{{ $booking->created_at->format('l, M d, Y') }}</div>
                            </div>
                           @if($booking->airlinepnr) 
                            <div style="display: flex; justify-content: space-between; padding: 8px 20px;">
                                <div style="font-size: 14px; font-weight: 600; color: #2d3748;">Airline Ref</div>
                                <div style="font-size: 14px; color: #4a5568;">{{ $booking->airlinepnr }}</div>
                            </div>
                           @endif

                        </div>
                    </div>
                </td>
            </tr>

            <!------Passenger -------->
            <tr>
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="border-radius: 0px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style="    font-weight: 600;
    color: #1a2a6c;
    padding: 10px 20px;
    background-color: #f8f9fa;
    border-bottom: 1px solid #e9ecef;">
                            Passenger Details
                        </div>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background-color: #f8f9fa;">
                                        <th style="font-size: 14px; font-weight: 600; padding: 8px 20px; text-align: left; color: #2d3748; border-bottom: 1px solid #e9ecef;">Type</th>
                                        <th style="font-size: 14px; font-weight: 600; padding: 8px 20px; text-align: left; color: #2d3748; border-bottom: 1px solid #e9ecef;">Passenger Name</th>
                                        <th style="font-size: 14px; font-weight: 600; padding: 8px 20px; text-align: left; color: #2d3748; border-bottom: 1px solid #e9ecef;">Seat</th>
                                        <th style="font-size: 14px; font-weight: 600; padding: 8px 20px; text-align: left; color: #2d3748; border-bottom: 1px solid #e9ecef;">E-Ticket</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($booking->passengers as $key=>$passengers)
                                    <tr>
                                        <td style="font-size: 14px; color: #4a5568; padding: 8px 20px; border-bottom: 1px solid #e9ecef;">{{$passengers->passenger_type}}</td>
                                        <td style="font-size: 14px; color: #4a5568; padding: 8px 20px; border-bottom: 1px solid #e9ecef;">{{$passengers->title}} {{$passengers->first_name}} {{$passengers->middle_name}} {{$passengers->last_name}}</td>
                                        <td style="font-size: 14px; color: #4a5568; padding: 8px 20px; border-bottom: 1px solid #e9ecef;">{{$passengers->seat_number}}</td>
                                        <td style="font-size: 14px; color: #4a5568; padding: 8px 20px; border-bottom: 1px solid #e9ecef;">{{$passengers->e_ticket_number}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>

            <!-------Price ---------->
            <tr>
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="border-radius: 0px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style="    font-weight: 600;color: #1a2a6c;padding: 10px 20px;background-color: #f8f9fa;border-bottom: 1px solid #e9ecef;">
                            Price Details (USD)
                        </div>
                        <div style="padding: 8px 20px;">

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


        @if($booking->query_type == 26)
                
            
          @foreach($booking->pricingDetails as $ExcursionPrice)  
            <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e9ecef;">
                <div style="font-size: 14px;  color: #2d3748;">
                    <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e9ecef;">
                     <div style="font-size: 14px;  color: #2d3748;">  {{$ExcursionPrice->details}}, per person:</div>
                     <div style="font-size: 16px; color: #0f9b0f;">${{$ExcursionPrice->gross_price}}</div>
                </div>
                <span style="font-size:10px">inc. taxes & fees.</span>
           
              @endforeach  
                            

        @else


                          


                @if(in_array($booking->query_type, [11,12]))
                <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e9ecef;">
                    <div style="font-size: 14px;  color: #2d3748;"> Pet in cargo Fees  :</div>
                        <div style="font-size: 16px; color: #0f9b0f;"> ${{ number_format(array_sum($mergedPrices), 2) }}</div>
                </div>

                @else                                   

                            @foreach($mergedPrices as $passengerType => $totalPrice)
                            <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e9ecef;">
                                
                                <div style="font-size: 14px;  color: #2d3748;">                             
                                    @if(in_array($booking->query_type, [3,7,8]))
                                        Total Price per person including taxes and fees.
                                    @elseif($booking->query_type == 2)
                                        Rebooking fees per person.
                                    @elseif($booking->query_type == 4)
                                        Baggage fees per Bag.
                                    @elseif($booking->query_type == 9)
                                        Travel Insurance per person.
                                     @elseif($booking->query_type == 17)
                                       Cruise Fare - Per Guest -   
                                    
                                    @else
                                        Total Price per person including taxes and fees.        
                                    @endif
                                    ({{ ucfirst($passengerType) }})
                                </div>
                                <div style="font-size: 16px; color: #0f9b0f;">
                                    ${{ number_format($totalPrice, 2) }}
                                </div>
                    
                            @endforeach

                @endif
        @endif 
       
    


                            <div style="display: flex; justify-content: space-between; padding: 10px 0;">
                                <div style="font-size: 14px; font-weight: 600; color: #2d3748;">Total Amount including taxes & Fees. </div>
                                <div style="font-size: 16px; font-weight: 600; color: #0f9b0f;">
                                    ${{ number_format($booking->gross_value, 2) }}
                                </div>
                            </div>                                      

                            <div style="margin-top: 10px; padding:  10px 20px; background-color: #f8f9fa; border-radius: 0px;">
                                <ul style="margin: 0; padding-left: 20px; color: #4a5568; font-size: 12px;">
                                    <li style="margin-bottom: 10px; line-height: 1.6;">
                                        <strong>All transactions</strong> will be processed in US Dollars (USD). If your card was issued in a country other than the USA, your card issuer may charge a currency conversion fee of up to 4% of the total amount charged. Kindly check with your financial institution for more information.
                                    </li>
                                    <li style="line-height: 1.6;">
                                        <strong>Prices are not guaranteed</strong> until the ticket number(s) are issued. Prices may change based on airline inventory availability.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>


            <tr>
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="border-radius: 0px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style="    font-weight: 600;
    color: #1a2a6c;
    padding: 10px 20px;
    background-color: #f8f9fa;
    border-bottom: 1px solid #e9ecef;">
                            Disclaimer:
                        </div>
                        <div style="padding: 10px 20px;">
                            <div style="font-size: 12px; color: #4a5568; line-height: 1.6;">
                                <p style="margin-bottom: 5px;">I,&nbsp;<strong>{{$billingPricingData->cc_holder_name}} </strong>, hereby acknowledge receipt of this communication outlining the associated charges. I have thoroughly reviewed and confirmed the accuracy of the itinerary, including all passenger names, flight schedules, dates, and times.</p>
                                <p style="margin-bottom: 5px;">I acknowledge and accept that the total cost of the booking is <strong>USD {{ number_format(array_sum($mergedPrices), 2) }} </strong>, which will be processed through <strong>single or multiple transactions</strong>. I understand that, regardless of the number of transactions, the <strong>total amount charged will not exceed USD {{ number_format(array_sum($mergedPrices), 2) }} </strong>.</p>
                                <p style="margin-bottom: 5px;">I further acknowledge that the charges may appear on my credit card statements under one or more of the following descriptors:<br>

                               {{ !empty($allAirlines) ? implode(', ', $allAirlines) : '' }}
                               {{ !empty($allHotelNames) ? implode(', ', $allHotelNames) : '' }}
                               {{ !empty($allCruiseProvider) ? implode(', ', $allCruiseProvider) : '' }}
                               {{ !empty($allCarProviders) ? implode(', ', $allCarProviders) : '' }}
                               {{ !empty($allTrainProviders) ? implode(', ', $allTrainProviders) : '' }}

                
                                <strong>{{ $booking->selected_company_name }}</strong>, or <strong>{{$booking->reservation_source}}</strong>.</p>
                                <p style="margin-bottom: 5px;">By this statement, I hereby authorize <strong>{{ $booking->selected_company_name }}</strong> and its affiliated service providers to charge the following amounts to my cards for the related travel services:</p>
                                
                               
                                
                                <ul style="margin-top: 10px; margin-bottom: -6px;">
                                    @foreach($billingPricingDataAll as $billing)
                                    <li style="margin-bottom: 10px;"><b> USD {{ number_format($billing->authorized_amt, 2) }} </b> to my <b> {{ $billing->card_type }} ending in 
                                        @php
                                        /* if(!empty($billing->cc_number)) {
                                            $ccNumber = $billing->cc_number;
                                            echo substr($ccNumber, -4);
                                        } else {
                                            echo 'N/A';
                                        } */
                                        @endphp
                                    </b></li>
                                    @endforeach                                                  
                                </ul>
                                <p style="margin-top: 5px;">I confirm that I am the authorized cardholder for the above payment methods and consent to the processing of these charges as outlined.</p>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>


<!-- Row for Add Signature button -->

            <tr id="signaturetd">
                <td colspan="2" style="padding: 10px 30px 20px 30px;">
                    <button 
                        style="background: linear-gradient(135deg, #1a2a6c, #2b5876); color: white; border: none; padding: 12px 30px; border-radius: 0px; font-weight: 600; cursor: pointer; transition: all 0.3s;"
                     data-bs-toggle="modal" data-bs-target="#signatureModal">Add
                        Signature</button>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="signaturePreview" class="signature-preview d-none">No signature added.</div>
                </td>
            </tr>



<!-- Row for Checkbox + Authorize button -->
<tr>
    <td colspan="2" style="padding: 0px 30px 20px 30px;">
        <form id="authorizationForm" method="POST" action="{{ route('signature.store') }}">
            @csrf
            <input type="hidden" name="card_id" id="card_id" value="{{ $card_id }}">
            <input type="hidden" name="card_billing_id" id="card_billing_id" value="{{ $card_billing_id }}">
            <input type="hidden" name="refund_status" id="refund_status" value="{{ $refund_status }}">
            <input type="hidden" name="signature" id="signatureData">
            <input type="hidden" name="signature_type" id="signatureType">
            <input type="hidden" name="booking_id" id="booking_id" value="{{ request()->segment(2) }}">

            <!-- Checkbox -->
            <div style="margin-bottom: 12px;">
                <label style="display: flex; align-items: center; font-size: 14px; color: #4a5568;">
                    <input type="checkbox" id="termsCheckbox" required style="margin-right: 8px;">
                    <a href="{{ route('terms-and-conditions') }}" target="_blank" 
                       style="color: #1a56db; text-decoration: none;">
                       I have read and agree to the Terms and Conditions
                    </a>
                </label>
            </div>

            <!-- Authorize Button -->
            <div>
                <button type="submit" class="btn btn-success " id="authorizeButton" disabled
                        style="background: linear-gradient(135deg, #0f9b0f, #1ed760); color: white; border: none; padding: 12px 40px; border-radius: 0px; font-weight: 600; cursor: pointer; transition: all 0.3s;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(15, 155, 15, 0.3)';" 
                        onmouseout="this.style.transform='none'; this.style.boxShadow='none';">
                    I Authorize
                </button>
            </div>
        </form>
    </td>
</tr>


           
            
            
        </tbody>
        <tfoot style="background: linear-gradient(135deg, #1a2a6c, #2b5876);">
            <tr>
                <td colspan="2" style="padding: 10px 30px; text-align: center;">
                    <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 5px;">
                       
                        <a href="https://www.instagram.com/flydreamz_/" target="_blank" style="margin: 0 10px; display: inline-block; transition: transform 0.3s;"" onmouseout="this.style.transform='none'">
                            <img width="24" src="{{asset('email-templates/instagram.png')}}" alt="instagram">
                        </a>
                        <a href="https://x.com/_flydreamz" target="_blank" style="margin: 0 10px; display: inline-block; transition: transform 0.3s;"" onmouseout="this.style.transform='none'">
                            <img width="24" src="{{asset('email-templates/twitter.png')}}" alt="twitter">
                        </a>
                    </div>
                    <div style="font-size: 14px; font-weight: 400; color: #e2e8f0; text-align: center;">
                        © {{ date('Y') }} All Rights Reserved.
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>

    <!-- Signature Modal -->
    <div class="modal fade" id="signatureModal" tabindex="-1" aria-labelledby="signatureModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                <div class="modal-header" style="background: linear-gradient(135deg, #1a2a6c, #2b5876); color: white; border-bottom: none; padding: 20px 25px;">
                    <h5 class="modal-title" style="font-family: 'Playfair Display', serif; font-weight: 600;">Add Your Signature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
                </div>
                <div class="modal-body" style="padding: 25px;">
                    <ul class="nav nav-tabs" id="signatureTabs" role="tablist" style="border-bottom: 2px solid #e9ecef;">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="signature1-tab" data-bs-toggle="tab" data-bs-target="#signature1" type="button" role="tab" 
                                    style="border: none; border-radius: 6px 6px 0 0; padding: 10px 15px; color: #4a5568; font-weight: 500; background: transparent;">
                                Signature 1
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="signature2-tab" data-bs-toggle="tab" data-bs-target="#signature2" type="button" role="tab" 
                                    style="border: none; border-radius: 6px 6px 0 0; padding: 10px 15px; color: #4a5568; font-weight: 500; background: transparent;">
                                Signature 2
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="signature3-tab" data-bs-toggle="tab" data-bs-target="#signature3" type="button" role="tab" 
                                    style="border: none; border-radius: 6px 6px 0 0; padding: 10px 15px; color: #4a5568; font-weight: 500; background: transparent;">
                                Signature 3
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="signature4-tab" data-bs-toggle="tab" data-bs-target="#signature4" type="button" role="tab" 
                                    style="border: none; border-radius: 6px 6px 0 0; padding: 10px 15px; color: #4a5568; font-weight: 500; background: transparent;">
                                Signature 4
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="signature5-tab" data-bs-toggle="tab" data-bs-target="#signature5" type="button" role="tab" 
                                    style="border: none; border-radius: 6px 6px 0 0; padding: 10px 15px; color: #4a5568; font-weight: 500; background: transparent;">
                                Signature 5
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content mt-4">
                        <div class="tab-pane fade show active" id="signature1" role="tabpanel">
                            <input type="text" id="typedName1" class="form-control" value="{{$billingPricingData->cc_holder_name}}" 
                                   style="border: 1px solid #d2d6dc; border-radius: 6px; padding: 12px 15px; font-size: 15px;">
                            <div id="preview1" class="signature-preview mt-3" style="font-family: 'Great Vibes'; border: 2px dashed #d2d6dc; padding: 20px; text-align: center; font-size: 32px; background-color: #fafafa; border-radius: 8px; min-height: 100px; display: flex; align-items: center; justify-content: center;">
                                {{$billingPricingData->cc_holder_name}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="signature2" role="tabpanel">
                            <input type="text" id="typedName2" class="form-control" value="{{$billingPricingData->cc_holder_name}}" 
                                   style="border: 1px solid #d2d6dc; border-radius: 6px; padding: 12px 15px; font-size: 15px;">
                            <div id="preview2" class="signature-preview mt-3" style="font-family: 'Dancing Script'; border: 2px dashed #d2d6dc; padding: 20px; text-align: center; font-size: 32px; background-color: #fafafa; border-radius: 8px; min-height: 100px; display: flex; align-items: center; justify-content: center;">
                                {{$billingPricingData->cc_holder_name}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="signature3" role="tabpanel">
                            <input type="text" id="typedName3" class="form-control" value="{{$billingPricingData->cc_holder_name}}" 
                                   style="border: 1px solid #d2d6dc; border-radius: 6px; padding: 12px 15px; font-size: 15px;">
                            <div id="preview3" class="signature-preview mt-3" style="font-family: 'Sacramento'; border: 2px dashed #d2d6dc; padding: 20px; text-align: center; font-size: 32px; background-color: #fafafa; border-radius: 8px; min-height: 100px; display: flex; align-items: center; justify-content: center;">
                                {{$billingPricingData->cc_holder_name}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="signature4" role="tabpanel">
                            <input type="text" id="typedName4" class="form-control" value="{{$billingPricingData->cc_holder_name}}" 
                                   style="border: 1px solid #d2d6dc; border-radius: 6px; padding: 12px 15px; font-size: 15px;">
                            <div id="preview4" class="signature-preview mt-3" style="font-family: 'Pacifico'; border: 2px dashed #d2d6dc; padding: 20px; text-align: center; font-size: 32px; background-color: #fafafa; border-radius: 8px; min-height: 100px; display: flex; align-items: center; justify-content: center;">
                                {{$billingPricingData->cc_holder_name}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="signature5" role="tabpanel">
                            <input type="text" id="typedName5" class="form-control" value="{{$billingPricingData->cc_holder_name}}" 
                                   style="border: 1px solid #d2d6dc; border-radius: 6px; padding: 12px 15px; font-size: 15px;">
                            <div id="preview5" class="signature-preview mt-3" style="font-family: 'Satisfy'; border: 2px dashed #d2d6dc; padding: 20px; text-align: center; font-size: 32px; background-color: #fafafa; border-radius: 8px; min-height: 100px; display: flex; align-items: center; justify-content: center;">
                                {{$billingPricingData->cc_holder_name}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e9ecef; padding: 20px 25px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" 
                            style="background: #a0aec0; border: none; padding: 10px 20px; border-radius: 6px; font-weight: 500;">Cancel</button>
                    <button type="button" class="btn btn-primary" id="addSignatureButton" 
                            style="background: linear-gradient(135deg, #1a2a6c, #2b5876); border: none; padding: 10px 25px; border-radius: 6px; font-weight: 500;">Add Signature</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include necessary JS files and scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Dancing+Script&family=Sacramento&family=Pacifico&family=Satisfy&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const addSignatureButton = document.getElementById('addSignatureButton');
        const signaturePreview = document.getElementById('signaturePreview');
        const authorizeButton = document.getElementById('authorizeButton');
        const signatureDataInput = document.getElementById('signatureData');
        const signatureModal = document.getElementById('signatureModal');
        
        const fonts = ['Great Vibes', 'Dancing Script', 'Sacramento', 'Pacifico', 'Satisfy'];

        // Update previews for all inputs
        for (let i = 1; i <= 5; i++) {
            const input = document.getElementById(`typedName${i}`);
            const preview = document.getElementById(`preview${i}`);
            input.addEventListener('input', () => {
                preview.textContent = input.value;
            });
        }

        // Add Signature Button Logic
        addSignatureButton.addEventListener('click', () => {
            const activeTab = document.querySelector('.nav-link.active').id;
            const tabNumber = activeTab.replace('signature', '').replace('-tab', '');
            const name = document.getElementById(`typedName${tabNumber}`).value;
            const font = fonts[tabNumber - 1];
            
            if (!name) {
                alert('Please type your name.');
                return;
            }
            
            const signatureHTML = `<span style="font-family: ${font}; font-size: 30px;">${name}</span>`;
            signatureDataInput.value = signatureHTML;
            document.getElementById('signatureType').value = 'type';
            signaturePreview.innerHTML = signatureHTML;

            signaturePreview.classList.remove('d-none');
            authorizeButton.disabled = false;

            const modal = bootstrap.Modal.getInstance(signatureModal);
            modal.hide();
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
                 $('#signaturetd').hide();
            },
            error: function(data) {
                showToast(data.responseJSON.message, 'error');
            }
        });
    });
    </script>
</body>
</html>