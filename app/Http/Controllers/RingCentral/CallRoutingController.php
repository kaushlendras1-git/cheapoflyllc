<?php

namespace App\Http\Controllers\RingCentral;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CallRoutingController extends Controller
{
    /**
     * Get user by extension for incoming call routing
     */
    public function getUserByExtension($extension)
    {
        try {
            $user = User::where('extension', $extension)->first();
            
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No user found for extension: ' . $extension
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'User found for extension',
                'data' => [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'extension' => $user->extension,
                    'department' => $user->departmentRelation->name ?? null,
                    'role' => $user->roleRelation->name ?? null
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Call Routing Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Get all users with extensions for call routing
     */
    public function getAllExtensions()
    {
        try {
            $users = User::whereNotNull('extension')
                ->with(['departmentRelation', 'roleRelation'])
                ->get()
                ->map(function($user) {
                    return [
                        'user_id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'extension' => $user->extension,
                        'department' => $user->departmentRelation->name ?? null,
                        'role' => $user->roleRelation->name ?? null
                    ];
                });

            return response()->json([
                'status' => 'success',
                'message' => 'Extensions fetched successfully',
                'data' => $users
            ]);
        } catch (\Exception $e) {
            Log::error('Extensions Fetch Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Webhook endpoint for RingCentral incoming calls
     */
    public function incomingCallWebhook(Request $request)
    {
        try {
            $callData = $request->all();
            Log::info('Incoming Call Webhook Data: ', $callData);

            // Extract extension from call data
            $toExtension = $callData['body']['to']['extensionNumber'] ?? null;
            
            if (!$toExtension) {
                return response()->json(['status' => 'error', 'message' => 'No extension found in call data']);
            }

            // Find user by extension
            $user = User::where('extension', $toExtension)->first();
            
            if ($user) {
                // Here you can implement notification logic
                // For example: send real-time notification to the user
                Log::info("Incoming call for user: {$user->name} (Extension: {$toExtension})");
                
                // You could broadcast an event here for real-time notifications
                // broadcast(new IncomingCallEvent($user, $callData));
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Webhook processed',
                'user' => $user ? $user->name : 'Unknown',
                'extension' => $toExtension
            ]);
        } catch (\Exception $e) {
            Log::error('Incoming Call Webhook Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}