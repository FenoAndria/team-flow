<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignUserToSubtaskRequest;
use App\Http\Requests\SubtaskRequest;
use App\Http\Resources\SubtaskResource;
use App\Models\Subtask;
use App\Models\Task;
use App\Services\SubtaskService;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    protected $subtaskService;
    public function __construct(SubtaskService $subtaskService)
    {
        $this->subtaskService = $subtaskService;
    }
    public function store(SubtaskRequest $request, Task $task)
    {
        $this->authorize('createSubtask', $task);
        try {
            $subtask = $this->subtaskService->store($task, $request->validated());
            return response()->json($subtask);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function assignUser(AssignUserToSubtaskRequest $request, Subtask $subtask)
    {
        $this->authorize('assignUser', $subtask);
        try {
            $assigned = $this->subtaskService->assignUser($subtask, $request->validated());
            return response()->json(new SubtaskResource($assigned)); 
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
