<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Merchant;

class MerchantController extends Controller
{
    public function index()
    {
        $merchants = Merchant::all();
        return view('masters.merchants.index', compact('merchants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'email' => 'required|email|unique:merchants,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $data = $request->all();
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('merchants', 'public');
        }

        Merchant::create($data);
        return redirect()->back()->with('success', 'Merchant created successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'email' => 'required|email|unique:merchants,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $merchant = Merchant::findOrFail($id);
        $data = $request->all();
        
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('merchants', 'public');
        }

        $merchant->update($data);
        return redirect()->back()->with('success', 'Merchant updated successfully');
    }

    public function destroy($id)
    {
        Merchant::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Merchant deleted successfully');
    }
}