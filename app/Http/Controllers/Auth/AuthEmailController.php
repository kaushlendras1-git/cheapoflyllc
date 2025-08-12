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
        $id = $request->input('id');
        $id = $this->hashids->decode($id);
        $id = $id[0] ?? null;

        $emails = $request->input('auth_email', []);
        

        if (in_array('all', $emails)) {
            // Optional: Replace with real logic to fetch all authorized emails
            $emails = [
                'credentials@cheapoflytravel.com',
                'other@example.com',
            ];
        }

        $booking = TravelBooking::findOrFail($id);

        try {
            foreach ($emails as $email) {
                Mail::to($email)->send(new AuthEmail($booking));

                	AuthHistory::create([
                        'booking_id' => 123, // example booking ID
                        'billing_details_id' => 45, // example billing details ID
                        'travel_billing_details_id' => 67, // example travel billing details ID
                        'user_id' => auth()->id(), // current logged-in user
                        'action' => 'Created', // e.g. Created, Updated, Deleted
                        'type' => 'Email', // e.g. Email, SMS, Notification
                        'sent_to' => 'customer@example.com', // email/phone of recipient
                        'details' => 'Booking confirmation email sent to customer.'
                    ]);

            }

            return response()->json(['message' => 'Auth Email sent successfully.'], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
