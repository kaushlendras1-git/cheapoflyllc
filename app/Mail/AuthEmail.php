<?php

namespace App\Mail;

use App\Models\TravelBooking;
use App\Models\BookingStatus;
use App\Models\PaymentStatus;
use App\Models\Campaign;
use App\Models\BillingDetail;
use App\Models\BookingType;
use App\Models\CarImages;
use App\Models\CruiseImages;
use App\Models\FlightImages;
use App\Models\HotelImages;
use App\Models\ScreenshotImages;
use App\Models\TrainImages;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class AuthEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $buttonRoute;
    public $billingPricingData;
    public $bookingStatus;
    public $paymentStatus;
    public $campaigns;
    public $billingData;
    public $carImages;
    public $cruiseImages;
    public $flight_images;
    public $hotelImages;
    public $screenshotImages;
    public $trainImages;
    public $users;

    /**
     * Create a new message instance.
     */
    public function __construct(int $bookingId, string $buttonRoute)
    {
        $this->buttonRoute = $buttonRoute;

        // Fetch booking with relationships
        $this->booking = TravelBooking::with([
            'bookingTypes',
            'sectorDetails',
            'passengers',
            'billingDetails',
            'pricingDetails',
            'trainBookingDetails',
            'screenshots',
            'travelFlight' => fn($query) => $query->withTrashed(),
            'travelCar',
            'travelCruise',
            'travelHotel',
        ])->findOrFail($bookingId);

        // Fetch billing pricing data
        $this->billingPricingData = DB::table('travel_billing_details as b')
            ->join('billing_details as p', 'b.state', '=', 'p.id')
            ->where('b.booking_id', $this->booking->id)
            ->select(
                'b.id as billing_id', 'b.card_type', 'b.cc_number', 'b.cc_holder_name', 
                'b.exp_month', 'b.exp_year', 'b.cvv', 'b.authorized_amt',
                'p.email', 'p.contact_number', 'p.street_address', 'p.city', 
                'p.state', 'p.zip_code', 'p.country'
            )
            ->first();

        // Fetch additional data
        $this->bookingStatus = BookingStatus::where('status', 1)->get();
        $this->paymentStatus = PaymentStatus::where('status', 1)->get();
        $this->campaigns = Campaign::where('status', 1)->get();
        $this->billingData = BillingDetail::where('booking_id', $this->booking->id)->get();
        $this->carImages = CarImages::where('booking_id', $this->booking->id)->get();
        $this->cruiseImages = CruiseImages::where('booking_id', $this->booking->id)->get();
        $this->flight_images = FlightImages::where('booking_id', $this->booking->id)->get();
        $this->hotelImages = HotelImages::where('booking_id', $this->booking->id)->get();
        $this->screenshotImages = ScreenshotImages::where('booking_id', $this->booking->id)->get();
        $this->trainImages = TrainImages::where('booking_id', $this->booking->id)->get();
        $this->users = User::get();
        $this->bookingType = BookingType::where('id',$this->booking->query_type)->first();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Credit Card Authorization - '.$this->bookingType->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'AuthEmails.auth',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}