<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bill;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductType;

class AdminController extends Controller
{
    /**
     * Hiển thị form đăng nhập admin
     */
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * Xử lý đăng nhập admin
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->isAdmin()) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }
            
            Auth::logout();
            return back()->withErrors([
                'email' => 'Bạn không có quyền truy cập vào trang quản trị.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('email');
    }

    /**
     * Đăng xuất admin
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    /**
     * Hiển thị dashboard admin
     */
    public function dashboard()
    {
        $totalOrders = Bill::count();
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $totalCategories = ProductType::count();
        
        $recentOrders = Bill::with('customer')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();
                        
        return view('admin.dashboard', compact(
            'totalOrders', 
            'totalProducts', 
            'totalUsers', 
            'totalCategories',
            'recentOrders'
        ));
    }
}