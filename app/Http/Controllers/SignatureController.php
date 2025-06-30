<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signature;
use Illuminate\Support\Facades\Http;


class SignatureController extends Controller
{
    public function showForm()
    {
        return view('web.signature.signature');
    }

    public function store(Request $request)
    {
        $request->validate([
            'signature' => 'required|string',
             'signature_type' => 'required|in:draw,type', 
        ]);

        // Get Public IP from an external service
        $response = Http::get('https://api.ipify.org?format=json');
        $publicIP = $response->json('ip'); // Extract the IP address

        // Save signature and public IP in the database
        Signature::create([
            'signature_data' => $request->input('signature'),
            'signature_type' => $request->input('signature_type'),
            'ip_address' => $publicIP,
        ]);

        return redirect()->back()->with('success', 'Signature and IP saved successfully!');
    }


     public function list()
    {
        $signatures = Signature::all();
        return view('web.signature.signature-list', compact('signatures'));
    }


}
