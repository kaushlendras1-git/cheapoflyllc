<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'log_type',
        'operation',
        'calllog_id',
        'comment',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assuming 'user_id' is the foreign key
    }
}
