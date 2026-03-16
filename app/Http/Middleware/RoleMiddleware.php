<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        $user = $request->user();


        // Make sure user is authenticated
        if (!$user) {
            abort(403, 'Unauthorized');
        }

    
        // If user has no role column
        if (!isset($user->role)) {
            abort(403, 'Role not defined');
        }

        // Check if user's role matches any of the allowed roles
        if (!in_array($user->role, $roles)) {
            abort(403, 'You do not have permission to access this area.');
        }   

        return $next($request);
    }
}
