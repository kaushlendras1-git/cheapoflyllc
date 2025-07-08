<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShiftAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shift_id',
        'effective_from',
        'effective_to',
    ];
}
