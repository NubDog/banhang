<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\bunmammientrung;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $code = Str::random(6); // Tạo mã xác nhận ngẫu nhiên
        
        // Dữ liệu gửi qua email
        $data = [
            'email' => $request->email,
            'code' => $code
        ];

        Mail::to($request->email)->send(new bunmammientrung($data));

        return back()->with('status', 'Chúng tôi đã gửi email khôi phục mật khẩu cho bạn!');
    }
}