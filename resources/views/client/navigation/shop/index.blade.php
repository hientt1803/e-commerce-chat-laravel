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
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Shop</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="shop__sidebar">
                    <div class="sidebar__categories">
                        <div class="section-title">
                            <h4>Danh mục</h4>
                        </div>
                        <div class="categories__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading active">
                                        <a data-toggle="collapse" data-target="#collapseOne">Hãng Sản Xuất</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <ul>
                                                @foreach($categories as $index => $cat)
                                                <li><a href="{{ route('filterByCategory', $cat->cat_id) }}">{{$cat->category_name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar__filter">
                        <div class="section-title">
                            <h4>Mua sắm theo giá</h4>
                        </div>
                        <form action="{{ route('filterByPrice') }}" method="GET">
                            <div class="filter-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="1000000" data-max="45000000"></div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <p>Giá:</p>
                                        <input type="text" class="font-weight-bold" id="minamount" name="minPrice" placeholder="{{number_format(1000000, 0, ',', '.')}} VND">
                                        <input type="text" class="font-weight-bold" id="maxamount" name="maxPrice" placeholder="{{number_format(45000000, 0, ',', '.')}} VND">
                                    </div>
                                </div>
                                <br>
                                <div class="d-flex gap-1 justify-content-between">
                                    <button type="submit" class="btn btn-outline-dark w-75 mt-1 font-weight-bold" id="filter">Tìm kiếm theo giá</button>
                                    <a href="{{route('shop')}}" class="btn btn-danger font-weight-bold outline-none text-white" style="bottom: 0 !important; padding:10px 16px 10px 16px;"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="row mb-4">
                    <div class="col-lg-4">
                        <p>Hiển thị {{ $products->count() }} trên tổng số {{ $products->total() }} sản phẩm <span style="color: red;">(*)</span></p>
                    </div>
                    <div class="col-lg-8">
                        <div>
                            <form action="{{ route('shopSearch') }}" method="GET" class="d-flex justify-content-end mr-2">
                                <select class="custom-select mr-2 w-auto" name="sort" onchange="this.form.submit()">
                                    <option value="asc">Giá: Thấp đến Cao</option>
                                    <option value="desc">Giá: Cao đến Thấp</option>
                                </select>
                                <div class="input-group">
                                    <input type="text" class="form-control w-auto" value="{{session('search')}}" style="min-width: 200px;" placeholder="Tìm kiếm sản phẩm..." name="search">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if($products->count()==0)
                    <h2 class="text-center fs-4 mx-auto font-weight-bold w-75">
                        Không có sản phẩm nào được tìm thấy.
                    </h2>
                    @else
                    @foreach($products as $index => $product)
                    @if($product->quantity > 0)
                    <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{asset('storage/'.$product->image)}}">
                                @if($index / 2 ==0)
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
                    <div class="col-lg-12 text-center">
                        <!-- <div class="pagination__option"> -->
                        {{ $products->links() }}
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

@endsection