<?php

namespace App\Http\Controllers\RingCentral;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\RingCentralComment;
use App\Models\User;

class RingCentralController extends Controller
{
    private $baseUrl = 'https://platform.ringcentral.com';
    private $clientId;
    private $clientSecret;
    private $extension;

    public function __construct()
    {
        $this->clientId = env('RINGCENTRAL_CLIENT_ID');
        $this->clientSecret = env('RINGCENTRAL_CLIENT_SECRET');
        $this->extension = auth()->user()->extension ?? env('RINGCENTRAL_EXTENSION');
    }

    public function getIncomingCallsForUser($extension = null)
    {
        try {
            $userExtension = $extension ?? auth()->user()->extension;
            
            if (!$userExtension) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No extension assigned to user'
                ], 400);
            }

            $accessToken = $this->getAccessToken();
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken
            ])->get($this->baseUrl . '/restapi/v1.0/account/~/extension/' . $userExtension . '/call-log', [
                'direction' => 'Inbound',
                'perPage' => 10,
                'page' => 1
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Incoming calls fetched successfully',
                'extension' => $userExtension,
                'data' => $response->json()
            ]);
        } catch (\Exception $e) {
            Log::error('RingCentral Incoming Calls Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function sms()
    {
        try {
            $accessToken = $this->getAccessToken();
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json'
            ])->post($this->baseUrl . '/restapi/v1.0/account/~/extension/~/sms', [
                'from' => ['phoneNumber' => $this->extension],
                'to' => [['phoneNumber' => '+1234567890']], // Replace with actual number
                'text' => 'Hello from RingCentral SMS!'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'SMS sent successfully',
                'data' => $response->json()
            ]);
        } catch (\Exception $e) {
            Log::error('RingCentral SMS Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function call()
    {
        try {
            $accessToken = $this->getAccessToken();
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json'
            ])->post($this->baseUrl . '/restapi/v1.0/account/~/extension/~/ring-out', [
                'from' => ['phoneNumber' => $this->extension],
                'to' => ['phoneNumber' => '+1234567890'], // Replace with actual number
                'playPrompt' => false
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Call initiated successfully',
                'data' => $response->json()
            ]);
        } catch (\Exception $e) {
            Log::error('RingCentral Call Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function fax()
    {
        try {
            $accessToken = $this->getAccessToken();
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken
            ])->attach('attachment', file_get_contents(public_path('sample.pdf')), 'sample.pdf')
            ->post($this->baseUrl . '/restapi/v1.0/account/~/extension/~/fax', [
                'to' => [['phoneNumber' => '+1234567890']], // Replace with actual number
                'coverPageText' => 'Fax from RingCentral'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Fax sent successfully',
                'data' => $response->json()
            ]);
        } catch (\Exception $e) {
            Log::error('RingCentral Fax Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function callLogs()
    {
        try {
            $accessToken = $this->getAccessToken();
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken
            ])->get($this->baseUrl . '/restapi/v1.0/account/~/extension/~/call-log', [
                'perPage' => 5,
                'page' => 1
            ]);

            $callLogs = $response->json();
            
            // Attach comments to each call
            if (isset($callLogs['records'])) {
                foreach ($callLogs['records'] as &$call) {
                    $comment = RingCentralComment::where('call_id', $call['id'])
                        ->where('extension', $this->extension)
                        ->first();
                    $call['comment'] = $comment ? $comment->comment : null;
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Call logs fetched successfully',
                'data' => $callLogs
            ]);
        } catch (\Exception $e) {
            Log::error('RingCentral Call Logs Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function addComment(Request $request)
    {
        $request->validate([
            'call_id' => 'required|string',
            'comment' => 'required|string|max:1000'
        ]);

        try {
            RingCentralComment::updateOrCreate(
                [
                    'call_id' => $request->call_id,
                    'extension' => $this->extension,
                    'user_id' => auth()->id()
                ],
                [
                    'comment' => $request->comment
                ]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Comment added successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('RingCentral Comment Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    private function getAccessToken()
    {
        $response = Http::asForm()->post($this->baseUrl . '/restapi/oauth/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret
        ]);

        if ($response->successful()) {
            return $response->json()['access_token'];
        }

        throw new \Exception('Failed to get RingCentral access token');
    }
}