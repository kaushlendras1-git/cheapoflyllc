<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TravelBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuthEmail;
use App\Utils\JsonResponse;
use App\ZohoSign\ZohoSignService;
use App\Models\AuthHistory;
use App\Models\TravelBillingDetail;
use Illuminate\Validation\ValidationException;
use Swift_TransportException;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Campaign;
use App\Models\BillingDetail;
use App\Models\CarImages;
use App\Models\CruiseImages;
use App\Models\FlightImages;
use App\Models\HotelImages;
use App\Models\ScreenshotImages;
use App\Models\TrainImages;
use App\Models\TravelCruise;
use App\Models\TravelCruiseAddon;
use App\Models\User;

class AuthEmailController extends Controller
{

   public function index(Request $request)
    {
        try{
            $request->validate([
                'refund_status'=>'required|in:refundable,non-refundable',
                'booking_id'=>'required',
                'card_id'=>'required',
                'card_billing_id'=>'required',
                'email'=>'required'
            ],[
                'refund_status.required' => 'Please select a refund status.',
                'refund_status.in'       => 'Invalid refund status selected.',

                'booking_id.required'      => 'Invalid payload, try reloading the page.',
                'card_id.required'         => 'Invalid payload, try reloading the page.',
                'card_billing_id.required' => 'Invalid payload, try reloading the page.',
                'email.required'           => 'Invalid payload, try reloading the page.',
            ]);
        }
        catch (ValidationException $e){
            return response()->json([
                'error'=>$e->validator->errors()->first(),
                'status'=>false,
                'code'=>422
            ],422);
        }

        $bookingId = decode($request->input('booking_id'));
        $booking = TravelBooking::findOrFail($bookingId);

        $booking_id = decode($request->booking_id);
        $card_id = decode($request->card_id);
        $card_billing_id = decode($request->card_billing_id);
        $refund_status = str_replace('-','_',$request->refund_status);

        // Fetch all data required for the PDF view
        $billingPricingDataAll = TravelBillingDetail::where('booking_id', $bookingId)->get();
        $billingPricingData = TravelBillingDetail::where('id',$card_billing_id)->first();
        $booking_status = $booking->booking_status;
        $payment_status = $booking->payment_status;
        $campaigns = Campaign::where('status',1)->get();
        $car_images = CarImages::where('booking_id', $booking->id)->get();
        $cruise_images = CruiseImages::where('booking_id', $booking->id)->get();
        $flight_images = FlightImages::where('booking_id', $booking->id)->get();
        $hotel_images = HotelImages::where('booking_id', $booking->id)->get();
        $screenshot_images = ScreenshotImages::where('booking_id', $booking->id)->get();
        $train_images = TrainImages::where('booking_id', $booking->id)->get();
        $travel_cruise_data = TravelCruise::where('booking_id', $booking->id)->first();
        $travel_cruise_addon = TravelCruiseAddon::where('booking_id',$booking->id)->get();
        $users = User::get();

        $buttonRoute = route('i_authorized',['booking_id'=>encode($booking_id),'card_id'=>encode($card_id),'card_billing_id'=>encode($card_billing_id),'refund_status'=>$refund_status]);
        $emailSendTo = $request->email;

        // Generate PDF using SignatureController
        $signatureController = new \App\Http\Controllers\SignatureController();
        $pdfResponse = $signatureController->pdf(
            encode($booking_id),
            encode($card_id),
            encode($card_billing_id),
            'YBvpr6pl'
        );
        
        // Save PDF to temporary file
        $fileName = 'authorization-' . $booking_id . '.pdf';
        $fullPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $fileName;
        file_put_contents($fullPath, $pdfResponse->getContent());
        
        try {

            // Mail Response

            try {
                    $recipientFetch = TravelBillingDetail::select('cc_holder_name')->where('id', $card_billing_id)->first();
                    $recipientName = $recipientFetch->cc_holder_name;
                    $zohoSignService = new ZohoSignService();
                    $response = $zohoSignService->createDocument(
                        $recipientName,
                        $request->email,
                        $recipientName,
                        $fullPath,
                        'Please review and sign this document'
                    );
                    // dd($recipientName,$request->email);
                    // Mail::to($emailSendTo)->send(new AuthEmail($bookingId, $buttonRoute));
                    AuthHistory::create([
                        'booking_id' => $bookingId,
                        'card_id' => $card_id,
                        'card_billing_id' => $card_billing_id,
                        'refund_status' => $refund_status,
                        'user_id' => auth()->id(),
                        'action' => 'Email sent for auth',
                        'type' => 'Email',
                        'sent_to' => $emailSendTo,
                        'details' => 'Booking confirmation email sent to customer.'
                    ]);
                    return response()->json([
                        'message' => 'Email sent successfully',
                        'status' => true,
                        'code' => 200
                    ], 200);

                    TravelBooking::where('id', $bookingId)->update(['booking_status_id' => 2]);

                } catch (Swift_TransportException $e) {
                    $errorMessage = $e->getMessage();
                    $error = strpos($errorMessage, '554 Message rejected: Email address is not verified') !== false
                        ? 'The sender email address is not verified in Amazon SES. Please verify it in the AWS SES console.'
                        : 'Failed to send email: ' . $errorMessage;

                    return response()->json([
                        'error' => $error,
                        'status' => false,
                        'code' => 422
                    ], 422);
                } catch (\Exception $e) {
                    return response()->json([
                        'error' => 'An unexpected error occurred: ' . $e,
                        'status' => false,
                        'code' => 500
                    ], 500);
                }


//            Mail::to($emailSendTo)->send(new AuthEmail($bookingId,$buttonRoute));


            return response()->json(['message' => 'Auth Email sent successfully.'], 201);

        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'details' => $e->getMessage()], 500);
        }
    }
}
