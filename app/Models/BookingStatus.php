<?php

// app/Models/BookingStatus.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingStatus extends Model
{
    protected $table = 'booking_statuses';

    protected $fillable = ['name','departments','roles','status', 'updated_by'];
    
    protected $casts = [
        'departments' => 'array',
        'roles' => 'array'
    ];
}
