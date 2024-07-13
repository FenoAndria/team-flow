<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Http\Resources\Lead\TeamNotificationResource;
use App\Services\Lead\TeamNotificationService;
use Illuminate\Http\Request;

class TeamNotificationController extends Controller
{
    protected $teamNotificationService;
    public function __construct(TeamNotificationService $teamNotificationService)
    {
        $this->teamNotificationService = $teamNotificationService;
    }

    public function show()
    {
        $teamNotification = $this->teamNotificationService->show();
        return response()->json(TeamNotificationResource::collection($teamNotification));
    }
}
