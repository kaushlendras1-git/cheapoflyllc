<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\StoreTravelBookingTypeRequest;
use App\Http\Requests\Travel\UpdateTravelBookingTypeRequest;
use App\Models\TravelBookingType;
use Illuminate\Http\JsonResponse;

class TravelBookingTypeController extends Controller
{
    public function add(StoreTravelBookingTypeRequest $request): JsonResponse
    {
        try {
            $bookingType = TravelBookingType::create($request->validated());
            return response()->json(['message' => 'Booking type created successfully', 'data' => $bookingType], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating booking type', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateTravelBookingTypeRequest $request, $id): JsonResponse
    {
        try {
            $bookingType = TravelBookingType::findOrFail($id);
            $bookingType->update($request->validated());
            return response()->json(['message' => 'Booking type updated successfully', 'data' => $bookingType], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating booking type', 'error' => $e->getMessage()], 500);
        }
    }
}