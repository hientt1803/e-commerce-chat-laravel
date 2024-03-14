@extends('client.layouts.user_type.auth')

@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option pt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Tài khoản</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<section class="shop quad">
    <div class="container">
        <div class="top-title">
            <h3>Hồ Sơ Của Tôi</h3>
            <p class="text-muted">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
            <hr class="dropdown-divider">
        </div>

        <form action="{{url('/user/user-profile/'.session('customer')->customer_id)}}" method="POST" enctype="multipart/form-data" class="checkout__form">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="checkout__form__input">
                        <p>Họ và tên<span>*</span></p>
                        <input type="text" placeholder="Nguyễn Văn An" value="{{session('customer')->customer_name}}" name="customer_name" required>
                        @error('customer_name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="checkout__form__input">
                        <p>Email<span>*</span></p>
                        <input type="text" placeholder="abc@gmail.com" value="{{session('customer')->email}}" name="email" required>
                        @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="checkout__form__input">
                        <p>Số điện thoại<span>*</span></p>
                        <input type="text" placeholder="+84" value="{{session('customer')->phone}}" name="phone" required>
                        @error('phone')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="checkout__form__input">
                        <p>Ngày sinh<span>*</span></p>
                        <input class="form-control" type="date" id="birthday" value="{{session('customer')->birthday}}" name="birthday" required>
                        @error('birthday')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="checkout__form__input">
                        <p>Địa chỉ <span>*</span></p>
                        <input type="text" placeholder="Tên đường, phường, xã" value="{{session('customer')->address}}" name="address" required>
                        @error('address')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="site-btn rounded-0">Lưu thay đổi</button>
            </div>
            <span class="text-dark mt-3">
                Bạn muốn đổi mật khẩu mới? <a href="/change-password" class="text-primary ms-2"> Thay đổi mật khẩu.</a>
                Bạn đã quên mật khẩu củ?<a href="/forgot-password" class="text-primary ms-2"> Khôi phục?</a>.
            </span>
        </form>
    </div>
</section>
@endsection