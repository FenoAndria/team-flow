<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->all();
        return response()->json([
            'lead' => UserResource::collection($users['lead']),
            'member' => UserResource::collection($users['member']),
        ]);
    }

    public function show()
    {
        $user = Auth::user();
        return response()->json(new UserResource($user));
    }
}
