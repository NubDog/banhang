@extends('admin.master')
@section('title', 'Danh sách đơn hàng')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh sách đơn hàng</h1>
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
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center">
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Hình thức thanh toán</th>
                <th>Ghi chú</th>
                <th>Trạng thái</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr class="odd gradeX" align="center">
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer->name }}</td>
                <td>{{ $order->date_order }}</td>
                <td>{{ number_format($order->total) }} đ</td>
                <td>{{ $order->payment }}</td>
                <td>{{ $order->note }}</td>
                <td>
                    @if($order->status == 0)
                        <span class="label label-warning">Đang xử lý</span>
                    @elseif($order->status == 1)
                        <span class="label label-primary">Đang giao hàng</span>
                    @elseif($order->status == 2)
                        <span class="label label-success">Đã giao hàng</span>
                    @else
                        <span class="label label-danger">Đã hủy</span>
                    @endif
                </td>
                <td class="center">
                    <a href="{{ route('admin.order.detail', $order->id) }}">
                        <i class="fa fa-eye fa-fw"></i> Chi tiết
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection