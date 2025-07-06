<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelBooking;

class MailHistoryController extends Controller
{
    public function mailHistory($id) {
         return view('web.mail-history.index');
    }

    public function sendSms($id) {
        // Load SMS view or trigger SMS sending
    }

    public function sendWhatsApp($id) {
        $booking = TravelBooking::findOrFail($id);
        $phone = preg_replace('/[^0-9]/', '', $booking->phone);
        $message = urlencode("Hi {$booking->name}, your booking is confirmed.");
        return redirect("https://wa.me/{$phone}?text={$message}");
    }

}
