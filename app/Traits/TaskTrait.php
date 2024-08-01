<?php

namespace App\Traits;

use App\Enum\StatusTab;
use App\Models\Task;

/**
 * Task trait
 */
trait TaskTrait
{
    protected function getTasksGroupedCounted()
    {
        $tasks = Task::all();
        $tasksGroupedByStatus = Task::all()->groupBy('status');
        $taskStatus = StatusTab::TASK_STATUS;
        $tasksGrouped = collect($taskStatus)->mapWithKeys(function ($status) use ($tasksGroupedByStatus) {
            return [
                $status => $tasksGroupedByStatus->get($status, collect())->count()
            ];
        });
        return [
            'all' => count($tasks),
            ...$tasksGrouped,
        ];
    }
}
