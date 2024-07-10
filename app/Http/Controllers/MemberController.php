<?php

namespace App\Http\Controllers;

use App\Http\Resources\Admin\MemberForAdminresource;
use App\Http\Resources\Member\MemberTeamResource;
use App\Http\Resources\Member\TeamDetailsResource;
use App\Models\Team;
use App\Services\MemberService;
use App\Traits\UserTrait;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    use UserTrait;
    protected $memberService;
    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function index()
    {
        $members = $this->getAllUsers();
        return response()->json(MemberForAdminresource::collection($members));
    }

    public function memberTeams()
    {
        $team = $this->memberService->memberTeams();
        return response()->json(MemberTeamResource::collection($team));
    }

    public function showTeam(Team $team)
    {
        $this->authorize('showTeam', $team);
        return response()->json(new TeamDetailsResource($team));
    }

    public function leaveTeam(Team $team)
    {
        $this->authorize('leaveTeam', $team);
        try {
            $teamLeave = $this->memberService->leaveTeam($team);
            return response()->json(['message' => 'OK!']);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
