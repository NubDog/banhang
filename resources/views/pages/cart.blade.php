@extends('layouts.master')

@section('title', 'Giỏ hàng')

@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Giỏ hàng của bạn</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="{{ route('home') }}">Trang chủ</a> / <span>Giỏ hàng</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <div class="table-responsive">
            <!-- Hiển thị thông báo thành công -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            
            <!-- Hiển thị thông báo lỗi -->
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            
            <!-- Nếu giỏ hàng trống -->
            @if(!$products)
            <div class="alert alert-info">
                Giỏ hàng của bạn đang trống. <a href="{{ route('home') }}">Tiếp tục mua sắm</a>
            </div>
            @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product['item']['name'] }}</td>
                        <td>
                            <img src="{{ asset('source/image/product/' . $product['item']['image']) }}" alt="{{ $product['item']['name'] }}" height="80px">
                        </td>
                        <td>
                            @if($product['item']['promotion_price'] > 0)
                            {{ number_format($product['item']['promotion_price']) }}
                            @else
                            {{ number_format($product['item']['unit_price']) }}
                            @endif
                            đồng
                        </td>
                        <td>
                            <div class="quantity-control">
                                <a href="{{ route('reduce-by-one', $product['item']['id']) }}" class="btn btn-xs btn-warning">-</a>
                                <span class="qty-number">{{ $product['qty'] }}</span>
                                <a href="{{ route('add-to-cart', $product['item']['id']) }}" class="btn btn-xs btn-success">+</a>
                            </div>
                        </td>
                        <td>{{ number_format($product['price']) }} đồng</td>
                        <td>
                            <a href="{{ route('remove-from-cart', $product['item']['id']) }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i> Xóa
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Tổng tiền:</strong></td>
                        <td>{{ number_format($totalPrice) }} đồng</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> Tiếp tục mua sắm
                    </a>
                </div>
                <div class="col-sm-6 text-right">
                    @if(Auth::check())
                        <a href="{{ route('dathang') }}" class="btn btn-success">
                            Thanh toán <i class="fa fa-arrow-right"></i>
                        </a>
                    @else
                        <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để thanh toán</p>
                        <a href="{{ route('login') }}" class="btn btn-info">
                            Đăng nhập để thanh toán <i class="fa fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection