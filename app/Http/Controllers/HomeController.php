<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function __construct()
    {
        // Chia sẻ biến loai_sp với tất cả các view
        $productTypes = ProductType::all();
        View::share('loai_sp', $productTypes);
    }

    public function index()
    {
        $slides = Slide::all();
        
        // Lấy 4 sản phẩm mới nhất (dựa vào created_at)
        $newProducts = Product::orderBy('created_at', 'desc')->take(4)->get();
        
        // Lấy sản phẩm khuyến mãi (promotion_price > 0)
        $promotionProducts = Product::whereNotNull('promotion_price')
            ->where('promotion_price', '>', 0)
            ->take(8)
            ->get();
            
        // Lấy tất cả sản phẩm
        $allProducts = Product::paginate(12);
        
        // Xử lý giỏ hàng
        $cart = Session::get('cart');
        $product_cart = $cart ? $cart->items : [];
        $totalPrice = $cart ? $cart->totalPrice : 0;
        
        return view('pages.home', compact(
            'slides', 
            'newProducts', 
            'promotionProducts', 
            'allProducts',
            'product_cart',
            'totalPrice'
        ));
    }
    
    public function dashboard()
    {
        $totalOrders = \App\Models\Bill::count();
        $totalProducts = \App\Models\Product::count();
        $totalUsers = \App\Models\User::count();
        $totalCategories = \App\Models\ProductType::count();
        
        $recentOrders = \App\Models\Bill::with('customer')
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
    
    // Các phương thức khác giữ nguyên
}