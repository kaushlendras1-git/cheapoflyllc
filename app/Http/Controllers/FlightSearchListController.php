<?php

namespace App\Http\Controllers;

use App\Models\FlightSearchList;
use Illuminate\Http\Request;

class FlightSearchListController extends Controller
{
    public function search(Request $request)
    {
        dd('hello');
        $keyword = $request->get('keyword');
        $searchAt =  $request->get('searchAt');

        $airlines = FlightSearchList::where('airport_code', 'LIKE', "%{$keyword}%")
            ->limit(10)
            ->get(['id', 'code', 'name']);

        return response()->json($airlines);
    }
}
