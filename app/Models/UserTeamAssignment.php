<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTeamAssignment extends Model
{
     protected $fillable = [
        'user_id',
        'team_id',
        'effective_from',
        'effective_to',
    ];
}
