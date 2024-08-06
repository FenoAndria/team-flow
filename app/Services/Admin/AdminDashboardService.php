<?php

namespace App\Services\Admin;

use App\Models\AdminNotification;
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
                'team_member_subtasks' => $this->teamMemberSubtasks(), // Team member with the most subtasks
                'team_member_appearance' => $this->teamMemberAppearance(), // Team member who appears most in teams
                'team_member_completed_subtasks' => $this->teamMemberCompletedSubtasks(), // Team member that has completed the most subtasks
                'team_completed_tasks' => $this->teamCompletedTasks(), // Team that has completed the most tasks
                'team_have_tasks' => $this->teamHaveTasks(), // Team with the most tasks
            ],
            // Latest tasks
            'latest_tasks' => $this->latestTasks(),
            // Latest notif
            'latest_notifications' => $this->latestNotifications(),
        ];
    }

    private function latestTasks()
    {
        $tasks = Task::take(3)->with('team')->orderByDesc('created_at')->get();
        return $tasks;
    }

    private function latestNotifications()
    {
        $notifications = AdminNotification::take(3)->with('user.profil')->with('team')->orderByDesc('created_at')->get();
        return $notifications;
    }

    private function teamMemberAppearance()
    {
        $teamMemberGrouped = TeamMember::with('team')->get()->groupBy('user.profil.name');
        $teamCount = array_map(fn ($teamMember) => collect($teamMember)->count(), $teamMemberGrouped->toArray());
        $max = array_key_first($teamCount);
        foreach ($teamCount as $key => $value) {
            if ($value > $teamCount[$max]) $max = $key;
        }
        return [
            'team_member' => $max,
            'count' => $this->getFormattedNumber($teamCount[$max])
        ];
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
        return [
            'team_member' => $max,
            'count' => $this->getFormattedNumber($subtaskCount[$max])
        ];
    }

    private function teamMemberCompletedSubtasks()
    {
        $subtasksGrouped = Subtask::with('assignedTo')->where('assigned_to', '!=', null)->get()->groupBy('assignedTo.profil.name');
        $subtaskCount = array_map(function ($subtasks) {
            return [
                'all' => $this->getFormattedNumber(collect($subtasks)->count()),
                'completed' => $this->getFormattedNumber(collect($subtasks)->filter(fn ($subtask) => $subtask['status'] === 'Completed')->values()->count())
            ];
        }, $subtasksGrouped->toArray());
        $max = array_key_first($subtaskCount);
        foreach ($subtaskCount as $key => $value) {
            if (($value['all'] - $value['completed']) > ($subtaskCount[$max]['all'] - $subtaskCount[$max]['completed'])) $max = $key;
        }
        return [
            'team_member' => $max,
            'count' => ($subtaskCount[$max]),
            'percentage' => ($subtaskCount[$max]['completed'] * 100) / $subtaskCount[$max]['all'],
            'subtasks' => $subtaskCount
        ];
    }

    private function teamCompletedTasks()
    {
        $taskGrouped = Task::with('team')->get()->groupBy('team.name');
        $taskCount = array_map(function ($tasks) {
            return [
                'all' => $this->getFormattedNumber(collect($tasks)->count()),
                'completed' => $this->getFormattedNumber(collect($tasks)->filter(fn ($task) => $task['status'] === 'Completed')->values()->count())
            ];
        }, $taskGrouped->toArray());
        $max = array_key_first($taskCount);
        foreach ($taskCount as $key => $value) {
            if (($value['all'] - $value['completed']) > ($taskCount[$max]['all'] - $taskCount[$max]['completed'])) $max = $key;
        }
        return [
            'team' => $max,
            'count' => $taskCount[$max],
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
        return [
            'team' => $max,
            'count' => $this->getFormattedNumber($taskCount[$max])
        ];
    }

    public function formatNumber($number)
    {
        return str_pad($number, 2, '0', 'STR_PAD_LEFT');
    }
}
