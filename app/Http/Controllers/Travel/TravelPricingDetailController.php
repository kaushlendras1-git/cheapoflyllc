<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\StoreTravelPricingDetailRequest;
use App\Http\Requests\Travel\UpdateTravelPricingDetailRequest;
use App\Models\TravelPricingDetail;
use Illuminate\Http\JsonResponse;

class TravelPricingDetailController extends Controller
{
    public function add(StoreTravelPricingDetailRequest $request): JsonResponse
    {
        try {
            $pricingDetail = TravelPricingDetail::create($request->validated());
            return response()->json(['message' => 'Pricing detail created successfully', 'data' => $pricingDetail], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating pricing detail', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateTravelPricingDetailRequest $request, $id): JsonResponse
    {
        try {
            $pricingDetail = TravelPricingDetail::findOrFail($id);
            $pricingDetail->update($request->validated());
            return response()->json(['message' => 'Pricing detail updated successfully', 'data' => $pricingDetail], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating pricing detail', 'error' => $e->getMessage()], 500);
        }
    }
}