<?php

namespace App\Observers;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
class GenericChangeObserver
{
    public function created($model)
    {
        Log::create([
            'log_type'   => class_basename($model),
            'operation'  => 'created',
            'calllog_id' => 1,
            'comment'    => json_encode($model->getAttributes()),
            'user_id'    => Auth::id(),
        ]);
    }

    public function updated($model)
    {
        foreach ($model->getDirty() as $field => $newValue) {
            $oldValue = $model->getOriginal($field);

            Log::create([
                'log_type'   => class_basename($model),
                'operation'  => 'updated',
                'calllog_id' => 1,
                'comment'    => "Field '{$field}' updated from '{$oldValue}' to '{$newValue}'",
                'user_id'    => Auth::id(),
            ]);
        }
    }

    public function deleted($model)
    {
        Log::create([
            'log_type'   => class_basename($model),
            'operation'  => 'deleted',
            'calllog_id' => 1,
            'comment'    => json_encode($model->getOriginal()),
            'user_id'    => Auth::id(),
        ]);
    }
}
