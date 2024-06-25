<?php

namespace App\Services;

use App\Models\Subtask;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Auth;

class MemberService
{
    protected $invitationService;
    public function __construct(SubtaskService $subtaskService, InvitationService $invitationService)
    {
        $this->subtaskService = $subtaskService;
        $this->invitationService = $invitationService;
    }

    public function memberTeams()
    {
        $user = Auth::user();
        return TeamMember::where('user_id', $user->id)->get();
    }

    public function leaveTeam(Team $team)
    {
        $user = Auth::user();
        $whereClause = [
            'team_id' => $team->id,
            'user_id' => $user->id,
        ];
        $teamInvitation = TeamInvitation::where($whereClause)->first();
        $this->invitationService->delete($teamInvitation);
        $delete = TeamMember::where($whereClause)->delete();
        $this->subtaskService->unassignUser($team);
        return $delete;
    }
}
