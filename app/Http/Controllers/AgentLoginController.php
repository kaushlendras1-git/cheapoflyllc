<?php

namespace App\Http\Controllers;

use App\Models\AgentLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Services\FirebaseService;

class AgentLoginController extends Controller
{
    public function requestLogin(Request $request)
    {
        try {
            $request->validate(['email' => 'required|string']);
            
            $loginField = $request->input('email');
            $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'pseudo';
            
            $user = User::where($fieldType, $loginField)->first();
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
            
            AgentLoginRequest::where('user_id', $user->id)
                ->where('status', 'pending')
                ->update(['status' => 'expired']);

            $loginRequest = AgentLoginRequest::create([
                'user_id' => $user->id,
                'status' => 'pending',
                'requested_at' => now(),
                'expired_at' => now()->addMinutes(10)
            ]);
            
            $this->notifyAdmins($user);
            
            return response()->json([
                'success' => true,
                'request_id' => $loginRequest->id,
                'expires_at' => $loginRequest->expired_at
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function checkRequestStatus($email)
    {
        $fieldType = filter_var($email, FILTER_VALIDATE_EMAIL) ? 'email' : 'pseudo';
        $user = User::where($fieldType, $email)->first();
        if (!$user) {
            return response()->json(['status' => 'none']);
        }
        
        // Force cleanup ALL old pending requests
        AgentLoginRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->where('created_at', '<', now()->subMinutes(15))
            ->update(['status' => 'expired']);
        
        // Get the most recent request regardless of status
        $loginRequest = AgentLoginRequest::where('user_id', $user->id)
            ->orderBy('requested_at', 'desc')
            ->first();

        if (!$loginRequest) {
            return response()->json(['status' => 'none']);
        }

        // Check if current request is expired
        if ($loginRequest->status === 'pending' && $loginRequest->expired_at < now()) {
            $loginRequest->update(['status' => 'expired']);
            return response()->json(['status' => 'expired']);
        }

        return response()->json([
            'status' => $loginRequest->status,
            'request_id' => $loginRequest->id,
            'expires_at' => $loginRequest->expired_at
        ]);
    }

    public function approveRequest(Request $request, $id)
    {
        $loginRequest = AgentLoginRequest::findOrFail($id);
        
        if ($loginRequest->status !== 'pending') {
            return response()->json(['error' => 'Request is not pending'], 400);
        }

        if ($loginRequest->expired_at < now()) {
            $loginRequest->update(['status' => 'expired']);
            return response()->json(['error' => 'Request has expired'], 400);
        }

        $action = $request->input('action'); // 'approve' or 'reject'
        
        $loginRequest->update([
            'status' => $action === 'approve' ? 'approved' : 'rejected',
            'approved_at' => now(),
            'approved_by' => Auth::id()
        ]);

        return response()->json(['success' => true, 'status' => $loginRequest->status]);
    }



    public function autoLogin($id)
    {
        $loginRequest = AgentLoginRequest::findOrFail($id);
        
        if ($loginRequest->status !== 'approved') {
            return redirect()->route('login')->with('error', 'Invalid login request');
        }

        Auth::login($loginRequest->user);
        
        return redirect()->route('user.dashboard');
    }

    public function getPendingRequests()
    {
        $requests = AgentLoginRequest::with('user')
            ->where('status', 'pending')
            ->where('expired_at', '>', now())
            ->orderBy('requested_at', 'desc')
            ->get();

        return response()->json($requests);
    }

    private function notifyAdmins($requestingUser)
    {
        $admins = User::where('department_id', '1')
            ->where('status', '1')
            ->get();

        foreach ($admins as $admin) {
            $this->sendBrowserNotification($admin, $requestingUser);
        }
    }

    private function sendBrowserNotification($admin, $requestingUser)
    {
        $notificationData = [
            'type' => 'agent_login_request',
            'message' => $requestingUser->name . ' wants to login. Please approve.',
            'agent_name' => $requestingUser->name,
            'agent_email' => $requestingUser->email,
            'timestamp' => now()->timestamp . '_' . $requestingUser->id
        ];

        \Cache::put('admin_notification_' . $admin->id, $notificationData, 600);
    }

    public function getAdminNotifications()
    {
        $userId = Auth::id();
        $notification = \Cache::get('admin_notification_' . $userId);
        
        if ($notification) {
            \Cache::forget('admin_notification_' . $userId);
            return response()->json($notification);
        }
        
        return response()->json(null);
    }

    public function cleanupExpiredRequests()
    {
        $expiredCount = AgentLoginRequest::where('status', 'pending')
            ->where('expired_at', '<', now())
            ->update(['status' => 'expired']);
            
        return response()->json([
            'success' => true,
            'expired_count' => $expiredCount
        ]);
    }

    public function testNotifications()
    {
        $pendingCount = AgentLoginRequest::where('status', 'pending')->count();
        $allRequests = AgentLoginRequest::with('user')->orderBy('created_at', 'desc')->take(5)->get();
        
        return response()->json([
            'pending_count' => $pendingCount,
            'recent_requests' => $allRequests,
            'current_user' => Auth::user(),
            'cache_test' => \Cache::get('admin_notification_' . Auth::id())
        ]);
    }
}