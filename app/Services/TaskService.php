<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function store(array $request)
    {
        $task = Task::create($request);
        return $task;
    }
}
