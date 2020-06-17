@extends('client.master')
@section('title', 'Chi tiết sản phẩm')
@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shop</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Tìm kiếm sản phẩm</h2>
                    <form action="{!! route('client.getSearch') !!}" method="get">
                        <input type="text" placeholder="Nhập từ khóa..." name="txtNameProduct">
                        <input type="submit" value="Search">
                    </form>
                </div>

                <div class="single-sidebar">
                    <h2 class="sidebar-title">Sản phẩm bán chạy</h2>
                    @foreach($product_selling as $val)
                        <div class="thubmnail-recent">
                            <img src="{!! asset('resources/upload/'.$val->image) !!}" class="recent-thumb" alt="">
                            <h2><a href="">{!! $val->name !!}</a></h2>
                            <div class="product-sidebar-price">
                                @if ($val->promotional == 0)
                                    <ins>{!! number_format($val->price, 0, ",", ".") !!} VNĐ</ins>
                                @else
                                    <ins>{!! number_format($val->promotional, 0, ",", ".") !!} VNĐ</ins> <del>{!! number_format($val->price, 0, ",", ".") !!} VNĐ</del>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="product-breadcroumb">
                        <a href="{!! route('index') !!}">Trang chủ</a>
                        <a href="{!! route('client.Category', [$cate->id, $cate->alias]) !!}">Loại</a>
                        <a href="{!! route('client.getSingle', [$product->id, $product->alias]) !!}">{!! $product->name !!}</a>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <img src="{!! asset('resources/upload/'.$product->image)!!}" alt="">
                                </div>

                                <div class="product-gallery">
                                    @foreach($product_img as $item)
                                    <img src="{!! asset('resources/upload/detail/'.$item->image)!!}" alt="">
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name">{!! $product->name !!}</h2>
                                <div class="product-inner-price">
                                    @if ($product->promotional == 0)
                                        {!! number_format($product->price, 0, ",", ".") !!} VNĐ</ins>
                                    @else
                                        <ins>{!! number_format($product->promotional, 0, ",", ".") !!} VNĐ</ins> <del>{!! number_format($product->price, 0, ",", ".") !!} VNĐ</del>
                                    @endif
                                </div>

                                @if (Auth::check())
                                    <form action="{!! route('client.addCart', $product->id)  !!}" class="cart">
                                        <div class="quantity">
                                            <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="qty" min="1" step="1">
                                        </div>
                                        <button class="add_to_cart_button" type="submit">Thêm vào giỏ</button>
                                    </form>
                                @else
                                    <form action="{!! route('client.getLogin')  !!}" class="cart">
                                        <div class="quantity">
                                            <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="qty" min="1" step="1">
                                        </div>
                                        <button class="add_to_cart_button" type="submit">Thêm vào giỏ</button>
                                    </form>
                                @endif
                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Mô tả</a>
                                        </li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Nhận xét</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>Mô tả sản phẩm</h2>
                                            <p>{!! $product->description !!}</p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <h2>Reviews</h2>
                                            <div class="submit-review">
                                                <p>
                                                    <label for="name">Name</label>
                                                    <input name="name" type="text">
                                                </p>
                                                <p>
                                                    <label for="email">Email</label>
                                                    <input name="email" type="email">
                                                </p>
                                                <div class="rating-chooser">
                                                    <p>Your rating</p>

                                                    <div class="rating-wrap-post">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p>
                                                    <label for="review">Your review</label>
                                                    <textarea name="review" id="" cols="30" rows="10"></textarea>
                                                </p>
                                                <p>
                                                    <input type="submit" value="Submit">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="related-products-wrapper">
                        <h2 class="related-products-title">Sản phẩm liên quan</h2>
                        <div class="related-products-carousel">
                            @foreach($product_relate as $val)
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="{!! asset('resources/upload/'.$val->image) !!}" alt="">
                                    <div class="product-hover">
                                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</a>
                                        <a href="" class="view-details-link"><i class="fa fa-link"></i> Chi tiết</a>
                                    </div>
                                </div>

                                <h2><a href="">{!! $val->name !!}</a></h2>

                                <div class="product-carousel-price">
                                    @if ($val->promotional == 0)
                                        <ins>{!! number_format($val->price, 0, ",", ".") !!} VNĐ</ins>
                                    @else
                                        <ins>{!! number_format($val->promotional, 0, ",", ".") !!} VNĐ</ins> <del>{!! number_format($val->price, 0, ",", ".") !!} VNĐ</del>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()