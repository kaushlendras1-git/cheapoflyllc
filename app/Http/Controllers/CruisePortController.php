<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CruisePortController extends Controller
{
    public function getCruisePorts()
    {
        try {
            $ports = DB::table('cruise_ports_list')
                ->select('name', 'country')
                ->orderBy('name')
                ->get();
            
            return response()->json($ports);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch cruise ports'], 500);
        }
    }
}