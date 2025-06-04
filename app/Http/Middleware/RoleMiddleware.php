<?php

namespace App\Http\Middleware;

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
    public function handle(Request $request, Closure $next,  $roles = null): Response
    {
        if (!session('loginId')) {
            return redirect('/')->with('fail', 'Please login first!');
        }

        $userRole = session('userRole');

        if (!$roles) {
            return $next($request); // Allow access if no roles specified
        }
            
        if (!$userRole || !in_array($userRole, explode(',', $roles))) {
            return redirect('/unauthorized')->with('fail', 'You do not have permission to access this page!');
        }

        return $next($request);
    }
}
