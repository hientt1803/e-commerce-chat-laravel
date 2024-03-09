@extends('admin.layouts.user_type.auth')

@section('content')

<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<!-- Nucleo Icons -->
<link href="../../../assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="../../../assets/css/nucleo-svg.css" rel="stylesheet" />
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<link href="../../../assets/css/nucleo-svg.css" rel="stylesheet" />
<!-- CSS Files -->
<link id="pagestyle" href="../../../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Cập nhật sản phẩm</h5>
                        </div>
                        <a href="{{ url('admin/products-management') }}" class="btn bg-gradient-primary btn-sm mb-0 d-flex align-items-center" type="button"><i class="fas fa-arrow-left"></i>&nbsp; Trở về</a>
                    </div>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form method="POST" action="{{ url('admin/products-management/update') . '/' . $product->product_id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_name" class="form-control-label">Tên sản phẩm</label>
                                    <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" value="{{$product->product_name}}" placeholder="product name" id="product_name" name="product_name">
                                        @error('product_name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="form-control-label">Giá (VNĐ)</label>
                                    <input class="form-control" type="number" value="{{$product->price}}" value="00" id="price" name="price">
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
                                        <option value="{{$category->cat_id}}" @if($product->cat_id == $category->cat_id) selected @endif>
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
                                    <label for="quantity" class="form-control-label">Số lượng</label>
                                    <input class="form-control" type="number" value="{{$product->quantity}}" placeholder="00" id="quantity" name="quantity">
                                    @error('quantity')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-control-label">Hình ảnh</label>
                                    <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="file" placeholder="Choose product image" id="image" name="image">
                                        @error('image')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                        <!-- Display current product image -->
                                        <div class="my-2 bg-white p-2">
                                            @if($product->image)
                                            <img src="{{ asset('storage/'.$product->image) }}" alt="Current Product Image" style="width: 200px; height: 200px;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea class="form-control" id="description" rows="3" name="description">
                                    {{$product->description}}
                                    </textarea>
                                    @error('description')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-primary">Cập nhật sản phẩm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection