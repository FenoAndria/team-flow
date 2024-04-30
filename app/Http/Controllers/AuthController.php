<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        try {
            $login = $this->authService->login($request->validated());
            if ($login) {
                return response()->json($login);
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
            $newUser = $this->authService->register($request->validated());
            $login = $this->authService->login($request->validated());
            return response()->json($login);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
