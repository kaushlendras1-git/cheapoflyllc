<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingActivity extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'booking_id',
        'user_id',
        'department_id',
        'role_id',
    ];

      // Relationships
        public function booking()
        {
            return $this->belongsTo(TravelBooking::class, 'booking_id', 'id');
        }

        public function user(){
            return $this->belongsTo(User::class, 'user_id', 'id');
        }

        public function department(){
            return $this->belongsTo(Department::class, 'department_id', 'id');
        }

        public function role(){
            return $this->belongsTo(Role::class, 'role_id', 'id');
        }    
}
