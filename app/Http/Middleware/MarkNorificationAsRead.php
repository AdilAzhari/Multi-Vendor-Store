<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MarkNorificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $notification_id = $request->notification_id;

        if ($notification_id) {
            if (auth()->user()) {
                auth()->user()->notifications()->where('id', $notification_id)->first()->markAsRead();
            }
        }

        return $next($request);
    }
}
