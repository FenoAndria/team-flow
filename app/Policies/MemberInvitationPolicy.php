<?php

namespace App\Policies;

use App\Exceptions\CustomForbiddenException;
use App\Models\TeamInvitation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MemberInvitationPolicy
{
    public function update(User $user, TeamInvitation $teamInvitation): Response
    {
        return ($user->id === $teamInvitation->user_id && $teamInvitation->status == 'Pending') ? Response::allow() : throw new CustomForbiddenException();
    }
}
