<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function getTeamsByLob($lobId)
    {
        $teams = Team::where('lob_id', $lobId)
            ->select('id', 'name')
            ->get();

        return response()->json($teams);
    }
}