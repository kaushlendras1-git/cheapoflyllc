<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Utils\JsonResponse;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\TravelBooking;
use App\Models\TravelBookingType;
use App\Models\TravelSectorDetail;
use App\Models\TravelPassenger;
use App\Models\TravelBillingDetail;
use App\Models\TravelPricingDetail;
use App\Models\TravelBookingRemark;
use App\Models\TravelQualityFeedback;
use App\Models\TravelScreenshot;
use App\Models\TravelFlightDetail;
use App\Models\TravelCarDetail;
use App\Models\TravelCruiseDetail;
use App\Models\TravelHotelDetail;
use App\Models\ChangeLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Hashids\Hashids;
use Carbon\Carbon;
use App\Traits\Loggable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BookingFormController extends Controller
{
    protected $hashids;
    protected $logController;

    public function __construct()
    {
        // Initialize Hashids with salt and length from config
        $this->hashids = new Hashids(config('hashids.salt'), config('hashids.length', 8));
    }

    public function index()
    {
        // Fetch paginated bookings, 15 records per page
        $bookings = TravelBooking::paginate(10);
        $hashids = new Hashids(config('hashids.salt'), config('hashids.length', 8));
        return view('web.booking.index', compact('bookings','hashids'));
    }

    public function search(){
        $bookings = TravelBooking::paginate(10);
        $hashids = new Hashids(config('hashids.salt'), config('hashids.length', 8));
        return view('web.booking.search', compact('bookings','hashids'));
    }


    public function store(Request $request)
    {
        try{
            $request->validate( [
                'pnr' => 'required|string|max:255',
                'hotel_ref' => 'nullable|string|max:255',
                'cruise_ref' => 'nullable|string|max:255',
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'query_type' => 'nullable|string|max:255',
                'selected_company' => 'required|string|max:255',
                'booking_status' => 'required|string|max:255',
                'payment_status' => 'required|string|max:255',
                'reservation_source' => 'nullable|string|max:255',
                'descriptor' => 'nullable|string|max:255',
                'amadeus_sabre_pnr' => 'nullable|string|max:255',
                'sector_details.*' => 'required|file|image|max:2048',
                'passenger' => 'required|array|min:1',
                'passenger.*.passenger_type' => 'required|string|in:Adult,Child,Infant',
                'passenger.*.gender' => 'required|string|in:Male,Female,Other',
                'passenger.*.title' => 'nullable|string|in:Mr,Ms,Mrs,Dr',
                'passenger.*.first_name' => 'required|string',
                'passenger.*.middle_name' => 'nullable|string',
                'passenger.*.last_name' => 'required|string',
                'passenger.*.dob' => 'required|date|before:today',
                'passenger.*.seat_number' => 'nullable|string',
                'passenger.*.credit_note' => 'nullable|numeric',
                'passenger.*.e_ticket_number' => 'nullable|string',
                'billing' => 'required|array|min:1',
                'billing.*.card_type' => 'required|string|in:VISA,MasterCard,AMEX,Discover',
                'billing.*.cc_number' => 'required|digits_between:13,19',
                'billing.*.cc_holder_name' => 'required|string',
                'billing.*.exp_month' => 'required|digits:2',
                'billing.*.exp_year' => 'required|digits:4',
                'billing.*.cvv' => 'required|digits_between:3,4',
                'billing.*.address' => 'required|string',
                'billing.*.email' => 'required|email',
                'billing.*.contact_no' => 'required|digits_between:8,15',
                'billing.*.city' => 'required|string',
                'billing.*.country' => 'required|string',
                'billing.*.state' => 'nullable|string',
                'billing.*.zip_code' => 'required|string',
                'billing.*.currency' => 'required|string|size:3',
                'billing.*.amount' => 'required|numeric|min:1',
                'pricing' => 'required|array|min:1',
                'pricing.*.passenger_type' => 'required|string|in:adult,child,infant',
                'pricing.*.num_passengers' => 'required|integer|min:1',
                'pricing.*.gross_price' => 'required|numeric|min:0',
                'pricing.*.net_price' => 'required|numeric|min:0',
                'pricing.*.details' => 'required|string',
            ],[
                'passenger.required' => 'Please provide at least one passenger.',
                'passenger.*.passenger_type.required' => 'Passenger type is required.',
                'passenger.*.passenger_type.in' => 'Passenger type must be Adult, Child, or Infant.',
                'passenger.*.gender.required' => 'Passenger Gender is required.',
                'passenger.*.gender.in' => 'Passenger Gender must be Male, Female, or Other.',
                'passenger.*.title.required' => 'Passenger Title is required (e.g., Mr, Ms, Mrs, Dr).',
                'passenger.*.title.in' => 'Passenger Title must be one of: Mr, Ms, Mrs, Dr.',
                'passenger.*.first_name.required' => 'Passenger First name is required.',
                'passenger.*.last_name.required' => 'Passenger Last name is required.',
                'passenger.*.dob.required' => 'Passenger Date of birth is required.',
                'passenger.*.dob.date' => 'Passenger Date of birth must be a valid date.',
                'passenger.*.dob.before' => 'Passenger Date of birth must be a past date.',
                'passenger.*.credit_note.numeric' => 'Passenger Credit note must be a number.',
                'billing.required' => 'Please provide at least one billing entry.',
                'billing.*.card_type.required' => 'Billing Card type is required.',
                'billing.*.card_type.in' => 'Billing Card type must be one of: VISA, MasterCard, AMEX, Discover.',
                'billing.*.cc_number.required' => 'Billing Card number is required.',
                'billing.*.cc_number.digits_between' => 'Billing Card number must be between 13 and 19 digits.',
                'billing.*.cc_holder_name.required' => 'Billing Card holder name is required.',
                'billing.*.exp_month.required' => 'Billing Expiration month is required.',
                'billing.*.exp_month.digits' => 'Billing Expiration month must be 2 digits.',
                'billing.*.exp_year.required' => 'Billing Expiration year is required.',
                'billing.*.exp_year.digits' => 'Billing Expiration year must be 4 digits.',
                'billing.*.cvv.required' => 'Billing CVV is required.',
                'billing.*.cvv.digits_between' => 'Billing CVV must be 3 or 4 digits.',
                'billing.*.address.required' => 'Billing address is required.',
                'billing.*.email.required' => 'Billing email is required.',
                'billing.*.email.email' => 'Billing email must be a valid email address.',
                'billing.*.contact_no.required' => 'Billing Contact number is required.',
                'billing.*.contact_no.digits_between' => 'Billing Contact number must be between 8 and 15 digits.',
                'billing.*.city.required' => 'Billing City is required.',
                'billing.*.country.required' => 'Billing Country is required.',
                'billing.*.zip_code.required' => 'Billing Zip code is required.',
                'billing.*.currency.required' => 'Billing Currency is required.',
                'billing.*.currency.size' => 'Billing Currency must be a 3-letter code (e.g., USD, EUR).',
                'billing.*.amount.required' => 'Billing Amount is required.',
                'billing.*.amount.numeric' => 'Billing Amount must be a valid number.',
                'billing.*.amount.min' => 'Billing Amount must be at least 1.',
                'pricing.required' => 'Please provide at least one pricing entry.',
                'pricing.*.passenger_type.required' => 'Pricing Passenger type is required.',
                'pricing.*.passenger_type.in' => 'Pricing Passenger type must be one of: adult, child, or infant.',
                'pricing.*.num_passengers.required' => 'Pricing Number of passengers is required.',
                'pricing.*.num_passengers.integer' => 'Pricing Number of passengers must be a whole number.',
                'pricing.*.num_passengers.min' => 'Pricing Number of passengers must be at least 1.',
                'pricing.*.gross_price.required' => 'Pricing Gross price is required.',
                'pricing.*.gross_price.numeric' => 'Pricing Gross price must be a valid number.',
                'pricing.*.gross_price.min' => 'Pricing Gross price cannot be negative.',
                'pricing.*.net_price.required' => 'Pricing Net price is required.',
                'pricing.*.net_price.numeric' => 'Pricing Net price must be a valid number.',
                'pricing.*.net_price.min' => 'Pricing Net price cannot be negative.',
                'pricing.*.details.required' => 'Pricing Details field is required.',
            ]);


            if ($request->hasFile('sector_details')) {
                foreach ($request->file('sector_details') as $file) {
                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/sector_details'), $fileName);
                }
            }


            // try {
            DB::beginTransaction();

            // Create Travel Booking
            $bookingData = $request->only([
                'pnr',
                'campaign',
                'hotel_ref',
                'cruise_ref',
                'name',
                'phone',
                'email',
                'query_type',
                'selected_company',
                'booking_status',
                'payment_status',
                'reservation_source',
                'descriptor',
                'amadeus_sabre_pnr',
            ]);

            $campaign = substr(strtoupper($request->input('campaign')), 0, 3);
            $bookingData['pnr'] = $campaign . $request->input('pnr');
            $bookingData['user_id'] = auth()->id();
            $booking = TravelBooking::create($bookingData);

            if(isset($fileName)){
                TravelSectorDetail::create([
                    'booking_id' => $booking->id,
                    'sector_type' => $fileName,
                ]);
            }

            // Create Booking Types
            foreach ($request->input('booking-type', []) as $type) {
                TravelBookingType::create([
                    'booking_id' => $booking->id,
                    'type' => $type,
                ]);
            }


            foreach ($data['flight'] ?? [] as $flight) {
                // Check if all fields in $flight are empty
                if ($this->allFieldsEmpty($flight)) {
                    continue; // Skip this iteration if all fields are empty
                }

                $flight['booking_id'] = $booking->id;
                TravelFlightDetail::create($flight);
            }

            // Save flight details
            foreach ($request->input('flight', []) as $flightData) {
                $flightData['booking_id'] = $booking->id;
                TravelFlightDetail::create($flightData);
            }

            // Save car details
            foreach ($request->input('car', []) as $carData) {
                $carData['booking_id'] = $booking->id;
                TravelCarDetail::create($carData);
            }

            // Save cruise details
            foreach ($request->input('cruise', []) as $cruiseData) {
                $cruiseData['booking_id'] = $booking->id;
                TravelCruiseDetail::create($cruiseData);
            }

            // Save hotel details
            foreach ($request->input('hotel', []) as $hotelData) {
                $hotelData['booking_id'] = $booking->id;
                TravelHotelDetail::create($hotelData);
            }

            // Save billing details
            foreach ($request->input('billing', []) as $billingData) {
                $billingData['booking_id'] = $booking->id;
                TravelBillingDetail::create($billingData);
            }

            // Create Passengers
            foreach ($request->input('passenger', []) as $passengerData) {
                $passengerData['booking_id'] = $booking->id;
                TravelPassenger::create($passengerData);
            }

            // Create Billing Details
            foreach ($request->input('billing', []) as $billingData) {
                $billingData['booking_id'] = $booking->id;
                TravelBillingDetail::create($billingData);
            }

            // Create Pricing Detail
            $pricingData = $request->only([
                'hotel_cost',
                'cruise_cost',
                'total_amount',
                'advisor_mco',
                'conversion_charge',
                'airline_commission',
                'final_amount',
                'merchant',
                'net_mco',
            ]);
            $pricingData['booking_id'] = $booking->id;
            TravelPricingDetail::create($pricingData);

            // Create Booking Remark (if provided)
            if ($request->filled('particulars')) {
                TravelBookingRemark::create([
                    'booking_id' => $booking->id,
                    'agent' => 'Testagent', // Default or from request if provided
                    'date_time' => now(),
                    'particulars' => $request->input('particulars'),
                ]);
            }

            // Create Quality Feedback (if provided)
            if ($request->filled('feedback')) {
                TravelQualityFeedback::create([
                    'booking_id' => $booking->id,
                    'qa' => 'Test QA', // Default or from request if provided
                    'date_time' => now(),
                    'feedback' => $request->input('feedback'),
                ]);
            }

            // Create Screenshot (if provided)
            if ($request->filled('type')) {
                TravelScreenshot::create([
                    'booking_id' => $booking->id,
                    'type' => $request->input('type'),
                    'status' => $request->input('status'),
                    'notes' => $request->input('notes'),
                ]);
            }

            DB::commit();
            $hash = $this->hashids->encode($booking->id);
            $redirectTo = [
                'route' => 'booking.show',
                'id'=>$hash
            ];
            return JsonResponse::successWithData('Booking form submitted successfully.', 201,$redirectTo,'201');
        }
        catch(ValidationException $e){
            return JsonResponse::error($e->validator->errors()->first(),422,'422');
        }
        catch(QueryException $e){
            return JsonResponse::error('Failed to Query',500,'500');
        }
        catch(\Exception $e){
            return JsonResponse::error('Internal Server Error',500,'500');
        }

        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return redirect()->route('travel.bookings.form')->with('error', 'Failed to submit booking: ' . $e->getMessage())->withFragment('booking-failed-' . ($booking->id ?? 'no-id'));
        // }
    }


    public function update(Request $request, $id)
    {
        if (empty($id)) {
            return redirect()->route('travel.bookings.form')->with('error', 'Invalid booking ID.')->withFragment('booking-failed');
        }


        $booking = TravelBooking::findOrFail($id);

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'pnr' => 'required|string|max:255',
            'campaign' => 'nullable|string|max:255',
            // 'hotel_ref' => 'nullable|string|max:255',
            // 'cruise_ref' => 'nullable|string|max:255',
            // 'car_ref' => 'nullable|string|max:255',
            // 'train_ref' => 'nullable|string|max:255',
            // 'airlinepnr' => 'nullable|string|max:255',
            // 'amadeus_sabre_pnr' => 'nullable|string|max:255',
            // 'pnrtype' => 'nullable|in:HK,GK',
            // 'name' => 'required|string|max:255',
            // 'phone' => 'required|string|max:20',
            // 'email' => 'required|email|max:255',
            // 'query_type' => 'nullable|in:N,NC,M,UMNR,CC,CR,CH,U,NMC,S,B,CBP,AI,AE',
            // 'selected_company' => 'required|in:1,3,5,6',
            // 'booking_status' => 'required|string|max:255',
            // 'payment_status' => 'required|string|max:255',
            // 'reservation_source' => 'nullable|string|max:255',
            // 'descriptor' => 'nullable|string|max:255',
            // 'booking-type' => 'nullable|array',
            // 'booking-type.*' => 'in:Flight,Hotel,Cruise,Car,Train',
            // 'flight.*.direction' => 'nullable|string|max:255',
            // 'flight.*.date' => 'nullable|date',
            // 'flight.*.airlines_code' => 'nullable|string|max:255',
            // 'flight.*.flight_no' => 'nullable|string|max:255',
            // 'flight.*.cabin' => 'nullable|string|max:255',
            // 'flight.*.class_of_service' => 'nullable|string|max:255',
            // 'flight.*.departure_airport' => 'nullable|string|max:255',
            // 'flight.*.departure_hrs' => 'nullable|integer|min:0|max:23',
            // 'flight.*.departure_mm' => 'nullable|integer|min:0|max:59',
            // 'flight.*.arrival_airport' => 'nullable|string|max:255',
            // 'flight.*.arrival_hrs' => 'nullable|integer|min:0|max:23',
            // 'flight.*.arrival_mm' => 'nullable|integer|min:0|max:59',
            // 'flight.*.duration' => 'nullable|string|max:255',
            // 'flight.*.transit' => 'nullable|string|max:255',
            // 'flight.*.arrival_date' => 'nullable|date',
            // 'car.*.car_rental_provider' => 'nullable|string|max:255',
            // 'car.*.car_type' => 'nullable|string|max:255',
            // 'car.*.pickup_location' => 'nullable|string|max:255',
            // 'car.*.dropoff_location' => 'nullable|string|max:255',
            // 'car.*.pickup_date' => 'nullable|date',
            // 'car.*.pickup_time' => 'nullable|time',
            // 'car.*.dropoff_date' => 'nullable|date',
            // 'car.*.dropoff_time' => 'nullable|time',
            // 'car.*.confirmation_number' => 'nullable|string|max:255',
            // 'car.*.remarks' => 'nullable|string|max:255',
            // 'car.*.rental_provider_address' => 'nullable|string|max:255',
            // 'cruise.*.date' => 'nullable|date',
            // 'cruise.*.cruise_line' => 'nullable|string|max:255',
            // 'cruise.*.ship_name' => 'nullable|string|max:255',
            // 'cruise.*.category' => 'nullable|string|max:255',
            // 'cruise.*.stateroom' => 'nullable|string|max:255',
            // 'cruise.*.departure_port' => 'nullable|string|max:255',
            // 'cruise.*.departure_date' => 'nullable|date',
            // 'cruise.*.departure_hrs' => 'nullable|integer|min:0|max:23',
            // 'cruise.*.departure_mm' => 'nullable|integer|min:0|max:59',
            // 'cruise.*.arrival_port' => 'nullable|string|max:255',
            // 'cruise.*.arrival_date' => 'nullable|date',
            // 'cruise.*.arrival_hrs' => 'nullable|integer|min:0|max:23',
            // 'cruise.*.arrival_mm' => 'nullable|integer|min:0|max:59',
            // 'cruise.*.remarks' => 'nullable|string|max:255',
            // 'hotel.*.hotel_name' => 'nullable|string|max:255',
            // 'hotel.*.room_category' => 'nullable|string|max:255',
            // 'hotel.*.checkin_date' => 'nullable|date',
            // 'hotel.*.checkout_date' => 'nullable|date',
            // 'hotel.*.no_of_rooms' => 'nullable|integer|min:1',
            // 'hotel.*.confirmation_number' => 'nullable|string|max:255',
            // 'hotel.*.hotel_address' => 'nullable|string|max:255',
            // 'hotel.*.remarks' => 'nullable|string|max:255',
            // 'passenger.*.passenger_type' => 'nullable|in:Adult,Child,Infant,Seat Infant,Lap Infant',
            // 'passenger.*.gender' => 'nullable|in:Male,Female',
            // 'passenger.*.title' => 'nullable|in:Mr,Mrs,Ms,Master,Miss',
            // 'passenger.*.first_name' => 'nullable|string|max:255',
            // 'passenger.*.middle_name' => 'nullable|string|max:255',
            // 'passenger.*.last_name' => 'nullable|string|max:255',
            // 'passenger.*.dob' => 'nullable|date',
            // 'passenger.*.seat_number' => 'nullable|string|max:255',
            // 'passenger.*.credit_note' => 'nullable|numeric|min:0',
            // 'passenger.*.e_ticket_number' => 'nullable|string|max:255',
            // 'billing.*.card_type' => 'nullable|in:VISA,Mastercard,AMEX,DISCOVER',
            // 'billing.*.cc_number' => 'nullable|string|max:255',
            // 'billing.*.cc_holder_name' => 'nullable|string|max:255',
            // 'billing.*.exp_month' => 'nullable|in:01,02,03,04,05,06,07,08,09,10,11,12',
            // 'billing.*.exp_year' => 'nullable|integer|min:' . date('Y') . '|max:' . (date('Y') + 10),
            // 'billing.*.cvv' => 'nullable|string|max:4',
            // 'billing.*.address' => 'nullable|string|max:255',
            // 'billing.*.email' => 'nullable|email|max:255',
            // 'billing.*.contact_no' => 'nullable|string|max:20',
            // 'billing.*.city' => 'nullable|string|max:255',
            // 'billing.*.country' => 'nullable|string|max:255',
            // 'billing.*.state' => 'nullable|string|max:255',
            // 'billing.*.zip_code' => 'nullable|string|max:10',
            // 'billing.*.currency' => 'nullable|in:USD,CAD,EUR,GBP,AUD,INR,MXN',
            // 'billing.*.amount' => 'nullable|numeric|min:0',
            // 'activeCard' => 'nullable|integer',
            // 'flight_cost' => 'nullable|numeric|min:0',
            // 'hotel_cost' => 'nullable|numeric|min:0',
            // 'cruise_cost' => 'nullable|numeric|min:0',
            // 'car_cost' => 'nullable|numeric|min:0',
            // 'train_cost' => 'nullable|numeric|min:0',
            // 'total_amount' => 'nullable|numeric|min:0',
            // 'issuance_fee' => 'nullable|numeric|min:0',
            // 'advisor_mco' => 'nullable|numeric|min:0',
            // 'airline_commission' => 'nullable|numeric|min:0',
            // 'final_amount' => 'nullable|numeric|min:0',
            // 'merchant' => 'nullable|in:11,12,13',
            // 'net_mco' => 'nullable|numeric|min:0',
            // 'sector_details.*' => 'nullable|file|image|max:2048',
            // 'particulars' => 'nullable|string',
            // 'feedback' => 'nullable|string',
            // 'type' => 'nullable|string|max:255',
            // 'status' => 'nullable|string|max:255',
            // 'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->withFragment('booking-failed');
        }

        try {
           // DB::beginTransaction();

           // Update TravelBooking
            $bookingData = $request->only([
                'pnr', 'campaign', 'hotel_ref', 'cruise_ref', 'car_ref', 'train_ref', 'airlinepnr',
                'amadeus_sabre_pnr', 'pnrtype', 'name', 'phone', 'email', 'query_type',
                'selected_company', 'booking_status', 'payment_status', 'reservation_source',
                'descriptor',
            ]);



            foreach ($bookingData as $field => $newValue) {
                $oldValue = $booking->$field;
                if ($oldValue !== $newValue) {
                    $booking->logChange($booking->id, 'TravelBooking', Auth::user()->id, $field, $oldValue, $newValue);
                }
            }
            $booking->update($bookingData);

            // Update or Create Booking Types
            $existingBookingTypeIds = $booking->bookingTypes->pluck('id')->toArray();
            $newBookingTypes = $request->input('booking-type', []);
            $processedBookingTypeIds = [];

            foreach ($newBookingTypes as $type) {
                $bookingType = TravelBookingType::updateOrCreate(
                    ['booking_id' => $booking->id, 'type' => $type],
                    ['type' => $type]
                );
                $processedBookingTypeIds[] = $bookingType->id;
                if ($bookingType->wasRecentlyCreated) {
                    $booking->logChange($booking->id, 'TravelBookingType', $bookingType->id, 'type', null, $type);
                }
            }
            $deletedBookingTypes = array_diff($existingBookingTypeIds, $processedBookingTypeIds);
            foreach ($deletedBookingTypes as $deletedId) {
                $booking->logChange($booking->id, 'TravelBookingType', $deletedId, 'deleted', 'exists', null);
            }
            TravelBookingType::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedBookingTypeIds)
                ->delete();



           // Update or Create Flight Details
            $existingFlightIds = $booking->travelFlight ? $booking->travelFlight->pluck('id')->toArray() : [];
            $newFlights = $request->input('flight', []);
            $processedFlightIds = [];


            foreach ($newFlights as $flightData) {

                $fieldsToCheck = [
                    'direction',
                    'departure_date',
                    'airline_code',
                    'flight_number',
                    'cabin',
                    // 'class_of_service',
                    // 'departure_airport',
                    // 'departure_hours',
                    // 'departure_minutes',
                    // 'arrival_airport',
                    // 'arrival_hours',
                    // 'arrival_minutes',
                    // 'duration',
                    // 'transit',
                    // 'arrival_date'
                ];

                // Check if all relevant fields are empty
                if ($this->areSpecifiedFieldsEmpty($flightData, $fieldsToCheck)) {
                    continue;
                }

                $flightData['booking_id'] = $booking->id;
                $oldFlight = TravelFlightDetail::find($flightData['id'] ?? null);
                $flight = TravelFlightDetail::updateOrCreate(
                    ['id' => $flightData['id'] ?? null, 'booking_id' => $booking->id],
                    $flightData
                );
                if ($oldFlight) {
                    foreach ($flightData as $field => $newValue) {
                        if ($oldFlight->$field != $newValue) {
                            $booking->logChange($booking->id, 'TravelFlightDetail', $flight->id, $field, $oldFlight->$field, $newValue);
                        }
                    }
                } else {
                    $booking->logChange($booking->id, 'TravelFlightDetail', $flight->id, 'created', null, json_encode($flightData));
                }
                $processedFlightIds[] = $flight->id;
            }
         
            $deletedFlights = array_diff($existingFlightIds, $processedFlightIds);
            foreach ($deletedFlights as $deletedId) {
                $booking->logChange($booking->id, 'TravelFlightDetail', $deletedId, 'deleted', 'exists', null);
            }
            TravelFlightDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedFlightIds)
                ->delete();


                      dd('FLIGHTS');


            // Update or Create Car Details
            $existingCarIds = $booking->carDetails->pluck('id')->toArray();
            $newCars = $request->input('car', []);
            $processedCarIds = [];

            foreach ($newCars as $carData) {
                if ($this->allFieldsEmpty($carData)) {
                    continue;
                }
                $carData['booking_id'] = $booking->id;
                $oldCar = TravelCarDetail::find($carData['id'] ?? null);
                $car = TravelCarDetail::updateOrCreate(
                    ['id' => $carData['id'] ?? null, 'booking_id' => $booking->id],
                    $carData
                );
                if ($oldCar) {
                    foreach ($carData as $field => $newValue) {
                        if ($oldCar->$field != $newValue) {
                            $booking->logChange($booking->id, 'TravelCarDetail', $car->id, $field, $oldCar->$field, $newValue);
                        }
                    }
                } else {
                    $booking->logChange($booking->id, 'TravelCarDetail', $car->id, 'created', null, json_encode($carData));
                }
                $processedCarIds[] = $car->id;
            }
            $deletedCars = array_diff($existingCarIds, $processedCarIds);
            foreach ($deletedCars as $deletedId) {
                $booking->logChange($booking->id, 'TravelCarDetail', $deletedId, 'deleted', 'exists', null);
            }
            TravelCarDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedCarIds)
                ->delete();

            // Update or Create Cruise Details
            $existingCruiseIds = $booking->cruiseDetails->pluck('id')->toArray();
            $newCruises = $request->input('cruise', []);
            $processedCruiseIds = [];

            foreach ($newCruises as $cruiseData) {
                if ($this->allFieldsEmpty($cruiseData)) {
                    continue;
                }
                $cruiseData['booking_id'] = $booking->id;
                $oldCruise = TravelCruiseDetail::find($cruiseData['id'] ?? null);
                $cruise = TravelCruiseDetail::updateOrCreate(
                    ['id' => $cruiseData['id'] ?? null, 'booking_id' => $booking->id],
                    $cruiseData
                );
                if ($oldCruise) {
                    foreach ($cruiseData as $field => $newValue) {
                        if ($oldCruise->$field != $newValue) {
                            $booking->logChange($booking->id, 'TravelCruiseDetail', $cruise->id, $field, $oldCruise->$field, $newValue);
                        }
                    }
                } else {
                    $booking->logChange($booking->id, 'TravelCruiseDetail', $cruise->id, 'created', null, json_encode($cruiseData));
                }
                $processedCruiseIds[] = $cruise->id;
            }
            $deletedCruises = array_diff($existingCruiseIds, $processedCruiseIds);
            foreach ($deletedCruises as $deletedId) {
                $booking->logChange($booking->id, 'TravelCruiseDetail', $deletedId, 'deleted', 'exists', null);
            }
            TravelCruiseDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedCruiseIds)
                ->delete();

            // Update or Create Hotel Details
            $existingHotelIds = $booking->travelHotel->pluck('id')->toArray();
            $newHotels = $request->input('hotel', []);
            $processedHotelIds = [];

            foreach ($newHotels as $hotelData) {
                if ($this->allFieldsEmpty($hotelData)) {
                    continue;
                }
                $hotelData['booking_id'] = $booking->id;
                $oldHotel = TravelHotelDetail::find($hotelData['id'] ?? null);
                $hotel = TravelHotelDetail::updateOrCreate(
                    ['id' => $hotelData['id'] ?? null, 'booking_id' => $booking->id],
                    $hotelData
                );
                if ($oldHotel) {
                    foreach ($hotelData as $field => $newValue) {
                        if ($oldHotel->$field != $newValue) {
                            $booking->logChange($booking->id, 'TravelHotelDetail', $hotel->id, $field, $oldHotel->$field, $newValue);
                        }
                    }
                } else {
                    $booking->logChange($booking->id, 'TravelHotelDetail', $hotel->id, 'created', null, json_encode($hotelData));
                }
                $processedHotelIds[] = $hotel->id;
            }
            $deletedHotels = array_diff($existingHotelIds, $processedHotelIds);
            foreach ($deletedHotels as $deletedId) {
                $booking->logChange($booking->id, 'TravelHotelDetail', $deletedId, 'deleted', 'exists', null);
            }
            TravelHotelDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedHotelIds)
                ->delete();

            // Update or Create Passengers
            $existingPassengerIds = $booking->passengers->pluck('id')->toArray();
            $newPassengers = $request->input('passenger', []);
            $processedPassengerIds = [];

            foreach ($newPassengers as $passengerData) {
                if ($this->allFieldsEmpty($passengerData)) {
                    continue;
                }
                $passengerData['booking_id'] = $booking->id;
                $oldPassenger = TravelPassenger::find($passengerData['id'] ?? null);
                $passenger = TravelPassenger::updateOrCreate(
                    ['id' => $passengerData['id'] ?? null, 'booking_id' => $booking->id],
                    $passengerData
                );
                if ($oldPassenger) {
                    foreach ($passengerData as $field => $newValue) {
                        if ($oldPassenger->$field != $newValue) {
                            $booking->logChange($booking->id, 'TravelPassenger', $passenger->id, $field, $oldPassenger->$field, $newValue);
                        }
                    }
                } else {
                    $booking->logChange($booking->id, 'TravelPassenger', $passenger->id, 'created', null, json_encode($passengerData));
                }
                $processedPassengerIds[] = $passenger->id;
            }
            $deletedPassengers = array_diff($existingPassengerIds, $processedPassengerIds);
            foreach ($deletedPassengers as $deletedId) {
                $booking->logChange($booking->id, 'TravelPassenger', $deletedId, 'deleted', 'exists', null);
            }
            TravelPassenger::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedPassengerIds)
                ->delete();

            // Update or Create Billing Details
            $existingBillingIds = $booking->billingDetails->pluck('id')->toArray();
            $newBillings = $request->input('billing', []);
            $processedBillingIds = [];

            foreach ($newBillings as $billingData) {
                if ($this->allFieldsEmpty($billingData)) {
                    continue;
                }
                $billingData['booking_id'] = $booking->id;
                $billingData['is_active'] = ($request->input('activeCard') == array_key_last($newBillings)) ? 1 : 0;
                $oldBilling = TravelBillingDetail::find($billingData['id'] ?? null);
                $billing = TravelBillingDetail::updateOrCreate(
                    ['id' => $billingData['id'] ?? null, 'booking_id' => $booking->id],
                    $billingData
                );
                if ($oldBilling) {
                    foreach ($billingData as $field => $newValue) {
                        if ($oldBilling->$field != $newValue) {
                            $booking->logChange($booking->id, 'TravelBillingDetail', $billing->id, $field, $oldBilling->$field, $newValue);
                        }
                    }
                } else {
                    $booking->logChange($booking->id, 'TravelBillingDetail', $billing->id, 'created', null, json_encode($billingData));
                }
                $processedBillingIds[] = $billing->id;
            }
            $deletedBillings = array_diff($existingBillingIds, $processedBillingIds);
            foreach ($deletedBillings as $deletedId) {
                $booking->logChange($booking->id, 'TravelBillingDetail', $deletedId, 'deleted', 'exists', null);
            }
            TravelBillingDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedBillingIds)
                ->delete();

            // Update or Create Pricing Detail (hasOne relationship)
            $pricingData = [
                'flight_cost' => $request->input('flight_cost', 0),
                'hotel_cost' => $request->input('hotel_cost', 0),
                'cruise_cost' => $request->input('cruise_cost', 0),
                'car_cost' => $request->input('car_cost', 0),
                'train_cost' => $request->input('train_cost', 0),
                'total_amount' => $request->input('total_amount', 0),
                'issuance_fee' => $request->input('issuance_fee', 0),
                'advisor_mco' => $request->input('advisor_mco', 0),
                'airline_commission' => $request->input('airline_commission', 0),
                'final_amount' => $request->input('final_amount', 0),
                'merchant' => $request->input('merchant'),
                'net_mco' => $request->input('net_mco', 0),
                'booking_id' => $booking->id,
            ];
            $oldPricing = $booking->pricingDetails;
            $pricing = TravelPricingDetail::updateOrCreate(
                ['booking_id' => $booking->id],
                $pricingData
            );
            if ($oldPricing) {
                foreach ($pricingData as $field => $newValue) {
                    if ($oldPricing->$field != $newValue) {
                        $pricing->logChange($booking->id, 'TravelPricingDetail', $pricing->id, $field, $oldPricing->$field, $newValue);
                    }
                }
            } else {
                $pricing->logChange($booking->id, 'TravelPricingDetail', $pricing->id, 'created', null, json_encode($pricingData));
                // Send OneSignal notification for new pricing
                $user = $booking->user; // Adjust based on your relationship
                if ($user) {
                    $user->notify(new PricingAdded($pricingData));
                }
            }

            // Update or Create Sector Details (file uploads)
            if ($request->hasFile('sector_details')) {
                foreach ($request->file('sector_details') as $file) {
                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/sector_details'), $fileName);
                    $sector = TravelSectorDetail::create([
                        'booking_id' => $booking->id,
                        'sector_type' => $fileName,
                    ]);
                    $booking->logChange($booking->id, 'TravelSectorDetail', $sector->id, 'created', null, $fileName);
                }
            }

            // Update or Create Booking Remark
            if ($request->filled('particulars')) {
                $oldRemark = TravelBookingRemark::where('booking_id', $booking->id)->first();
                $remarkData = [
                    'agent' => 'Testagent',
                    'date_time' => now(),
                    'particulars' => $request->input('particulars'),
                ];
                $remark = TravelBookingRemark::updateOrCreate(
                    ['booking_id' => $booking->id],
                    $remarkData
                );
                if ($oldRemark && $oldRemark->particulars != $remarkData['particulars']) {
                    $booking->logChange($booking->id, 'TravelBookingRemark', $remark->id, 'particulars', $oldRemark->particulars, $remarkData['particulars']);
                } elseif (!$oldRemark) {
                    $booking->logChange($booking->id, 'TravelBookingRemark', $remark->id, 'created', null, json_encode($remarkData));
                }
            }

            // Update or Create Quality Feedback
            if ($request->filled('feedback')) {
                $oldFeedback = TravelQualityFeedback::where('booking_id', $booking->id)->first();
                $feedbackData = [
                    'qa' => 'Test QA',
                    'date_time' => now(),
                    'feedback' => $request->input('feedback'),
                ];
                $feedback = TravelQualityFeedback::updateOrCreate(
                    ['booking_id' => $booking->id],
                    $feedbackData
                );
                if ($oldFeedback && $oldFeedback->feedback != $feedbackData['feedback']) {
                    $booking->logChange($booking->id, 'TravelQualityFeedback', $feedback->id, 'feedback', $oldFeedback->feedback, $feedbackData['feedback']);
                } elseif (!$oldFeedback) {
                    $booking->logChange($booking->id, 'TravelQualityFeedback', $feedback->id, 'created', null, json_encode($feedbackData));
                }
            }

            // Update or Create Screenshot
            if ($request->filled('type')) {
                $oldScreenshot = TravelScreenshot::where('booking_id', $booking->id)->first();
                $screenshotData = [
                    'type' => $request->input('type'),
                    'status' => $request->input('status'),
                    'notes' => $request->input('notes'),
                ];
                $screenshot = TravelScreenshot::updateOrCreate(
                    ['booking_id' => $booking->id],
                    $screenshotData
                );
                if ($oldScreenshot) {
                    foreach ($screenshotData as $field => $newValue) {
                        if ($oldScreenshot->$field != $newValue) {
                            $booking->logChange($booking->id, 'TravelScreenshot', $screenshot->id, $field, $oldScreenshot->$field, $newValue);
                        }
                    }
                } else {
                    $booking->logChange($booking->id, 'TravelScreenshot', $screenshot->id, 'created', null, json_encode($screenshotData));
                }
            }

           // DB::commit();
            return redirect()->route('booking.show', ['id' => $id])->with('success', 'Booking updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Failed to update booking: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update booking: ' . $e->getMessage())->withInput()->withFragment('booking-failed');
        }
    }

    public function show($hash)
    {
        // Decrypt the hash to get the original ID
        $id = $this->hashids->decode($hash);
        $id = $id[0] ?? null;

        if (!$id) {
            abort(404); // Handle invalid or missing hash
        }

        $hashids = new Hashids(config('hashids.salt'), config('hashids.length', 8));
        $booking = TravelBooking::with([
            'bookingTypes',
            'sectorDetails',
            'passengers',
            'billingDetails',
            'pricingDetails',
            'remarks',
            'qualityFeedback',
            'screenshots',
            'travelFlight' => fn($query) => $query->withTrashed(), // Include soft-deleted flights
            'travelCar',
            'travelCruise',
            'travelHotel',
        ])->findOrFail($id);

        return view('web.booking.show', compact('booking', 'hashids'));
    }


    public function add(){
       $pnr = date('dm') . str_pad(time() % 86400 % 10000, 4, '0', STR_PAD_LEFT) . str_pad(
                DB::table('travel_bookings')->whereDate('created_at', now()->toDateString())->count() + 1,
                4,
                '0',
                STR_PAD_LEFT);
        return view('web.booking.add', compact('pnr'));
    }

    protected function allFieldsEmpty($data)
    {
        foreach ($data as $value) {
            if (!empty($value) || $value === null) {
                return false;
            }
        }
        return true;
    }

    private function areSpecifiedFieldsEmpty(array $data, array $fields): bool
    {
        foreach ($fields as $field) {
            if (!empty($data[$field])) {
                return false; // Return false as soon as one field is not empty
            }
        }
        return true; // All specified fields are empty
    }



}
