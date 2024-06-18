<?php

namespace App\Services;

use App\Models\LeadInvitation;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\TeamMember;
use App\Traits\TeamTrait;
use Illuminate\Support\Facades\Auth;

class InvitationService
{
    use TeamTrait;

    public function show()
    {
        $user = Auth::user();
        return $user->invitation;
    }

    public function indexLeadInvitation()
    {
        return LeadInvitation::all();
        // return Team::with('leadInvitations.user')->get();
    }

    public function showLeadInvitation()
    {
        $user = Auth::user();
        $leadInvitation = LeadInvitation::where('user_id', $user->id)->get();
        return $leadInvitation;
    }

    public function update(TeamInvitation $teamInvitation, array $request)
    {
        if ($request && $request['status']) {
            $teamInvitation->status = $request['status'];
            $teamInvitation->save();
            if ($request['status'] == 'Accepted' && !$this->isMember($teamInvitation->team_id, $teamInvitation->user_id)) {
                $this->accept($teamInvitation);
            }
        }
        return $teamInvitation;
    }

    public function updateLeadInvitation(LeadInvitation $leadInvitation, array $request)
    {
        $leadInvitation->status = $request['status'];
        $leadInvitation->save();
        if ($request['status'] === 'Accepted') {
            $leadInvitation->team->lead_id = $leadInvitation->user_id;
            $leadInvitation->team->save();
        }
       
        return $leadInvitation;
    }

    public function delete(TeamInvitation $teamInvitation)
    {
        return $teamInvitation->delete();
    }

    private function accept(TeamInvitation $teamInvitation)
    {
        $teamMember = TeamMember::create([
            'team_id' => $teamInvitation->team_id,
            'user_id' => $teamInvitation->user_id,
        ]);
        return $teamMember;
    }
}
