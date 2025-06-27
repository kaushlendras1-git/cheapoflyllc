<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChangeLog extends Model
{
    protected $fillable = [
        'booking_id', 'model_id', 'model_type', 'user_id', 'field', 'old_value', 'new_value', 'changed_at'
    ];
    
    public $timestamps = false;
}