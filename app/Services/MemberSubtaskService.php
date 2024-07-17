<?php

namespace App\Services;

use App\Enum\AdminNotificationType;
use App\Enum\TeamNotificationType;
use App\Events\TeamNotificationEvent;
use App\Models\AdminNotification;
use App\Models\Subtask;
use App\Models\TeamNotification;
use Illuminate\Support\Facades\Auth;

class MemberSubtaskService
{

    public function index()
    {
        $user = Auth::user();
        return Subtask::where('assigned_to', $user->id)->get();
    }

    public function update(Subtask $subtask, array $request)
    {
        if ($request && $request['status'] && ($subtask->status != 'Completed' && $subtask->status != 'Cancelled')) {
            $subtask->status = $request['status'];
            $subtask->save();
            $this->taskBegin($subtask);
            $this->taskCompleted($subtask);
            TeamNotificationEvent::dispatch([
                'team_id' => $subtask->task->team->id,
                'user_id' => $subtask->assignedTo->id,
                'type' => TeamNotificationType::SUBTASK_UPDATED,
                'data' => json_encode([
                    'subtask' => $subtask->title,
                    'status' => $subtask->status,
                ]),
            ]);
        }
        return $subtask;
    }

    private function taskBegin(Subtask $subtask)
    {
        if ($subtask->status == 'In Progress' && $subtask->task->status == 'Todo') {
            $subtask->task->status = 'In Progress';
            $subtask->task->save();
            AdminNotification::create([
                'team_id' => $subtask->task->team->id,
                'data' => json_encode(['task' => $subtask->task->title]),
                'type' => AdminNotificationType::TASK_BEGINNING,
            ]);
        }
    }

    private function taskCompleted(Subtask $subtask)
    {
        if ($subtask->status == 'Completed' && count($subtask->task->subtask->filter(fn ($value) => $value->status == 'Completed')) === count($subtask->task->subtask)) {
            $subtask->task->status = 'Completed';
            $subtask->task->save();
            TeamNotification::create([
                'team_id' => $subtask->task->team->id,
                'data' => json_encode(['task' => $subtask->task->title]),
                'type' => TeamNotificationType::TASK_COMPLETED,
            ]);
            AdminNotification::create([
                'team_id' => $subtask->task->team->id,
                'data' => json_encode(['task' => $subtask->task->title]),
                'type' => AdminNotificationType::TASK_COMPLETED,
            ]);
        }
    }
}
