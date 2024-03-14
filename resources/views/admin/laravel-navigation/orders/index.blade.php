@extends('admin.layouts.user_type.auth')

@section('content')

<style>
    .disabled-button {
        pointer-events: none;
        opacity: 0.6;
    }
</style>

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Đơn hàng</h5>
                        </div>
                        <!-- <a href="{{ url('admin/orders-management') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tạo sản phẩm</a> -->
                    </div>
                </div>
                @if(session('success'))
                <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                    <span class="alert-text text-white">
                        {{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                </div>
                @endif
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tên người nhận
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Địa chỉ người nhận
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        SĐT người nhận
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tổng tiền
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Mô tả
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Trạng thái
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ngày tạo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Thao tác
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($orders->isEmpty())
                                <h2 class="font-weight-bold text-center m-3">Bạn không có đơn hàng nào</h2>
                                @else
                                @foreach($orders as $index => $order)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $index + 1 }}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{ $order->name_receiver }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{ $order->address_receiver }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{ $order->phone_receiver }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{ $order->total_price }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{ $order->notes }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            @switch($order->status)
                                            @case('đang chờ')
                                            <span class="badge bg-warning text-dark">Đang chờ</span>
                                            @break
                                            @case('đang giao')
                                            <span class="badge bg-primary text-white">Đang giao</span>
                                            @break
                                            @case('đã giao')
                                            <span class="badge bg-success">Đã giao</span>
                                            @break
                                            @case('đã hủy')
                                            <span class="badge bg-danger">Đã hủy</span>
                                            @break
                                            @default
                                            <span class="badge bg-warning text-dark">Đang chờ</span>
                                            @endswitch
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $order->create_at }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="mx-3" data-bs-toggle="modal" data-bs-target="#previewModal{{ $order->order_id }}">
                                            <i class="fas fa-search text-secondary cursor-pointer"></i>
                                        </span>
                                        <span type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $order->order_id }}" class="{{ $order->status == 'đã hủy' || $order->status == 'đã giao'  ? 'disabled-button' : '' }}">
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>

                                        <!-- Preview Modal -->
                                        <div class="modal fade" id="previewModal{{ $order->order_id }}" tabindex="-1" aria-labelledby="previewModal" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="previewModal">Thông tin chi tiết đơn hàng</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="w-full text-white" style="background: #25a99b;">
                                                            <span class="d-flex justify-content-between p-5">
                                                                <span class="text-white fs-5 text-truncate align-items-center">
                                                                    @switch($order->status)
                                                                    @case('đang chờ')Đang chờ xác nhận
                                                                    @break
                                                                    @case('đang giao')Đang giao
                                                                    @break
                                                                    @case('đã giao')
                                                                    Đơn hàng đã giao
                                                                    @break
                                                                    @case('đã hủy')
                                                                    Đơn hàng đã hủy
                                                                    @break
                                                                    @default
                                                                    Đang chờ xác nhận
                                                                    @endswitch
                                                                </span>
                                                                <span><i class="fas fa-box-open text-white fs-1"></i></span>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex align-items-center gap-1">
                                                                <span class="text-secondary">Mã đơn hàng <span class="text-danger">*</span>: </span>
                                                                <span class="text-dark font-weight-bold">{{$order->order_id}}{{$order->create_at}}</span>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-1">
                                                                <span class="text-secondary">Trạng thái <span class="text-danger">*</span>: </span>
                                                                <span class="text-dark font-weight-bold">
                                                                    @switch($order->status)
                                                                    @case('đang chờ')
                                                                    <span class="badge bg-warning text-dark">Đang chờ</span>
                                                                    @break
                                                                    @case('đang giao')
                                                                    <span class="badge bg-primary">Đang giao</span>
                                                                    @break
                                                                    @case('đã giao')
                                                                    <span class="badge bg-success">Đã giao</span>
                                                                    @break
                                                                    @case('đã hủy')
                                                                    <span class="badge bg-danger">Đã hủy</span>
                                                                    @break
                                                                    @default
                                                                    <span class="badge bg-warning text-dark">Đang chờ</span>
                                                                    @endswitch
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex align-items-center gap-1">
                                                                <span class="text-secondary">Ngày tạo <span class="text-danger">*</span>: </span>
                                                                <span class="text-dark font-weight-bold">{{$order->create_at}}</span>
                                                            </div>
                                                        </div>
                                                        <hr class="mb-3">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-6 col-sm-12 d-flex flex-column align-items-start">
                                                                <span class="text-secondary">Tên người nhận</span>
                                                                <span class="text-dark font-weight-bold">{{$order->name_receiver}}</span>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 col-sm-12 d-flex flex-column align-items-center">
                                                                <span class="text-secondary">Địa chỉ người nhận</span>
                                                                <span class="text-dark font-weight-bold">{{$order->address_receiver}}</span>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 col-sm-12 d-flex flex-column align-items-end text-start">
                                                                <span class="text-secondary">SĐT người nhận</span>
                                                                <span class="text-dark font-weight-bold">{{$order->phone_receiver}}</span>
                                                            </div>
                                                            <div class="col-12 d-flex align-items-center gap-1 mt-2">
                                                                <span class="text-secondary">Ghi chú:</span>
                                                                <span class="text-dark font-weight-bold">{{$order->notes}}</span>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="d-flex align-items-center gap-1">
                                                            <span class="text-secondary">Tổng số lượng sản phẩm <span class="text-danger">*</span>: </span>
                                                            <span class="text-dark font-weight-bold">
                                                                {{ count($order->orderDetail) }}
                                                            </span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="table-responsive p-0">
                                                                <table class="table align-items-center mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                                ID
                                                                            </th>
                                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                                Tên sản phẩm
                                                                            </th>
                                                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                                Hình ảnh
                                                                            </th>
                                                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                                Giá
                                                                            </th>
                                                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                                Danh mục
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($order->orderDetail as $detail)
                                                                        <tr>
                                                                            <td class="ps-4">
                                                                                <p class="text-xs font-weight-bold mb-0">{{ $loop->parent->iteration }}</p>
                                                                            </td>
                                                                            <td>
                                                                                <div>
                                                                                    <p class="text-xs font-weight-bold mb-0">{{ $detail->product->product_name }}</p>
                                                                                </div>
                                                                            </td>
                                                                            <td class="d-flex justify-content-center">
                                                                                <img src="{{ asset('storage/'.$detail->product->image) }}" alt="Product Image" class="img-responsive avatar avatar-md me-3">
                                                                            </td>
                                                                            <td>
                                                                                <div>
                                                                                    <p class="text-xs font-weight-bold mb-0">{{number_format($detail->product->price, 0, ',', '.')}}</p>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div>
                                                                                    <p class="text-xs font-weight-bold mb-0">{{ $detail->product->categories->category_name }}</p>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-between">
                                                        <span class="text-secondary fs-5">
                                                            Tổng tiền: <strong> {{number_format($order->total_price, 0, ',', '.')}}</strong> VNĐ.
                                                        </span>
                                                        <div class="d-flex gap-2">
                                                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Trở về</button>
                                                            <form method="POST" action="{{ url('admin/orders-management/update') . '/' . $order->order_id}}">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-primary" {{ $order->status == 'đã hủy' || $order->status == 'đã giao' || $order->status == 'đang giao' ? 'disabled' : null }}>Xác nhận giao đơn hàng</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $order->order_id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Xác nhận hủy đơn hàng</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Bạn có chắc chắn muốn hủy đơn hàng: {{$order->order_id}}.{{$order->create_at}}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Trở về</button>
                                                        <form method="POST" action="{{ url('admin/orders-management/delete') . '/' . $order->order_id}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hủy đơn hàng</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>

                        </table>
                        <div class="float-right mx-4 ml-4 mt-5">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection