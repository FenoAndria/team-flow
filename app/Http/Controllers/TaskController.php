<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    
    public function index()
    {
        $tasks = $this->taskService->all();
        return response()->json(TaskResource::collection($tasks));
    }

    public function store(TaskRequest $request)
    {
        try {
            $task = $this->taskService->store($request->validated());
            return response()->json($task);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
   

}
