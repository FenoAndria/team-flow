<?php

namespace App\Services;

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

    private function accept(TeamInvitation $teamInvitation)
    {
        $teamMember = TeamMember::create([
            'team_id' => $teamInvitation->team_id,
            'user_id' => $teamInvitation->user_id,
        ]);
        return $teamMember;
    }
}
