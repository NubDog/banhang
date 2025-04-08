@extends('layouts.master')

@section('title', 'Trang chủ')

@section('content')
<div class="rev-slider">
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <div class="bannercontainer">
                <div class="banner">
                    <ul>
                        @foreach($slides as $slide)
                        <li>
                            <img src="source/image/slide/{{ $slide->image }}" alt="{{ $slide->image }}" />
                            @if($slide->link)
                            <div class="caption-link">
                                <a href="{{ $slide->link }}"></a>
                            </div>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            
            <!-- Sản phẩm mới -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>Sản phẩm mới</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{ count($newProducts) }} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            @foreach($newProducts as $product)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    @if($product->promotion_price != 0)
                                    <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                    @endif
                                    <div class="single-item-header">
                                        <a href="{{ route('product.detail', $product->id) }}">
                                            <img src="source/image/product/{{ $product->image }}" alt="{{ $product->name }}" height="250px">
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
                    </div> <!-- .beta-products-list -->
                </div>
            </div> <!-- end section -->
            
            <div class="space50">&nbsp;</div>
            
            <!-- Sản phẩm khuyến mãi -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>Sản phẩm khuyến mãi</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{ count($promotionProducts) }} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            @foreach($promotionProducts as $product)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                    <div class="single-item-header">
                                        <a href="{{ route('product.detail', $product->id) }}">
                                            <img src="source/image/product/{{ $product->image }}" alt="{{ $product->name }}" height="250px">
                                        </a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $product->name }}</p>
                                        <p class="single-item-price">
                                            <span class="flash-del">{{ number_format($product->unit_price) }} đồng</span>
                                            <span class="flash-sale">{{ number_format($product->promotion_price) }} đồng</span>
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
                    </div> <!-- .beta-products-list -->
                </div>
            </div> <!-- end section -->
            
            <div class="space50">&nbsp;</div>
            
            <!-- Tất cả sản phẩm -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>Tất cả sản phẩm</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{ count($allProducts) }} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            @foreach($allProducts as $product)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    @if($product->promotion_price != 0)
                                    <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                    @endif
                                    <div class="single-item-header">
                                        <a href="{{ route('product.detail', $product->id) }}">
                                            <img src="source/image/product/{{ $product->image }}" alt="{{ $product->name }}" height="250px">
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
                                {{ $allProducts->links() }}
                            </div>
                        </div>
                    </div> <!-- .beta-products-list -->
                </div>
            </div> <!-- end section -->
        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection