<?php

namespace App\Policies;

use App\Exceptions\CustomForbiddenException;
use App\Models\LeadInvitation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LeadInvitationPolicy
{
    public function update(User $user, LeadInvitation $leadInvitation): Response
    {
        return ($user->id === $leadInvitation->user_id && $leadInvitation->status == 'Pending') ? Response::allow() : throw new CustomForbiddenException();
    }
}
