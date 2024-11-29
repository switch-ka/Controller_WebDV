<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $userType = session('user_type'); // Retrieve the user type from the session

        if (!in_array($userType, $roles)) {
            // If the user does not have the correct role, redirect to login
            return redirect()->route('login')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}