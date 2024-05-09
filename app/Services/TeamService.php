<?php

namespace App\Services;

use App\Models\Team;

class TeamService
{
    public function store(array $request)
    {
        $team = Team::create([
            'name' => $request['name'],
            'lead_id' => $request['lead_id'],
        ]);
        return $team;
    }

}
