<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TeamInvitation;
use App\Models\User;
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
        return $teamInvitation;
    }
}
