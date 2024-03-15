@extends('client.layouts.user_type.auth')

@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option pt-0">
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
<section class="mb-5">
    <div class="row">
        @foreach($orderHistory as $index => $order)
        <div class="col-lg-12 mb-5 shadow-sm p-3">
            <div class="d-flex justify-content-between">
                <div class="d-flex" style="gap: 5px;">
                    <span class="badge bg-warning p-2 text-dark">Yêu thích</span>
                    <span class="text-dark font-weight-bold text-truncate" style="max-width: 250px;">Đơn hàng: #{{$order->order_id . str_pad(random_int(0, 9999999999), 5, '0', STR_PAD_LEFT)}}</span>
                </div>
                <div class="d-flex align-items-center" style="gap: 3px;">
                    @switch($order->status)
                    @case('đang chờ')
                    <i class="fa fa-truck text-warning" aria-hidden="true"></i>
                    <span class="text-warning">Đơn hàng của bạn đang chờ xác nhận</span>
                    @break
                    @case('đang giao')
                    <i class="fa fa-truck text-primary" aria-hidden="true"></i>
                    <span class="text-primary">Đơn hàng của bạn đang được vận chuyển</span>
                    @break
                    @case('đã giao')
                    <i class="fa fa-truck text-success" aria-hidden="true"></i>
                    <span class="text-success">Đơn hàng của bạn đã giao thành công</span>
                    @break
                    @case('đã hủy')
                    <i class="fa fa-truck text-danger" aria-hidden="true"></i>
                    <span class="text-danger">Đơn hàng của bạn đã đưuọc hủy</span>
                    @break
                    @default
                    <i class="fa fa-truck text-warning" aria-hidden="true"></i>
                    <span class="text-warning">Đơn hàng của bạn đang chờ xác nhận</span>
                    @endswitch
                </div>
            </div>
            <hr class="dropdown-divider">
            <div class="my-2">
                @if($order->orderDetail && $order->orderDetail->count() > 0)
                @foreach($order->orderDetail as $i => $orderDetail)
                <div class="row">
                    <div class="col-2 mb-2">
                        <img src="{{asset('/storage/' . $orderDetail->product->image)}}" alt="" width="175" height="150">
                    </div>
                    <div class="col-7 d-flex flex-column" style="gap: 5px;">
                        <span class="text-dark font-weight-bold">
                            {{$orderDetail->product->product_name}}
                        </span>
                        <span class="text-muted">
                            Số lượng: {{$orderDetail->quantity}}
                        </span>
                    </div>
                    <div class="col-3">
                        <span class="text-danger font-weight-bold">{{number_format($orderDetail->product->price, 0, ',', '.')}} VND</span>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <hr class="dropdown-divider">
            <div class="my-2">
                Tổng thành tiền: <span class="fs-4 text-danger font-weight-bold">{{number_format($order->total_price, 0, ',', '.')}} VND</span>
            </div>
            <div class="mt-3 d-flex justify-content-between ">
                <span>Đơn hàng được khỏi tạo ngày: <span class="text-dark">{{$order->create_at}}</span>.</span>
                <form action="{{url('/user/order-history/' . $order->order_id)}}" method="POST">
                    @csrf
                    @if($order->status=='đang giao')
                    @method('PUT')
                    @else
                    @method('DELETE')
                    @endif
                    <div class="d-flex" style="gap: 3px;">
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
                    </div>
                </form>
            </div>
        </div>
        @endforeach
        <div>
            {{$orderHistory->links()}}
        </div>
    </div>
</section>
<!-- Checkout Section End -->

@endsection