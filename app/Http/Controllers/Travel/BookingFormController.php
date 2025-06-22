<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Hashids\Hashids;
use Carbon\Carbon;

class BookingFormController extends Controller
{   
    protected $hashids;

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

        //dd($request->all());

        // Validate the request data
        $validator = Validator::make($request->all(), [
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

          
            // 'booking-type' => 'required|array',
            // 'booking-type.*' => 'string|max:255',
          
            // 'passenger' => 'required|array',
            // 'passenger.*.passenger_type' => 'required|string|max:255',
            // 'passenger.*.gender' => 'nullable|string|max:255',
            // 'passenger.*.dob' => 'nullable|date',
            // 'passenger.*.seat_number' => 'nullable|string|max:50',
            // 'passenger.*.title' => 'nullable|string|max:50',
            // 'passenger.*.credit_note' => 'nullable|numeric|min:0',
            // 'passenger.*.first_name' => 'required|string|max:255',
            // 'passenger.*.middle_name' => 'nullable|string|max:255',
            // 'passenger.*.last_name' => 'required|string|max:255',
            // 'passenger.*.e_ticket_number' => 'nullable|string|max:50',
            // 'billing' => 'required|array',
            // 'billing.*.card_type' => 'required|string|max:255',
            // 'billing.*.cc_number' => 'nullable|string|max:20',
            // 'billing.*.cc_holder_name' => 'nullable|string|max:255',
            // 'billing.*.exp_month' => 'required|string|max:2',
            // 'billing.*.exp_year' => 'required|string|max:4',
            // 'billing.*.cvv' => 'nullable|string|max:4',
            // 'billing.*.address' => 'nullable|string|max:255',
            // 'billing.*.email' => 'nullable|email|max:255',
            // 'billing.*.contact_no' => 'nullable|string|max:20',
            // 'billing.*.city' => 'nullable|string|max:255',
            // 'billing.*.country' => 'nullable|string|max:255',
            // 'billing.*.state' => 'nullable|string|max:255',
            // 'billing.*.zip_code' => 'nullable|string|max:10',
            // 'billing.*.currency' => 'required|string|max:3',
            // 'billing.*.amount' => 'required|numeric|min:0',
            // 'activeCard' => 'required|integer',
            // 'hotel_cost' => 'required|numeric|min:0',
            // 'cruise_cost' => 'required|numeric|min:0',
            // 'total_amount' => 'required|numeric|min:0',
            // 'advisor_mco' => 'required|numeric|min:0',
            // 'conversion_charge' => 'required|numeric|min:0',
            // 'airline_commission' => 'required|numeric|min:0',
            // 'final_amount' => 'required|numeric|min:0',
            // 'merchant' => 'required|string|max:255',
            // 'net_mco' => 'required|numeric|min:0',
            // 'particulars' => 'nullable|string',
            // 'feedback' => 'nullable|string',
            // 'status' => 'nullable|string|max:255',
            // 'type' => 'required|string|max:255',
            // 'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->withFragment('booking-failed');
        }

      //dd($request->file('sector_details'));

        if ($request->hasFile('sector_details')) {
            foreach ($request->file('sector_details') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/sector_details'), $fileName);

                TravelSectorDetail::create([
                    'booking_id' => $booking->id,
                    'sector_type' => $fileName,
                ]);
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
            $booking = TravelBooking::create($bookingData);

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
                return redirect()->route('booking.show', ['id' => $hash])->with('success', 'Booking form submitted successfully.');
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return redirect()->route('travel.bookings.form')->with('error', 'Failed to submit booking: ' . $e->getMessage())->withFragment('booking-failed-' . ($booking->id ?? 'no-id'));
        // }
    }

    public function update(Request $request, $id)
    {
        // Find the booking
        $booking = TravelBooking::findOrFail($id);

        // Validate the request data
        $validator = Validator::make($request->all(), [
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
            'booking-type' => 'required|array',
            'booking-type.*' => 'string|max:255',
            'sector_type' => 'required|string|max:255',
            'passenger' => 'required|array',
            'passenger.*.passenger_type' => 'required|string|max:255',
            'passenger.*.gender' => 'nullable|string|max:255',
            'passenger.*.dob' => 'nullable|date',
            'passenger.*.seat_number' => 'nullable|string|max:50',
            'passenger.*.title' => 'nullable|string|max:50',
            'passenger.*.credit_note' => 'nullable|numeric|min:0',
            'passenger.*.first_name' => 'required|string|max:255',
            'passenger.*.middle_name' => 'nullable|string|max:255',
            'passenger.*.last_name' => 'required|string|max:255',
            'passenger.*.e_ticket_number' => 'nullable|string|max:50',
            'billing' => 'required|array',
            'billing.*.card_type' => 'required|string|max:255',
            'billing.*.cc_number' => 'nullable|string|max:20',
            'billing.*.cc_holder_name' => 'nullable|string|max:255',
            'billing.*.exp_month' => 'required|string|max:2',
            'billing.*.exp_year' => 'required|string|max:4',
            'billing.*.cvv' => 'nullable|string',
            'billing.*.address' => 'nullable|string|max:255',
            'billing.*.email' => 'nullable|email|max:255',
            'billing.*.contact_no' => 'nullable|string|max:20',
            'billing.*.city' => 'nullable|string|max:255',
            'billing.*.country' => 'nullable|string|max:255',
            'billing.*.state' => 'nullable|string|max:255',
            'billing.*.zip_code' => 'nullable|string|max:10',
            'billing.*.currency' => 'required|string',
            'billing.*.amount' => 'required|numeric|min:0',
            'activeCard' => 'required|integer',
            'hotel_cost' => 'required|numeric|min:0',
            'cruise_cost' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'advisor_mco' => 'required|numeric|min:0',
            'conversion_charge' => 'required|numeric|min:0',
            'airline_commission' => 'required|numeric|min:0',
            'final_amount' => 'required|numeric|min:0',
            'merchant' => 'required|string|max:255',
            'net_mco' => 'required|numeric|min:0',
            'particulars' => 'nullable|string',
            'feedback' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            $hash = $this->hashids->encode($id);
            return redirect()->route('booking.show', ['id' => $hash])->withErrors($validator)->withInput()->withFragment('booking-failed-' . $id);
        }

        // try {
            DB::beginTransaction();

            // Update TravelBooking
            $booking->update($request->only([
                'pnr',
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
            ]));

            // Update Booking Types (delete existing and create new)
            TravelBookingType::where('booking_id', $booking->id)->delete();
            foreach ($request->input('booking-type', []) as $type) {
                TravelBookingType::create([
                    'booking_id' => $booking->id,
                    'type' => $type,
                ]);
            }

            // Update Sector Detail
            TravelSectorDetail::updateOrCreate(
                ['booking_id' => $booking->id],
                ['sector_type' => $request->input('sector_type')]
            );

            // Update Passengers (delete existing and create new)
            TravelPassenger::where('booking_id', $booking->id)->delete();
            foreach ($request->input('passenger', []) as $passengerData) {
                $passengerData['booking_id'] = $booking->id;
                TravelPassenger::create($passengerData);
            }

            // Update Billing Details (delete existing and create new)
            TravelBillingDetail::where('booking_id', $booking->id)->delete();
            foreach ($request->input('billing', []) as $billingData) {
                $billingData['booking_id'] = $booking->id;
                TravelBillingDetail::create($billingData);
            }

            // Update Pricing Detail
            TravelPricingDetail::updateOrCreate(
                ['booking_id' => $booking->id],
                $request->only([
                    'hotel_cost',
                    'cruise_cost',
                    'total_amount',
                    'advisor_mco',
                    'conversion_charge',
                    'airline_commission',
                    'final_amount',
                    'merchant',
                    'net_mco',
                ])
            );

            // Update Booking Remark (delete existing and create new if provided)
            TravelBookingRemark::where('booking_id', $booking->id)->delete();
            if ($request->filled('particulars')) {
                TravelBookingRemark::create([
                    'booking_id' => $booking->id,
                    'agent' => 'Testagent',
                    'date_time' => now(),
                    'particulars' => $request->input('particulars'),
                ]);
            }

            // Update Quality Feedback (delete existing and create new if provided)
            TravelQualityFeedback::where('booking_id', $booking->id)->delete();
            if ($request->filled('feedback')) {
                TravelQualityFeedback::create([
                    'booking_id' => $booking->id,
                    'qa' => 'Test QA',
                    'date_time' => now(),
                    'feedback' => $request->input('feedback'),
                ]);
            }

            // Update Screenshot (delete existing and create new if provided)
            TravelScreenshot::where('booking_id', $booking->id)->delete();
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
            return redirect()->route('booking.show', ['id' => $hash])->with('success', 'Booking updated successfully.');


        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return redirect()->route('travel.bookings.form')
        //         ->with('error', 'Failed to update booking: ' . $e->getMessage())
        //         ->withFragment('booking-failed-' . $id);
        // }
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
            'bookingTypes', 'sectorDetails', 'passengers', 'billingDetails',
            'pricingDetails', 'remarks', 'qualityFeedback', 'screenshots'
        ])->findOrFail($id);


        
        // $booking = TravelBooking::with([
        //     'bookingTypes', 'passengers', 'billingDetails'
        // ])->findOrFail($id);


        return view('web.booking.show', compact('booking','hashids'));
    }

    public function add(){
        $day = date('d'); // Day of the month (e.g., 21)
        $month = date('m'); // Month (e.g., 06)
        $startOfDay = strtotime('today'); // Timestamp for the start of the day
        $currentTime = time(); // Current timestamp
        $secondsSinceStartOfDay = $currentTime - $startOfDay; // Seconds since start of the day

        // Limit seconds to 4 digits
        $formattedSeconds = str_pad($secondsSinceStartOfDay % 10000, 4, '0', STR_PAD_LEFT);

        // Count today's bookings
        $todayBookingCount = DB::table('travel_bookings')
            ->whereDate('created_at', now()->toDateString())
            ->count();

        // Generate the serial number
        $pnr = $day . $month . $formattedSeconds . str_pad($todayBookingCount + 1, 4, '0', STR_PAD_LEFT);

        return view('web.booking.add', compact('pnr'));
    }

    protected function allFieldsEmpty(array $fields): bool
    {
        foreach ($fields as $key => $value) {
            if (!is_null($value) && trim((string) $value) !== '') {
                return false; // At least one field is not empty
            }
        }
        return true; // All fields are empty
    }
    


}