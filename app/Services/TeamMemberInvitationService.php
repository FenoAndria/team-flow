<?php

namespace App\Services;

use App\Enum\MemberNotificationType;
use App\Models\MemberNotification;
use App\Models\TeamInvitation;
use App\Traits\TeamTrait;

class TeamMemberInvitationService
{
    use TeamTrait;
    
    public function show()
    {
        return TeamInvitation::where('team_id', $this->getTeam()->id)->get();
    }
    
    public function invite(array $request)
    {
        $teamInvitation = TeamInvitation::create([
            'team_id' => $this->getTeam()->id,
            'user_id' => $request['user_id'],
        ]);
        MemberNotification::create([
            'user_id' => $request['user_id'],
            'team_id' => $this->getTeam()->id,
            'type' => MemberNotificationType::TEAM_MEMBER_INVITATION,
        ]);
        return $teamInvitation; 
    }


}
