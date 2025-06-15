<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'email_templates';

    // Specify the fields that are mass assignable
    protected $fillable = ['name', 'subject', 'content'];

    // Specify the fields that should be cast to native types, if needed
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
