<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Models\Customer;

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
    
    // Hiển thị trang đặt hàng
    public function getCheckout()
    {
        if (!Session::has('cart')) {
            return redirect()->route('home')->with('error', 'Giỏ hàng trống');
        }
        
        $oldCart = Session::get('cart');
        $cart = new CartModel($oldCart);
        
        return view('pages.checkout', [
            'cart' => $cart,
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice,
            'totalQty' => $cart->totalQty
        ]);
    }
    
    // Xử lý đặt hàng
    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('home')->with('error', 'Giỏ hàng trống');
        }
        
        $cart = Session::get('cart');
        
        // Lưu thông tin khách hàng
$customer = new Customer();
        $customer->name = $request->input('name');
        $customer->gender = $request->input('gender');
        $customer->email = $request->input('email');
        $customer->address = $request->input('address');
        $customer->phone_number = $request->input('phone_number');
        $customer->note = $request->input('notes');
        $customer->save();
        
        // Lưu thông tin đơn hàng
$bill = new \App\Models\Bill();
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $request->input('payment_method');
        $bill->note = $request->input('notes');
        $bill->save();
        
        // Lưu chi tiết đơn hàng
        foreach ($cart->items as $key => $value) {
            $bill_detail = new \App\Models\BillDetail();
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = $value['price'] / $value['qty'];
            $bill_detail->save();
        }
        
        // Xóa giỏ hàng
        Session::forget('cart');
        
        return redirect()->route('home')->with('success', 'Đặt hàng thành công');
    }
}