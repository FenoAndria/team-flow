<?php

namespace App\Services;

use App\Models\Subtask;
use Illuminate\Support\Facades\Auth;

class MemberSubtaskService
{

    public function index()
    {
        $user = Auth::user();
        return Subtask::where('assigned_to', $user->id)->get();
    }

    public function update(Subtask $subtask, array $request)
    {
        if ($request && $request['status']) {
            $subtask->status = $request['status'];
            $subtask->save();
            if ($subtask->status == 'In Progress' && $subtask->task->status == 'Todo') {
                $subtask->task->status = 'In Progress';
                $subtask->task->save();
            }
        }
        return $subtask;
    }
}
