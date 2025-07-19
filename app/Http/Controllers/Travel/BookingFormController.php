<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Models\TravelTrainDetail;
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
use App\Models\BookingStatus;
use App\Models\PaymentStatus;
use App\Models\TravelCruiseDetail;
use App\Models\TravelHotelDetail;
use App\Models\UserShiftAssignment;
use App\Models\ChangeLog;
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



class BookingFormController extends Controller
{
    protected $hashids;
    protected $logController;

    public function __construct()
    {
        // Initialize Hashids with salt and length from config
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



    public function store(Request $request)
    {
        try{

            $validator = Validator::make($request->all(), [
                'pnr' => 'required|string|max:255',
                'hotel_ref' => 'nullable|string|max:255',
                'cruise_ref' => 'nullable|string|max:255',
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'query_type' => 'nullable|string|max:255',
                'selected_company' => 'required|string|max:255',
                'booking_status_id' => 'required',
                'payment_status_id' => 'required',
                'reservation_source' => 'nullable|string|max:255',
                'descriptor' => 'nullable|string|max:255',
                'amadeus_sabre_pnr' => 'nullable|string|max:255',
                'sector_details.*' => 'required|file|image|max:2048',
                'passenger' => 'required|array|min:1',
                'passenger.*.passenger_type' => 'required|string|in:Adult,Child,Infant,Seat Infant,Lap Infant',
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
                'pricing.*.passenger_type' => 'required|string|in:adult,child,infant_on_lap,infant_on_seat',
                'pricing.*.num_passengers' => 'required|integer|min:1',
                'pricing.*.gross_price' => 'required|numeric|min:0',
                'pricing.*.net_price' => 'required|numeric|min:0',
                'pricing.*.details' => 'required|string',
            ],
                [
                'passenger.required' => 'Please provide at least one passenger.',
                'passenger.*.passenger_type.required' => 'Passenger type is required.',
                'passenger.*.passenger_type.in' => 'Passenger type must be Adult, Child, Infant, Lap Infant, Seat Infant.',
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
            ]);


            // Custom AMEX/non-AMEX card number & CVV validation
                $validator->after(function ($validator) use ($request) {
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

        // Trigger validation (throws ValidationException on failure)
       $validator->validate();


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
                'car_ref',
                'train_ref',
                'airlinepnr',
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

            $currentShift = UserShiftAssignment::where('user_id', auth()->id())
            ->whereDate('effective_from', '<=', Carbon::now())
            ->where(function ($q) {
                $q->whereNull('effective_to')->orWhere('effective_to', '>=', Carbon::now());
            })
            ->orderByDesc('effective_from')
            ->first();

            $campaign = substr(strtoupper($request->input('campaign')), 0, 3);
            $bookingData['pnr'] = $campaign . $request->input('pnr');
            $bookingData['user_id'] = auth()->id();
            $bookingData['shift_id'] =  $currentShift?->shift_id;
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
            foreach ($request->input('train', []) as $trainData) {
                $trainData['booking_id'] = $booking->id;
                TravelTrainDetail::create($trainData);
            }

            // Create Billing Details
            foreach ($request->input('billing', []) as $billingData) {
                $billingData['booking_id'] = $booking->id;
                TravelBillingDetail::create($billingData);
            }

            // Create Pricing Detail
//            $pricingData = $request->only([
//                'hotel_cost',
//                'cruise_cost',
//                'total_amount',
//                'advisor_mco',
//                'conversion_charge',
//                'airline_commission',
//                'final_amount',
//                'merchant',
//                'net_mco',
//                'passenger_type',
//                'num_passengers',
//                'gross_price',
//                'net_price',
//                'details'
//            ]);
            foreach ($request->pricing as $pricingData) {
                $pricingData['booking_id'] = $booking->id;
                TravelPricingDetail::create($pricingData);
            }


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
            return JsonResponse::error('Failed to Query'.$e,500,'500');
        }
        catch(\Exception $e){
            return JsonResponse::error('Internal Server Error',500,'500');
        }

        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return redirect()->route('travel.bookings.form')->with('error', 'Failed to submit booking: ' . $e->getMessage())->withFragment('booking-failed-' . ($booking->id ?? 'no-id'));
        // }
    }



    public function updateRemark(Request $request,$id)
    {
        TravelBookingRemark::create([
            'booking_id' => $this->hashids->decode($id)[0],
            'particulars'=>$request->remark,
            'agent'=>$request->agent,
        ]);
        $data = TravelBookingRemark::select('id','booking_id','agent','particulars','created_at')->where('booking_id',$this->hashids->decode($id)[0])->get();
        return JsonResponse::successWithData('Booking review saved',201,$data,'201');
    }

    public function deleteRemark(Request $request,$id){

        $delete = TravelBookingRemark::where('id',$id)->delete();
        $data = TravelBookingRemark::select('id','booking_id','particulars')->where('booking_id',$this->hashids->decode($request->booking_id)[0])->get();
        return JsonResponse::successWithData('Booking review deleted',201,$data,'201');
    }


    public function update(Request $request, $id)
    {
        if (empty($id)) {
            return redirect()->route('travel.bookings.form')->with('error', 'Invalid booking ID.')->withFragment('booking-failed');
        }


        try {

       $validator = Validator::make($request->all(), [
                'pnr' => 'required|string|max:255',
                'hotel_ref' => 'nullable|string|max:255',
                'cruise_ref' => 'nullable|string|max:255',
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
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
                'passenger.*.title' => 'nullable|string|in:Mr,Ms,Mrs,Dr',
                'passenger.*.first_name' => 'required|string',
                'passenger.*.middle_name' => 'nullable|string',
                'passenger.*.last_name' => 'required|string',
                'passenger.*.dob' => 'required|date|before:today',
                'passenger.*.seat_number' => 'nullable|string',
                'passenger.*.credit_note' => 'nullable|numeric',
                'passenger.*.e_ticket_number' => 'nullable|string',

                'billing' => 'required|array|min:1',
                'billing.*.card_type' => 'required|in:VISA,Mastercard,AMEX,DISCOVER',
                'billing.*.cc_number' => 'required|string|max:255',
                'billing.*.cc_holder_name' => 'required|string|max:255',
                'billing.*.cc_holder_name' => ['required','string','max:255','regex:/^[A-Za-z\s]+$/'],
                'billing.*.exp_month' => 'required|in:01,02,03,04,05,06,07,08,09,10,11,12',
                'billing.*.exp_year' => 'required|integer|min:' . date('Y') . '|max:' . (date('Y') + 10),
                'billing.*.cvv' => 'required|string|max:5',
                'billing.*.address' => 'required|string|max:255',
                'billing.*.email' => 'required|email|max:255',
                'billing.*.contact_no' => 'required|string|max:20',
                'billing.*.city' => 'required|string|max:255',
               'billing.*.country' => 'required|string|max:255',
               'billing.*.state' => 'required|string|max:255',

                'billing.*.zip_code' => 'required|string|max:10',
                'billing.*.currency' => 'required|in:USD,CAD,EUR,GBP,AUD,INR,MXN',
                'billing.*.amount' => 'required|numeric|min:0',

                'pricing' => 'required|array|min:1',
                'pricing.*.passenger_type' => 'required|string|in:adult,child,infant_on_lap,infant_on_seat',
                'pricing.*.num_passengers' => 'required|integer|min:1',
                'pricing.*.gross_price' => 'required|numeric|min:0',
                'pricing.*.net_price' => 'required|numeric|min:0',
                'pricing.*.details' => 'required|string',
            ],
                [

                'passenger.required' => 'Please provide at least one passenger.',
                'passenger.*.passenger_type.required' => 'Passenger type is required.',
                'passenger.*.passenger_type.in' => 'Passenger type must be Adult, Child, Infant, Lap Infant, Seat Infant.',
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
                'billing.*.cc_holder_name.regex' => 'Card holder name must only contain letters and spaces.',

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
            ]);

        $validator->after(function ($validator) use ($request) {
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

        // Trigger validation (throws ValidationException on failure)
        $validator->validate();
        $user_id =Auth::id();

            //DB::beginTransaction();

            // Update TravelBooking
            $booking = TravelBooking::findOrFail($id);
            $bookingData = $request->only([
                'payment_status_id', 'booking_status_id', 'pnr', 'campaign', 'hotel_ref', 'cruise_ref', 'car_ref', 'train_ref', 'airlinepnr',
                'amadeus_sabre_pnr', 'pnrtype', 'name', 'phone', 'email', 'query_type',
                'selected_company', 'reservation_source', 'descriptor',
            ]);
            $bookingData['shift_id'] = 2;
            $bookingData['team_id'] = 2;
            $bookingData['user_id'] = $user_id;
            // Perform the update
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


             // Update or Create Passengers
                $passengers = collect($request->input('passenger', []))
                    ->filter(function ($data) {
                        return collect($data)->filter()->isNotEmpty(); // Skip empty rows
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

            // Update or Create Flight Details
            $existingFlightIds = $booking->travelFlight ? $booking->travelFlight->pluck('id')->toArray() : [];
            $newFlights = $request->input('flight', []);
            $processedFlightIds = [];

            foreach ($newFlights as $flightData) {

                $flightData['booking_id'] = $booking->id;

                // Handle flight booking image uploads
                if (isset($request->flightbookingimage) && !empty($request->flightbookingimage)) {
                    $flightData['files'] = [];

                    foreach ($request->flightbookingimage as $key => $image) {
                        $flightData['files'][] = 'storage/' . $image->store('flight_booking_image', 'public');
                    }

                    $flightData['files'] = json_encode($flightData['files']);
                }

                $flight = TravelFlightDetail::updateOrCreate(
                    ['booking_id' => $booking->id],
                    $flightData
                );

                $processedFlightIds[] = $flight->id;
            }

            // Delete unprocessed (removed) flight records
            TravelFlightDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedFlightIds)
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
                if(!empty($request->hotelbookingimage)){
                    $hotelData['files'] = [];
                    foreach($request->hotelbookingimage as $key => $image){
                        $hotelData['files'][] = 'storage/'.$image->store('hotel_booking_image','public');
                    }
                    $hotelData['files'] = json_encode($hotelData['files']);
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

            // Update or Create Cruise Details
            $existingCruiseIds = $booking->cruiseDetails?$booking->cruiseDetails->pluck('id')->toArray():[];
            $newCruises = $request->input('cruise', []);
            $processedCruiseIds = [];

            foreach ($newCruises as $cruiseData) {
                if ($this->allFieldsEmpty($cruiseData)) {
                    continue;
                }
                $cruiseData['booking_id'] = $booking->id;
                if(isset($request->cruisebookingimage) && !empty($request->cruisebookingimage)){
                    $cruiseData['files'] = [];
                    foreach($request->cruisebookingimage as $key => $image){
                        $cruiseData['files'][] = 'storage/'.$image->store('cruise_booking_image','public');
                    }
                    $cruiseData['files'] = json_encode($cruiseData['files']);
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

            // Update or Create Car Details
            $existingCarIds = $booking->carDetails ? $booking->carDetails->pluck('id')->toArray() : [];
            $newCars = $request->input('car', []);
            $processedCarIds = [];

            foreach ($newCars as $carData) {
                $carData['booking_id'] = $booking->id;
                // Handle file upload
                if (isset($request->carbookingimage) && !empty($request->carbookingimage)) {
                    $carData['files'] = [];
                    foreach ($request->carbookingimage as $key => $image) {
                        $carData['files'][] = 'storage/' . $image->store('car_booking_image', 'public');
                    }
                    $carData['files'] = json_encode($carData['files']);
                }

                // Insert or update car detail
                $car = TravelCarDetail::updateOrCreate(
                    ['id' => $carData['id'] ?? null, 'booking_id' => $booking->id],
                    $carData
                );

                $processedCarIds[] = $car->id;
            }

            // Delete removed car details
            TravelCarDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedCarIds)
                ->delete();


            $newTrains = !empty($request->train)?$request->train:[];

            foreach ($newTrains as $train) {
                $trainData = $train;
                $trainData['booking_id'] = $booking->id;
                if(isset($request->trainbookingimage) && !empty($request->trainbookingimage)){
                    $trainData['files'] = [];
                    foreach($request->trainbookingimage as $key => $image){
                        $trainData['files'][] = 'storage/'.$image->store('train_booking_image','public');
                    }
                    $trainData['files'] = json_encode($trainData['files']);
                }
                $trainDataD = TravelTrainDetail::where('booking_id',$booking->id ?? null)->first();
                $car = TravelTrainDetail::updateOrCreate(
                    ['id' => $trainDataD['id'] ?? null, 'booking_id' => $booking->id],
                    $trainData
                );
            }
            // Update or Create Billing Details
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

            // Delete unprocessed billings
            TravelBillingDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedBillingIds)
                ->delete();


            // Update or Create Pricing Details
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

                // Delete pricing details that were not submitted in the new request
                TravelPricingDetail::where('booking_id', $booking->id)
                    ->whereNotIn('id', $processedPricingIds)
                    ->delete();










            ########################pricing error###################################

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




           // DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Booking updated successfully',
                'code'=>201
            ],201);
//            return redirect()->route('booking.show', ['id' => $id])->with('success', 'Booking updated successfully.');
        }
        catch(ValidationException $e){
            return JsonResponse::error($e->validator->errors()->first(),422,'422');
        }
        catch(QueryException $e){
            return JsonResponse::error('Failed to Query'.$e,500,'500');
        }
        catch(\Exception $e){
            \Log::error('Update Booking Error: '.$e->getMessage(), [
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
        $booking_status = BookingStatus::all();
        $payment_status = PaymentStatus::all();
        return view('web.booking.show', compact('booking', 'hashids','booking_status','payment_status'));
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
