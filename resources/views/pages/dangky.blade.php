@extends('layouts.master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Đăng ký</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="{{ route('home') }}">Trang chủ</a> / <span>Đăng ký</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <form action="{{ route('register') }}" method="post" class="beta-form-checkout">
            @csrf
            <div class="row">
                <div class="col-sm-3"></div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{ $err }}<br>
                        @endforeach
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <div class="col-sm-6">
                    <h4>Đăng ký</h4>
                    <div class="space20">&nbsp;</div>

                    <div class="form-block">
                        <label for="email">Email*</label>
                        <input type="email" name="email" id="email" required>
                    </div>

                    <div class="form-block">
                        <label for="fullname">Họ tên*</label>
                        <input type="text" name="full_name" id="fullname" required>
                    </div>

                    <div class="form-block">
                        <label for="password">Mật khẩu*</label>
                        <input type="password" name="password" id="password" required>
                    </div>

                    <div class="form-block">
                        <label for="repassword">Nhập lại mật khẩu*</label>
                        <input type="password" name="repassword" id="repassword" required>
                    </div>

                    <div class="form-block">
                        <label for="phone">Điện thoại*</label>
                        <input type="text" name="phone" id="phone" required>
                    </div>

                    <div class="form-block">
                        <label for="address">Địa chỉ*</label>
                        <input type="text" name="address" id="address" required>
                    </div>

                    <div class="form-block">
                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection