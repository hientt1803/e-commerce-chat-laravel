@extends('admin.layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Cập nhật danh mục</h5>
                        </div>
                        <a href="{{ url('admin/categories-management') }}" class="btn bg-gradient-primary btn-sm mb-0 d-flex align-items-center" type="button"><i class="fas fa-arrow-left"></i>&nbsp; Trở về</a>
                    </div>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form method="POST" action="{{ url('admin/categories-management/update') . '/' . $category->cat_id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_name" class="form-control-label">Tên danh mục</label>
                                <div class="@error('category_name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{$category->category_name}}" type="text" placeholder="category name" id="category_name" name="category_name" required>
                                    @error('category_name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-primary">Cập nhật danh mục</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection