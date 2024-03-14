@extends('client.layouts.user_type.guest')

@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Lịch sử đặt hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Section Begin -->
<section class="order-history spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="order-history__content">
                    <div class="card mb-4 mx-4">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã đơn hàng</th>
                                            <th>Ngày đặt hàng</th>
                                            <th>Tình trạng</th>
                                            <th>Tổng tiền</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orderHistory as $index => $order)
                                        <tr>
                                            <td class="cart__price">
                                                <span class="text-dark">
                                                    {{$index+1}}
                                                </span>
                                            </td>
                                            <td class="cart__price">
                                                <span class="text-dark">
                                                    #{{$order->order_id . str_pad(random_int(0, 9999999999), 5, '0', STR_PAD_LEFT)}}
                                                </span>
                                            </td>
                                            <td class="cart__price">
                                                <span class="text-dark">{{$order->create_at}}</span>
                                            </td>
                                            <td class="cart__price">
                                                @switch($order->status)
                                                @case('đang chờ')
                                                <span class="badge bg-warning p-2 text-dark">Đang chờ</span>
                                                @break
                                                @case('đang giao')
                                                <span class="badge bg-primary p-2 text-white">Đang giao</span>
                                                @break
                                                @case('đã giao')
                                                <span class="badge bg-success p-2 text-white">Đã giao</span>
                                                @break
                                                @case('đã hủy')
                                                <span class="badge bg-danger p-2 text-white">Đã hủy</span>
                                                @break
                                                @default
                                                <span class="badge bg-warning p-2 text-dark">Đang chờ</span>
                                                @endswitch
                                            </td>
                                            <td class="cart__total">{{number_format($order->total_price, 0, ',', '.')}} VND</td>
                                            <td class="cart__total">
                                                @if($order->status == 'đang chờ')
                                                <button class="site-btn rounded-0 w-100">
                                                    Hủy đơn hàng
                                                </button>
                                                @elseif($order->status=='đang giao')
                                                <button class="btn btn-success w-100">
                                                    Xác nhận đã nhận
                                                </button>
                                                @elseif($order->status=='đã giao')
                                                <button class="btn btn-secondary disabled w-100" style="cursor: not-allowed;">
                                                    Đã giao
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Checkout Section End -->

@endsection