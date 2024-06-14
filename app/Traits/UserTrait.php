<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UserTrait
{
    public function assertRole(String $roleName)
    {
        $user = Auth::user();
        return $user->role->name === $roleName;
    }
}
