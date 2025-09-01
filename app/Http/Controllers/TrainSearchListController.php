<?php

namespace App\Http\Controllers;

use App\Models\FlightSearchList;
use Illuminate\Http\Request;

class TrainSearchListController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->get('keyword');
        $searchAt =  $request->get('searchAt');

        $airlines = FlightSearchList::where('airport_name', 'LIKE', "%{$keyword}%")
            ->limit(10)
            ->get(['id', 'airport_name', 'city','country']);

        return response()->json($airlines);
    }
}
