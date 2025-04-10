@extends('admin.master')
@section('title', 'Danh sách sản phẩm')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh sách sản phẩm</h1>
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
                <th>Tên sản phẩm</th>
                <th>Loại</th>
                <th>Giá</th>
                <th>Giá khuyến mãi</th>
                <th>Hình ảnh</th>
                <th>Xóa</th>
                <th>Sửa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="odd gradeX" align="center">
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->productType->name }}</td>
                <td>{{ number_format($product->unit_price) }} đ</td>
                <td>{{ number_format($product->promotion_price) }} đ</td>
                <td>
                    <img width="100px" src="{{ asset('source/image/product/'.$product->image) }}" alt="{{ $product->name }}">
                </td>
                <td class="center">
                    <a href="{{ route('admin.product.delete', $product->id) }}" onclick="return confirm('Bạn có chắc muốn xóa?')">
                        <i class="fa fa-trash-o fa-fw"></i> Xóa
                    </a>
                </td>
                <td class="center">
                    <a href="{{ route('admin.product.edit', $product->id) }}">
                        <i class="fa fa-pencil fa-fw"></i> Sửa
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection