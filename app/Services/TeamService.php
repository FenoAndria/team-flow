<?php

namespace App\Services;

use App\Models\Task;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\TeamMember;
use App\Traits\TeamTrait;
use Exception;
use Illuminate\Support\Facades\Auth;

class TeamService
{
    use TeamTrait;
    protected $subtaskService;
    protected $invitationService;
    public function __construct(SubtaskService $subtaskService, InvitationService $invitationService)
    {
        $this->subtaskService = $subtaskService;
        $this->invitationService = $invitationService;
    }
    public function store(array $request)
    {
        $isTeamMember = TeamMember::where('user_id', $request['lead_id'])->first();
        if ($isTeamMember) {
            throw new Exception('User already member of a team!');
        }
        $team = Team::create([
            'name' => $request['name'],
            'lead_id' => $request['lead_id'],
        ]);
        return $team;
    }

    public function invite(array $request)
    {
        $teamInvitation = TeamInvitation::create([
            'team_id' => $this->getTeam()->id,
            'user_id' => $request['user_id'],
        ]);
        return $teamInvitation;
    }

    public function leave(Team $team)
    {
        $user = Auth::user();
        $whereClause = [
            'team_id' => $team->id,
            'user_id' => $user->id,
        ];
        $teamInvitation = TeamInvitation::where($whereClause)->first();
        $delete = TeamMember::where($whereClause)->delete();
        $this->subtaskService->unassignUser($team);
        $this->invitationService->delete($teamInvitation);
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
