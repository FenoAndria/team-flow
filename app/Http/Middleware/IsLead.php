<?php

namespace App\Http\Middleware;

use App\Exceptions\CustomForbiddenException;
use App\Models\Team;
use App\Traits\TeamTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsLead
{
    use TeamTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->isLead($request->user()->id)) {
            throw new CustomForbiddenException();
        }
        return $next($request);
    }
}
