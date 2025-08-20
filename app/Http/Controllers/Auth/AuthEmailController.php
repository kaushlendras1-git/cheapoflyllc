<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TravelBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuthEmail;
use App\Utils\JsonResponse;
use App\Models\AuthHistory;

class AuthEmailController extends Controller
{

   public function index(Request $request)
    {
        
       # dd($request->all());

        $bookingId = $request->input('booking_id');
        $booking = TravelBooking::findOrFail($bookingId);
      
        $booking_id = $request->booking_id;
        $card_id = $request->card_id;
        $card_billing_id = $request->card_billing_id;
        //  $refund_status = $request->refund_status ?? 1;
        $refund_status = 1;
        $buttonRoute = route('i_authorized',['booking_id'=>encode($booking_id),'card_id'=>encode($card_id),'card_billing_id'=>encode($card_billing_id),'refund_status'=>encode($refund_status)]);
        $emailSendTo = $request->email;
      
        try {
            Mail::to($emailSendTo)->send(new AuthEmail($bookingId,$buttonRoute));

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

            return response()->json(['message' => 'Auth Email sent successfully.'], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'details' => $e->getMessage()], 500);
        }
    }
}