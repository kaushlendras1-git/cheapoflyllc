<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TravelBooking;
use Illuminate\Support\Facades\Auth;

class OnlineBookingController extends Controller
{
     public function index(Request $request)
    {
        $query = TravelBooking::with(['user', 'pricingDetails', 'bookingStatus', 'paymentStatus']);
        $userId = Auth::id();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('pnr', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhereDate('created_at', $search) // for Booking Date (exact)
                ->orWhereHas('user', function ($uq) use ($search) {
                    $uq->where('name', 'like', "%{$search}%"); // Agent name
                })
                ->orWhereHas('pricingDetails', function ($pq) use ($search) {
                    $pq->where('total_amount', 'like', "%{$search}%")
                        ->orWhere('advisor_mco', 'like', "%{$search}%");
                });
            });
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(10);
        $bookings->appends($request->only('search'));
        $hashids = new \Hashids\Hashids(config('hashids.salt'), config('hashids.length', 8));

        $flight_booking = TravelBooking::where('user_id', $userId)->where('airlinepnr','!=', NULL)->count();
        $hotel_booking = TravelBooking::where('user_id', $userId)->where('hotel_ref','!=', NULL)->count();
        $cruise_booking = TravelBooking::where('user_id', $userId)->where('cruise_ref','!=', NULL)->count();
        $car_booking = TravelBooking::where('user_id', $userId)->where('car_ref','!=', NULL)->count();
        $train_booking = 0;
        $pending_booking = TravelBooking::where('user_id', $userId)->where('booking_status_id',1)->count();
        return view('web.online-booking.index', compact('bookings', 'hashids','flight_booking','hotel_booking','cruise_booking','car_booking','train_booking','pending_booking'));
    }
}
