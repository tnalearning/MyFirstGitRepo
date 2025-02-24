<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, string $roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $user = Auth::user();
        $roleList = explode(',', $roles); // Allow multiple roles like 'User,Agent'

        if (!$user->hasAnyRole($roleList)) {
            return redirect('/')->with('error', 'Unauthorized Access.');
        }

        return $next($request);
    }
}
