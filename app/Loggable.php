<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait Loggable
{
    public function logChange($bookingId, $modelType, $modelId, $field, $oldValue, $newValue)
    {
        DB::table('change_logs')->insert([
            'booking_id' => $bookingId,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'field' => $field,
            'old_value' => is_scalar($oldValue) ? $oldValue : json_encode($oldValue),
            'new_value' => is_scalar($newValue) ? $newValue : json_encode($newValue),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}