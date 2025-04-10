@extends('admin.master')
@section('title', 'Thêm sản phẩm')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Thêm sản phẩm</h1>
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
        
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Loại sản phẩm</label>
                <select class="form-control" name="id_type">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Tên sản phẩm</label>
                <input class="form-control" name="name" placeholder="Nhập tên sản phẩm" />
            </div>
            <div class="form-group">
                <label>Giá</label>
                <input class="form-control" name="unit_price" placeholder="Nhập giá sản phẩm" />
            </div>
            <div class="form-group">
                <label>Giá khuyến mãi</label>
                <input class="form-control" name="promotion_price" placeholder="Nhập giá khuyến mãi" />
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea class="form-control" rows="3" id="editor" name="description"></textarea>
            </div>
            <div class="form-group">
                <label>Hình ảnh</label>
                <input type="file" name="image">
            </div>
            <div class="form-group">
                <label>Sản phẩm nổi bật</label>
                <label class="radio-inline">
                    <input name="new" value="1" checked="" type="radio">Có
                </label>
                <label class="radio-inline">
                    <input name="new" value="0" type="radio">Không
                </label>
            </div>
            <button type="submit" class="btn btn-default">Thêm</button>
            <button type="reset" class="btn btn-default">Làm mới</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('source/admin/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('editor');
</script>
@endsection