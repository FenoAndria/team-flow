<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamInvitationRequest;
use App\Http\Requests\LeadInvitationRequest;
use App\Http\Requests\TeamRequest;
use App\Http\Resources\Lead\InvitationResource;
use App\Http\Resources\Member\MemberResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TeamResource;
use App\Http\Resources\UserResource;
use App\Models\Task;
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
        $teams = $this->teamService->all();
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

    public function inviteLead(LeadInvitationRequest $request)
    {
        try {
            $leadInvitation = $this->teamService->inviteLead($request->validated());
            return response()->json($leadInvitation);
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

    public function showInvitableLead()
    {
        $users = $this->teamService->showInvitableLead();
        // return response()->json(($users));
        return response()->json(UserResource::collection($users));
    }

    public function showTask(Task $task)
    {
        $this->authorize('show', $task);
        return response()->json(new TaskResource($task));
    }

    public function showMember()
    {
        $member = $this->teamService->showMember();
        return response()->json(MemberResource::collection($member));
    }
}
