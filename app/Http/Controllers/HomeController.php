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
        
        // Lấy sản phẩm khuyến mãi (is_promotion = 1)
        $promotionProducts = Product::where('is_promotion', 1)->take(8)->get();
            
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
    
    // Các phương thức khác giữ nguyên
}