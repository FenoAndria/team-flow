<?php

namespace App\Services;

use App\Models\Profil;
use App\Models\Role;
use App\Models\User;
use App\Traits\TeamTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    use TeamTrait;
    public function login(array $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            /** @var \App\Models\User $user  */
            $user = Auth::user();
            $authData['token'] = $user->createToken('LaravelSanctumAuth')->plainTextToken;
            $authData['id'] = $user->id;
            $authData['email'] = $user->email;
            $authData['name'] = $user->profil->name;
            $authData['role'] = $user->role->name == 'Admin' ? $user->role->name : ($this->isLead($user->id) ? 'Lead' : 'User');
            return $authData;
        }
        return false;
    }

    public function register(array $request)
    {
        $roleUser = Role::where('name', 'User')->first();
        $user = new User();
        $user->fill([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_id' => $roleUser->id,
        ]);
        $user->save();
        $profil = new Profil();
        $profil->fill([
            'name' => $request['name'],
            'user_id' => $user->id,
        ]);
        $profil->save();
        return $user;
    }
}
