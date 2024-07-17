<?php

namespace App\Policies;

use App\Exceptions\CustomForbiddenException;
use App\Models\Task;
use App\Models\User;
use App\Traits\TeamTrait;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    use TeamTrait;

    /**
     * Determine whether the user can create models.
     */
    public function createSubtask(User $user, Task $task): Response
    {
        return $task->team_id == $this->getTeam()->id && $task->status != 'Completed' ? Response::allow() : throw new CustomForbiddenException();
    }

    public function show(User $user, Task $task): Response
    {
        return $task->team_id == $this->getTeam()->id ? Response::allow() : throw new CustomForbiddenException();
    }
}
