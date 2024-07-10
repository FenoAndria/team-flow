<?php

namespace App\Traits;

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

    public function getAllUsers()
    {
        return User::whereHas('role', fn ($query) => $query->where('name', 'User'))->get();
    }

    public function getUserTeams($userId)
    {
        return TeamMember::where('user_id', $userId)->get();
    }
}
