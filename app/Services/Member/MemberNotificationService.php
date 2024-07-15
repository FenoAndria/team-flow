<?php

namespace App\Services\Member;

use App\Models\MemberNotification;
use App\Traits\TeamTrait;
use Illuminate\Support\Facades\Auth;

class MemberNotificationService
{
    use TeamTrait;
    
    public function show()
    {
        $user = Auth::user();
        return MemberNotification::where('user_id', $user->id)->get();
    }
}
