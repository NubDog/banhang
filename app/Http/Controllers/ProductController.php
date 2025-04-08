<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function __construct()
    {
        // Chia sẻ biến loai_sp với tất cả các view
        $productTypes = ProductType::all();
        View::share('loai_sp', $productTypes);
    }
    
    public function getProductDetail($id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại');
        }
        
        // Lấy các sản phẩm liên quan (cùng loại)
        $relatedProducts = Product::where('id_type', $product->id_type)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();
            
        // Lấy sản phẩm mới
        $newProducts = Product::orderBy('created_at', 'desc')
            ->take(4)
            ->get();
            
        // Xử lý giỏ hàng
        $cart = Session::get('cart');
        $product_cart = $cart ? $cart->items : [];
        $totalPrice = $cart ? $cart->totalPrice : 0;
        
        return view('pages.product_detail', compact(
            'product',
            'relatedProducts',
            'newProducts',
            'product_cart',
            'totalPrice'
        ));
    }
    
    public function getProductsByType($type_id)
    {
        $productType = ProductType::find($type_id);
        
        if (!$productType) {
            return redirect()->route('home')->with('error', 'Loại sản phẩm không tồn tại');
        }
        
        $products = Product::where('id_type', $type_id)->paginate(8);
        
        // Lấy sản phẩm mới
        $newProducts = Product::orderBy('created_at', 'desc')
            ->take(4)
            ->get();
            
        // Xử lý giỏ hàng
        $cart = Session::get('cart');
        $product_cart = $cart ? $cart->items : [];
        $totalPrice = $cart ? $cart->totalPrice : 0;
        
        return view('pages.product_type', compact(
            'productType',
            'products',
            'newProducts',
            'product_cart',
            'totalPrice'
        ));
    }
}