<?php

namespace App\Services;

use App\Models\TeamInvitation;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Auth;

class InvitationService
{
    public function show()
    {
        $user = Auth::user();
        return $user->invitation;
    }

    public function update(TeamInvitation $teamInvitation, array $request)
    {
        $teamInvitation->status = $request['status'];
        $teamInvitation->save();
        if ($request['status'] == 'Accepted') {
            $this->accept($teamInvitation);
        }
        return $teamInvitation;
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
