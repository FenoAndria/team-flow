<?php

namespace App\Traits;

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

    public function getAllUsers()
    {
        return User::whereHas('role', fn ($query) => $query->where('name', 'User'))->get();
    }

    public function getUserTeams($userId)
    {
        return TeamMember::where('user_id', $userId)->get();
    }

    protected function getUsersGrouped()
    {
        $allUsers = $this->getAllUsers();
        return [
            'all' => count($allUsers),
            'team_lead' => count($allUsers->filter(
                fn ($user) => Team::where('lead_id', $user->id)->exists()
            )->values()),
            'team_member' => count($allUsers->filter(
                fn ($user) => TeamMember::where('user_id', $user->id)->exists()
            )->values()),
            'others' => count($allUsers->filter(
                fn ($user) => !Team::where('lead_id', $user->id)->exists() && !TeamMember::where('user_id', $user->id)->exists()
            )->values()),

        ];
    }
}
