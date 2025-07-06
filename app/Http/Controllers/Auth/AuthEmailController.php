<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TravelBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuthEmail;

class AuthEmailController extends Controller
{
    public function index(Request $request, $id)
    {
        $booking = TravelBooking::findOrFail($id);
        Mail::to($booking->email)->send(new AuthEmail($booking));
        return redirect()->back()->with('success', 'Authorization email sent successfully');
    }
}
