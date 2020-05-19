@extends('client.master')
@section('title', 'Giỏ hàng')
@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Giỏ hàng</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">

    <div class="container">
        <div class="row">
    
            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="woocommerce">

                        <h3 id="order_review_heading">Giỏ hàng của bạn</h3>

                        <div id="order_review" style="position: relative;">
                            <table class="shop_table">
                                <thead>
                                    <tr>
                                        <th>Cập nhật</th>
                                        <th>Xóa</th>
                                        <th class="product-name">Tên sản phẩm</th>
                                        <th class="product-image">Hình ảnh</th>
                                        <th class="prroduct-quantity">Số lượng</th>
                                        <th class="product-total">Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="" method="POST">
                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                       @if (Session::has('cart'))
                                             @foreach($content as $val)
                                                <tr class="cart_item">
                                                    <td>                        
                                                        <input type="button" id="{!! $val->rowId !!}" value="Cập nhật" class="btn btn-primary updatecart">
                                                    </td>
                                                    <td>
                                                        <input type="button" id="{!! $val->rowId !!}" value="Xóa" class="btn btn-danger deletecart">
                                                    </td>
                                                    <td class="product-name">
                                                        {!! $val->name !!} 
                                                    </td>
                                                    <td>
                                                        <img style="height: 80px;" src="{!! asset('resources/upload/'.$val->options->img) !!}">
                                                    </td>
                                                    <td>
                                                        <input name="qty" class="qty" type="number" min="0" step="1" value="{!! $val->qty !!}">
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="amount">{!! number_format($val->qty*$val->price, 0, ",", ".") !!} VNĐ</span>
                                                    </td>
                                                </tr>    
                                            @endforeach
                                       @endif
                                    </form>
                                </tbody>
                                <tfoot>

                                    <tr class="cart-subtotal">
                                        <th colspan="5">Tổng tiền đơn hàng</th>
                                        <td >
                                            <span class="amount">{!! $subtotal !!} VNĐ</span>
                                        </td>
                                    </tr>

                                    <tr class="shipping">
                                        <th colspan="5">Giao hàng và xử lý</th>
                                        <td>
                                            Miễn phí   
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div><h3>Tiến hành thanh toán <a style="font-size: 25px" type="button" class="btn btn-primary" href="{!! route('getCheckout') !!}">Thanh toán</a></h3></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection