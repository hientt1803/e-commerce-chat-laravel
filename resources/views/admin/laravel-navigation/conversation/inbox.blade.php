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
                    <div class="d-flex justify-content-start gap-3">
                        <a href="{{ url('admin/conversation-management') }}" class="mb-0 d-flex align-items-center" type="button"><i class="fas fa-arrow-left fs-6"></i></a>
                        <div>
                            <h5 class="mb-0 fw-bolder text-dark fs-5">
                                Jessica
                            </h5>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection