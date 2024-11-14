<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the session has a user type and if it matches the required role
        if ($request->session()->get('user_type') !== $role) {
            return redirect()->route('login')->withErrors(['Unauthorized access']);
        }

        return $next($request);
    }
}
