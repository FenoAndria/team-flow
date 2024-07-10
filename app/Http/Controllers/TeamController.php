<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Http\Resources\Lead\InvitationResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TeamResource;
use App\Http\Resources\UserResource;
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
    
    public function index()
    {
        $teams = $this->teamService->getAllTeams();
        return response()->json(TeamResource::collection($teams));
    }
    
    public function show(Team $team)
    {
        return response()->json(new TeamResource($team));
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

    public function showInvitation()
    {
        $invitations = $this->teamService->showInvitation();
        return response()->json(InvitationResource::collection($invitations));
    }

    public function allTask()
    {
        $tasks = $this->teamService->showTask();
        return response()->json(TaskResource::collection($tasks));
    }

    public function showUsersInvitable()
    {
        $users = $this->teamService->showUsersInvitable();
        return response()->json(UserResource::collection($users));
    }

}
