<?php

namespace App\Services\Member;

use App\Enum\StatusTab;
use App\Models\MemberNotification;
use App\Models\Subtask;
use App\Models\TeamMember;
use App\Traits\TeamTrait;
use Illuminate\Support\Facades\Auth;

class MemberDashboardService
{
    use TeamTrait;

    public function index()
    {
        return [
            'subtask_stat' => $this->subtaskStat(),
            'subtask_team_count' => $this->subtaskTeamCount(),
            'subtask_completed' => $this->subtaskCompleted(),
            'latest_notifications' => $this->latestNotifications(),
        ];
    }

    private function latestNotifications()
    {
        $user = Auth::user();
        return MemberNotification::with('team')->where('user_id', $user->id)->take(3)->latest()->get();
    }


    private function subtaskCompleted()
    {
        $user = Auth::user();
        return Subtask::where(['assigned_to' => $user->id, 'status' => 'Completed'])->get()->take(3)->sortByDesc('updated_at')->values();
    }

    private function subtaskTeamCount()
    {
        $user = Auth::user();
        $subtasksGrouped = Subtask::with('task')->where('assigned_to', $user->id)->get();
        $userTeams = TeamMember::with('team')->where('user_id', $user->id)->get();

        $subtasksCount = array_map(function ($team) use ($subtasksGrouped) {
            return [
                'team' => $team['team']['name'],
                'count' => collect($subtasksGrouped)->filter(fn ($subtask) => $subtask['task']['team_id'] === $team['team']['id'])->count()
            ];
        }, $userTeams->toArray());
        return $subtasksCount;
    }

    private function subtaskStat()
    {
        $user = Auth::user();
        $subtasks = Subtask::where('assigned_to', $user->id)->get();
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
