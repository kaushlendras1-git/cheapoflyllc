<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait Loggable
{
    public function logChange($bookingId, $modelType, $modelId, $field, $oldValue, $newValue)
    {

            $data = [
                'booking_id' => $bookingId,
                'model_type' => $modelType,
                'model_id' => $modelId,
                'field' => $field,
                'old_value' => is_scalar($oldValue) ? $oldValue : json_encode($oldValue),
                'new_value' => is_scalar($newValue) ? $newValue : json_encode($newValue),
                'created_at' => now(),
                'updated_at' => now(),
            ];
         
            $result = DB::table('change_logs')->insert($data);
            dd($result);
            
            if ($result) {
                Log::info('Successfully inserted into change_logs', $data);
            } else {
                Log::warning('Insert into change_logs returned false', $data);
            }
            return $result;
       
    }
}