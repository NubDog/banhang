@extends('admin.master')
@section('title', 'Danh sách loại sản phẩm')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh sách loại sản phẩm</h1>
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
                <th>Tên loại</th>
                <th>Mô tả</th>
                <th>Hình ảnh</th>
                <th>Xóa</th>
                <th>Sửa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cates as $cate)
            <tr class="odd gradeX" align="center">
                <td>{{ $cate->id }}</td>
                <td>{{ $cate->name }}</td>
                <td>{{ $cate->description }}</td>
                <td>
                    @if($cate->image)
                        <img width="100px" src="{{ asset('source/image/category/'.$cate->image) }}" alt="{{ $cate->name }}">
                    @else
                        Không có hình
                    @endif
                </td>
                <td class="center">
                    <a href="{{ route('admin.getCateDelete', $cate->id) }}" onclick="return confirm('Bạn có chắc muốn xóa?')">
                        <i class="fa fa-trash-o fa-fw"></i> Xóa
                    </a>
                </td>
                <td class="center">
                    <a href="{{ route('admin.getCateEdit', $cate->id) }}">
                        <i class="fa fa-pencil fa-fw"></i> Sửa
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection