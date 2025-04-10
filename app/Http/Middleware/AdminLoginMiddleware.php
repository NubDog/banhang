<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            $user = Auth::user();
            if($user->level == 1 || $user->level == 2){
                return $next($request);
            }
            else {
                return redirect('/dang-nhap')->with(['flag'=>'danger','message'=>'Bạn không có quyền truy cập trang admin']);
            }
        }
        else {
            return redirect('/dang-nhap')->with(['flag'=>'danger','message'=>'Vui lòng đăng nhập để tiếp tục']);
        }
    }
}
