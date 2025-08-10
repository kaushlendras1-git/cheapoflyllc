<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FcmController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['token' => 'required|string']);
        $user = $request->user();

        // save to user model or a tokens table
        $user->fcm_token = $request->token;
        $user->save();

        return response()->json(['ok' => true]);
    }
}
