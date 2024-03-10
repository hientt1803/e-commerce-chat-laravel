@extends('admin.layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Khách hàng</h5>
                        </div>
                        <a href="{{ url('admin/customers-management-create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tạo khách hàng</a>
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
                                        Tên khách hàng
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Mật khẩu
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ngày sinh
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Địa chỉ
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Số điện thoại
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Trạng thái
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ngày tạo
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $index => $customer)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $index + 1 }}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs font-weight-bold mb-0">{{ $customer->customer_name }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs font-weight-bold mb-0">{{ $customer->email }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs font-weight-bold mb-0 text-truncate" style="max-width: 100px;">{{ $customer->password }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs font-weight-bold mb-0">{{ $customer->birthday }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs font-weight-bold mb-0">{{ $customer->address }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs font-weight-bold mb-0">{{ $customer->phone }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            @if($customer->status == 1)
                                            <span class="badge bg-primary">Đang hoạt động</span>
                                            @else
                                            <span class="badge bg-warning text-dark">Vô hiệu hóa</span>
                                            @endif
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $customer->create_at }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('admin/customers-management-edit/' . $customer->customer_id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit customer">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $customer->customer_id }}">
                                            @if($customer->status == 0)
                                            <i class="fas fa-undo text-secondary cursor-pointer"></i>
                                            @else
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            @endif
                                        </span>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $customer->customer_id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Bạn có chắc chắn muốn xóa khách hàng {{$customer->customer_name}}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <form method="POST" action="{{ url('admin/customers-management/delete') . '/' . $customer->customer_id}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="float-right mx-4 ps-auto mt-5">
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection