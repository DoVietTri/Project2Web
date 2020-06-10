<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    @if(Auth::check())
                        <ul>
                            <li><a href="{!! route('client.getProfile') !!}"><i class="fa fa-user"></i> {!! Auth::user()->name !!}</a>
                            </li>
                            <li><a href="{!! route('getCart') !!}"><i class="fa fa-user"></i> Giỏ hàng</a>
                            </li>
                            <li><a href="{!! route('getCheckout') !!}"><i class="fa fa-user"></i> Thanh toán</a>
                            </li>
                            <li><a href="{!! route('client.getMyListOrder') !!}"><i class="fa fa-user"></i> Đơn hàng</a>
                            </li>
                            <li><a href="{!! route('client.getLogout') !!}"> Đăng xuất </a>
                            </li>
                        </ul>
                    @else
                        <ul>
                            <li><a href="{!! route('client.getLogin') !!}"><i class="fa fa-user"></i> Đăng nhập</a>
                            </li>
                            <li><a href="{!! route('client.getRegister') !!}"><i class="fa fa-user"></i> Đăng kí</a>
                            </li>
                        </ul>
                    @endif
                    
                </div>
            </div>

            <div class="col-md-4">
                <div class="header-right">
                    <ul class="list-unstyled list-inline">
                        @if (Auth::check())
                            <li class="dropdown dropdown-small">
                                <a href="{!! route('getContact') !!}">Liên hệ</a>
                            </li>
                        @else
                            <li class="dropdown dropdown-small">
                                <a href="{!! route('client.getLogin') !!}">Liên hệ</a>
                            </li>
                        @endif
                        <li class="dropdown dropdown-small">
                            <a  href="#"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End header area -->

<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="logo">
                    <h1><a href="{!! route('index') !!}"><img src="{{ url('public/client/img/logo.png') }}"></a></h1>
                </div>
            </div>
            <div class="col-sm-5" style="margin-top: 46px;">
                <form action="{!! route('client.getSearch') !!}">
                    <input style="width: 450px; height: 42px" type="text" name="txtNameProduct" placeholder="Nhập từ khóa...">
                </form>
            </div>
            <div class="col-sm-4">    
                <div class="shopping-item">
                    @if(Auth::check())
                        <a href="{!! route('getCart') !!}" >Giỏ hàng - <span class="cart-amunt">{!! Cart::subtotal(0, ",", ".") !!} VNĐ</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">{!! Cart::count() !!}</span></a>
                    @else
                        <a href="{!! route('client.getLogin') !!}">Giỏ hàng<span class="cart-amunt"></span><i class="fa fa-shopping-cart"></i></a>
                    @endif 
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End site branding area -->

<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{!! route('index') !!}">Trang chủ</a>
                    </li>
                    @foreach($category as $val)
                    <li class=""><a href="{!! route('client.Category', [$val->id, $val->alias]) !!}">{!! $val->name !!}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>