<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
    <title>
        Augentern Shop
    </title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href=" {{asset('assets/client/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href=" {{asset('assets/client/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href=" {{asset('assets/client/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href=" {{asset('assets/client/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href=" {{asset('assets/client/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href=" {{asset('assets/client/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href=" {{asset('assets/client/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href=" {{asset('assets/client/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href=" {{asset('assets/client/css/custom.css')}}" type="text/css">
</head>

<style>
    .customer-search-input input {
        width: 500px;
        font-size: 40px;
        border: none;
        border-bottom: 2px solid #dddddd;
        background: 0 0;
        color: #999;
    }
</style>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="#"><span class="icon_heart_alt"></span>
                    <div class="tip">2</div>
                </a></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                    <div class="tip">2</div>
                </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="/"><img src="{{asset('assets/client/img/logo.png')}}" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="#">Login</a>
            <a href="#">Register</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Toast message Begin -->
    @if(session('toastMsg'))
    <div id="snackbar" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
        <div class="toast-header bg-transparent d-flex justify-content-between">
            <strong class="me-auto">Thông báo</strong>
            <button type="button" class="outline-none border-0 bg-transparent"><i class="fa fa-bell" aria-hidden="true"></i></button>
        </div>
        <div class="toast-body">
            {{session('toastMsg')}}
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 8000);
        }
        myFunction();
    </script>
    @endif
    <!-- Toast message End -->

    @guest
    @yield('guest')
    @endguest

    <!-- Search Begin -->
    <form action="{{ route('shopSearch') }}" method="GET">
        <div class="search-model">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="search-close-switch">+</div>
                <div class="customer-search-input">
                    <input type="text" id="search-input" name="search" placeholder="Search here.....">
                </div>
            </div>
        </div>
    </form>
    <!-- Search End -->

    <!-- Help button Begin -->
    <!-- <div class="help-area">
        <button type="button" class="site-btn rounded-sm" id="helpButton" style="font-size: 22px;" onclick="toggleHelp()">
            <i class="fa fa-columns mr-2" aria-hidden="true"></i>
            CHAT
        </button>
        <div class="card card-help" id="helpCard">
            <div class="card-help-content" id="helpCardContent">
                <div class="w-100 d-flex justify-content-between align-items-center">
                    <span class="text-dark font-weight-bold fs-5 p-2"><span class="ml-1 text-danger">CHAT</span></span>
                    <button class="btn bg-transparent text-dark" onclick="toggleHelp()"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></button>
                </div>
                <div class="card">
                    <div class="card-body border-1" style="height: 500px; background-color: #f1f1f1;">
                    
                        <div class="d-flex flex-row mb-3">
                            <div class="p-2 bg-light rounded">
                                <p class="mb-0">Hi</p>
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse mb-3">
                            <div class="p-2 bg-primary text-white rounded">
                                <p class="mb-0">hi</p>
                            </div>
                        </div>
                    </div>
                    <form action="{{url('/client/message')}}" method="POST">
                        <div class="card-footer d-flex justify-content-between">
                            <input type="text" class="form-input w-100" placeholder="Nhập nội dung tin nhắn" name="content" required>
                            <button type="submit" class="ml-1 site-btn rounded-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Help button End -->

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css"> -->
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
    <script>
        var botmanWidget = {
            aboutText: 'Botman',
            introMessage: "Xin chào! Tôi có thể giúp gì cho bạn?"
        };
    </script>

    <script>
        function toggleHelp() {
            var helpCard = document.getElementById("helpCard");
            var helpCardContent = document.getElementById("helpCardContent");

            // Toggle the 'expanded' class on the card
            helpCard.classList.toggle("expanded");

            // Hide or show the button based on the card's visibility
            var helpButton = document.getElementById("helpButton");
            if (helpCard.classList.contains("expanded")) {
                helpButton.style.display = "none";
                helpCardContent.style.display = "block";
            } else {
                helpButton.style.display = "block";
                helpCardContent.style.display = "none";
            }
        }
    </script>
    <!-- Help button Begin -->


    <!-- Js Plugins -->
    <script src=" {{asset('assets/client/js/jquery-3.3.1.min.js')}}"></script>
    <script src=" {{asset('assets/client/js/bootstrap.min.js')}}"></script>
    <script src=" {{asset('assets/client/js/jquery.magnific-popup.min.js')}}"></script>
    <script src=" {{asset('assets/client/js/jquery-ui.min.js')}}"></script>
    <script src=" {{asset('assets/client/js/mixitup.min.js')}}"></script>
    <script src=" {{asset('assets/client/js/jquery.countdown.min.js')}}"></script>
    <script src=" {{asset('assets/client/js/jquery.slicknav.js')}}"></script>
    <script src=" {{asset('assets/client/js/owl.carousel.min.js')}}"></script>
    <script src=" {{asset('assets/client/js/jquery.nicescroll.min.js')}}"></script>
    <script src=" {{asset('assets/client/js/main.js')}}"></script>
</body>

</html>