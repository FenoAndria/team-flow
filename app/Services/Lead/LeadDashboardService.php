<?php

namespace App\Services\Lead;

use App\Enum\StatusTab;
use App\Models\Subtask;
use App\Models\Task;
use App\Models\TeamMember;
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
            ]
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
