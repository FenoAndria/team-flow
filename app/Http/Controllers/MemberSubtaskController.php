<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMemberSubtaskRequest;
use App\Models\Subtask;
use App\Services\MemberSubtaskService;
use Illuminate\Http\Request;

class MemberSubtaskController extends Controller
{
    protected $memberSubtaskService;
    public function __construct(MemberSubtaskService $memberSubtaskService)
    {
        $this->memberSubtaskService = $memberSubtaskService;
    }

    public function index()
    {
        $memberSubtasks = $this->memberSubtaskService->all();
        return response()->json($memberSubtasks);
    }

    public function update(UpdateMemberSubtaskRequest $request, Subtask $subtask)
    {
        $this->authorize('updateStatus', $subtask);
        try {
            $updateSubtask = $this->memberSubtaskService->update($subtask, $request->validated());
            return response()->json($updateSubtask);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
