<?php

if (!function_exists('log_operation')) {
    /**
     * Log an operation into the logs table.
     *
     * @param string $logType Type of log (e.g., 'info', 'error', 'warning').
     * @param string $operation The operation performed.
     * @param string|null $comment Additional information about the log (optional).
     * @param int|null $userId ID of the user performing the operation (optional).
     * @return bool True if the log is inserted successfully, false otherwise.
     */
    function log_operation(string $logType, string $calllog_id, string $operation, ?string $comment = null, ?int $userId = null): bool
    {
        // try {
            \DB::table('logs')->insert([
                'log_type' => $logType,
                'calllog_id' => $calllog_id,
                'operation' => $operation,
                'comment' => $comment,
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return true;
        // } catch (\Exception $e) {
        //     \Log::error('Failed to log operation: ' . $e->getMessage());
        //     return false;
        // }
    }
}
