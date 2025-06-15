<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\StoreTravelSectorDetailRequest;
use App\Http\Requests\Travel\UpdateTravelSectorDetailRequest;
use App\Models\TravelSectorDetail;
use Illuminate\Http\JsonResponse;

class TravelSectorDetailController extends Controller
{
    public function add(StoreTravelSectorDetailRequest $request): JsonResponse
    {
        try {
            $sectorDetail = TravelSectorDetail::create($request->validated());
            return response()->json(['message' => 'Sector detail created successfully', 'data' => $sectorDetail], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating sector detail', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateTravelSectorDetailRequest $request, $id): JsonResponse
    {
        try {
            $sectorDetail = TravelSectorDetail::findOrFail($id);
            $sectorDetail->update($request->validated());
            return response()->json(['message' => 'Sector detail updated successfully', 'data' => $sectorDetail], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating sector detail', 'error' => $e->getMessage()], 500);
        }
    }
}