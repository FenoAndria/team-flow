<?php

namespace App\Services;

use App\Enum\AdminNotificationType;
use App\Enum\TeamNotificationType;
use App\Events\TeamNotificationEvent;
use App\Models\AdminNotification;
use App\Models\Task;
use App\Models\TeamNotification;
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

    public function complete(Task $task)
    {
        if (count($task->subtask->filter(fn ($value) => $value->status == 'Completed')) === count($task->subtask)) {
            $task->status = 'Completed';
            $task->save();
            TeamNotification::create([
                'team_id' => $task->team->id,
                'data' => json_encode(['task' => $task->title]),
                'type' => TeamNotificationType::TASK_COMPLETED,
            ]);
            AdminNotification::create([
                'team_id' => $task->team->id,
                'data' => json_encode(['task' => $task->title]),
                'type' => AdminNotificationType::TASK_COMPLETED,
            ]);
        }
    }
}
