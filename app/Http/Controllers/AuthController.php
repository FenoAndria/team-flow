<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
                /** @var \App\Models\User $user  */
                $user = Auth::user();
                $authData['token'] = $user->createToken('LaravelSanctumAuth')->plainTextToken;
                $authData['email'] = $user->email;
                $authData['name'] = $user->name;
                return response()->json($authData);
            } else {
                return response()->json([
                    'error' => 'User unauthenticated',
                ], 401);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = new User();
            $user->fill([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->save();
            return response()->json($user);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
