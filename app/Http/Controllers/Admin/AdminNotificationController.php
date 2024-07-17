<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminNotificationResource;
use App\Services\Admin\AdminNotificationService;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    protected $teamNotificationService;
    public function __construct(AdminNotificationService $adminNotificationService)
    {
        $this->adminNotificationService = $adminNotificationService;
    }

    public function show()
    {
        $adminNotification = $this->adminNotificationService->show();
        // return response()->json(($adminNotification));
        return response()->json(AdminNotificationResource::collection($adminNotification));
    }
}
