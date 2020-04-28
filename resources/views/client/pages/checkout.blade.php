@extends('client.master')
@section('title', 'Giỏ hàng')
@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Thanh toán</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <form enctype="multipart/form-data" action="{!! route('postCheckout') !!}" class="checkout" method="POST" name="checkout">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="col-md-4">
                    <div class="product-content-right">
                        <div class="woocommerce">

                                <div id="customer_details" class="col2-set">
                                    <div class="col-1">
                                        <div class="woocommerce-billing-fields">
                                            <h3>Điền thông tin</h3>
                                            <p>
                                                <label>Tên người dùng <b style="color: red;"> *</b></label>
                                                <input type="text" placeholder="Nhập tên" name="txtUsername" value="{!! $user->name !!}">
                                            </p>
                                            <p>
                                                <label>Email <b style="color: red;"> *</b></label>
                                                <input type="text" placeholder="Nhập email" name="txtEmail" value="{!! $user->email !!}">
                                            </p>

                                            <p>
                                                <label>Địa chỉ <b style="color: red;"> *</b></label>
                                                <input type="text" name="txtAddress" placeholder="Nhập địa chỉ nhận hàng">
                                            </p>
                                            <p>
                                                <label>Số điện thoại <b style="color: red;"> *</b></label>
                                                <input type="text" name="txtPhone" placeholder="Nhập số điện thoại">
                                            </p>
                                            <p>
                                                <label>Note</label>
                                                <input type="text" name="txtNote">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" value="Xác nhận">
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h3 id="order_review_heading">Đơn hàng của bạn</h3>

                    <div id="order_review" style="position: relative;">
                        <table class="shop_table">
                            <thead>
                                <tr>
                                    <th class="product-name">Tên sản phẩm</th>
                                    <th class="product-total">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($content as $val)
                                <tr class="cart_item">
                                    <td class="product-name">
                                        {!! $val->name !!}<strong class="product-quantity">× {!! $val->qty !!}</strong> </td>
                                    <td class="product-total">
                                        <span class="amount">{!! number_format($val->price*$val->qty, 0, ",", ".") !!} VNĐ</span> </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>

                                <tr class="cart-subtotal">
                                    <th>Tổng tiền</th>
                                    <td><span class="amount">{!! Cart::subtotal(0, ",", ".") !!} VNĐ</span>

                                    </td>
                                </tr>

                                <tr class="shipping">
                                    <th>Phí vận chuyển</th>
                                    <td>

                                        Miễn phí
                                        <input type="hidden" class="shipping_method" value="free_shipping" id="shipping_method_0" data-index="0" name="shipping_method[0]">
                                    </td>
                                </tr>


                                <tr class="order-total">
                                    <th>Tổng tiền đơn hàng</th>
                                    <td><strong><span class="amount">{!!  Cart::subtotal(0, ",", ".") !!} VNĐ</span></strong> </td>
                                </tr>

                            </tfoot>
                        </table>
                    </div>                       
                </div>
            </form>    
        </div>
    </div>
</div>
@endsection