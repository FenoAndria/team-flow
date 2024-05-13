<?php

namespace App\Services;

use App\Models\Subtask;
use Illuminate\Support\Facades\Auth;

class MemberSubtaskService
{
    public function all()
    {
        $user = Auth::user();
        return Subtask::where('assigned_to', $user->id)->get();
    }

    public function update(Subtask $subtask, array $request)
    {
        $subtask->status = $request['status'];
        $subtask->save();
        return $subtask;
    }
}
