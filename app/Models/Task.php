<?php

namespace App\Models;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected function casts() : array
    {
        return [
            'status' => TaskStatus::class,
            'priority' => TaskPriority::class,
            'scheduled_at' => 'datetime',
            'due_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }
    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
