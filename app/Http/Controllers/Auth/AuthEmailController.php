<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TravelBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuthEmail;
use App\Utils\JsonResponse;
use App\Models\AuthHistory;
use Illuminate\Validation\ValidationException;

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

//        $refund_status = 1;
        $buttonRoute = route('i_authorized',['booking_id'=>encode($booking_id),'card_id'=>encode($card_id),'card_billing_id'=>encode($card_billing_id),'refund_status'=>$refund_status]);
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

        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'details' => $e->getMessage()], 500);
        }
    }
}
