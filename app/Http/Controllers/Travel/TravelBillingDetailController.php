<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\StoreTravelBillingDetailRequest;
use App\Http\Requests\Travel\UpdateTravelBillingDetailRequest;
use App\Models\TravelBillingDetail;
use Illuminate\Http\JsonResponse;

class TravelBillingDetailController extends Controller
{
    public function add(StoreTravelBillingDetailRequest $request): JsonResponse
    {
        try {
            $billingDetail = TravelBillingDetail::create($request->validated());
            return response()->json(['message' => 'Billing detail created successfully', 'data' => $billingDetail], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating billing detail', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateTravelBillingDetailRequest $request, $id): JsonResponse
    {
        try {
            $billingDetail = TravelBillingDetail::findOrFail($id);
            $billingDetail->update($request->validated());
            return response()->json(['message' => 'Billing detail updated successfully', 'data' => $billingDetail], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating billing detail', 'error' => $e->getMessage()], 500);
        }
    }
}