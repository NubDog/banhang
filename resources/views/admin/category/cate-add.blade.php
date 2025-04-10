@extends('admin.master')
@section('title', 'Thêm loại sản phẩm')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Thêm loại sản phẩm</h1>
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
        
        <form action="{{ route('admin.postCateAdd') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Tên loại sản phẩm</label>
                <input class="form-control" name="name" placeholder="Nhập tên loại sản phẩm" />
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea class="form-control" rows="3" name="description"></textarea>
            </div>
            <div class="form-group">
                <label>Hình ảnh</label>
                <input type="file" name="image">
            </div>
            <button type="submit" class="btn btn-default">Thêm</button>
            <button type="reset" class="btn btn-default">Làm mới</button>
        </form>
    </div>
</div>
@endsection