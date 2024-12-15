<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $userRole = session('user_type');
    
        if (!in_array($userRole, $roles)) {
            return redirect()->route('login')->with('error', 'Unauthorized access');
        }
    
        return $next($request);
    }
    
}