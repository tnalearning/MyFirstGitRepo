<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login')->with('error', 'Please log in first.');
        }

        if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin')) {
            return $next($request);
        }

        // If the user is logged in but does not have the correct role, abort with a 403
        abort(403, 'Unauthorized Access');
    }

}
