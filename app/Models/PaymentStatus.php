<?php

// app/Models/PaymentStatus.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    protected $table = 'payment_statuses'; // Ensure correct table name

    protected $fillable = ['name', 'color']; // Add other fields as needed

    public $timestamps = true; // Change to false if table doesn't use timestamps
}
