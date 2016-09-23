<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="author" content="Giang Phan" />
    <title>Order Management System</title>
    <!--jquery-ui-->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300italic,400italic,700,300|Source+Sans+Pro:400,300,300italic,400italic,700,700italic&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
    <!--common style-->
    <link href="{{ asset('public/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/lib/bootstrap/css/bootstrap-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('public/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/main/css/core.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/main/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/main/css/style-responsive.css') }}" rel="stylesheet">
    @stack('head')
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="sticky-header">
    <section>
        <!-- sidebar left start-->
        <div class="sidebar-left">
            <!--responsive view logo start-->
            <div class="logo dark-logo-bg visible-xs-* visible-sm-*">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('public/assets/main/img/logo-icon.png') }}" alt="">
                    <span class="brand-name">SBS NAILS</span>
                </a>
            </div>
            <!--responsive view logo end-->

            <div class="sidebar-left-info">
                <!-- visible small devices start-->
                <div class=" search-field">  </div>
                <!-- visible small devices end-->

                <!--sidebar nav start-->
                <ul class="nav nav-pills nav-stacked side-navigation">
                    <li>
                        <h3 class="navigation-title">Navigation</h3>
                    </li>
                    <li class=""><a href="{{  route('order.index') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-cubes"></i>  <span>Products</span></a>
                        <ul class="child-list">
                        <li><a href="{{  route('product.index') }}"> List</a></li>
                            <li><a href="{{  route('order.create') }}"> Add New</a></li>
                        </ul>
                    </li>
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-laptop"></i>  <span>Order</span></a>
                        <ul class="child-list">
                        <li><a href="{{  route('order.index') }}"> List</a></li>
                            <li><a href="{{  route('order.create') }}"> Add New</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3 class="navigation-title">Administrator</h3>
                    </li>
                    <li class="menu-list"><a href="#"><i class="fa fa-user"></i> <span>User </span></a>
                        <ul class="child-list">
                            <li><a href="{{ route('user.index') }}"> List</a></li>
                            <li><a href="{{ route('user.create') }}"> Add New</a></li>
                        </ul>
                    </li>
                    <li class=""><a href="#"><i class="fa fa-tasks"></i> <span>Log </span></a>
                    </li>

                <!--sidebar nav end-->

            </div>
        </div>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" >

            <!-- header section start-->
            <div class="header-section">

                <!--logo and logo icon start-->
                <div class="logo dark-logo-bg hidden-xs hidden-sm">
                    <a href="{{ route('dashboard') }}">
                        <img class="img-responsive" src="{{ asset('public/assets/main/img/logo-icon.png') }}" alt="">
                        <!--<i class="fa fa-maxcdn"></i>-->
                        <span class="brand-name">SBS NAILS</span>
                    </a>
                </div>
                <!--logo and logo icon end-->

                <!--toggle button start-->
                <a class="toggle-btn"><i class="fa fa-outdent"></i></a>
                <!--toggle button end-->

                <div class="notification-wrap">
                <!--right notification start-->
                <div class="right-notification">
                    <ul class="notification-menu">
                        {{-- <li>
                            <form class="search-content" action="http://thevectorlab.net/slicklab/index.html" method="post">
                                <input type="text" class="form-control" name="keyword" placeholder="Search...">
                            </form>
                        </li> --}}

                        <li>
                            <a href="javascript:;" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('public/assets/login/img/user-12.jpg') }}" alt="">@if(Auth::check()) {{ Auth::user()->name }} @endif
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu purple pull-right">
                                <li><a href="javascript:;">  Profile</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--right notification end-->
                </div>

            </div>
            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                @yield('page-head')
            </div>
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">
                @yield('content')
            </div>
            <!--body wrapper end-->

            <!--footer section start-->
            <footer>
                Made with <i class="fa fa-heart"></i> by Giang Phan. {{ date('Y') }} &copy; All right reserved.
            </footer>
            <!--footer section end-->

        </div>
        <!-- body content end-->
    </section>
<!-- Placed js at the end of the document so the pages load faster -->
<script src="{{ asset('public/lib/jquery/jquery-1.12.4.min.js') }}"></script>

<script src="{{ asset('public/lib/jquery/jquery-migrate.js') }}"></script>
<script src="{{ asset('public/lib/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/lib/modernizr.min.js') }}"></script>

<!--Nice Scroll-->
<script src="{{ asset('public/lib/jquery/jquery.nicescroll.js') }}" type="text/javascript"></script>

<!--jquery countTo-->
<script src="{{ asset('public/lib/jquery-countTo/jquery.countTo.js') }}"  type="text/javascript"></script>


<script type="text/javascript">

    $(document).ready(function() {
        //countTo
        $('.timer').countTo();
    });

</script>
<!--common scripts for all pages-->
@stack('scripts')
<script src="{{ asset('public/assets/main/js/myscripts.js') }}"></script>

</body>
</html>
