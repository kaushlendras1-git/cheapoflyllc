<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TravelBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuthEmail;
use App\Utils\JsonResponse;
use Hashids\Hashids;
use App\Models\AuthHistory;

class AuthEmailController extends Controller
{
    protected $hashids;
    public function __construct()
    {
        $this->hashids = new Hashids(config('hashids.salt'), config('hashids.length', 8));
    }

   public function index(Request $request)
    {
        $bookingId = $request->input('id');
        $booking = TravelBooking::findOrFail($bookingId);
        $emails = $request->input('auth_email', []);
        $cards = $request->input('cards', []);
        $billingDetailsIds = $request->input('billing_details_ids', []);
        $travelBillingDetailsIds = $request->input('travel_billing_details_ids', []);

        $booking_id = $request->booking_id;
        $card_id = $request->card_id;
        $card_billing_id = $request->card_billing_id;
        $refund_status = $request->refund_status;
        $buttonRoute = route('i_authorized',['booking_id'=>encode($booking_id),'card_id'=>encode($card_id),'card_billing_id'=>encode($card_billing_id),'refund_status'=>encode($refund_status)]);
        $emailSendTo = $request->email;
        try {
            Mail::to($emailSendTo)->send(new AuthEmail($booking,$buttonRoute));

            //    dd($request->all());
            //    $cardLastDigit = $cards[$index] ?? null;
            //    $billingDetailsId = $billingDetailsIds[$index] ?? null;
            //    $travelBillingDetailsId = $travelBillingDetailsIds[$index] ?? null;
            //    Mail::to($email)->send(new AuthEmail($booking,$buttonRoute));

            //    AuthHistory::create([
            //        'booking_id' => $bookingId,
            //        'billing_details_id' => $billingDetailsId,
            //        'travel_billing_details_id' => $travelBillingDetailsId,
            //        'user_id' => auth()->id(),
            //        'action' => 'Email sent for auth',
            //        'card_last_digit' => $cardLastDigit,
            //        'type' => 'Email',
            //        'sent_to' => $email,
            //        'details' => 'Booking confirmation email sent to customer.'
            //    ]);

            return response()->json(['message' => 'Auth Email sent successfully.'], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'details' => $e->getMessage()], 500);
        }
    }
}
