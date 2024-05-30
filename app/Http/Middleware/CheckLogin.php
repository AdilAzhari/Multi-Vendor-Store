<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (!$user)  abort(403, 'You are not Logged in and not authorized to access this route');

        if ($user->type === 'user') return $next($request);

        if ($user->type !== 'admin') abort(403, 'You Dont have authorizaion to access this route');

        return $next($request);
    }
}
