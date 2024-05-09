<?php

namespace App\Services;

use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\TeamMember;

class TeamService
{
    public function store(array $request)
    {
        $team = Team::create([
            'name' => $request['name'],
            'lead_id' => $request['lead_id'],
        ]);
        return $team;
    }

    public function invite(array $request)
    {
        $isMember = TeamMember::where([
            'team_id' => $request['team_id'],
            'user_id' => $request['user_id'],
        ])->first();
        $isInvited = TeamInvitation::where([
            'team_id' => $request['team_id'],
            'user_id' => $request['user_id'],
        ])->first();
        if (!$isMember && !$isInvited) {
            $teamInvitation = TeamInvitation::create([
                'team_id' => $request['team_id'],
                'user_id' => $request['user_id'],
            ]);
            return $teamInvitation;
        }
        return false;
    }
}
