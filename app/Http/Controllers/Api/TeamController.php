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
                ->select('id', 'pseudo')
                ->get()
                ->map(function($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->pseudo
                    ];
                });
            return response()->json($users);
        } else {
            $teams = User::where('lob', $lobId)
                ->whereIn('role_id', [19,6,9,12])
                ->whereNotIn('id', [1, 2])
                ->select('id', 'pseudo')
                ->get()
                ->map(function($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->pseudo
                    ];
                });
            return response()->json($teams);
        }
    }
}