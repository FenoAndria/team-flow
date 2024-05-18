<?php

namespace App\Http\Controllers;

use App\Http\Resources\Member\GetTeamResource;
use App\Services\MemberService;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $memberService;
    public function __construct(MemberService $memberService) {
        $this->memberService = $memberService;
    }

    public function team()
    {
        $team = $this->memberService->team();
        return response()->json(GetTeamResource::collection($team));
    }
}
