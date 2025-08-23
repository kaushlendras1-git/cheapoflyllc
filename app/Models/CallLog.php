<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'chkflight',
        'chkhotel',
        'chkcruise',
        'chkcar',
        'phone',
        'name',
        'team',
        'campaign_id',
        'reservation_source',
        'call_type',
        'call_converted',
        'followup_date',
        'assign',
        'notes',
        'user_id',
        'pnr',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
                                                  
    }
}