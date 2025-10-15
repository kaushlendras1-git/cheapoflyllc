<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', Arial, sans-serif; }
    </style>
    <title>Booking Authorization - {{ $booking->pnr }} </title>
</head>
@php
$bookingTypes = $booking->bookingTypes->pluck('type')->toArray();
@endphp

<body style="margin: 0; padding: 0; background-color: #f8f9fa;">
    <table style="font-family: 'Inter', sans-serif; width: 100%; max-width: 700px; background-color: #ffffff; margin: 0 auto; border-collapse: collapse; box-shadow: 0 8px 25px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
        <tr>
            <td style="padding: 10px 20px; background-color: #1a2a6c; color: white; text-align: left; font-weight: 600; font-size: 18px;">Speak to a Travel Expert</td>
            <td style="padding: 10px 20px; background-color: #1a2a6c; text-align: right;">
                <span style="display: flex; align-items: center; justify-content: end;">
                    <img style="margin-right: 10px; filter: brightness(0) invert(1);" width="20" src="{{ public_path('email-templates/call.png') }}" alt="call">
                    <a style="font-size: 18px; font-weight: 600; color: #ffffff; text-decoration: none;" href="tel:+1-844-382-2225">+1-844-362-2566</a>
                </span>
            </td>
        </tr>
        <tbody>
            <tr>
                <td colspan="2" style="padding: 0px;">
                
                    @if($booking->selected_company == 1 && $bookingTypes[0] == 'Flight')
                    <img style="height: 200px; width: 100%; object-fit: cover; display: block; object-position: top right;"
                        src="{{ public_path('email-templates/flydreamz-flight.png') }}" alt="flight">
                    @elseif($booking->selected_company == 1 && $bookingTypes[0] == 'Cruise')
                    <img style="height: 200px; width: 100%; object-fit: cover; display: block; object-position: top right;"
                        src="{{ public_path('email-templates/flydreamz-cruise.png') }}" alt="cruise">
                    @elseif($booking->selected_company == 1 && $bookingTypes[0] == 'Hotel')
                    <img style="height: 200px; width: 100%; object-fit: cover; display: block; object-position: top right;"
                        src="{{ public_path('email-templates/flydreamz-hotel.png') }}" alt="hotel">
                    @elseif($booking->selected_company == 1 && $bookingTypes[0] == 'Train')
                    <img style="height: 200px; width: 100%; object-fit: cover; display: block; object-position: top right;"
                        src="{{ public_path('email-templates/flydreamz-train.png') }}" alt="train">
                    @elseif($booking->selected_company == 2 && $bookingTypes[0] == 'Cruise')
                    <img style="height: 200px; width: 100%; object-fit: cover; display: block; object-position: top right;"
                        src="{{ public_path('email-templates/fare-tickets-cruise.png') }}" alt="cruise">
                    @elseif($booking->selected_company == 2 && $bookingTypes[0] == 'Flight')
                    <img style="height: 200px; width: 100%; object-fit: cover; display: block; object-position: top right;"
                        src="{{ public_path('email-templates/fare-tickets-flight.png') }}" alt="flight">
                    @elseif($booking->selected_company == 2 && $bookingTypes[0] == 'Hotel')
                    <img style="height: 200px; width: 100%; object-fit: cover; display: block; object-position: top right;"
                        src="{{ public_path('email-templates/fare-tickets-hotel.png') }}" alt="hotel">
                    @elseif($booking->selected_company == 2 && $bookingTypes[0] == 'Train')
                    <img style="height: 200px; width: 100%; object-fit: cover; display: block; object-position: top right;"
                        src="{{ public_path('email-templates/fare-tickets-train.png') }}" alt="train">
                    @else
                    <img style="height: 200px; width: 100%; object-fit: cover; display: block; object-position: top right;"
                        src="{{ public_path('email-templates/flight-banner.png') }}" alt="default">
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
                <td style="padding: 0 15px 0 30px; width: 50%;">
                    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin-top: 10px; text-align: center; border: 1px solid #e9ecef; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <div style="margin-bottom: 12px;"> 
                            <img width="20" src="{{ public_path('email-templates/sku.png') }}" alt="Number"> 
                        </div>
                        <div style="font-size: 14px; font-weight: 600; color: #2d3748; margin-bottom: 0px;">Order Reference Number</div>
                        <div style="font-size: 14px; color: #4a5568; font-weight: 500;">{{ $booking->pnr }}</div>
                    </div>
                </td>

                <td style="padding: 0 30px 0 15px; width: 50%;">
                    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin-top: 10px; text-align: center; border: 1px solid #e9ecef; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <div style="margin-bottom: 12px;"> 
                            <img width="20" src="{{ public_path('email-templates/event.png') }}" alt="Number"> 
                        </div>
                        <div style="font-size: 14px; font-weight: 600; color: #2d3748; margin-bottom: 0px;">Order Date</div>
                        <div style="font-size: 14px; color: #4a5568; font-weight: 500;">{{ $booking->created_at->format('l, M d, Y') }}</div>
                    </div>
                </td>
            </tr>

            <!-------------Flight --------------->
            @if(in_array('Flight', $bookingTypes))
            <tr>
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="width:100%; border-radius: 8px; overflow: hidden; border: 1px solid #e9ecef; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <div style=" font-size:16px; font-weight:600; color:#1a2a6c; padding:10px 20px; background-color: #f8f9fa; border-bottom:1px solid #e9ecef;">
                            Flight Details
                        </div>
                        <div style="padding: 10px 20px;">
                            @if($booking->travelFlight->isNotEmpty())    
                                @foreach($booking->travelFlight as $index => $flight)
                                <div style="display: flex; align-items: flex-start; margin-bottom: 18px; padding-bottom: 0px; border-bottom: 1px solid #e9ecef; flex-wrap: wrap;">
                                    <div style="flex-shrink: 0; margin-right: 15px; margin-bottom: 15px;">
                                        @php
                                            $airline = \App\Models\Airline::where('airline_code', $flight->airline_code)->first();
                                            if ($airline && $airline->logo) {
                                                $logoPath = $airline->logo;
                                            } else {
                                                $logoPath = public_path('email-templates/default-airline.png');
                                            }
                                        @endphp
                                        <img src="{{ $logoPath }}" alt="airline logo" style="height:35px; width:75px; object-fit: contain;">
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
                                        @if($flight->transit && $flight->transit != '00:00')                                        <div style="color: #718096; font-size:13px; margin-top:0px; padding: 8px 0;">
                                            <div>-------- Transit Time: {{$flight->transit }} --------</div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            @endif

                            @if($flight_images)
                                @foreach ($flight_images as $key => $img)
                                    <div style="padding-top: 10px;">
                                        <img src="{{ public_path($img->file_path) }}" style="max-width: 100%; height: auto; border-radius: 6px;">
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
            <tr>
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="width:100%; border-radius: 0px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style=" font-size:16px; font-weight:600; color:#1a2a6c; padding:10px 20px; background-color: #f8f9fa; border-bottom:1px solid #e9ecef;">
                            Hotel Details
                        </div>
                        <div style="padding: 10px;">
                            <div style="padding:0; margin-bottom: 20px;">
                                <img src="{{ public_path('email-templates/bedroom.jpg') }}" alt="Hotel" style="width:100%; height:200px; border-radius:0px; object-fit: cover;">
                            </div>
                            
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
                                @endforeach
                            </div>
                            
                            <div style="padding:0px; padding-left: 0; color:#4a5568;">
                                <div style="white-space: pre-line; font-size: 14px; line-height: 1.3;">{!! $booking->hotel_description !!}</div>
                            </div>
                            
                            @if($hotel_images)
                                @foreach ($hotel_images as $key => $img)
                                <div style="padding: 10px 0;">
                                    <img src="{{ public_path($img->file_path) }}" style="max-width: 100%; height: auto; border-radius: 6px;">
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
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="width:100%; border-radius: 0px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style=" font-size:16px; font-weight:600; color:#1a2a6c; padding:10px 20px; background-color: #f8f9fa; border-bottom:1px solid #e9ecef;">
                            Cruise Details
                        </div>
                        <div style="padding: 10px 20px;">
                            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 00px;">
                                <div style="flex: 1; min-width: 300px;    margin-bottom: -10px;">
                                    <div style=" font-size:16px; font-weight:600; color:#1a2a6c; padding:10px 20px; background-color: #f8f9fa; border-bottom:1px solid #e9ecef;">
                                    <div style="display: flex; justify-content: space-between;">
    <span>{{ $travel_cruise_data->cruise_line ?? '' }}</span>
    <span>{{ $travel_cruise_data->ship_name ?? '' }}</span>
</div>
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
                                    <img src="{{ public_path($img->file_path) }}" style="max-width: 100%; height: auto; border-radius: 6px;">
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
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="width:100%; border-radius: 0px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style=" font-size:16px; font-weight:600; color:#1a2a6c; padding:10px 20px; background-color: #f8f9fa; border-bottom:1px solid #e9ecef;">
                            Car Details
                        </div>
                       <div style="padding: 0px; background-color: #ffffff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333;">
                    <div style="display: flex; flex-wrap: wrap; gap: 5px; border-radius: 0px; padding: 10px 20px 0px;">
                        <div style="flex: 1;">
                            <div style="font-size: 14px; font-weight: 600; color: #1a2a6c; border-bottom: 2px solid #e0e0e0; padding-bottom: 5px;">
                                Pick-up and Drop-off
                            </div>

                            @foreach($booking->travelCar as $travelCar)
                                <table style="width: 100%; border-collapse: separate; border-spacing: 0 10px; font-size: 14px; color: #555; ">
                                    @if($travelCar->car_rental_provider)
                                    <tr>
                                         <td style="font-weight: 500;background-color: #fafafa;  border-radius: 0px;  color: #2d3748; font-size: 14px;">Car Rental Provider :</td>
                                         <td style="font-weight: 400;background-color: #fafafa;  border-radius: 0px;  color: #2d3748; font-size: 14px;">{{ $travelCar->car_rental_provider }}</td>
                                    </tr>                                
                                    @endif

                                    @if($travelCar->car_type)
                                    <tr>
                                        <td style="font-weight: 500;background-color: #fafafa;  border-radius: 0px;  color: #2d3748; font-size: 14px;">Car Type :</td>
                                        <td style="font-weight: 400;background-color: #fafafa;  border-radius: 0px;  color: #2d3748; font-size: 14px;">{{ $travelCar->car_type }}</td>
                                    </tr>
                                    @endif

                                    @if($travelCar->confirmation_number)
                                    <tr>
                                        <td style="font-weight: 500;background-color: #fafafa;  border-radius: 0px;  color: #2d3748; font-size: 14px;">Confirmation Number :</td>
                                        <td style="font-weight: 400;background-color: #fafafa;  border-radius: 0px;  color: #2d3748; font-size: 14px;">{{ $travelCar->confirmation_number }}</td>
                                    </tr>
                                    @endif

                                    @if($travelCar->rental_provider_address)
                                    <tr>
                                        <td style="font-weight: 600; padding: 14px; background-color: #fafafa; border-radius: 6px; color: #2d3748;">Rental Provider Address</td>
                                        <td style="padding: 14px; background-color: #fafafa; border-radius: 6px;">{{ $travelCar->rental_provider_address }}</td>
                                    </tr>
                                    @endif
                                </table>

                                <div style="padding: 6px;background-color: #f8f9fa;border-radius: 0px; margin-bottom: 10px;">
                                    <div style="font-size: 14px; font-weight: 600; color: #1a202c; ">Pickup :  ⭕ {{ $travelCar->pickup_date?->format('D, M j') }} - {{ $travelCar->pickup_time }} , 
                                        <span style="font-weight: 600;">{{ $travelCar->pickup_location }}</span>
                                    </div>

                                    <div style="font-size: 14px; font-weight: 600; color: #1a202c; ">Drop-off : ⭕ {{ $travelCar->dropoff_date?->format('D, M j') }} - {{ $travelCar->dropoff_time }} ,
                                        <span style="font-weight: 600;">{{ $travelCar->dropoff_location }}</span>
                                    </div>
                                </div>
                            @endforeach

                            <div style="font-size: 14px; line-height: 1.6; color: #555; white-space: pre-line;">
                                {!! $booking->car_description !!}
                                </div>
                        </div>
                    </div>

                    @if($car_images)
                        @foreach ($car_images as $img)
                        <div style="padding: 15px 0;">
                            <img src="{{ public_path($img->file_path) }}" style="max-width: 100%; height: auto; border-radius: 10px; box-shadow: 0 3px 8px rgba(0,0,0,0.1);">
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
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="width:100%; border-radius: 0px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style="f font-size:16px; font-weight:600; color:#1a2a6c; padding:10px 20px; background-color: #f8f9fa; border-bottom:1px solid #e9ecef;">
                            Train Details
                        </div>
                        <div style="padding: 10px;">
                            @foreach($booking->trainBookingDetails as $key=>$trainBookingDetails)
                            <div style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #e9ecef;">
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

                               <div style="padding: 20px 0; font-size: 14px; color: #4a5568; background-color: #f8f9fa; border-radius: 0px;">
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); align-items: center; gap: 10px; text-align: center;">
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

        <div>
            <div style="font-size: 20px; font-weight: bold; color: #1a2a6c;">
                {{ date('h:i A', strtotime($trainBookingDetails->departure_hours)) }}
            </div>
            <div style="font-size: 12px; color: #718096; ">DEPARTS</div>
        </div>

        <div>
            <div style="font-size: 20px; color: #1a2a6c;">→</div>
            <div style="font-size: 12px; color: #718096; ">
                {{ $trainBookingDetails->transit }}
            </div>
        </div>

        <div>
            <div style="font-size: 20px; font-weight: bold; color: #1a2a6c;">
                {{ date('h:i A', strtotime($trainBookingDetails->arrival_hours)) }}
            </div>
            <div style="font-size: 12px; color: #718096; ">ARRIVES</div>
        </div>
    </div>
</div>

                                <div style="background: #e6eeff;padding: 10px;font-size: 12px;color: #1a2a6c;margin-top: 10px;">
                                    <div style="white-space: pre-line; line-height: 1.6;">{!! $booking->train_description !!}</div>
                                </div>
                            </div>
                            @endforeach

                            @if($train_images)
                                @foreach ($train_images as $key => $img)
                                <div style="padding: 10px 0;">
                                    <img src="{{ public_path($img->file_path) }}" style="max-width: 100%; height: auto; border-radius: 6px;">
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            @endif

            <tr>
                <td colspan="2" style="padding: 5px 30px 0px 30px;">
                    <div style="border-radius: 8px; overflow: hidden; border: 1px solid #e9ecef; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <div style="font-weight: 600;color: #1a2a6c;padding: 10px 20px;background-color: #e5e7eb;border-bottom: 1px solid #e9ecef;">
                            Customer Information
                        </div>
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="width: 50%; padding: 10px 20px; border-right: 1px solid #e9ecef; vertical-align: top;">
                                    <div style="margin-bottom: 15px;">
                                        <div style="font-size: 14px; font-weight: 600; color: #2d3748; margin-bottom: 5px;">Card Holder Name</div>
                                        <div style="font-size: 14px; color: #4a5568;">{{$billingPricingData->cc_holder_name}}</div>
                                    </div>
                                    <div style="margin-bottom: 15px;">
                                        <div style="font-size: 14px; font-weight: 600; color: #2d3748; margin-bottom: 5px;">Card Number</div>
                                        <div style="font-size: 14px; color: #4a5568;">
                                          {{ str_repeat('*', strlen($billingPricingData->cc_number) - 4) . substr($billingPricingData->cc_number, -4) }}
                                        </div>
                                    </div>
                                    <div style="margin-bottom: 15px;">
                                        <div style="font-size: 14px; font-weight: 600; color: #2d3748; margin-bottom: 5px;">Card Type</div>
                                        <div style="font-size: 14px; color: #4a5568;">{{$billingPricingData->card_type}}</div>
                                    </div>
                                </td>
                                <td style="width: 50%; padding: 10px 20px; vertical-align: top;">
                                    <div style="margin-bottom: 15px;">
                                        <div style="font-size: 14px; font-weight: 600; color: #2d3748; margin-bottom: 5px;">Email</div>
                                        <div style="font-size: 14px;">
                                            <a style="color: #1a56db; text-decoration: none;" href="mailto:{{$billingPricingData->email}}">{{$billingPricingData->email}}</a>
                                        </div>
                                    </div>
                                    <div style="margin-bottom: 15px;">
                                        <div style="font-size: 14px; font-weight: 600; color: #2d3748; margin-bottom: 5px;">Booking Date</div>
                                        <div style="font-size: 14px; color: #4a5568;">{{ $booking->created_at->format('l, M d, Y') }}</div>
                                    </div>
                                    @if($booking->airlinepnr || $booking->cruise_ref || $booking->car_ref || $booking->train_ref)
                                    <div style="margin-bottom: 15px;">
                                        <div style="font-size: 14px; font-weight: 600; color: #2d3748; margin-bottom: 5px;">Reference</div>
                                        <div style="font-size: 14px; color: #4a5568;">
                                            @if($booking->airlinepnr){{ $booking->airlinepnr }}@endif
                                            @if($booking->cruise_ref){{ $booking->cruise_ref }}@endif
                                            @if($booking->car_ref){{ $booking->car_ref }}@endif
                                            @if($booking->train_ref){{ $booking->train_ref }}@endif
                                        </div>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>

            <!------Passenger -------->
            <tr>
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="border-radius: 0px; overflow: hidden; border: 1px solid #e9ecef;">
                        <div style="font-weight: 600;color: #1a2a6c;padding: 10px 20px;background-color: #e5e7eb;border-bottom: 1px solid #e9ecef;">
                            Passenger Details
                        </div>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background-color: #f8f9fa;">
                                        <th style="font-size: 14px; font-weight: 600; padding: 8px 20px; text-align: left; color: #2d3748; border-bottom: 1px solid #e9ecef;">Type</th>
                                        <th style="font-size: 14px; font-weight: 600; padding: 8px 20px; text-align: left; color: #2d3748; border-bottom: 1px solid #e9ecef;">Passenger Name</th>
                                        @if($booking->passengers->whereNotNull('seat_number')->count() > 0)
                                        <th style="font-size: 14px; font-weight: 600; padding: 8px 20px; text-align: left; color: #2d3748; border-bottom: 1px solid #e9ecef;">Seat</th>
                                        @endif
                                        @if($booking->passengers->whereNotNull('e_ticket_number')->count() > 0)
                                        <th style="font-size: 14px; font-weight: 600; padding: 8px 20px; text-align: left; color: #2d3748; border-bottom: 1px solid #e9ecef;">E-Ticket</th>
                                        @endif
                                        @if($booking->passengers->whereNotNull('room_category')->count() > 0)
                                        <th style="font-size: 14px; font-weight: 600; padding: 8px 20px; text-align: left; color: #2d3748; border-bottom: 1px solid #e9ecef;">Room Category</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($booking->passengers as $key=>$passengers)
                                    <tr>
                                        <td style="font-size: 14px; color: #4a5568; padding: 8px 20px; border-bottom: 1px solid #e9ecef;">{{$passengers->passenger_type}}</td>
                                        <td style="font-size: 14px; color: #4a5568; padding: 8px 20px; border-bottom: 1px solid #e9ecef;">{{$passengers->title}} {{$passengers->first_name}} {{$passengers->middle_name}} {{$passengers->last_name}}</td>
                                        @if($booking->passengers->whereNotNull('seat_number')->count() > 0)
                                        <td style="font-size: 14px; color: #4a5568; padding: 8px 20px; border-bottom: 1px solid #e9ecef;">{{$passengers->seat_number}}</td>
                                        @endif
                                        @if($booking->passengers->whereNotNull('e_ticket_number')->count() > 0)
                                        <td style="font-size: 14px; color: #4a5568; padding: 8px 20px; border-bottom: 1px solid #e9ecef;">{{$passengers->e_ticket_number}}</td>
                                        @endif
                                        @if($booking->passengers->whereNotNull('room_category')->count() > 0)
                                        <td style="font-size: 14px; color: #4a5568; padding: 8px 20px; border-bottom: 1px solid #e9ecef;">{{$passengers->room_category}}</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>

            <!-------Start Price --------->
            <tr class="price-details">
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="border-radius: 8px; overflow: hidden; border: 1px solid #e9ecef; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <div style="    font-weight: 600;color: #1a2a6c;padding: 10px 20px;background-color: #e5e7eb;border-bottom: 1px solid #e9ecef;">
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

        @if($booking->query_type == 26 || $booking->query_type  == 27 || $booking->query_type  == 49 || $booking->query_type  == 2 || $booking->query_type  == 38 || $booking->query_type  == 30 || $booking->query_type  == 46)
          @foreach($booking->pricingDetails as $ExcursionPrice)  
            <table style="width: 100%; border-collapse: collapse; padding: 10px 0; border-bottom: 1px solid #e9ecef;">
                <tr>
                    <td style="font-size: 14px; color: #2d3748; text-align: left; padding: 10px 0;">{{$ExcursionPrice->details}}, per person:</td>
                    <td style="font-size: 16px; color: #0f9b0f; text-align: right; padding: 10px 0;">${{$ExcursionPrice->gross_price}}</td>
                </tr>
            </table>
            
            @if($booking->query_type == 26)
                <div style="font-size: 10px; color: #666; padding: 0 0 10px 0;">inc. taxes & fees.</div>
            @endif
          @endforeach
        @else
                @if(in_array($booking->query_type, [11,12]))
                <table style="width: 100%; border-collapse: collapse; padding: 10px 0; border-bottom: 1px solid #e9ecef;">
                    <tr>
                        <td style="font-size: 14px; color: #2d3748; text-align: left; padding: 10px 0;"> Pet in cargo Fees  :</td>
                        <td style="font-size: 16px; color: #0f9b0f; text-align: right; padding: 10px 0;"> ${{ number_format(array_sum($mergedPrices), 2) }}</td>
                    </tr>
                </table>
                @else                                   
                            @foreach($mergedPrices as $passengerType => $totalPrice)
                            <table style="width: 100%; border-collapse: collapse; padding: 10px 0; border-bottom: 1px solid #e9ecef;">
                                <tr>
                                    <td style="font-size: 14px; color: #2d3748; text-align: left; padding: 10px 0;">
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
                                        @elseif($booking->query_type == 13 || $booking->query_type == 14  || $booking->query_type ==18  || $booking->query_type == 19  || $booking->query_type == 20  || $booking->query_type ==29  || $booking->query_type == 33  || $booking->query_type == 34  || $booking->query_type == 41  || $booking->query_type == 43  || $booking->query_type == 44  || $booking->query_type == 50  || $booking->query_type == 51) 
                                            Cancellation fee per person - ({{ ucfirst($passengerType) }}) 
                                        @else 
                                            Total Price per person including taxes and fees. ({{ ucfirst($passengerType) }})
                                        @endif
                                    </td>
                                    <td style="font-size: 16px; color: #0f9b0f; text-align: right; padding: 10px 0;">
                                        ${{ number_format($totalPrice, 2) }}
                                    </td>
                                </tr>
                            </table>
                            @endforeach
                @endif
        @endif 

                            <table style="width: 100%; border-collapse: collapse; padding: 10px 0;">
                                <tr>
                                    <td style="font-size: 14px; font-weight: 600; color: #2d3748; text-align: left; padding: 10px 0;">Total Amount including taxes & Fees. </td>
                                    <td style="font-size: 16px; font-weight: 600; color: #0f9b0f; text-align: right; padding: 10px 0;">
                                        ${{ number_format($booking->gross_value, 2) }}
                                    </td>
                                </tr>
                            </table>                                      

                            <div style="margin-top: 10px; padding:  10px 20px; background-color: #f8f9fa; border-radius: 0px;">
                                <ul style="margin: 0; padding-left: 20px; color: #4a5568; font-size: 12px;">
                                    <li style="margin-bottom: 10px; line-height: 1.6;">
                                        <strong>All transactions</strong> will be processed in US Dollars (USD). If your card was issued in a country other than the USA, your card issuer may charge a currency conversion fee of up to 4% of the total amount charged. Kindly check with your financial institution for more information.
                                    </li>
                                    
                                     @if($booking->query_type != 13 || $booking->query_type != 14  || $booking->query_type != 18  || $booking->query_type != 19  || $booking->query_type != 20  || $booking->query_type != 29  || $booking->query_type != 33  || $booking->query_type != 34  || $booking->query_type != 41  || $booking->query_type != 43  || $booking->query_type != 44  || $booking->query_type != 50  || $booking->query_type != 51)
                                        <li style="line-height: 1.6;">
                                            <strong>Prices are not guaranteed</strong> until the ticket number(s) are issued. Prices may change based on airline inventory availability.
                                        </li>
                                     @endif  
                                </ul>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>


            <tr>
                <td colspan="2" style="padding: 10px 30px 0px 30px;">
                    <div style="border-radius: 8px; overflow: hidden; border: 1px solid #e9ecef; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <div style="font-weight: 400; font-size: 14px; color: #1a2a6c; padding: 10px 20px; background-color: #e5e7eb; border-bottom: 1px solid #e9ecef;">
                            Disclaimer:
                        </div>
                        <div style="padding: 10px 20px;">
                            <div style="font-size: 12px; color: #4a5568; line-height: 1.6;">
                                <p style="margin-bottom: 5px;">I,&nbsp;<strong>{{$billingPricingData->cc_holder_name}} </strong>, hereby acknowledge receipt of this communication outlining the associated charges. I have thoroughly reviewed and confirmed the accuracy of the itinerary, including all passenger names, flight schedules, dates, and times.</p>
                                <p style="margin-bottom: 5px;">I acknowledge and accept that the total cost of the booking is <strong>USD {{ number_format($booking->gross_value, 2) }} </strong>, which will be processed through <strong>single or multiple transactions</strong>. I understand that, regardless of the number of transactions, the <strong>total amount charged will not exceed USD {{ number_format($booking->gross_value, 2) }} </strong>.</p>
                                <p style="margin-bottom: 5px;">I further acknowledge that the charges may appear on my credit card statements under one or more of the following descriptors: <br> {{ $booking->descriptor }}
                                <strong>{{ $booking->selected_company_name }}</strong>.</p>
                                <p style="margin-bottom: 5px;">By this statement, I hereby authorize <strong>{{ $booking->selected_company_name }}</strong> and its affiliated service providers to charge the following amounts to my cards for the related travel services:</p>
                                
                                <ul style="margin-top: 10px; margin-bottom: -6px;">
                                    @foreach($billingPricingDataAll as $billing)
                                    <li style="margin-bottom: 10px;"><b> USD {{ number_format($billing->authorized_amt, 2) }} </b> to my <b> {{ $billing->card_type }} ending in 
                                      **** **** ****  {{ substr($billing->cc_number, -4) }}                                       
                                    </b></li>
                                    @endforeach                                                  
                                </ul>
                                <p style="margin-top: 5px;">I confirm that I am the authorized cardholder for the above payment methods and consent to the processing of these charges as outlined.</p>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 0px 30px 20px 30px;">
                    <!-- Terms and Conditions -->
                    <div style="margin-bottom: 12px;">
                        <div style="display: flex; align-items: center; font-size: 14px; color: #4a5568;">
                             @{{Checkbox}}
                            <a href="{{ route('terms-and-conditions') }}" target="_blank" 
                            style="color: #1a56db; text-decoration: none;">
                            I have read and agree to the Terms and Conditions
                            </a>
                        </div>
                    </div>        
                </td>
            </tr>


            <tr>
                <td colspan="2" style="padding: 0px 30px 20px 30px;">
                    <!-- Signature Space -->
                    <div style="margin-top: 30px; text-align: right;">
                        <div style="width: 200px; height: 60px; border-bottom: 2px solid #1a2a6c; margin-left: auto; margin-bottom: 10px;">@{{S}}</div>
                        <label style="font-size: 16px; font-weight: 600; color: #1a2a6c; display: inline-block;">
                            Signature
                        </label>
                    </div> 
                </td>
            </tr>


        </tbody>
        <tfoot style="background: linear-gradient(135deg, #1a2a6c, #2b5876);">
            <tr>
                <td colspan="2" style="padding: 10px 30px; text-align: center;">
                    <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 5px;">
                        <a href="https://www.instagram.com/flydreamz_/" target="_blank" style="margin: 0 10px; display: inline-block; transition: transform 0.3s;"" onmouseout="this.style.transform='none'">
                            <img width="24" src="{{ public_path('email-templates/instagram.png') }}" alt="instagram">
                        </a>
                        <a href="https://x.com/_flydreamz" target="_blank" style="margin: 0 10px; display: inline-block; transition: transform 0.3s;"" onmouseout="this.style.transform='none'">
                            <img width="24" src="{{ public_path('email-templates/twitter.png') }}" alt="twitter">
                        </a>
                    </div>
                    <div style="font-size: 14px; font-weight: 400; color: #e2e8f0; text-align: center;">
                        © {{ date('Y') }} All Rights Reserved.
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
    
</body>
</html>