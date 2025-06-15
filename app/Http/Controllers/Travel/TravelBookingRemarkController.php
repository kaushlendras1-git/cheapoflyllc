<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\StoreTravelBookingRemarkRequest;
use App\Http\Requests\Travel\UpdateTravelBookingRemarkRequest;
use App\Models\TravelBookingRemark;
use Illuminate\Http\JsonResponse;

class TravelBookingRemarkController extends Controller
{
    public function add(StoreTravelBookingRemarkRequest $request): JsonResponse
    {
        try {
            $remark = TravelBookingRemark::create($request->validated());
            return response()->json(['message' => 'Booking remark created successfully', 'data' => $remark], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating booking remark', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateTravelBookingRemarkRequest $request, $id): JsonResponse
    {
        try {
            $remark = TravelBookingRemark::findOrFail($id);
            $remark->update($request->validated());
            return response()->json(['message' => 'Booking remark updated successfully', 'data' => $remark], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating booking remark', 'error' => $e->getMessage()], 500);
        }
    }
}