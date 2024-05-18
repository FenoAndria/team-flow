<?php

namespace App\Services;

use App\Models\Subtask;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Auth;

class MemberService
{
    public function team()
    {
        $user = Auth::user();
        return TeamMember::where('user_id', $user->id)->get();
    }
}
