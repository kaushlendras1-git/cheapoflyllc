<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class FirebaseService
{
    protected $firebaseUrl = 'https://fcm.googleapis.com/fcm/send';
    protected $serverKey;

    public function __construct()
    {
        // The Firebase Server Key from Firebase Console
        $this->serverKey = env('FIREBASE_SERVER_KEY');
    }

    public function sendNotification($deviceToken, $title, $body, $data = [])
    {
        $client = new Client();

        $payload = [
            'to' => $deviceToken,
            'notification' => [
                'title' => $title,
                'body' => $body,
                'sound' => 'default',
            ],
            'data' => $data,
        ];

        $response = $client->post($this->firebaseUrl, [
            'headers' => [
                'Authorization' => 'key=' . $this->serverKey,
                'Content-Type' => 'application/json',
            ],
            'json' => $payload,
        ]);

        return json_decode($response->getBody(), true);
    }
}
