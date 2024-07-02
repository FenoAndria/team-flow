<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Team;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MessageController extends Controller
{
    protected $messageService;
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function store(MessageRequest $request, Team $team)
    {
        $this->authorize('storeMessage', $team);
        try {
            $message = $this->messageService->store($request->validated(), $team);
            Cache::put('updated', true);
            return response()->json(new MessageResource($message));
        } catch (\Throwable $e) { 
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function showLeadMessages()
    {
        $message = $this->messageService->showLeadMessages();
        return response()->json(MessageResource::collection($message));
    }
}
