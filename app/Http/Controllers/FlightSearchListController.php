<?php

namespace App\Http\Controllers;

use App\Models\FlightSearchList;
use Illuminate\Http\Request;

class FlightSearchListController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->get('keyword');
        $searchAt = $request->get('searchAt');

        // First try matching airport_code
        $airlines = FlightSearchList::where('airport_code', 'LIKE', "%{$keyword}%")
            ->limit(15)
            ->get(['id', 'airport_name', 'city', 'country']);

        // If no results from airport_code, search other fields
        if ($airlines->isEmpty()) {
            $airlines = FlightSearchList::where('airport_name', 'LIKE', "%{$keyword}%")
                ->orWhere('city', 'LIKE', "%{$keyword}%")
                ->orWhere('country', 'LIKE', "%{$keyword}%")
                ->limit(15)
                ->get(['id', 'airport_name', 'city', 'country']);
        }

        return response()->json($airlines);
    }
}
