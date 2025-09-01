<?php

namespace App\Http\Controllers;

use App\Models\TrainStation;
use Illuminate\Http\Request;

class TrainSearchListController extends Controller
{
    public function search(Request $request)
    {
        $k = trim((string)$request->keyword);
        if ($k === '') return response()->json([]);

        $stations = TrainStation::query()
            ->where('name', 'like', "%{$k}%")
            ->orderBy('name')
            ->limit(10)
            ->get(['id','name']);

        return response()->json($stations);
    }
}
