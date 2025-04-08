@extends('layouts.master')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Chi tiết sản phẩm {{ $product->name }}</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('home') }}">Trang chủ</a> / <span>Chi tiết sản phẩm</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <div class="row">
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-4">
                        <img src="source/image/product/{{ $product->image }}" alt="{{ $product->name }}">
                    </div>
                    <div class="col-sm-8">
                        <div class="single-item-body">
                            <p class="single-item-title"><h2>{{ $product->name }}</h2></p>
                            <p class="single-item-price">
                                @if($product->promotion_price != 0)
                                <span class="flash-del">{{ number_format($product->unit_price) }} đồng</span>
                                <span class="flash-sale">{{ number_format($product->promotion_price) }} đồng</span>
                                @else
                                <span>{{ number_format($product->unit_price) }} đồng</span>
                                @endif
                            </p>
                        </div>

                        <div class="clearfix"></div>
                        <div class="space20">&nbsp;</div>

                        <div class="single-item-desc">
                            <p>{{ $product->description }}</p>
                        </div>
                        <div class="space20">&nbsp;</div>

                        <p>Số lượng:</p>
                        <div class="single-item-options">
                            <select class="wc-select" name="qty">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <a class="add-to-cart" href="{{ route('add-to-cart', $product->id) }}"><i class="fa fa-shopping-cart"></i></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="space40">&nbsp;</div>
                <div class="woocommerce-tabs">
                    <ul class="tabs">
                        <li><a href="#tab-description">Mô tả</a></li>
                    </ul>

                    <div class="panel" id="tab-description">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
                <div class="space50">&nbsp;</div>
                <div class="beta-products-list">
                    <h4>Sản phẩm liên quan</h4>

                    <div class="row">
                        @foreach($relatedProducts as $relatedProduct)
                        <div class="col-sm-3">
                            <div class="single-item">
                                @if($relatedProduct->promotion_price != 0)
                                <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                @endif
                                <div class="single-item-header">
                                    <a href="{{ route('product.detail', $relatedProduct->id) }}">
                                        <img src="source/image/product/{{ $relatedProduct->image }}" alt="{{ $relatedProduct->name }}" height="200px">
                                    </a>
                                </div>
                                <div class="single-item-body">
                                    <p class="single-item-title">{{ $relatedProduct->name }}</p>
                                    <p class="single-item-price">
                                        @if($relatedProduct->promotion_price != 0)
                                        <span class="flash-del">{{ number_format($relatedProduct->unit_price) }} đồng</span>
                                        <span class="flash-sale">{{ number_format($relatedProduct->promotion_price) }} đồng</span>
                                        @else
                                        <span>{{ number_format($relatedProduct->unit_price) }} đồng</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="single-item-caption">
                                    <a class="add-to-cart pull-left" href="{{ route('add-to-cart', $relatedProduct->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="beta-btn primary" href="{{ route('product.detail', $relatedProduct->id) }}">Chi tiết <i class="fa fa-chevron-right"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div> <!-- .beta-products-list -->
            </div>
            <div class="col-sm-3 aside">
                <div class="widget">
                    <h3 class="widget-title">Sản phẩm bán chạy</h3>
                    <div class="widget-body">
                        <div class="beta-sales beta-lists">
                            @foreach($newProducts as $newProduct)
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="{{ route('product.detail', $newProduct->id) }}">
                                    <img src="source/image/product/{{ $newProduct->image }}" alt="{{ $newProduct->name }}">
                                </a>
                                <div class="media-body">
                                    {{ $newProduct->name }}
                                    <span class="beta-sales-price">{{ number_format($newProduct->promotion_price != 0 ? $newProduct->promotion_price : $newProduct->unit_price) }} đồng</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div> <!-- best sellers widget -->
                <div class="widget">
                    <h3 class="widget-title">Sản phẩm mới</h3>
                    <div class="widget-body">
                        <div class="beta-sales beta-lists">
                            @foreach($newProducts as $newProduct)
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="{{ route('product.detail', $newProduct->id) }}">
                                    <img src="source/image/product/{{ $newProduct->image }}" alt="{{ $newProduct->name }}">
                                </a>
                                <div class="media-body">
                                    {{ $newProduct->name }}
                                    <span class="beta-sales-price">{{ number_format($newProduct->promotion_price != 0 ? $newProduct->promotion_price : $newProduct->unit_price) }} đồng</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div> <!-- best sellers widget -->
            </div>
        </div>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection