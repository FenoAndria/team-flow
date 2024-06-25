<?php

namespace App\Services;

use App\Models\LeadInvitation;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\TeamMember;
use App\Traits\TeamTrait;
use App\Traits\UserTrait;
use Exception;
use Illuminate\Support\Facades\Auth;

class TeamService
{
    use TeamTrait, UserTrait;

    protected $subtaskService;
    protected $invitationService;
    public function __construct(SubtaskService $subtaskService, InvitationService $invitationService)
    {
        $this->subtaskService = $subtaskService;
        $this->invitationService = $invitationService;
    }

    public function getAllTeams()
    {
        return Team::all();
    }

    public function store(array $request)
    {
        $team = Team::create([
            'name' => $request['name'],
        ]);
        return $team;
    }

    public function showTeamMember()
    {
        return $this->getTeam()->member;
    }

    public function showUsersInvitable()
    {
        return $this->getUsersInvitable();
    }

}
