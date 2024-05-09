<?php

namespace App\Services;

use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Auth;

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

    private function isMember($teamId, $userId)
    {
        return TeamMember::where([
            'team_id' => $teamId,
            'user_id' => $userId,
        ])->first();
    }

    private function isInvited($teamId, $userId)
    {
        return TeamInvitation::where([
            'team_id' => $teamId,
            'user_id' => $userId,
        ])->first();
    }

    private function isLead($userId)
    {
        return Team::where('lead_id', $userId)->first();
    }

    private function getTeam()
    {
        $user = Auth::user();
        return $this->isLead($user->id);
    }
}
