@extends('client.layouts.app')

@section('guest')
    @if(\Request::is('login/forgot-password')) 
        @include('client.layouts.navbar.navbar')
        @yield('content') 
    @else
        @include('client.layouts.navbar.navbar')
        @yield('content')        
        @include('client.layouts.footer.footer')
    @endif
@endsection