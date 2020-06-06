@extends('client.master')
@section('title', 'Đăng nhập')

@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Đăng nhập</h2>
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
                        <h2 class="sidebar-title">Tìm kiếm</h2>
                        <form action="">
                            <input type="text" placeholder="Tìm kiếm...">
                            <input type="submit" value="Tìm kiếm">
                        </form>
                    </div>
                               
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Sản phẩm bán chạy</h2>
                        @foreach($product_selling as $val)
                            <div class="thubmnail-recent">
                                <img src="{!! asset('resources/upload/'.$val->image) !!}" class="recent-thumb" alt="">
                                <h2><a href="{!! route('client.getSingle', [$val->id, $val->alias]) !!}">{!! $val->name !!}</a></h2>
                                <div class="product-sidebar-price">
                                    <ins>{!! number_format($val->promotional, 0, ",", ".") !!} VNĐ</ins> <del>{!! number_format($val->price, 0, ",", ".") !!} VNĐ</del>
                                </div>                             
                            </div>
                        @endforeach
                    </div>
                      
                </div>
                
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                        
                            <form id="login-form-wrap" class="login" method="post" action="{!! route('client.postLogin') !!}">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <p>Vui lòng đăng nhập tài khoản của bạn để nhận được nhiều ưu đãi hơn</p>

                                <p class="form-row form-row-first">
                                    <label for="email">Email <span class="required">*</span>
                                    </label>
                                    <input type="text" id="txtEmail" name="txtEmail" class="input-text">
                                </p>
                                <p class="form-row form-row-last">
                                    <label for="password">Mật khẩu <span class="required">*</span>
                                    </label>
                                    <input type="password" id="password" name="txtPassword" class="input-text">
                                </p>
                                <div class="clear"></div>


                                <p class="form-row">
                                    <input type="submit" value="Đăng nhập" name="login" class="button">
                                    <label class="inline" for="rememberme"><input type="checkbox" value="forever" id="rememberme" name="rememberme"> Remember me </label>
                                </p>
                                <p class="lost_password">
                                    <a href="#">Quên mật khẩu?</a>
                                </p>
                                <div>Bạn chưa có tài khoản ? <a href="{!! route('client.getRegister') !!}" type="button" class="btn btn-primary">Đăng kí</a></div>
                                <div class="clear"></div>
                            </form>
                        </div>                       
                    </div>                    
                </div>
            </div>
        </div>
    </div>
@endsection()