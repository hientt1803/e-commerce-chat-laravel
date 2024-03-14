@extends('client.layouts.user_type.guest')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Toast -->
<div id="snackbar" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
    <div class="toast-header bg-transparent d-flex justify-content-between">
        <strong class="me-auto">Thông báo</strong>
        <button type="button" class="outline-none border-0 bg-transparent"><i class="fa fa-bell" aria-hidden="true"></i></button>
    </div>
    <div class="toast-body" id="snackbarMessage">
    </div>
</div>

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
                                            <input type="text" value="{{ $cart->quantity }}" class="cart-item-quantity" data-cart-id="{{ $cart->cart_detail_id }}">
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
                                                        showSnackbar('Sản phẩm đã được xóa thành công!');
                                                        location.reload();
                                                    },
                                                    error: function(xhr, status, error) {
                                                        showSnackbar('Xóa giỏ hàng thất bại! Liên hệ ngay cho admin.');
                                                    }
                                                });
                                            }

                                            function showSnackbar(message) {
                                                var x = document.getElementById("snackbarMessage");
                                                var snackbar = document.getElementById("snackbar");
                                                snackbar.className = "show";
                                                x.innerText = message;
                                                setTimeout(function() {
                                                    x.className = x.className.replace("show", "");
                                                }, 8000);
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
                        <button type="button" onclick="updateCartItem()" class="outline-none border-0" style="padding: 14px 30px 12px;"><span class="icon_loading"></span> <span>Cập nhật giỏ hàng</span></button>
                    </div>

                    <script>
                        function updateCartItem() {
                            alert('run?')
                            var cartItems = [];
                            $('.cart-item-quantity').each(function() {
                                var cartId = $(this).data('cart-id');
                                var quantity = $(this).val();
                                cartItems.push({
                                    cart_detail_id: cartId,
                                    quantity: quantity
                                });
                            });

                            $.ajax({
                                url: '/cart-detail-update',
                                type: 'POST',
                                data: {
                                    cartDetails: cartItems,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    console.log('run?');
                                    console.log(
                                        response
                                    );
                                    showSnackbar(response.message);
                                },
                                error: function(xhr) {
                                    showSnackbar('Cập nhật giỏ hàng thất bại! Liên hệ ngay cho admin.');
                                }
                            });
                        }

                        function showSnackbar(message) {
                            var x = document.getElementById("snackbarMessage");
                            var snackbar = document.getElementById("snackbar");
                            snackbar.className = "show";
                            x.innerText = message;
                            setTimeout(function() {
                                x.className = x.className.replace("show", "");
                            }, 8000);
                        }
                    </script>
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
                        <button type="submit" class="site-btn w-100">Tiến hành thanh toán</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Shop Cart Section End -->

@endsection