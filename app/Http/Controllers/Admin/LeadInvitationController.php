<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadInvitationRequest;
use App\Http\Requests\UpdateLeadInvitationRequest;
use App\Http\Resources\Admin\LeadInvitationResource;
use App\Http\Resources\UserResource;
use App\Models\LeadInvitation;
use App\Services\LeadInvitationService;
use Illuminate\Http\Request;

class LeadInvitationController extends Controller
{
    protected $leadInvitationService;
    public function __construct(LeadInvitationService $leadInvitationService)
    {
        $this->leadInvitationService = $leadInvitationService;
    }

    public function index()
    {
        $leadInvitation = $this->leadInvitationService->index();
        return response()->json(LeadInvitationResource::collection($leadInvitation));
    }
    
    public function store(LeadInvitationRequest $request)
    {
        try {
            $leadInvitation = $this->leadInvitationService->store($request->validated());
            return response()->json(new LeadInvitationResource($leadInvitation));
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function showInvitableLead()
    {
        $users = $this->leadInvitationService->getInvitableLead();
        return response()->json(UserResource::collection($users));
    }

    
    public function update(UpdateLeadInvitationRequest $request, LeadInvitation $leadInvitation)
    {
        $this->authorize('update', $leadInvitation);
        try {
            $leadInvitation = $this->leadInvitationService->update($leadInvitation, $request->validated());
            return response()->json($leadInvitation);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }


}
