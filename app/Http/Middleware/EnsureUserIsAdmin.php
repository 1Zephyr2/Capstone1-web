<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     * Allows admin and staff users to access protected routes.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!Auth::check() || !$user || !in_array($user->role, ['admin', 'staff', 'healthcare_provider'])) {
            abort(403, 'Unauthorized access. Admin or staff privileges required.');
        }

        return $next($request);
    }
}
