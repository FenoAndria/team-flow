<?php

namespace App\Services;

use App\Models\Task;
use App\Traits\TeamTrait;

class TaskService
{
    use TeamTrait;

    public function all()
    {
        return Task::all();
    }

    public function store(array $request)
    {
        $task = Task::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'deadline' => $request['deadline'] ?? null,
            'team_id' => $request['team_id'],
        ]);
        return $task;
    }
}
