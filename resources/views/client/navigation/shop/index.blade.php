@extends('client.layouts.user_type.guest')

@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Home</a>
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
                                    <button type="submit" class="btn btn-outline-dark w-fit float-start mt-1 font-weight-bold" id="filter">Tìm kiếm theo giá</button>
                                    <a href="{{route('shop')}}" class="btn btn-danger font-weight-bold outline-none text-white" style="bottom: 0 !important; padding:5px 16px 5px 16px;"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    @if($products->count()==0)
                    <h2 class="text-center fs-4 mx-auto font-weight-bold w-75">
                        Không có sản phẩm nào được tìm thấy.
                    </h2>
                    @else
                    @foreach($products as $index => $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{asset('storage/'.$product->image)}}">
                                @if($index / 2 ==0)
                                <div class="label new">New</div>
                                @endif
                                <ul class="product__hover">
                                    <li><a href="{{asset('storage/'.$product->image)}}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">{{$product->product_name}}</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">{{number_format($product->price, 0, ',', '.')}} VND</div>
                            </div>
                        </div>
                    </div>
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