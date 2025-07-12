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

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
