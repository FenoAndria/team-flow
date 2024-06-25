<?php

namespace App\Services;

use App\Models\LeadInvitation;
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
                LeadInvitation::where('user_id', $teamInvitation->user_id)->where('status', '!=', 'Declined')->update(['status' => 'Declined']);
            }
        }
        return $teamInvitation;
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
