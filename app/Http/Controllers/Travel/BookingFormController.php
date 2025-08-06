<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Models\BillingDetail;
use App\Models\CarImages;
use App\Models\CruiseImages;
use App\Models\flightImages;
use App\Models\HotelImages;
use App\Models\ScreenshotImages;
use App\Models\TrainImages;
use App\Models\TravelTrainDetail;
use App\Utils\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
use App\Models\BookingStatus;
use App\Models\PaymentStatus;
use App\Models\TravelCruiseDetail;
use App\Models\TravelHotelDetail;
use App\Models\UserShiftAssignment;
use App\Models\ChangeLog;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Hashids\Hashids;
use Carbon\Carbon;
use App\Traits\Loggable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Exports\BookingsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;

class BookingFormController extends Controller
{
    protected $hashids;
    protected $logController;

    public function __construct()
    {
        $this->hashids = new Hashids(config('hashids.salt'), config('hashids.length', 8));
    }

    public function index(Request $request)
    {
        $query = TravelBooking::with(['user', 'pricingDetails', 'bookingStatus', 'paymentStatus']);
        $userId = Auth::id();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('pnr', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhereDate('created_at', $search) // for Booking Date (exact)
                ->orWhereHas('user', function ($uq) use ($search) {
                    $uq->where('name', 'like', "%{$search}%"); // Agent name
                })
                ->orWhereHas('pricingDetails', function ($pq) use ($search) {
                    $pq->where('total_amount', 'like', "%{$search}%")
                        ->orWhere('advisor_mco', 'like', "%{$search}%");
                });
            });
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(10);
        $bookings->appends($request->only('search'));
        $hashids = new \Hashids\Hashids(config('hashids.salt'), config('hashids.length', 8));
        $flight_booking = TravelBooking::where('user_id', $userId)->where('airlinepnr','!=', NULL)->count();
        $hotel_booking = TravelBooking::where('user_id', $userId)->where('hotel_ref','!=', NULL)->count();
        $cruise_booking = TravelBooking::where('user_id', $userId)->where('cruise_ref','!=', NULL)->count();
        $car_booking = TravelBooking::where('user_id', $userId)->where('car_ref','!=', NULL)->count();
        $train_booking = 0;
        $pending_booking = TravelBooking::where('user_id', $userId)->where('booking_status_id',1)->count();
        return view('web.booking.index', compact('bookings', 'hashids','flight_booking','hotel_booking','cruise_booking','car_booking','train_booking','pending_booking'));
    }

    public function update(Request $request, $id)
    {
        if (empty($id)) {
            return redirect()->route('travel.bookings.form')->with('error', 'Invalid booking ID.')->withFragment('booking-failed');
        }

        try {
            $bookingTypes = $request->input('booking-type', []);
            $rules = [
                'booking-type'        => 'required|array|min:1',
                'booking-type.*'      => 'in:Flight,Hotel,Cruise,Car,Train',
                'pnr'                 => 'required|string|max:255',
                'hotel_ref'           => 'nullable|string|max:255',
                'cruise_ref'          => 'nullable|string|max:255',
                'name'                => 'required|string|max:255',
                'phone'               => 'required|string|max:20',
                'query_type'          => 'nullable|string|max:255',
                'selected_company'    => 'required|string|max:255',
                'booking_status_id'   => 'nullable',
                'payment_status_id'   => 'nullable',
                'reservation_source'  => 'nullable|string|max:255',
                'descriptor'          => 'nullable|string|max:255',
                'amadeus_sabre_pnr'   => 'nullable|string|max:255',
                'sector_details.*'    => 'required|file|image|max:2048',

                // Passenger
                'passenger'                          => 'required|array|min:1',
                'passenger.*.passenger_type'         => 'required|string|in:Adult,Child,Infant,Seat Infant,Lap Infant',
                'passenger.*.gender'                 => 'required|string|in:Male,Female,Other',
                'passenger.*.title'                  => 'nullable|string|in:Mr,Ms,Mrs,Dr,Master,Miss',
                'passenger.*.first_name'             => 'required|string',
                'passenger.*.middle_name'            => 'nullable|string',
                'passenger.*.last_name'              => 'required|string',
                'passenger.*.dob'                    => 'required|date|before:today',
                'passenger.*.seat_number'            => 'nullable|string',
                'passenger.*.credit_note'            => 'nullable|numeric',
                'passenger.*.e_ticket_number'        => 'nullable|string',

                // Billing
                'billing'                => 'required|array|min:1',
                'billing.*.card_type'    => 'required|string|in:VISA,MasterCard,AMEX,Discover',
                'billing.*.cc_number'    => 'required|string|max:255',
                'billing.*.cc_holder_name' => ['required','string','max:255','regex:/^[A-Za-z\s]+$/'],
                'billing.*.exp_month'    => 'required|in:01,02,03,04,05,06,07,08,09,10,11,12',
                'billing.*.exp_year'     => 'required|integer|min:' . date('Y') . '|max:' . (date('Y') + 10),
                'billing.*.cvv'          => 'required|string|max:4',
                'billing.*.currency'     => 'required|in:USD,CAD,EUR,GBP,AUD,INR,MXN',
                'billing.*.amount'       => 'required|numeric|min:1',

                // Pricing
                'pricing'                    => 'required|array|min:1',
                'pricing.*.passenger_type'   => 'required|string|in:adult,child,infant_on_lap,infant_on_seat',
                'pricing.*.num_passengers'   => 'required|integer|min:1',
                'pricing.*.gross_price'      => 'required|numeric|min:0',
                'pricing.*.net_price'        => 'required|numeric|min:0',
                'pricing.*.details'          => 'required|string',
            ];

            // == CONDITIONAL RULES based on booking-type ==
            // ---- FLIGHT ----
            if (in_array('Flight', $bookingTypes)) {
                $rules['flight']                        = 'required|array|min:1';
                $rules['flight.*.direction']            = 'required|string|in:Inbound,Outbound';
                $rules['flight.*.departure_date']       = 'required|date|after_or_equal:today';
                $rules['flight.*.departure_airport']    = 'required|string|max:255';
                $rules['flight.*.departure_hours']      = 'required|date_format:H:i';
                $rules['flight.*.arrival_airport']      = 'required|string|max:255';
                $rules['flight.*.arrival_hours']        = 'required|date_format:H:i';
                $rules['flight.*.duration']             = 'required';
                $rules['flight.*.transit']              = 'required';
                $rules['flight.*.arrival_date']         = 'required';
                $rules['flight.*.airline_code']         = 'required|string|size:2';
                $rules['flight.*.flight_number']        = 'required|string|max:10';
                $rules['flight.*.cabin']                = 'required|string|in:B.Eco,Eco,Pre.Eco,Buss.';
                $rules['flight.*.class_of_service']     = 'required|string|max:3';
            }
            // ---- HOTEL ----
            if (in_array('Hotel', $bookingTypes)) {
                $rules['hotel']                         = 'required|array|min:1';
                $rules['hotel.*.hotel_name']            = 'required|string|max:255';
                $rules['hotel.*.room_category']         = 'required|string|max:255';
                $rules['hotel.*.checkin_date']          = 'required|date|after_or_equal:today';
                $rules['hotel.*.checkout_date']         = 'required|date|after:hotel.*.checkin_date';
                $rules['hotel.*.no_of_rooms']           = 'required|integer|min:1';
                $rules['hotel.*.confirmation_number']   = 'required|string|max:100';
                $rules['hotel.*.hotel_address']         = 'required|string|max:500';
                $rules['hotel.*.remarks']               = 'required|string|max:1000';
            }
            // ---- CRUISE ----
            if (in_array('Cruise', $bookingTypes)) {
                $rules['cruise']                        = 'required|array|min:1';
                $rules['cruise.*.cruise_line']          = 'required|string|max:255';
                $rules['cruise.*.ship_name']            = 'required|string|max:255';
                $rules['cruise.*.category']             = 'required|string|max:255';
                $rules['cruise.*.stateroom']            = 'required|string|max:255';
                $rules['cruise.*.departure_port']       = 'required|string|max:255';
                $rules['cruise.*.departure_date']       = 'required|date';
                $rules['cruise.*.departure_hrs']        = 'required|date_format:H:i';
                $rules['cruise.*.arrival_port']         = 'required|string|max:255';
                $rules['cruise.*.arrival_hrs']          = 'required|date_format:H:i';
            }
            // ---- CAR ----
            if (in_array('Car', $bookingTypes)) {
                $rules['car']                              = 'required|array|min:1';
                $rules['car.*.car_rental_provider']        = 'required|string|max:255';
                $rules['car.*.car_type']                   = 'required|string|max:255';
                $rules['car.*.pickup_location']            = 'required|string|max:255';
                $rules['car.*.dropoff_location']           = 'required|string|max:255';
                $rules['car.*.pickup_date']                = 'required|date|after_or_equal:today';
                $rules['car.*.pickup_time']                = 'required|date_format:H:i';
                $rules['car.*.dropoff_date']               = 'required|date|after_or_equal:today';
                $rules['car.*.dropoff_time']               = 'required|date_format:H:i';
                $rules['car.*.confirmation_number']        = 'nullable|string|max:255';
                $rules['car.*.remarks']                    = 'nullable|string|max:255';
                $rules['car.*.rental_provider_address']    = 'required|string|max:255';
            }
            // ---- TRAIN ----
            if (in_array('Train', $bookingTypes)) {
                $rules['train']                        = 'required|array|min:1';
                $rules['train.*.direction']            = 'required|string';
                $rules['train.*.departure_date']       = 'required|date|after_or_equal:today';
                $rules['train.*.train_number']         = 'required|string|max:255';
                $rules['train.*.cabin']                = 'required|string';
                $rules['train.*.departure_station']    = 'required|string|max:255';
                $rules['train.*.departure_hours']      = 'required|integer|between:0,23';
                $rules['train.*.departure_minutes']    = 'required|integer|between:0,59';
                $rules['train.*.arrival_station']      = 'required|string|max:255';
                $rules['train.*.arrival_hours']        = 'required|integer|between:0,23';
                $rules['train.*.arrival_minutes']      = 'required|integer|between:0,59';
                $rules['train.*.duration']             = 'required|string';
                $rules['train.*.transit']              = 'required|string';
                $rules['train.*.arrival_date']         = 'required|date';
            }


            // Optional: Put your custom messages array here (same as you posted)
            $messages = [/* ... paste your $messages array ... */];
          
            // $validator = Validator::make($request->all(), $rules, $messages);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'status' => 'error',
            //         'errors' => $validator->errors(),
            //     ], 422);
            // }

            $validator = Validator::make($request->all(), $rules, $messages);

            $validator->after(function ($validator) use ($request, $bookingTypes) {
                // Billing card number and CVV validation
                $billings = $request->input('billing', []);
                foreach ($billings as $index => $billing) {
                    $cardType = strtoupper($billing['card_type'] ?? '');
                    $ccNumber = preg_replace('/\D/', '', $billing['cc_number'] ?? '');
                    $cvv = preg_replace('/\D/', '', $billing['cvv'] ?? '');

                    if ($cardType === 'AMEX') {
                        if (strlen($ccNumber) !== 15) {
                            $validator->errors()->add("billing.$index.cc_number", 'AMEX card number must be exactly 15 digits.');
                        }
                        if (strlen($cvv) !== 4) {
                            $validator->errors()->add("billing.$index.cvv", 'AMEX CVV must be exactly 4 digits.');
                        }
                    } else {
                        if (strlen($ccNumber) !== 16) {
                            $validator->errors()->add("billing.$index.cc_number", 'Card number must be exactly 16 digits for non-AMEX.');
                        }
                        if (strlen($cvv) !== 3) {
                            $validator->errors()->add("billing.$index.cvv", 'CVV must be exactly 3 digits for non-AMEX.');
                        }
                    }
                }
            });
            $validator->validate();

            $user_id =Auth::id();

            #DB::beginTransaction();

            $booking = TravelBooking::findOrFail($id);
            $bookingData = $request->only([
                'payment_status_id', 'booking_status_id', 'pnr', 'campaign', 'hotel_ref', 'cruise_ref', 'car_ref', 'train_ref', 'airlinepnr',
                'amadeus_sabre_pnr', 'pnrtype', 'name', 'phone', 'email', 'query_type',
                'selected_company', 'reservation_source', 'descriptor','shared_booking','call_queue'
            ]);
            $bookingData['shift_id'] = 2;
            $bookingData['team_id'] = 2;
            $bookingData['user_id'] = $user_id;
            $booking->update($bookingData);


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


            $passengers = collect($request->input('passenger', []))
                ->filter(function ($data) {
                return collect($data)->filter()->isNotEmpty();
            });

            $processedPassengerIds = [];
            TravelPassenger::where('booking_id', $booking->id)->delete();
            foreach ($passengers as $data) {

                $data['booking_id'] = $booking->id;

                $passenger = TravelPassenger::create(
                    $data
                );
                $processedPassengerIds[] = $passenger->id;
            }
            TravelPassenger::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedPassengerIds)
                ->delete();

            $existingFlightIds = $booking->travelFlight ? $booking->travelFlight->pluck('id')->toArray() : [];
            $newFlights = $request->input('flight', []);
            $processedFlightIds = [];
            $check = TravelFlightDetail::where('booking_id', $booking->id)->forceDelete();
            if(in_array('Flight',$newBookingTypes)){
                foreach ($newFlights as $flightData) {

                    $flightData['booking_id'] = $booking->id;

                    // Handle flight booking image uploads
                    if (isset($request->flightbookingimage) && !empty($request->flightbookingimage)) {
                        $flightbookingimage = [];

                        foreach ($request->flightbookingimage as $key => $image) {
                            $file =  'storage/' . $image->store('flight_booking_image', 'public');
                            FlightImages::create([
                                'booking_id' => $booking->id,
                                'agent_id' => auth()->user()->id,
                                'file_path'=>$file
                            ]);
                        }

                    }

                    $flight = TravelFlightDetail::create(
                        $flightData
                    );

                    $processedFlightIds[] = $flight->id;
                }
            }

            TravelFlightDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedFlightIds)
                ->delete();

            $existingHotelIds = $booking->travelHotel->pluck('id')->toArray();
            $newHotels = $request->input('hotel', []);
            $processedHotelIds = [];

            $delete = TravelHotelDetail::where('booking_id', $booking->id)->delete();
            if(in_array('Hotel',$newBookingTypes)){
                foreach ($newHotels as $hotelData) {
                    if ($this->allFieldsEmpty($hotelData)) {
                        continue;
                    }
                    $hotelData['booking_id'] = $booking->id;
                    if(!empty($request->hotelbookingimage)){
                        $hotelbookingimage = [];
                        foreach($request->hotelbookingimage as $key => $image){
                            $fileHotel = 'storage/'.$image->store('hotel_booking_image','public');
                            HotelImages::create([
                                'file_path'=>$fileHotel,
                                'agent_id'=>auth()->user()->id,
                                'booking_id'=>$booking->id
                            ]);
                        }

                    }

                    $oldHotel = TravelHotelDetail::find($hotelData['id'] ?? null);
                    $hotel = TravelHotelDetail::create(
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
            }
            $deletedHotels = array_diff($existingHotelIds, $processedHotelIds);
            foreach ($deletedHotels as $deletedId) {
                $booking->logChange($booking->id, 'TravelHotelDetail', $deletedId, 'deleted', 'exists', null);
            }
            TravelHotelDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedHotelIds)
                ->delete();

            $existingCruiseIds = $booking->cruiseDetails?$booking->cruiseDetails->pluck('id')->toArray():[];
            $newCruises = $request->input('cruise', []);
            $processedCruiseIds = [];
            TravelCruiseDetail::where('booking_id', $booking->id)->delete();
            if(in_array('Cruise',$newBookingTypes)){
                foreach ($newCruises as $cruiseData) {
                    if ($this->allFieldsEmpty($cruiseData)) {
                        continue;
                    }
                    $cruiseData['booking_id'] = $booking->id;
                    if(isset($request->cruisebookingimage) && !empty($request->cruisebookingimage)){
                        foreach($request->cruisebookingimage as $key => $image){
                            $cruisebookingimage = 'storage/'.$image->store('cruise_booking_image','public');
                            CruiseImages::create([
                                'booking_id' => $booking->id,
                                'agent_id'=>auth()->user()->id,
                                'file_path'=>$cruisebookingimage,
                            ]);
                        }

                    }
                    $oldCruise = TravelCruiseDetail::find($cruiseData['id'] ?? null);
                    $cruise = TravelCruiseDetail::create(
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
            }
            $deletedCruises = array_diff($existingCruiseIds, $processedCruiseIds);
            foreach ($deletedCruises as $deletedId) {
                $booking->logChange($booking->id, 'TravelCruiseDetail', $deletedId, 'deleted', 'exists', null);
            }
            TravelCruiseDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedCruiseIds)
                ->delete();
            $existingCarIds = $booking->carDetails ? $booking->carDetails->pluck('id')->toArray() : [];
            $newCars = $request->input('car', []);
            $processedCarIds = [];
            TravelCarDetail::where('booking_id', $booking->id)->delete();
            if(in_array('Car',$newBookingTypes)){
                foreach ($newCars as $carData) {
                    $carData['booking_id'] = $booking->id;
                    // Handle file upload
                    if (isset($request->carbookingimage) && !empty($request->carbookingimage)) {
                        $carbookingimage = [];
                        foreach ($request->carbookingimage as $key => $image) {
                            $carbookingimage = 'storage/' . $image->store('car_booking_image', 'public');
                            CarImages::create([
                                'booking_id' => $booking->id,
                                'agent_id'=>auth()->user()->id,
                                'file_path'=>$carbookingimage
                            ]);
                        }
                    }

                    $car = TravelCarDetail::create(
                        $carData
                    );

                    $processedCarIds[] = $car->id;
                }
            }

            TravelCarDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedCarIds)
                ->delete();


            $newTrains = !empty($request->train)?$request->train:[];
            TravelTrainDetail::where('booking_id', $booking->id)->delete();
            if(in_array('Train',$newBookingTypes)){
                foreach ($newTrains as $train) {
                    $trainData = $train;
                    $trainData['booking_id'] = $booking->id;
                    if(isset($request->trainbookingimage) && !empty($request->trainbookingimage)){
                        foreach($request->trainbookingimage as $key => $image){
                            $trainbookingimage = 'storage/'.$image->store('train_booking_image','public');
                            TrainImages::create([
                                'booking_id' => $booking->id,
                                'agent_id'=>auth()->user()->id,
                                'file_path'=>$trainbookingimage,
                            ]);
                        }

                    }
                    $trainDataD = TravelTrainDetail::where('booking_id',$booking->id ?? null)->first();
                    $car = TravelTrainDetail::create(
                        $trainData
                    );
                }
            }
            $existingBillingIds = $booking->billingDetails->pluck('id')->toArray();
            $newBillings = $request->input('billing', []);
            $processedBillingIds = [];
            TravelBillingDetail::where('booking_id',$booking->id)->forceDelete();
            foreach ($newBillings as $index => $billingData) {
                    $billingData['booking_id'] = $booking->id;
                    // Set active only if this is the last card
                    $billingData['is_active'] = ($request->input('activeCard') == $index) ? 1 : 0;
                    $billing = TravelBillingDetail::create(
                        $billingData
                    );
                    $processedBillingIds[] = $billing->id;
                }

            TravelBillingDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedBillingIds)
                ->delete();


            $existingPricingIds = $booking->pricingDetails->pluck('id')->toArray();
            $newPricings = $request->input('pricing', []);


          #  dd($newPricings);

            $processedPricingIds = [];
            TravelPricingDetail::where('booking_id',$booking->id)->delete();
            foreach ($newPricings as $index => $pricingData) {
                $pricingData['booking_id'] = $booking->id;
                $pricing = TravelPricingDetail::create(
                    $pricingData
                );
                $processedPricingIds[] = $pricing->id;
            }


            TravelPricingDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedPricingIds)
                ->delete();



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
            if (isset($request->screenshots) && !empty($request->screenshots)) {
                foreach ($request->screenshots as $key => $image) {
                    $screenshots = 'storage/' . $image->store('screenshots', 'public');
                    ScreenshotImages::create([
                       'booking_id' => $booking->id,
                       'agent_id'=>auth()->user()->id,
                       'file_path'=>$screenshots,
                    ]);
                }
            }
           # DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Booking updated successfully',
                'code'=>201
            ],201);
        }
        catch(ValidationException $e){
            return JsonResponse::error($e->validator->errors()->first(),422,'422');
        }
        catch(QueryException $e){
            return JsonResponse::error('Failed to Query'.$e,500,'500');
        }
        catch(\Exception $e){
            \Log::error('Update Booking Error', [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            return JsonResponse::error('Internal Server Error'.$e, 500, '500');
        }
    }


    public function show($hash)
    {
        $id = $this->hashids->decode($hash);
        $id = $id[0] ?? null;

        if (!$id) {
            abort(404);
        }
        $hashids = $hash;
        $booking = TravelBooking::with([
            'bookingTypes',
            'sectorDetails',
            'passengers',
            'billingDetails',
            'pricingDetails',
            'remarks',
            'qualityFeedback',
            'trainBookingDetails',
            'screenshots',
            'travelFlight' => fn($query) => $query->withTrashed(), // Include soft-deleted flights
            'travelCar',
            'travelCruise',
            'travelHotel',
        ])->findOrFail($id);
        $booking_status = BookingStatus::where('status',1)->get();
        $payment_status = PaymentStatus::where('status',1)->get();
        $campaigns = Campaign::where('status',1)->get();
        $billingData = BillingDetail::where('booking_id',$booking->id)->get();
        $feed_backs = TravelQualityFeedback::where('booking_id', $booking->id)->get();
        $car_images = CarImages::where('booking_id', $booking->id)->get();
        $cruise_images = CruiseImages::where('booking_id', $booking->id)->get();
        $flight_images = flightImages::where('booking_id', $booking->id)->get();
        $hotel_images = HotelImages::where('booking_id', $booking->id)->get();
        $screenshot_images = ScreenshotImages::where('booking_id', $booking->id)->get();
        $train_images = TrainImages::where('booking_id', $booking->id)->get();
        $users = User::get();
        $countries = \DB::table('countries')->get();
        return view('web.booking.show', compact('car_images','cruise_images','flight_images','hotel_images','train_images','screenshot_images','countries','booking','users', 'hashids','feed_backs','booking_status','payment_status','campaigns','billingData'));
    }

    public function add(){
       $pnr = date('dm') . str_pad(time() % 86400 % 10000, 4, '0', STR_PAD_LEFT) . str_pad(
                DB::table('travel_bookings')->whereDate('created_at', now()->toDateString())->count() + 1,
                4,
                '0',
                STR_PAD_LEFT);
        return view('web.booking.add', compact('pnr'));
    }

    private function allFieldsEmpty($data)
    {
        foreach ($data as $value) {
            if (!is_null($value) && $value !== '') {
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

    public function export(Request $request)
    {
        return Excel::download(new BookingsExport($request), 'bookings.xlsx');
    }

    public function toggleRemarkStatus($id)
    {
        $remark = TravelBookingRemark::findOrFail($id);
        // Toggle status
        $remark->status = !$remark->status;
        $remark->save();

        return response()->json([
            'success' => true,
            'new_status' => $remark->status,
            'message' => $remark->status ? 'Remark is now visible.' : 'Remark is now hidden.',
        ]);
    }

    public function billingDetails(Request $request,$id){
        try{
            $data = $request->validate([
                'email'=>'required|email',
                'contact_number'=>'required|regex:/^\d{10}$/',
                'street_address'=>'required',
                'city'=>'required',
                'state'=>'required',
                'zip_code'=>'required',
                'country'=>'required',
            ],[
                'email.required' => 'The email field is required.',
                'email.email' => 'Please enter a valid email address.',
                'contact_number.required' => 'The contact number is required.',
                'contact_number.regex' => 'Please enter a valid 10-digit contact number.',
                'street_address.required' => 'The street address is required.',
                'city.required' => 'The city is required.',
                'state.required' => 'The state is required.',
                'zip_code.required' => 'The zip code is required.',
                'zip_code.regex' => 'Please enter a valid 6-digit zip code.',
                'country.required' => 'The country is required.',
            ]);
            $data['booking_id'] = $id;
            $insert = BillingDetail::create($data);
            return response()->json([
                'status'=>'success',
                'code'=>201,
                'message'=>'Billing Details Added Successfully',
                'data'=>$insert
            ],201);
        }
        catch (ValidationException $e){
            return response()->json([
                'status'=>'failed',
                'message'=>$e->validator->errors()->first(),
                'code'=>'422'
            ],422);
        }
        catch (QueryException $e){
            return response()->json([
                'status'=>'failed',
                'message'=>'Failed to query',
                'code'=>'500'
            ],500);
        }
        catch (\Exception $e){
            return response()->json([
                'status'=>'failed',
                'message'=>'Something went wrong',
                'code'=>'500'
            ],500);
        }
    }

    public function deletebillingDetails($id){
        try{
            $destroy = BillingDetail::findOrFail($id);
            $destroy->delete();
            return response()->json([
                'deleted_id'=>$id,
                'status'=>'success',
                'message'=>'Billing Details Deleted Successfully',
                'code'=>'200'
            ],200);
        }
        catch(ModelNotFoundException $e){
            return response()->json([
                'status'=>'failed',
                'message'=>'Billing Details not found',
                'code'=>'404'
            ],404);
        }
        catch(QueryException $e){
            return response()->json([
                'status'=>'failed',
                'message'=>'Failed to query',
                'code'=>'500'
            ],500);
        }
        catch (\Exception $e){
            return response()->json([
                'status'=>'failed',
                'message'=>'Something went wrong',
                'code'=>'500'
            ],500);
        }
    }

    public function search(Request $request)
    {
        $query = TravelBooking::with(['user', 'pricingDetails', 'bookingStatus', 'paymentStatus']);

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('pnr', 'like', "%{$keyword}%")
                ->orWhere('name', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%");
            });
            $bookings = TravelBooking::paginate(10);
            $hashids = new Hashids(config('hashids.salt'), config('hashids.length', 8));
            return view('web.booking.index', compact('bookings','hashids'));
        }


        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->filled('booking_status')) {
            $query->where('booking_status_id', $request->booking_status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status_id', $request->payment_status);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(10);
        $bookings->appends($request->all());

        $hashids = new Hashids(config('hashids.salt'), config('hashids.length', 8));
        $booking_status = BookingStatus::all();
        $payment_status = PaymentStatus::all();

        return view('web.booking.search', compact('bookings', 'hashids', 'booking_status', 'payment_status'));
    }


    public function updateRemark(Request $request,$id)
    {
        TravelBookingRemark::create([
            'booking_id' => $this->hashids->decode($id)[0],
            'particulars'=>$request->remark,
            'agent'=>Auth::id(),
        ]);
        $data = TravelBookingRemark::select('id','booking_id','agent','particulars','created_at')->where('booking_id',$this->hashids->decode($id)[0])->where('status',1)->get();
        return JsonResponse::successWithData('Booking review saved',201,$data,'201');
    }

    public function deleteRemark(Request $request,$id){

        $delete = TravelBookingRemark::where('id',$id)->delete();
        $data = TravelBookingRemark::select('id','booking_id','particulars')->where('booking_id',$this->hashids->decode($request->booking_id)[0])->get();
        return JsonResponse::successWithData('Booking review deleted',201,$data,'201');
    }

    public function updateFeedBack(Request $request, $id)
    {
        Log::info('Received parameters:', $request->all());

        $request->validate([
            'parameters' => 'required|array',
            'parameters.*.parameter' => 'required|string',
            'parameters.*.note' => 'nullable|string',
            'parameters.*.marks' => 'nullable|string',
            'parameters.*.quality' => 'nullable|string',
        ]);

        $bookingId = $this->hashids->decode($id)[0];

        foreach ($request->parameters as $param) {
            if($param['note']){
                TravelQualityFeedback::create([
                    'booking_id' => $bookingId,
                    'user_id' => Auth::id(),
                    'parameter' => $param['parameter'] ?? '',
                    'note' => $param['note'] ?? '',
                    'marks' => $param['marks'] ?? '',
                    'quality' => $param['quality'] ?? '',
                ]);
            }
        }

        $data = TravelQualityFeedback::select('id', 'booking_id', 'user_id', 'parameter', 'note', 'marks', 'quality', 'created_at')
            ->where('booking_id', $bookingId)
            ->get();

        return JsonResponse::successWithData('Booking Feedback saved', 201, $data, '201');
    }


    public function deleteFeedBack(Request $request,$id){
        $bookingId = $this->hashids->decode($id)[0];

        $delete = TravelQualityFeedback::where('booking_id',$bookingId)->where('parameter',$request->parameter)->delete();
        $data = TravelQualityFeedback::select('id', 'booking_id', 'user_id', 'parameter', 'note', 'marks', 'quality', 'created_at')->where('booking_id', $bookingId)->get();
        return JsonResponse::successWithData('Booking review deleted',201,$data,'201');
    }




}
