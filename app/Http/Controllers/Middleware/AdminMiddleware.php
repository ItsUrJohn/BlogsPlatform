<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in
        if (!auth()->check()) {
            return redirect('/login-page');
        }
        
        // Check if user email is admin@blogplatform.com
        if (auth()->user()->email !== 'admin@blogplatform.com') {
            abort(403, 'Unauthorized access. Admin only area.');
        }
        
        return $next($request);
    }
}