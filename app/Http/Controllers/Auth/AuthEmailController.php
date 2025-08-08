<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TravelBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuthEmail;
use App\Utils\JsonResponse;


class AuthEmailController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->input('id');
        $emails = $request->input('auth_email', []); // This will be an array

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
            }

            return response()->json(['message' => 'Auth Email sent successfully.'], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
