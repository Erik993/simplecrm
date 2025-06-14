<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_status_id', 'id');
    }
}
