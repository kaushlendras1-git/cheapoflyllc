<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\FirebaseService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendNotification(Request $request, FirebaseService $firebaseService)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $recipient = User::find($request->user_id);

        if (!$recipient->device_token) {
            return response()->json(['message' => 'Recipient does not have a device token.'], 400);
        }

        $response = $firebaseService->sendNotification(
            $recipient->device_token,
            $request->title,
            $request->body,
            ['additional_data' => 'value']
        );

        return response()->json(['message' => 'Notification sent successfully.', 'response' => $response]);
    }

    public function updateDeviceToken(Request $request)
    {
        $request->validate(['device_token' => 'required|string']);

        $user = auth()->user(); // Or fetch the user by ID
        $user->update(['device_token' => $request->device_token]);

        return response()->json(['message' => 'Device token updated successfully.']);
    }
}
