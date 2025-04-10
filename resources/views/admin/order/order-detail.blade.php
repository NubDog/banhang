@extends('admin.master')
@section('title', 'Chi tiết đơn hàng')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Chi tiết đơn hàng #{{ $order->id }}</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
    
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin khách hàng
            </div>
            <div class="panel-body">
                <p><strong>Tên khách hàng:</strong> {{ $order->customer->name }}</p>
                <p><strong>Email:</strong> {{ $order->customer->email }}</p>
                <p><strong>Số điện thoại:</strong> {{ $order->customer->phone }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->customer->address }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin đơn hàng
            </div>
            <div class="panel-body">
                <p><strong>Ngày đặt:</strong> {{ $order->date_order }}</p>
                <p><strong>Tổng tiền:</strong> {{ number_format($order->total) }} đ</p>
                <p><strong>Hình thức thanh toán:</strong> {{ $order->payment }}</p>
                <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
                <p>
                    <strong>Trạng thái:</strong> 
                    @if($order->status == 0)
                        <span class="label label-warning">Đang xử lý</span>
                    @elseif($order->status == 1)
                        <span class="label label-primary">Đang giao hàng</span>
                    @elseif($order->status == 2)
                        <span class="label label-success">Đã giao hàng</span>
                    @else
                        <span class="label label-danger">Đã hủy</span>
                    @endif
                </p>
                
                <form action="{{ route('admin.order.update-status', $order->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Cập nhật trạng thái</label>
                        <select class="form-control" name="status">
                            <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Đang giao hàng</option>
                            <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Đã giao hàng</option>
                            <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Chi tiết sản phẩm
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr align="center">
                            <th>STT</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderDetails as $key => $detail)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ number_format($detail->unit_price) }} đ</td>
                            <td>{{ number_format($detail->quantity * $detail->unit_price) }} đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection