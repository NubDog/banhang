<?php

namespace App\Models;

class CartModel
{
    // Mảng chứa các sản phẩm trong giỏ hàng
    public $items = [];
    
    // Tổng số lượng sản phẩm
    public $totalQty = 0;
    
    // Tổng giá tiền
    public $totalPrice = 0;

    // Khởi tạo giỏ hàng
    public function __construct($oldCart = null)
    {
        // Nếu đã có giỏ hàng cũ, lấy thông tin từ giỏ hàng cũ
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add($item, $id)
    {
        // Tạo một mảng chứa thông tin sản phẩm
        $giohang = [
            'qty' => 0, 
            'price' => $item->promotion_price > 0 ? $item->promotion_price : $item->unit_price, 
            'item' => $item
        ];
        
        // Nếu sản phẩm đã có trong giỏ hàng
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $giohang = $this->items[$id];
            }
        }
        
        // Tăng số lượng sản phẩm
        $giohang['qty']++;
        
        // Tính tổng giá của sản phẩm này
        $giohang['price'] = $giohang['item']->promotion_price > 0 
            ? $giohang['item']->promotion_price 
            : $giohang['item']->unit_price;
        
        // Lưu sản phẩm vào giỏ hàng
        $this->items[$id] = $giohang;
        
        // Cập nhật tổng số lượng và tổng giá
        $this->totalQty++;
        $this->totalPrice += $giohang['price'];
    }
    
    // Xóa một sản phẩm khỏi giỏ hàng
    public function removeItem($id)
    {
        // Giảm tổng số lượng và tổng giá
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'] * $this->items[$id]['qty'];
        
        // Xóa sản phẩm khỏi giỏ hàng
        unset($this->items[$id]);
    }
}