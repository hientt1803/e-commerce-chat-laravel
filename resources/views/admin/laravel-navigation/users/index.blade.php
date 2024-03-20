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
                            <h5 class="mb-0">Nhân viên</h5>
                        </div>
                        <a href="{{ url('admin/users-management-create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tạo nhân viên</a>
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
                <div class="ms-auto me-4 mt-3">
                    <form action="{{ url('admin/users-management-search') }}" method="GET">
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" class="form-control" style="width: 250px;" placeholder="Tên nhân viên" name="search" value="{{ request()->search }}" aria-describedby="button-search-user">
                            <button class="btn btn-outline-secondary mb-0" type="submit" id="button-search-user"><i class="ni ni-send"></i></button>
                        </div>
                    </form>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Họ và tên
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Hình ảnh
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Mật khẩu
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Địa chỉ
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        SĐT
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Giới tính
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
                                @foreach($users as $index => $user)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $index + 1 }}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{ $user->fullname }}</p>
                                        </div>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <img src="{{ asset('storage/'.$user->image) }}" alt="user Image" class="img-responsive avatar avatar-md me-3">
                                        <!-- {{$user->image}} -->
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{ $user->email }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0 text-truncate" style="max-width: 100px;">{{ $user->password }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0 text-truncate" style="max-width: 100px;">{{ $user->address }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{ $user->phone }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{ $user->gender == 1 ? 'Nam' : 'Nữ' }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $user->create_at }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('admin/users-management-edit/' . $user->user_id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->user_id }}" class="{{ $user->role == 'admin' ? 'disabled-button' : '' }}">
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $user->user_id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Bạn có chắc chắn muốn xóa nhân viên: {{$user->fullname}}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Trở về</button>
                                                        <form method="POST" action="{{ url('admin/users-management/delete') . '/' . $user->user_id}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Xóa nhân viên</button>
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
                        <div class="float-right mx-4 ml-4 mt-5">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection