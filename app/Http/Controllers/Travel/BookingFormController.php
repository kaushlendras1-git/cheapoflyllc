<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Models\BillingDetail;
use App\Models\TravelCruise;
use App\Models\CarImages;
use App\Models\CruiseImages;
use App\Models\TravelCruiseAddon;
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
use App\Models\BookingType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Traits\Loggable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Exports\BookingsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;
use App\Models\CallType;


class BookingFormController extends Controller
{

    protected $logController;

    public function __construct()
    {

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
            $getBillingdata = BillingDetail::select('country')->with('get_country')->find($insert->id);
            $insert['country'] = $getBillingdata->get_country->country_name;
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

    public function getBillingDetails($id){
        $data = BillingDetail::where('booking_id',$id)->get();
        return response()->json([
            'status'=>'success',
            'code'=>200,
            'data'=>$data
        ],200);
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

        $flight_booking = TravelBooking::where('user_id', $userId)->where('airlinepnr','!=', NULL)->count();
        $hotel_booking = TravelBooking::where('user_id', $userId)->where('hotel_ref','!=', NULL)->count();
        $cruise_booking = TravelBooking::where('user_id', $userId)->where('cruise_ref','!=', NULL)->count();
        $car_booking = TravelBooking::where('user_id', $userId)->where('car_ref','!=', NULL)->count();
        $train_booking = 0;
        $pending_booking = TravelBooking::where('user_id', $userId)->where('booking_status_id',1)->count();
        return view('web.booking.index', compact('bookings', 'flight_booking','hotel_booking','cruise_booking','car_booking','train_booking','pending_booking'));
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
            return view('web.booking.index', compact('bookings'));
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
        $booking_status = BookingStatus::all();
        $payment_status = PaymentStatus::all();

        return view('web.booking.search', compact('bookings', 'booking_status', 'payment_status'));
    }


   public function updateRemark(Request $request, $id)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'remark' => 'required|string|min:1|max:1000',
        ]);

        if ($validator->fails()) {
            return JsonResponse::error($validator->errors()->first(), 422);
        }

        try {
            $decodedId = decode($id);
            TravelBookingRemark::create([
                'booking_id' => $decodedId,
                'particulars' => nl2br(htmlspecialchars($request->remark, ENT_QUOTES, 'UTF-8')),
                'agent' => Auth::id(),
            ]);

            $data = TravelBookingRemark::with('agentUser:id,name')
                ->select('id', 'booking_id', 'agent', 'particulars', 'created_at')
                ->where('booking_id', $decodedId)
                ->where('status', 1)
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'booking_id' => $item->booking_id,
                        'agent' => $item->agentUser->name ?? 'N/A',
                        'particulars' => $item->particulars,
                        'created_at' => $item->created_at->format('d-m-Y'),
                    ];
                });

            return JsonResponse::successWithData('Booking remark saved successfully', 201, $data, '201');
        } catch (\Exception $e) {
            return JsonResponse::error('Failed to save remark: ' . $e->getMessage(), 500);
        }
    }

    public function deleteRemark(Request $request,$id){

        $delete = TravelBookingRemark::where('id',$id)->delete();
        $data = TravelBookingRemark::select('id','booking_id','particulars')->where('booking_id',decode($request->booking_id))->get();
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

        $bookingId = decode($id);

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
        $bookingId =decode($id);
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
            $rules = [
                'booking-type'        => 'required|array|min:1',
                'booking-type.*'      => 'in:Flight,Hotel,Cruise,Car,Train',
              #  'pnr'                 => 'required|string|max:255',
                'hotel_ref'           => 'nullable|string|max:255',
                'cruise_ref'          => 'nullable|string|max:255',
                'name'                => 'required|string|max:255',
                'phone'               => 'required|string|max:20',
                'campaign'               => 'required',
               # 'call_type'               => 'required',
                'query_type'          => 'nullable|string|max:255',
                'selected_company'    => 'required|string|max:255',
                'booking_status_id'   => 'nullable',
                'payment_status_id'   => 'nullable',
                'reservation_source'  => 'nullable|string|max:255',
                'descriptor'          => 'nullable|string|max:255',
                'amadeus_sabre_pnr'   => 'nullable|string|max:255',
                'sector_details.*'    => 'required|file|image|max:2048',
            ];

            // if(query_type)
            // '13', '14','18','19','32','33','39','41','43','44', '50', '51'
            //passenger[0][credit_note_amount]


           if(auth()->user()->departments != 'Billing')  {
                $rules['passenger']                              = 'required|array|min:1';
                $rules['passenger.*.passenger_type']             = 'required|string|in:Adult,Child,Infant,Seat Infant,Lap Infant';
                $rules['passenger.*.gender']                     = 'required|string|in:Male,Female,Other';
                $rules['passenger.*.title']                      = 'nullable|string|in:Mr,Ms,Mrs,Dr,Master,Miss';
                $rules['passenger.*.first_name']                 = ['required','string','max:255','regex:/^[A-Za-z\s]+$/'];
                $rules['passenger.*.middle_name']                = ['nullable','string','max:255','regex:/^[A-Za-z\s]+$/'];
                $rules['passenger.*.last_name']                  = ['required','string','max:255','regex:/^[A-Za-z\s]+$/'];
                $rules['passenger.*.dob']                        = 'required|date';
                $rules['passenger.*.seat_number']                = 'nullable|string';
                $rules['passenger.*.credit_note']                = 'nullable|numeric';
                $rules['passenger.*.e_ticket_number']            = 'nullable|string';
            }


            if(auth()->user()->departments != 'Billing')  {
            // ---- FLIGHT ----
            if (in_array('Flight', $bookingTypes)) {
                $flightImageExists = DB::table('flight_images')->where('booking_id', $id)->exists();

                if ($flightImageExists) {
                    $rules['flightbookingimage'] = 'array';
                    $rules['flight'] = 'array';
                } else {
                    $rules['flightbookingimage'] = 'required_without:flight|array';
                    $rules['flight'] = 'required_without:flightbookingimage|array|min:1';
                }

                $rules['pnrtype']                   = 'required';
                $rules['flight.*.direction']         = 'required_with:flight|string|in:Inbound,Outbound';
                $rules['flight.*.departure_date']    = 'required_with:flight|date';
                $rules['flight.*.departure_airport'] = 'required_with:flight|string|max:255';
                $rules['flight.*.departure_hours']   = 'required_with:flight|date_format:H:i';
                $rules['flight.*.arrival_airport']   = 'required_with:flight|string|max:255';
                $rules['flight.*.arrival_hours']     = 'required_with:flight|date_format:H:i';
                $rules['flight.*.duration']          = 'required_with:flight';
                #$rules['flight.*.transit']           = 'required_with:flight';
                #$rules['flight.*.arrival_date']      = 'required_with:flight|date|after_or_equal:flight.*.departure_date';
                #$rules['flight.*.airline_code']      = 'required_with:flight|string|size:2';
                $rules['flight.*.flight_number']     = 'required_with:flight|string|max:10';
                $rules['flight.*.cabin']             = 'required_with:flight|string|in:B.Eco,Eco,Pre.Eco,Buss.,First Class';
              #  $rules['flight.*.class_of_service']  = 'required_with:flight|string|max:3';
            }


            // ---- HOTEL ----
            if (in_array('Hotel', $bookingTypes)) {
                $hotelImageExists = DB::table('hotel_images')->where('booking_id', $id)->exists();
                if ($hotelImageExists) {
                    $rules['hotelbookingimage'] = 'array';
                    $rules['hotel'] = 'array';
                } else {
                     $rules['hotelbookingimage'] = 'required_without:hotel|array';
                    $rules['hotel'] = 'required_without:hotelbookingimage|array|min:1';
                }
              #  $rules['hotel_ref']                 = 'required|string';
                $rules['hotel.*.hotel_name']          = 'required_with:hotel|string|max:255';
                $rules['hotel.*.room_category']       = 'required_with:hotel|string|max:255';
                $rules['hotel.*.checkin_date']        = 'required_with:hotel|date';
                $rules['hotel.*.checkout_date'] = 'required_with:hotel|date|after_or_equal:hotel.*.checkin_date';
                $rules['hotel.*.no_of_rooms']         = 'required_with:hotel|integer|min:1';
                $rules['hotel.*.confirmation_number'] = 'required_with:hotel|string|max:100';
                $rules['hotel.*.hotel_address']       = 'required_with:hotel|string|max:500';
               # $rules['hotel.*.remarks']             = 'required_with:hotel|string|max:1000';
            }

            // ---- CRUISE ----
            if (in_array('Cruise', $bookingTypes)) {

                 $rules['cruise_name']                              = 'required';
                 $rules['ship_name']                              = 'required';
                 $rules['length']                              = 'required';
                 $rules['departure_port']                              = 'required';
                 $rules['arrival_port']                              = 'required';
                 $rules['cruise_line']                              = 'required';
               #  $rules['category']                              = 'required';
                 $rules['stateroom']                              = 'required';

                $cruiseImageExists = DB::table('cruise_images')->where('booking_id', $id)->exists();

                if ($cruiseImageExists) {
                    $rules['cruisebookingimage'] = 'array';
                    $rules['cruise'] = 'array';
                } else {
                    $rules['cruisebookingimage'] = 'required_without:cruise|array';
                    $rules['cruise'] = 'required_without:cruisebookingimage|array|min:1';
                }
              #  $rules['cruise_ref']                 = 'required|string';
                $rules['cruise.*.departure_date']  = 'required_with:cruise|date';
                 $rules['cruise.*.departure_port']  = 'required_with:cruise|string|max:255';
                 $rules['cruise.*.departure_hrs']   = 'required_with:cruise|date_format:H:i';
                 $rules['cruise.*.arrival_hrs']     = 'required_with:cruise|date_format:H:i';                
            }

            // ---- CAR ----
            if (in_array('Car', $bookingTypes)) {
                $carImageExists = DB::table('car_images')->where('booking_id', $id)->exists();
                 $rules['car_description'] = 'required_without:car';     
                if ($carImageExists) {
                    $rules['carbookingimage'] = 'array';
                    $rules['car'] = 'array';
                } else {
                    $rules['carbookingimage'] = 'required_without:car|array';
                    $rules['car'] = 'required_without:carbookingimage|array|min:1';
                }
              #  $rules['car_ref']                 = 'required|string';
                $rules['car.*.car_rental_provider']     = 'required_with:car|string|max:255';
                $rules['car.*.car_type']                = 'required_with:car|string|max:255';
                $rules['car.*.pickup_location']         = 'required_with:car|string|max:255';
                $rules['car.*.dropoff_location']        = 'required_with:car|string|max:255';
                $rules['car.*.pickup_date']             = 'required_with:car|date|after_or_equal:today';
                $rules['car.*.pickup_time']             = 'required_with:car|date_format:H:i';
                $rules['car.*.dropoff_date']            = 'required_with:car|date|after_or_equal:today';
                $rules['car.*.dropoff_time']            = 'required_with:car|date_format:H:i';
                $rules['car.*.confirmation_number']     = 'nullable|string|max:255';
                $rules['car.*.remarks']                 = 'nullable|string|max:255';
//                $rules['car.*.rental_provider_address'] = 'required_with:car|string|max:255';
            }

            // ---- TRAIN ----
            if (in_array('Train', $bookingTypes)) {
                $trainImageExists = DB::table('train_images')->where('booking_id', $id)->exists();

                if ($trainImageExists) {
                    $rules['trainbookingimage'] = 'array';
                    $rules['train'] = 'array';
                } else {
                    $rules['trainbookingimage'] = 'required_without:train|array';
                    $rules['train'] = 'required_without:trainbookingimage|array|min:1';
                }

                $rules['train_ref']                 = 'required|string';
                $rules['train.*.direction']         = 'required_with:train|string';
                $rules['train.*.departure_date']    = 'required_with:train|date';
                $rules['train.*.train_number']      = 'required_with:train|string|max:255';
                $rules['train.*.cabin']             = 'required_with:train|string';
                $rules['train.*.departure_station'] = 'required_with:train|string|max:255';
                $rules['train.*.departure_hours']   = 'required_with:train|string';
                $rules['train.*.arrival_station']   = 'required_with:train|string|max:255';
                $rules['train.*.arrival_hours']     = 'required_with:train|string';
                $rules['train.*.duration']          = 'required_with:train|string';
                $rules['train.*.transit']           = 'required_with:train|string';
                $rules['train.*.arrival_date']      = 'required_with:train|date';
            }

        }

            //BILLING
            $rules['billing']                           = 'required|array|min:1';
            $rules['billing.*.card_type']               = 'required|string|in:VISA,Mastercard,AMEX,DISCOVER';
            $rules['billing.*.cc_number']               = 'required|string|max:255';
            $rules['billing.*.cc_holder_name']          = ['required','string','max:255','regex:/^[A-Za-z\s]+$/'];
            $rules['billing.*.exp_month']               = 'required|in:01,02,03,04,05,06,07,08,09,10,11,12';
            $rules['billing.*.exp_year']                = 'required|integer|min:' . date('Y') . '|max:' . (date('Y') + 10);
            $rules['billing.*.cvv']                     = 'required|string|max:4';
            $rules['billing.*.currency']                = 'required|in:USD,CAD,EUR,GBP,AUD,INR,MXN';
            $rules['billing.*.amount']                  = 'required|numeric|min:1';

            //PRICIGN
            $rules['pricing']                          = 'required|array|min:1';
            $rules['pricing.*.passenger_type'] = [  'nullable',
                                                        'string',
                                                        'in:adult,child,infant,infant_on_lap,infant_on_seat',
                                                        'required_unless:pricing.*.details,Issuance Fees - Voyzant,Full Refund,Partial Refund,FXL Issuance Fees,Company card'
                                                    ];

            $rules['pricing.*.num_passengers']         = 'required|integer';
            $rules['pricing.*.gross_price']            = 'required|numeric|min:0';
            $rules['pricing.*.net_price']              = 'required|numeric|min:0';
            $rules['pricing.*.details']                = 'required|string';

           $remarkCount = DB::table('travel_booking_remarks')->where('booking_id', $id)->count();
            if ($remarkCount == 0) {
                $rules['remark'] = 'required';
            }

            $messages = [
                'remark.required'     => 'At least one Remark type is required.',
                // booking-type
                'booking-type.required'     => 'At least one booking type is required.',
                'booking-type.array'        => 'Booking types must be provided as an array.',
                'booking-type.min'          => 'At least one booking type must be selected.',
                'booking-type.*.in'         => 'Each booking type must be one of: Flight, Hotel, Cruise, Car, Train.',

                // pnr
                'pnr.required'              => 'PNR is required.',
                'pnr.string'                => 'PNR must be a valid string.',
                'pnr.max'                   => 'PNR can not exceed 255 characters.',

                // hotel_ref
                'hotel_ref.string'          => 'Hotel reference must be a valid string.',
                'hotel_ref.max'             => 'Hotel reference can not exceed 255 characters.',

                // cruise_ref
                'cruise_ref.string'         => 'Cruise reference must be a valid string.',
                'cruise_ref.max'            => 'Cruise reference can not exceed 255 characters.',

                // name
                'name.required'             => 'Name is required.',
                'name.string'               => 'Name must be a string.',
                'name.max'                  => 'Name cannot exceed 255 characters.',

                // phone
                'phone.required'            => 'Phone number is required.',
                'phone.string'              => 'Phone number must be a valid string.',
                'phone.max'                 => 'Phone number cannot exceed 20 characters.',

                // query_type
                'query_type.string'         => 'Query type must be a valid string.',
                'query_type.max'            => 'Query type cannot exceed 255 characters.',


                // selected_company
                'selected_company.required' => 'Selected company is required.',
                'selected_company.string'   => 'Selected company must be a string.',
                'selected_company.max'      => 'Selected company cannot exceed 255 characters.',

                // booking_status_id - nullable, no further constraints

                // payment_status_id - nullable, no further constraints

                // reservation_source
                'reservation_source.string' => 'Reservation source must be a string.',
                'reservation_source.max'    => 'Reservation source cannot exceed 255 characters.',

                // descriptor
                'descriptor.string'         => 'Descriptor must be a string.',
                'descriptor.max'            => 'Descriptor cannot exceed 255 characters.',

                // amadeus_sabre_pnr
                'amadeus_sabre_pnr.string' => 'Amadeus Sabre PNR must be a string.',
                'amadeus_sabre_pnr.max'    => 'Amadeus Sabre PNR cannot exceed 255 characters.',

                // sector_details
                'sector_details.*.required'=> 'Each sector detail is required.',
                'sector_details.*.file'    => 'Each sector detail must be a file.',
                'sector_details.*.image'   => 'Each sector detail must be an image.',
                'sector_details.*.max'     => 'Each sector detail file cannot exceed 2048 KB.',

                // passenger
                'passenger.required'       => 'At least one passenger is required.',
                'passenger.array'          => 'Passengers must be submitted as an array.',
                'passenger.min'            => 'At least one passenger is required.',

                'passenger.*.passenger_type.required' => 'Passenger type is required.',
                'passenger.*.passenger_type.string'   => 'Passenger type must be a valid string.',
                'passenger.*.passenger_type.in'       => 'Passenger type must be one of: Adult, Child, Infant, Seat Infant, Lap Infant.',

                'passenger.*.gender.required'         => 'Passenger gender is required.',
                'passenger.*.gender.string'           => 'Passenger gender must be a valid string.',
                'passenger.*.gender.in'               => 'Passenger gender must be one of: Male, Female, Other.',

                'passenger.*.title.string'            => 'Passenger title must be a valid string.',
                'passenger.*.title.in'                => 'Passenger title must be one of: Mr, Ms, Mrs, Dr, Master, Miss.',

               'passenger.*.first_name.required' => 'First name is required.',
                'passenger.*.first_name.string'   => 'First name must be a valid string.',
                'passenger.*.first_name.max'      => 'First name cannot exceed 255 characters.',
                'passenger.*.first_name.regex'    => 'First name can only contain letters and spaces.',

                'passenger.*.middle_name.string'  => 'Middle name must be a valid string.',
                'passenger.*.middle_name.max'     => 'Middle name cannot exceed 255 characters.',
                'passenger.*.middle_name.regex'   => 'Middle name can only contain letters and spaces.',

                'passenger.*.last_name.required'  => 'Last name is required.',
                'passenger.*.last_name.string'    => 'Last name must be a valid string.',
                'passenger.*.last_name.max'       => 'Last name cannot exceed 255 characters.',
                'passenger.*.last_name.regex'     => 'Last name can only contain letters and spaces.',

                'passenger.*.dob.required'            => 'Passenger date of birth is required.',
                'passenger.*.dob.date'                => 'Passenger date of birth must be a valid date.',
                'passenger.*.dob.before'              => 'Passenger date of birth must be a past date.',

                'passenger.*.seat_number.string'     => 'Passenger seat number must be a string.',
                'passenger.*.credit_note.numeric'    => 'Passenger credit note must be a numeric value.',
                'passenger.*.e_ticket_number.string' => 'Passenger e-ticket number must be a string.',

                // billing
                'billing.required'                   => 'At least one billing entry is required.',
                'billing.array'                      => 'Billing entries must be an array.',
                'billing.min'                        => 'At least one billing entry is required.',

                'billing.*.card_type.required'      => 'Billing card type is required.',
                'billing.*.card_type.string'        => 'Billing card type must be a string.',
                'billing.*.card_type.in'            => 'Billing card type must be one of: VISA, MasterCard, AMEX, Discover.',

                'billing.*.cc_number.required'      => 'Billing credit card number is required.',
                'billing.*.cc_number.string'        => 'Billing credit card number must be a string.',
                'billing.*.cc_number.max'           => 'Billing credit card number cannot exceed 255 characters.',

                'billing.*.cc_holder_name.required' => 'Billing card holder name is required.',
                'billing.*.cc_holder_name.string'   => 'Billing card holder name must be a string.',
                'billing.*.cc_holder_name.max'      => 'Billing card holder name cannot exceed 255 characters.',
                'billing.*.cc_holder_name.regex'    => 'Card holder name can only contain letters and spaces.',

                'billing.*.exp_month.required'      => 'Billing expiration month is required.',
                'billing.*.exp_month.in'            => 'Billing expiration month must be a valid month (01-12).',

                'billing.*.exp_year.required'       => 'Billing expiration year is required.',
                'billing.*.exp_year.integer'        => 'Billing expiration year must be a number.',
                'billing.*.exp_year.min'            => 'Billing expiration year cannot be in the past.',
                'billing.*.exp_year.max'            => 'Billing expiration year seems unrealistic.',

                'billing.*.cvv.required'            => 'Billing CVV is required.',
                'billing.*.cvv.string'              => 'Billing CVV must be a string.',
                'billing.*.cvv.max'                 => 'Billing CVV cannot exceed 4 characters.',

                'billing.*.currency.required'       => 'Billing currency is required.',
                'billing.*.currency.in'             => 'Billing currency must be one of: USD, CAD, EUR, GBP, AUD, INR, MXN.',

                'billing.*.amount.required'         => 'Billing amount is required.',
                'billing.*.amount.numeric'          => 'Billing amount must be a numeric value.',
                'billing.*.amount.min'              => 'Billing amount must be at least 1.',

                // pricing
                'pricing.required'                  => 'At least one pricing entry is required.',
                'pricing.array'                     => 'Pricing entries must be an array.',
                'pricing.min'                       => 'At least one pricing entry is required.',

                'pricing.*.passenger_type.required' => 'Pricing passenger type is required.',
                'pricing.*.passenger_type.string'   => 'Pricing passenger type must be a string.',
                'pricing.*.passenger_type.in'       => 'Pricing passenger type must be one of: adult, child, infant_on_lap, infant_on_seat.',

                'pricing.*.num_passengers.required' => 'Pricing number of passengers is required.',
                'pricing.*.num_passengers.integer'  => 'Pricing number of passengers must be an integer.',
                'pricing.*.num_passengers.min'      => 'Pricing number of passengers must be at least 1.',

                'pricing.*.gross_price.required'    => 'Pricing gross price is required.',
                'pricing.*.gross_price.numeric'     => 'Pricing gross price must be numeric.',
                'pricing.*.gross_price.min'         => 'Pricing gross price cannot be negative.',

                'pricing.*.net_price.required'      => 'Pricing net price is required.',
                'pricing.*.net_price.numeric'       => 'Pricing net price must be numeric.',
                'pricing.*.net_price.min'           => 'Pricing net price cannot be negative.',

                'pricing.*.details.required'        => 'Pricing details are required.',
                'pricing.*.details.string'          => 'Pricing details must be a string.',

                // Flight
                'flight.required'                   => 'Flight detail is required.',
                'flight.array'                      => 'Flight details must be an array.',
                'flight.min'                        => 'At least one flight detail is required.',

                'flight.*.direction.required'      => 'Flight direction is required (Inbound/Outbound).',
                'flight.*.direction.string'        => 'Flight direction must be a string.',
                'flight.*.direction.in'            => 'Flight direction must be either Inbound or Outbound.',

                'flight.*.departure_date.required' => 'Flight departure date is required.',
                'flight.*.departure_date.date'     => 'Flight departure date must be a valid date.',
                'flight.*.departure_date.after_or_equal' => 'Flight departure date cannot be in the past.',

                'flight.*.departure_airport.required' => 'Flight departure airport is required.',
                'flight.*.departure_airport.string' => 'Flight departure airport must be a string.',
                'flight.*.departure_airport.max'    => 'Flight departure airport cannot exceed 255 characters.',

                'flight.*.departure_hours.required' => 'Flight departure time is required.',
                'flight.*.departure_hours.date_format' => 'Flight departure time must be in the format HH:MM.',

                'flight.*.arrival_airport.required' => 'Flight arrival airport is required.',
                'flight.*.arrival_airport.string'   => 'Flight arrival airport must be a string.',
                'flight.*.arrival_airport.max'      => 'Flight arrival airport cannot exceed 255 characters.',

                'flight.*.arrival_hours.required'   => 'Flight arrival time is required.',
                'flight.*.arrival_hours.date_format' => 'Flight arrival time must be in the format HH:MM.',

                'flight.*.duration.required'         => 'Flight duration is required.',
                'flight.*.transit.required'          => 'Flight transit details are required.',

                'flight.*.arrival_date.required'     => 'Flight arrival date is required.',

                'flight.*.airline_code.required'     => 'Flight airline code is required.',
                'flight.*.airline_code.string'       => 'Flight airline code must be a string.',
                'flight.*.airline_code.size'         => 'Flight airline code must be exactly 2 characters.',

                'flight.*.flight_number.required'   => 'Flight number is required.',
                'flight.*.flight_number.string'     => 'Flight number must be a string.',
                'flight.*.flight_number.max'        => 'Flight number cannot exceed 10 characters.',

                'flight.*.cabin.required'            => 'Flight cabin is required.',
                'flight.*.cabin.string'              => 'Flight cabin must be a string.',
                'flight.*.cabin.in'                  => 'Flight cabin must be one of: B.Eco, Eco, Pre.Eco, Buss.',

                'flight.*.class_of_service.required' => 'Flight class of service is required.',
                'flight.*.class_of_service.string'   => 'Flight class of service must be a string.',
                'flight.*.class_of_service.max'      => 'Flight class of service cannot exceed 3 characters.',

                // Hotel
                'hotel.required'                   => 'Hotel booking details are required.',
                'hotel.array'                      => 'Hotel booking details must be an array.',
                'hotel.min'                        => 'At least one hotel booking is required.',

                'hotel.*.hotel_name.required'     => 'Hotel name is required.',
                'hotel.*.hotel_name.string'       => 'Hotel name must be a string.',
                'hotel.*.hotel_name.max'          => 'Hotel name cannot exceed 255 characters.',

                'hotel.*.room_category.required'  => 'Hotel room category is required.',
                'hotel.*.room_category.string'    => 'Hotel room category must be a string.',
                'hotel.*.room_category.max'       => 'Hotel room category cannot exceed 255 characters.',

                'hotel.*.checkin_date.required'   => 'Hotel check-in date is required.',
                'hotel.*.checkin_date.date'       => 'Hotel check-in date must be a valid date.',
                'hotel.*.checkin_date.after_or_equal' => 'Hotel check-in date cannot be before today.',

                'hotel.*.checkout_date.required'  => 'Hotel check-out date is required.',
                'hotel.*.checkout_date.date'      => 'Hotel check-out date must be a valid date.',
                'hotel.*.checkout_date.after'     => 'Hotel check-out date must be after the check-in date.',

                'hotel.*.no_of_rooms.required'    => 'Number of hotel rooms is required.',
                'hotel.*.no_of_rooms.integer'     => 'Number of hotel rooms must be an integer.',
                'hotel.*.no_of_rooms.min'         => 'At least one hotel room must be booked.',

                'hotel.*.confirmation_number.required' => 'Hotel confirmation number is required.',
                'hotel.*.confirmation_number.string'   => 'Hotel confirmation number must be a string.',
                'hotel.*.confirmation_number.max'      => 'Hotel confirmation number cannot exceed 100 characters.',

                'hotel.*.hotel_address.required'  => 'Hotel address is required.',
                'hotel.*.hotel_address.string'    => 'Hotel address must be a string.',
                'hotel.*.hotel_address.max'       => 'Hotel address cannot exceed 500 characters.',

                'hotel.*.remarks.required'        => 'Hotel remarks are required.',
                'hotel.*.remarks.string'          => 'Hotel remarks must be a string.',
                'hotel.*.remarks.max'             => 'Hotel remarks cannot exceed 1000 characters.',

                // Cruise
                'cruise.required'                 => 'Cruise booking details are required.',
                'cruise.array'                    => 'Cruise booking details must be an array.',
                'cruise.min'                      => 'At least one cruise booking is required.',

                'cruise.*.departure_port.required' => 'Cruise departure port is required.',
                'cruise.*.departure_port.string' => 'Cruise departure port must be a string.',
                'cruise.*.departure_port.max'    => 'Cruise departure port cannot exceed 255 characters.',

                'cruise.*.departure_date.required' => 'Cruise departure date is required.',
                'cruise.*.departure_date.date'     => 'Cruise departure date must be a valid date.',

                'cruise.*.departure_hrs.required'  => 'Cruise departure time is required.',
                'cruise.*.departure_hrs.date_format'=> 'Cruise departure time must be in format HH:MM.',
                
                'cruise.*.arrival_hrs.required'    => 'Cruise arrival time is required.',
                'cruise.*.arrival_hrs.date_format' => 'Cruise arrival time must be in format HH:MM.',

                // Car
                'car.required'                     => 'Car rental details are required.',
                'car.array'                        => 'Car rental details must be an array.',
                'car.min'                          => 'At least one car rental entry is required.',

                'car.*.car_rental_provider.required' => 'Car rental provider is required.',
                'car.*.car_rental_provider.string'   => 'Car rental provider must be a string.',
                'car.*.car_rental_provider.max'      => 'Car rental provider cannot exceed 255 characters.',

                'car.*.car_type.required'           => 'Car type is required.',
                'car.*.car_type.string'             => 'Car type must be a string.',
                'car.*.car_type.max'                => 'Car type cannot exceed 255 characters.',

                'car.*.pickup_location.required'   => 'Pickup location is required.',
                'car.*.pickup_location.string'     => 'Pickup location must be a string.',
                'car.*.pickup_location.max'        => 'Pickup location cannot exceed 255 characters.',

                'car.*.dropoff_location.required'  => 'Dropoff location is required.',
                'car.*.dropoff_location.string'    => 'Dropoff location must be a string.',
                'car.*.dropoff_location.max'       => 'Dropoff location cannot exceed 255 characters.',

                'car.*.pickup_date.required'       => 'Pickup date is required.',
                'car.*.pickup_date.date'           => 'Pickup date must be a valid date.',
                'car.*.pickup_date.after_or_equal' => 'Pickup date cannot be before today.',

                'car.*.pickup_time.required'       => 'Pickup time is required.',
                'car.*.pickup_time.date_format'    => 'Pickup time must be in format HH:MM.',

                'car.*.dropoff_date.required'      => 'Dropoff date is required.',
                'car.*.dropoff_date.date'          => 'Dropoff date must be a valid date.',
                'car.*.dropoff_date.after_or_equal'=> 'Dropoff date cannot be before today.',

                'car.*.dropoff_time.required'      => 'Dropoff time is required.',
                'car.*.dropoff_time.date_format'   => 'Dropoff time must be in format HH:MM.',

                'car.*.confirmation_number.string' => 'Car confirmation number must be a string.',
                'car.*.confirmation_number.max'    => 'Car confirmation number cannot exceed 255 characters.',

                'car.*.remarks.string'             => 'Car remarks must be a string.',
                'car.*.remarks.max'                => 'Car remarks cannot exceed 255 characters.',

                'car.*.rental_provider_address.required' => 'Rental provider address is required.',
                'car.*.rental_provider_address.string'   => 'Rental provider address must be a string.',
                'car.*.rental_provider_address.max'      => 'Rental provider address cannot exceed 255 characters.',

                // Train
                'train.required'                   => 'Train booking details are required.',
                'train.array'                      => 'Train booking details must be an array.',
                'train.min'                        => 'At least one train booking is required.',

                'train.*.direction.required'      => 'Train trip direction is required.',
                'train.*.direction.string'        => 'Train trip direction must be a string.',

                'train.*.departure_date.required' => 'Train departure date is required.',
                'train.*.departure_date.date'     => 'Train departure date must be a valid date.',
                'train.*.departure_date.after_or_equal' => 'Train departure date cannot be in the past.',

                'train.*.train_number.required'   => 'Train number is required.',
                'train.*.train_number.string'     => 'Train number must be a string.',
                'train.*.train_number.max'        => 'Train number cannot exceed 255 characters.',

                'train.*.cabin.required'           => 'Train cabin class is required.',
                'train.*.cabin.string'             => 'Train cabin class must be a string.',

                'train.*.departure_station.required' => 'Train departure station is required.',
                'train.*.departure_station.string'   => 'Train departure station must be a string.',
                'train.*.departure_station.max'      => 'Train departure station cannot exceed 255 characters.',

                'train.*.departure_hours.required'   => 'Train departure hour is required.',
                'train.*.departure_hours.integer'    => 'Train departure hour must be an integer.',
                'train.*.departure_hours.between'    => 'Train departure hour must be between 0 and 23.',

                'train.*.departure_minutes.required' => 'Train departure minutes are required.',
                'train.*.departure_minutes.integer'  => 'Train departure minutes must be an integer.',
                'train.*.departure_minutes.between'  => 'Train departure minutes must be between 0 and 59.',

                'train.*.arrival_station.required'   => 'Train arrival station is required.',
                'train.*.arrival_station.string'     => 'Train arrival station must be a string.',
                'train.*.arrival_station.max'        => 'Train arrival station cannot exceed 255 characters.',

                'train.*.arrival_hours.required'     => 'Train arrival hour is required.',
                'train.*.arrival_hours.integer'      => 'Train arrival hour must be an integer.',
                'train.*.arrival_hours.between'      => 'Train arrival hour must be between 0 and 23.',

                'train.*.arrival_minutes.required'   => 'Train arrival minutes are required.',
                'train.*.arrival_minutes.integer'    => 'Train arrival minutes must be an integer.',
                'train.*.arrival_minutes.between'    => 'Train arrival minutes must be between 0 and 59.',

                'train.*.duration.required'           => 'Train trip duration is required.',
                'train.*.duration.string'             => 'Train trip duration must be a string.',

                'train.*.transit.required'            => 'Train transit details are required.',
                'train.*.transit.string'              => 'Train transit details must be a string.',

                'train.*.arrival_date.required'       => 'Train arrival date is required.',
                'train.*.arrival_date.date'           => 'Train arrival date must be a valid date.',
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

                    // ✅ Prefix checks based on card type
                    if ($cardType === 'VISA' && !preg_match('/^4/', $ccNumber)) {
                        $validator->errors()->add("billing.$index.cc_number", 'VISA card numbers must start with 4.');
                    }

                    if ($cardType === 'MASTERCARD' && !preg_match('/^5[1-5]/', $ccNumber)) {
                        $validator->errors()->add("billing.$index.cc_number", 'Mastercard numbers must start with 51-55.');
                    }

                    if ($cardType === 'AMEX' && !preg_match('/^3[47]/', $ccNumber)) {
                        $validator->errors()->add("billing.$index.cc_number", 'AMEX numbers must start with 34 or 37.');
                    }

                    if ($cardType === 'DISCOVER' && !preg_match('/^6(?:011|5)/', $ccNumber)) {
                        $validator->errors()->add("billing.$index.cc_number", 'Discover numbers must start with 6011 or 65.');
                    }

                }
            });
            $validator->validate();

            $user_id =Auth::id();

            #DB::beginTransaction();

            $booking = TravelBooking::findOrFail($id);

            // if ($request->input('last_updated_at') != $booking->updated_at->toDateTimeString()) {
            //          return response()->json([
            //             'status' => 'error',
            //             'errors' => 'This booking was updated by someone else. Please refresh and try again.',
            //             'code' => 555
            //         ], 555);
            //  }


            $bookingData = $request->only([
                'payment_status_id', 'booking_status_id', 'pnr', 'campaign', 'hotel_ref', 'cruise_ref', 'car_ref', 'train_ref', 'airlinepnr',
                'amadeus_sabre_pnr', 'pnrtype', 'name', 'phone', 'email', 'query_type',
                'selected_company', 'reservation_source', 'descriptor','shared_booking','call_queue','gross_value','net_value','gross_mco','net_mco','merchant_fee'
            ]);
//            dd($request->all());
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
//            TravelBookingType::where('booking_id', $booking->id)
//                ->whereNotIn('id', $processedBookingTypeIds)
//                ->delete();
            $bookingTypesToDelete = TravelBookingType::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedBookingTypeIds ?? [])
                ->get();
            foreach ($bookingTypesToDelete as $bt) {
                $bt->delete(); // observer logs
            }


            $passengers = collect($request->input('passenger', []))
                ->filter(function ($data) {
                return collect($data)->filter()->isNotEmpty();
            });

            $processedPassengerIds = [];
            TravelPassenger::where('booking_id', $booking->id)
                ->get()
                ->each
                ->forceDelete();
//            TravelPassenger::where('booking_id', $booking->id)->delete();
            foreach ($passengers as $data) {

                $data['booking_id'] = $booking->id;

                $passenger = TravelPassenger::create(
                    $data
                );
                $processedPassengerIds[] = $passenger->id;
            }
            TravelPassenger::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedPassengerIds)
                ->get()
                ->each
                ->forceDelete();

            $existingFlightIds = $booking->travelFlight ? $booking->travelFlight->pluck('id')->toArray() : [];
            $newFlights = $request->input('flight', []);
            $processedFlightIds = [];
//            $check = TravelFlightDetail::where('booking_id', $booking->id)->forceDelete();
            $check = TravelFlightDetail::where('booking_id', $booking->id)
                ->get()
                ->each
                ->forceDelete();
            if(in_array('Flight',$newBookingTypes)){

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
                foreach ($newFlights as $flightData) {
                    $flightData['booking_id'] = $booking->id;
                    $flight = TravelFlightDetail::create(
                        $flightData
                    );
                    $processedFlightIds[] = $flight->id;
                }
            }

            TravelFlightDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedFlightIds)
                ->get()
                ->each
                ->forceDelete();

            $existingHotelIds = $booking->travelHotel->pluck('id')->toArray();
            $newHotels = $request->input('hotel', []);
            $processedHotelIds = [];

            $delete = TravelHotelDetail::where('booking_id', $booking->id)->get()->each->delete();
            if(in_array('Hotel',$newBookingTypes)){

                 $hotelData['hotel_description'] = $request->hotel_description;
                 $booking->update($hotelData);

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

                foreach ($newHotels as $hotelData) {
                    if ($this->allFieldsEmpty($hotelData)) {
                        continue;
                    }
                    $hotelData['booking_id'] = $booking->id;
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
//            TravelHotelDetail::where('booking_id', $booking->id)
//                ->whereNotIn('id', $processedHotelIds)
//                ->delete();
            TravelHotelDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedHotelIds ?? [])
                ->get()
                ->each
                ->delete();

            $existingCruiseIds = $booking->cruiseDetails?$booking->cruiseDetails->pluck('id')->toArray():[];
            $newCruises = $request->input('cruise', []);
            $processedCruiseIds = [];
            TravelCruiseDetail::where('booking_id', $booking->id)->get()->each->delete();
            if(in_array('Cruise',$newBookingTypes)){

                $cruiseData = $request->only(['cruise_name', 'ship_name','length', 'departure_port', 'arrival_port','cruise_line','category','stateroom','day', 'type']);
                if (!empty($cruiseData)) {
                    $cruiseData['booking_id'] = $booking->id;
                    TravelCruise::updateOrCreate(
                        ['booking_id' => $booking->id],
                        $cruiseData
                    );
                }

               if ($request->has('addon_cruise')) {
                    foreach ($request->addon_cruise as $addon) {
                        if (!empty($addon['services']) || !empty($addon['service_name'])) {
                            TravelCruiseAddon::create([
                                'services'     => $addon['services'] ?? '',
                                'service_name' => $addon['service_name'] ?? '',
                                'booking_id'   => $booking->id,
                                'image'        => 'spa.jpg', // Replace with file upload if needed
                            ]);
                        }
                    }
                }
                
                
                
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
                foreach ($newCruises as $cruiseData) {
                    if ($this->allFieldsEmpty($cruiseData)) {
                        continue;
                    }
                    $cruiseData['booking_id'] = $booking->id;
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
//            TravelCruiseDetail::where('booking_id', $booking->id)
//                ->whereNotIn('id', $processedCruiseIds)
//                ->delete();
            TravelCruiseDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedCruiseIds ?? [])
                ->get()
                ->each
                ->delete();
            $existingCarIds = $booking->carDetails ? $booking->carDetails->pluck('id')->toArray() : [];
            $newCars = $request->input('car', []);
            $processedCarIds = [];
            TravelCarDetail::where('booking_id', $booking->id)->get()->each->delete();

            if(in_array('Car',$newBookingTypes)){
                
                 $carData['car_description'] = $request->car_description;
                 $booking->update($carData);

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
                if (isset($request->car_main_image) && !empty($request->car_main_image)) {
                    $carbookingimage1 = [];
                    foreach ($request->car_main_image as $key => $image) {
                        $carbookingimage1 = 'storage/' . $image->store('car_booking_image', 'public');
                        CarImages::create([
                            'booking_id' => $booking->id,
                            'agent_id'=>auth()->user()->id,
                            'file_path'=>$carbookingimage1,
                            'isMainFiles'=>1
                        ]);
                    }
                }
                foreach ($newCars as $carData) {
                    $carData['booking_id'] = $booking->id;
                    $car = TravelCarDetail::create(
                        $carData
                    );
                    $processedCarIds[] = $car->id;
                }
            }

//            TravelCarDetail::where('booking_id', $booking->id)
//                ->whereNotIn('id', $processedCarIds)
//                ->delete();
            TravelCarDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedCarIds ?? [])
                ->get()
                ->each
                ->delete();

            $newTrains = !empty($request->train)?$request->train:[];
            TravelTrainDetail::where('booking_id', $booking->id)->get()->each->delete();
            if(in_array('Train',$newBookingTypes)){

                 $trainData['train_description'] = $request->train_description;
                 $booking->update($trainData);

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

                foreach ($newTrains as $train) {
                    $trainData = $train;
                    $trainData['booking_id'] = $booking->id;
                    $trainDataD = TravelTrainDetail::where('booking_id',$booking->id ?? null)->first();
                    $car = TravelTrainDetail::create(
                        $trainData
                    );
                }
            }
            $existingBillingIds = $booking->billingDetails->pluck('id')->toArray();
            $newBillings = $request->input('billing', []);
            $processedBillingIds = [];

            TravelBillingDetail::where('booking_id',$booking->id)->get()->each->forceDelete();
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
                ->get()
                ->each
                ->forceDelete();


            $existingPricingIds = $booking->pricingDetails->pluck('id')->toArray();
            $newPricings = $request->input('pricing', []);


          #  dd($newPricings);

            $processedPricingIds = [];

            TravelPricingDetail::where('booking_id',$booking->id)->get()->each->delete();
            foreach ($newPricings as $index => $pricingData) {
                $pricingData['booking_id'] = $booking->id;
                $pricing = TravelPricingDetail::create(
                    $pricingData
                );
                $processedPricingIds[] = $pricing->id;
            }

            TravelPricingDetail::where('booking_id', $booking->id)
                ->whereNotIn('id', $processedPricingIds)
                ->get()
                ->each
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

            if($request->payment_status_id == 7){
                //dd($request->payment_status_id);
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
        $id = decode($hash);
        if (!$id) {
            abort(404);
        }
        $hashids = $hash;
        $booking = TravelBooking::with([
            'bookingTypes',
            'sectorDetails',
            'passengers',
            'billingDetails.getBillingDetail',
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

        $userDepartments = auth()->user()->departments;
        $userDepartments = [$userDepartments];
        $booking_status = BookingStatus::where('status', 1)->whereJsonContains('department', $userDepartments[0])->get();
        $payment_status = PaymentStatus::where('status', 1)->whereJsonContains('department', $userDepartments[0])->get();
        $campaigns = Campaign::where('status',1)->get();
        $billingData = BillingDetail::with('get_country')->where('booking_id',$booking->id)->get();
        $feed_backs = TravelQualityFeedback::where('booking_id', $booking->id)->get();
        $car_images = CarImages::where('booking_id', $booking->id)->get();
        $cruise_images = CruiseImages::where('booking_id', $booking->id)->get();
        $flight_images = flightImages::where('booking_id', $booking->id)->get();
        $hotel_images = HotelImages::where('booking_id', $booking->id)->get();
        $screenshot_images = ScreenshotImages::where('booking_id', $booking->id)->get();
        $train_images = TrainImages::where('booking_id', $booking->id)->get();
        $travel_cruise_data = TravelCruise::where('booking_id', $booking->id)->first();
        $travel_cruise_addon = TravelCruiseAddon::where('booking_id', $booking->id)->get();
        $users = User::get();
        $booking_types = BookingType::get();
        $countries = \DB::table('countries')->get();
        $campaigns = Campaign::all();
      #  $call_types = CallType::all();
        return view('web.booking.show', compact('travel_cruise_addon','travel_cruise_data','campaigns','booking_types','car_images','cruise_images','flight_images','hotel_images','train_images','screenshot_images','countries','booking','users', 'hashids','feed_backs','booking_status','payment_status','campaigns','billingData'));
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



}
