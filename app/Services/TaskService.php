<?php

namespace App\Services;

use App\Enum\TeamNotificationType;
use App\Events\TeamNotificationEvent;
use App\Models\Task;
use App\Traits\TeamTrait;

class TaskService
{
    use TeamTrait;

    public function all()
    {
        return Task::all();
    }

    public function store(array $request)
    {
        $task = Task::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'deadline' => $request['deadline'] ?? null,
            'team_id' => $request['team_id'],
        ]);
        TeamNotificationEvent::dispatch([
            'team_id' => $task->team_id,
            'type' => TeamNotificationType::TASK_ASSIGNED,
            'data' => $task->title,
        ]);
        return $task;
    }
}
