<?php

namespace App\Services;

use App\Enum\MemberNotificationType;
use App\Events\MemberNotificationEvent;
use App\Models\Subtask;
use App\Models\Task;
use App\Models\Team;
use App\Traits\TeamTrait;
use Exception;
use Illuminate\Support\Facades\Auth;

class SubtaskService
{
    use TeamTrait;

    public function store(Task $task, array $request)
    {
        $subtask = Subtask::create([
            'task_id' => $task->id,
            'title' => $request['title'],
            'description' => $request['description'],
            'deadline' => $request['deadline'] ?? null,
        ]);
        return $subtask;
    }

    public function assignUser(Subtask $subtask, array $request)
    {
        if ($subtask->assigned_to) {
            throw new Exception('Subtask already assigned to a User');
        }
        $subtask->assigned_to = $request['user_id'];
        $subtask->save();
        MemberNotificationEvent::dispatch([
            'user_id' => $subtask->assigned_to,
            'team_id' => $subtask->task->team->id,
            'type' => MemberNotificationType::NEW_SUBTASK_ASSIGNED,
            'data' => json_encode([
                'task' => $subtask->task->title,
                'subtask' => $subtask->title,
            ]),
        ]);
        return $subtask;
    }

    public function unassignUser(Team $team)
    {
        $user = Auth::user();
        $tasks = Task::where('team_id', $team->id)->pluck('id');
        $subtasks = Subtask::whereIn('task_id', $tasks)->where('assigned_to', $user->id)->get();
        foreach ($subtasks as $subtask) {
            $subtask->assigned_to = null;
            if ($subtask->status == 'In Progress' || $subtask->status == 'Cancelled') {
                $subtask->status = 'Todo';
            }
            $subtask->save();
        }
    }
}
