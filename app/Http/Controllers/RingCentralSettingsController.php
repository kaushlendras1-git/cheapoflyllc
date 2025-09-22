<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RingCentralSettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'client_id' => env('RINGCENTRAL_CLIENT_ID'),
            'client_secret' => env('RINGCENTRAL_CLIENT_SECRET'),
            'extension' => env('RINGCENTRAL_EXTENSION')
        ];
        
        return view('web.ringcentral.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'client_id' => 'required|string',
            'client_secret' => 'required|string',
            'extension' => 'required|string'
        ]);

        $envPath = base_path('.env');
        $envContent = file_get_contents($envPath);

        $envContent = preg_replace('/^RINGCENTRAL_CLIENT_ID=.*$/m', 'RINGCENTRAL_CLIENT_ID=' . $request->client_id, $envContent);
        $envContent = preg_replace('/^RINGCENTRAL_CLIENT_SECRET=.*$/m', 'RINGCENTRAL_CLIENT_SECRET=' . $request->client_secret, $envContent);
        $envContent = preg_replace('/^RINGCENTRAL_EXTENSION=.*$/m', 'RINGCENTRAL_EXTENSION=' . $request->extension, $envContent);

        file_put_contents($envPath, $envContent);

        return redirect()->back()->with('success', 'RingCentral settings updated successfully!');
    }
}