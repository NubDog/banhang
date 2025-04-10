<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\BillDetail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Bill::with('customer')->orderBy('created_at', 'desc')->get();
        return view('admin.order.order-list', compact('orders'));
    }

    public function show($id)
    {
        $order = Bill::with(['customer', 'orderDetails.product'])->findOrFail($id);
        return view('admin.order.order-detail', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2,3',
        ]);

        $order = Bill::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công');
    }
}