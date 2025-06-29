<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chkflight',
        'chkhotel',
        'chkcruise',
        'chkcar',
        'phone',
        'name',
        'team',
        'campaign',
        'reservation_source',
        'call_type',
        'call_converted',
        'followup_date',
        'assign',
        'notes',
        'user_id',
        'pnr',
    ];
}
