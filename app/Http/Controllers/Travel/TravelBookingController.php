<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\StoreTravelBookingRequest;
use App\Http\Requests\Travel\UpdateTravelBookingRequest;
use App\Models\TravelBooking;
use Illuminate\Http\JsonResponse;

class TravelBookingController extends Controller
{
    public function add(StoreTravelBookingRequest $request): JsonResponse
    {
        try {
            $booking = TravelBooking::create($request->validated());
            return response()->json(['message' => 'Booking created successfully', 'data' => $booking], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating booking', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateTravelBookingRequest $request, $id): JsonResponse
    {
        try {
            $booking = TravelBooking::findOrFail($id);
            $booking->update($request->validated());
            return response()->json(['message' => 'Booking updated successfully', 'data' => $booking], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating booking', 'error' => $e->getMessage()], 500);
        }
    }
}