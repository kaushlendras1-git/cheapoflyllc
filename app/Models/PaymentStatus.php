<?php

// app/Models/PaymentStatus.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    protected $table = 'payment_statuses';
    protected $fillable = ['name','departments','roles','updated_by'];
    
    protected $casts = [
        'departments' => 'array',
        'roles' => 'array'
    ];
}
