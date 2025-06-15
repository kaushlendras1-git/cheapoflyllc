<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelSectorDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'travel_sector_details';

    protected $fillable = ['booking_id', 'sector_type'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }
}