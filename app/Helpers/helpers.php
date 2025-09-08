<?php

   use App\Helpers\HashidsHelper;
   use \App\Models\Log;
   use Illuminate\Support\Facades\Auth;

   if (!function_exists('encode')) {
       function encode($id)
       {
           return HashidsHelper::encode($id);
       }
   }

   if (!function_exists('decode')) {
       function decode($hash)
       {
           return HashidsHelper::decode($hash);
       }
   }


   function log_operation(string $log_type, int $resourceId, string $action, string $message, int $userId): void
    {
         Log::create([
            'log_type' => $log_type,
            'calllog_id' => $resourceId,
            'operation' => $action,
            'comment' => $message,
            'user_id' => $userId,
        ]);
    }

    // Standardized logging for Call Logs
    function log_call_operation(int $callLogId, string $action, int $userId, string $details = null): void
    {
        $message = match($action) {
            'view' => "Call log #{$callLogId} viewed",
            'create' => "Call log #{$callLogId} created",
            'edit' => "Call log #{$callLogId} updated",
            'delete' => "Call log #{$callLogId} deleted",
            default => "Call log #{$callLogId} {$action}"
        };
        
        if ($details) {
            $message .= " - {$details}";
        }
        
        log_operation('call_log', $callLogId, $action, $message, $userId);
    }

    // Standardized logging for Bookings
    function log_booking_operation(int $bookingId, string $action, int $userId, string $details = null): void
    {
        $message = match($action) {
            'view' => "Booking #{$bookingId} viewed",
            'create' => "Booking #{$bookingId} created",
            'edit' => "Booking #{$bookingId} updated",
            'delete' => "Booking #{$bookingId} deleted",
            'status_change' => "Booking #{$bookingId} status changed",
            'payment_update' => "Booking #{$bookingId} payment updated",
            default => "Booking #{$bookingId} {$action}"
        };
        
        if ($details) {
            $message .= " - {$details}";
        }
        
        log_operation('booking', $bookingId, $action, $message, $userId);
    }

    // Log field changes with old and new values
    function log_field_changes(string $modelType, int $modelId, array $oldValues, array $newValues, int $userId): void
    {
        foreach ($newValues as $field => $newValue) {
            $oldValue = $oldValues[$field] ?? null;
            if ($oldValue != $newValue) {
                log_operation(
                    $modelType,
                    $modelId,
                    'Updated',
                    "Field '{$field}' updated from '{$oldValue}' to '{$newValue}'",
                    $userId
                );
            }
        }
    }