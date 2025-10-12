<?php

namespace App\ZohoSign;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class ZohoSignService
{
    private $client;
    private $clientId;
    private $clientSecret;
    private $refreshToken;
    private $redirectUri;
    private $signUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->clientId = env('ZOHO_CLIENT_ID');
        $this->clientSecret = env('ZOHO_CLIENT_SECRET');
        $this->refreshToken = env('ZOHO_REFRESH_TOKEN');
        $this->redirectUri = env('ZOHO_REDIRECT_URI');
        $this->signUrl = env('ZOHO_SIGN_URL');
    }

    /**
     * Refresh Access Token
     */
    public function refreshAccessToken()
    {
        try {
            Log::info('Refreshing Zoho access token...');
            
            $response = $this->client->post('https://accounts.zoho.in/oauth/v2/token', [
                'form_params' => [
                    'refresh_token' => $this->refreshToken,
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'redirect_uri' => $this->redirectUri,
                    'grant_type' => 'refresh_token'
                ]
            ]);

            $responseBody = $response->getBody()->getContents();
            Log::info('Token refresh response: ' . $responseBody);
            
            $data = json_decode($responseBody, true);
            
            if (isset($data['access_token'])) {
                Log::info('Access token refreshed successfully');
                return $data['access_token'];
            }
            
            Log::error('Access token not found in response: ' . json_encode($data));
            throw new \Exception('Access token not found in response: ' . json_encode($data));
            
        } catch (RequestException $e) {
            $errorBody = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : 'No response body';
            Log::error('Zoho Sign Token Refresh Error: ' . $e->getMessage() . ' Response: ' . $errorBody);
            throw new \Exception('Token refresh failed: ' . $e->getMessage() . ' Response: ' . $errorBody);
        }
    }

    /**
     * Create Document
     */
    public function createDocument($requestName, $recipientEmail, $recipientName, $filePath, $privateNotes = '')
    {
        try {
            $accessToken = $this->refreshAccessToken();
            
            $requestData = [
                'requests' => [
                    'request_name' => $requestName,
                    'actions' => [
                        [
                            'action_type' => 'SIGN',
                            'recipient_email' => $recipientEmail,
                            'recipient_name' => $recipientName,
                            'signing_order' => 1,
                            'verify_recipient' => false,
                            'verification_type' => '',
                            'verification_code' => '',
                            'private_notes' => $privateNotes
                        ]
                    ],
                    'expiration_days' => 7,
                    'is_sequential' => true,
                    'email_reminders' => true,
                    'reminder_period' => 3
                ]
            ];

            $response = $this->client->post($this->signUrl . '/requests', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken
                ],
                'multipart' => [
                    [
                        'name' => 'data',
                        'contents' => json_encode($requestData)
                    ],
                    [
                        'name' => 'file',
                        'contents' => fopen($filePath, 'r'),
                        'filename' => basename($filePath)
                    ]
                ]
            ]);

            return json_decode($response->getBody(), true);
            
        } catch (RequestException $e) {
            Log::error('Zoho Sign Create Document Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get Document Info
     */
    public function getDocumentInfo($requestId, $documentId)
    {
        try {
            $accessToken = $this->refreshAccessToken();
            
            $response = $this->client->get($this->signUrl . '/requests/' . $requestId . '/documents/' . $documentId, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken
                ]
            ]);
            
            return json_decode($response->getBody(), true);
            
        } catch (RequestException $e) {
            Log::error('Zoho Sign Get Document Info Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Send Document for Signature
     */
    public function submitDocument($requestId, $actionId, $documentId, $fields = [])
    {
        try {
            $accessToken = $this->refreshAccessToken();
            
            // Default fields if none provided
            if (empty($fields)) {
                // Get document info to determine page count
                $docInfo = $this->getDocumentInfo($requestId, $documentId);
                $totalPages = $docInfo['document']['total_pages'] ?? 1;
                $lastPage = $totalPages - 1; // Pages are 0-indexed
                
                $fields = [
                    [
                        'field_type_name' => 'Signature',
                        'field_category' => 'signature',
                        'field_label' => 'Signature',
                        'is_mandatory' => true,
                        'page_no' => $lastPage,
                        'document_id' => $documentId,
                        'field_name' => 'Signature',
                        'y_coord' => 50, // Bottom of page
                        'action_id' => $actionId,
                        'abs_width' => 200,
                        'x_coord' => 100,
                        'abs_height' => 50
                    ]
                ];
            }
            
            $requestData = [
                'requests' => [
                    'actions' => [
                        [
                            'verify_recipient' => false,
                            'action_id' => $actionId,
                            'action_type' => 'SIGN',
                            'private_notes' => 'Sign the document',
                            'signing_order' => 0,
                            'fields' => $fields
                        ]
                    ]
                ]
            ];

            $response = $this->client->post($this->signUrl . '/requests/' . $requestId . '/submit', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'data' => json_encode($requestData)
                ]
            ]);

            return json_decode($response->getBody(), true);
            
        } catch (RequestException $e) {
            Log::error('Zoho Sign Submit Document Error: ' . $e->getMessage());
            throw $e;
        }
    }
}