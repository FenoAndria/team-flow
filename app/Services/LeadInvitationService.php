<?php

namespace App\Services;

use App\Models\LeadInvitation;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\TeamMember;
use App\Models\User;

class LeadInvitationService
{

    public function index()
    {
        return LeadInvitation::all();
        // return Team::with('leadInvitations.user')->get();
    }


    public function store(array $request)
    {
        $leadInvitation = LeadInvitation::create($request);
        return $leadInvitation;
    }

    public function update(LeadInvitation $leadInvitation, array $request)
    {
        $leadInvitation->status = $request['status'];
        $leadInvitation->save();
        if ($request['status'] === 'Accepted') {
            $leadInvitation->team->lead_id = $leadInvitation->user_id;
            $leadInvitation->team->save();
            LeadInvitation::where('id', '!=', $leadInvitation->id)->where('status', '!=', 'Declined')->where(function ($query) use ($leadInvitation) {
                $query->where('team_id', $leadInvitation->team_id)->orWhere('user_id', $leadInvitation->user_id);
            })->update(['status' => 'Expired']); // Todo : other user's lead_invitations will be 'Declined'
            TeamInvitation::where('user_id', $leadInvitation->user->id)->where('status', '!=', 'Declined')->update(['status' => 'Declined']);
        }

        return $leadInvitation;
    }

    public function getInvitableLead()
    {
        $allUsers = User::whereHas('role', function ($query) {
            return $query->where('name', 'User');
        })->get();
        $leadIds = Team::pluck('lead_id')->toArray();
        $teamMemberIds = TeamMember::pluck('user_id')->toArray();
        // $invitedIds = LeadInvitation::where('status', 'Accepted')->pluck('user_id')->toArray();
        $invitableLead = $allUsers->filter(function ($user) use ($leadIds, $teamMemberIds) {
            return !in_array($user->id, $leadIds) && !in_array($user->id, $teamMemberIds) ;
        })->values();
        return $invitableLead;
    }
}
