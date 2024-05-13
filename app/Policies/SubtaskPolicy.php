<?php

namespace App\Policies;

use App\Exceptions\CustomForbiddenException;
use App\Models\Subtask;
use App\Models\User;
use App\Traits\TeamTrait;
use Illuminate\Auth\Access\Response;

class SubtaskPolicy
{
    use TeamTrait;
    
    public function assignUser(User $user, Subtask $subtask): Response
    {
        return $subtask->task->team_id == $this->getTeam()->id ? Response::allow() : throw new CustomForbiddenException();
    }

    public function updateStatus(User $user, Subtask $subtask): Response
    {
        return $subtask->assigned_to == $user->id ? Response::allow() : throw new CustomForbiddenException();
    }
}
