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
}
