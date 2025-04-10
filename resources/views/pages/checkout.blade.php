@extends('layouts.master')

@section('title', 'Đặt hàng')

@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Đặt hàng</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="{{ route('home') }}">Trang chủ</a> / <span>Đặt hàng</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
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
        
        <form action="{{ route('dathang') }}" method="post" class="beta-form-checkout">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <h4>Thông tin đặt hàng</h4>
                    <div class="space20">&nbsp;</div>

                    <div class="form-block">
                        <label for="name">Họ tên*</label>
                        <input type="text" name="name" id="name" required>
                    </div>
                    
                    <div class="form-block">
                        <label>Giới tính*</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="gender-male" name="gender" value="nam" checked>
                            <label class="form-check-label" for="gender-male">Nam</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="gender-female" name="gender" value="nữ">
                            <label class="form-check-label" for="gender-female">Nữ</label>
                        </div>
                    </div>

                    <div class="form-block">
                        <label for="email">Email*</label>
                        <input type="email" name="email" id="email" required>
                    </div>

                    <div class="form-block">
                        <label for="address">Địa chỉ*</label>
                        <input type="text" name="address" id="address" required>
                    </div>

                    <div class="form-block">
                        <label for="phone_number">Điện thoại*</label>
                        <input type="text" name="phone_number" id="phone_number" required>
                    </div>

                    <div class="form-block">
                        <label for="notes">Ghi chú</label>
                        <textarea name="notes" id="notes"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="your-order">
                        <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                        <div class="your-order-body">
                            <div class="your-order-item">
                                @if(isset($products) && count($products) > 0)
                                    @foreach($products as $product)
                                    <div class="media">
                                        <img width="100" src="{{ asset('source/image/product/' . $product['item']['image']) }}" alt="{{ $product['item']['name'] }}" class="pull-left">
                                        <div class="media-body">
                                            <p class="font-large">{{ $product['item']['name'] }}</p>
                                            <span class="color-gray your-order-info">Số lượng: {{ $product['qty'] }}</span>
                                            <span class="color-gray your-order-info">Đơn giá: 
                                                @if($product['item']['promotion_price'] > 0)
                                                {{ number_format($product['item']['promotion_price']) }}
                                                @else
                                                {{ number_format($product['item']['unit_price']) }}
                                                @endif
                                                đồng
                                            </span>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <p>Không có sản phẩm trong giỏ hàng</p>
                                @endif
                                <div class="clearfix"></div>
                            </div>
                            <div class="your-order-item">
                                <div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
                                <div class="pull-right"><h5 class="color-black">{{ number_format($totalPrice) }} đồng</h5></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="your-order-head"><h5>Phương thức thanh toán</h5></div>
                        
                        <div class="your-order-body">
                            <ul class="payment_methods methods">
                                <li class="payment_method_bacs">
                                    <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
                                    <label for="payment_method_bacs">Thanh toán khi nhận hàng (COD) </label>
                                    <div class="payment_box payment_method_bacs" style="display: block;">
                                        Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
                                    </div>						
                                </li>

                                <li class="payment_method_cheque">
                                    <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
                                    <label for="payment_method_cheque">Chuyển khoản </label>
                                    <div class="payment_box payment_method_cheque" style="display: none;">
                                        Chuyển tiền đến tài khoản sau:
                                        <br>- Số tài khoản: 123 456 789
                                        <br>- Chủ TK: Nguyễn A
                                        <br>- Ngân hàng ACB, Chi nhánh TPHCM
                                    </div>						
                                </li>
                            </ul>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="beta-btn primary">Đặt hàng <i class="fa fa-chevron-right"></i></button>
                        </div>
                    </div> <!-- .your-order -->
                </div>
            </div>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Hiển thị/ẩn phương thức thanh toán
        $('input[name="payment_method"]').change(function() {
            $('.payment_box').hide();
            $(this).siblings('.payment_box').show();
        });
    });
</script>
@endsection