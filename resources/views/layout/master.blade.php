<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="description"
        content="Discover a one-stop solution for all your event needs at Bilbol Kitchen. We specialize in providing top-notch equipment rentals for cooking and events, ensuring you have the tools you need to make your celebration a success. From elegant decorations that set the ambiance to professional catering services that delight the palate, our team excels in creating memorable experiences. Entrust us with your event management, and watch as we turn your vision into reality. With our culinary expertise, we also offer event cooking services, crafting delectable dishes that leave a lasting impression on your guests. Elevate your events with Bilbol Kitchen – where every detail matters, and every moment is unforgettable.">
    <meta name="author" content="Bolaji Teslim Olabode">
    <meta name="keywords"
        content="event equipment rental, decorations, catering services, event management, event planning, event cooking, culinary services, party supplies, celebration essentials, catering equipment, event coordination, professional catering, event logistics, party planning, event services, celebration management">
    <link rel="apple-touch-icon-precomposed" sizes="57x57"
        href="{{ URL::to('assets/images/favicon/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ URL::to('assets/images/favicon/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ URL::to('assets/images/favicon/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ URL::to('assets/images/favicon/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60"
        href="{{ URL::to('assets/images/favicon/apple-touch-icon-60x60.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
        href="{{ URL::to('assets/images/favicon/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76"
        href="{{ URL::to('assets/images/favicon/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
        href="{{ URL::to('assets/images/favicon/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png') }}" href="{{ URL::to('assets/images/favicon/favicon-196x196.png') }}"
        sizes="196x196" />
    <link rel="icon" type="image/png') }}" href="{{ URL::to('assets/images/favicon/favicon-96x96.png') }}"
        sizes="96x96" />
    <link rel="icon" type="image/png') }}" href="{{ URL::to('assets/images/favicon/favicon-32x32.png') }}"
        sizes="32x32" />
    <link rel="icon" type="image/png') }}" href="{{ URL::to('assets/images/favicon/favicon-16x16.png') }}"
        sizes="16x16" />
    <link rel="icon" type="image/png') }}" href="{{ URL::to('assets/images/favicon/favicon-128.png') }}"
        sizes="128x128" />
    <meta name="application-name" content="Bilbol Kitchen" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ URL::to('assets/images/favicon/mstile-144x144.png') }}" />
    <meta name="msapplication-square70x70logo" content="{{ URL::to('assets/images/favicon/mstile-70x70.png') }}" />
    <meta name="msapplication-square150x150logo" content="{{ URL::to('assets/images/favicon/mstile-150x150.png') }}" />
    <meta name="msapplication-wide310x150logo" content="{{ URL::to('assets/images/favicon/mstile-310x150.png') }}" />
    <meta name="msapplication-square310x310logo" content="{{ URL::to('assets/images/favicon/mstile-310x310.png') }}" />

    <title>@yield('title') Bilbol Kitchen</title>
    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/bootstrap.css') }}" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700&display=swap"
        rel="stylesheet">
    <!-- Custom styles for this template -->    <link href="{{ URL::to('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ URL::to('assets/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ URL::to('assets/css/responsive.css') }}" rel="stylesheet" />
    <!-- resources/views/layouts/app.blade.php -->
    {{-- message toastr --}}
    <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
    {{-- message toastr --}}
    <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
</head>

<body class="sub_page">
    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="assets/images/png/logo-no-background.png" alt="" />
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  ">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('home') }}">Home <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('about') }}">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('shop') }}">Shop </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('furniture') }}"> Furniture </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact') }}">Contact us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('checkout') }}">Checkout</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart') }}">Cart</a>
                            </li>
                        </ul>
                        <div class="user_option">
                            <a href="">
                                <img src="assets/images/user.png" alt="">
                                <span>
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </span>
                            </a>
                            <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
                            </form>
                        </div>
                    </div>
                    <div>
                        <div class="custom_menu-btn ">
                            <button>
                                <span class=" s-1">

                                </span>
                                <span class="s-2">

                                </span>
                                <span class="s-3">

                                </span>
                            </button>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
    </div>
    {{-- message --}}
    {!! Toastr::message() !!}
    @yield('content')

    <!-- info section -->
    <section class="info_section layout_padding2">
        <div class="container">
            <div class="info_logo">
                <h2>
                    Bilbol Kitchen
                </h2>
            </div>
            <div class="row">

                <div class="col-md-4">
                    <div class="info_contact">
                        <h5>
                            About Shop
                        </h5>
                        <div>
                            <div class="img-box">
                                <img src="assets/images/location-white.png" width="18px" alt="">
                            </div>
                            <p>
                                Block 9 Flat 6,
                                Informatiom Quarters,
                                Phase 4, Kubwa - Abuja.
                            </p>
                        </div>
                        <div>
                            <div class="img-box">
                                <img src="assets/images/telephone-white.png" width="12px" alt="">
                            </div>
                            <p>
                                +234 8077747898
                            </p>&nbsp;
                            <p>
                                +234 7039892637
                            </p>
                        </div>
                        <div>
                            <div class="img-box">
                                <img src="assets/images/envelope-white.png" width="18px" alt="">
                            </div>
                            <p>
                                bolajimotunrayo20@gmail.com
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info_info">
                        <h5>
                            Informations
                        </h5>
                        <p>
                           Discover a one-stop solution for all your event needs at Bilbol Kitchen. We specialize in providing top-notch equipment rentals for cooking and events, ensuring you have the tools you need to make your celebration a success. From elegant decorations that set the ambiance to professional catering services that delight the palate, our team excels in creating memorable experiences. Entrust us with your event management, and watch as we turn your vision into reality. With our culinary expertise, we also offer event cooking services, crafting delectable dishes that leave a lasting impression on your guests. Elevate your events with Bilbol Kitchen – where every detail matters, and every moment is unforgettable.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info_form ">
                        <h5>
                            Newsletter
                        </h5>
                        <form action="">
                            <input type="email" placeholder="Enter your email">
                            <button>
                                Subscribe
                            </button>
                        </form>
                        <div class="social_box">
                            <a href="">
                                <img src="assets/images/fb.png" alt="">
                            </a>
                            <a href="">
                                <img src="assets/images/twitter.png" alt="">
                            </a>
                            <a href="">
                                <img src="assets/images/linkedin.png" alt="">
                            </a>
                            <a href="">
                                <img src="assets/images/youtube.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end info_section -->

    <!-- footer section -->
    <section class="container-fluid footer_section ">
        <div class="container">
            <p>
                Bilbol Kitchen &copy; {{ date('Y') }} All Rights Reserved By
                <a target="blank" href="https://teslim.unibooks.com.ng">Teslim-sama</a>
            </p>
        </div>
    </section>
    <!-- end  footer section -->

    <script type="text/javascript" src="{{ URL::to('assets/js/jquery-3.4.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('assets/js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js">
    </script>
    <script type="text/javascript">
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            navText: [],
            autoplay: true,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                420: {
                    items: 2
                },
                1000: {
                    items: 5
                }
            }

        });
    </script>
    <script>
        var nav = $("#navbarSupportedContent");
        var btn = $(".custom_menu-btn");
        btn.click
        btn.click(function(e) {

            e.preventDefault();
            nav.toggleClass("lg_nav-toggle");
            document.querySelector(".custom_menu-btn").classList.toggle("menu_btn-style")
        });
    </script>
    <script>
        $('.carousel').on('slid.bs.carousel', function() {
            $(".indicator-2 li").removeClass("active");
            indicators = $(".carousel-indicators li.active").data("slide-to");
            a = $(".indicator-2").find("[data-slide-to='" + indicators + "']").addClass("active");
            console.log(indicators);

        })
    </script>

    @yield('script')

</body>

</html>
