<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomForbiddenException;
use App\Http\Requests\TeamRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\TeamService;
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

}
