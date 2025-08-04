<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightImages extends Model
{
    protected $table = 'flight_images';
    protected $fillable = [
        'booking_id',
        'agent_id',
        'file_path',
    ];

    public function get_agent(){
        return $this->belongsTo(User::class,'agent_id','id');
    }
}
