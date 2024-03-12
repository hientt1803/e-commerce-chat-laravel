@extends('client.layouts.user_type.guest')

@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Giỏ hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
    <div class="container">
        <form action="{{ url('/check-out-process') }}" method="POST">
            @csrf
            @method('POST')

            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>STT</th>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá thành</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @php
                            $totalPrice = 0;
                            @endphp
                            <tbody>
                                @foreach($cartDetails as $index => $cart)
                                @php
                                $totalPrice += $cart->product->price * $cart->quantity;
                                @endphp
                                <tr>
                                    <td class="cart__price">
                                        <input type="checkbox" name="selected_items[{{$index}}]" value="{{$cart->cart_detail_id}}" style="transform: scale(1.5);">
                                    </td>
                                    <td class="cart__price">
                                        <span class="text-dark">
                                            {{$index+1}}
                                        </span>
                                    </td>
                                    <td class="cart__product__item">
                                        <img src="{{asset('/storage/'.$cart->product->image)}}" style="width: 250px;height:200px;" alt="">
                                        <div class="cart__product__item__title">
                                            <h6>{{$cart->product->product_name}}</h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">{{number_format($cart->product->price, 0, ',', '.')}} VND</td>
                                    <td class="cart__quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="{{$cart->quantity}}">
                                        </div>
                                    </td>
                                    <td class="cart__total">{{number_format($cart->product->price * $cart->quantity, 0, ',', '.')}} VND</td>
                                    <td class="cart__close">
                                        <button type="button" onclick="deleteCartItem('{{ $cart->cart_detail_id }}')" class="cart__close outline-none rounded-circle border-0">
                                            <span class="icon_close"></span>
                                        </button>
                                        <script>
                                            function deleteCartItem(cartDetailId) {
                                                $.ajax({
                                                    url: '/cart-detail/' + cartDetailId,
                                                    type: 'POST',
                                                    data: {
                                                        _token: "{{ csrf_token() }}",
                                                        _method: 'DELETE',
                                                    },
                                                    success: function(response) {
                                                        alert('Mục đã được xóa thành công!');
                                                        location.reload();
                                                    },
                                                    error: function(xhr, status, error) {
                                                        alert('Xảy ra lỗi khi xóa mục: ' + error);
                                                    }
                                                });
                                            }
                                        </script>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="/shop">Tiếp tục mua sắm</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn update__btn">
                        <a href="/cart-detail"><span class="icon_loading"></span> Cập nhật giỏ hàng</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <!-- <div class="discount__content">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Enter your coupon code">
                        <button type="submit" class="site-btn">Apply</button>
                    </form>
                </div> -->
                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Tổng quan giỏ hàng</h6>
                        <ul>
                            <li>Tổng phụ <span>{{ number_format($totalPrice, 0, ',', '.') }} VND</span></li>
                            <li>Tổng tiền <span>{{ number_format($totalPrice, 0, ',', '.') }} VND</span></li>
                        </ul>
                        <button type="submit" class="site-btn">Tiến hành thanh toán</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Shop Cart Section End -->

@endsection