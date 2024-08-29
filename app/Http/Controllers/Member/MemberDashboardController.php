<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Services\Member\MemberDashboardService;
use Illuminate\Http\Request;

class MemberDashboardController extends Controller
{
    protected $memberDashboardService;
    public function __construct(MemberDashboardService $memberDashboardService)
    {
        $this->memberDashboardService = $memberDashboardService;
    }

    public function index()
    {
        $memberDashboard = $this->memberDashboardService->index();
        return response()->json($memberDashboard);
    }

}
