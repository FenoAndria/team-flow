<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomForbiddenException;
use App\Http\Requests\TeamInvitationRequest;
use App\Http\Requests\TeamRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\TeamService;
use Exception;
use Illuminate\Http\JsonResponse;
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
                throw new Exception("An invitation with the same team, user already exists.", 1);
            }
            return response()->json($teamInvitation);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
