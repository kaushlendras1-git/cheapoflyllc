<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;


class SendPushController extends Controller
{
     public function send(Messaging $messaging)
    {
        $token = 'DEVICE_TOKEN_FROM_DB';
        $message = CloudMessage::withTarget('token', $token)
            ->withNotification(Notification::create('Hello', 'You have a new message'))
            ->withData(['url' => '/inbox']); // additional data

        $messaging->send($message);

        return 'sent';
    }
}
