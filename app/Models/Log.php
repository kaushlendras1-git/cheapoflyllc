<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'log_type',
        'calllog_id',
        'operation',
        'comment',
        'user_id'
    ];

    public function callLog()
    {
        return $this->belongsTo(CallLog::class, 'calllog_id')->where('log_type', 'call_log');
    }

    public function booking()
    {
        return $this->belongsTo(TravelBooking::class, 'calllog_id')->where('log_type', 'booking');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assuming 'user_id' is the foreign key
    }
}
