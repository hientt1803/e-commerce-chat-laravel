@extends('admin.layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Các cuộc hội thoại</h5>
                        </div>
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
                    <div class="card shadow-none border-1 rounded mx-4 my-2 p-2 position-relative">
                        <a href="{{ url('admin/conversation-management/1') }}">
                            <div class="d-flex justify-content-between fs-6">
                                <span class="fw-bolder text-black">
                                    Jessica
                                </span>
                                <span class="fw-bolder text-black-50">
                                    2024-03-03 21:56:07
                                </span>
                            </div>
                            <div class="d-flex flex-wrap">
                                abbbbbbbbbb bbbbbbbbbbbbbbbb bbbbbbbbbbbbbbb bbbbbbbbbbbbbbb bbbbbbbbbbbbbb bbbbbbbbbbb aaaaa bbbb cccccc
                            </div>

                            <!-- Notification -->
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                new
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection