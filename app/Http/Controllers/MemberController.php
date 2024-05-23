<?php

namespace App\Http\Controllers;

use App\Http\Resources\Member\GetTeamResource;
use App\Http\Resources\Member\TeamDetailsResource;
use App\Models\Team;
use App\Services\MemberService;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $memberService;
    public function __construct(MemberService $memberService) {
        $this->memberService = $memberService;
    }

    public function memberTeams()
    {
        $team = $this->memberService->team();
        return response()->json(GetTeamResource::collection($team));
    }

    public function showTeam(Team $team)
    {
        $this->authorize('showTeam',$team);
        return response()->json(new TeamDetailsResource($team));
    }
}
