@extends('client.master')
@section('title', 'Category')
@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>{{ $cate->name }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            @foreach($product as $val)
            <div class="col-md-3 col-sm-6">
                <div class="single-shop-product">
                    <div class="product-upper">
                        <img src="{!! asset('resources/upload/'.$val->image) !!}" alt="">
                    </div>
                    <h2><a href="{!! route('client.getSingle',[$val->id, $val->alias]) !!}">{!! $val->name !!}</a></h2>
                    <div class="product-carousel-price">
                        @if ($val->promotional == 0)
                            <ins>{!! number_format($val->price, 0, ",", ".") !!} VNĐ</ins>
                        @else
                            <ins>{!! number_format($val->promotional, 0, ",", ".") !!} VNĐ</ins> <del>{!! number_format($val->price, 0, ",", ".") !!} VNĐ</del>
                        @endif
                    </div>

                    <div class="product-option-shop">
                        @if (Auth::check())
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="{!! route('client.addCart', $val->id) !!}">Thêm vào giỏ</a>
                        @else
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="{!! route('client.getLogin') !!}">Thêm vào giỏ</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="product-pagination text-center">
                    <nav>
                        {!! $product->links() !!}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection