<?php

namespace App\Services;

use App\Models\User;
use App\Traits\TeamTrait;

class UserService
{
    use TeamTrait;
    public function all()
    {
        // Get all users non-Admin
        $users = User::whereHas('role', function ($query) {
            return $query->where('name', 'User');
        })->get();
        return [
            'lead' => $users->filter(
                fn ($user) => $this->isLead($user['id'])
            )->values(),
            'member' => $users->filter(
                fn ($user) => !$this->isLead($user['id'])
            )->values()
        ];
    }
}
