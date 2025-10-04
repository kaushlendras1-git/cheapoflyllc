<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getTeamLeaders(Request $request)
    {
        $query = User::whereHas('roleRelation', function($q) {
            $q->where('name', 'Team Leader');
        });

        if ($request->has('lob')) {
            $query->where('lob', $request->lob);
        }

        if ($request->has('team')) {
            $query->where('team', $request->team);
        }

        $teamLeaders = $query->select('id', 'name')->get();

        return response()->json($teamLeaders);
    }
}