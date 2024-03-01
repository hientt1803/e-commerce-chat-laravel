@extends('admin.layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Create new Products</h5>
                        </div>
                        <a href="{{ url('admin/products-management') }}" class="btn bg-gradient-primary btn-sm mb-0 d-flex align-items-center" type="button"><i class="fas fa-arrow-left"></i>&nbsp; Comeback</a>
                    </div>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form method="POST" action="/admin/products-management" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_name" class="form-control-label">Product Name</label>
                                    <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="product name" id="product_name" name="product_name">
                                        @error('product_name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="form-control-label">Price (VNĐ)</label>
                                    <input class="form-control" type="number" value="00" id="price" name="price">
                                    @error('price')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cat_id">Categories</label>
                                    <select class="form-control" id="cat_id" name="cat_id">
                                        @foreach($categories as $index => $category)
                                        <option value="{{$category->cat_id}}">
                                            {{$category->category_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('cat_id')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity" class="form-control-label">Quantity</label>
                                    <input class="form-control" type="number" placeholder="00" id="quantity" name="quantity">
                                    @error('quantity')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-control-label">Product Image</label>
                                    <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="file" placeholder="Choose product image" id="image" name="image">
                                        @error('image')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                                    @error('description')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Create Products</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection