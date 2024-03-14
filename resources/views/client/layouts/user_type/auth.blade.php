@extends('client.layouts.app')

@section('guest')
@if(\Request::is('login/forgot-password'))
@include('client.layouts.navbar.navbar')
@yield('content')
@else
@include('client.layouts.navbar.navbar')
<div class="container">
    <div class="row mt-5">
        <div class="col-2 p-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <img src="{{asset('assets/client/img/logo.png')}}" alt="" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                <div class="text-truncate text-dark ms-2 font-weight-bold">{{session('customer')->customer_name}}</div>
            </div>
            <ul class="list-unstyled mt-5">
                <li class="d-flex justify-content-center align-items-center" style="gap: 12px;">
                    <i class="fa fa-address-book-o" aria-hidden="true"></i>
                    <a href="/user/profile" class="text-dark">Tài khoản của tôi</a>
                </li>
                <li class="d-flex justify-content-center align-items-center" style="gap: 12px;">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    <a href="/user/order-history" class="text-dark">Lịch sử đơn hàng</a>
                </li>
            </ul>
        </div>
        <div class="col-10 p-3">
            @yield('content')
        </div>
    </div>
</div>
@include('client.layouts.footer.footer')
@endif
@endsection