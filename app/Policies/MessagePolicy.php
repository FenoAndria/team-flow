<?php

namespace App\Policies;

use App\Exceptions\CustomForbiddenException;
use App\Models\Team;
use App\Models\User;
use App\Traits\TeamTrait;
use Illuminate\Auth\Access\Response;

class MessagePolicy
{
    use TeamTrait;

    public function storeMessage(User $user, Team $team)
    {
        // Only Lead and members can send message 
        return $this->isMember($team->id, $user->id) || ($this->isLead($user->id) && $team->lead_id == $user->id) ? Response::allow() : throw new CustomForbiddenException();
    }

    public function showMessage(User $user, Team $team)
    {
        return $this->isMember($team->id, $user->id) || ($this->isLead($user->id) && $team->lead_id == $user->id) ? Response::allow() : throw new CustomForbiddenException();
    }
}
