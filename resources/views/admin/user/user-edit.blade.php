@extends('admin.master')
@section('title', 'Sửa người dùng')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Sửa người dùng</h1>
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
        
        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Họ tên</label>
                <input class="form-control" name="full_name" placeholder="Nhập họ tên" value="{{ $user->full_name }}" />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" placeholder="Nhập email" type="email" value="{{ $user->email }}" readonly />
            </div>
            <div class="form-group">
                <label>Mật khẩu mới (để trống nếu không đổi)</label>
                <input class="form-control" name="password" placeholder="Nhập mật khẩu mới" type="password" />
            </div>
            <div class="form-group">
                <label>Nhập lại mật khẩu mới</label>
                <input class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu mới" type="password" />
            </div>
            <div class="form-group">
                <label>Số điện thoại</label>
                <input class="form-control" name="phone" placeholder="Nhập số điện thoại" value="{{ $user->phone }}" />
            </div>
            <div class="form-group">
                <label>Địa chỉ</label>
                <input class="form-control" name="address" placeholder="Nhập địa chỉ" value="{{ $user->address }}" />
            </div>
            <div class="form-group">
                <label>Quyền</label>
                <select class="form-control" name="level">
                    <option value="0" {{ $user->level == 0 ? 'selected' : '' }}>Khách hàng</option>
                    <option value="1" {{ $user->level == 1 ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ $user->level == 2 ? 'selected' : '' }}>Quản lý</option>
                </select>
            </div>
            <button type="submit" class="btn btn-default">Cập nhật</button>
            <button type="reset" class="btn btn-default">Làm mới</button>
        </form>
    </div>
</div>
@endsection