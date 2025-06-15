<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\StoreTravelPassengerRequest;
use App\Http\Requests\Travel\UpdateTravelPassengerRequest;
use App\Models\TravelPassenger;
use Illuminate\Http\JsonResponse;

class TravelPassengerController extends Controller
{
    public function add(StoreTravelPassengerRequest $request): JsonResponse
    {
        try {
            $passenger = TravelPassenger::create($request->validated());
            return response()->json(['message' => 'Passenger created successfully', 'data' => $passenger], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating passenger', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateTravelPassengerRequest $request, $id): JsonResponse
    {
        try {
            $passenger = TravelPassenger::findOrFail($id);
            $passenger->update($request->validated());
            return response()->json(['message' => 'Passenger updated successfully', 'data' => $passenger], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating passenger', 'error' => $e->getMessage()], 500);
        }
    }
}