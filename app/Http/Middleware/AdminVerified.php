<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('admin_verified')) {
            return redirect()->route('admin.verify');
        }

        return $next($request);
    }
}
