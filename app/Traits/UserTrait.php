<?php

namespace App\Traits;

use App\Models\LeadInvitation;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait UserTrait
{
    protected function assertRole(String $roleName)
    {
        $user = Auth::user();
        return $user->role->name === $roleName;
    }

}
