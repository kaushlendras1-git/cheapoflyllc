<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelBooking;
use App\Utils\JsonResponse;
use App\Models\AuthHistory;
use PDF;
use App\Models\BookingStatus;
use App\Models\PaymentStatus;
use App\Models\Campaign;
use App\Models\BillingDetail;
use App\Models\BookingType;
use App\Models\CarImages;
use App\Models\CruiseImages;
use App\Models\FlightImages;
use App\Models\HotelImages;
use App\Models\ScreenshotImages;
use App\Models\TrainImages;
use App\Models\TravelCruise;
use App\Models\TravelCruiseAddon;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\ZohoSign\ZohoSignService;


class AuthHistoryController extends Controller
{

    public function index($id) {
        $id = decode($id);
        $auth_histories = AuthHistory::where('auth_histories.booking_id', $id)->with('travel_billing_details')->get();

        foreach ($auth_histories as $auth_history) {
            if ($auth_history->auth_status == 'completed') {
                TravelBooking::where('id', $auth_history->booking_id)
                    ->update([
                        'booking_status_id' => 23,
                        'payment_status_id' => 30
                    ]);
            }
        }

        return view('web.mail-history.index', compact('auth_histories'));
    }
    

    public function updateZohoStatus(Request $request) {
        $auth_history_id = $request->auth_history_id;
        $auth_history = AuthHistory::find($auth_history_id);
        
        if (!$auth_history || !$auth_history->zoho_document_id) {
            return response()->json(['status' => 'sent', 'error' => 'No auth history or zoho document id']);
        }
        
     
        try {
         
            
            if ($auth_history->auth_status == 'completed') {
                TravelBooking::where('id', $auth_history->booking_id)
                    ->update([
                        'booking_status_id' => 23,
                        'payment_status_id' => 30
                    ]);
            }else{
                 $zohoService = new ZohoSignService();
                $data = $zohoService->getRequestDetails($auth_history->zoho_document_id);
                $zoho_status = $data['requests']['request_status'] ?? 'sent';
            }
            
            AuthHistory::where('id', $auth_history_id)->update(['auth_status' => $zoho_status]);
            return response()->json(['status' => $zoho_status, 'success' => true]);
        } catch (\Exception $e) {
            \Log::error('Zoho status update failed: ' . $e->getMessage());
            AuthHistory::where('id', $auth_history_id)->update(['auth_status' => 'sent']);
            return response()->json(['status' => 'sent', 'error' => $e->getMessage()]);
        }
    }


    public function sendSms($id) {
       try{
            #$booking = TravelBooking::findOrFail($id);
            #Mail::to($booking->email)->send(new AuthEmail($booking));
            return JsonResponse::success('SMS has been Sent.', 201,'201');
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
    }


    public function sendWhatsApp($id) {
        $booking = TravelBooking::findOrFail($id);
        $phone = preg_replace('/[^0-9]/', '', $booking->phone);
        $message = urlencode("Hi {$booking->name}, your booking is confirmed.");
        return redirect("https://wa.me/{$phone}?text={$message}");
    }

    
    





    public function downloadAuthPdf($id)
    {
       // try {
            // Fetch booking with relationships
            $booking = TravelBooking::with([
                'bookingTypes',
                'sectorDetails',
                'passengers',
                'billingDetails',
                'pricingDetails',
                'trainBookingDetails',
                'screenshots',
                'travelFlight' => fn($query) => $query->withTrashed(),
                'travelCar',
                'travelCruise',
                'travelHotel',
            ])->findOrFail($id);

            // Fetch billing pricing data
            $billingPricingData = DB::table('travel_billing_details as b')
                ->join('billing_details as p', 'b.state', '=', 'p.id')
                ->where('b.booking_id', $booking->id)
                ->select(
                    'b.id as billing_id', 'b.card_type', 'b.cc_number', 'b.cc_holder_name',
                    'b.exp_month', 'b.exp_year', 'b.cvv', 'b.authorized_amt',
                    'p.email', 'p.contact_number', 'p.street_address', 'p.city',
                    'p.state', 'p.zip_code', 'p.country'
                )
                ->first();

            // Fetch additional data
            $bookingStatus       = BookingStatus::where('status', 1)->get();
            $paymentStatus       = PaymentStatus::where('status', 1)->get();
            $campaigns           = Campaign::where('status', 1)->get();
            $billingData         = BillingDetail::where('booking_id', $booking->id)->get();
            $carImages           = CarImages::where('booking_id', $booking->id)->get();
            $cruise_images       = CruiseImages::where('booking_id', $booking->id)->get();
            $flight_images       = FlightImages::where('booking_id', $booking->id)->get();
            $hotel_images        = HotelImages::where('booking_id', $booking->id)->get();
            $screenshotImages    = ScreenshotImages::where('booking_id', $booking->id)->get();
            $train_images        = TrainImages::where('booking_id', $booking->id)->get();
            $travel_cruise_data  = TravelCruise::where('booking_id', $booking->id)->first();
            $travel_cruise_addon = TravelCruiseAddon::where('booking_id',$booking->id)->get();
            $users               = User::get();
            $bookingType         = BookingType::where('id',$booking->query_type)->first();

            // Collect everything into an array for PDF
            $data = [
                'booking'             => $booking,
                'billingPricingData'  => $billingPricingData,
                'bookingStatus'       => $bookingStatus,
                'paymentStatus'       => $paymentStatus,
                'campaigns'           => $campaigns,
                'billingData'         => $billingData,
                'carImages'           => $carImages,
                'cruise_images'       => $cruise_images,
                'flight_images'       => $flight_images,
                'hotel_images'        => $hotel_images,
                'screenshotImages'    => $screenshotImages,
                'train_images'        => $train_images,
                'travel_cruise_data'  => $travel_cruise_data,
                'travel_cruise_addon' => $travel_cruise_addon,
                'users'               => $users,
                'bookingType'         => $bookingType,
            ];

            // Load Blade view and pass data
            $pdf = PDF::loadView('pdf.mailPdf', $data);

            // Stream PDF to browser
            return $pdf->stream('authMail.pdf');

        // } catch (\Exception $e) {
        //     return JsonResponse::error('Internal Server Error', 500, '500');
        // }
        
    }





}
