<?php

namespace App\Services\Lead;

use App\Models\TeamNotification;
use App\Traits\TeamTrait;

class TeamNotificationService
{
    use TeamTrait;
    
    public function show()
    {
        $team = $this->getTeam();
        return TeamNotification::where('team_id', $team->id)->get();
    }
}
