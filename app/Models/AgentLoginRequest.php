<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentLoginRequest extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'requested_at',
        'expired_at',
        'approved_at',
        'approved_by'
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'expired_at' => 'datetime',
        'approved_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
