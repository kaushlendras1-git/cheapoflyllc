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
    private $accountId;
    private $extension;

    public function __construct()
    {
        $this->clientId = env('RINGCENTRAL_CLIENT_ID');
        $this->clientSecret = env('RINGCENTRAL_CLIENT_SECRET');
        $this->accountId = env('RINGCENTRAL_ACCOUNT_ID', '~');
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

    public function authorize()
    {
        $redirectUri = env('RINGCENTRAL_REDIRECT_URI', url('/ringcentral/callback'));
        $authUrl = $this->baseUrl . '/restapi/oauth/authorize?' . http_build_query([
            'response_type' => 'code',
            'client_id' => $this->clientId,
            'redirect_uri' => $redirectUri,
            'state' => csrf_token()
        ]);
        
        return redirect($authUrl);
    }
    
    public function callback(Request $request)
    {
        $code = $request->get('code');
        $state = $request->get('state');
        
        if (!$code || $state !== csrf_token()) {
            return response()->json(['error' => 'Invalid authorization code or state'], 400);
        }
        
        $redirectUri = env('RINGCENTRAL_REDIRECT_URI', url('/ringcentral/callback'));
        
        $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
            ->asForm()
            ->post($this->baseUrl . '/restapi/oauth/token', [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => $redirectUri
            ]);
            
        if ($response->successful()) {
            $tokenData = $response->json();
            // Store tokens in session or database
            session([
                'ringcentral_access_token' => $tokenData['access_token'],
                'ringcentral_refresh_token' => $tokenData['refresh_token'] ?? null,
                'ringcentral_expires_at' => now()->addSeconds($tokenData['expires_in'])
            ]);
            
            return response()->json(['message' => 'Authorization successful']);
        }
        
        return response()->json(['error' => 'Failed to exchange code for token'], 400);
    }
    
    private function getAccessToken()
    {
        // Check if we have a valid access token in session
        $accessToken = session('ringcentral_access_token');
        $expiresAt = session('ringcentral_expires_at');
        
        if ($accessToken && $expiresAt && now()->lt($expiresAt)) {
            return $accessToken;
        }
        
        // Try to refresh token if available
        $refreshToken = session('ringcentral_refresh_token');
        if ($refreshToken) {
            $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
                ->asForm()
                ->post($this->baseUrl . '/restapi/oauth/token', [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refreshToken
                ]);
                
            if ($response->successful()) {
                $tokenData = $response->json();
                session([
                    'ringcentral_access_token' => $tokenData['access_token'],
                    'ringcentral_refresh_token' => $tokenData['refresh_token'] ?? $refreshToken,
                    'ringcentral_expires_at' => now()->addSeconds($tokenData['expires_in'])
                ]);
                
                return $tokenData['access_token'];
            }
        }
        
        // Try password flow as fallback
        $username = env('RINGCENTRAL_USERNAME');
        $password = env('RINGCENTRAL_PASSWORD');
        
        if ($username && $password) {
            $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
                ->asForm()
                ->post($this->baseUrl . '/restapi/oauth/token', [
                    'grant_type' => 'password',
                    'username' => $username,
                    'password' => $password,
                    'extension' => $this->extension
                ]);
                
            if ($response->successful()) {
                $tokenData = $response->json();
                session([
                    'ringcentral_access_token' => $tokenData['access_token'],
                    'ringcentral_refresh_token' => $tokenData['refresh_token'] ?? null,
                    'ringcentral_expires_at' => now()->addSeconds($tokenData['expires_in'])
                ]);
                
                return $tokenData['access_token'];
            }
            
            Log::error('RingCentral Password Auth Error: ' . $response->body());
        }
        
        throw new \Exception('No valid access token. Please authorize first at /ringcentral/authorize');
    }
}