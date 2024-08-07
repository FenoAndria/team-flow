<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Services\Lead\LeadDashboardService;
use Illuminate\Http\Request;

class LeadDashboardController extends Controller
{
    protected $leadDashboardService;
    public function __construct(LeadDashboardService $leadDashboardService)
    {
        $this->leadDashboardService = $leadDashboardService;
    }

    public function index()
    {
        $leadDashboard = $this->leadDashboardService->index();
        return response()->json($leadDashboard);
    }
}
