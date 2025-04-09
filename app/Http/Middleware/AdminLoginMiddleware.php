<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminLoginMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()) {
            $user = Auth::user();
            if($user->level == 1 || $user->level == 2) {
                return $next($request);
            }
            return redirect('/dang-nhap')->with([
                'flag' => 'danger',
                'message' => 'Bạn không có quyền truy cập trang admin'
            ]);
        }
        return redirect('/dang-nhap')->with([
            'flag' => 'danger',
            'message' => 'Vui lòng đăng nhập để truy cập'
        ]);
    }
}
