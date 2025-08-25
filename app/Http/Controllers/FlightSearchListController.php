<?php

namespace App\Http\Controllers;

use App\Models\FlightSearchList;
use Illuminate\Http\Request;

class FlightSearchListController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->get('keyword');
        $searchAt =  $request->get('searchAt');

        $airlines = FlightSearchList::where('airport_code', 'LIKE', "%{$keyword}%")
            ->limit(10)
            ->get(['id', 'city_code', 'autosuggest']);

        return response()->json($airlines);
    }
}
