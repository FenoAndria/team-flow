<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamInvitationRequest;
use App\Http\Requests\TeamRequest;
use App\Services\TeamService;
use Exception;
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
            if (!$teamInvitation) {
                throw new Exception("There are some errors in the invitation.", 1);
            }
            return response()->json($teamInvitation);
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
        return response()->json($tasks);
    }

    public function showMember()
    {
        $tasks = $this->teamService->showMember();
        return response()->json($tasks);
    }


}
