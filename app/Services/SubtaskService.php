<?php

namespace App\Services;

use App\Models\Subtask;
use App\Models\Task;
use App\Traits\TeamTrait;
use Exception;

class SubtaskService
{
    use TeamTrait;

    public function store(Task $task, array $request)
    {
        $subtask = Subtask::create([
            'task_id' => $task->id,
            ...$request
        ]);
        return $subtask;
    }

    public function assignUser(Subtask $subtask, array $request)
    {
        if (!$this->isMember($this->getTeam()->id, $request['user_id'])) {
            throw new Exception('User selected is not a member of the \'' . $this->getTeam()->name . '\' team!');
        }
        if ($subtask->assigned_to) {
            throw new Exception('Subtask already assigned to a User');
        }
        $subtask->assigned_to = $request['user_id'];
        $subtask->save();
        return $subtask;
    }
}
