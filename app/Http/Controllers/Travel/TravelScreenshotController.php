<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\StoreTravelScreenshotRequest;
use App\Http\Requests\Travel\UpdateTravelScreenshotRequest;
use App\Models\TravelScreenshot;
use Illuminate\Http\JsonResponse;

class TravelScreenshotController extends Controller
{
    public function add(StoreTravelScreenshotRequest $request): JsonResponse
    {
        try {
            $screenshot = TravelScreenshot::create($request->validated());
            return response()->json(['message' => 'Screenshot created successfully', 'data' => $screenshot], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating screenshot', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateTravelScreenshotRequest $request, $id): JsonResponse
    {
        try {
            $screenshot = TravelScreenshot::findOrFail($id);
            $screenshot->update($request->validated());
            return response()->json(['message' => 'Screenshot updated successfully', 'data' => $screenshot], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating screenshot', 'error' => $e->getMessage()], 500);
        }
    }
}