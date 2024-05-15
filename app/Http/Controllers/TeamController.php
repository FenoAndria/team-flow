<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamInvitationRequest;
use App\Http\Requests\TeamRequest;
use App\Http\Resources\TaskResource;
use App\Models\Team;
use App\Services\TeamService;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    protected $teamService;
    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    public function store(TeamRequest $request)
    {
        try {
            $team = $this->teamService->store($request->validated());
            return response()->json($team);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function invite(TeamInvitationRequest $request)
    {
        try {
            $teamInvitation = $this->teamService->invite($request->validated());
            return response()->json($teamInvitation);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function leave(Team $team)
    {
        $this->authorize('leaveTeam', $team);
        try {
            $teamLeave = $this->teamService->leave($team);
            return response()->json(['message' => 'OK!']);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function showInvitation()
    {
        $invitations = $this->teamService->showInvitation();
        return response()->json($invitations);
    }

    public function showTask()
    {
        $tasks = $this->teamService->showTask();
        return response()->json(TaskResource::collection($tasks)); 
    }

    public function showMember()
    {
        $tasks = $this->teamService->showMember();
        return response()->json($tasks);
    }
}
