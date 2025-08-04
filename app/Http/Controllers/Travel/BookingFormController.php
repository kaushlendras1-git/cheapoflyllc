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
                // Flight-specific validations
                'flight' => Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)) . '|array|min:1',
                'flight.*.direction' => Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)) . '|nullable|string|in:Inbound,Outbound',
                'flight.*.departure_date' => Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)) . '|nullable|date|after_or_equal:today',
                'flight.*.departure_airport'=>Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)) . '|nullable|string|max:255',
                'flight.*.departure_hours'=>Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)).'|nullable|date_format:H:i',
                'flight.*.arrival_airport'=>Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)).'|nullable|string|max:255',
                'flight.*.arrival_hours'=>Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)).'|nullable|date_format:H:i',
                'flight.*.duration'=>Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)).'|nullable',
                'flight.*.transit'=>Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)).'|nullable',
                'flight.*.arrival_date'=>Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)).'|nullable',
                'flight.*.airline_code' => Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)) . '|nullable|string|size:2', // Corrected to size:2
                'flight.*.flight_number' => Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)) . '|nullable|string|max:10',
                'flight.*.cabin' => Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)) . '|nullable|string|in:B.Eco,Eco,Pre.Eco,Buss.',
                'flight.*.class_of_service' => Rule::requiredIf(fn () => in_array('Flight', $bookingTypes)) . '|nullable|string|max:3',

                // Hotel-specific validations
                'hotel' => Rule::requiredIf(fn () => in_array('Hotel', $bookingTypes)) . '|array|min:1',
                'hotel.*.hotel_name' => Rule::requiredIf(fn () => in_array('Hotel', $bookingTypes)) . '|nullable|string|max:255',
                'hotel.*.room_category' => Rule::requiredIf(fn () => in_array('Hotel', $bookingTypes)) . '|nullable|string|max:255',
                'hotel.*.checkin_date' => Rule::requiredIf(fn () => in_array('Hotel', $bookingTypes)) . '|nullable|date|after_or_equal:today',
                'hotel.*.checkout_date' => Rule::requiredIf(fn () => in_array('Hotel', $bookingTypes)) . '|nullable|date|after:hotel.*.checkin_date',
                'hotel.*.no_of_rooms' => Rule::requiredIf(fn () => in_array('Hotel', $bookingTypes)).'|nullable|integer|min:1',
                'hotel.*.confirmation_number' => Rule::requiredIf(fn () => in_array('Hotel', $bookingTypes)).'|nullable|string|max:100',
                'hotel.*.hotel_address' => Rule::requiredIf(fn () => in_array('Hotel', $bookingTypes)).'|nullable|string|max:500',
                'hotel.*.remarks' => Rule::requiredIf(fn () => in_array('Hotel', $bookingTypes)).'|nullable|string|max:1000',

                // Cruise-specific validations
                'cruise' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)) . '|array|min:1',
                'cruise.*.cruise_line' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)) . '|nullable|string|max:255',
                'cruise.*.ship_name' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)) . '|nullable|string|max:255',
                'cruise.*.category' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)) . '|nullable|string|max:255',
                'cruise.*.stateroom' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)) . '|nullable|string|max:255',
                'cruise.*.departure_port' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)) . '|nullable|string|max:255',
                'cruise.*.departure_date' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)).'|nullable|date|required',
                'cruise.*.departure_hrs' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)).'|nullable|date_format:H:i|required',
                'cruise.*.arrival_port' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)).'|nullable|string|max:255|required',
                'cruise.*.arrival_hrs' => Rule::requiredIf(fn () => in_array('Cruise', $bookingTypes)).'|nullable|date_format:H:i|required',

                // Car-specific validations
                'car' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|array|min:1',
                'car.*.car_rental_provider' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|nullable|string|max:255',
                'car.*.car_type' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|nullable|string|max:255',
                'car.*.pickup_location' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|nullable|string|max:255',
                'car.*.dropoff_location' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|nullable|string|max:255',
                'car.*.pickup_date' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|nullable|date|after_or_equal:today',
                'car.*.pickup_time' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|nullable|date_format:H:i',
                'car.*.dropoff_date' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|nullable|date|after_or_equal:today',
                'car.*.dropoff_time' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|nullable|date_format:H:i',
                'car.*.confirmation_number' => 'nullable|string|max:255',
                'car.*.remarks' => 'nullable|string|max:255',
                'car.*.rental_provider_address' => Rule::requiredIf(fn () => in_array('Car', $bookingTypes)) . '|nullable|string|max:255',

                // Train-specific validations
                'train' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)) . '|array|min:1',
                'train.*.direction' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)) . '|nullable|string',
                'train.*.departure_date' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)) . '|nullable|date|after_or_equal:today',
                'train.*.train_number' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)) . '|nullable|string|max:255',
                'train.*.cabin' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)) . '|nullable|string',
                'train.*.departure_station' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)) . '|nullable|string|max:255',
                'train.*.departure_hours' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)).'|nullable|integer|between:0,23',
                'train.*.departure_minutes' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)).'|nullable|integer|between:0,59',
                'train.*.arrival_station' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)).'|nullable|string|max:255',
                'train.*.arrival_hours' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)).'|nullable|integer|between:0,23',
                'train.*.arrival_minutes' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)).'|nullable|integer|between:0,59',

                'train.*.duration' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)).'|nullable|string',
                'train.*.transit' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)).'|nullable|string',
                'train.*.arrival_date' => Rule::requiredIf(fn () => in_array('Train', $bookingTypes)).'|nullable|date',

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
                'booking-type.required' => 'Atleast one booking type is required',
                'booking-type.array' => 'Atleast one booking type is required',
                'booking-type.min' => 'Atleast one booking type is required',
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
                'flight.required' => 'Please add flight details.',
                'flight.array' => 'Flight information must be an array.',
                'flight.min' => 'At least one flight entry is required.',

                'flight.*.direction.required' => 'Flight direction is required (Inbound or Outbound).',
                'flight.*.direction.string' => 'Flight direction must be valid text.',
                'flight.*.direction.in' => 'Flight direction must be either Inbound or Outbound.',

                'flight.*.departure_date.required' => 'Flight departure date is required.',
                'flight.*.departure_date.date' => 'Flight departure date must be a valid date.',
                'flight.*.departure_date.after_or_equal' => 'Flight departure date cannot be in the past.',

                'flight.*.departure_airport.required' => 'Flight departure airport is required.',
                'flight.*.departure_airport.string' => 'Flight departure airport must be valid text.',
                'flight.*.departure_airport.max' => 'Flight departure airport name cannot exceed 255 characters.',

                'flight.*.departure_hours.required' => 'Flight departure time is required.',
                'flight.*.departure_hours.date_format' => 'Flight departure time must be in the format HH:MM.',

                'flight.*.arrival_airport.required' => 'Flight arrival airport is required.',
                'flight.*.arrival_airport.string' => 'Flight arrival airport must be valid text.',
                'flight.*.arrival_airport.max' => 'Flight arrival airport name cannot exceed 255 characters.',

                'flight.*.arrival_hours.required' => 'Flight arrival time is required.',
                'flight.*.arrival_hours.date_format' => 'Flight arrival time must be in the format HH:MM.',

                'flight.*.duration.required' => 'Flight duration is required.',
                'flight.*.duration.string' => 'Flight duration must be valid text.',

                'flight.*.transit.required' => 'Flight transit details are required.',
                'flight.*.transit.string' => 'Flight transit details must be valid text.',

                'flight.*.arrival_date.required' => 'Flight arrival date is required.',
                'flight.*.arrival_date.date' => 'Flight arrival date must be a valid date.',

                'flight.*.airline_code.required' => 'Flight airline code is required.',
                'flight.*.airline_code.string' => 'Flight airline code must be a text value.',
                'flight.*.airline_code.size' => 'Flight airline code must be exactly 2 characters.',

                'flight.*.flight_number.required' => 'Flight number is required.',
                'flight.*.flight_number.string' => 'Flight number must be a text value.',
                'flight.*.flight_number.max' => 'Flight number cannot exceed 10 characters.',

                'flight.*.cabin.required' => 'Flight cabin class is required.',
                'flight.*.cabin.string' => 'Flight cabin class must be valid text.',
                'flight.*.cabin.in' => 'Flight cabin class must be one of: B.Eco, Eco, Pre.Eco, Buss.',

                'flight.*.class_of_service.required' => 'Flight class of service is required.',
                'flight.*.class_of_service.string' => 'Flight class of service must be valid text.',
                'flight.*.class_of_service.max' => 'Flight class of service cannot exceed 3 characters.',

                // Hotel-specific error messages
                'hotel.required' => 'Please provide hotel booking details.',
                'hotel.array' => 'Hotel booking details must be an array.',
                'hotel.min' => 'At least one hotel booking is required.',

                'hotel.*.hotel_name.required' => 'Hotel name is required.',
                'hotel.*.hotel_name.string' => 'Hotel name must be a valid text.',
                'hotel.*.hotel_name.max' => 'Hotel name cannot exceed 255 characters.',

                'hotel.*.room_category.required' => 'Hotel room category is required.',
                'hotel.*.room_category.string' => 'Hotel room category must be valid text.',
                'hotel.*.room_category.max' => 'Hotel room category cannot exceed 255 characters.',

                'hotel.*.checkin_date.required' => 'Hotel check-in date is required.',
                'hotel.*.checkin_date.date' => 'Hotel check-in date must be a valid date.',
                'hotel.*.checkin_date.after_or_equal' => 'Hotel check-in date cannot be before today.',

                'hotel.*.checkout_date.required' => 'Hotel check-out date is required.',
                'hotel.*.checkout_date.date' => 'Hotel check-out date must be a valid date.',
                'hotel.*.checkout_date.after' => 'Hotel check-out date must be after the check-in date.',

                'hotel.*.no_of_rooms.required' => 'Hotel number of rooms is required.',
                'hotel.*.no_of_rooms.integer' => 'Hotel number of rooms must be a whole number.',
                'hotel.*.no_of_rooms.min' => 'You must book at least 1 hotel room.',

                'hotel.*.confirmation_number.required' => 'Hotel confirmation number is required.',
                'hotel.*.confirmation_number.string' => 'Hotel confirmation number must be valid text.',
                'hotel.*.confirmation_number.max' => 'Hotel confirmation number cannot exceed 100 characters.',

                'hotel.*.hotel_address.required' => 'Hotel address is required.',
                'hotel.*.hotel_address.string' => 'Hotel address must be valid text.',
                'hotel.*.hotel_address.max' => 'Hotel address cannot exceed 500 characters.',

                'hotel.*.remarks.required' => 'Hotel remarks are required.',
                'hotel.*.remarks.string' => 'Hotel remarks must be valid text.',
                'hotel.*.remarks.max' => 'Hotel remarks cannot exceed 1000 characters.',

                // Cruise-specific error messages
                'cruise.required' => 'Please provide cruise booking details.',
                'cruise.array' => 'Cruise booking details must be an array.',
                'cruise.min' => 'At least one cruise booking entry is required.',

                'cruise.*.cruise_line.required' => 'Cruise line name is required.',
                'cruise.*.cruise_line.string' => 'Cruise line name must be valid text.',
                'cruise.*.cruise_line.max' => 'Cruise line name cannot exceed 255 characters.',

                'cruise.*.ship_name.required' => 'Cruise ship name is required.',
                'cruise.*.ship_name.string' => 'Cruise ship name must be valid text.',
                'cruise.*.ship_name.max' => 'Cruise ship name cannot exceed 255 characters.',

                'cruise.*.category.required' => 'Cruise category is required.',
                'cruise.*.category.string' => 'Cruise category must be valid text.',
                'cruise.*.category.max' => 'Cruise category cannot exceed 255 characters.',

                'cruise.*.stateroom.required' => 'Cruise stateroom is required.',
                'cruise.*.stateroom.string' => 'Cruise stateroom must be valid text.',
                'cruise.*.stateroom.max' => 'Cruise stateroom cannot exceed 255 characters.',

                'cruise.*.departure_port.required' => 'Cruise departure port is required.',
                'cruise.*.departure_port.string' => 'Cruise departure port must be valid text.',
                'cruise.*.departure_port.max' => 'Cruise departure port cannot exceed 255 characters.',

                'cruise.*.departure_date.required' => 'Cruise departure date is required.',
                'cruise.*.departure_date.date' => 'Cruise departure date must be a valid date.',

                'cruise.*.departure_hrs.required' => 'Cruise departure time is required.',
                'cruise.*.departure_hrs.date_format' => 'Cruise departure time must be in the format HH:MM.',

                'cruise.*.arrival_port.required' => 'Cruise arrival port is required.',
                'cruise.*.arrival_port.string' => 'Cruise arrival port must be valid text.',
                'cruise.*.arrival_port.max' => 'Cruise arrival port cannot exceed 255 characters.',

                'cruise.*.arrival_hrs.required' => 'Cruise arrival time is required.',
                'cruise.*.arrival_hrs.date_format' => 'Cruise arrival time must be in the format HH:MM.',
                // Car-specific error messages
                'car.required' => 'Please provide car rental details.',
                'car.array' => 'Car details must be a valid array.',
                'car.min' => 'At least one car rental entry is required.',

                'car.*.car_rental_provider.required' => 'Car rental provider name is required.',
                'car.*.car_rental_provider.string' => 'Car rental provider must be a valid text.',
                'car.*.car_rental_provider.max' => 'Car rental provider name cannot exceed 255 characters.',

                'car.*.car_type.required' => 'Car type is required.',
                'car.*.car_type.string' => 'Car type must be a valid text.',
                'car.*.car_type.max' => 'Car type cannot exceed 255 characters.',

                'car.*.pickup_location.required' => 'Car pickup location is required.',
                'car.*.pickup_location.string' => 'Car pickup location must be a valid text.',
                'car.*.pickup_location.max' => 'Car pickup location cannot exceed 255 characters.',

                'car.*.dropoff_location.required' => 'Car dropoff location is required.',
                'car.*.dropoff_location.string' => 'Car dropoff location must be a valid text.',
                'car.*.dropoff_location.max' => 'Car dropoff location cannot exceed 255 characters.',

                'car.*.pickup_date.required' => 'Car pickup date is required.',
                'car.*.pickup_date.date' => 'Car pickup date must be a valid date.',
                'car.*.pickup_date.after_or_equal' => 'Car pickup date cannot be earlier than today.',

                'car.*.pickup_time.required' => 'Car pickup time is required.',
                'car.*.pickup_time.date_format' => 'Car pickup time must be in the format HH:MM.',

                'car.*.dropoff_date.required' => 'Car dropoff date is required.',
                'car.*.dropoff_date.date' => 'Car dropoff date must be a valid date.',
                'car.*.dropoff_date.after_or_equal' => 'Car dropoff date cannot be earlier than today.',

                'car.*.dropoff_time.required' => 'Car dropoff time is required.',
                'car.*.dropoff_time.date_format' => 'Car dropoff time must be in the format HH:MM.',

                'car.*.confirmation_number.string' => 'Car confirmation number must be a valid text.',
                'car.*.confirmation_number.max' => 'Car confirmation number cannot exceed 255 characters.',

                'car.*.remarks.string' => 'Car remarks must be a valid text.',
                'car.*.remarks.max' => 'Car remarks cannot exceed 255 characters.',

                'car.*.rental_provider_address.required' => 'Car rental provider address is required.',
                'car.*.rental_provider_address.string' => 'Car rental provider address must be a valid text.',
                'car.*.rental_provider_address.max' => 'Car rental provider address cannot exceed 255 characters.',

                // Train-specific error messages
                'train.required' => 'Please provide train booking details.',
                'train.array' => 'Train bookings must be provided as an array.',
                'train.min' => 'At least one train booking is required.',

                'train.*.direction.required' => 'Train trip direction is required.',
                'train.*.direction.string' => 'Train trip direction must be valid text.',
                'train.*.direction.in' => 'Train trip direction must be either "One Way" or "Round Trip".',

                'train.*.departure_date.required' => 'Train departure date is required.',
                'train.*.departure_date.date' => 'Train departure date must be a valid date.',
                'train.*.departure_date.after_or_equal' => 'Train departure date cannot be in the past.',

                'train.*.train_number.required' => 'Train number is required.',
                'train.*.train_number.string' => 'Train number must be valid text.',
                'train.*.train_number.max' => 'Train number cannot exceed 255 characters.',

                'train.*.cabin.required' => 'Train cabin class is required.',
                'train.*.cabin.string' => 'Train cabin class must be valid text.',
                'train.*.cabin.in' => 'Train cabin class must be one of: Economy, Sleeper, Business, or First.',

                'train.*.departure_station.required' => 'Train departure station is required.',
                'train.*.departure_station.string' => 'Train departure station must be valid text.',
                'train.*.departure_station.max' => 'Train departure station cannot exceed 255 characters.',

                'train.*.departure_hours.required' => 'Train departure hour is required (0-23).',
                'train.*.departure_hours.integer' => 'Train departure hour must be an integer.',
                'train.*.departure_hours.between' => 'Train departure hour must be between 0 and 23.',

                'train.*.departure_minutes.required' => 'Train departure minutes are required (0-59).',
                'train.*.departure_minutes.integer' => 'Train departure minutes must be an integer.',
                'train.*.departure_minutes.between' => 'Train departure minutes must be between 0 and 59.',

                'train.*.arrival_station.required' => 'Train arrival station is required.',
                'train.*.arrival_station.string' => 'Train arrival station must be valid text.',
                'train.*.arrival_station.max' => 'Train arrival station cannot exceed 255 characters.',

                'train.*.arrival_hours.required' => 'Train arrival hour is required (0-23).',
                'train.*.arrival_hours.integer' => 'Train arrival hour must be an integer.',
                'train.*.arrival_hours.between' => 'Train arrival hour must be between 0 and 23.',

                'train.*.arrival_minutes.required' => 'Train arrival minutes are required (0-59).',
                'train.*.arrival_minutes.integer' => 'Train arrival minutes must be an integer.',
                'train.*.arrival_minutes.between' => 'Train arrival minutes must be between 0 and 59.',

                'train.*.duration.required' => 'Train trip duration is required.',
                'train.*.duration.string' => 'Train trip duration must be valid text.',

                'train.*.transit.required' => 'Train transit details are required.',
                'train.*.transit.string' => 'Train transit details must be valid text.',

                'train.*.arrival_date.required' => 'Train arrival date is required.',
                'train.*.arrival_date.date' => 'Train arrival date must be a valid date.',
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


}
