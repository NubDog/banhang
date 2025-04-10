@extends('admin.master')
@section('title', 'Danh sách người dùng')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh sách người dùng</h1>
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
                <th>Họ tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Quyền</th>
                <th>Xóa</th>
                <th>Sửa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="odd gradeX" align="center">
                <td>{{ $user->id }}</td>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>
                    @if($user->level == 1)
                        Admin
                    @elseif($user->level == 2)
                        Quản lý
                    @else
                        Khách hàng
                    @endif
                </td>
                <td class="center">
                    <a href="{{ route('admin.user.delete', $user->id) }}" onclick="return confirm('Bạn có chắc muốn xóa?')">
                        <i class="fa fa-trash-o fa-fw"></i> Xóa
                    </a>
                </td>
                <td class="center">
                    <a href="{{ route('admin.user.edit', $user->id) }}">
                        <i class="fa fa-pencil fa-fw"></i> Sửa
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection