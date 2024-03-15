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

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Home</a>
                    <a href="{{url('shop/category/' . $product->categories->cat_id)}}">{{$product->categories->category_name}}</a>
                    <span>{{$product->product_name}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__left product__thumb nice-scroll">
                        <a class="pt active" href="#product-1">
                            <img src="{{asset('/storage/' . $product->image)}}" alt="">
                        </a>
                        <a class="pt" href="#product-2">
                            <img src="{{asset('/storage/' . $product->image)}}" alt="">
                        </a>
                        <a class="pt" href="#product-3">
                            <img src="{{asset('/storage/' . $product->image)}}" alt="">
                        </a>
                        <a class="pt" href="#product-4">
                            <img src="{{asset('/storage/' . $product->image)}}" alt="">
                        </a>
                    </div>
                    <div class="product__details__slider__content">
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-hash="product-1" class="product__big__img" src="{{asset('/storage/' . $product->image)}}" alt="">
                            <img data-hash="product-2" class="product__big__img" src="{{asset('/storage/' . $product->image)}}" alt="">
                            <img data-hash="product-3" class="product__big__img" src="{{asset('/storage/' . $product->image)}}" alt="">
                            <img data-hash="product-4" class="product__big__img" src="{{asset('/storage/' . $product->image)}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product__details__text">
                    <h3>{{$product->product_name}} <span>Danh mục: {{$product->categories->category_name}}</span></h3>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <span>( 138 reviews )</span>
                    </div>
                    <div class="product__details__price">{{number_format($product->price, 0, ',', '.')}} VND <span>{{number_format($product->price + 2000000, 0, ',', '.')}} VND</span></div>
                    <p>{{ Str::limit($product->description, 250) }}.</p>
                    <form action="/cart-detail" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="product__details__button">
                            <div class="quantity">
                                <span>Số lượng:</span>
                                <div class="pro-qty">
                                    <input type="text" value="1" name="quantity" @if($product->quantity <= 0) disabled @endif>
                                </div>
                            </div>
                            <input type="hidden" value="{{$product->product_id}}" name="product_id">
                            <button type="submit" class="cart-btn outline-none"><span class="icon_bag_alt"></span>Thêm vào giỏ hàng</button>
                            <ul>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
                            </ul>
                        </div>
                    </form>
                    <div class="product__details__widget">
                        <ul>
                            <li>
                                <span>Còn lại:</span>
                                @if($product->quantity == 0)
                                <div class="stock__checkbox text-danger">
                                    Hết hàng
                                </div>
                                @else
                                <div class="stock__checkbox">
                                    <label for="stockin">
                                        {{$product->quantity}}
                                        <input type="checkbox" id="stockin">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                @endif
                            </li>
                            <li>
                                <span>Khuyến mãi:</span>
                                <p>Miễn phí vận chuyển</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Mô tả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( 2 )</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <h6>Mô tả</h6>
                            <p>{{$product->description}}.</p>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <h6>Chỉ định</h6>
                            <p>{{$product->description}}.</p>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <h6>Đánh giá ( 200 )</h6>
                            <p>{{$product->description}}.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="related__title">
                    <h5>SẢN PHẨM CÙNG LOẠI</h5>
                </div>
            </div>
            @if($relatedProducts->count()==0)
            <h2 class="text-center fs-4 mx-auto font-weight-bold w-75">
                Không có sản phẩm nào được tìm thấy.
            </h2>
            @else
            @foreach($relatedProducts as $index => $product)
            @if($product->quantity > 0)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{asset('/storage/' . $product->image)}}">
                        @if($index / 3 ==0)
                        <div class="label new">New</div>
                        @endif
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
            @endif
            <div class="col-12 mx-auto">
                {{$relatedProducts->links()}}
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

@endsection