@extends('admin.layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Danh mục</h5>
                        </div>
                        <a href="{{ url('admin/categories-management-create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tạo danh mục</a>
                    </div>
                </div>
                @if(session('success'))
                <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                    <span class="alert-text text-white">
                        {{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                </div>
                @endif
                <div class="ms-auto me-4 mt-3">
                    <form action="{{ url('admin/categories-management-search') }}" method="GET">
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" class="form-control" style="width: 250px;" placeholder="Tên danh mục" name="search" value="{{ request()->search }}" aria-describedby="button-search-category">
                            <button class="btn btn-outline-secondary mb-0" type="submit" id="button-search-category"><i class="ni ni-send"></i></button>
                        </div>
                    </form>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="categoriesTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tên danh mục
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
                                @foreach($categories as $index => $category)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $index + 1 }}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs font-weight-bold mb-0">{{ $category->category_name }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            @if($category->status == 1)
                                            <span class="badge bg-primary">Đang hoạt động</span>
                                            @else
                                            <span class="badge bg-warning text-dark">Vô hiệu hóa</span>
                                            @endif
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $category->create_at }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('admin/categories-management-edit/' . $category->cat_id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $category->cat_id }}">
                                            @if($category->status == 0)
                                            <i class="fas fa-undo text-secondary cursor-pointer"></i>
                                            @else
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            @endif
                                        </span>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $category->cat_id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Bạn có chắc chắn muốn xóa danh mục {{$category->category_name}}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <form method="POST" action="{{ url('admin/categories-management/delete') . '/' . $category->cat_id}}">
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
                        <div class="float-end ms-auto mx-4 ps-auto mt-5">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection