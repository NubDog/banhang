@extends('admin.master')
@section('title', 'Thêm người dùng')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Thêm người dùng</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-7" style="padding-bottom:120px">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
            </div>
        @endif
        
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        
        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Họ tên</label>
                <input class="form-control" name="full_name" placeholder="Nhập họ tên" />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" placeholder="Nhập email" type="email" />
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input class="form-control" name="password" placeholder="Nhập mật khẩu" type="password" />
            </div>
            <div class="form-group">
                <label>Nhập lại mật khẩu</label>
                <input class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu" type="password" />
            </div>
            <div class="form-group">
                <label>Số điện thoại</label>
                <input class="form-control" name="phone" placeholder="Nhập số điện thoại" />
            </div>
            <div class="form-group">
                <label>Địa chỉ</label>
                <input class="form-control" name="address" placeholder="Nhập địa chỉ" />
            </div>
            <div class="form-group">
                <label>Quyền</label>
                <select class="form-control" name="level">
                    <option value="0">Khách hàng</option>
                    <option value="1">Admin</option>
                    <option value="2">Quản lý</option>
                </select>
            </div>
            <button type="submit" class="btn btn-default">Thêm</button>
            <button type="reset" class="btn btn-default">Làm mới</button>
        </form>
    </div>
</div>
@endsection