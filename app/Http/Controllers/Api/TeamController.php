<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function getTeamsByLob(Request $request, $lobId)
    {
        if ($request->has('role_id')) {
            $roleId = $request->get('role_id');
            $users = User::where('lob', $lobId)
                ->where('role_id', $roleId)
                ->select('id', 'name')
                ->get()
                ->map(function($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name
                    ];
                });
            return response()->json($users);
        } else {
            $teams = Team::where('lob_id', $lobId)
                ->select('id', 'name')
                ->get();
            return response()->json($teams);
        }
    }
}