@extends('admin.layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Sản phẩm</h5>
                        </div>
                        <a href="{{ url('admin/products-management-create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tạo sản phẩm</a>
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
                                        Tên sản phẩm
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hình ảnh
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Giá
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Số lượng
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Mô tả
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Danh mục
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
                                @foreach($products as $index => $product)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $index + 1 }}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{ $product->product_name }}</p>
                                        </div>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <img src="{{ asset('storage/'.$product->image) }}" alt="Product Image" class="img-responsive avatar avatar-md me-3">
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{ $product->price }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{ $product->quantity }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0 text-truncate" style="max-width: 100px;">{{ $product->description }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{ $product->categories->category_name }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            @if($product->status == 1)
                                            <span class="badge bg-primary">Đang hoạt động</span>
                                            @else
                                            <span class="badge bg-warning text-dark">Vô hiệu hóa</span>
                                            @endif
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $product->create_at }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('admin/products-management-edit/' . $product->cat_id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span type="button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->cat_id }}">
                                            @if($product->status == 0)
                                            <i class="fas fa-undo text-secondary cursor-pointer"></i>
                                            @else
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            @endif
                                        </span>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal{{ $product->cat_id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if($product->status == 1 )
                                                        Bạn có chắc chắn muốn xóa sản phẩm: {{$product->product_name}}?
                                                        @else
                                                        Bạn có chắc chắn muốn khổi phục sản phẩm: {{$product->product_name}}?
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Trở về</button>
                                                        <form method="POST" action="{{ url('admin/products-management/delete') . '/' . $product->cat_id}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                {{$product->status == 1 ? 'Xóa sản phẩm':'Khôi phục'}}
                                                            </button>
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
                        <div class="float-right ml-4 mt-5">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection