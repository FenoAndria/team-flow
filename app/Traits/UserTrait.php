<?php

namespace App\Traits;

use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait UserTrait
{
    use NumberFormatTrait;

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
            'all' => $this->getFormattedNumber(count($allUsers)),
            'team_lead' =>$this->getFormattedNumber(count($allUsers->filter(
                fn ($user) => Team::where('lead_id', $user->id)->exists()
            )->values())),
            'team_member' => $this->getFormattedNumber(count($allUsers->filter(
                fn ($user) => TeamMember::where('user_id', $user->id)->exists()
            )->values())),
            'others' => $this->getFormattedNumber(count($allUsers->filter(
                fn ($user) => !Team::where('lead_id', $user->id)->exists() && !TeamMember::where('user_id', $user->id)->exists()
            )->values())),

        ];
    }
}
