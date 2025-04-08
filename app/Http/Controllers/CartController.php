<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);
        
        return redirect()->back();
    }
    
    public function removeFromCart($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        
        return redirect()->back();
    }
    
    public function getCheckout()
    {
        if (!Session::has('cart')) {
            return redirect('trang-chu');
        }
        
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $productTypes = ProductType::all();
        
        return view('cart.checkout', [
            'cart' => Session::get('cart'),
            'product_cart' => $cart->items,
            'totalPrice' => $cart->totalPrice,
            'totalQty' => $cart->totalQty,
            'productTypes' => $productTypes
        ]);
    }
    
    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('home');
        }
        
        $cart = Session::get('cart');
        
        $bill = new Bill();
        $bill->id_customer = $request->id_customer;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $request->payment;
        $bill->note = $request->note;
        $bill->save();
        
        foreach ($cart->items as $key => $value) {
            $billDetail = new BillDetail();
            $billDetail->id_bill = $bill->id;
            $billDetail->id_product = $key;
            $billDetail->quantity = $value['qty'];
            $billDetail->unit_price = $value['price'] / $value['qty'];
            $billDetail->save();
        }
        
        Session::forget('cart');
        
        return redirect()->route('home')->with('success', 'Đặt hàng thành công');
    }
}

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $giohang = ['qty' => 0, 'price' => $item->promotion_price == 0 ? $item->unit_price : $item->promotion_price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $giohang = $this->items[$id];
            }
        }
        $giohang['qty']++;
        $giohang['price'] = $item->promotion_price == 0 ? $item->unit_price * $giohang['qty'] : $item->promotion_price * $giohang['qty'];
        $this->items[$id] = $giohang;
        $this->totalQty++;
        $this->totalPrice += $item->promotion_price == 0 ? $item->unit_price : $item->promotion_price;
    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}