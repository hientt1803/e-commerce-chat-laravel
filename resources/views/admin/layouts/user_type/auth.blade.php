@extends('admin.layouts.app')

@section('auth')

<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<!-- Nucleo Icons -->
<link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
<!-- CSS Files -->
<link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />

<!--   Core JS Files   -->
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../assets/js/plugins/fullcalendar.min.js"></script>
<script src="../assets/js/plugins/chartjs.min.js"></script>

@if(\Request::is('static-sign-up'))
@include('admin.layouts.navbars.guest.nav')
@yield('content')
@include('admin.layouts.footers.guest.footer')

@elseif (\Request::is('static-sign-in'))
@include('admin.layouts.navbars.guest.nav')
@yield('content')
@include('admin.layouts.footers.guest.footer')

@else
@if (\Request::is('rtl'))
@include('admin.layouts.navbars.auth.sidebar-rtl')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
    @include('admin.layouts.navbars.auth.nav-rtl')
    <div class="container-fluid py-4">
        @yield('content')
        @include('admin.layouts.footers.auth.footer')
    </div>
</main>

@elseif (\Request::is('profile'))
@include('admin.layouts.navbars.auth.sidebar')
<div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    @include('admin.layouts.navbars.auth.nav')
    @yield('content')
</div>

@elseif (\Request::is('virtual-reality'))
@include('admin.layouts.navbars.auth.nav')
<div class="border-radius-xl mt-3 mx-3 position-relative" style="background-image: url('../assets/img/vr-bg.jpg') ; background-size: cover;">
    @include('admin.layouts.navbars.auth.sidebar')
    <main class="main-content mt-1 border-radius-lg">
        @yield('content')
    </main>
</div>
@include('admin.layouts.footers.auth.footer')

@else
@include('admin.layouts.navbars.auth.sidebar')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
    @include('admin.layouts.navbars.auth.nav')
    <div class="container-fluid py-4">
        @yield('content')
        @include('admin.layouts.footers.auth.footer')
    </div>
</main>
@endif

@endif

@endsection