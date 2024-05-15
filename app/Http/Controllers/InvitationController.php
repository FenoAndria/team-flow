<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMemberInvitationRequest;
use App\Http\Resources\TeamInvitationResource;
use App\Models\TeamInvitation;
use App\Services\InvitationService;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    protected $invitationService;
    public function __construct(InvitationService $invitationService)
    {
        $this->invitationService = $invitationService;
    }
    public function show()
    {
        $invitation = $this->invitationService->show();
        return response()->json(TeamInvitationResource::collection($invitation)); 
    }

    public function update(UpdateMemberInvitationRequest $request, TeamInvitation $teamInvitation)
    {
        $this->authorize('update', $teamInvitation);
        try {
            $memberInvitation = $this->invitationService->update($teamInvitation,$request->validated());
            return response()->json($memberInvitation);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
