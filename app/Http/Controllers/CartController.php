<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    public function __construct()
    {
        // Chia sẻ biến loai_sp với tất cả các view
        $productTypes = ProductType::all();
        View::share('loai_sp', $productTypes);
    }
    
    // Thêm sản phẩm vào giỏ hàng
    public function addToCart(Request $request, $id)
    {
        // Tìm sản phẩm theo id
        $product = Product::find($id);
        
        // Nếu không tìm thấy sản phẩm, chuyển hướng về trang chủ
        if (!$product) {
            return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại');
        }
        
        // Lấy giỏ hàng hiện tại từ session
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        
        // Tạo giỏ hàng mới từ giỏ hàng cũ
        $cart = new CartModel($oldCart);
        
        // Thêm sản phẩm vào giỏ hàng
        $cart->add($product, $id);
        
        // Lưu giỏ hàng vào session
        $request->session()->put('cart', $cart);
        
        // Chuyển hướng về trang trước đó
        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    }
    
    // Thêm nhiều sản phẩm vào giỏ hàng
    public function addManyToCart(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại');
        }
        
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new CartModel($oldCart);
        
        $quantity = $request->input('qty', 1);
        $cart->addMany($product, $id, $quantity);
        
        $request->session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    }
    
    // Giảm số lượng sản phẩm trong giỏ hàng
    public function reduceByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        if (!$oldCart) {
            return redirect()->route('home');
        }
        
        $cart = new CartModel($oldCart);
        $cart->reduceByOne($id);
        
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        
        return redirect()->back()->with('success', 'Đã giảm số lượng sản phẩm');
    }
    
    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($id)
    {
        // Lấy giỏ hàng hiện tại từ session
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        
        // Nếu không có giỏ hàng, chuyển hướng về trang chủ
        if (!$oldCart) {
            return redirect()->route('home');
        }
        
        // Tạo giỏ hàng mới từ giỏ hàng cũ
        $cart = new CartModel($oldCart);
        
        // Xóa sản phẩm khỏi giỏ hàng
        $cart->removeItem($id);
        
        // Nếu giỏ hàng trống, xóa session
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        
        // Chuyển hướng về trang trước đó
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }
    
    // Hiển thị trang giỏ hàng
    public function showCart()
    {
        // Nếu không có giỏ hàng, hiển thị giỏ hàng trống
        if (!Session::has('cart')) {
            return view('pages.cart', [
                'products' => null,
                'totalPrice' => 0,
                'totalQty' => 0
            ]);
        }
        
        // Lấy giỏ hàng từ session
        $oldCart = Session::get('cart');
        $cart = new CartModel($oldCart);
        
        // Truyền dữ liệu giỏ hàng vào view
        return view('pages.cart', [
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice,
            'totalQty' => $cart->totalQty
        ]);
    }
}