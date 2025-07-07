<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortBreak extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'break_date',
        'status',
        'start_time',
        'end_time',
        'total_time',
        'approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
