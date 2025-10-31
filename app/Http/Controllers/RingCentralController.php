<?php

namespace App\Http\Controllers;


use RingCentral\SDK\SDK;
use Exception;

class RingCentralController extends Controller
{
    public static function updateStatus($extensionId = null, $status = 'DoNotAcceptAnyCalls')
    {
        $accountId = '855621048';
        $extensionId = $extensionId ?: '496461049'; // Use working extension ID
          
        $body = [
            'userStatus' => $status === 'DoNotAcceptAnyCalls' ? 'Busy' : 'Available',
            'dndStatus' => $status,
            'message' => 'Status set via API - ' . date('Y-m-d H:i:s')
        ];

        try {
            $rcsdk = new SDK(
                env('RC_APP_CLIENT_ID'),
                env('RC_APP_CLIENT_SECRET'),
                env('RC_SERVER_URL')
            );

            $platform = $rcsdk->platform();
            $platform->login(["jwt" => env('RC_USER_JWT')]);
            $platform->put("/restapi/v1.0/account/{$accountId}/extension/{$extensionId}/presence", $body);
            
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


}
