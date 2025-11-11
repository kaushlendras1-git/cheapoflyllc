<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\AllowedIp;
use Illuminate\Http\Request;

class AllowedIpController extends Controller
{
    public function index()
    {
        $ips = AllowedIp::orderBy('id', 'desc')->get();
        return view('masters.allowed-ips.index', compact('ips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ip_address' => 'required|ip|unique:allowed_ips,ip_address',
            'description' => 'nullable|string|max:255'
        ]);

        AllowedIp::create([
            'ip_address' => $request->ip_address,
            'description' => $request->description,
            'status' => 1
        ]);

        return redirect()->route('allowed-ips.index')->with('success', 'IP address added successfully');
    }

    public function update(Request $request, AllowedIp $allowedIp)
    {
        $request->validate([
            'ip_address' => 'required|ip|unique:allowed_ips,ip_address,' . $allowedIp->id,
            'description' => 'nullable|string|max:255'
        ]);

        $allowedIp->update([
            'ip_address' => $request->ip_address,
            'description' => $request->description
        ]);

        return redirect()->route('allowed-ips.index')->with('success', 'IP address updated successfully');
    }

    public function destroy(AllowedIp $allowedIp)
    {
        $allowedIp->delete();
        return redirect()->route('allowed-ips.index')->with('success', 'IP address deleted successfully');
    }

    public function toggleStatus(AllowedIp $allowedIp)
    {
        $allowedIp->update(['status' => !$allowedIp->status]);
        return redirect()->route('allowed-ips.index')->with('success', 'IP status updated successfully');
    }

    public function toggleOpenAll()
    {
        $openAll = AllowedIp::where('open_all', 1)->first();
        
        if ($openAll) {
            $openAll->update(['open_all' => 0]);
            $message = 'IP restriction enabled';
        } else {
            AllowedIp::create([
                'ip_address' => '0.0.0.0',
                'description' => 'Open All IPs',
                'status' => 1,
                'open_all' => 1
            ]);
            $message = 'All IPs allowed';
        }
        
        return redirect()->route('allowed-ips.index')->with('success', $message);
    }
}