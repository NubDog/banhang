@extends('layouts.master')

@section('title', $productType->name)

@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">{{ $productType->name }}</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('home') }}">Trang chủ</a> / <span>{{ $productType->name }}</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-3">
                    <ul class="aside-menu">
                        @foreach($loai_sp as $loai)
                        <li class="{{ $loai->id == $productType->id ? 'active' : '' }}">
                            <a href="{{ route('loaisanpham', $loai->id) }}">{{ $loai->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-9">
                    <div class="beta-products-list">
                        <h4>{{ $productType->name }}</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{ count($products) }} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            @foreach($products as $product)
                            <div class="col-sm-4">
                                <div class="single-item">
                                    @if($product->promotion_price != 0)
                                    <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                    @endif
                                    <div class="single-item-header">
                                        <a href="{{ route('product.detail', $product->id) }}">
                                            <img src="{{ asset('source/image/product/' . $product->image) }}" alt="{{ $product->name }}" height="250px">
                                        </a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $product->name }}</p>
                                        <p class="single-item-price">
                                            @if($product->promotion_price != 0)
                                            <span class="flash-del">{{ number_format($product->unit_price) }} đồng</span>
                                            <span class="flash-sale">{{ number_format($product->promotion_price) }} đồng</span>
                                            @else
                                            <span>{{ number_format($product->unit_price) }} đồng</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{ route('add-to-cart', $product->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="{{ route('product.detail', $product->id) }}">Chi tiết <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div> <!-- .beta-products-list -->
                </div>
            </div> <!-- end section with sidebar and main content -->
        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection