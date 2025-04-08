<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        
        // Lấy sản phẩm mới (new = 1)
        $newProducts = Product::where('new', 1)->take(8)->get();
        
        // Lấy sản phẩm khuyến mãi (promotion_price > 0)
        $promotionProducts = Product::whereNotNull('promotion_price')
            ->where('promotion_price', '>', 0)
            ->take(8)
            ->get();
            
        // Lấy tất cả sản phẩm
        $allProducts = Product::paginate(12);
        
        // Lấy danh mục sản phẩm
        $productTypes = ProductType::all();
        
        // Xử lý giỏ hàng
        $cart = Session::get('cart');
        $product_cart = $cart ? $cart->items : [];
        $totalPrice = $cart ? $cart->totalPrice : 0;
        
        return view('pages.home', compact(
            'slides', 
            'newProducts', 
            'promotionProducts', 
            'allProducts',
            'productTypes',
            'product_cart',
            'totalPrice'
        ));
    }
    
    public function getAbout()
    {
        $productTypes = ProductType::all();
        return view('pages.about', compact('productTypes'));
    }
    
    public function getContact()
    {
        $productTypes = ProductType::all();
        return view('pages.contact', compact('productTypes'));
    }
    
    public function getSearch(Request $request)
    {
        $key = $request->key;
        $products = Product::where('name', 'like', '%'.$key.'%')
            ->orWhere('description', 'like', '%'.$key.'%')
            ->paginate(8);
        $productTypes = ProductType::all();
        
        return view('product.search', compact('products', 'key', 'productTypes'));
    }
}