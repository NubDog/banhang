@extends('layouts.master')

@section('title', 'Trang chủ')

@section('content')
<div class="fullwidthbanner-container">
    <div class="fullwidthbanner">
        <div class="bannercontainer">
            <div class="banner">
                <ul>
                    @foreach($slides as $slide)
                    <li data-transition="boxfade" data-slotamount="20" class="active-revslide">
                        <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
                            <div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="source/image/slide/{{ $slide->image }}" data-src="source/image/slide/{{ $slide->image }}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('source/image/slide/{{ $slide->image }}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>Sản phẩm mới</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{ count($newProducts) }} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            @foreach($newProducts as $new)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    @if($new->promotion_price != 0)
                                    <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                    @endif
                                    <div class="single-item-header">
                                        <a href="{{ route('product.detail', $new->id) }}">
                                            <img src="source/image/product/{{ $new->image }}" alt="{{ $new->name }}" height="250px">
                                        </a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $new->name }}</p>
                                        <p class="single-item-price">
                                            @if($new->promotion_price != 0)
                                            <span class="flash-del">{{ number_format($new->unit_price) }} đồng</span>
                                            <span class="flash-sale">{{ number_format($new->promotion_price) }} đồng</span>
                                            @else
                                            <span>{{ number_format($new->unit_price) }} đồng</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{ route('add-to-cart', $new->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="{{ route('product.detail', $new->id) }}">Chi tiết <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div> <!-- .beta-products-list -->

                    <div class="space50">&nbsp;</div>

                    <div class="beta-products-list">
                        <h4>Sản phẩm khuyến mãi</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm thấy {{ count($promotionProducts) }} sản phẩm</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach($promotionProducts as $promotion)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    <div class="ribbon-wrapper"><div class="ribbon sale">Khuyến mãi</div></div>
                                    <div class="single-item-header">
                                        <a href="{{ route('product.detail', $promotion->id) }}">
                                            <img src="source/image/product/{{ $promotion->image }}" alt="{{ $promotion->name }}" height="250px">
                                        </a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $promotion->name }}</p>
                                        <p class="single-item-price">
                                            @if($promotion->promotion_price != 0)
                                            <span class="flash-del">{{ number_format($promotion->unit_price) }} đồng</span>
                                            <span class="flash-sale">{{ number_format($promotion->promotion_price) }} đồng</span>
                                            @else
                                            <span>{{ number_format($promotion->unit_price) }} đồng</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{ route('add-to-cart', $promotion->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="{{ route('product.detail', $promotion->id) }}">Chi tiết <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div> <!-- .beta-products-list -->

                    <div class="space50">&nbsp;</div>

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
            </div> <!-- end section with sidebar and main content -->
        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection