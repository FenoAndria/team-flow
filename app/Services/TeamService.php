<?php

namespace App\Services;

use App\Models\Task;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\TeamMember;
use App\Traits\TeamTrait;
use Illuminate\Support\Facades\Auth;

class TeamService
{
    use TeamTrait;
    protected $subtaskService;
    public function __construct(SubtaskService $subtaskService)
    {
        $this->subtaskService = $subtaskService;
    }
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
        $isMember = $this->isMember($this->getTeam()->id, $request['user_id']);
        $isInvited = $this->isInvited($this->getTeam()->id, $request['user_id']);
        $isLead = $this->isLead($request['user_id']);
        if (!$isMember && !$isInvited && !$isLead) {
            $teamInvitation = TeamInvitation::create([
                'team_id' => $this->getTeam()->id,
                'user_id' => $request['user_id'],
            ]);
            return $teamInvitation;
        }
        return false;
    }

    public function leave(Team $team)
    {
        $user = Auth::user();
        $delete = TeamMember::where([
            'team_id' => $team->id,
            'user_id' => $user->id,
        ])->delete();
        $this->subtaskService->unassignUser($team);
        return $delete;
    }

    public function showInvitation()
    {
        return TeamInvitation::where('team_id', $this->getTeam()->id)->get();
    }

    public function showTask()
    {
        return $this->getTeam()->task;
    }

    public function showMember()
    {
        return $this->getTeam()->member;
    }
}
