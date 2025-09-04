<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'attendance_date',
        'status',
    ];

    const STATUS_PRESENT = 'P';
    const STATUS_WEEK_OFF = 'WO';
    const STATUS_LEAVE_WITHOUT_PAY = 'LWP';
    const STATUS_UNPLANNED_LEAVE = 'UL';
    const STATUS_TRAINING = 'TR';
    const STATUS_LEAVE = 'LV';
    const STATUS_HALF_DAY = 'HD';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getStatusOptions()
    {
        return [
            self::STATUS_PRESENT => 'Present',
            self::STATUS_WEEK_OFF => 'Week Off',
            self::STATUS_LEAVE_WITHOUT_PAY => 'Leave Without Pay',
            self::STATUS_UNPLANNED_LEAVE => 'Unplanned Leave',
            self::STATUS_TRAINING => 'Training',
            self::STATUS_LEAVE => 'Leave',
            self::STATUS_HALF_DAY => 'Half Day',
        ];
    }
}
