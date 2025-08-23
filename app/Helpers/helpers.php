<?php

   use App\Helpers\HashidsHelper;

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


   function log_operation(string $model, int $resourceId, string $action, string $message, int $userId): void
    {
        \App\Models\Log::create([
            'model' => $model,
            'resource_id' => $resourceId,
            'action' => $action,
            'message' => $message,
            'user_id' => $userId,
            'created_at' => now(),
        ]);
    }