<?php

namespace App\Services;

use App\Enum\TeamNotificationType;
use App\Events\TeamNotificationEvent;
use App\Models\Subtask;
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
        if ($request && $request['status']) {
            $subtask->status = $request['status'];
            $subtask->save();
            if ($subtask->status == 'In Progress' && $subtask->task->status == 'Todo') {
                $subtask->task->status = 'In Progress';
                $subtask->task->save();
            }
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
}
