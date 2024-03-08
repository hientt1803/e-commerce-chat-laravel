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
                            <h5 class="mb-0">Cập nhật nhân viên</h5>
                        </div>
                        <a href="{{ url('admin/users-management') }}" class="btn bg-gradient-primary btn-sm mb-0 d-flex align-items-center" type="button"><i class="fas fa-arrow-left"></i>&nbsp; Trở về</a>
                    </div>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <form method="POST" action="{{ url('admin/users-management/update') . '/' . $user->user_id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fullname" class="form-control-label">Họ và tên</label>
                                    <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" value="{{$user->fullname}}" placeholder="Họ và tên" id="fullname" name="fullname">
                                        @error('fullname')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-control-label">Hình ảnh</label>
                                    <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="file" value="storage/{{$user->image}}" placeholder="Choose users image" id="image" name="image">
                                        @error('image')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email</label>
                                    <input class="form-control" type="email" value="{{$user->email}}" placeholder="abc@gmail.com" id="email" name="email">
                                    @error('email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-control-label">Mật khẩu</label>
                                    <input class="form-control" type="password" value="{{$user->password}}" placeholder="12345" id="password" name="password">
                                    @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address" class="form-control-label">Địa chỉ</label>
                                    <input class="form-control" type="input" value="{{$user->address}}" placeholder="TP.HCM" id="address" name="address">
                                    @error('address')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-control-label">SĐT</label>
                                    <input class="form-control" type="number" value="{{$user->phone}}" placeholder="07******" id="phone" name="phone">
                                    @error('phone')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender" class="form-control-label">Giới tính</label>
                                    <div>
                                        <input type="radio" {{ $user->gender == 1 ? 'checked' : '' }} id="gender_male" name="gender" value="1">
                                        <label for="gender_male">Nam</label><br>
                                        <input type="radio" {{ $user->gender == 0 ? 'checked' : '' }} id="gender_female" name="gender" value="0">
                                        <label for="gender_female">Nữ</label><br>
                                    </div>
                                    @error('gender')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role" class="form-control-label">Phân quyền</label>
                                    <div>
                                        <input type="radio" id="role_user" {{ $user->role == 'user' ? 'checked' : '' }} name="role" value="user">
                                        <label for="role_user">Nhân viên</label><br>
                                        <input type="radio" id="role_admin" {{ $user->role == 'admin' ? 'checked' : '' }} name="role" value="admin">
                                        <label for="role_admin">Quản trị viên</label><br>
                                    </div>
                                    @error('role')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-primary">Cập nhật nhân viên</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection