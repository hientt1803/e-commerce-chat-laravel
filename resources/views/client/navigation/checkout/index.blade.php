@extends('client.layouts.user_type.guest')

@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Thanh toán</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        @php
        $totalPrice = 0
        @endphp
        <form action="/check-out" method="POST" enctype="multipart/form-data" class="checkout__form">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-lg-7">
                    <h5>Thông tin chi tiết hóa đơn</h5>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>Tên người nhận<span>*</span></p>
                                <input type="text" placeholder="Nguyễn Văn An" name="name_receiver" required>
                                @error('name_receiver')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                <p>Số điện thoại<span>*</span></p>
                                <input type="text" placeholder="+84" name="phone_receiver" required>
                                @error('phone_receiver')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Địa chỉ <span>*</span></p>
                                <input type="text" placeholder="Tên đường, phường, xã" name="address_receiver" required>
                                @error('name_receiver')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="checkout__form__input">
                                <p>Mô tả <span>(Không bắt buộc)</span></p>
                                <textarea class="w-100" rows="3" name="notes" placeholder="Nội dung" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="checkout__order">
                        <h5>Đơn đặt hàng của bạn</h5>
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <span class="top__text">Sản phẩm</span>
                                    <span class="top__text__right">Tổng tiền</span>
                                </li>
                                @foreach($cartDetails as $index => $item)
                                @php
                                $totalPrice += $item->product->price * $item->quantity;
                                @endphp
                                <li class="d-flex justify-content-between g-2"><span class="text-truncate float-start" style="max-width: 250px;"> 0{{$index+1}}. {{$item->product->product_name}}</span> <span class="float-end">{{number_format($item->product->price * $item->quantity, 0, ',', '.')}} VND</span></li>

                                <!-- add product to hidden input -->
                                <input type="hidden" name="productDetail[{{$index}}][product_id]" value="{{$item->product->product_id}}">
                                <input type="hidden" name="productDetail[{{$index}}][quantity]" value="{{$item->quantity}}">
                                <input type="hidden" name="productDetail[{{$index}}][price]" value="{{$item->product->price}}">
                                <input type="hidden" name="productDetail[{{$index}}][cart_detail_id]" value="{{$item->cart_detail_id}}">
                                @endforeach

                            </ul>
                        </div>
                        <div class="checkout__order__total">
                            <ul>
                                <li>Tổng phụ <span>{{number_format($totalPrice, 0, ',', '.')}} VND</span></li>
                                <li>Tổng tiền <span>{{number_format($totalPrice, 0, ',', '.')}} VND</span></li>
                                <!-- hidden total price-->
                                <input type="hidden" name="totalPrice" value="{{$totalPrice}}">
                            </ul>
                        </div>
                        <button type="submit" class="site-btn w-100">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Checkout Section End -->

@endsection