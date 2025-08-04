<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarImages extends Model
{
    protected $fillable = [
        'booking_id',
        'agent_id',
        'file_path',
    ];

    public function get_agent(){
        return $this->belongsTo(User::class,'agent_id','id');
    }
}
