<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function ($model) {
            $model->logActivity('create');
        });

        static::updated(function ($model) {
            $model->logActivity('edit');
        });

        static::deleted(function ($model) {
            $model->logActivity('delete');
        });
    }

    public function logActivity(string $action, string $details = null)
    {
        if (!Auth::check()) return;

        $logType = $this->getLogType();
        $userId = Auth::id();
        
        if ($logType === 'call_log') {
            log_call_operation($this->id, $action, $userId, $details);
        } elseif ($logType === 'booking') {
            log_operation('Booking', $this->id, $action, $details ?: "Booking #{$this->id} {$action}", $userId);
        }
    }

    public function logView(string $details = null)
    {
        if (!Auth::check()) return;
        
        $this->logActivity('view', $details);
    }

    protected function getLogType(): string
    {
        return match(class_basename($this)) {
            'CallLog' => 'call_log',
            'TravelBooking' => 'booking',
            default => strtolower(class_basename($this))
        };
    }
}