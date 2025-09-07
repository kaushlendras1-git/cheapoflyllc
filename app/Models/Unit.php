<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'lob_id', 'team_id'];

    public function lob()
    {
        return $this->belongsTo(LOB::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}