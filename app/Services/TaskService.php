<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
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
