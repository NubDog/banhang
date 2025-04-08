@extends('layouts.master')

@section('title', $product->name)

@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Chi tiết sản phẩm</h6>
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
                        <img src="{{ asset('source/image/product/' . $product->image) }}" alt="{{ $product->name }}" height="250px">
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
                        @foreach($relatedProducts as $related)
                        <div class="col-sm-3">
                            <div class="single-item">
                                @if($related->promotion_price != 0)
                                <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                @endif
                                <div class="single-item-header">
                                    <a href="{{ route('product.detail', $related->id) }}">
                                        <img src="{{ asset('source/image/product/' . $related->image) }}" alt="{{ $related->name }}" height="200px">
                                    </a>
                                </div>
                                <div class="single-item-body">
                                    <p class="single-item-title">{{ $related->name }}</p>
                                    <p class="single-item-price">
                                        @if($related->promotion_price != 0)
                                        <span class="flash-del">{{ number_format($related->unit_price) }} đồng</span>
                                        <span class="flash-sale">{{ number_format($related->promotion_price) }} đồng</span>
                                        @else
                                        <span>{{ number_format($related->unit_price) }} đồng</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="single-item-caption">
                                    <a class="add-to-cart pull-left" href="{{ route('add-to-cart', $related->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="beta-btn primary" href="{{ route('product.detail', $related->id) }}">Chi tiết <i class="fa fa-chevron-right"></i></a>
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
                    <h3 class="widget-title">Sản phẩm mới</h3>
                    <div class="widget-body">
                        <div class="beta-sales beta-lists">
                            @foreach($newProducts as $new)
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="{{ route('product.detail', $new->id) }}">
                                    <img src="{{ asset('source/image/product/' . $new->image) }}" alt="{{ $new->name }}" height="80px">
                                </a>
                                <div class="media-body">
                                    <span class="beta-sales-price">
                                        @if($new->promotion_price != 0)
                                        {{ number_format($new->promotion_price) }} đồng
                                        @else
                                        {{ number_format($new->unit_price) }} đồng
                                        @endif
                                    </span>
                                    <p class="beta-sales-item">{{ $new->name }}</p>
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