<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelQualityFeedback extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'travel_quality_feedback';

    protected $fillable = ['booking_id', 'qa', 'date_time', 'feedback', 'parameters', 'status'];

    protected $casts = [
        'date_time' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'status' => 'string',
    ];

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'booking_id');
    }
}