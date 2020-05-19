@extends('client.master')
@section('title', 'Đăng kí')

@section('content')


<div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    
                    Tài khoản của: <h4 class="sidebar-title">{!! Auth::user()->name !!}</h4>
                    <div class="thubmnail-recent">
                        <a style="font-size: 23px; background-color: #C0C0C0" href="#" type="button" class="btn btn-secondary"><i class="fa fa-user"></i>Thông tin tài khoản</a>                
                    </div>
                    
                                                    
                </div>
                
                <div class="col-md-9">
                    <div class="product-content-right">
                        <div class="woocommerce">
                        
                            <form id="login-form-wrap" class="login" method="post">
                                
                                <h3>Thông tin khách hàng</h3>
                                <p class="form-row form-row-first">
                                    <label for="username">Tên tài khoản <span class="required">*</span>
                                    </label>
                                    <input type="text" id="txtUsername" name="txtUsername" class="input-text" value="{!! Auth::user()->name !!}">
                                </p>
                                <p class="form-row form-row-first">
                                    <label for="email">Email <span class="required">*</span>
                                    </label>
                                    <input type="text" id="txtEmail" name="txtEmail" class="input-text" value="{!! Auth::user()->email !!}">
                                </p>
            
                                <div class="clear"></div>
                            </form>
                        </div>                       
                    </div>                    
                </div>
            </div>
        </div>
    </div>
@endsection()