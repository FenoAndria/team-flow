<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Resources\Member\MemberNotificationResource;
use App\Services\Member\MemberNotificationService;
use Illuminate\Http\Request;

class MemberNotificationController extends Controller
{
    protected $teamNotificationService;
    public function __construct(MemberNotificationService $memberNotificationService)
    {
        $this->memberNotificationService = $memberNotificationService;
    }

    public function show()
    {
        $memberNotification = $this->memberNotificationService->show();
        return response()->json(MemberNotificationResource::collection($memberNotification));
    }
}
