<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; // Make sure to import this
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Use the Auth facade to get the user and check role
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Return 403 if the role doesn't match
        abort(403, 'Unauthorized action.');
    }
}
