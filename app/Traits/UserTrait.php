<?php

namespace App\Traits;

use App\Models\LeadInvitation;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait UserTrait
{
    protected function assertRole(String $roleName)
    {
        $user = Auth::user();
        return $user->role->name === $roleName;
    }

    protected function getInvitableLead()
    {
        $allUsers = User::whereHas('role', function ($query) {
            return $query->where('name', 'User');
        })->get();
        $leadIds = Team::pluck('lead_id')->toArray();
        $teamMemberIds = TeamMember::pluck('user_id')->toArray();
        $invitedIds = LeadInvitation::pluck('user_id')->toArray();
        $invitableLead = $allUsers->filter(function ($user) use ($leadIds, $teamMemberIds, $invitedIds) {
            return !in_array($user->id, $leadIds) && !in_array($user->id, $teamMemberIds) && !in_array($user->id, $invitedIds);
        })->values();
        return $invitableLead;
    }
}
