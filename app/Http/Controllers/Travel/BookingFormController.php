<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Models\BillingDetail;
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
        // Initialize Hashids with salt and length from config
        $this->hashids = new Hashids(config('hashids.salt'), config('hashids.length', 8));
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
        $data = TravelBookingRemark::select('id','booking_id','agent','particulars','created_at')->where('booking_id',$this->hashids->decode($id)[0])->get();
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


    public function update(Request $request, $id)
    {
        if (empty($id)) {
            return redirect()->route('travel.bookings.form')->with('error', 'Invalid booking ID.')->withFragment('booking-failed');
        }

        try {

            $bookingTypes = $request->input('booking-type', []);

            // if query_type = Cancellation for Refunds
            // query_type=seat_number
            // query_type=credit_note_amount

            $rules = [
                'booking-type' => 'required|array|min:1',
                'booking-type.*' => 'in:Flight,Hotel,Cruise,Car,Train',
                'pnr' => 'required|string|max:255',
                'hotel_ref' => 'nullable|string|max:255',
                'cruise_ref' => 'nullable|string|max:255',
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'query_type' => 'nullable|string|max:255',
                'selected_company' => 'required|string|max:255',
                'booking_status_id' => 'nullable',
                'payment_status_id' => 'nullable',
                'reservation_source' => 'nullable|string|max:255',
                'descriptor' => 'nullable|string|max:255',
                'amadeus_sabre_pnr' => 'nullable|string|max:255',
                'sector_details.*' => 'required|file|image|max:2048',

                'passenger' => 'required|array|min:1',
                'passenger.*.passenger_type' => 'required|string|in:Adult,Child,Infant,Seat Infant,Lap Infant',
                'passenger.*.gender' => 'required|string|in:Male,Female,Other',
                'passenger.*.title' => 'nullable|string|in:Mr,Ms,Mrs,Dr,Master,Miss',
                'passenger.*.first_name' => 'required|string',
                'passenger.*.middle_name' => 'nullable|string',
                'passenger.*.last_name' => 'required|string',
                'passenger.*.dob' => 'required|date|before:today',
                'passenger.*.seat_number' => 'nullable|string',
                'passenger.*.credit_note' => 'nullable|numeric',
                'passenger.*.e_ticket_number' => 'nullable|string',

              /*
                // Flight-specific validations
                'flight' => Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)) . '|array|min:1',
                'flight.*.direction' => Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)) . '|string|in:Inbound,Outbound',
                'flight.*.departure_date' => Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)) . '|date|after_or_equal:today',
                'flight.*.airline_code' => Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)) . '|string|size:2', // Corrected to size:2
                'flight.*.flight_number' => Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)) . '|string|max:10',
                'flight.*.cabin' => Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)) . '|string|in:Economy,Premium Economy,Business,First',
                'flight.*.class_of_service' => Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)) . '|string|max:3',

                // Hotel-specific validations
                'hotel' => Rule::requiredIf(fn () => in_array('Hotel', $bookingTypes)) . '|array|min:1',
                'hotel.*.hotel_name' => Rule::requiredIf(fn () => in_array('Hotel', $bookingTypes)) . '|string|max:255',
                'hotel.*.room_category' => Rule::requiredIf(fn () => in_array('Hotel', $bookingTypes)) . '|string|max:255',
                'hotel.*.checkin_date' => Rule::requiredIf(fn () => in_array('Hotel', $bookingTypes)) . '|date|after_or_equal:today',
                'hotel.*.checkout_date' => Rule::requiredIf(fn () => in_array('Hotel', $bookingTypes)) . '|date|after:hotel.*.checkin_date',

                // Cruise-specific validations
                'cruise' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)) . '|array|min:1',
                'cruise.*.cruise_line' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)) . '|string|max:255',
                'cruise.*.ship_name' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)) . '|string|max:255',
                'cruise.*.category' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)) . '|string|max:255',
                'cruise.*.stateroom' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)) . '|string|max:255',
                'cruise.*.departure_port' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)) . '|string|max:255',

                // Car-specific validations
                'car' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|array|min:1',
                'car.*.car_rental_provider' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|string|max:255',
                'car.*.car_type' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|string|max:255',
                'car.*.pickup_location' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|string|max:255',
                'car.*.dropoff_location' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|string|max:255',
                'car.*.dropoff_date' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|date|after_or_equal:today',
                'car.*.dropoff_time' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|date_format:H:i',
                'car.*.confirmation_number' => 'nullable|string|max:255',
                'car.*.remarks' => 'nullable|string|max:255',
                'car.*.rental_provider_address' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|string|max:255',

                // Train-specific validations
                'train' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)) . '|array|min:1',
                'train.*.direction' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)) . '|string|in:One Way,Round Trip',
                'train.*.departure_date' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)) . '|date|after_or_equal:today',
                'train.*.train_number' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)) . '|string|max:255',
                'train.*.cabin' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)) . '|string|in:Economy,Sleeper,Business,First',
                'train.*.departure_station' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)) . '|string|max:255',

                */

                'billing' => 'required|array|min:1',
                'billing.*.card_type' => 'required|string|in:VISA,MasterCard,AMEX,Discover',
                'billing.*.cc_number' => 'required|string|max:255',
                'billing.*.cc_holder_name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z\s]+$/'],
                'billing.*.exp_month' => 'required|in:01,02,03,04,05,06,07,08,09,10,11,12',
                'billing.*.exp_year' => 'required|integer|min:' . date('Y') . '|max:' . (date('Y') + 10),
                'billing.*.cvv' => 'required|string|max:4',
                'billing.*.currency' => 'required|in:USD,CAD,EUR,GBP,AUD,INR,MXN',
                'billing.*.amount' => 'required|numeric|min:1', // Changed from string to numeric for consistency

                'pricing' => 'required|array|min:1',
                'pricing.*.passenger_type' => 'required|string|in:adult,child,infant_on_lap,infant_on_seat',
                'pricing.*.num_passengers' => 'required|integer|min:1',
                'pricing.*.gross_price' => 'required|numeric|min:0',
                'pricing.*.net_price' => 'required|numeric|min:0',
                'pricing.*.details' => 'required|string',

            ];

            $messages = [
                'booking-type.*.in' => 'Each booking type must be one of: Flight, Hotel, Cruise, Car, Train.',
                'passenger.required' => 'Please provide at least one passenger.',
                'passenger.*.passenger_type.required' => 'Passenger type is required.',
                'passenger.*.passenger_type.in' => 'Passenger type must be Adult, Child, Infant, Lap Infant, Seat Infant.',
                'passenger.*.gender.required' => 'Passenger Gender is required.',
                'passenger.*.gender.in' => 'Passenger Gender must be Male, Female, or Other.',
                'passenger.*.title.in' => 'Passenger Title must be one of: Mr, Ms, Mrs, Dr, Master, Miss.',
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
                'billing.*.cc_holder_name.required' => 'Billing Card holder name is required.',
                'billing.*.cc_holder_name.regex' => 'Card holder name must only contain letters and spaces.',
                'billing.*.exp_month.required' => 'Billing Expiration month is required.',
                'billing.*.exp_year.required' => 'Billing Expiration year is required.',
                'billing.*.cvv.required' => 'Billing CVV is required.',
                'billing.*.currency.required' => 'Billing Currency is required.',
                'billing.*.amount.required' => 'Billing Amount is required.',
                'billing.*.amount.numeric' => 'Billing Amount must be a valid number.',
                'billing.*.amount.min' => 'Billing Amount must be at least 1.',

                'pricing.required' => 'Please provide at least one pricing entry.',
                'pricing.*.passenger_type.required' => 'Pricing Passenger type is required.',
                'pricing.*.passenger_type.in' => 'Pricing Passenger type must be one of: adult, child, infant on lap, or infant on seat.',
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

                // Flight-specific error messages
                'flight.required_if' => 'Flight details are required when booking type is Flight.',
                'flight.*.direction.required_if' => 'Flight direction is required.',
                'flight.*.direction.in' => 'Flight direction must be Inbound or Outbound.',
                'flight.*.departure_date.required_if' => 'Flight departure date is required.',
                'flight.*.departure_date.date' => 'Flight departure date must be a valid date.',
                'flight.*.departure_date.after_or_equal' => 'Flight departure date must be today or later.',
                'flight.*.airline_code.required_if' => 'Flight airline code is required.',
                'flight.*.airline_code.size' => 'Flight airline code must be exactly 2 characters.',
                'flight.*.flight_number.required_if' => 'Flight number is required.',
                'flight.*.cabin.required_if' => 'Flight cabin is required.',
                'flight.*.cabin.in' => 'Flight cabin must be Economy, Premium Economy, Business, or First.',
                'flight.*.class_of_service.required_if' => 'Flight class of service is required.',

                // Hotel-specific error messages
                'hotel.required_if' => 'Hotel details are required when booking type is Hotel.',
                'hotel.*.hotel_name.required_if' => 'Hotel name is required.',
                'hotel.*.room_category.required_if' => 'Hotel room category is required.',
                'hotel.*.checkin_date.required_if' => 'Hotel check-in date is required.',
                'hotel.*.checkin_date.date' => 'Hotel check-in date must be a valid date.',
                'hotel.*.checkin_date.after_or_equal' => 'Hotel check-in date must be today or later.',
                'hotel.*.checkout_date.required_if' => 'Hotel check-out date is required.',
                'hotel.*.checkout_date.date' => 'Hotel check-out date must be a valid date.',
                'hotel.*.checkout_date.after' => 'Hotel check-out date must be after check-in date.',

                // Cruise-specific error messages
                'cruise.required_if' => 'Cruise details are required when booking type is Cruise.',
                'cruise.*.cruise_line.required_if' => 'Cruise line is required.',
                'cruise.*.ship_name.required_if' => 'Cruise ship name is required.',
                'cruise.*.category.required_if' => 'Cruise category is required.',
                'cruise.*.stateroom.required_if' => 'Cruise stateroom is required.',
                'cruise.*.departure_port.required_if' => 'Cruise departure port is required.',

                // Car-specific error messages
                'car.required_if' => 'Car details are required when booking type is Car.',
                'car.*.car_rental_provider.required_if' => 'Car rental provider is required.',
                'car.*.car_type.required_if' => 'Car type is required.',
                'car.*.pickup_location.required_if' => 'Car pickup location is required.',
                'car.*.dropoff_location.required_if' => 'Car drop-off location is required.',
                'car.*.dropoff_date.required_if' => 'Car drop-off date is required.',
                'car.*.dropoff_date.date' => 'Car drop-off date must be a valid date.',
                'car.*.dropoff_date.after_or_equal' => 'Car drop-off date must be today or later.',
                'car.*.dropoff_time.required_if' => 'Car drop-off time is required.',
                'car.*.dropoff_time.date_format' => 'Car drop-off time must be in HH:MM format.',
                'car.*.rental_provider_address.required_if' => 'Car rental provider address is required.',

                // Train-specific error messages
                'train.required_if' => 'Train details are required when booking type is Train.',
                'train.*.direction.required_if' => 'Train direction is required.',
                'train.*.direction.in' => 'Train direction must be One Way or Round Trip.',
                'train.*.departure_date.required_if' => 'Train departure date is required.',
                'train.*.departure_date.date' => 'Train departure date must be a valid date.',
                'train.*.departure_date.after_or_equal' => 'Train departure date must be today or later.',
                'train.*.train_number.required_if' => 'Train number is required.',
                'train.*.cabin.required_if' => 'Train cabin is required.',
                'train.*.cabin.in' => 'Train cabin must be Economy, Sleeper, Business, or First.',
                'train.*.departure_station.required_if' => 'Train departure station is required.',
            ];

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

                // // Prevent validation of fields for unselected booking types
                // $allowedFields = array_map('strtolower', $bookingTypes);
                // $possibleFields = ['flight', 'hotel', 'cruise', 'car', 'train'];

                // foreach ($possibleFields as $field) {
                //     if (!in_array($field, $allowedFields) && $request->has($field)) {
                //         $validator->errors()->add($field, "The {$field} field should not be provided when booking type does not include " . ucfirst($field) . ".");
                //     }
                // }
            });

            $validator->validate();

            $user_id =Auth::id();

            DB::beginTransaction();

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
            foreach ($passengers as $data) {

                $data['booking_id'] = $booking->id;
                $passenger = TravelPassenger::updateOrCreate(
                    ['booking_id' => $booking->id],
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

            foreach ($newFlights as $flightData) {

                $flightData['booking_id'] = $booking->id;

                // Handle flight booking image uploads
                if (isset($request->flightbookingimage) && !empty($request->flightbookingimage)) {
                    $flightbookingimage = [];

                    foreach ($request->flightbookingimage as $key => $image) {
                        $flightbookingimage[] = 'storage/' . $image->store('flight_booking_image', 'public');
                    }
                    TravelBooking::where('id',$booking->id)->update([
                        'flightbookingimage'=>json_encode($flightbookingimage)
                    ]);

                }
                $flight = TravelFlightDetail::updateOrCreate(
                    ['booking_id' => $booking->id],
                    $flightData
                );

                $processedFlightIds[] = $flight->id;
            }

            TravelFlightDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedFlightIds)
                ->delete();

            $existingHotelIds = $booking->travelHotel->pluck('id')->toArray();
            $newHotels = $request->input('hotel', []);
            $processedHotelIds = [];

            foreach ($newHotels as $hotelData) {
                if ($this->allFieldsEmpty($hotelData)) {
                    continue;
                }
                $hotelData['booking_id'] = $booking->id;
                if(!empty($request->hotelbookingimage)){
                    $hotelbookingimage = [];
                    foreach($request->hotelbookingimage as $key => $image){
                        $hotelbookingimage[] = 'storage/'.$image->store('hotel_booking_image','public');
                    }
                    TravelBooking::where('id',$booking->id)->update([
                        'hotelbookingimage'=>json_encode($hotelbookingimage)
                    ]);
                }

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

            $existingCruiseIds = $booking->cruiseDetails?$booking->cruiseDetails->pluck('id')->toArray():[];
            $newCruises = $request->input('cruise', []);
            $processedCruiseIds = [];

            foreach ($newCruises as $cruiseData) {
                if ($this->allFieldsEmpty($cruiseData)) {
                    continue;
                }
                $cruiseData['booking_id'] = $booking->id;
                if(isset($request->cruisebookingimage) && !empty($request->cruisebookingimage)){
                    $cruisebookingimage = [];
                    foreach($request->cruisebookingimage as $key => $image){
                        $cruisebookingimage[] = 'storage/'.$image->store('cruise_booking_image','public');
                    }
                    TravelBooking::where('id',$booking->id)->update([
                        'cruisebookingimage'=>json_encode($cruisebookingimage)
                    ]);
                }
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
            $existingCarIds = $booking->carDetails ? $booking->carDetails->pluck('id')->toArray() : [];
            $newCars = $request->input('car', []);
            $processedCarIds = [];

            foreach ($newCars as $carData) {
                $carData['booking_id'] = $booking->id;
                // Handle file upload
                if (isset($request->carbookingimage) && !empty($request->carbookingimage)) {
                    $carbookingimage = [];
                    foreach ($request->carbookingimage as $key => $image) {
                        $carbookingimage[] = 'storage/' . $image->store('car_booking_image', 'public');
                    }
                    TravelBooking::where('id',$booking->id)->update([
                        'carbookingimage'=>json_encode($carbookingimage)
                    ]);
                }

                // Insert or update car detail
                $car = TravelCarDetail::updateOrCreate(
                    ['id' => $carData['id'] ?? null, 'booking_id' => $booking->id],
                    $carData
                );

                $processedCarIds[] = $car->id;
            }

            TravelCarDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedCarIds)
                ->delete();


            $newTrains = !empty($request->train)?$request->train:[];

            foreach ($newTrains as $train) {
                $trainData = $train;
                $trainData['booking_id'] = $booking->id;

                if(isset($request->trainbookingimage) && !empty($request->trainbookingimage)){
                    $trainbookingimage = [];
                    foreach($request->trainbookingimage as $key => $image){
                        $trainbookingimage[] = 'storage/'.$image->store('train_booking_image','public');
                    }
                    TravelBooking::where('id',$booking->id)->update([
                        'trainbookingimage'=>json_encode($trainbookingimage)
                    ]);
                }
                $trainDataD = TravelTrainDetail::where('booking_id',$booking->id ?? null)->first();
                $car = TravelTrainDetail::updateOrCreate(
                    ['id' => $trainDataD['id'] ?? null, 'booking_id' => $booking->id],
                    $trainData
                );
            }
            $existingBillingIds = $booking->billingDetails->pluck('id')->toArray();
            $newBillings = $request->input('billing', []);
            $processedBillingIds = [];

            foreach ($newBillings as $index => $billingData) {
                    $billingData['booking_id'] = $booking->id;
                    // Set active only if this is the last card
                    $billingData['is_active'] = ($request->input('activeCard') == $index) ? 1 : 0;
                    $billing = TravelBillingDetail::updateOrCreate(
                        ['booking_id' => $booking->id],
                        $billingData
                    );
                    $processedBillingIds[] = $billing->id;
                }

            TravelBillingDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedBillingIds)
                ->delete();

            $existingPricingIds = $booking->pricingDetails->pluck('id')->toArray();
            $newPricings = $request->input('pricing', []);
            $processedPricingIds = [];

            foreach ($newPricings as $index => $pricingData) {
                // Skip if required fields are missing (e.g., passenger_type is blank)
                if (empty($pricingData['passenger_type'])) {
                    continue;
                }

                $pricingData['booking_id'] = $booking->id;

                $pricing = TravelPricingDetail::updateOrCreate(
                    ['id' => $pricingData['id'] ?? null, 'booking_id' => $booking->id],
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
                $screenshots = [];
                foreach ($request->screenshots as $key => $image) {
                    $screenshots[] = 'storage/' . $image->store('screenshots', 'public');
                }
                TravelBooking::where('id',$booking->id)->update([
                    'screenshot'=>json_encode($screenshots)
                ]);
            }
            DB::commit();
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

            return JsonResponse::error('Internal Server Error', 500, '500');
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
        $users = User::get();
        return view('web.booking.show', compact('booking','users', 'hashids','feed_backs','booking_status','payment_status','campaigns','billingData'));
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


}
