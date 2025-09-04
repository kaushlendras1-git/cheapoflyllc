<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function index()
    {
        return view('web.members.settings');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
           # 'name' => 'required|string|max:255',
           # 'pseudo' => 'required|string|max:255',
          #  'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = auth()->user();
        
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $user->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $user->update($request->only(['name', 'pseudo', 'email', 'phone', 'address']));

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password changed successfully!');
    }

    public function updateDocuments(Request $request)
    {
        $request->validate([
            'pan_card' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'aadhar_card' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = auth()->user();

        if ($request->hasFile('pan_card')) {
            if ($user->pan_card) {
                Storage::disk('public')->delete($user->pan_card);
            }
            $user->pan_card = $request->file('pan_card')->store('documents', 'public');
        }

        if ($request->hasFile('aadhar_card')) {
            if ($user->aadhar_card) {
                Storage::disk('public')->delete($user->aadhar_card);
            }
            $user->aadhar_card = $request->file('aadhar_card')->store('documents', 'public');
        }

        $user->save();

        return back()->with('success', 'Documents updated successfully!');
    }
}