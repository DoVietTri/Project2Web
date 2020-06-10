@extends('client.master')
@section('title', 'Trang chủ')

@section('content')
<div class="slider-area">
    <!-- Slider -->
    <div class="block-slider block-slider4">
        <ul class="" id="bxslider-home4">
            @foreach($slider as $val)
            <li>
                <img src="{{ asset('resources/upload/slider/'.$val->image) }}" alt="Slide">
                <!-- <div class="caption-group">
                    <h2 class="caption title">
                                iPhone <span class="primary">6 <strong>Plus</strong></span>
                            </h2>
                    <h4 class="caption subtitle">Dual SIM</h4>
                    <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                </div> -->
            </li>
            @endforeach
        </ul>
    </div>
    <!-- ./Slider -->
</div>

<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo1">
                    <i class="fa fa-refresh"></i>
                    <p>30 ngày đổi trả</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo2">
                    <i class="fa fa-truck"></i>
                    <p>Miễn phí vận chuyển</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo3">
                    <i class="fa fa-lock"></i>
                    <p>Thanh toán an toàn</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo4">
                    <i class="fa fa-gift"></i>
                    <p>Sản phẩm mới</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">        
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Sản phẩm mới nhất</h2>
                    <div class="product-carousel">
                        @foreach($product as $val)
                        <div class="single-product">
                            <div class="product-f-image">
                                <img src="{!! asset('resources/upload/'.$val->image) !!}" alt="">
                                <div class="product-hover">
                                    @if(Auth::check())
                                        <a href="{!! route('client.addCart', $val->id)  !!}" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</a>
                                    @else
                                        <a href="{!! route('client.getLogin')  !!}" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</a>
                                    @endif
                                    
                                    <a href="{!! route('client.getSingle', [$val->id, $val->alias]) !!}" class="view-details-link"><i class="fa fa-link"></i> Chi tiết</a>
                                </div>
                            </div>

                            <h2><a href="{!! route('client.getSingle', [$val->id, $val->alias]) !!}">{!! $val->name !!}</a></h2>

                            <div class="product-carousel-price">
                                <ins>{!! number_format($val->promotional,0, ",", ".") !!} VNĐ</ins> <del>{!! number_format($val->price,0, ",", ".") !!} VNĐ</del>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End main content area -->

<div class="product-widget-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Bán chạy</h2>
                    <a href="" class="wid-view-more">Xem tất cả</a>
                    @foreach($product_selling as $item)
                        <div class="single-wid-product">
                            <a href="{!! route('client.getSingle', [$item->id, $item->alias]) !!}"><img src="{!! asset('resources/upload/'.$item->image) !!}" alt="" class="product-thumb">
                            </a>
                            <h2><a href="{!! route('client.getSingle', [$item->id, $item->alias]) !!}">{!! $item->name !!}</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>{!! number_format($item->promotional, 0, ",", ".") !!} VNĐ</ins> <del>{!! number_format($item->price, 0, ",", ".") !!} VNĐ</del>
                            </div>
                        </div>
                    @endforeach    
                </div>
            </div>

            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Vừa xem gần đây</h2>
                    <a href="#" class="wid-view-more">Xem tất cả</a>
                    <!-- <div class="single-wid-product">
                        <a href="single-product.html"><img src="img/product-thumb-4.jpg" alt="" class="product-thumb">
                        </a>
                        <h2><a href="single-product.html">Sony playstation microsoft</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>$400.00</ins> <del>$425.00</del>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Hàng mới</h2>
                    <a href="#" class="wid-view-more">Xem tất cả</a>
                    @foreach($product_new as $val)
                    <div class="single-wid-product">
                        <a href="{!! route('client.getSingle', [$val->id, $val->alias]) !!}"><img src="{!! asset('resources/upload/'.$val->image) !!}" alt="" class="product-thumb">
                        </a>
                        <h2><a href="{!! route('client.getSingle', [$val->id, $val->alias]) !!}">{!! $val->name !!}</a></h2>
                        <div class="product-wid-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product-wid-price">
                            <ins>{!! number_format($val->promotional, 0, ",", ".") !!} VNĐ</ins> <del>{!! number_format($val->price, 0, ",", ".") !!} VNĐ</del>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End product widget area -->
@endsection()