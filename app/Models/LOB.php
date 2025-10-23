<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LOB extends Model
{
    use HasFactory;

    // Set the correct table name to prevent pluralization error
    protected $table = 'lobs';

    protected $fillable = ['name', 'reference', 'user_id', 'email', 'password'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
