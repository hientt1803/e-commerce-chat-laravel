@extends('client.layouts.user_type.guest')

@section('content')

<style>
    .custom-button-cart {
        font-size: 18px;
        color: #111111;
        display: block;
        height: 45px;
        width: 45px;
        background: #ffffff;
        line-height: 48px;
        text-align: center;
        border-radius: 50%;
        -webkit-transition: all, 0.5s;
        -o-transition: all, 0.5s;
        transition: all, 0.5s;
    }

    .custom-button-cart:hover {
        background: #ca1515;
    }

    .custom-button-cart:hover span {
        color: #ffffff;
        -webkit-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }
</style>

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="categories__item categories__large__item set-bg" data-setbg="../assets/client/img/home/iphone-15-pro-max-tu-nhien-1-1.jpg" style="background-size: cover;">
                    <div class="categories__text">
                        <h1>Iphone Collection</h1>
                        <p>Danh mục các sản phẩm Iphone bán chạy nhất hiện nay.</p>
                        <a href="/shop/category/1">Mua ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="../assets/client/img/home/huawei-nova-5t-blue-600x600-600x600.jpg" style="background-size: 225px 225px;background-position: center center; background-repeat: no-repeat;">
                            <div class="categories__text">
                                <h4>Huawei</h4>
                                <p>358 sản phẩm</p>
                                <a href="/shop/category/2">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="../assets/client/img/home/samsung-galaxy-z-fold5-kem-600x600.jpg" style="background-size: 225px 225px;background-position: center center; background-repeat: no-repeat;">
                            <div class="categories__text">
                                <h4>samsung</h4>
                                <p>273 sản phẩm</p>
                                <a href="/shop/category/3">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="../assets/client/img/home/xiaomi-14-white-thumbnew-600x600.jpg" style="background-size: 225px 225px;background-position: center center; background-repeat: no-repeat;">
                            <div class="categories__text">
                                <h4>Xiaomi</h4>
                                <p>159 sản phẩm</p>
                                <a href="/shop/category/4">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="../assets/client/img/home/oppo-reno-11-pro-xam-thumb-600x600.jpg" style="background-size: 225px 225px;background-position: center center; background-repeat: no-repeat;">
                            <div class="categories__text">
                                <h4>Oppo</h4>
                                <p>792 sản phẩm</p>
                                <a href="/shop/category/5">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>Sản phẩm mới</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">All</li>
                    @foreach($categories as $index => $category)
                    <li data-filter=".{{$category->category_name}}">{{$category->category_name}}</li>
                    @endforeach
                    <!-- <li data-filter=".men">Men’s</li>
                    <li data-filter=".kid">Kid’s</li>
                    <li data-filter=".accessories">Accessories</li>
                    <li data-filter=".cosmetic">Cosmetics</li> -->
                </ul>
            </div>
        </div>
        <div class="row property__gallery">
            @foreach($productNews as $index =>$product)
            @if($product->quantity > 0)
            <div class="col-lg-3 col-md-4 col-sm-6 mix {{$product->categories->category_name}}">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{asset('storage/'.$product->image)}}" style="background-size: contain; background-position: center center;">
                        <div class="label new">New</div>
                        <ul class="product__hover">
                            <li><a href="{{asset('storage/'.$product->image)}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                            <li>
                                <a href="{{url('/shop/product-detail/'.$product->product_id)}}"><span class="icon_search"></span></a>
                            </li>
                            <li>
                                <form action="/cart-detail" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" value="{{$product->product_id}}" name="product_id">
                                    <input type="hidden" value="1" name="quantity">
                                    <button type="submit" class="border-0 outline-none custom-button-cart"><span class="icon_bag_alt"></span></button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="{{url('/shop/product-detail/'.$product->product_id)}}">{{$product->product_name}}</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">
                            <a href="{{url('/shop/product-detail/'.$product->product_id)}}" class="text-dark">
                                {{number_format($product->price, 0, ',', '.')}} VND
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Banner Section Begin -->
<section class="banner set-bg" data-setbg="../assets/client/img/banner/iphone-banner.jpg" style="background-size: cover; background-position: center center;">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-8 m-auto">
                <div class="banner__slider owl-carousel">
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Iphone Collection</span>
                            <h1>Iphone 15 pro max 1TB</h1>
                            <a href="/shop/category/1">Mua ngay</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Huawei Collection</span>
                            <h1>Huawei Mate 30 pro</h1>
                            <a href="/shop/category/2">Mua ngay</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Xiaomi Collection</span>
                            <h1>Xiaomi 14 pro max</h1>
                            <a href="/shop/category/5">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Trend Section Begin -->
<section class="trend spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Hot Trend</h4>
                    </div>
                    @foreach($hotTrend as $index => $trend)
                    @if($trend->quantity > 0)
                    <div class="trend__item">
                        <a href="{{url('/shop/product-detail/'.$trend->product_id)}}" class="text-dark">
                            <div class="trend__item__pic">
                                <img src="{{asset('storage/'.$trend->image)}}" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                        </a>
                        <div class="trend__item__text">
                            <h6><a href="{{url('/shop/product-detail/'.$trend->product_id)}}" class="text-dark">{{$trend->product_name}}</a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">
                                <a href="{{url('/shop/product-detail/'.$trend->product_id)}}" class="text-dark">
                                    {{number_format($trend->price, 0, ',', '.')}} VND
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Bán chạy nhất</h4>
                    </div>
                    @foreach($bestSeller as $index => $trend)
                    @if($trend->quantity > 0)
                    <div class="trend__item">
                        <a href="{{url('/shop/product-detail/'.$trend->product_id)}}" class="text-dark">
                            <div class="trend__item__pic">
                                <img src="{{asset('storage/'.$trend->image)}}" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                        </a>
                        <div class="trend__item__text">
                            <h6><a href="{{url('/shop/product-detail/'.$trend->product_id)}}" class="text-dark">{{$trend->product_name}}</a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">
                                <a href="{{url('/shop/product-detail/'.$trend->product_id)}}" class="text-dark">
                                    {{number_format($trend->price, 0, ',', '.')}} VND
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Vừa cập nhật</h4>
                    </div>
                    @foreach($productFilter as $index => $trend)
                    @if($trend->quantity > 0)
                    <div class="trend__item">
                        <a href="{{url('/shop/product-detail/'.$trend->product_id)}}" class="text-dark">
                            <div class="trend__item__pic">
                                <img src="{{asset('storage/'.$trend->image)}}" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                        </a>
                        <div class="trend__item__text">
                            <h6><a href="{{url('/shop/product-detail/'.$trend->product_id)}}" class="text-dark">{{$trend->product_name}}</a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">
                                <a href="{{url('/shop/product-detail/'.$trend->product_id)}}" class="text-dark">
                                    {{number_format($trend->price, 0, ',', '.')}} VND
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Trend Section End -->

<!-- Discount Section Begin -->
<section class="discount">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="discount__pic">
                    <img src="../assets/client/img/discount-2.jpg" style="object-fit: cover; height: 390px;" alt="">
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="discount__text">
                    <div class="discount__text__title">
                        <span>Giảm giá</span>
                        <h2>Summer 2024</h2>
                        <h5><span>Giảm giá</span> 50%</h5>
                    </div>
                    <div class="discount__countdown" id="countdown-time">
                        <div class="countdown__item">
                            <span>22</span>
                            <p>Ngày</p>
                        </div>
                        <div class="countdown__item">
                            <span>18</span>
                            <p>Giờ</p>
                        </div>
                        <div class="countdown__item">
                            <span>46</span>
                            <p>Phút</p>
                        </div>
                        <div class="countdown__item">
                            <span>05</span>
                            <p>Giây</p>
                        </div>
                    </div>
                    <a href="#">Mua ngay</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Discount Section End -->

<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-car"></i>
                    <h6>Miễn phí Ship</h6>
                    <p>Lên tới tận 1M VND</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-money"></i>
                    <h6>Hoàn tiền 100%</h6>
                    <p>Nếu sản phẩm có vẫn đề</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-support"></i>
                    <h6>Hỗ trợ trực tuyến 24/7</h6>
                    <p>Tận tâm hỗ trợ</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-headphones"></i>
                    <h6>Bảo mật thanh toán</h6>
                    <p>100% bảo mật thanh toán</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->

@endsection