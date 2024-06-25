<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Traits\TeamTrait;
use Illuminate\Http\Request;

class TeamTaskController extends Controller
{
    use TeamTrait;

    public function index()
    {
        $tasks = $this->getTeam()->task;
        return response()->json(TaskResource::collection($tasks));
    }

    
    public function show(Task $task)
    {
        $this->authorize('show', $task);
        return response()->json(new TaskResource($task));
    }

}
