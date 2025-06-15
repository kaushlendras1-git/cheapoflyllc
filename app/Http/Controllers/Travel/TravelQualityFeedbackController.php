<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\StoreTravelQualityFeedbackRequest;
use App\Http\Requests\Travel\UpdateTravelQualityFeedbackRequest;
use App\Models\TravelQualityFeedback;
use Illuminate\Http\JsonResponse;

class TravelQualityFeedbackController extends Controller
{
    public function add(StoreTravelQualityFeedbackRequest $request): JsonResponse
    {
        try {
            $feedback = TravelQualityFeedback::create($request->validated());
            return response()->json(['message' => 'Quality feedback created successfully', 'data' => $feedback], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating quality feedback', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateTravelQualityFeedbackRequest $request, $id): JsonResponse
    {
        try {
            $feedback = TravelQualityFeedback::findOrFail($id);
            $feedback->update($request->validated());
            return response()->json(['message' => 'Quality feedback updated successfully', 'data' => $feedback], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating quality feedback', 'error' => $e->getMessage()], 500);
        }
    }
}