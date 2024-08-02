<?php

namespace App\Services\Admin;

use App\Models\Subtask;
use App\Models\Task;
use App\Models\TeamMember;
use App\Traits\TaskTrait;
use App\Traits\TeamTrait;
use App\Traits\UserTrait;

class AdminDashboardService
{
    use UserTrait, TeamTrait, TaskTrait;

    public function index()
    {
        return [
            // Global stat
            'global_stat' => [
                'user_stat' => $this->getUsersGrouped(),
                'team_stat' => $this->getTeamsGrouped(),
                'task_stat' => $this->getTasksGroupedCounted(),
            ],
            // Particular stat
            'particular_stat' => [
                'team_member_subtasks' => $this->teamMemberSubtasks(),
                'team_member_appearance' => $this->teamMemberAppearance(),
                'team_member_completed_subtasks' => $this->teamMemberCompletedSubtasks(),
                'team_completed_tasks' => $this->teamCompletedTasks(),
                'team_have_tasks' => $this->teamHaveTasks(),
            ]
        ];
    }

    private function teamMemberAppearance()
    {
        $teamMemberGrouped = TeamMember::with('team')->get()->groupBy('user.profil.name');
        $teamCount = array_map(fn ($teamMember) => collect($teamMember)->count(), $teamMemberGrouped->toArray());
        $max = array_key_first($teamCount);
        foreach ($teamCount as $key => $value) {
            if ($value > $teamCount[$max]) $max = $key;
        }
        return [$max => $teamCount[$max]];
    }

    private function teamMemberSubtasks()
    {
        $subtasksGrouped = Subtask::with('assignedTo')->where('assigned_to', '!=', null)->get()->groupBy('assignedTo.profil.name');
        $subtaskCount = array_map(function ($subtasks) {
            return collect($subtasks)->count();
        }, $subtasksGrouped->toArray());
        $max = array_key_first($subtaskCount);
        foreach ($subtaskCount as $key => $value) {
            if ($value > $subtaskCount[$max]) $max = $key;
        }
        return [$max => $subtaskCount[$max]];
    }

    private function teamMemberCompletedSubtasks()
    {
        $subtasksGrouped = Subtask::with('assignedTo')->where('assigned_to', '!=', null)->get()->groupBy('assignedTo.profil.name');
        $subtaskCount = array_map(function ($subtasks) {
            return [
                'all' => collect($subtasks)->count(),
                'completed' => collect($subtasks)->filter(fn ($subtask) => $subtask['status'] === 'Completed')->values()->count()
            ];
        }, $subtasksGrouped->toArray());
        $max = array_key_first($subtaskCount);
        foreach ($subtaskCount as $key => $value) {
            if (($value['all'] - $value['completed']) > ($subtaskCount[$max]['all'] - $subtaskCount[$max]['completed'])) $max = $key;
        }
        return [
            $max => $subtaskCount[$max],
            'percentage' => ($subtaskCount[$max]['completed'] * 100) / $subtaskCount[$max]['all'],
            'subtasks' => $subtaskCount
        ];
    }

    private function teamCompletedTasks()
    {
        $taskGrouped = Task::with('team')->get()->groupBy('team.name');
        $taskCount = array_map(function ($tasks) {
            return [
                'all' => collect($tasks)->count(),
                'completed' => collect($tasks)->filter(fn ($task) => $task['status'] === 'Completed')->values()->count()
            ];
        }, $taskGrouped->toArray());
        $max = array_key_first($taskCount);
        foreach ($taskCount as $key => $value) {
            if (($value['all'] - $value['completed']) > ($taskCount[$max]['all'] - $taskCount[$max]['completed'])) $max = $key;
        }
        return [
            $max => $taskCount[$max],
            'percentage' => ($taskCount[$max]['completed'] * 100) / $taskCount[$max]['all'],
            'tasks' => $taskCount
        ];
    }

    private function teamHaveTasks()
    {
        $taskGrouped = Task::with('team')->get()->groupBy('team.name');
        $taskCount = array_map(fn ($tasks) => collect($tasks)->count(), $taskGrouped->toArray());
        $max = array_key_first($taskCount);
        foreach ($taskCount as $key => $value) {
            if ($value > $taskCount[$max]) $max = $key;
        }
        return [$max => $taskCount[$max]];
    }
}
