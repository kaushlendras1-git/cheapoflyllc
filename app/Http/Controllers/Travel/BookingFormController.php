<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\StoreTravelBookingRequest;
use App\Http\Requests\Travel\StoreTravelBookingTypeRequest;
use App\Http\Requests\Travel\StoreTravelSectorDetailRequest;
use App\Http\Requests\Travel\StoreTravelPassengerRequest;
use App\Http\Requests\Travel\StoreTravelBillingDetailRequest;
use App\Http\Requests\Travel\StoreTravelPricingDetailRequest;
use App\Http\Requests\Travel\StoreTravelBookingRemarkRequest;
use App\Http\Requests\Travel\StoreTravelQualityFeedbackRequest;
use App\Http\Requests\Travel\StoreTravelScreenshotRequest;
use App\Models\TravelBooking;
use App\Models\TravelBookingType;
use App\Models\TravelSectorDetail;
use App\Models\TravelPassenger;
use App\Models\TravelBillingDetail;
use App\Models\TravelPricingDetail;
use App\Models\TravelBookingRemark;
use App\Models\TravelQualityFeedback;
use App\Models\TravelScreenshot;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BookingFormController extends Controller
{
    public function store(
        StoreTravelBookingRequest $bookingRequest,
        StoreTravelBookingTypeRequest $bookingTypeRequest,
        StoreTravelSectorDetailRequest $sectorRequest,
        StoreTravelPassengerRequest $passengerRequest,
        StoreTravelBillingDetailRequest $billingRequest,
        StoreTravelPricingDetailRequest $pricingRequest,
        StoreTravelBookingRemarkRequest $remarkRequest,
        StoreTravelQualityFeedbackRequest $feedbackRequest,
        StoreTravelScreenshotRequest $screenshotRequest
    ): JsonResponse {
        try {
            DB::beginTransaction();

            // Create Travel Booking
            $bookingData = $bookingRequest->validated();
            $bookingData['created_by'] = 'Testagent'; // Set dynamically based on auth user
            $booking = TravelBooking::create($bookingData);

            // Create Booking Types
            foreach ($bookingTypeRequest->validated()['types'] as $type) {
                TravelBookingType::create([
                    'booking_id' => $booking->id,
                    'type' => $type,
                ]);
            }

            // Create Sector Detail
            TravelSectorDetail::create([
                'booking_id' => $booking->id,
                'sector_type' => $sectorRequest->validated()['sector_type'],
            ]);

            // Create Passengers
            foreach ($passengerRequest->validated() as $passengerData) {
                $passengerData['booking_id'] = $booking->id;
                TravelPassenger::create($passengerData);
            }

            // Create Billing Details
            foreach ($billingRequest->validated() as $billingData) {
                $billingData['booking_id'] = $booking->id;
                TravelBillingDetail::create($billingData);
            }

            // Create Pricing Detail
            $pricingData = $pricingRequest->validated();
            $pricingData['booking_id'] = $booking->id;
            TravelPricingDetail::create($pricingData);

            // Create Booking Remark (if provided)
            if ($remarkRequest->has('particulars')) {
                TravelBookingRemark::create([
                    'booking_id' => $booking->id,
                    'agent' => $remarkRequest->validated()['agent'] ?? 'Testagent',
                    'date_time' => $remarkRequest->validated()['date_time'] ?? now(),
                    'particulars' => $remarkRequest->validated()['particulars'],
                ]);
            }

            // Create Quality Feedback (if provided)
            if ($feedbackRequest->has('feedback')) {
                $feedbackData = $feedbackRequest->validated();
                $feedbackData['booking_id'] = $booking->id;
                $feedbackData['qa'] = $feedbackData['qa'] ?? 'Test QA';
                $feedbackData['date_time'] = $feedbackData['date_time'] ?? now();
                TravelQualityFeedback::create($feedbackData);
            }

            // Create Screenshot (if provided)
            if ($screenshotRequest->has('type')) {
                $screenshotData = $screenshotRequest->validated();
                $screenshotData['booking_id'] = $booking->id;
                TravelScreenshot::create($screenshotData);
            }

            DB::commit();
            return response()->json(['message' => 'Booking form submitted successfully', 'booking_id' => $booking->id], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error submitting booking form', 'error' => $e->getMessage()], 500);
        }
    }
}