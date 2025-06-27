<?php

namespace App\Traits;

use App\Models\ChangeLog;

trait Loggable
{
    public function logChange($modelId, $modelType, $userId, $field, $oldValue, $newValue)
    {
        try { 
            ChangeLog::create([
                'booking_id' => $modelId, // Adjust if booking_id differs from model_id
                'model_id' => $modelId,
                'model_type' => $modelType,
                'user_id' => $userId,
                'field' => $field,
                'old_value' => is_scalar($oldValue) ? (string) $oldValue : json_encode($oldValue),
                'new_value' => is_scalar($newValue) ? (string) $newValue : json_encode($newValue),
                'changed_at' => now(),
            ]);
        } catch (\Exception $e) {
            \Log::error("Failed to log change: Model ID {$modelId}, Field {$field}, Error: " . $e->getMessage());
            // Temporarily rethrow for debugging
            throw $e;
        }
    }
}