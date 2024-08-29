<?php

namespace App\Services\Lead;

use App\Enum\StatusTab;
use App\Models\Subtask;
use App\Models\Task;
use App\Models\TeamInvitation;
use App\Models\TeamMember;
use App\Models\TeamNotification;
use App\Traits\TeamTrait;

class LeadDashboardService
{
    use TeamTrait;

    public function index()
    {
        return [
            'global_stat' => [
                'team_member_stat' => $this->teamMemberStat(),
                'task_stat' => $this->taskStat(),
                'subtask_stat' => $this->subtaskStat(),
            ],
            'particular_stat' => [
                'team_member_subtasks' => $this->teamMemberSubtasks(), // Team member with the most subtasks in the team
                'team_member_completed_subtasks' => $this->teamMemberCompletedSubtasks(), // Team member that has completed the most subtasks
            ],
            'recent_completed_tasks' => $this->recentCompletedTasks(), // 3 recent completed tasks
            // Latest notif
            'latest_notifications' => $this->latestNotifications(),
            // New member
            'new_member' => $this->newMember()
        ];
    }

    private function newMember()
    {
        $team = $this->getTeam();
        return TeamInvitation::with('user.profil')->where('team_id', $team->id)->where('status', 'Accepted')->orderByDesc('updated_at')->get()->take(3);
    }

    private function latestNotifications()
    {
        $team = $this->getTeam();
        $notifications = TeamNotification::with('user.profil')->where('team_id', $team->id)->take(3)->orderByDesc('created_at')->get();
        return $notifications;
    }

    private function recentCompletedTasks()
    {
        $team = $this->getTeam();
        return collect($team->task)->filter(fn ($task) => $task->status === 'Completed')->take(3)->sortByDesc('updated_at')->values();
    }

    private function teamMemberCompletedSubtasks()
    {
        $team = $this->getTeam();
        $subtasksGrouped = Subtask::with('assignedTo')->whereHas('task', function ($query) use ($team) {
            return $query->where('team_id', $team->id);
        })->where('assigned_to', '!=', null)->get()->groupBy('assignedTo.profil.name');
        $subtaskCount = array_map(function ($subtasks) {
            $all = $this->getFormattedNumber(collect($subtasks)->count());
            $completed = $this->getFormattedNumber(collect($subtasks)->filter(fn ($subtask) => $subtask['status'] === 'Completed')->values()->count());
            return [
                'all' => $all,
                'completed' => $completed,
                'percentage' => round(($completed * 100) / $all, 2)
            ];
        }, $subtasksGrouped->toArray());
        $max = array_key_first($subtaskCount);

        foreach ($subtaskCount as $key => $value) {
            if ($value['percentage'] > $subtaskCount[$max]['percentage']) $max = $key;
        }
        return [
            'team_member' => $max,
            'count' => ($subtaskCount[$max]),
            // 'subtasks' => $subtaskCount
        ];
    }

    private function teamMemberSubtasks()
    {
        $team = $this->getTeam();
        $subtasksGrouped = Subtask::with('assignedTo')->whereHas('task', function ($query) use ($team) {
            return $query->where('team_id', $team->id);
        })->where('assigned_to', '!=', null)->get()->groupBy('assignedTo.profil.name');
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

    private function teamMemberStat()
    {
        $team = $this->getTeam();
        $teamSubtasks = Subtask::whereHas('task', function ($query) use ($team) {
            return $query->where('team_id', $team->id);
        })->where('assigned_to', '!=', null)->get();
        $haveSubtask = collect($team->member)->filter(function ($teamMember) use ($teamSubtasks) {
            return collect($teamSubtasks)->contains('assigned_to', $teamMember->user_id);
        })->count();
        $noSubtask = collect($team->member)->filter(function ($teamMember) use ($teamSubtasks) {
            return !collect($teamSubtasks)->contains('assigned_to', $teamMember->user_id);
        })->count();
        return [
            'all' => $this->getFormattedNumber(count($team->member)),
            'subtask' => [
                'have_subtask' => $this->getFormattedNumber($haveSubtask),
                'no_subtask' => $this->getFormattedNumber($noSubtask),
            ],
        ];
    }

    private function taskStat()
    {
        $tasks = Task::where('team_id', $this->getTeam()->id)->get();
        $tasksGroupedByStatus = $tasks->groupBy('status');
        $taskStatus = StatusTab::TASK_STATUS;
        $tasksGrouped = collect($taskStatus)->mapWithKeys(function ($status) use ($tasksGroupedByStatus) {
            return [
                $status => $this->getFormattedNumber($tasksGroupedByStatus->get($status, collect())->count())
            ];
        });
        return [
            'all' => $this->getFormattedNumber(count($tasks)),
            ...$tasksGrouped,
        ];
    }

    private function subtaskStat()
    {
        $team = $this->getTeam();
        $subtasks = Subtask::whereHas('task', function ($query) use ($team) {
            return $query->where('team_id', $team->id);
        })->where('assigned_to', '!=', null)->get();
        $subtasksGroupedByStatus = $subtasks->groupBy('status');
        $subtasksGrouped = collect(StatusTab::TASK_STATUS)->mapWithKeys(function ($status) use ($subtasksGroupedByStatus) {
            return [
                $status => $this->getFormattedNumber($subtasksGroupedByStatus->get($status, collect())->count())
            ];
        });
        return [
            'all' => $this->getFormattedNumber(count($subtasks)),
            ...$subtasksGrouped
        ];
    }
}
