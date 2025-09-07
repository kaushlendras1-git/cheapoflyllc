<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status', 'lob_id'];

    public function userTeamAssignments()
    {
        return $this->hasMany(UserTeamAssignment::class);
    }

    public function lob()
    {
        return $this->belongsTo(LOB::class);
    }
    
}
