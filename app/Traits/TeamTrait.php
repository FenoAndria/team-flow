<?php

namespace App\Traits;

use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait TeamTrait
{

    public function isMember($teamId, $userId)
    {
        return TeamMember::where([
            'team_id' => $teamId,
            'user_id' => $userId,
        ])->exists();
    }

    public function isInvited($teamId, $userId)
    {
        return TeamInvitation::where([
            'team_id' => $teamId,
            'user_id' => $userId,
        ])->first();
    }

    public function isLead($userId)
    {
        return Team::where('lead_id', $userId)->first();
    }

    public function getTeam()
    {
        $user = Auth::user();
        return $this->isLead($user->id);
    }

    public function getUsersInvitable()
    {
        $allUsers = User::whereHas('role', function ($query) {
            return $query->where('name', 'User');
        })->get();
        $teamId = $this->getTeam()->id;
        $usersInvitable = $allUsers->filter(function ($item) use ($teamId) {
            return !$this->isLead($item->id) && !$this->isMember($teamId, $item->id) && !$this->isInvited($teamId, $item->id);
        })->values();
        return $usersInvitable;
    }

    
}
