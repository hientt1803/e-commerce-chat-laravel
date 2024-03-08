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
                        @foreach($conversions as $index => $conversion)
                        <a href="{{ url('admin/conversation-management/' . $conversion->cvs_id )}}">
                            <div class="d-flex justify-content-between fs-6">
                                <span class="fw-bolder text-black">
                                    {{$conversion->customer->customer_name}}
                                </span>
                                <span class="fw-bolder text-black-50">
                                    {{$conversion->messages[0]->send_time}}
                                </span>
                            </div>
                            <div class="d-flex flex-wrap ">
                                {{$conversion->messages[0]->content}}
                            </div>

                            <!-- Notification -->
                            @if($conversion->messages[0]->sender_type == 'customer' && $conversion->messages[0]->status == 'chưa đọc')
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                new
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection