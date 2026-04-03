<!DOCTYPE html>
<html>

<head>
    <title>Super Market an Ecommerce Online Shopping Category Flat Bootstrap Responsive Website Template | Home ::
        w3layouts</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Super Market Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!-- font-awesome icons -->
    <link href="{{ asset('frontend/css/font-awesome.css') }}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="{{ asset('frontend/js/jquery-1.11.1.min.js') }}"></script>
    <!-- //js -->
    <link
        href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <link
        href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic'
        rel='stylesheet' type='text/css'>
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="{{ asset('frontend/js/move-top.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/easing.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <!-- start-smoth-scrolling -->
</head>

<body>
    <!-- header -->
    <div class="agileits_header">
        <div class="container">
            <div class="w3l_offers">
                <p>SALE UP TO 70% OFF. USE CODE "SALE70%" . <a href="#">SHOP NOW</a></p>
            </div>
            <div class="agile-login">
                <ul>
                    @guest
                        <li><a href="{{ route('register') }}">Đăng Ký</a></li>
                        <li><a href="{{ route('login') }}">Đăng Nhập</a></li>
                    @endguest
                    @auth
                        <li>Xin chào: {{ Auth::user()->name }}</li>

                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Đăng xuất
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endauth

                    <li><a href="{{ route('lien-he') }}">Help</a></li>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>

    <div class="logo_products">
        <div class="container">
            <div class="w3ls_logo_products_left">
                <h1><a href="{{ route('trang-chu') }}">CÂY CẢNH</a></h1>
            </div>
            <div class="w3l_search">
                <form action="#" method="post">
                    <input type="search" name="Search" placeholder="Search for a Product..." required="">
                    <button type="submit" class="btn btn-default search" aria-label="Left Align">
                        <i class="fa fa-search" aria-hidden="true"> </i>
                    </button>
                    <div class="clearfix"></div>
                </form>
            </div>

            <div class="clearfix"> </div>
        </div>
    </div>
    <!-- //header -->
    <!-- navigation -->
    <div class="navigation-agileits">
        <div class="container">
            <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{ route('trang-chu') }}" class="act">Home</a></li>
                        <!-- Mega Menu -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Loại Cây<b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu multi-column columns-3">
                                <div class="row">
                                    <div class="multi-gd-img">
                                        <ul class="multi-column-dropdown">
                                            @foreach ($categories as $cate)
                                                <li>
                                                    <a href="{{ route('danh-muc', ['id' => $cate->id]) }}">
                                                        {{ $cate->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                            </ul>
                        </li>
                        <li><a href="{{ route('san-pham') }}">Sản phẩm</a></li>
                        <li><a href="offers#">Kinh nghiệm</a></li>
						<li><a href="offers#">Cẩm nang</a></li>
						<li><a href="{{ route('gio-hang') }}">Giỏ hàng</a></li>
                        <li><a href="{{ route('lien-he') }}">Liên hệ</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <!-- //navigation -->
    @yield('slider')

    @yield('content')

    <!-- //footer -->
    <div class="footer">
        <div class="container">
            <div class="w3_footer_grids">
                <div class="col-md-3 w3_footer_grid">
                    <h3>Contact</h3>

                    <ul class="address">
                        <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>180 cao lỗ, phường 4, quận 8
                            <span>TP.HCM</span>
                        </li>
                        <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a
                                href="#">info@example.com</a></li>
                        <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>0123456789</li>
                    </ul>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <h3>Information</h3>
                    <ul class="info">
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about#">About Us</a>
                        </li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a
                                href="{{ route('lien-he') }}">Contact Us</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="short-codes#">Short
                                Codes</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="faq#">FAQ's</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="products#">Special
                                Products</a></li>
                    </ul>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <h3>Category</h3>
                    <ul class="info">
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a
                                href="groceries#">Groceries</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a
                                href="household#">Household</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="personalcare#">Personal
                                Care</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="packagedfoods#">Packaged
                                Foods</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a
                                href="beverages#">Beverages</a></li>
                    </ul>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <h3>Profile</h3>
                    <ul class="info">
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="products#">Store</a>
                        </li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="checkout#">My Cart</a>
                        </li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a
                                href="{{ route('login') }}">Login</a></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i><a
                                href="{{ route('register') }}">Create Account</a></li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>

        <div class="footer-copy">

            <div class="container">
                <p>Bán hàng vì đam mê</p>
            </div>
        </div>

    </div>
    <div class="footer-botm">
        <div class="container">
            <div class="w3layouts-foot">
                <ul>
                    <li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook"
                                aria-hidden="true"></i></a></li>
                    <li><a href="#" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    </li>
                    <li><a href="#" class="w3_agile_dribble"><i class="fa fa-dribbble"
                                aria-hidden="true"></i></a></li>
                    <li><a href="#" class="w3_agile_vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
            <div class="payment-w3ls">
                <img src="{{ asset('frontend/images/card.png') }}" alt=" " class="img-responsive">
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!-- //footer -->
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>

    <!-- top-header and slider -->
    <!-- here stars scrolling icon -->
    <script type="text/javascript">
        $(document).ready(function() {
            /*
            	var defaults = {
            	containerID: 'toTop', // fading element id
            	containerHoverID: 'toTopHover', // fading element hover id
            	scrollSpeed: 1200,
            	easingType: 'linear' 
            	};
            */

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <!-- //here ends scrolling icon -->
    <script src="{{ asset('frontend/js/minicart.min.js') }}"></script>
    <script>
        // Mini Cart
        paypal.minicart.render({
            action: '#'
        });

        if (~window.location.search.indexOf('reset=true')) {
            paypal.minicart.reset();
        }
    </script>
    <!-- main slider-banner -->
    <script src="{{ asset('frontend/js/skdslider.min.js') }}"></script>
    <link href="{{ asset('frontend/css/skdslider.css') }}" rel="stylesheet">
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#demo1').skdslider({
                'delay': 5000,
                'animationSpeed': 2000,
                'showNextPrev': true,
                'showPlayButton': true,
                'autoSlide': true,
                'animationType': 'fading'
            });

            jQuery('#responsive').change(function() {
                $('#responsive_wrapper').width(jQuery(this).val());
            });

        });
    </script>
    <!-- //main slider-banner -->
</body>

</html>
