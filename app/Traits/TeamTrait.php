<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait TeamTrait
{
    public function isMember($teamId, $userId)
    {
        return TeamMember::where([
            'team_id' => $teamId,
            'user_id' => $userId,
        ])->first();
    }

    public function isInvited($teamId, $userId)
    {
        return TeamInvitation::where([
            'team_id' => $teamId,
            'user_id' => $userId,
        ])->first();
    }

    public function isLead($userId)
    {
        return Team::where('lead_id', $userId)->first();
    }

    public function getTeam()
    {
        $user = Auth::user();
        return $this->isLead($user->id);
    }

    public function getUsersInvitable()
    {
        $role = Role::where('name', 'User')->first();
        $all = User::where('role_id', $role->id)->get();
        $teamId = $this->getTeam()->id;
        $usersTab = [];
        foreach ($all as $item) {
            if (!$this->isLead($item->id) && !$this->isMember($teamId, $item->id) && !$this->isInvited($teamId, $item->id)) {
                array_push($usersTab, $item);
            }
        }
        return $usersTab;
    }
}
