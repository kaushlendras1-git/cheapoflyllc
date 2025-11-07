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
                'auth_type'=>'required',
                'booking_id'=>'required',
                'card_id'=>'required',
                'card_billing_id'=>'required',
                'email'=>'required'
            ],[
                'refund_status.required' => 'Please select a refund status.',
                'auth_type.required' => 'Please select an authorization send option.',
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

        $card_id = $request->card_id;
        $card_billing_id = $request->card_billing_id;
        $booking = TravelBooking::findOrFail($request->booking_id);
        $refund_status = $request->refund_status;

        // Fetch all data required for the PDF view
        $billingPricingDataAll = TravelBillingDetail::where('booking_id', $booking->id)->get();
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

        $buttonRoute = route('i_authorized',['booking_id'=>encode($booking->id),'card_id'=>encode($card_id),'card_billing_id'=>encode($card_billing_id),'refund_status'=>$refund_status]);
        $emailSendTo = $request->email;

        TravelBooking::where('id', $booking->id)->update([
                        'auth_type' => $request->auth_type,
                        'refund_status' => $request->refund_status
                    ]);


        // Generate PDF using SignatureController
        $signatureController = new \App\Http\Controllers\SignatureController();
        $pdfResponse = $signatureController->pdf(
            encode($booking->id),
            encode($card_id),
            encode($card_billing_id),
            encode($refund_status)
        );
        
        // Save PDF to temporary file
        $fileName = 'authorization-for-' . decode($booking->id) . '.pdf';
        $fullPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $fileName;
        file_put_contents($fullPath, $pdfResponse->getContent());
          $bookingTypeName = \App\Models\BookingType::find($booking->query_type)?->name ?? 'Booking';
        
        try {

            // Mail Response

            try {
                    $recipientFetch = TravelBillingDetail::select('cc_holder_name')->where('id', $card_billing_id)->first();
                    $recipientName = $bookingTypeName;
                    $zohoSignService = new ZohoSignService();
                    
                    ##$requestId = "1234567890";
                    // Create document

                   
                    
                    // Get billing details
                    $billingDetail = \App\Models\BillingDetail::where('id', $card_id)
                        ->select('contact_number', 'country')
                        ->first();
                    
                    // Get country code
                    $country = \App\Models\Country::where('id', $billingDetail->country ?? 0)
                        ->select('country_code')
                        ->first();

                    $delivery_mode = $request->auth_type;
                    $recipient_countrycode_iso = strtoupper($country->country_code ?? 'US');
                    $recipient_phonenumber = $billingDetail->contact_number ?? '';
                    

                    $response = $zohoSignService->createDocument(
                        $recipientName,
                        $request->email,
                        $recipientName,
                        $fullPath,
                        'New Flight Booking with Credit2',
                        $delivery_mode,
                        $recipient_countrycode_iso,
                        $recipient_phonenumber
                    );
                    
                    // Submit document for signature if creation was successful
                    if (isset($response['requests']['request_id'])) {
                        $requestId = $response['requests']['request_id'];
                        $actionId = $response['requests']['actions'][0]['action_id'] ?? null;
                        $documentId = $response['requests']['document_ids'][0]['document_id'] ?? null;
                        
                        if ($actionId && $documentId) {
                            $submitResponse = $zohoSignService->submitDocument($requestId, $actionId, $documentId,[], ucfirst(auth()->user()->name) . ' has requested you to review the document');
                            
                            if (!isset($submitResponse['status']) || $submitResponse['status'] !== 'success') {
                                throw new \Exception('Failed to submit document for signature');
                            }
                        } else {
                            throw new \Exception('Missing action_id or document_id in response');
                        }
                    } else {
                        throw new \Exception('Failed to create document');
                    }
                    
                    if (file_exists($fullPath)) {
                        unlink($fullPath);
                    }
                    
                    AuthHistory::create([
                        'booking_id' => $booking->id,
                        'card_id' => $card_id,
                        'card_billing_id' => $card_billing_id,
                        'refund_status' => $refund_status,
                        'user_id' => auth()->id(),
                        'action' => 'Document sent for signature',
                        'type' => 'ZohoSign',
                        'sent_to' => $emailSendTo,
                        'zoho_document_id' => $requestId,
                        'details' => 'sent via Zoho Sign. Request ID: ' . $requestId
                    ]);
                    
                    
                    
                    return response()->json([
                        'message' => 'Document sent for signature successfully',
                        'status' => true,
                        'code' => 200
                    ], 200);

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


          #  Mail::to($emailSendTo)->send(new AuthEmail($booking->id,$buttonRoute));


            return response()->json(['message' => 'Auth Email sent successfully.'], 201);

        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'details' => $e->getMessage()], 500);
        }
    }
}
