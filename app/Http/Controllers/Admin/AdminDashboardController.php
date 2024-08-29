<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminDashboardService;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    protected $adminDashboardService;
    public function __construct(AdminDashboardService $adminDashboardService)
    {
        $this->adminDashboardService = $adminDashboardService;
    }
    
    public function index()
    {
        $adminDashboard = $this->adminDashboardService->index();
        return response()->json($adminDashboard);
    }
}
