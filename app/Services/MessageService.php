<?php

namespace App\Services;

use App\Models\Message;
use App\Models\Subtask;
use App\Models\Team;
use App\Traits\TeamTrait;
use Illuminate\Support\Facades\Auth;

class MessageService
{
    use TeamTrait;

    public function store(array $request, Team $team)
    {
        $user = Auth::user();

        return Message::create([
            'sender_id' => $user->id,
            'team_id' => $team->id,
            'content' => $request['content']
        ]);
    }

    public function showLeadMessages()
    {
        $lead = $this->getTeam();
        return $lead->messages;
    }
}
