<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamInvitationRequest;
use App\Http\Resources\Lead\InvitationResource;
use App\Services\TeamMemberInvitationService;
use Illuminate\Http\Request;

class TeamMemberInvitationController extends Controller
{
    protected $teamMemberInvitationService;
    public function __construct(TeamMemberInvitationService $teamMemberInvitationService)
    {
        $this->teamMemberInvitationService = $teamMemberInvitationService;
    }
    
    public function show()
    {
        $invitations = $this->teamMemberInvitationService->show();
        return response()->json(InvitationResource::collection($invitations));
    }

    public function invite(TeamInvitationRequest $request)
    {
        try {
            $teamMemberInvitation = $this->teamMemberInvitationService->invite($request->validated());
            return response()->json($teamMemberInvitation);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }


}
