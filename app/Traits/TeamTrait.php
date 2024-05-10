<?php

namespace App\Traits;

use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Auth;

trait TeamTrait
{
    public function isMember($teamId, $userId)
    {
        return TeamMember::where([
            'team_id' => $teamId,
            'user_id' => $userId,
        ])->first();
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
}
