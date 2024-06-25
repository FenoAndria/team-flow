<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Http\Resources\Member\MemberResource;
use App\Services\TeamService;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    protected $teamService;
    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }
    
    public function show()
    {
        $member = $this->teamService->showTeamMember();
        return response()->json(MemberResource::collection($member));
    }
}
