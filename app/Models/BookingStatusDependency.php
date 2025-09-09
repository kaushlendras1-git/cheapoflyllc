<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingStatusDependency extends Model
{
    protected $fillable = [
        'booking_status_id',
        'dependent_status_id',
        'department',
        'role'
    ];

    public function bookingStatus()
    {
        return $this->belongsTo(BookingStatus::class);
    }

    public function dependentStatus()
    {
        return $this->belongsTo(BookingStatus::class, 'dependent_status_id');
    }
    
    public function departmentRelation()
    {
        return $this->belongsTo(Department::class, 'department', 'id');
    }

    public function roleRelation()
    {
        return $this->belongsTo(Role::class, 'role', 'id');
    }

}