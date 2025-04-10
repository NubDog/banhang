<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }
        
        $user = Auth::user();
        if (!$user->isAdmin()) {
            return redirect()->route('admin.login')->with('error', 'Bạn không có quyền truy cập vào trang quản trị.');
        }
        
        return $next($request);
    }
}
