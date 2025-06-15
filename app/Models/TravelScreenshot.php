<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelScreenshot extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'travel_screenshots';

    protected $fillable = ['booking_id', 'type', 'notes', 'file_path'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'type' => 'string',
    ];

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }
}