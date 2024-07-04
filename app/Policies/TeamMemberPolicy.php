<?php

namespace App\Policies;

use App\Exceptions\CustomForbiddenException;
use App\Models\Team;
use App\Models\User;
use App\Traits\TeamTrait;
use Illuminate\Auth\Access\Response;

class TeamMemberPolicy
{
    use TeamTrait;

    public function leaveTeam(User $user, Team $team): Response
    {
        return $this->isMember($team->id, $user->id) ? Response::allow() : throw new CustomForbiddenException();
    }
    
    public function showTeam(User $user, Team $team): Response
    {
        return $this->isMember($team->id, $user->id) ? Response::allow() : throw new CustomForbiddenException();
    }

    public function storeMessage(User $user, Team $team)
    {
        // Only Lead and members can send message 
        return $this->isMember($team->id, $user->id) || ($this->isLead($user->id) && $team->lead_id == $user->id) ? Response::allow() : throw new CustomForbiddenException();
    }

}
 