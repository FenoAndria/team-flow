<?php

namespace App\Http\Middleware;

use App\Exceptions\CustomForbiddenException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role->name != 'Admin') {
            throw new CustomForbiddenException();
        }
        return $next($request);
    }
}
