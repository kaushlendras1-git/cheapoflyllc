<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Authorization</title>
    <style>
        @page {
            margin: 15px;
            size: A4;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.3;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header-only-first {
            background-color: #1a2a6c;
            color: white;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 14px;
        }
        .section-title {
            background-color: #f0f8ff;
            color: #1a2a6c;
            font-weight: bold;
            padding: 6px 10px;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
        }
        .content-box {
            border: 1px solid #ddd;
            margin-bottom: 8px;
        }
        .content {
            padding: 8px 10px;
        }
        .price-green {
            color: #0f9b0f;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .flex-between {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4px 0;
        }
        .border-bottom {
            border-bottom: 1px solid #eee;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }
        th, td {
            padding: 4px 6px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .footer {
            background-color: #1a2a6c;
            color: white;
            text-align: center;
            padding: 8px;
            font-size: 10px;
        }
        .booking-ref {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            margin: 5px 0;
        }
        .disclaimer {
            font-size: 9px;
            line-height: 1.4;
        }
    </style>
</head>
@php
$bookingTypes = $booking->bookingTypes->pluck('type')->toArray();
@endphp

<body>
    <!-- Header - Only on first page -->
    <div class="header-only-first text-center">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span>Speak to a Travel Expert</span>
            <span>📞 +1-844-382-2225</span>
        </div>
    </div>

    <!-- Booking Type Banner -->
    <div class="text-center" style="padding: 15px; background-color: #f0f8ff; margin-bottom: 10px;">
        <h2 style="color: #1a2a6c; margin: 0; font-size: 16px;">{{ ucfirst($bookingTypes[0] ?? 'Travel') }} Booking Authorization</h2>
    </div>

    <!-- Customer Greeting -->
    <div class="content" style="font-weight: bold; margin-bottom: 8px;">
        Dear {{ $booking->name }},
    </div>
    <div class="content" style="margin-bottom: 15px;">
        Thank you for using {{ $booking->selected_company_name }} for your travel needs. Please review the details below.
    </div>

    <!-- Booking Reference -->
    <div style="display: flex; gap: 10px; margin-bottom: 15px;">
        <div class="booking-ref" style="flex: 1;">
            <div style="font-weight: bold; margin-bottom: 3px;">Booking Reference</div>
            <div>{{ $booking->pnr }}</div>
        </div>
        <div class="booking-ref" style="flex: 1;">
            <div style="font-weight: bold; margin-bottom: 3px;">Booking Date</div>
            <div>{{ $booking->created_at->format('M d, Y') }}</div>
        </div>
    </div>

    <!-- Flight Details -->
    @if(in_array('Flight', $bookingTypes))
    @php $allAirlines = []; @endphp
    <div class="content-box">
        <div class="section-title">Flight Details</div>
        <div class="content">
            @foreach($booking->travelFlight as $flight)
            <div style="margin-bottom: 10px; padding-bottom: 8px; border-bottom: 1px solid #eee;">
                <div style="font-weight: bold;">{{ $flight->departure_date?->format('D, M j') }} - {{$flight->airline_code}} {{$flight->flight_number}}</div>
                <div>Departing: {{ date('h:i A', strtotime($flight->departure_hours)) }} from {{$flight->departure_airport}}</div>
                <div>Arriving: {{ date('h:i A', strtotime($flight->arrival_hours)) }} into {{$flight->arrival_airport}}</div>
                @if($flight->transit)
                <div style="color: #666; font-size: 10px;">Transit: {{$flight->transit}}</div>
                @endif
            </div>
            @php 
                $codes = explode(',', $flight->airline_code);
                $allAirlines = array_unique(array_merge($allAirlines, $codes));
            @endphp
            @endforeach
        </div>
    </div>
    @endif

    <!-- Hotel Details -->
    @if(in_array('Hotel', $bookingTypes) && $booking->travelHotel->isNotEmpty())
    @php $allHotelNames = []; @endphp
    <div class="content-box">
        <div class="section-title">Hotel Details</div>
        <div class="content">
            @foreach($booking->travelHotel as $hotel)
            <div style="margin-bottom: 8px;">
                <div style="font-weight: bold;">{{$hotel->hotel_name}}</div>
                <div>Room: {{$hotel->room_category}} | Confirmation: {{$hotel->confirmation_number}}</div>
                <div>Check-in: {{ $hotel->checkin_date?->format('M d, Y') }} | Check-out: {{ $hotel->checkout_date?->format('M d, Y') }}</div>
                <div>Address: {{$hotel->hotel_address}}</div>
            </div>
            @php 
                $hotel_names = explode(',', $hotel->hotel_name);
                $allHotelNames = array_unique(array_merge($allHotelNames, $hotel_names));
            @endphp
            @endforeach
        </div>
    </div>
    @endif

    <!-- Customer Information -->
    <div class="content-box">
        <div class="section-title">Customer Information</div>
        <div class="content">
            <div class="flex-between border-bottom">
                <span style="font-weight: bold;">Card Holder Name</span>
                <span>{{$billingPricingData->cc_holder_name}}</span>
            </div>
            <div class="flex-between border-bottom">
                <span style="font-weight: bold;">Email</span>
                <span>{{$billingPricingData->email}}</span>
            </div>
            <div class="flex-between">
                <span style="font-weight: bold;">Airline Ref</span>
                <span>{{ $booking->airlinepnr }}</span>
            </div>
        </div>
    </div>

    <!-- Passenger Details -->
    @if($booking->passengers->isNotEmpty())
    <div class="content-box">
        <div class="section-title">Passenger Details</div>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Passenger Name</th>
                        <th>Seat</th>
                        <th>E-Ticket</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($booking->passengers as $passenger)
                    <tr>
                        <td>{{$passenger->passenger_type}}</td>
                        <td>{{$passenger->title}} {{$passenger->first_name}} {{$passenger->last_name}}</td>
                        <td>{{$passenger->seat_number}}</td>
                        <td>{{$passenger->e_ticket_number}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Price Details -->
    <div class="content-box">
        <div class="section-title">Price Details (USD)</div>
        <div class="content">
            <div class="flex-between border-bottom">
                <span style="font-weight: bold;">Total Price including taxes and fees</span>
                <span class="price-green">${{ number_format($billingPricingData->authorized_amt, 2) }}</span>
            </div>
            <div style="margin-top: 8px; font-size: 9px; color: #666;">
                <div style="margin-bottom: 5px;">• All transactions processed in USD. Currency conversion fees may apply.</div>
                <div>• Prices not guaranteed until ticket numbers are issued.</div>
            </div>
        </div>
    </div>

    <!-- Disclaimer -->
    <div class="content-box">
        <div class="section-title">Authorization & Disclaimer</div>
        <div class="content disclaimer">
            <p>I, <strong>{{$billingPricingData->cc_holder_name}}</strong>, acknowledge receipt of this communication and confirm the accuracy of the itinerary details.</p>
            <p>I accept the total booking cost of <strong>USD {{ number_format($booking->gross_mco, 2) }}</strong> to be processed through single or multiple transactions, not exceeding this amount.</p>
            <p>Charges may appear under: {{ !empty($allAirlines) ? implode(', ', $allAirlines) : '' }} {{ !empty($allHotelNames) ? implode(', ', $allHotelNames) : '' }}, <strong>{{ $booking->selected_company_name }}</strong>, or <strong>{{$booking->reservation_source}}</strong>.</p>
            <p>I authorize <strong>{{ $booking->selected_company_name }}</strong> to charge my payment methods for these travel services and confirm I am the authorized cardholder.</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div>Follow us: Instagram | Twitter</div>
        <div>© {{ date('Y') }} All Rights Reserved.</div>
    </div>
</body>
</html>