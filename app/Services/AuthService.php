<?php

namespace App\Services;

use App\Models\Profil;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(array $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            /** @var \App\Models\User $user  */
            $user = Auth::user();
            $authData['token'] = $user->createToken('LaravelSanctumAuth')->plainTextToken;
            $authData['email'] = $user->email;
            $authData['name'] = $user->profil->name;
            return $authData;
        }
        return false;
    }

    public function register(array $request)
    {
        $user = new User();
        $user->fill([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
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