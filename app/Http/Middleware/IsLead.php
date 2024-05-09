<?php

namespace App\Http\Middleware;

use App\Exceptions\CustomForbiddenException;
use App\Models\Team;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsLead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isLead = Team::where('lead_id', $request->user()->id)->first();
        if (!$isLead) {
            throw new CustomForbiddenException();
        }
        return $next($request);
    }
}
