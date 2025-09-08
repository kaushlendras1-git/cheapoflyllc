<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Airline;

class AirlineCodeController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->input('q');
        $airlines = Airline::where('airline_name', 'like', "%$q%")
            ->orWhere('airline_code', 'like', "%$q%")
            ->limit(10)
            ->get(['id', 'airline_code', 'airline_name']);

        return response()->json($airlines);
    }
}
