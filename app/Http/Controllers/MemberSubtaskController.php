<?php

namespace App\Http\Controllers;

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
}
