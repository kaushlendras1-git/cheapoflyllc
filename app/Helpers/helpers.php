<?php

   use App\Helpers\HashidsHelper;
   use \App\Models\Log;

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
            'resource_id' => $resourceId,
            'action' => $action,
            'message' => $message,
            'user_id' => $userId,
            'created_at' => now(),
        ]);
    }