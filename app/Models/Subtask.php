<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    use HasFactory;
    protected $table = 'subtasks';
    protected $fillable = ['task_id', 'title', 'description', 'status', 'deadline', 'assigned_to'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function assignedTo()
    {
        return $this->hasOne(User::class);
    }
}
