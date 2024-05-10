<?php

namespace App\Services;

use App\Models\Team;
use App\Models\TeamInvitation;
use App\Traits\TeamTrait;

class TeamService
{
    use TeamTrait;

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
        $team = $this->getTeam();
        $isMember = $this->isMember($team->id, $request['user_id']);
        $isInvited = $this->isInvited($team->id, $request['user_id']);
        $isLead = $this->isLead($request['user_id']);
        if (!$isMember && !$isInvited && !$isLead) {
            $teamInvitation = TeamInvitation::create([
                'team_id' => $team->id,
                'user_id' => $request['user_id'],
            ]);
            return $teamInvitation;
        }
        return false;
    }

    public function show()
    {
        $team = $this->getTeam();
        return TeamInvitation::where('team_id', $team->id)->get();
    }

}
