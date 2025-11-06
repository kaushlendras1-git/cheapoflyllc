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
            
            $response = $this->client->post('https://accounts.zoho.com/oauth/v2/token', [
                'form_params' => [
                    'refresh_token' => '1000.83dff88607e5d5fb8186e04d7cdb933a.ac5ca69351e2527945879b81ec9dc2ed',
                    'client_id' => '1000.RFERNL5N6ZX0REEEIGQJSYOTI2XJ9M',
                    'client_secret' => '619e261660544d93333e1d173e03050a4876e6357c',
                    'redirect_uri' => 'https://sign.zoho.com',
                    'grant_type' => 'refresh_token'
                ],
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ]
            ]);

            $responseBody = $response->getBody()->getContents();            
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
                            'private_notes' => $privateNotes,
                            //'delivery_mode" => "EMAIL_SMS',
                            //'recipient_countrycode_iso' => 'IN',
                            //'recipient_phonenumber' => "8510810544",
                        ]
                    ],
                    'expiration_days' => 7,
                    'is_sequential' => true,
                    'email_reminders' => true,
                    'reminder_period' => 3,
                    'notes' =>  "Note for all recipients"
                ]
            ];
            $response = $this->client->post('https://sign.zoho.com/api/v1/requests', [
                'headers' => [
                    'Authorization' => 'Zoho-oauthtoken ' . $accessToken
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
            dd($e->getMessage());
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
            
            $response = $this->client->get('https://sign.zoho.com/api/v1/requests/' . $requestId . '/documents/' . $documentId, [
                'headers' => [
                    'Authorization' => 'Zoho-oauthtoken ' . $accessToken
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
    public function submitDocument($requestId, $actionId, $documentId, $fields = [],$private_notes)
    {
        try {
            // Always refresh token before making the request
            $accessToken = $this->refreshAccessToken();
            
            // Add a small delay to ensure token is properly refreshed
            sleep(1);
            
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
                        'is_mandatory' => false,
                        'page_no' => $lastPage,
                        'document_id' => $documentId,
                        'field_name' => 'Signature',
                        'y_coord' => 50,
                        'action_id' => $actionId,
                        'abs_width' => 0,
                        'x_coord' => 0,
                        'abs_height' => 0
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
                            'private_notes' => $private_notes,
                            'signing_order' => 0,
                           // 'fields' => $fields
                        ]
                    ]
                ]
            ];

            $response = $this->client->post('https://sign.zoho.com/api/v1/requests/' . $requestId . '/submit', [
                'headers' => [
                    'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
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

    
    /**
     * Get Request Details
     */
    public function getRequestDetails($requestId)
    {
        try {
            $accessToken = $this->refreshAccessToken();
            
            $response = $this->client->get('https://sign.zoho.com/api/v1/requests/' . $requestId, [
                'headers' => [
                    'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
                    'Content-Type' => 'application/json'
                ]
            ]);
            
            return json_decode($response->getBody(), true);
            
        } catch (RequestException $e) {
            Log::error('Zoho Sign Get Request Details Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Download PDF
     */
    public function downloadPdf($requestId)
    {
        try {
            $accessToken = $this->refreshAccessToken();
            
            Log::info('Downloading PDF for request ID: ' . $requestId);
            
            $response = $this->client->get('https://sign.zoho.com/api/v1/requests/' . $requestId . '/pdf', [
                'headers' => [
                    'Authorization' => 'Zoho-oauthtoken ' . $accessToken
                ],
                'query' => [
                    'with_coc' => 'true',
                    'merge' => 'false'
                ]
            ]);
            
            $statusCode = $response->getStatusCode();
            $contentType = $response->getHeader('Content-Type')[0] ?? '';
            
            Log::info('Zoho PDF Response - Status: ' . $statusCode . ', Content-Type: ' . $contentType);
            
            if ($statusCode !== 200) {
                throw new \Exception('Zoho API returned status code: ' . $statusCode);
            }
            
            return $response->getBody()->getContents();
            
        } catch (RequestException $e) {
            $errorBody = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : 'No response body';
            Log::error('Zoho Sign Download PDF Error: ' . $e->getMessage());
            throw new \Exception('Failed to download PDF: ' . $e->getMessage());
        }
    }

    /**
     * Download Completion Certificate
     */
    public function downloadCompletionCertificate($requestId)
    {
        try {
            // First check if the request is completed
            $requestDetails = $this->getRequestDetails($requestId);
            $requestStatus = $requestDetails['requests']['request_status'] ?? '';
            
            if ($requestStatus !== 'completed') {
                throw new \Exception('Completion certificate is only available for completed requests. Current status: ' . $requestStatus);
            }
            
            $accessToken = $this->refreshAccessToken();
            
            Log::info('Downloading completion certificate for request ID: ' . $requestId);
            
            $response = $this->client->get('https://sign.zoho.com/api/v1/requests/' . $requestId . '/completioncertificate', [
                'headers' => [
                    'Authorization' => 'Zoho-oauthtoken ' . $accessToken
                ]
            ]);
            
            $statusCode = $response->getStatusCode();
            $contentType = $response->getHeader('Content-Type')[0] ?? '';
            
            Log::info('Zoho Certificate Response - Status: ' . $statusCode . ', Content-Type: ' . $contentType);
            
            if ($statusCode !== 200) {
                throw new \Exception('Zoho API returned status code: ' . $statusCode);
            }
            
            return $response->getBody()->getContents();
            
        } catch (RequestException $e) {
            $errorBody = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : 'No response body';
            Log::error('Zoho Sign Download Certificate Error: ' . $e->getMessage() . ' Response: ' . $errorBody);
            throw new \Exception('Failed to download certificate: ' . $e->getMessage() . ' Response: ' . $errorBody);
        }
    }
}