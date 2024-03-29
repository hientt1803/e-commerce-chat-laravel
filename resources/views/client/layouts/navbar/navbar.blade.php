<!-- Header Section Begin -->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="/"><img src="{{asset('assets/client/img/logo.png')}}" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ (Request::is('/') ? 'active' : '') }}"><a href="/">Trang chủ</a></li>
                        <li class="{{ (Request::is('shop') || Request::is('shop/product-detail/{id}') ? 'active' : '') }}"><a href="/shop">Shop</a></li>
                        <!-- <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="product-detail">Product Details</a></li>
                                <li><a href="cart">Shop Cart</a></li>
                                <li><a href="checkout">Checkout</a></li>
                            </ul>
                        </li> -->
                        <li class="{{ (Request::is('blog') ? 'active' : '') }}"><a href="/blog">Blog</a></li>
                        <li class="{{ (Request::is('contact') ? 'active' : '') }}"><a href="/contact">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right d-flex align-items-center gap-2">
                    @if(session('customer'))
                    <div class="dropdown">
                        <a class="btn btn-transparent dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{session('customer')->customer_name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="/user/profile"><i class="fa fa-user-o mr-1" aria-hidden="true"></i>Thông tin cá nhân</a></li>
                            <li><a class="dropdown-item" href="/user/order-history"><i class="fa fa-history mr-1" aria-hidden="true"></i>Lịch sử đặt hàng</a></li>
                            <li><a class="dropdown-item" href="/cart"><span class="icon_bag_alt mr-1"></span>Giỏ hàng</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="/login/forgot-password"><i class="fa fa-unlock-alt mr-1" aria-hidden="true"></i>Quên mật khẩu?</a></li>
                            <li><a class="dropdown-item text-danger" href="/logout"><i class="fa fa-sign-out mr-1" aria-hidden="true"></i>Đăng xuất</a></li>
                        </div>
                    </div>
                    @else
                    <div class="header__right__auth">
                        <a href="/login">Đăng nhập</a>
                        <a href="/register">Đăng ký</a>
                    </div>
                    @endif
                    <ul class="header__right__widget">
                        <li><span class="icon_search search-switch"></span></li>
                        <li><a href="/user/order-history"><i class="fa fa-history" aria-hidden="true"></i>
                            </a></li>
                        <li><a href="/cart"><span class="icon_bag_alt"></span>
                                <div class="tip">{{$cartCount ? $cartCount : 0}}</div>
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->