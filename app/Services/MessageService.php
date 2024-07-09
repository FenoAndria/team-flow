<?php

namespace App\Services;

use App\Models\Message;
use App\Models\Team;
use App\Traits\TeamTrait;
use Illuminate\Support\Facades\Auth;

class MessageService
{
    use TeamTrait;

    public function storeLeadMessage(array $request)
    {
        $user = Auth::user();

        return Message::create([
            'sender_id' => $user->id,
            'team_id' => $this->getTeam()->id,
            'content' => $request['content']
        ]);
    }

    public function storeTeamMessage(array $request, Team $team)
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

    public function showTeamMemberMessages()
    {
        $user = Auth::user();
        $messages = Message::where('sender_id', $user->id)->get();
        return $messages;
    }

    public function showTeamMessages(Team $team)
    {
        $user = Auth::user();
        $messages = Message::where(['team_id' => $team->id])->get();
        return $messages;
    }
}
