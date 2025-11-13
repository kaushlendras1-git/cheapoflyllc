<?php

namespace App\Http\Controllers;

use App\Models\TravelChange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Utils\JsonResponse;
use Illuminate\Validation\ValidationException;

class TravelChangeController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'booking_id' => 'required|exists:travel_bookings,id',
                'amount' => 'nullable|numeric',
                'description' => 'required|string',
                'remarks' => 'nullable|string',
                'progress_status' => 'required|string'
            ]);

            $validated['attempted_by'] = Auth::id();
            
            // Debug log
            \Log::info('Creating change with data:', $validated);

            $change = TravelChange::create($validated);
            $change->load('user');

            return response()->json([
                'status' => 'success',
                'message' => 'Changes updated successfully',
                'code' => 201,
                'change' => $change
            ], 201);
        }
        catch(ValidationException $e){
            return JsonResponse::error($e->validator->errors()->first(), 422, '422');
        }
    }

    public function getByBooking($bookingId)
    {
        $changes = TravelChange::with('user')
            ->where('booking_id', $bookingId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['changes' => $changes]);
    }
    
    public function show($id)
    {
        $change = TravelChange::with('user')->findOrFail($id);
        return response()->json(['change' => $change]);
    }
    
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'amount' => 'nullable|numeric',
                'description' => 'required|string',
                'remarks' => 'nullable|string',
                'progress_status' => 'required|string'
            ]);

            $change = TravelChange::findOrFail($id);
            $change->update($validated);
            $change->load('user');

            return response()->json([
                'status' => 'success',
                'message' => 'Change updated successfully',
                'change' => $change
            ]);
        }
        catch(ValidationException $e){
            return JsonResponse::error($e->validator->errors()->first(), 422, '422');
        }
    }
    
    public function destroy($id)
    {
        $change = TravelChange::findOrFail($id);
        $change->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Change deleted successfully'
        ]);
    }
}